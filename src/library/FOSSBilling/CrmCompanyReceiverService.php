<?php

declare(strict_types=1);

/**
 * Copyright 2022-2025 FOSSBilling
 * Copyright 2011-2021 BoxBilling, Inc.
 * SPDX-License-Identifier: Apache-2.0.
 *
 * @copyright FOSSBilling (https://www.fossbilling.org)
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

namespace FOSSBilling;

use Pimple\Container;

/**
 * CRM Company Receiver Service
 *
 * Verwerkt inkomende bedrijfssynchronisatie berichten van CRM naar Facturatie.
 *
 * Contracten:
 *  - Contract 14: crm.company.confirmed  → processConfirmed()   → upsert bedrijf
 *  - Contract 19: crm.company.updated    → processUpdated()     → upsert bedrijf (met extra velden)
 *  - Contract 23: crm.company.deactivated → processDeactivated() → soft delete (isActive = false)
 *
 * Lookup strategie (van hoog naar laag prioriteit):
 *  1. Via id (CRM UUID = Facturatie company id)
 *  2. Via vat_number (backward compatibility / fallback)
 *
 * Businessregel: NOOIT hard deleten. Bij deactivatie enkel is_active = 0 zetten.
 */
class CrmCompanyReceiverService
{
    public function __construct(private readonly Container $di)
    {
    }

    /**
     * Verwerkt een inkomend CRM company bericht op basis van de routing key.
     *
     * @throws \InvalidArgumentException Als de routing key niet ondersteund wordt
     */
    public function process(string $routingKey, string $xml): string
    {
        return match ($routingKey) {
            'crm.company.confirmed'   => $this->processConfirmed($xml),
            'crm.company.updated'     => $this->processUpdated($xml),
            'crm.company.deactivated' => $this->processDeactivated($xml),
            default => throw new \InvalidArgumentException(
                sprintf('Unsupported routing key "%s" for CRM company receiver.', $routingKey)
            ),
        };
    }

    // ─── Handlers per contract ─────────────────────────────────────────────────

    /**
     * Contract 14: crm.company.confirmed
     * Maakt een nieuw bedrijf aan of update een bestaand bedrijf (upsert).
     */
    private function processConfirmed(string $xml): string
    {
        $payload = $this->parseConfirmed($xml);

        return $this->upsertCompany($payload, 'crm.company.confirmed');
    }

    /**
     * Contract 19: crm.company.updated
     * Vervangt de lokale kopie volledig (geen partial merge).
     */
    private function processUpdated(string $xml): string
    {
        $payload = $this->parseUpdated($xml);

        return $this->upsertCompany($payload, 'crm.company.updated');
    }

    /**
     * Contract 23: crm.company.deactivated
     * Soft delete: zet isActive = false. Nooit hard deleten.
     */
    private function processDeactivated(string $xml): string
    {
        $payload = $this->parseDeactivated($xml);

        $company = $this->findCompany((string) $payload['id'], (string) $payload['vatNumber']);
        if ($company === null) {
            $this->logWarn(sprintf(
                '[crm-company-receiver] Deactivate skipped: company not found (crm_id=%s, vat=%s)',
                (string) $payload['id'],
                (string) $payload['vatNumber']
            ));

            return 'not-found';
        }

        $this->di['db']->exec(
            'UPDATE company SET is_active = 0, updated_at = :updated_at WHERE id = :id',
            [
                ':id'         => $company['id'],
                ':updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        $this->logInfo(sprintf(
            '[crm-company-receiver] Deactivated company id=%s (crm_id=%s, vat=%s)',
            (string) $company['id'],
            (string) $payload['id'],
            (string) $payload['vatNumber']
        ));

        return 'deactivated';
    }

    // ─── Upsert logica ─────────────────────────────────────────────────────────

    /**
     * Maakt een bedrijf aan of werkt het bij op basis van de CRM UUID of btw-nummer.
     */
    private function upsertCompany(array $payload, string $source): string
    {
        $existing = $this->findCompany((string) $payload['id'], (string) $payload['vatNumber']);

        if ($existing !== null) {
            $this->updateCompany($existing['id'], $payload);

            $this->logInfo(sprintf(
                '[crm-company-receiver] Updated company id=%s (crm_id=%s, vat=%s, source=%s)',
                (string) $existing['id'],
                (string) $payload['id'],
                (string) $payload['vatNumber'],
                $source
            ));

            return 'updated';
        }

        $this->createCompany($payload);

        $this->logInfo(sprintf(
            '[crm-company-receiver] Created company id=%s (vat=%s, source=%s)',
            (string) $payload['id'],
            (string) $payload['vatNumber'],
            $source
        ));

        return 'created';
    }

    /**
     * Zoekt een bedrijf op in Facturatie.
     * Prioriteit: 1) CRM UUID als id, 2) vat_number als fallback.
     *
     * @return array<string, mixed>|null
     */
    private function findCompany(string $crmId, string $vatNumber): ?array
    {
        // Primaire lookup: CRM UUID als bedrijfs-id
        $row = $this->di['db']->getRow(
            'SELECT * FROM company WHERE id = :id LIMIT 1',
            [':id' => $crmId]
        );
        if (is_array($row) && $row !== []) {
            return $row;
        }

        // Fallback: zoek op btw-nummer (voor bedrijven aangemaakt vóór CRM sync)
        $row = $this->di['db']->getRow(
            'SELECT * FROM company WHERE vat_number = :vat LIMIT 1',
            [':vat' => $vatNumber]
        );

        return (is_array($row) && $row !== []) ? $row : null;
    }

    /**
     * Maakt een nieuw bedrijf aan met de CRM UUID als primaire sleutel.
     */
    private function createCompany(array $payload): void
    {
        $now = date('Y-m-d H:i:s');

        $this->di['db']->exec(
            'INSERT INTO company (id, name, vat_number, email, phone, street, house_number, city, postal_code, country, is_active, created_at, updated_at)
             VALUES (:id, :name, :vat_number, :email, :phone, :street, :house_number, :city, :postal_code, :country, :is_active, :created_at, :updated_at)',
            [
                ':id'           => $payload['id'],
                ':name'         => $payload['name'],
                ':vat_number'   => $payload['vatNumber'],
                ':email'        => $payload['email'] ?? null,
                ':phone'        => $payload['phone'] ?? null,
                ':street'       => $payload['street'] ?? null,
                ':house_number' => $payload['houseNumber'] ?? null,
                ':city'         => $payload['city'] ?? null,
                ':postal_code'  => $payload['postalCode'] ?? null,
                ':country'      => $payload['country'] ?? null,
                ':is_active'    => $payload['isActive'] ? 1 : 0,
                ':created_at'   => $now,
                ':updated_at'   => $now,
            ]
        );
    }

    /**
     * Werkt een bestaand bedrijf bij met de data uit het CRM bericht.
     * Volledige vervanging (geen partial merge).
     */
    private function updateCompany(string $companyId, array $payload): void
    {
        $now = date('Y-m-d H:i:s');

        $this->di['db']->exec(
            'UPDATE company
             SET name = :name, vat_number = :vat_number, email = :email, phone = :phone,
                 street = :street, house_number = :house_number, city = :city,
                 postal_code = :postal_code, country = :country,
                 is_active = :is_active, updated_at = :updated_at
             WHERE id = :id',
            [
                ':id'           => $companyId,
                ':name'         => $payload['name'],
                ':vat_number'   => $payload['vatNumber'],
                ':email'        => $payload['email'] ?? null,
                ':phone'        => $payload['phone'] ?? null,
                ':street'       => $payload['street'] ?? null,
                ':house_number' => $payload['houseNumber'] ?? null,
                ':city'         => $payload['city'] ?? null,
                ':postal_code'  => $payload['postalCode'] ?? null,
                ':country'      => $payload['country'] ?? null,
                ':is_active'    => $payload['isActive'] ? 1 : 0,
                ':updated_at'   => $now,
            ]
        );
    }

    // ─── XML Parsing ───────────────────────────────────────────────────────────

    /**
     * Parset een CompanyConfirmed XML bericht (Contract 14).
     *
     * @return array{id: string, vatNumber: string, name: string, email: string, isActive: bool, confirmedAt: string}
     */
    private function parseConfirmed(string $xml): array
    {
        $xpath = $this->buildXPath($xml);

        return [
            'id'          => $this->xpathRequired($xpath, '/CompanyConfirmed/id'),
            'vatNumber'   => $this->xpathRequired($xpath, '/CompanyConfirmed/vatNumber'),
            'name'        => $this->xpathRequired($xpath, '/CompanyConfirmed/name'),
            'email'       => $this->xpathRequired($xpath, '/CompanyConfirmed/email'),
            'isActive'    => $this->xpathBool($xpath, '/CompanyConfirmed/isActive'),
            'confirmedAt' => $this->xpathRequired($xpath, '/CompanyConfirmed/confirmedAt'),
            // Contract 14 heeft geen adresvelden — optioneel null
            'phone'       => null,
            'street'      => null,
            'houseNumber' => null,
            'postalCode'  => null,
            'city'        => null,
            'country'     => null,
        ];
    }

    /**
     * Parset een CompanyUpdated XML bericht (Contract 19).
     *
     * @return array{id: string, vatNumber: string, name: string, isActive: bool, updatedAt: string, ...}
     */
    private function parseUpdated(string $xml): array
    {
        $xpath = $this->buildXPath($xml);

        return [
            'id'          => $this->xpathRequired($xpath, '/CompanyUpdated/id'),
            'vatNumber'   => $this->xpathRequired($xpath, '/CompanyUpdated/vatNumber'),
            'name'        => $this->xpathRequired($xpath, '/CompanyUpdated/name'),
            'email'       => $this->xpathOptional($xpath, '/CompanyUpdated/email'),
            'phone'       => $this->xpathOptional($xpath, '/CompanyUpdated/phone'),
            'street'      => $this->xpathOptional($xpath, '/CompanyUpdated/street'),
            'houseNumber' => $this->xpathOptional($xpath, '/CompanyUpdated/houseNumber'),
            'postalCode'  => $this->xpathOptional($xpath, '/CompanyUpdated/postalCode'),
            'city'        => $this->xpathOptional($xpath, '/CompanyUpdated/city'),
            'country'     => $this->xpathOptional($xpath, '/CompanyUpdated/country'),
            'isActive'    => $this->xpathBool($xpath, '/CompanyUpdated/isActive'),
            'updatedAt'   => $this->xpathRequired($xpath, '/CompanyUpdated/updatedAt'),
        ];
    }

    /**
     * Parset een CompanyDeactivated XML bericht (Contract 23).
     *
     * @return array{id: string, vatNumber: string, deactivatedAt: string}
     */
    private function parseDeactivated(string $xml): array
    {
        $xpath = $this->buildXPath($xml);

        return [
            'id'            => $this->xpathRequired($xpath, '/CompanyDeactivated/id'),
            'vatNumber'     => $this->xpathRequired($xpath, '/CompanyDeactivated/vatNumber'),
            'deactivatedAt' => $this->xpathRequired($xpath, '/CompanyDeactivated/deactivatedAt'),
        ];
    }

    // ─── XPath hulpmethoden ────────────────────────────────────────────────────

    private function buildXPath(string $xml): \DOMXPath
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);

        try {
            if (!$dom->loadXML($xml, LIBXML_NONET)) {
                throw new \InvalidArgumentException(
                    'Kan CRM company XML niet laden: ' . $this->formatLibxmlErrors()
                );
            }
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }

        return new \DOMXPath($dom);
    }

    private function xpathRequired(\DOMXPath $xpath, string $path): string
    {
        $value = trim((string) $xpath->evaluate(sprintf('string(%s)', $path)));
        if ($value === '') {
            throw new \InvalidArgumentException(
                sprintf('Verplicht veld ontbreekt in CRM company bericht: %s', $path)
            );
        }

        return $value;
    }

    private function xpathOptional(\DOMXPath $xpath, string $path): ?string
    {
        $value = trim((string) $xpath->evaluate(sprintf('string(%s)', $path)));

        return $value === '' ? null : $value;
    }

    private function xpathBool(\DOMXPath $xpath, string $path): bool
    {
        $value = strtolower(trim((string) $xpath->evaluate(sprintf('string(%s)', $path))));

        return $value === 'true' || $value === '1';
    }

    private function formatLibxmlErrors(): string
    {
        $errors = libxml_get_errors();
        if ($errors === []) {
            return 'Unknown libxml error';
        }

        return implode(' | ', array_unique(array_map(
            static fn(\LibXMLError $e): string => trim($e->message),
            $errors
        )));
    }

    // ─── Logging ──────────────────────────────────────────────────────────────

    private function logInfo(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->info($message);
        } else {
            error_log($message);
        }
    }

    private function logWarn(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->warn($message);
        } else {
            error_log($message);
        }
    }

    public function logError(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->err($message);
        } else {
            error_log($message);
        }
    }
}

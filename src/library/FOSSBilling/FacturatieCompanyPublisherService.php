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

class FacturatieCompanyPublisherService
{
    public const ROUTING_KEY_CREATED = 'facturatie.company.created';
    public const ROUTING_KEY_UPDATED = 'facturatie.company.updated';
    public const ROUTING_KEY_DEACTIVATED = 'facturatie.company.deactivated';

    private const DEFAULT_EXCHANGE = 'company.topic';

    private ?RabbitMQService $rabbitMQService = null;
    private bool $topologyDeclared = false;

    public function __construct(private readonly Container $di, ?RabbitMQService $rabbitMQService = null)
    {
        $this->rabbitMQService = $rabbitMQService;
    }

    /**
     * Publiceert een CompanyCreated-event nadat een nieuw bedrijf is aangemaakt in FOSSBilling.
     */
    public function publishCreated(array $company): void
    {
        $this->ensureTopology();

        $payload = $this->buildCreatedPayload($company);
        $xml = $this->buildCreatedXml($payload);

        try {
            $this->rabbit()->publishXML(self::ROUTING_KEY_CREATED, $xml);

            $this->logInfo(sprintf(
                '[facturatie-company-publisher] Published created event (company_id=%s, name=%s)',
                (string) ($company['id'] ?? 'unknown'),
                (string) ($company['name'] ?? '')
            ));
        } catch (\Throwable $exception) {
            $this->logError(sprintf(
                '[facturatie-company-publisher] Failed publish created event (company_id=%s, routing_key=%s, exception=%s, message=%s)',
                (string) ($company['id'] ?? 'unknown'),
                self::ROUTING_KEY_CREATED,
                get_class($exception),
                $exception->getMessage()
            ));

            throw $exception;
        }
    }

    /**
     * Publiceert een CompanyUpdated-event nadat een bedrijf is gewijzigd in FOSSBilling.
     */
    public function publishUpdated(array $company): void
    {
        $this->ensureTopology();

        $outboundId = $this->resolveOutboundId($company);
        if ($outboundId === null) {
            $this->logWarn(sprintf(
                '[facturatie-company-publisher] Skip updated publish: missing company UUID (name=%s)',
                (string) ($company['name'] ?? '')
            ));

            return;
        }

        $payload = $this->buildUpdatedPayload($company, $outboundId);
        $xml = $this->buildUpdatedXml($payload);

        try {
            $this->rabbit()->publishXML(self::ROUTING_KEY_UPDATED, $xml);

            $this->logInfo(sprintf(
                '[facturatie-company-publisher] Published updated event (company_id=%s, name=%s)',
                $outboundId,
                (string) ($company['name'] ?? '')
            ));
        } catch (\Throwable $exception) {
            $this->logError(sprintf(
                '[facturatie-company-publisher] Failed publish updated event (company_id=%s, routing_key=%s, exception=%s, message=%s)',
                $outboundId,
                self::ROUTING_KEY_UPDATED,
                get_class($exception),
                $exception->getMessage()
            ));

            throw $exception;
        }
    }

    /**
     * Publiceert een CompanyDeactivated-event wanneer een bedrijf wordt gedeactiveerd in FOSSBilling.
     */
    public function publishDeactivated(array $company, ?\DateTimeInterface $deactivatedAt = null): void
    {
        $this->ensureTopology();

        $outboundId = $this->resolveOutboundId($company);
        if ($outboundId === null) {
            $this->logWarn(sprintf(
                '[facturatie-company-publisher] Skip deactivated publish: missing company UUID (name=%s)',
                (string) ($company['name'] ?? '')
            ));

            return;
        }

        $payload = [
            'id' => $outboundId,
            'email' => (string) ($company['email'] ?? ''),
            'deactivatedAt' => ($deactivatedAt ?? new \DateTimeImmutable('now', new \DateTimeZone('UTC')))->format('Y-m-d\TH:i:sP'),
        ];

        $xml = $this->buildDeactivatedXml($payload);

        try {
            $this->rabbit()->publishXML(self::ROUTING_KEY_DEACTIVATED, $xml);

            $this->logInfo(sprintf(
                '[facturatie-company-publisher] Published deactivated event (company_id=%s)',
                $outboundId
            ));
        } catch (\Throwable $exception) {
            $this->logError(sprintf(
                '[facturatie-company-publisher] Failed publish deactivated event (company_id=%s, routing_key=%s, exception=%s, message=%s)',
                $outboundId,
                self::ROUTING_KEY_DEACTIVATED,
                get_class($exception),
                $exception->getMessage()
            ));

            throw $exception;
        }
    }

    // ─── Payload-opbouw ───────────────────────────────────────────

    private function buildCreatedPayload(array $company): array
    {
        return [
            'name' => (string) ($company['name'] ?? ''),
            'vatNumber' => $this->nullableString($company['vat_number'] ?? null),
            'email' => $this->nullableString($company['email'] ?? null),
            'phone' => $this->nullableString($company['phone'] ?? null),
            'street' => $this->nullableString($company['street'] ?? null),
            'houseNumber' => $this->nullableString($company['house_number'] ?? null),
            'postalCode' => $this->nullableString($company['postal_code'] ?? null),
            'city' => $this->nullableString($company['city'] ?? null),
            'country' => $this->normalizeCountryCode($company['country'] ?? null),
            'createdAt' => $this->toIso8601($company['created_at'] ?? null),
        ];
    }

    private function buildUpdatedPayload(array $company, string $companyId): array
    {
        return [
            'id' => $companyId,
            'vatNumber' => $this->nullableString($company['vat_number'] ?? null),
            'name' => (string) ($company['name'] ?? ''),
            'email' => $this->nullableString($company['email'] ?? null),
            'phone' => $this->nullableString($company['phone'] ?? null),
            'street' => $this->nullableString($company['street'] ?? null),
            'houseNumber' => $this->nullableString($company['house_number'] ?? null),
            'postalCode' => $this->nullableString($company['postal_code'] ?? null),
            'city' => $this->nullableString($company['city'] ?? null),
            'country' => $this->normalizeCountryCode($company['country'] ?? null),
            'isActive' => (int) ($company['is_active'] ?? 1) === 1,
            'updatedAt' => $this->toIso8601($company['updated_at'] ?? null),
        ];
    }

    // ─── XML-opbouw ──────────────────────────────────────────────

    private function buildCreatedXml(array $payload): string
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $root = $dom->createElement('FacturatieCompanyCreated');

        $this->appendRequiredElement($dom, $root, 'name', $payload['name']);
        $this->appendOptionalElement($dom, $root, 'vatNumber', $payload['vatNumber']);
        $this->appendOptionalElement($dom, $root, 'email', $payload['email']);
        $this->appendOptionalElement($dom, $root, 'phone', $payload['phone']);
        $this->appendOptionalElement($dom, $root, 'street', $payload['street']);
        $this->appendOptionalElement($dom, $root, 'houseNumber', $payload['houseNumber']);
        $this->appendOptionalElement($dom, $root, 'postalCode', $payload['postalCode']);
        $this->appendOptionalElement($dom, $root, 'city', $payload['city']);
        $this->appendOptionalElement($dom, $root, 'country', $payload['country']);
        $this->appendRequiredElement($dom, $root, 'createdAt', $payload['createdAt']);

        $dom->appendChild($root);

        return $dom->saveXML() ?: '';
    }

    private function buildUpdatedXml(array $payload): string
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $root = $dom->createElement('FacturatieCompanyUpdated');

        $this->appendRequiredElement($dom, $root, 'id', $payload['id']);
        $this->appendOptionalElement($dom, $root, 'vatNumber', $payload['vatNumber']);
        $this->appendRequiredElement($dom, $root, 'name', $payload['name']);
        $this->appendOptionalElement($dom, $root, 'email', $payload['email']);
        $this->appendOptionalElement($dom, $root, 'phone', $payload['phone']);
        $this->appendOptionalElement($dom, $root, 'street', $payload['street']);
        $this->appendOptionalElement($dom, $root, 'houseNumber', $payload['houseNumber']);
        $this->appendOptionalElement($dom, $root, 'postalCode', $payload['postalCode']);
        $this->appendOptionalElement($dom, $root, 'city', $payload['city']);
        $this->appendOptionalElement($dom, $root, 'country', $payload['country']);
        $this->appendRequiredElement($dom, $root, 'isActive', $this->boolToXml($payload['isActive']));
        $this->appendRequiredElement($dom, $root, 'updatedAt', $payload['updatedAt']);

        $dom->appendChild($root);

        return $dom->saveXML() ?: '';
    }

    private function buildDeactivatedXml(array $payload): string
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $root = $dom->createElement('FacturatieCompanyDeactivated');

        $this->appendRequiredElement($dom, $root, 'id', $payload['id']);
        $this->appendRequiredElement($dom, $root, 'email', $payload['email']);
        $this->appendRequiredElement($dom, $root, 'deactivatedAt', $payload['deactivatedAt']);

        $dom->appendChild($root);

        return $dom->saveXML() ?: '';
    }

    // ─── DOM-hulpmethoden ─────────────────────────────────────────

    private function appendRequiredElement(\DOMDocument $dom, \DOMElement $root, string $name, string $value): void
    {
        $root->appendChild($dom->createElement($name, $value));
    }

    private function appendOptionalElement(\DOMDocument $dom, \DOMElement $root, string $name, ?string $value): void
    {
        if ($value === null || $value === '') {
            return;
        }

        $root->appendChild($dom->createElement($name, $value));
    }

    private function boolToXml(bool $value): string
    {
        return $value ? 'true' : 'false';
    }

    // ─── Normalisatie-hulpmethoden ──────────────────────────────

    private function resolveOutboundId(array $company): ?string
    {
        $aid = $this->nullableString($company['aid'] ?? null);
        if ($aid !== null && $this->isUuidV4($aid)) {
            return $aid;
        }

        $id = $this->nullableString($company['id'] ?? null);
        if ($id !== null && $this->isUuidV4($id)) {
            return $id;
        }

        return null;
    }

    private function normalizeCountryCode(?string $value): ?string
    {
        $normalized = strtoupper(trim((string) $value));
        if ($normalized === '' || !preg_match('/^[A-Z]{2}$/', $normalized)) {
            return null;
        }

        return $normalized;
    }

    private function toIso8601(?string $value): string
    {
        try {
            if (!empty($value)) {
                $dateTime = new \DateTimeImmutable($value, new \DateTimeZone('UTC'));

                return $dateTime->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d\TH:i:sP');
            }
        } catch (\Throwable) {
            // Terugvallen op huidig UTC-tijdstip als de brondatum ongeldig is.
        }

        return (new \DateTimeImmutable('now', new \DateTimeZone('UTC')))->format('Y-m-d\TH:i:sP');
    }

    private function isUuidV4(string $value): bool
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $value) === 1;
    }

    private function nullableString(?string $value): ?string
    {
        $normalized = trim((string) $value);

        return $normalized === '' ? null : $normalized;
    }

    // ─── RabbitMQ-topologie ────────────────────────────────────────

    private function rabbit(): RabbitMQService
    {
        if ($this->rabbitMQService instanceof RabbitMQService) {
            return $this->rabbitMQService;
        }

        $this->rabbitMQService = new RabbitMQService([
            'exchange' => $this->companyExchange(),
        ]);

        return $this->rabbitMQService;
    }

    private function ensureTopology(): void
    {
        if ($this->topologyDeclared) {
            return;
        }

        $exchange = $this->companyExchange();
        $rabbit = $this->rabbit();

        try {
            $rabbit->declareExchange($exchange, 'topic', true);
        } catch (\Throwable $exception) {
            $this->logError(sprintf(
                '[facturatie-company-publisher] Failed to declare exchange (exchange=%s, exception=%s, message=%s)',
                $exchange,
                get_class($exception),
                $exception->getMessage()
            ));

            throw $exception;
        }

        $this->topologyDeclared = true;
    }

    private function companyExchange(): string
    {
        $value = trim((string) getenv('FACTURATIE_COMPANY_EXCHANGE'));

        return $value !== '' ? $value : self::DEFAULT_EXCHANGE;
    }

    // ─── Logging (logboek) ────────────────────────────────────────

    private function logInfo(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->info($message);

            return;
        }

        error_log($message);
    }

    private function logWarn(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->warn($message);

            return;
        }

        error_log($message);
    }

    private function logError(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->err($message);

            return;
        }

        error_log($message);
    }
}

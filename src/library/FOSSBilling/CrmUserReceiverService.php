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

class CrmUserReceiverService
{
    private const TARGET_ROLE = 'COMPANY_CONTACT';

    public function __construct(private readonly Container $di)
    {
    }

    public function process(string $routingKey, string $xml): string
    {
        return match ($routingKey) {
            'crm.user.confirmed' => $this->processConfirmed($xml),
            'crm.user.updated' => $this->processUpdated($xml),
            'crm.user.deactivated' => $this->processDeactivated($xml),
            default => throw new \InvalidArgumentException(sprintf('Unsupported routing key "%s" for CRM user receiver.', $routingKey)),
        };
    }

    private function processConfirmed(string $xml): string
    {
        $payload = $this->parseConfirmed($xml);

        return $this->upsertClient($payload, false, 'crm.user.confirmed');
    }

    private function processUpdated(string $xml): string
    {
        $payload = $this->parseUpdated($xml);

        return $this->upsertClient($payload, true, 'crm.user.updated');
    }

    private function processDeactivated(string $xml): string
    {
        $payload = $this->parseDeactivated($xml);

        $client = $this->findClient((string) $payload['id'], (string) $payload['email']);
        if (!$client instanceof \Model_Client) {
            $this->logWarn(sprintf(
                '[crm-user-receiver] Deactivate skipped: client not found (crm_user_id=%s, email=%s)',
                (string) $payload['id'],
                (string) $payload['email']
            ));

            return 'not-found';
        }

        $client->status = \Model_Client::SUSPENDED;
        $client->custom_5 = (string) $payload['deactivatedAt'];
        $client->updated_at = date('Y-m-d H:i:s');
        $this->di['db']->store($client);

        $this->logInfo(sprintf(
            '[crm-user-receiver] Deactivated client #%s (crm_user_id=%s, email=%s)',
            (string) $client->id,
            (string) $payload['id'],
            (string) $payload['email']
        ));

        return 'deactivated';
    }

    private function upsertClient(array $payload, bool $isUpdateMessage, string $sourceRoutingKey): string
    {
        if ($payload['role'] !== self::TARGET_ROLE) {
            $this->logWarn(sprintf(
                '[crm-user-receiver] Refused user message due to unsupported role (source=%s, crm_user_id=%s, email=%s, role=%s, expected_role=%s)',
                $sourceRoutingKey,
                (string) $payload['id'],
                (string) $payload['email'],
                (string) $payload['role'],
                self::TARGET_ROLE
            ));

            return 'ignored-role';
        }

        $client = $this->findClient((string) $payload['id'], (string) $payload['email']);
        if ($client instanceof \Model_Client) {
            $this->updateExistingClient($client, $payload, $isUpdateMessage, $sourceRoutingKey);

            $this->logInfo(sprintf(
                '[crm-user-receiver] Updated existing client #%s (crm_user_id=%s, email=%s, source=%s)',
                (string) $client->id,
                (string) $payload['id'],
                (string) $payload['email'],
                $isUpdateMessage ? 'crm.user.updated' : 'crm.user.confirmed'
            ));

            return 'updated';
        }

        $this->createClient($payload, $sourceRoutingKey);

        $this->logInfo(sprintf(
            '[crm-user-receiver] Created client from CRM payload (crm_user_id=%s, email=%s, source=%s)',
            (string) $payload['id'],
            (string) $payload['email'],
            $isUpdateMessage ? 'crm.user.updated' : 'crm.user.confirmed'
        ));

        return 'created';
    }

    private function findClient(string $crmUserId, string $email): ?\Model_Client
    {
        $client = $this->di['db']->findOne('Client', 'aid = ?', [$crmUserId]);
        if ($client instanceof \Model_Client) {
            return $client;
        }

        // Backward compatibility in case early messages were persisted to custom_1.
        $client = $this->di['db']->findOne('Client', 'custom_1 = ?', [$crmUserId]);
        if ($client instanceof \Model_Client) {
            return $client;
        }

        $client = $this->di['db']->findOne('Client', 'email = ?', [strtolower($email)]);

        return $client instanceof \Model_Client ? $client : null;
    }

    private function createClient(array $payload, string $sourceRoutingKey): void
    {
        $clientService = $this->di['mod_service']('client');
        $createData = $this->buildClientWriteData($payload, false, $sourceRoutingKey);
        $createData['password'] = $this->generateStrongPassword();
        $createData['sync_origin'] = 'crm';
        $createData['suppress_user_topic_publish'] = true;

        $clientService->adminCreateClient($createData);
    }

    private function updateExistingClient(\Model_Client $client, array $payload, bool $isUpdateMessage, string $sourceRoutingKey): void
    {
        $normalizedEmail = strtolower((string) $payload['email']);
        $conflictingClientId = $this->di['db']->getCell('SELECT id FROM client WHERE email = :email AND id != :id LIMIT 1', [
            ':email' => $normalizedEmail,
            ':id' => $client->id,
        ]);
        if ($conflictingClientId) {
            $this->logError(sprintf(
                '[crm-user-receiver] Email conflict while updating client #%s (crm_user_id=%s, email=%s, conflicting_client_id=%s)',
                (string) $client->id,
                (string) $payload['id'],
                $normalizedEmail,
                (string) $conflictingClientId
            ));

            throw new \RuntimeException(sprintf('Cannot update CRM user %s because email %s is already used by client #%s.', $payload['id'], $normalizedEmail, $conflictingClientId));
        }

        $writeData = $this->buildClientWriteData($payload, $isUpdateMessage, $sourceRoutingKey);

        $client->email = $normalizedEmail;
        $client->first_name = $writeData['first_name'];
        $client->last_name = $writeData['last_name'];
        $client->phone = $writeData['phone'];
        $client->status = $writeData['status'];
        $client->aid = $writeData['aid'];
        $client->custom_2 = $writeData['custom_2'];
        $client->custom_3 = $writeData['custom_3'];
        $client->custom_4 = $writeData['custom_4'];
        $client->custom_5 = $writeData['custom_5'];
        $client->company_id = $writeData['company_id'];

        if ($isUpdateMessage) {
            $client->address_1 = $writeData['address_1'];
            $client->address_2 = $writeData['address_2'];
            $client->postcode = $writeData['postcode'];
            $client->city = $writeData['city'];
            $client->country = $writeData['country'];
        }

        $client->updated_at = date('Y-m-d H:i:s');
        $this->di['db']->store($client);
    }

    private function buildClientWriteData(array $payload, bool $isUpdateMessage, string $sourceRoutingKey): array
    {
        $status = $payload['isActive'] ? \Model_Client::ACTIVE : \Model_Client::SUSPENDED;
        $companyId = $payload['companyId'];
        $localCompanyId = $this->resolveLocalCompanyId($companyId);

        if ($companyId !== null && $localCompanyId === null) {
            $this->logWarn(sprintf(
                '[crm-user-receiver] Refused user message due to missing company dependency (source=%s, crm_user_id=%s, email=%s, company_id=%s)',
                $sourceRoutingKey,
                (string) $payload['id'],
                (string) $payload['email'],
                (string) $companyId
            ));

            throw new MissingCompanyDependencyException($companyId);
        }

        $data = [
            'email' => strtolower((string) $payload['email']),
            'first_name' => (string) $payload['firstName'],
            'last_name' => (string) $payload['lastName'],
            'phone' => $payload['phone'],
            'status' => $status,
            'type' => 'company',
            'company_id' => $localCompanyId,
            'aid' => (string) $payload['id'],
            'custom_2' => (string) $payload['role'],
            'custom_3' => $payload['badgeCode'],
            'custom_4' => $payload['gdprConsent'] ? '1' : '0',
            'custom_5' => (string) ($payload[$isUpdateMessage ? 'updatedAt' : 'confirmedAt'] ?? ''),
        ];

        if ($isUpdateMessage) {
            $address1 = $payload['street'];
            if ($address1 !== null && $payload['houseNumber'] !== null) {
                $address1 = trim($address1 . ' ' . $payload['houseNumber']);
            }

            $data['address_1'] = $address1;
            $data['address_2'] = $payload['houseNumber'];
            $data['postcode'] = $payload['postalCode'];
            $data['city'] = $payload['city'];
            $data['country'] = $payload['country'];
        }

        return $data;
    }

    private function resolveLocalCompanyId(?string $companyId): ?string
    {
        if ($companyId === null) {
            return null;
        }

        $existingCompanyId = $this->di['db']->getCell('SELECT id FROM company WHERE id = :id OR aid = :aid LIMIT 1', [
            ':id' => $companyId,
            ':aid' => $companyId,
        ]);

        if (!$existingCompanyId) {
            $this->logWarn(sprintf('[crm-user-receiver] Company lookup miss (company_id=%s)', $companyId));

            return null;
        }

        return (string) $existingCompanyId;
    }

    private function parseConfirmed(string $xml): array
    {
        $xpath = $this->createXPath($xml);

        return [
            'id' => $this->requiredValue($xpath, '/UserConfirmed/id'),
            'email' => $this->requiredValue($xpath, '/UserConfirmed/email'),
            'firstName' => $this->requiredValue($xpath, '/UserConfirmed/firstName'),
            'lastName' => $this->requiredValue($xpath, '/UserConfirmed/lastName'),
            'phone' => $this->optionalValue($xpath, '/UserConfirmed/phone'),
            'role' => $this->requiredValue($xpath, '/UserConfirmed/role'),
            'companyId' => $this->optionalValue($xpath, '/UserConfirmed/companyId'),
            'badgeCode' => $this->optionalValue($xpath, '/UserConfirmed/badgeCode'),
            'isActive' => $this->requiredBool($xpath, '/UserConfirmed/isActive'),
            'gdprConsent' => $this->requiredBool($xpath, '/UserConfirmed/gdprConsent'),
            'confirmedAt' => $this->requiredValue($xpath, '/UserConfirmed/confirmedAt'),
        ];
    }

    private function parseUpdated(string $xml): array
    {
        $xpath = $this->createXPath($xml);

        return [
            'id' => $this->requiredValue($xpath, '/UserUpdated/id'),
            'email' => $this->requiredValue($xpath, '/UserUpdated/email'),
            'firstName' => $this->requiredValue($xpath, '/UserUpdated/firstName'),
            'lastName' => $this->requiredValue($xpath, '/UserUpdated/lastName'),
            'phone' => $this->optionalValue($xpath, '/UserUpdated/phone'),
            'role' => $this->requiredValue($xpath, '/UserUpdated/role'),
            'companyId' => $this->optionalValue($xpath, '/UserUpdated/companyId'),
            'badgeCode' => $this->optionalValue($xpath, '/UserUpdated/badgeCode'),
            'street' => $this->optionalValue($xpath, '/UserUpdated/street'),
            'houseNumber' => $this->optionalValue($xpath, '/UserUpdated/houseNumber'),
            'postalCode' => $this->optionalValue($xpath, '/UserUpdated/postalCode'),
            'city' => $this->optionalValue($xpath, '/UserUpdated/city'),
            'country' => $this->optionalValue($xpath, '/UserUpdated/country'),
            'isActive' => $this->requiredBool($xpath, '/UserUpdated/isActive'),
            'gdprConsent' => $this->requiredBool($xpath, '/UserUpdated/gdprConsent'),
            'updatedAt' => $this->requiredValue($xpath, '/UserUpdated/updatedAt'),
        ];
    }

    private function parseDeactivated(string $xml): array
    {
        $xpath = $this->createXPath($xml);

        return [
            'id' => $this->requiredValue($xpath, '/UserDeactivated/id'),
            'email' => $this->requiredValue($xpath, '/UserDeactivated/email'),
            'deactivatedAt' => $this->requiredValue($xpath, '/UserDeactivated/deactivatedAt'),
        ];
    }

    private function createXPath(string $xml): \DOMXPath
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $internalErrors = libxml_use_internal_errors(true);

        try {
            if (!$dom->loadXML($xml, LIBXML_NONET)) {
                throw new \InvalidArgumentException('Unable to parse incoming CRM XML payload.');
            }
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($internalErrors);
        }

        return new \DOMXPath($dom);
    }

    private function requiredValue(\DOMXPath $xpath, string $path): string
    {
        $value = trim((string) $xpath->evaluate(sprintf('string(%s)', $path)));
        if ($value === '') {
            throw new \InvalidArgumentException(sprintf('Missing required value at %s.', $path));
        }

        return $value;
    }

    private function optionalValue(\DOMXPath $xpath, string $path): ?string
    {
        $value = trim((string) $xpath->evaluate(sprintf('string(%s)', $path)));

        return $value === '' ? null : $value;
    }

    private function requiredBool(\DOMXPath $xpath, string $path): bool
    {
        $value = $this->requiredValue($xpath, $path);
        $normalized = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if ($normalized === null) {
            throw new \InvalidArgumentException(sprintf('Invalid boolean value at %s.', $path));
        }

        return $normalized;
    }

    private function generateStrongPassword(): string
    {
        return bin2hex(random_bytes(8)) . 'Aa1!';
    }

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

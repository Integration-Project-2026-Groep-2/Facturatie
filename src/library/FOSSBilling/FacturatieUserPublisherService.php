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

class FacturatieUserPublisherService
{
    public const ROUTING_KEY_CREATED = 'facturatie.user.created';
    public const ROUTING_KEY_UPDATED = 'facturatie.user.updated';
    public const ROUTING_KEY_DEACTIVATED = 'facturatie.user.deactivated';

    private const DEFAULT_ROLE = 'COMPANY_CONTACT';
    private const DEFAULT_EXCHANGE = 'user.topic';

    /** @var array<string, bool> */
    private const ALLOWED_ROLES = [
        'VISITOR' => true,
        'COMPANY_CONTACT' => true,
        'SPEAKER' => true,
        'EVENT_MANAGER' => true,
        'CASHIER' => true,
        'BAR_STAFF' => true,
        'ADMIN' => true,
    ];

    private ?RabbitMQService $rabbitMQService = null;
    private bool $topologyDeclared = false;

    public function __construct(private readonly Container $di, ?RabbitMQService $rabbitMQService = null)
    {
        $this->rabbitMQService = $rabbitMQService;
    }

    public function publishCreated(\Model_Client $client): void
    {
        $this->ensureTopology();

        $payload = $this->buildCreatedPayload($client);
        $xml = $this->buildCreatedXml($payload);

        $this->rabbit()->publishXML(self::ROUTING_KEY_CREATED, $xml);
    }

    public function publishUpdated(\Model_Client $client): bool
    {
        $this->ensureTopology();

        $crmUserId = $this->resolveCrmUserId($client);
        if ($crmUserId === null) {
            $this->logInfo(sprintf('[facturatie-user-publisher] Skip updated publish for client #%s: missing CRM UUID.', $client->id));

            return false;
        }

        $payload = $this->buildUpdatedPayload($client, $crmUserId);
        $xml = $this->buildUpdatedXml($payload);

        $this->rabbit()->publishXML(self::ROUTING_KEY_UPDATED, $xml);

        return true;
    }

    public function publishDeactivated(\Model_Client $client, ?\DateTimeInterface $deactivatedAt = null): bool
    {
        $this->ensureTopology();

        $crmUserId = $this->resolveCrmUserId($client);
        if ($crmUserId === null) {
            $this->logInfo(sprintf('[facturatie-user-publisher] Skip deactivated publish for client #%s: missing CRM UUID.', $client->id));

            return false;
        }

        $payload = [
            'id' => $crmUserId,
            'email' => strtolower((string) $client->email),
            'deactivatedAt' => ($deactivatedAt ?? new \DateTimeImmutable('now', new \DateTimeZone('UTC')))->format('Y-m-d\TH:i:sP'),
        ];

        $xml = $this->buildDeactivatedXml($payload);
        $this->rabbit()->publishXML(self::ROUTING_KEY_DEACTIVATED, $xml);

        return true;
    }

    private function buildCreatedPayload(\Model_Client $client): array
    {
        return [
            'facturatieCustomerId' => (string) $client->id,
            'registrationId' => $this->extractRegistrationId($client),
            'firstName' => (string) $client->first_name,
            'lastName' => (string) $client->last_name,
            'email' => strtolower((string) $client->email),
            'phone' => $this->nullableString($client->phone),
            'role' => $this->normalizeRole($client->custom_2 ?? null),
            'gdprConsent' => $this->boolFromCustomField($client->custom_4 ?? null),
            'companyId' => $this->normalizeUuid($client->company_id ?? null),
            'createdAt' => $this->toIso8601($client->created_at ?? null),
        ];
    }

    private function buildUpdatedPayload(\Model_Client $client, string $crmUserId): array
    {
        return [
            'id' => $crmUserId,
            'email' => strtolower((string) $client->email),
            'firstName' => (string) $client->first_name,
            'lastName' => (string) $client->last_name,
            'phone' => $this->nullableString($client->phone),
            'street' => $this->nullableString($client->address_1),
            'houseNumber' => $this->nullableString($client->address_2),
            'postalCode' => $this->nullableString($client->postcode),
            'city' => $this->nullableString($client->city),
            'country' => $this->normalizeCountryCode($client->country ?? null),
            'role' => $this->normalizeRole($client->custom_2 ?? null),
            'companyId' => $this->normalizeUuid($client->company_id ?? null),
            'isActive' => (string) $client->status === \Model_Client::ACTIVE,
            'gdprConsent' => $this->boolFromCustomField($client->custom_4 ?? null),
            'updatedAt' => $this->toIso8601($client->updated_at ?? null),
        ];
    }

    private function buildCreatedXml(array $payload): string
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $root = $dom->createElement('UserCreated');

        $this->appendRequiredElement($dom, $root, 'facturatieCustomerId', $payload['facturatieCustomerId']);
        $this->appendOptionalElement($dom, $root, 'registrationId', $payload['registrationId']);
        $this->appendRequiredElement($dom, $root, 'firstName', $payload['firstName']);
        $this->appendRequiredElement($dom, $root, 'lastName', $payload['lastName']);
        $this->appendRequiredElement($dom, $root, 'email', $payload['email']);
        $this->appendOptionalElement($dom, $root, 'phone', $payload['phone']);
        $this->appendRequiredElement($dom, $root, 'role', $payload['role']);
        $this->appendRequiredElement($dom, $root, 'gdprConsent', $this->boolToXml($payload['gdprConsent']));
        $this->appendOptionalElement($dom, $root, 'companyId', $payload['companyId']);
        $this->appendRequiredElement($dom, $root, 'createdAt', $payload['createdAt']);

        $dom->appendChild($root);

        return $dom->saveXML() ?: '';
    }

    private function buildUpdatedXml(array $payload): string
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $root = $dom->createElement('UserUpdated');

        $this->appendRequiredElement($dom, $root, 'id', $payload['id']);
        $this->appendRequiredElement($dom, $root, 'email', $payload['email']);
        $this->appendRequiredElement($dom, $root, 'firstName', $payload['firstName']);
        $this->appendRequiredElement($dom, $root, 'lastName', $payload['lastName']);
        $this->appendOptionalElement($dom, $root, 'phone', $payload['phone']);
        $this->appendOptionalElement($dom, $root, 'street', $payload['street']);
        $this->appendOptionalElement($dom, $root, 'houseNumber', $payload['houseNumber']);
        $this->appendOptionalElement($dom, $root, 'postalCode', $payload['postalCode']);
        $this->appendOptionalElement($dom, $root, 'city', $payload['city']);
        $this->appendOptionalElement($dom, $root, 'country', $payload['country']);
        $this->appendRequiredElement($dom, $root, 'role', $payload['role']);
        $this->appendOptionalElement($dom, $root, 'companyId', $payload['companyId']);
        $this->appendRequiredElement($dom, $root, 'isActive', $this->boolToXml($payload['isActive']));
        $this->appendRequiredElement($dom, $root, 'gdprConsent', $this->boolToXml($payload['gdprConsent']));
        $this->appendRequiredElement($dom, $root, 'updatedAt', $payload['updatedAt']);

        $dom->appendChild($root);

        return $dom->saveXML() ?: '';
    }

    private function buildDeactivatedXml(array $payload): string
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $root = $dom->createElement('UserDeactivated');

        $this->appendRequiredElement($dom, $root, 'id', $payload['id']);
        $this->appendRequiredElement($dom, $root, 'email', $payload['email']);
        $this->appendRequiredElement($dom, $root, 'deactivatedAt', $payload['deactivatedAt']);

        $dom->appendChild($root);

        return $dom->saveXML() ?: '';
    }

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

    private function extractRegistrationId(\Model_Client $client): ?string
    {
        $candidate = $this->nullableString($client->custom_1 ?? null);
        if ($candidate === null) {
            return null;
        }

        if ($this->isUuidV4($candidate)) {
            return null;
        }

        return $candidate;
    }

    private function resolveCrmUserId(\Model_Client $client): ?string
    {
        $candidateAid = $this->normalizeUuid($client->aid ?? null);
        if ($candidateAid !== null) {
            return $candidateAid;
        }

        return $this->normalizeUuid($client->custom_1 ?? null);
    }

    private function normalizeRole(?string $value): string
    {
        $normalized = strtoupper(trim((string) $value));
        if ($normalized === '' || !isset(self::ALLOWED_ROLES[$normalized])) {
            return self::DEFAULT_ROLE;
        }

        return $normalized;
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
            // Fall back to current UTC timestamp when source date is malformed.
        }

        return (new \DateTimeImmutable('now', new \DateTimeZone('UTC')))->format('Y-m-d\TH:i:sP');
    }

    private function boolFromCustomField(?string $value): bool
    {
        $normalized = filter_var(trim((string) $value), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        return $normalized ?? false;
    }

    private function normalizeUuid(?string $value): ?string
    {
        $normalized = strtolower(trim((string) $value));
        if ($normalized === '') {
            return null;
        }

        return $this->isUuidV4($normalized) ? $normalized : null;
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

    private function rabbit(): RabbitMQService
    {
        if ($this->rabbitMQService instanceof RabbitMQService) {
            return $this->rabbitMQService;
        }

        $this->rabbitMQService = new RabbitMQService([
            'exchange' => $this->userExchange(),
        ]);

        return $this->rabbitMQService;
    }

    private function ensureTopology(): void
    {
        if ($this->topologyDeclared) {
            return;
        }

        $exchange = $this->userExchange();
        $rabbit = $this->rabbit();

        $rabbit->declareExchange($exchange, 'topic', true);

        $this->topologyDeclared = true;
    }

    private function userExchange(): string
    {
        $value = trim((string) getenv('FACTURATIE_USER_EXCHANGE'));

        return $value !== '' ? $value : self::DEFAULT_EXCHANGE;
    }

    private function logInfo(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->info($message);

            return;
        }

        error_log($message);
    }
}

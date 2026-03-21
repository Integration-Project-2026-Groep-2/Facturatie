<?php

/**
 * Copyright 2022-2025 FOSSBilling
 * Copyright 2011-2021 BoxBilling, Inc.
 * SPDX-License-Identifier: Apache-2.0.
 *
 * @copyright FOSSBilling (https://www.fossbilling.org)
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

namespace Box\Mod\Company;

use FOSSBilling\InjectionAwareInterface;
use Ramsey\Uuid\Uuid;

class Service implements InjectionAwareInterface
{
    protected ?\Pimple\Container $di = null;

    public function setDi(\Pimple\Container $di): void
    {
        $this->di = $di;
    }

    public function getDi(): ?\Pimple\Container
    {
        return $this->di;
    }

    public function getSearchQuery(array $data = [], string $selectStmt = 'SELECT c.*'): array
    {
        $sql = $selectStmt . ' FROM company c';

        $search = $data['search'] ?? null;
        $name = $data['name'] ?? null;
        $vatNumber = $data['vat_number'] ?? null;

        $where = [];
        $params = [];

        if ($name) {
            $where[] = 'c.name LIKE :name';
            $params[':name'] = '%' . $name . '%';
        }

        if ($vatNumber) {
            $where[] = 'c.vat_number LIKE :vat_number';
            $params[':vat_number'] = '%' . $vatNumber . '%';
        }

        if ($search) {
            $where[] = 'c.name LIKE :search OR c.vat_number LIKE :search OR c.company_number LIKE :search OR c.email LIKE :search';
            $params[':search'] = '%' . $search . '%';
        }

        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        $sql .= ' ORDER BY c.name ASC';

        return [$sql, $params];
    }

    public function toApiArray(array $data): array
    {
        $data['linked_clients'] = (int) $this->di['db']->getCell('SELECT COUNT(*) FROM client WHERE company_id = :company_id', [
            ':company_id' => $data['id'],
        ]);

        return $data;
    }

    public function get(string $id): array
    {
        $row = $this->di['db']->getRow('SELECT * FROM company WHERE id = :id LIMIT 1', [':id' => $id]);
        if (!$row) {
            throw new \FOSSBilling\Exception('Company not found');
        }

        return $row;
    }

    public function getPairs(): array
    {
        return $this->di['db']->getAssoc('SELECT id, name FROM company ORDER BY name ASC');
    }

    public function create(array $data): string
    {
        $companyId = $this->generateCompanyId();
        $now = date('Y-m-d H:i:s');
        $payload = $this->buildPayload($data);

        $this->di['db']->exec(
            'INSERT INTO company (id, name, vat_number, company_number, email, phone, street, house_number, city, postal_code, country, created_at, updated_at) VALUES (:id, :name, :vat_number, :company_number, :email, :phone, :street, :house_number, :city, :postal_code, :country, :created_at, :updated_at)',
            [
                ':id' => $companyId,
                ':name' => $payload['name'],
                ':vat_number' => $payload['vat_number'],
                ':company_number' => $payload['company_number'],
                ':email' => $payload['email'],
                ':phone' => $payload['phone'],
                ':street' => $payload['street'],
                ':house_number' => $payload['house_number'],
                ':city' => $payload['city'],
                ':postal_code' => $payload['postal_code'],
                ':country' => $payload['country'],
                ':created_at' => $now,
                ':updated_at' => $now,
            ]
        );

        return $companyId;
    }

    public function update(array $company, array $data): bool
    {
        $payload = $this->buildPayload($data, $company);

        $this->di['db']->exec(
            'UPDATE company SET name = :name, vat_number = :vat_number, company_number = :company_number, email = :email, phone = :phone, street = :street, house_number = :house_number, city = :city, postal_code = :postal_code, country = :country, updated_at = :updated_at WHERE id = :id',
            [
                ':id' => $company['id'],
                ':name' => $payload['name'],
                ':vat_number' => $payload['vat_number'],
                ':company_number' => $payload['company_number'],
                ':email' => $payload['email'],
                ':phone' => $payload['phone'],
                ':street' => $payload['street'],
                ':house_number' => $payload['house_number'],
                ':city' => $payload['city'],
                ':postal_code' => $payload['postal_code'],
                ':country' => $payload['country'],
                ':updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        return true;
    }

    public function delete(array $company): bool
    {
        $this->di['db']->exec('UPDATE client SET company_id = NULL WHERE company_id = :company_id', [
            ':company_id' => $company['id'],
        ]);
        $this->di['db']->exec('DELETE FROM company WHERE id = :id', [':id' => $company['id']]);

        return true;
    }

    private function buildPayload(array $data, array $existing = []): array
    {
        return [
            'name' => trim((string) ($data['name'] ?? $existing['name'] ?? '')),
            'vat_number' => $this->nullable($data['vat_number'] ?? $existing['vat_number'] ?? null),
            'company_number' => $this->nullable($data['company_number'] ?? $existing['company_number'] ?? null),
            'email' => $this->nullable($data['email'] ?? $existing['email'] ?? null),
            'phone' => $this->nullable($data['phone'] ?? $existing['phone'] ?? null),
            'street' => $this->nullable($data['street'] ?? $existing['street'] ?? null),
            'house_number' => $this->nullable($data['house_number'] ?? $existing['house_number'] ?? null),
            'city' => $this->nullable($data['city'] ?? $existing['city'] ?? null),
            'postal_code' => $this->nullable($data['postal_code'] ?? $existing['postal_code'] ?? null),
            'country' => $this->nullable($data['country'] ?? $existing['country'] ?? null),
        ];
    }

    private function nullable($value): ?string
    {
        $trimmed = trim((string) ($value ?? ''));

        return $trimmed === '' ? null : $trimmed;
    }

    private function generateCompanyId(): string
    {
        if (class_exists(Uuid::class)) {
            return Uuid::uuid4()->toString();
        }

        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0x0fff) | 0x4000,
            random_int(0, 0x3fff) | 0x8000,
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff)
        );
    }
}

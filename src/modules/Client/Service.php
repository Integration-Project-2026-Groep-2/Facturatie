<?php

/**
 * Copyright 2022-2025 FOSSBilling
 * Copyright 2011-2021 BoxBilling, Inc.
 * SPDX-License-Identifier: Apache-2.0.
 *
 * @copyright FOSSBilling (https://www.fossbilling.org)
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

namespace Box\Mod\Client;

use FOSSBilling\FacturatieUserPublisherService;
use FOSSBilling\InjectionAwareInterface;
use Ramsey\Uuid\Uuid;

class Service implements InjectionAwareInterface
{
    protected ?\Pimple\Container $di = null;

    /** @var array<int, string> */
    private static array $clientStatusBeforeUpdate = [];

    public function setDi(\Pimple\Container $di): void
    {
        $this->di = $di;
    }

    public function getDi(): ?\Pimple\Container
    {
        return $this->di;
    }

    public function approveClientEmailByHash($hash)
    {
        $db = $this->di['db'];
        $result = $db->getRow('SELECT id, client_id FROM extension_meta WHERE extension = "mod_client" AND meta_key = "confirm_email" AND meta_value = :hash', [':hash' => $hash]);
        if (!$result) {
            throw new \FOSSBilling\InformationException('Invalid email confirmation link');
        }
        $db->exec('UPDATE client SET email_approved = 1 WHERE id = :id', ['id' => $result['client_id']]);
        $db->exec('DELETE FROM extension_meta WHERE id = :id', ['id' => $result['id']]);

        return true;
    }

    public function generateEmailConfirmationLink($client_id)
    {
        $hash = strtolower($this->di['tools']->generatePassword(50));
        $db = $this->di['db'];

        $meta = $db->dispense('ExtensionMeta');
        $meta->extension = 'mod_client';
        $meta->client_id = $client_id;
        $meta->meta_key = 'confirm_email';
        $meta->meta_value = $hash;
        $meta->created_at = date('Y-m-d H:i:s');
        $meta->updated_at = date('Y-m-d H:i:s');
        $db->store($meta);

        return $this->di['tools']->url('/client/confirm-email/' . $hash);
    }

    public static function onAfterClientSignUp(\Box_Event $event)
    {
        $di = $event->getDi();
        $params = $event->getParameters();
        $config = $di['mod_config']('client');
        $emailService = $di['mod_service']('email');

        try {
            $email = [];
            $email['to_client'] = $params['id'];
            $email['code'] = 'mod_client_signup';
            $email['password'] = __trans('The password you chose when creating your account.');
            $email['require_email_confirmation'] = false;
            if (isset($config['require_email_confirmation']) && $config['require_email_confirmation']) {
                $clientService = $di['mod_service']('client');
                $email['require_email_confirmation'] = true;
                $email['email_confirmation_link'] = $clientService->generateEmailConfirmationLink($params['id']);
            }

            $emailService->sendTemplate($email);
        } catch (\Exception $exc) {
            error_log($exc->getMessage());
        }

        return true;
    }

    public static function onAfterAdminCreateClient(\Box_Event $event)
    {
        $di = $event->getDi();
        $params = $event->getParameters();
        $clientId = isset($params['id']) ? (int) $params['id'] : 0;

        if ($clientId < 1) {
            return true;
        }

        try {
            $client = $di['db']->getExistingModelById('Client', $clientId, 'Client not found for outbound user.created sync');
            $publisher = new FacturatieUserPublisherService($di);
            $publisher->publishCreated($client);
        } catch (\Throwable $exception) {
            self::logUserSyncFailure($di, 'created', $clientId, $exception);
        }

        return true;
    }

    public static function onBeforeAdminClientUpdate(\Box_Event $event)
    {
        $di = $event->getDi();
        $params = $event->getParameters();
        $clientId = isset($params['id']) ? (int) $params['id'] : 0;

        if ($clientId < 1) {
            return true;
        }

        try {
            $client = $di['db']->findOne('Client', 'id = ?', [$clientId]);
            if ($client instanceof \Model_Client) {
                self::$clientStatusBeforeUpdate[$clientId] = (string) $client->status;
            }
        } catch (\Throwable $exception) {
            self::logUserSyncFailure($di, 'before-update-status-capture', $clientId, $exception);
        }

        return true;
    }

    public static function onAfterAdminClientUpdate(\Box_Event $event)
    {
        $di = $event->getDi();
        $params = $event->getParameters();
        $clientId = isset($params['id']) ? (int) $params['id'] : 0;

        if ($clientId < 1) {
            return true;
        }

        $previousStatus = self::$clientStatusBeforeUpdate[$clientId] ?? null;
        unset(self::$clientStatusBeforeUpdate[$clientId]);

        try {
            $client = $di['db']->getExistingModelById('Client', $clientId, 'Client not found for outbound user.updated sync');
            $publisher = new FacturatieUserPublisherService($di);

            $isNowDeactivated = in_array((string) $client->status, [\Model_Client::SUSPENDED, \Model_Client::CANCELED], true);
            $wasDeactivated = $previousStatus !== null && in_array($previousStatus, [\Model_Client::SUSPENDED, \Model_Client::CANCELED], true);

            if ($isNowDeactivated && !$wasDeactivated) {
                $publisher->publishDeactivated($client);

                return true;
            }

            $publisher->publishUpdated($client);
        } catch (\Throwable $exception) {
            self::logUserSyncFailure($di, 'updated', $clientId, $exception);
        }

        return true;
    }

    public static function onBeforeAdminClientDelete(\Box_Event $event)
    {
        $di = $event->getDi();
        $params = $event->getParameters();
        $clientId = isset($params['id']) ? (int) $params['id'] : 0;

        if ($clientId < 1) {
            return true;
        }

        try {
            $client = $di['db']->getExistingModelById('Client', $clientId, 'Client not found for outbound user.deactivated sync');
            $publisher = new FacturatieUserPublisherService($di);
            $publisher->publishDeactivated($client);
        } catch (\Throwable $exception) {
            self::logUserSyncFailure($di, 'deactivated', $clientId, $exception);
        }

        return true;
    }

    public function getSearchQuery($data, $selectStmt = 'SELECT c.*'): array
    {
        $sql = $selectStmt;
        $sql .= ' FROM client as c left join client_group as cg on c.client_group_id = cg.id';

        $search = (isset($data['search']) && !empty($data['search'])) ? $data['search'] : null;
        $client_id = (isset($data['client_id']) && !empty($data['client_id'])) ? $data['client_id'] : null;
        $group_id = (isset($data['group_id']) && !empty($data['group_id'])) ? $data['group_id'] : null;
        $id = (isset($data['id']) && !empty($data['id'])) ? $data['id'] : null;
        $status = (isset($data['status']) && !empty($data['status'])) ? $data['status'] : null;
        $name = (isset($data['name']) && !empty($data['name'])) ? $data['name'] : null;
        $company = (isset($data['company']) && !empty($data['company'])) ? $data['company'] : null;
        $email = (isset($data['email']) && !empty($data['email'])) ? $data['email'] : null;
        $created_at = (isset($data['created_at']) && !empty($data['created_at'])) ? $data['created_at'] : null;
        $date_from = (isset($data['date_from']) && !empty($data['date_from'])) ? $data['date_from'] : null;
        $date_to = (isset($data['date_to']) && !empty($data['date_to'])) ? $data['date_to'] : null;

        $where = [];
        $params = [];
        if ($id) {
            $where[] = 'c.id = :client_id or c.aid = :alt_client_id';
            $params[':client_id'] = $id;
            $params[':alt_client_id'] = $id;
        }

        if ($name) {
            $where[] = '(c.first_name LIKE :first_name or c.last_name LIKE :last_name )';
            $name = '%' . $name . '%';
            $params[':first_name'] = $name;
            $params[':last_name'] = $name;
        }

        if ($email) {
            $where[] = 'c.email LIKE :email';
            $params[':email'] = '%' . $email . '%';
        }

        if ($company) {
            $where[] = 'c.company LIKE :company';
            $params[':company'] = '%' . $company . '%';
        }

        if ($status) {
            $where[] = 'c.status = :status';
            $params[':status'] = $status;
        }

        if ($group_id) {
            $where[] = 'c.client_group_id = :group_id';
            $params[':group_id'] = $group_id;
        }

        if ($created_at) {
            $where[] = "DATE_FORMAT(c.created_at, '%Y-%m-%d') = :created_at";
            $params[':created_at'] = date('Y-m-d', strtotime($created_at));
        }

        if ($date_from) {
            $where[] = 'UNIX_TIMESTAMP(c.created_at) >= :date_from';
            $params[':date_from'] = strtotime($date_from);
        }

        if ($date_to) {
            $where[] = 'UNIX_TIMESTAMP(c.created_at) <= :date_from';
            $params[':date_to'] = strtotime($date_to);
        }

        // smartSearch
        if ($search) {
            if (is_numeric($search)) {
                $where[] = 'c.id = :cid or c.aid = :caid';
                $params[':cid'] = $search;
                $params[':caid'] = $search;
            } else {
                $where[] = "c.company LIKE :s_company OR c.first_name LIKE :s_first_time OR c.last_name LIKE :s_last_name OR c.email LIKE :s_email OR CONCAT(c.first_name,  ' ', c.last_name ) LIKE  :full_name";
                $search = '%' . $search . '%';
                $params[':s_company'] = $search;
                $params[':s_first_time'] = $search;
                $params[':s_last_name'] = $search;
                $params[':s_email'] = $search;
                $params[':full_name'] = $search;
            }
        }

        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $sql .= ' ORDER BY c.created_at desc';

        return [$sql, $params];
    }

    public function getPairs($data)
    {
        $limit = $data['per_page'] ?? 30;
        if (!is_numeric($limit) || $limit < 1) {
            throw new \FOSSBilling\InformationException('Invalid per page number');
        }

        [$sql, $params] = $this->getSearchQuery($data, "SELECT c.id, IF(c.company <> '', CONCAT_WS(' ', c.first_name, c.last_name, ' (', c.company, ')'), CONCAT_WS(' ', c.first_name, c.last_name)) as client");
        $sql .= sprintf(' LIMIT %u', $limit);

        return $this->di['db']->getAssoc($sql, $params);
    }

    public function toSessionArray(\Model_Client $model)
    {
        return [
            'id' => $model->id,
            'email' => $model->email,
            'name' => $model->getFullName(),
            'role' => $model->role,
        ];
    }

    public function emailAlreadyRegistered($new_email, ?\Model_Client $model = null)
    {
        if ($model instanceof \Model_Client && $model->email == $new_email) {
            return false;
        }

        $result = $this->di['db']->findOne('Client', 'email = ?', [$new_email]);

        return ($result) ? true : false;
    }

    public function canChangeCurrency(\Model_Client $model, $currency = null)
    {
        if (!$model->currency) {
            return true;
        }

        if ($model->currency == $currency) {
            return false;
        }

        $invoice = $this->di['db']->findOne('Invoice', 'client_id = :client_id', [':client_id' => $model->id]);
        if ($invoice instanceof \Model_Invoice) {
            throw new \FOSSBilling\InformationException('Currency cannot be changed. Client already has invoices issued.');
        }

        $order = $this->di['db']->findOne('ClientOrder', 'client_id = :client_id', [':client_id' => $model->id]);
        if ($order instanceof \Model_ClientOrder) {
            throw new \FOSSBilling\InformationException('Currency cannot be changed. Client already has orders.');
        }

        return true;
    }

    public function addFunds(\Model_Client $client, $amount, $description, array $data = [])
    {
        if (!$client->currency) {
            throw new \FOSSBilling\InformationException('You must define the client\'s currency before adding funds.');
        }

        if (!is_numeric($amount)) {
            throw new \FOSSBilling\InformationException('Funds amount is invalid');
        }

        if (empty($description)) {
            throw new \FOSSBilling\InformationException('Funds description is invalid');
        }

        $credit = $this->di['db']->dispense('ClientBalance');

        $credit->client_id = $client->id;
        $credit->type = $data['type'] ?? 'gift';
        $credit->rel_id = $data['rel_id'] ?? null;
        $credit->description = $description;
        $credit->amount = $amount;
        $credit->created_at = date('Y-m-d H:i:s');
        $credit->updated_at = date('Y-m-d H:i:s');

        $this->di['db']->store($credit);

        return true;
    }

    public function getExpiredPasswordReminders()
    {
        $expire_after_hours = 2;

        return $this->di['db']->find('ClientPasswordReset', 'UNIX_TIMESTAMP() - ? > UNIX_TIMESTAMP(created_at)', [$expire_after_hours * 60 * 60]);
    }

    public function getHistorySearchQuery($data)
    {
        $q = 'SELECT ach.*, c.first_name, c.last_name, c.email
              FROM activity_client_history as ach
                LEFT JOIN client as c on ach.client_id = c.id ';

        $search = $data['search'] ?? null;
        $client_id = $data['client_id'] ?? null;

        $where = [];
        $params = [];
        if ($search) {
            $where[] = 'c.first_name LIKE :first_name OR c.last_name LIKE :last_name OR c.id LIKE :id';
            $params[':first_name'] = '%' . $search . '%';
            $params[':last_name'] = '%' . $search . '%';
            $params[':id'] = $search;
        }

        if ($client_id) {
            $where[] = 'ach.client_id = :client_id';
            $params[':client_id'] = $client_id;
        }

        if (!empty($where)) {
            $q .= ' WHERE ' . implode(' AND ', $where);
        }

        $q .= ' ORDER BY ach.id desc';

        return [$q, $params];
    }

    public function counter()
    {
        $sql = 'SELECT status, COUNT(id) as counter
                FROM client
                group by status';
        $data = $this->di['db']->getAssoc($sql);

        return [
            'total' => array_sum($data),
            \Model_Client::ACTIVE => $data[\Model_Client::ACTIVE] ?? 0,
            \Model_Client::SUSPENDED => $data[\Model_Client::SUSPENDED] ?? 0,
            \Model_Client::CANCELED => $data[\Model_Client::CANCELED] ?? 0,
        ];
    }

    public function getGroupPairs()
    {
        $sql = 'SELECT id, title
                FROM client_group';

        return $this->di['db']->getAssoc($sql);
    }

    public function getCompanyPairs(): array
    {
        try {
            return $this->di['db']->getAssoc('SELECT id, name FROM company ORDER BY name ASC');
        } catch (\Exception) {
            return [];
        }
    }

    public function getCompanyById(string $companyId): ?array
    {
        $row = $this->di['db']->getRow('SELECT * FROM company WHERE id = :id LIMIT 1', [':id' => $companyId]);

        return $row ?: null;
    }

    public function syncClientCompany(\Model_Client $client, array $data = []): void
    {
        if (!$this->shouldSyncClientCompany($data)) {
            return;
        }

        try {
            $companyData = $this->buildCompanyData($data, $client);
            $requestedCompanyId = trim((string) ($data['company_id'] ?? ''));

            if ($requestedCompanyId !== '') {
                $company = $this->getCompanyById($requestedCompanyId);
                if (!$company) {
                    throw new \FOSSBilling\Exception('Selected company was not found');
                }

                if ($this->hasExplicitCompanyPayload($data) && $this->hasCompanyIdentity($companyData)) {
                    $company = $this->upsertCompany($requestedCompanyId, $companyData);
                }
                $this->applyCompanyToClient($client, $company);

                return;
            }

            if (!$this->hasCompanyIdentity($companyData)) {
                if (array_key_exists('company_id', $data)) {
                    $client->company_id = null;
                    $client->company = null;
                    $client->company_vat = null;
                    $client->company_number = null;
                }

                return;
            }

            $existingCompanyId = !empty($client->company_id) ? (string) $client->company_id : null;
            $companyId = $this->findExistingCompanyId($companyData, $existingCompanyId);
            $company = $this->upsertCompany($companyId ?? $this->generateCompanyId(), $companyData);
            $this->applyCompanyToClient($client, $company);
        } catch (\Exception) {
            // Keep legacy behavior in case company migration is not yet applied.
            if (array_key_exists('company', $data)) {
                $client->company = $data['company'] ?: null;
            }
            if (array_key_exists('company_vat', $data)) {
                $client->company_vat = $data['company_vat'] ?: null;
            }
            if (array_key_exists('company_number', $data)) {
                $client->company_number = $data['company_number'] ?: null;
            }
        }
    }

    public function clientAlreadyExists($email)
    {
        $client = $this->di['db']->findOne('Client', 'email = :email ', [':email' => $email]);

        return $client instanceof \Model_Client;
    }

    public function getByLoginDetails($email, $password)
    {
        return $this->di['db']->findOne('Client', 'email = ? and pass = ? and status = ?', [$email, $password, \Model_Client::ACTIVE]);
    }

    public function toApiArray(\Model_Client $model, $deep = false, $identity = null): array
    {
        $details = [
            'id' => $model->id,
            'aid' => $model->aid,
            'email' => $model->email,
            'email_approved' => $model->email_approved,
            'type' => $model->type,
            'group_id' => $model->client_group_id,
            'company_id' => $model->company_id,
            'company' => $model->company,
            'company_vat' => $model->company_vat,
            'company_number' => $model->company_number,
            'company_email' => null,
            'company_phone' => null,
            'company_street' => null,
            'company_house_number' => null,
            'company_postal_code' => null,
            'first_name' => $model->first_name,
            'last_name' => $model->last_name,
            'gender' => $model->gender,
            'birthday' => $model->birthday,
            'phone_cc' => $model->phone_cc,
            'phone' => $model->phone,
            'address_1' => $model->address_1,
            'address_2' => $model->address_2,
            'city' => $model->city,
            'state' => $model->state,
            'postcode' => $model->postcode,
            'country' => $model->country,
            'currency' => $model->currency,
            'notes' => $model->notes,
            'created_at' => $model->created_at,
            'document_nr' => $model->document_nr,
            'linked_company' => null,
        ];

        if (!empty($model->company_id)) {
            $company = $this->getCompanyById((string) $model->company_id);
            if (is_array($company)) {
                $details['linked_company'] = $company;
                $details['company'] = $company['name'];
                $details['company_vat'] = $company['vat_number'];
                $details['company_number'] = $company['company_number'];
                $details['company_email'] = $company['email'];
                $details['company_phone'] = $company['phone'];
                $details['company_street'] = $company['street'];
                $details['company_house_number'] = $company['house_number'];
                $details['company_postal_code'] = $company['postal_code'];
            }
        }

        // Keep legacy flat fields for compatibility, but expose explicit separation for messaging contracts.
        $details['user'] = $this->toUserApiArray($model);
        $details['company_entity'] = $this->toCompanyApiArray($model);

        if ($deep) {
            $details['balance'] = $this->getClientBalance($model);
        }

        $m = $this->di['db']->toArray($model);
        for ($i = 1; $i < 11; ++$i) {
            $k = 'custom_' . $i;
            if (isset($m[$k]) && !empty($m[$k])) {
                $details[$k] = $m[$k];
            }
        }

        $clientGroup = $this->di['db']->load('ClientGroup', $model->client_group_id);

        if ($identity instanceof \Model_Admin) {
            $details['auth_type'] = $model->auth_type;
            $details['api_token'] = $model->api_token;
            $details['ip'] = $model->ip;
            $details['status'] = $model->status;
            $details['tax_exempt'] = $model->tax_exempt;
            $details['group'] = ($clientGroup) ? $clientGroup->title : null;
            $details['updated_at'] = $model->updated_at;
            $details['email_approved'] = $model->email_approved;
        }

        return $details;
    }

    public function toUserApiArray(\Model_Client $model): array
    {
        return [
            'id' => $model->id,
            'aid' => $model->aid,
            'email' => $model->email,
            'email_approved' => $model->email_approved,
            'type' => $model->type,
            'group_id' => $model->client_group_id,
            'first_name' => $model->first_name,
            'last_name' => $model->last_name,
            'gender' => $model->gender,
            'birthday' => $model->birthday,
            'phone_cc' => $model->phone_cc,
            'phone' => $model->phone,
            'address_1' => $model->address_1,
            'address_2' => $model->address_2,
            'city' => $model->city,
            'state' => $model->state,
            'postcode' => $model->postcode,
            'country' => $model->country,
            'currency' => $model->currency,
            'company_id' => $model->company_id,
            'created_at' => $model->created_at,
        ];
    }

    public function toCompanyApiArray(\Model_Client $model): ?array
    {
        if (empty($model->company_id)) {
            return null;
        }

        return $this->getCompanyById((string) $model->company_id);
    }

    public function toMessagingApiArray(\Model_Client $model): array
    {
        return [
            'user' => $this->toUserApiArray($model),
            'company' => $this->toCompanyApiArray($model),
        ];
    }

    public function getClientBalance(\Model_Client $c)
    {
        $sql = 'SELECT SUM(amount) as client_total
                FROM client_balance
                WHERE client_id = ?
                GROUP BY client_id';

        return $this->di['db']->getCell($sql, [$c->id]);
    }

    public function get($data)
    {
        if (!isset($data['id']) && !isset($data['email'])) {
            throw new \FOSSBilling\InformationException('Client ID or email is required');
        }

        $db = $this->di['db'];
        $client = null;
        if (isset($data['id'])) {
            $client = $db->findOne('Client', 'id = ?', [$data['id']]);
        }

        if (!$client && isset($data['email'])) {
            $client = $db->findOne('Client', 'email = ?', [$data['email']]);
        }

        if (!$client instanceof \Model_Client) {
            throw new \FOSSBilling\Exception('Client not found');
        }

        return $client;
    }

    public function isClientTaxable(\Model_Client $model)
    {
        $systemService = $this->di['mod_service']('system');

        if (!$systemService->getParamValue('tax_enabled', false)) {
            return false;
        }

        if ($model->tax_exempt) {
            return false;
        }

        return true;
    }

    public function createGroup(array $data)
    {
        $systemService = $this->di['mod_service']('system');
        $systemService->checkLimits('Model_ClientGroup', 2);

        $model = $this->di['db']->dispense('ClientGroup');

        $model->title = $data['title'];
        $model->updated_at = date('Y-m-d H:i:s');
        $model->created_at = date('Y-m-d H:i:s');

        $group_id = $this->di['db']->store($model);

        $this->di['logger']->info('Created new client group #%s', $model->id);

        return $group_id;
    }

    public function deleteGroup(\Model_ClientGroup $model)
    {
        $client = $this->di['db']->findOne('Client', 'client_group_id = ?', [$model->id]);
        if ($client) {
            throw new \FOSSBilling\Exception('Cannot remove groups with clients');
        }

        $this->di['db']->trash($model);
        $this->di['logger']->info('Removed client group #%s', $model->id);

        return true;
    }

    private function createClient(array $data)
    {
        $password = $data['password'] ?? uniqid();

        $client = $this->di['db']->dispense('Client');

        $client->auth_type = $data['auth_type'] ?? null;
        $client->email = strtolower(trim($data['email'] ?? null));
        $client->first_name = ucwords($data['first_name'] ?? null);
        $client->pass = $this->di['password']->hashIt($password);

        $phoneCC = $data['phone_cc'] ?? $client->phone_cc;
        if (!empty($phoneCC)) {
            $client->phone_cc = intval($phoneCC);
        }

        $client->aid = $data['aid'] ?? null;
        $client->last_name = $data['last_name'] ?? null;
        $client->client_group_id = !empty($data['group_id']) ? $data['group_id'] : null;
        $client->status = $data['status'] ?? null;
        $client->gender = $data['gender'] ?? null;
        $client->birthday = $data['birthday'] ?? null;
        $client->phone = $data['phone'] ?? null;
        $client->company_id = $data['company_id'] ?? null;
        $client->company = $data['company'] ?? null;
        $client->company_vat = $data['company_vat'] ?? null;
        $client->company_number = $data['company_number'] ?? null;
        $client->type = $data['type'] ?? null;
        $client->address_1 = $data['address_1'] ?? null;
        $client->address_2 = $data['address_2'] ?? null;
        $client->city = $data['city'] ?? null;
        $client->state = $data['state'] ?? null;
        $client->postcode = $data['postcode'] ?? null;
        $client->country = $data['country'] ?? null;
        $client->document_type = $data['document_type'] ?? null;
        $client->document_nr = $data['document_nr'] ?? null;
        $client->notes = $data['notes'] ?? null;
        $client->lang = $data['lang'] ?? null;
        $client->currency = $data['currency'] ?? null;

        $client->custom_1 = $data['custom_1'] ?? null;
        $client->custom_2 = $data['custom_2'] ?? null;
        $client->custom_3 = $data['custom_3'] ?? null;
        $client->custom_4 = $data['custom_4'] ?? null;
        $client->custom_5 = $data['custom_5'] ?? null;
        $client->custom_6 = $data['custom_6'] ?? null;
        $client->custom_7 = $data['custom_7'] ?? null;
        $client->custom_8 = $data['custom_8'] ?? null;
        $client->custom_9 = $data['custom_9'] ?? null;
        $client->custom_10 = $data['custom_10'] ?? null;

        $client->ip = $data['ip'] ?? null;

        $created_at = $data['created_at'] ?? null;
        $client->created_at = !empty($created_at) ? date('Y-m-d H:i:s', strtotime($created_at)) : date('Y-m-d H:i:s');
        $client->updated_at = date('Y-m-d H:i:s');

        $this->syncClientCompany($client, $data);
        $this->di['db']->store($client);

        return $client;
    }

    public function adminCreateClient(array $data)
    {
        $this->di['events_manager']->fire(['event' => 'onBeforeAdminCreateClient', 'params' => $data]);
        $client = $this->createClient($data);
        $this->di['events_manager']->fire(['event' => 'onAfterAdminCreateClient', 'params' => ['id' => $client->id, 'password' => $data['password']]]);
        $this->di['logger']->info('Created new client #%s', $client->id);

        return $client->id;
    }

    public function guestCreateClient(array $data)
    {
        $event_params = $data;
        $event_params['ip'] = $this->di['request']->getClientIp();
        $this->di['events_manager']->fire(['event' => 'onBeforeClientSignUp', 'params' => $event_params]);

        $data['ip'] = $this->di['request']->getClientIp();
        $data['status'] = \Model_Client::ACTIVE;
        $client = $this->createClient($data);

        $this->di['events_manager']->fire(['event' => 'onAfterClientSignUp', 'params' => ['id' => $client->id, 'password' => $data['password']]]);
        $this->di['logger']->info('Client #%s signed up', $client->id);

        return $client;
    }

    public function remove(\Model_Client $model)
    {
        $service = $this->di['mod_service']('Order');
        $service->rmByClient($model);
        $service = $this->di['mod_service']('Invoice');
        $service->rmByClient($model);
        $service = $this->di['mod_service']('Support');
        $service->rmByClient($model);
        $service = $this->di['mod_service']('Client', 'Balance');
        $service->rmByClient($model);

        $table = $this->di['table']('ActivityClientHistory');
        $table->rmByClient($model);

        $service->rmByClient($model);
        $service = $this->di['mod_service']('Email');
        $service->rmByClient($model);
        $service = $this->di['mod_service']('Activity');
        $service->rmByClient($model);

        $table = $this->di['table']('ClientPasswordReset');
        $table->rmByClient($model);

        $pdo = $this->di['pdo'];
        $stmt = $pdo->prepare('DELETE FROM extension_meta WHERE client_id = :id');
        $stmt->execute(['id' => $model->id]);

        $this->di['db']->trash($model);
    }

    public function authorizeClient($email, $plainTextPassword)
    {
        $model = $this->di['db']->findOne('Client', 'email = ? AND status = ?', [$email, \Model_Client::ACTIVE]);

        return $this->di['auth']->authorizeUser($model, $plainTextPassword);
    }

    public function sendEmailConfirmationForClient(\Model_Client $client)
    {
        try {
            $email = [];
            $email['to_client'] = $client->id;
            $email['code'] = 'mod_client_confirm';
            $email['require_email_confirmation'] = true;
            $email['email_confirmation_link'] = $this->generateEmailConfirmationLink($client->id);
            $email['send_now'] = true;

            $emailService = $this->di['mod_service']('email');
            $emailService->sendTemplate($email);
        } catch (\Exception $exc) {
            error_log($exc->getMessage());
        }
    }

    public function canChangeEmail(\Model_Client $client, $email)
    {
        $config = $this->di['mod_config']('client');

        if (
            $client->email != $email
            && isset($config['disable_change_email'])
            && $config['disable_change_email']
        ) {
            throw new \FOSSBilling\InformationException('Email address cannot be changed');
        }

        return true;
    }

    public function checkExtraRequiredFields(array $checkArr)
    {
        $config = $this->di['mod_config']('client');
        $required = $config['required'] ?? [];
        foreach ($required as $field) {
            if (!isset($checkArr[$field]) || empty($checkArr[$field])) {
                $name = ucwords(str_replace('_', ' ', $field));

                throw new \FOSSBilling\InformationException('Field :field cannot be empty', [':field' => $name]);
            }
        }
    }

    public function checkCustomFields(array $checkArr)
    {
        $config = $this->di['mod_config']('client');
        $customFields = $config['custom_fields'] ?? [];
        foreach ($customFields as $cFieldName => $cField) {
            $active = isset($cField['active']) && $cField['active'] ? true : false;
            $required = isset($cField['required']) && $cField['required'] ? true : false;
            if ($active && $required) {
                if (!isset($checkArr[$cFieldName]) || empty($checkArr[$cFieldName])) {
                    $name = isset($cField['title']) && !empty($cField['title']) ? $cField['title'] : ucwords(str_replace('_', ' ', $cFieldName));

                    throw new \FOSSBilling\InformationException('Field :field cannot be empty', [':field' => $name]);
                }
            }
        }
    }

    public function exportCSV(array $headers)
    {
        if ($headers) {
            // Prevent the password / salt columns from being exported
            if (isset($headers['pass'])) {
                unset($headers['pass']);
            }
            if (isset($headers['salt'])) {
                unset($headers['salt']);
            }
        } else {
            $headers = ['id', 'email', 'status', 'first_name', 'last_name', 'phone_cc', 'phone', 'company', 'company_vat', 'company_number', 'address_1', 'address_2', 'city', 'state', 'postcode', 'country', 'currency'];
        }

        return $this->di['table_export_csv']('client', 'clients.csv', $headers);
    }

    /**
     * Confirm password reset action.
     *
     * @return bool|int
     *
     * @throws \FOSSBilling\InformationException
     */
    public function password_reset_valid($data)
    {
        $required = [
            'hash' => 'Hash required',
        ];
        $this->di['events_manager']->fire(['event' => 'onBeforePasswordResetClient']);
        $this->di['validator']->checkRequiredParamsForArray($required, $data);

        $reset = $this->di['db']->findOne('ClientPasswordReset', 'hash = ?', [$data['hash']]);
        if (!$reset instanceof \Model_ClientPasswordReset) {
            throw new \FOSSBilling\InformationException('The link has expired or you have already reset your password.');
        }

        $c = $this->di['db']->findOne('Client', 'id = ?', [$reset->client_id]);
        // Return the client ID if the reset request is valid (from within the last 15 minutes), otherwise return false
        if (strtotime($reset->created_at) - time() + 900 < 0) {
            return false;
        } else {
            return $c->id;
        }
    }

    private function shouldSyncClientCompany(array $data): bool
    {
        return array_key_exists('company_id', $data)
            || array_key_exists('company', $data)
            || array_key_exists('company_vat', $data)
            || array_key_exists('company_number', $data)
            || array_key_exists('company_email', $data)
            || array_key_exists('company_phone', $data)
            || array_key_exists('street', $data)
            || array_key_exists('house_number', $data)
            || array_key_exists('postal_code', $data);
    }

    private function buildCompanyData(array $data, \Model_Client $client): array
    {
        $existingCompany = null;
        if (!empty($client->company_id)) {
            $existingCompany = $this->getCompanyById((string) $client->company_id);
        }

        $defaultPhone = trim((string) (($client->phone_cc ?? '') . ' ' . ($client->phone ?? '')));

        return [
            'name' => trim((string) ($data['company'] ?? $client->company ?? '')),
            'vat_number' => trim((string) ($data['company_vat'] ?? $client->company_vat ?? '')),
            'company_number' => trim((string) ($data['company_number'] ?? $client->company_number ?? '')),
            'email' => trim((string) ($data['company_email'] ?? ($existingCompany['email'] ?? $client->email ?? ''))),
            'phone' => trim((string) ($data['company_phone'] ?? ($existingCompany['phone'] ?? $defaultPhone))),
            'street' => trim((string) ($data['street'] ?? ($existingCompany['street'] ?? $client->address_1 ?? ''))),
            'house_number' => trim((string) ($data['house_number'] ?? ($existingCompany['house_number'] ?? $client->address_2 ?? ''))),
            'city' => trim((string) ($data['city'] ?? $client->city ?? '')),
            'postal_code' => trim((string) ($data['postal_code'] ?? ($existingCompany['postal_code'] ?? $client->postcode ?? ''))),
            'country' => trim((string) ($data['country'] ?? $client->country ?? '')),
        ];
    }

    private function hasCompanyIdentity(array $companyData): bool
    {
        return $companyData['name'] !== '' || $companyData['vat_number'] !== '';
    }

    private function hasExplicitCompanyPayload(array $data): bool
    {
        return array_key_exists('company', $data)
            || array_key_exists('company_vat', $data)
            || array_key_exists('company_number', $data)
            || array_key_exists('company_email', $data)
            || array_key_exists('company_phone', $data)
            || array_key_exists('street', $data)
            || array_key_exists('house_number', $data)
            || array_key_exists('postal_code', $data);
    }

    private function findExistingCompanyId(array $companyData, ?string $fallbackCompanyId = null): ?string
    {
        if ($fallbackCompanyId) {
            return $fallbackCompanyId;
        }

        if ($companyData['vat_number'] !== '') {
            $id = $this->di['db']->getCell('SELECT id FROM company WHERE vat_number = :vat LIMIT 1', [':vat' => $companyData['vat_number']]);
            if ($id) {
                return (string) $id;
            }
        }

        if ($companyData['name'] !== '' && $companyData['company_number'] !== '') {
            $id = $this->di['db']->getCell('SELECT id FROM company WHERE name = :name AND company_number = :company_number LIMIT 1', [
                ':name' => $companyData['name'],
                ':company_number' => $companyData['company_number'],
            ]);
            if ($id) {
                return (string) $id;
            }
        }

        return null;
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

    private function upsertCompany(string $companyId, array $companyData): array
    {
        $now = date('Y-m-d H:i:s');
        $existing = $this->getCompanyById($companyId);

        if ($existing) {
            $this->di['db']->exec(
                'UPDATE company SET name = :name, vat_number = :vat_number, company_number = :company_number, email = :email, phone = :phone, street = :street, house_number = :house_number, city = :city, postal_code = :postal_code, country = :country, updated_at = :updated_at WHERE id = :id',
                [
                    ':id' => $companyId,
                    ':name' => $companyData['name'],
                    ':vat_number' => $companyData['vat_number'] !== '' ? $companyData['vat_number'] : null,
                    ':company_number' => $companyData['company_number'] !== '' ? $companyData['company_number'] : null,
                    ':email' => $companyData['email'] !== '' ? $companyData['email'] : null,
                    ':phone' => $companyData['phone'] !== '' ? $companyData['phone'] : null,
                    ':street' => $companyData['street'] !== '' ? $companyData['street'] : null,
                    ':house_number' => $companyData['house_number'] !== '' ? $companyData['house_number'] : null,
                    ':city' => $companyData['city'] !== '' ? $companyData['city'] : null,
                    ':postal_code' => $companyData['postal_code'] !== '' ? $companyData['postal_code'] : null,
                    ':country' => $companyData['country'] !== '' ? $companyData['country'] : null,
                    ':updated_at' => $now,
                ]
            );
        } else {
            $this->di['db']->exec(
                'INSERT INTO company (id, name, vat_number, company_number, email, phone, street, house_number, city, postal_code, country, created_at, updated_at) VALUES (:id, :name, :vat_number, :company_number, :email, :phone, :street, :house_number, :city, :postal_code, :country, :created_at, :updated_at)',
                [
                    ':id' => $companyId,
                    ':name' => $companyData['name'],
                    ':vat_number' => $companyData['vat_number'] !== '' ? $companyData['vat_number'] : null,
                    ':company_number' => $companyData['company_number'] !== '' ? $companyData['company_number'] : null,
                    ':email' => $companyData['email'] !== '' ? $companyData['email'] : null,
                    ':phone' => $companyData['phone'] !== '' ? $companyData['phone'] : null,
                    ':street' => $companyData['street'] !== '' ? $companyData['street'] : null,
                    ':house_number' => $companyData['house_number'] !== '' ? $companyData['house_number'] : null,
                    ':city' => $companyData['city'] !== '' ? $companyData['city'] : null,
                    ':postal_code' => $companyData['postal_code'] !== '' ? $companyData['postal_code'] : null,
                    ':country' => $companyData['country'] !== '' ? $companyData['country'] : null,
                    ':created_at' => $now,
                    ':updated_at' => $now,
                ]
            );
        }

        $company = $this->getCompanyById($companyId);
        if (!$company) {
            throw new \FOSSBilling\Exception('Unable to persist company record');
        }

        return $company;
    }

    private function applyCompanyToClient(\Model_Client $client, array $company): void
    {
        $client->company_id = $company['id'];
        $client->company = $company['name'];
        $client->company_vat = $company['vat_number'];
        $client->company_number = $company['company_number'];
    }

    /*
     * Prunes the `client_password_reset` table of reset requests older than 15 minutes
     *
     * @return void
     */
    public static function onBeforeAdminCronRun(\Box_Event $event)
    {
        $di = $event->getDi();
        $sql = 'DELETE FROM client_password_reset WHERE UNIX_TIMESTAMP() - 900 > UNIX_TIMESTAMP(created_at);';

        try {
            $db = $di['db'];
            $db->exec($sql);
        } catch (\Exception $e) {
            error_log($e->getMessage());
        }
    }

    private static function logUserSyncFailure(\Pimple\Container $di, string $flow, int $clientId, \Throwable $exception): void
    {
        $message = sprintf('[facturatie-user-sync] Failed to publish %s for client #%d: %s', $flow, $clientId, $exception->getMessage());

        if (isset($di['logger'])) {
            $di['logger']->setChannel('application')->err($message);

            return;
        }

        error_log($message);
    }
}

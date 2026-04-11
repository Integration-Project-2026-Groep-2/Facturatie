<?php

declare(strict_types=1);

/**
 * Smoke test: RabbitMQ -> FOSSBilling user synchronization.
 *
 * Validates inbound crm.user.confirmed / crm.user.updated / crm.user.deactivated
 * messages are consumed and persisted correctly in FOSSBilling.
 */

$loadPath = __DIR__ . '/../src/load.php';
if (!file_exists($loadPath)) {
    $loadPath = __DIR__ . '/../load.php';
}
require_once $loadPath;

use FOSSBilling\CrmUserReceiverService;
use FOSSBilling\RabbitMQService;

$di['translate']();

$exchange = getenv('CRM_CONTACT_EXCHANGE') ?: 'contact.topic';
$probeQueue = 'facturatie.crm.user.inbound.probe.' . bin2hex(random_bytes(4));

$companyId = '9a33a76e-2c43-407b-8eee-48d141b2de80';
$crmUserId = '8a9b2a3e-6d1f-4b58-8c20-2f5f3f5c4d11';
$email = 'company.contact@gmail.com';

$rabbit = new RabbitMQService([
    'exchange' => $exchange,
]);

$receiverService = new CrmUserReceiverService($di);
$db = $di['db'];

try {
    $rabbit->declareAndBindQueue($probeQueue, 'crm.user.*', true, $exchange);

    ensureCompanyExists($db, $companyId);
    deleteExistingClient($db, $crmUserId, $email);

    $confirmedXml = loadFixture('crm_user_confirmed_sample.xml');
    publishAndProcess($rabbit, $receiverService, $probeQueue, $exchange, 'crm.user.confirmed', $confirmedXml);
    assertConfirmedState($db, $crmUserId, $email, $companyId);

    $updatedXml = loadFixture('crm_user_updated_sample.xml');
    publishAndProcess($rabbit, $receiverService, $probeQueue, $exchange, 'crm.user.updated', $updatedXml);
    assertUpdatedState($db, $crmUserId, $email);

    $deactivatedXml = loadFixture('crm_user_deactivated_sample.xml');
    publishAndProcess($rabbit, $receiverService, $probeQueue, $exchange, 'crm.user.deactivated', $deactivatedXml);
    assertDeactivatedState($db, $crmUserId, $email);

    echo 'Inbound smoke test passed: RabbitMQ crm.user.* messages were consumed and applied in FOSSBilling.' . PHP_EOL;
} finally {
    try {
        deleteExistingClient($db, $crmUserId, $email);
    } catch (\Throwable) {
    }

    try {
        $rabbit->getChannel()->queue_delete($probeQueue);
    } catch (\Throwable) {
    }

    $rabbit->close();
}

/**
 * @return \Model_Client
 */
function findClientOrFail($db, string $crmUserId, string $email)
{
    $client = $db->findOne('Client', 'aid = ? OR email = ?', [$crmUserId, strtolower($email)]);
    if (!$client instanceof \Model_Client) {
        fwrite(STDERR, sprintf('Expected client not found (aid=%s, email=%s).', $crmUserId, $email) . PHP_EOL);
        exit(1);
    }

    return $client;
}

function assertConfirmedState($db, string $crmUserId, string $email, string $companyId): void
{
    $client = findClientOrFail($db, $crmUserId, $email);

    if ((string) $client->aid !== $crmUserId) {
        fail('Confirmed assertion failed: client aid does not match CRM user id.');
    }
    if ((string) $client->email !== strtolower($email)) {
        fail('Confirmed assertion failed: client email mismatch.');
    }
    if ((string) $client->status !== \Model_Client::ACTIVE) {
        fail('Confirmed assertion failed: client should be active after confirmed event.');
    }
    if ((string) $client->company_id !== $companyId) {
        fail('Confirmed assertion failed: client company_id mismatch.');
    }
}

function assertUpdatedState($db, string $crmUserId, string $email): void
{
    $client = findClientOrFail($db, $crmUserId, $email);

    if ((string) $client->first_name !== 'New') {
        fail('Updated assertion failed: first_name was not updated.');
    }
    if ((string) $client->last_name !== 'Updated') {
        fail('Updated assertion failed: last_name was not updated.');
    }
    if ((string) $client->status !== \Model_Client::ACTIVE) {
        fail('Updated assertion failed: client should remain active after update event.');
    }
}

function assertDeactivatedState($db, string $crmUserId, string $email): void
{
    $client = findClientOrFail($db, $crmUserId, $email);

    if ((string) $client->status !== \Model_Client::SUSPENDED) {
        fail('Deactivated assertion failed: client should be suspended after deactivated event.');
    }
}

function publishAndProcess(
    RabbitMQService $rabbit,
    CrmUserReceiverService $receiverService,
    string $queueName,
    string $exchange,
    string $routingKey,
    string $xml
): void {
    $rabbit->publishRaw($exchange, $routingKey, $xml);

    $channel = $rabbit->getChannel();
    for ($i = 0; $i < 60; $i++) {
        $message = $channel->basic_get($queueName, false);
        if ($message === null) {
            usleep(200000);

            continue;
        }

        $body = $message->getBody();
        $actualRoutingKey = (string) $message->getRoutingKey();
        if ($actualRoutingKey !== $routingKey) {
            $channel->basic_ack($message->getDeliveryTag());

            continue;
        }

        $rabbit->validateXMLForRoutingKey($actualRoutingKey, $body);
        $result = $receiverService->process($actualRoutingKey, $body);
        $channel->basic_ack($message->getDeliveryTag());

        echo sprintf('Processed %s (result=%s)', $actualRoutingKey, $result) . PHP_EOL;

        return;
    }

    fail(sprintf('Timed out waiting for message %s on queue %s.', $routingKey, $queueName));
}

function ensureCompanyExists($db, string $companyId): void
{
    $company = $db->findOne('Company', 'id = ?', [$companyId]);
    if ($company instanceof \Model_Company) {
        return;
    }

    $company = $db->dispense('Company');
    $company->id = $companyId;
    $company->name = 'Inbound Smoke Company';
    $company->vat_number = null;
    $company->email = 'inbound-smoke-company@example.com';
    $company->country = 'BE';
    $company->created_at = date('Y-m-d H:i:s');
    $company->updated_at = date('Y-m-d H:i:s');
    $db->store($company);
}

function deleteExistingClient($db, string $crmUserId, string $email): void
{
    $clientByAid = $db->findOne('Client', 'aid = ?', [$crmUserId]);
    if ($clientByAid instanceof \Model_Client) {
        $db->trash($clientByAid);
    }

    $clientByEmail = $db->findOne('Client', 'email = ?', [strtolower($email)]);
    if ($clientByEmail instanceof \Model_Client) {
        $db->trash($clientByEmail);
    }
}

function loadFixture(string $file): string
{
    $path = __DIR__ . DIRECTORY_SEPARATOR . $file;
    $contents = file_get_contents($path);
    if ($contents === false) {
        fail('Unable to load XML fixture: ' . $path);
    }

    return $contents;
}

function fail(string $message): void
{
    fwrite(STDERR, $message . PHP_EOL);
    exit(1);
}

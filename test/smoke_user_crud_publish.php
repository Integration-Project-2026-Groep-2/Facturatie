<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/load.php';

$hookService = $di['mod_service']('hook');
$hookService->batchConnect('Client');

$exchange = getenv('FACTURATIE_USER_EXCHANGE') ?: 'user.topic';
$rabbit = new \FOSSBilling\RabbitMQService([
    'exchange' => $exchange,
]);

$probeQueue = 'facturatie.user.probe.' . bin2hex(random_bytes(4));
$rabbit->declareAndBindQueue($probeQueue, 'facturatie.user.*', true, $exchange);

$adminApi = new \Box\Mod\Client\Api\Admin();
$adminApi->setDi($di);

$uuid = '8a9b2a3e-6d1f-4b58-8c20-2f5f3f5c4d11';
$email = 'copilot.smoke.' . time() . '@example.com';

$clientId = $adminApi->create([
    'email' => $email,
    'first_name' => 'Copilot',
    'last_name' => 'Smoke',
    'password' => 'StrongPass1!',
    'custom_2' => 'COMPANY_CONTACT',
    'custom_4' => '1',
    'aid' => $uuid,
]);

echo 'Created client id=' . $clientId . PHP_EOL;

$adminApi->update([
    'id' => $clientId,
    'phone' => '+32471111111',
    'address_1' => 'Teststraat',
    'address_2' => '10',
    'postcode' => '1000',
    'city' => 'Brussel',
    'country' => 'BE',
    'custom_2' => 'COMPANY_CONTACT',
    'custom_4' => '1',
]);

echo 'Updated client id=' . $clientId . PHP_EOL;

$adminApi->update([
    'id' => $clientId,
    'status' => \Model_Client::SUSPENDED,
    'custom_2' => 'COMPANY_CONTACT',
    'custom_4' => '1',
]);

echo 'Suspended client id=' . $clientId . PHP_EOL;

$adminApi->delete([
    'id' => $clientId,
]);

echo 'Deleted client id=' . $clientId . PHP_EOL;

$channel = $rabbit->getChannel();
$messages = [];
for ($i = 0; $i < 60; $i++) {
    $msg = $channel->basic_get($probeQueue, false);
    if ($msg) {
        $body = $msg->getBody();
        $xml = @simplexml_load_string($body);
        $root = $xml ? $xml->getName() : 'invalid-xml';
        $messages[] = [
            'routing_key' => $msg->getRoutingKey(),
            'root' => $root,
        ];
        $channel->basic_ack($msg->getDeliveryTag());
        continue;
    }

    usleep(200000);
}

$channel->queue_delete($probeQueue);
$rabbit->close();

$keys = array_map(static fn(array $m): string => $m['routing_key'], $messages);
$foundCreated = in_array('facturatie.user.created', $keys, true);
$foundUpdated = in_array('facturatie.user.updated', $keys, true);
$foundDeactivated = in_array('facturatie.user.deactivated', $keys, true);

echo '--- Captured messages ---' . PHP_EOL;
foreach ($messages as $item) {
    echo $item['routing_key'] . ' | ' . $item['root'] . PHP_EOL;
}

echo '--- Assertions ---' . PHP_EOL;
echo 'created=' . ($foundCreated ? 'yes' : 'no') . PHP_EOL;
echo 'updated=' . ($foundUpdated ? 'yes' : 'no') . PHP_EOL;
echo 'deactivated=' . ($foundDeactivated ? 'yes' : 'no') . PHP_EOL;

if (!$foundCreated || !$foundUpdated || !$foundDeactivated) {
    fwrite(STDERR, 'Missing expected user CRUD events in captured RabbitMQ messages.' . PHP_EOL);
    exit(1);
}

echo 'Smoke test passed: admin UI/API client create/update/delete path emits expected CRM sync messages.' . PHP_EOL;

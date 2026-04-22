<?php

declare(strict_types=1);

/**
 * Smoke test voor Company CRUD → RabbitMQ publicatie.
 *
 * Verifieert dat het aanmaken, bijwerken en verwijderen van een bedrijf via de
 * admin API de berichten facturatie.company.created, facturatie.company.updated
 * en facturatie.company.deactivated uitzendt op de company.topic exchange.
 *
 * Gebruik (in Docker):
 *   docker compose exec app php /var/www/html/test/smoke_company_crud_publish.php
 */

// Pad dat werkt zowel lokaal als in Docker container
$loadPath = __DIR__ . '/../src/load.php';
if (!file_exists($loadPath)) {
    $loadPath = __DIR__ . '/../load.php';
}
require_once $loadPath;

$di['translate']();

$phpErrorLog = __DIR__ . '/../src/data/log/php_error.log';
$phpErrorLogStart = is_file($phpErrorLog) ? filesize($phpErrorLog) : 0;

$exchange = getenv('FACTURATIE_COMPANY_EXCHANGE') ?: 'company.topic';
$rabbit = new \FOSSBilling\RabbitMQService([
    'exchange' => $exchange,
]);

// Maak een tijdelijke probe-queue aan die gebonden is aan facturatie.company.* op de exchange.
$probeQueue = 'facturatie.company.probe.' . bin2hex(random_bytes(4));
$rabbit->declareAndBindQueue($probeQueue, 'facturatie.company.*', true, $exchange);

$service = new \Box\Mod\Company\Service();
$service->setDi($di);

$adminApi = new \Box\Mod\Company\Api\Admin();
$adminApi->setDi($di);
$adminApi->setService($service);

// ─── 1. Aanmaken ─────────────────────────────────────────────

$companyId = $adminApi->create([
    'name' => 'Smoke Test BV ' . time(),
    'vat_number' => 'BE0123456789',
    'email' => 'smoke-company-' . time() . '@gmail.com',
    'phone' => '+3221234567',
    'street' => 'Testlaan',
    'house_number' => '42',
    'postal_code' => '1000',
    'city' => 'Brussel',
    'country' => 'BE',
]);

echo 'Created company id=' . $companyId . PHP_EOL;

// ─── 2. Bijwerken ────────────────────────────────────────────

$adminApi->update([
    'id' => $companyId,
    'name' => 'Smoke Test BV Updated',
    'email' => 'smoke-company-updated-' . time() . '@gmail.com',
    'phone' => '+3229876543',
    'street' => 'Nieuwstraat',
    'house_number' => '1',
    'postal_code' => '2000',
    'city' => 'Antwerpen',
    'country' => 'BE',
]);

echo 'Updated company id=' . $companyId . PHP_EOL;

// ─── 3. Verwijderen (deactiveren) ────────────────────────────

$adminApi->delete([
    'id' => $companyId,
]);

echo 'Deleted company id=' . $companyId . PHP_EOL;

// ─── Berichten verzamelen ────────────────────────────────────

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
            'body' => $body,
        ];
        $channel->basic_ack($msg->getDeliveryTag());
        continue;
    }

    usleep(200000);
}

$channel->queue_delete($probeQueue);
$rabbit->close();

// ─── Controles ───────────────────────────────────────────────

$keys = array_map(static fn(array $m): string => $m['routing_key'], $messages);
$foundCreated = in_array('facturatie.company.created', $keys, true);
$foundUpdated = in_array('facturatie.company.updated', $keys, true);
$foundDeactivated = in_array('facturatie.company.deactivated', $keys, true);

$expectedRootsByRoutingKey = [
    'facturatie.company.created' => 'FacturatieCompanyCreated',
    'facturatie.company.updated' => 'FacturatieCompanyUpdated',
    'facturatie.company.deactivated' => 'FacturatieCompanyDeactivated',
];

$rootExpectationsOk = true;
foreach ($messages as $item) {
    $expectedRoot = $expectedRootsByRoutingKey[$item['routing_key']] ?? null;
    if ($expectedRoot === null) {
        continue;
    }

    if ($item['root'] !== $expectedRoot) {
        $rootExpectationsOk = false;
        fwrite(STDERR, sprintf(
            'Unexpected root for %s: expected %s, got %s',
            $item['routing_key'],
            $expectedRoot,
            $item['root']
        ) . PHP_EOL);
    }
}

echo '--- Captured messages ---' . PHP_EOL;
foreach ($messages as $item) {
    echo $item['routing_key'] . ' | ' . $item['root'] . PHP_EOL;
}

echo '--- Assertions ---' . PHP_EOL;
echo 'created=' . ($foundCreated ? 'yes' : 'no') . PHP_EOL;
echo 'updated=' . ($foundUpdated ? 'yes' : 'no') . PHP_EOL;
echo 'deactivated=' . ($foundDeactivated ? 'yes' : 'no') . PHP_EOL;
echo 'roots=' . ($rootExpectationsOk ? 'ok' : 'mismatch') . PHP_EOL;

if (!$foundCreated || !$foundUpdated || !$foundDeactivated || !$rootExpectationsOk) {
    fwrite(STDERR, 'Missing expected company CRUD events in captured RabbitMQ messages.' . PHP_EOL);
    exit(1);
}

assertNoGenericErrors($phpErrorLog, $phpErrorLogStart, [
    'Missing company dependency',
    'Email address is invalid',
]);

echo 'Smoke test passed: Company create/update/delete correctly emits facturatie.company.* CRM sync messages.' . PHP_EOL;

function assertNoGenericErrors(string $logFile, int $startOffset, array $needles): void
{
    if (!is_file($logFile)) {
        return;
    }

    $contents = file_get_contents($logFile);
    if ($contents === false) {
        return;
    }

    $tail = $startOffset > 0 ? substr($contents, $startOffset) : $contents;
    foreach ($needles as $needle) {
        if (strpos($tail, $needle) !== false) {
            fwrite(STDERR, sprintf('Smoke test detected unexpected application error in php_error.log: %s', $needle) . PHP_EOL);
            exit(1);
        }
    }
}

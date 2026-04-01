<?php
/**
 * Direct test: Company create/update/delete + controleer RabbitMQ berichten.
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');

$loadPath = __DIR__ . '/../load.php';
if (!file_exists($loadPath)) {
    $loadPath = __DIR__ . '/../src/load.php';
}
require_once $loadPath;

echo "=== Company CRUD + RabbitMQ Test ===\n";

// 1. Maak een probe queue aan om berichten op te vangen
$exchange = getenv('FACTURATIE_COMPANY_EXCHANGE') ?: 'company.topic';
$rabbit = new \FOSSBilling\RabbitMQService(['exchange' => $exchange]);
$probeQueue = 'test.company.verify.' . bin2hex(random_bytes(4));
$rabbit->declareAndBindQueue($probeQueue, 'facturatie.company.*', true, $exchange);
echo "Probe queue aangemaakt: $probeQueue\n";

// 2. Maak een bedrijf aan via de Service
$service = $di['mod_service']('Company');

$id = $service->create([
    'name' => 'Test Bedrijf BV',
    'vat_number' => 'BE0123456789',
    'email' => 'test@bedrijf.be',
    'phone' => '+3221234567',
    'street' => 'Teststraat',
    'house_number' => '1',
    'postal_code' => '1000',
    'city' => 'Brussel',
    'country' => 'BE',
]);
echo "1. CREATED company id=$id\n";

// 3. Update het bedrijf
$company = $service->get($id);
$service->update($company, [
    'name' => 'Test Bedrijf BV Updated',
    'email' => 'updated@bedrijf.be',
]);
echo "2. UPDATED company id=$id\n";

// 4. Verwijder het bedrijf
$company = $service->get($id);
$service->delete($company);
echo "3. DELETED company id=$id\n";

// 5. Berichten ophalen uit de probe queue
$channel = $rabbit->getChannel();
$messages = [];
for ($i = 0; $i < 30; $i++) {
    $msg = $channel->basic_get($probeQueue, false);
    if ($msg) {
        $messages[] = [
            'routing_key' => $msg->getRoutingKey(),
            'body' => $msg->getBody(),
        ];
        $channel->basic_ack($msg->getDeliveryTag());
        continue;
    }
    usleep(200000);
}

// 6. Opruimen
$channel->queue_delete($probeQueue);
$rabbit->close();

// 7. Resultaten tonen
echo "\n=== RESULTATEN ===\n";
echo "Aantal berichten ontvangen: " . count($messages) . "\n\n";

foreach ($messages as $i => $m) {
    echo "--- Bericht " . ($i + 1) . " ---\n";
    echo "Routing key: " . $m['routing_key'] . "\n";
    echo "XML:\n" . $m['body'] . "\n\n";
}

$keys = array_column($messages, 'routing_key');
$ok = in_array('facturatie.company.created', $keys)
   && in_array('facturatie.company.updated', $keys)
   && in_array('facturatie.company.deactivated', $keys);

echo $ok ? "✅ ALLE 3 BERICHTEN ONTVANGEN!\n" : "❌ NIET ALLE BERICHTEN ONTVANGEN\n";

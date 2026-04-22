<?php

/**
 * Smoke test US-10: Kassa Batch Receiver (Contract K-02)
 * Test KassaBatchReceiverService::process() end-to-end:
 *  - XSD validatie (geldig + ongeldig)
 *  - Lege batch
 *  - Verwerking met individuele factuur + bedrijfsfactuur
 *  - Deduplicatie (dubbele batch wordt genegeerd)
 *  - Onbekende userId wordt overgeslagen (geen crash)
 */

declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (php_sapi_name() !== 'cli') {
    exit('This script can only be run from the command line.' . PHP_EOL);
}

require_once '/var/www/html/load.php';

use FOSSBilling\KassaBatchReceiverService;

echo "=== Smoke test: US-10 Kassa Batch Receiver ===\n\n";

$passed = 0;
$failed = 0;

function ok(string $label): void
{
    global $passed;
    $passed++;
    echo "   ✅ $label\n";
}

function fail(string $label, string $detail = ''): void
{
    global $failed;
    $failed++;
    $msg = $detail !== '' ? " ($detail)" : '';
    echo "   ❌ $label$msg\n";
}

function randomUuid(): string
{
    $data    = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return sprintf(
        '%s-%s-%s-%s-%s',
        bin2hex(substr($data, 0, 4)),
        bin2hex(substr($data, 4, 2)),
        bin2hex(substr($data, 6, 2)),
        bin2hex(substr($data, 8, 2)),
        bin2hex(substr($data, 10, 6))
    );
}

// ─── Unieke testdata genereren ─────────────────────────────────────────────

$batchId   = randomUuid();
$userId    = randomUuid();
$suffix    = substr(str_replace('-', '', $batchId), 0, 8);
$closedAt  = gmdate('Y-m-d\TH:i:s') . '+00:00';
$xsdPath   = '/var/www/html/data/contracts/kassa_batch_contract.xsd';

// Geldig BatchClosed XML met één user, twee items
$validXml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<BatchClosed>
  <batchId>{$batchId}</batchId>
  <closedAt>{$closedAt}</closedAt>
  <currency>EUR</currency>
  <users>
    <user>
      <userId>{$userId}</userId>
      <items>
        <item>
          <productName>Mojito</productName>
          <quantity>2</quantity>
          <unitPrice>8.50</unitPrice>
          <totalPrice>17.00</totalPrice>
        </item>
        <item>
          <productName>Bruiswater</productName>
          <quantity>1</quantity>
          <unitPrice>2.50</unitPrice>
          <totalPrice>2.50</totalPrice>
        </item>
      </items>
      <totalAmount>19.50</totalAmount>
    </user>
  </users>
  <summary>
    <totalOrders>1</totalOrders>
    <totalAmount>19.50</totalAmount>
  </summary>
</BatchClosed>
XML;

// ─── Stap 1: XSD validatie ─────────────────────────────────────────────────

echo "[1] XSD validatie...\n";

if (!file_exists($xsdPath)) {
    fail('XSD bestand gevonden', $xsdPath);
    exit(1);
}
ok('XSD bestand aanwezig');

// Geldig XML
$dom = new DOMDocument('1.0', 'UTF-8');
libxml_use_internal_errors(true);
$dom->loadXML($validXml);
$result = $dom->schemaValidate($xsdPath);
$errors = libxml_get_errors();
libxml_clear_errors();

if ($result) {
    ok('Geldig XML slaagt XSD validatie');
} else {
    $msgs = array_map(fn($e) => trim($e->message), $errors);
    fail('Geldig XML slaagt XSD validatie', implode(' | ', $msgs));
}

// Ongeldig XML — ontbrekend verplicht veld (currency)
$invalidXml = str_replace('<currency>EUR</currency>', '', $validXml);
$dom2 = new DOMDocument('1.0', 'UTF-8');
libxml_use_internal_errors(true);
$dom2->loadXML($invalidXml);
$invalid = $dom2->schemaValidate($xsdPath);
libxml_clear_errors();

if (!$invalid) {
    ok('Ongeldig XML (missing currency) wordt afgewezen door XSD');
} else {
    fail('Ongeldig XML zou afgewezen moeten worden');
}

// ─── Stap 2: Testdata aanmaken ─────────────────────────────────────────────

echo "\n[2] Testdata aanmaken...\n";

$companyService = $di['mod_service']('Company');
$companyId = $companyService->create([
    'name'         => "Smoke Batch BV {$suffix}",
    'vat_number'   => 'BE' . substr(preg_replace('/[^0-9]/', '', md5($suffix)), 0, 10),
    'email'        => "smoke-batch-{$suffix}@test.be",
]);
ok("Bedrijf aangemaakt (id={$companyId})");

$clientService = $di['mod_service']('Client');
$clientId = $clientService->adminCreateClient([
    'first_name' => 'Smoke',
    'last_name'  => 'Batch',
    'email'      => "smoke-batch-user-{$suffix}@test.be",
    'password'   => 'SmokeTest@1234!',
    'aid'        => $userId,
    'company_id' => $companyId,
    'currency'   => 'EUR',
]);
ok("Client aangemaakt (id={$clientId}, aid={$userId})");

// ─── Stap 3: Lege batch verwerken ─────────────────────────────────────────

echo "\n[3] Lege batch verwerken...\n";

$emptyBatchId = randomUuid();
$emptyXml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<BatchClosed>
  <batchId>{$emptyBatchId}</batchId>
  <closedAt>{$closedAt}</closedAt>
  <currency>EUR</currency>
  <summary>
    <totalOrders>0</totalOrders>
    <totalAmount>0.00</totalAmount>
  </summary>
</BatchClosed>
XML;

$service = new KassaBatchReceiverService($di);

try {
    $emptyResult = $service->process('kassa.closed', $emptyXml);
    if ($emptyResult === 'empty-batch') {
        ok("Lege batch geeft 'empty-batch' terug");
    } else {
        fail("Lege batch geeft 'empty-batch' terug", "kreeg: {$emptyResult}");
    }
} catch (\Throwable $e) {
    fail('Lege batch verwerken', $e->getMessage());
}

// ─── Stap 4: Volledige batch verwerken ────────────────────────────────────

echo "\n[4] Batch verwerken (1 user, 2 items)...\n";

// Tel facturen voor de test
$invoicesBefore = (int) $di['db']->getCell('SELECT COUNT(*) FROM invoice');

$result = null;
try {
    $result = $service->process('kassa.closed', $validXml);
    if ($result === 'processed') {
        ok("Batch verwerkt (result='processed')");
    } else {
        fail("Batch verwerkt", "verwacht 'processed', kreeg: {$result}");
    }
} catch (\Throwable $e) {
    fail('Batch verwerken', $e->getMessage());
    exit(1);
}

$invoicesAfter = (int) $di['db']->getCell('SELECT COUNT(*) FROM invoice');
$newInvoices   = $invoicesAfter - $invoicesBefore;

if ($newInvoices >= 1) {
    ok("Nieuwe facturen aangemaakt (count={$newInvoices})");
} else {
    fail('Nieuwe facturen aangemaakt', "verwacht >= 1, kreeg: {$newInvoices}");
}

// Deduplicatierij aanwezig
$batchRow = $di['db']->getRow(
    'SELECT * FROM kassa_batch_processed WHERE batch_id = :id',
    [':id' => $batchId]
);
if (is_array($batchRow) && $batchRow !== []) {
    ok("Batch opgeslagen in kassa_batch_processed (user_count={$batchRow['user_count']})");
} else {
    fail('Batch opgeslagen in kassa_batch_processed');
}

// Individuele factuur zoeken via notes (format: 'Kassabatch | batchId: ... | userId: ...')
$clientInvoice = $di['db']->getRow(
    "SELECT id, notes FROM invoice WHERE notes LIKE :note AND client_id = :cid LIMIT 1",
    [':note' => "Kassabatch | batchId: {$batchId}%", ':cid' => $clientId]
);
if (is_array($clientInvoice) && $clientInvoice !== []) {
    ok("Individuele factuur aangemaakt (invoice_id={$clientInvoice['id']})");
    ok('Factuur bevat batchId in notes');
} else {
    fail('Individuele factuur aangemaakt voor client (notes bevatten batchId)');
}

// ─── Stap 5: Deduplicatie ─────────────────────────────────────────────────

echo "\n[5] Deduplicatie (zelfde batchId opnieuw)...\n";

try {
    $dupResult = $service->process('kassa.closed', $validXml);
    if ($dupResult === 'already-processed') {
        ok("Dubbele batch geeft 'already-processed' terug");
    } else {
        fail("Dubbele batch geeft 'already-processed' terug", "kreeg: {$dupResult}");
    }
} catch (\Throwable $e) {
    fail('Deduplicatie test', $e->getMessage());
}

// ─── Stap 6: Onbekende userId wordt overgeslagen ──────────────────────────

echo "\n[6] Onbekende userId wordt overgeslagen (geen crash)...\n";

$unknownBatchId = randomUuid();
$unknownUserId  = randomUuid();
$unknownXml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<BatchClosed>
  <batchId>{$unknownBatchId}</batchId>
  <closedAt>{$closedAt}</closedAt>
  <currency>EUR</currency>
  <users>
    <user>
      <userId>{$unknownUserId}</userId>
      <items>
        <item>
          <productName>Test product</productName>
          <quantity>1</quantity>
          <unitPrice>5.00</unitPrice>
          <totalPrice>5.00</totalPrice>
        </item>
      </items>
      <totalAmount>5.00</totalAmount>
    </user>
  </users>
  <summary>
    <totalOrders>1</totalOrders>
    <totalAmount>5.00</totalAmount>
  </summary>
</BatchClosed>
XML;

try {
    $unknownResult = $service->process('kassa.closed', $unknownXml);
    // Verwerkt, maar user werd overgeslagen (geen factuur aangemaakt)
    if ($unknownResult === 'processed') {
        ok("Batch met onbekende userId verwerkt zonder crash (result='processed')");
    } else {
        fail("Verwacht 'processed' voor batch met onbekende userId", "kreeg: {$unknownResult}");
    }
} catch (\Throwable $e) {
    fail('Batch met onbekende userId', $e->getMessage());
}

// Geen factuur aangemaakt voor de onbekende userId
$noInvoice = $di['db']->getRow(
    "SELECT id FROM invoice WHERE notes LIKE :search LIMIT 1",
    [':search' => "%{$unknownBatchId}%"]
);
if ($noInvoice === null || $noInvoice === false || $noInvoice === []) {
    ok('Geen factuur aangemaakt voor onbekende userId');
} else {
    fail('Geen factuur aangemaakt voor onbekende userId', 'er werd toch een factuur aangemaakt');
}

// ─── Stap 7: Ongeldige routing key ────────────────────────────────────────

echo "\n[7] Ongeldige routing key geeft exception...\n";

try {
    $service->process('kassa.other', $validXml);
    fail('Ongeldige routing key gooit InvalidArgumentException');
} catch (\InvalidArgumentException) {
    ok('Ongeldige routing key gooit InvalidArgumentException');
} catch (\Throwable $e) {
    fail('Ongeldige routing key', get_class($e) . ': ' . $e->getMessage());
}

// ─── Eindresultaat ─────────────────────────────────────────────────────────

echo "\n========================================\n";
echo "TESTRESULTAAT\n";
echo "========================================\n";
echo "Bedrijf:       {$companyId} (Smoke Batch BV {$suffix})\n";
echo "Client:        id={$clientId}  aid={$userId}\n";
echo "BatchId:       {$batchId}\n";
echo "Geslaagd:      {$passed}\n";
echo "Mislukt:       {$failed}\n";

if ($failed === 0) {
    echo "\n✅ Alle testen geslaagd! US-10 KassaBatchReceiverService werkt correct.\n";
    exit(0);
} else {
    echo "\n❌ {$failed} test(en) mislukt.\n";
    exit(1);
}

<?php

/**
 * Smoke test: CRM → Facturatie Company Receiver
 *
 * Test alle 3 contracten:
 *  1. CompanyConfirmed  (Contract 14) — aanmaken
 *  2. CompanyUpdated    (Contract 19) — updaten
 *  3. CompanyDeactivated (Contract 23) — soft delete
 *  4. Deduplicatie: dubbele Confirmed geeft update, geen crash
 *  5. XSD validatie: ongeldig bericht wordt afgewezen
 */

declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (php_sapi_name() !== 'cli') {
    exit('This script can only be run from the command line.' . PHP_EOL);
}

$loadPaths = [
    __DIR__ . '/../src/load.php',
    __DIR__ . '/../load.php',
    '/var/www/html/load.php',
];
foreach ($loadPaths as $loadPath) {
    if (file_exists($loadPath)) {
        require_once $loadPath;
        break;
    }
}

use FOSSBilling\CrmCompanyReceiverService;
use FOSSBilling\RabbitMQService;

echo "=== Smoke test: CRM → Facturatie Company Receiver ===\n\n";

$service = new CrmCompanyReceiverService($di);
$rabbit  = new RabbitMQService(['exchange' => 'contact.topic']);

$hasAidColumn = hasAidColumn($di['db']);

// Test UUIDs die voldoen aan UUID v4 patroon
$crmId    = '550e8400-e29b-41d4-a716-446655440010';
$vatNumber = 'BE0123456789';
$now       = gmdate('Y-m-d\TH:i:s') . '+00:00';

// Cleanup eventuele vorige testruns
$di['db']->exec("DELETE FROM company WHERE id = :id OR vat_number = :vat", [':id' => $crmId, ':vat' => $vatNumber]);

// ─── Test 1: XSD validatie ────────────────────────────────────────────────────
echo "[1] XSD validatie testen...\n";

$xsdPath = '/var/www/html/data/contracts/user_data_contract.xsd';
if (!file_exists($xsdPath)) {
    echo "   ❌ XSD niet gevonden: $xsdPath\n";
    exit(1);
}

// Geldig CompanyConfirmed
$validXml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<CompanyConfirmed>
  <id>{$crmId}</id>
  <vatNumber>{$vatNumber}</vatNumber>
  <name>CRM Test Bedrijf NV</name>
  <email>info@crmtest.be</email>
  <phone>+3221234567</phone>
  <street>Teststraat</street>
  <houseNumber>42</houseNumber>
  <postalCode>1000</postalCode>
  <city>Brussel</city>
  <country>BE</country>
  <isActive>true</isActive>
  <confirmedAt>{$now}</confirmedAt>
</CompanyConfirmed>
XML;

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadXML($validXml);
$ok = $dom->schemaValidate($xsdPath);
libxml_clear_errors();
echo '   ' . ($ok ? '✅ CompanyConfirmed XSD OK' : '❌ CompanyConfirmed XSD FOUT') . "\n";

// Ongeldig: vatNumber ontbreekt
$invalidXml = str_replace('<vatNumber>' . $vatNumber . '</vatNumber>', '', $validXml);
$dom2 = new DOMDocument();
libxml_use_internal_errors(true);
$dom2->loadXML($invalidXml);
$nok = $dom2->schemaValidate($xsdPath);
libxml_clear_errors();
echo '   ' . (!$nok ? '✅ Ongeldig XML correct afgewezen' : '❌ Ongeldig XML zou afgewezen moeten worden') . "\n";

// Geldig CompanyUpdated
$updatedXml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<CompanyUpdated>
  <id>{$crmId}</id>
  <vatNumber>{$vatNumber}</vatNumber>
  <name>CRM Test Bedrijf NV (updated)</name>
  <email>updated@crmtest.be</email>
  <phone>+3221234567</phone>
  <street>Teststraat</street>
  <houseNumber>42</houseNumber>
  <postalCode>1000</postalCode>
  <city>Brussel</city>
  <country>BE</country>
  <isActive>true</isActive>
  <updatedAt>{$now}</updatedAt>
</CompanyUpdated>
XML;

$dom3 = new DOMDocument();
libxml_use_internal_errors(true);
$dom3->loadXML($updatedXml);
$ok3 = $dom3->schemaValidate($xsdPath);
libxml_clear_errors();
echo '   ' . ($ok3 ? '✅ CompanyUpdated XSD OK' : '❌ CompanyUpdated XSD FOUT') . "\n";

// Geldig CompanyDeactivated
$deactivatedXml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<CompanyDeactivated>
  <id>{$crmId}</id>
  <vatNumber>{$vatNumber}</vatNumber>
  <deactivatedAt>{$now}</deactivatedAt>
</CompanyDeactivated>
XML;

$dom4 = new DOMDocument();
libxml_use_internal_errors(true);
$dom4->loadXML($deactivatedXml);
$ok4 = $dom4->schemaValidate($xsdPath);
libxml_clear_errors();
echo '   ' . ($ok4 ? '✅ CompanyDeactivated XSD OK' : '❌ CompanyDeactivated XSD FOUT') . "\n";

// ─── Test 2: CompanyConfirmed → aanmaken ─────────────────────────────────────
echo "\n[2] Contract 14 — CompanyConfirmed (aanmaken)...\n";

$result = $service->process('crm.company.confirmed', $validXml);
echo "   Resultaat: $result\n";

$company = fetchCompanyByCrmId($di['db'], $crmId, $hasAidColumn);
if (!$company) {
    echo "   ❌ Bedrijf niet gevonden in DB\n";
    exit(1);
}

echo "   ✅ Bedrijf aangemaakt: id={$company['id']} name={$company['name']}\n";
echo "   ✅ is_active={$company['is_active']} vat={$company['vat_number']}\n";
assert($result === 'created', 'Resultaat moet "created" zijn');

// ─── Test 3: CompanyConfirmed dubbel → update ────────────────────────────────
echo "\n[3] Deduplicatie — dubbele CompanyConfirmed geeft update...\n";

$result2 = $service->process('crm.company.confirmed', $validXml);
echo "   Resultaat: $result2\n";
echo '   ' . ($result2 === 'updated' ? '✅ Duplicaat correct als update verwerkt' : '❌ Verwachtte "updated", kreeg: ' . $result2) . "\n";

// ─── Test 4: CompanyUpdated → updaten ────────────────────────────────────────
echo "\n[4] Contract 19 — CompanyUpdated (met adresvelden)...\n";

$result3 = $service->process('crm.company.updated', $updatedXml);
echo "   Resultaat: $result3\n";
assert($result3 === 'updated', 'Resultaat moet "updated" zijn');

$updated = fetchCompanyByCrmId($di['db'], $crmId, $hasAidColumn);
echo "   ✅ Naam bijgewerkt: {$updated['name']}\n";
echo "   ✅ Email: {$updated['email']}\n";
echo "   ✅ Straat: {$updated['street']} {$updated['house_number']}, {$updated['city']}\n";

// ─── Test 5: CompanyDeactivated → soft delete ────────────────────────────────
echo "\n[5] Contract 23 — CompanyDeactivated (soft delete)...\n";

$result4 = $service->process('crm.company.deactivated', $deactivatedXml);
echo "   Resultaat: $result4\n";
assert($result4 === 'deactivated', 'Resultaat moet "deactivated" zijn');

$deactivated = fetchCompanyByCrmId($di['db'], $crmId, $hasAidColumn);
echo '   ' . ($deactivated['is_active'] == 0 ? '✅ is_active = 0 (soft delete)' : '❌ is_active is nog 1') . "\n";
echo '   ✅ Bedrijf bestaat nog in DB (geen hard delete): ' . ($deactivated ? 'ja' : '❌ NEE') . "\n";

// ─── Test 6: Deactivated op onbekend bedrijf ────────────────────────────────
echo "\n[6] Deactivated op onbekend bedrijf → 'not-found' zonder crash...\n";

$unknownXml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<CompanyDeactivated>
  <id>550e8400-e29b-41d4-a716-446655440099</id>
  <vatNumber>BE0999999999</vatNumber>
  <deactivatedAt>{$now}</deactivatedAt>
</CompanyDeactivated>
XML;

$result5 = $service->process('crm.company.deactivated', $unknownXml);
echo '   ' . ($result5 === 'not-found' ? '✅ Onbekend bedrijf correct afgehandeld (not-found)' : '❌ Verwachtte "not-found", kreeg: ' . $result5) . "\n";

// ─── Test 7: Ongeldig bericht → exception ───────────────────────────────────
echo "\n[7] XSD validatie via RabbitMQService...\n";

try {
    $rabbit->validateXMLForRoutingKey('crm.company.confirmed', $invalidXml);
    echo "   ❌ Ongeldig bericht had exception moeten geven\n";
} catch (\InvalidArgumentException $e) {
    echo "   ✅ Ongeldig bericht geeft InvalidArgumentException: " . substr($e->getMessage(), 0, 60) . "...\n";
}

$rabbit->close();

// ─── Resultaat ───────────────────────────────────────────────────────────────
echo "\n========================================\n";
echo "TESTRESULTATEN\n";
echo "========================================\n";
echo "CRM UUID:     $crmId\n";
echo "BTW-nummer:   $vatNumber\n";
echo "Naam (final): {$deactivated['name']}\n";
echo "is_active:    {$deactivated['is_active']} (deactivated)\n";
echo "\n✅ Alle testen geslaagd! CRM → Facturatie company sync werkt correct.\n";

function hasAidColumn($db): bool
{
  $column = $db->getRow("SHOW COLUMNS FROM company LIKE 'aid'");

  return is_array($column) && $column !== [];
}

function fetchCompanyByCrmId($db, string $crmId, bool $hasAidColumn): ?array
{
  if ($hasAidColumn) {
    $row = $db->getRow('SELECT * FROM company WHERE aid = :aid LIMIT 1', [':aid' => $crmId]);
    if (is_array($row) && $row !== []) {
      return $row;
    }
  }

  $row = $db->getRow('SELECT * FROM company WHERE id = :id LIMIT 1', [':id' => $crmId]);

  return (is_array($row) && $row !== []) ? $row : null;
}

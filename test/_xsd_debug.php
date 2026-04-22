<?php
libxml_use_internal_errors(true);
$d = new DOMDocument();
$xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompanyConfirmed>
  <id>550e8400-e29b-41d4-a716-446655440010</id>
  <vatNumber>BE0123456789</vatNumber>
  <name>Test Bedrijf</name>
  <email>test@test.be</email>
  <isActive>true</isActive>
  <confirmedAt>2026-04-22T10:00:00+00:00</confirmedAt>
</CompanyConfirmed>';

$d->loadXML($xml);
$ok = $d->schemaValidate('/var/www/html/data/contracts/user_data_contract.xsd');
$errs = libxml_get_errors();
foreach ($errs as $e) {
    echo 'ERROR: ' . trim($e->message) . ' (line ' . $e->line . ')' . PHP_EOL;
}
echo ($ok ? 'VALID' : 'INVALID') . PHP_EOL;

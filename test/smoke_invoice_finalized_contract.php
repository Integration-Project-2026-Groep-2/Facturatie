<?php

declare(strict_types=1);

/**
 * Smoke test for invoice.finalized contract validation.
 *
 * Verifies that REGULAR and CREDIT payloads validate against
 * src/data/contracts/facturatie_contract.xsd and invalid values are rejected.
 *
 * Usage (in Docker):
 *   docker compose exec app php /var/www/html/test/smoke_invoice_finalized_contract.php
 */

$loadPath = __DIR__ . '/../src/load.php';
if (!file_exists($loadPath)) {
    $loadPath = __DIR__ . '/../load.php';
}
require_once $loadPath;

$rabbit = new \FOSSBilling\RabbitMQService([
    'exchange' => getenv('INVOICE_EXCHANGE') ?: 'invoice.topic',
]);

$validRegular = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<invoice_finalized>
  <invoiceNumber>INV-1001</invoiceNumber>
  <recipientEmail>billing@example.com</recipientEmail>
  <pdfUrl>https://example.com/invoice/INV-1001.pdf</pdfUrl>
  <totalAmount>125.50</totalAmount>
  <type>REGULAR</type>
</invoice_finalized>
XML;

$validCredit = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<invoice_finalized>
  <invoiceNumber>INV-1002</invoiceNumber>
  <recipientEmail>billing@example.com</recipientEmail>
  <pdfUrl>https://example.com/invoice/INV-1002.pdf</pdfUrl>
  <totalAmount>-15.00</totalAmount>
  <type>CREDIT</type>
</invoice_finalized>
XML;

$invalidType = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<invoice_finalized>
  <invoiceNumber>INV-1003</invoiceNumber>
  <recipientEmail>billing@example.com</recipientEmail>
  <pdfUrl>https://example.com/invoice/INV-1003.pdf</pdfUrl>
  <totalAmount>20.00</totalAmount>
  <type>invoice_finalized</type>
</invoice_finalized>
XML;

try {
    $rabbit->validateXMLForRoutingKey('invoice.finalized', $validRegular);
    echo "REGULAR payload is valid" . PHP_EOL;

    $rabbit->validateXMLForRoutingKey('invoice.finalized', $validCredit);
    echo "CREDIT payload is valid" . PHP_EOL;
} catch (\Throwable $e) {
    fwrite(STDERR, 'Expected valid payload failed validation: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}

$invalidRejected = false;
try {
    $rabbit->validateXMLForRoutingKey('invoice.finalized', $invalidType);
} catch (\InvalidArgumentException $e) {
    $invalidRejected = true;
    echo 'Invalid type payload correctly rejected: ' . $e->getMessage() . PHP_EOL;
}

if (!$invalidRejected) {
    fwrite(STDERR, 'Expected invalid type payload to be rejected by XSD, but it passed.' . PHP_EOL);
    exit(1);
}

echo 'Smoke test passed: invoice.finalized contract validation behaves as expected.' . PHP_EOL;

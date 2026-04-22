<?php
declare(strict_types=1);
require_once '/var/www/html/load.php';

$rows = $di['db']->getAll(
    'SELECT id, name, vat_number, email, is_active, created_at FROM company ORDER BY created_at DESC LIMIT 10'
);

echo "\n=== Bedrijven in FOSSBilling DB (laatste 10) ===\n\n";
foreach ($rows as $r) {
    $status = $r['is_active'] ? 'ACTIEF' : 'INACTIEF';
    echo sprintf("ID:     %s\n", $r['id']);
    echo sprintf("Naam:   %s\n", $r['name']);
    echo sprintf("BTW:    %s\n", $r['vat_number']);
    echo sprintf("Email:  %s\n", $r['email'] ?? '-');
    echo sprintf("Status: %s\n", $status);
    echo sprintf("Datum:  %s\n", $r['created_at']);
    echo str_repeat('-', 60) . "\n";
}

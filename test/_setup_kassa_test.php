<?php
declare(strict_types=1);
require_once '/var/www/html/load.php';

$testAid = '550e8400-e29b-41d4-a716-446655440001';

// Zoek client met company
$clients = $di['db']->getAll(
    "SELECT id, email, aid, company_id FROM client WHERE company_id IS NOT NULL AND company_id != '' LIMIT 3"
);

if (empty($clients)) {
    echo "❌ Geen clients gevonden met een company_id.\n";
    echo "   Maak eerst een client aan in FOSSBilling en link hem aan een bedrijf.\n";
    exit(1);
}

echo "=== Beschikbare clients met company ===\n";
foreach ($clients as $c) {
    echo sprintf("  id=%-3s  email=%-30s  aid=%-40s  company_id=%s\n",
        $c['id'], $c['email'], $c['aid'] ?? '(leeg)', $c['company_id']);
}

// Eerste client instellen met test aid
$targetClient = $clients[0];
$di['db']->exec(
    "UPDATE client SET aid = :aid WHERE id = :id",
    [':aid' => $testAid, ':id' => $targetClient['id']]
);

echo "\n✅ aid ingesteld op client id={$targetClient['id']} ({$targetClient['email']})\n";
echo "   aid = $testAid\n";
echo "   company_id = {$targetClient['company_id']}\n";
echo "\nGebruik deze userId in je BatchClosed XML: $testAid\n";

<?php
declare(strict_types=1);
require_once '/var/www/html/load.php';

echo "=== Clients met aid (CRM UUID) ===\n";
$clients = $di['db']->getAll(
    "SELECT id, aid, email, first_name, last_name, company_id FROM client WHERE aid IS NOT NULL AND aid != '' LIMIT 5"
);
if (empty($clients)) {
    echo "  (geen clients met aid gevonden)\n";
} else {
    foreach ($clients as $c) {
        echo sprintf(
            "  client_id=%-5s  aid=%-40s  email=%-30s  company_id=%s\n",
            $c['id'], $c['aid'], $c['email'], $c['company_id'] ?? 'null'
        );
    }
}

echo "\n=== Actieve companies ===\n";
$companies = $di['db']->getAll("SELECT id, name, vat_number FROM company WHERE is_active = 1 LIMIT 5");
foreach ($companies as $co) {
    echo sprintf("  id=%-40s  name=%s\n", $co['id'], $co['name']);
}

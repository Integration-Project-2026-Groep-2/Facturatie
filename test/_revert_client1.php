<?php
declare(strict_types=1);
require_once '/var/www/html/load.php';

$di['db']->exec("UPDATE client SET aid = NULL WHERE id = 1");
echo "✅ aid van client id=1 teruggezet naar NULL\n";

$c = $di['db']->getRow("SELECT id, email, aid, company_id FROM client WHERE id = 1");
echo "   id={$c['id']} email={$c['email']} aid=" . ($c['aid'] ?? 'null') . "\n";

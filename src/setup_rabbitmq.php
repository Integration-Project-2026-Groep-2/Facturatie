<?php

declare(strict_types=1);

require_once __DIR__ . '/load.php';

use FOSSBilling\RabbitMQService;

echo "[RabbitMQ Setup] Declaring exchanges and queues...\n";

try {
    $rabbit = new RabbitMQService();
    
    // Kassa Infrastructure
    $kassaExchange = (string) (getenv('KASSA_TOPIC_EXCHANGE') ?: 'kassa.topic');
    $kassaQueue = (string) (getenv('KASSA_INVOICE_REQUESTED_QUEUE') ?: 'facturatie.kassa.invoice.requested');
    $kassaRoutingKey = 'kassa.invoice.requested';
    
    echo "- Declaring exchange: $kassaExchange\n";
    $rabbit->declareExchange($kassaExchange, 'topic', true);
    
    echo "- Declaring queue: $kassaQueue and binding to $kassaRoutingKey\n";
    $rabbit->declareAndBindQueue($kassaQueue, $kassaRoutingKey, true, $kassaExchange);
    
    // CRM Infrastructure
    $crmExchange = (string) (getenv('CRM_CONTACT_EXCHANGE') ?: 'contact.topic');
    $rabbit->declareExchange($crmExchange, 'topic', true);
    
    $crmQueues = [
        'crm.user.confirmed' => (string) (getenv('CRM_USER_CONFIRMED_QUEUE') ?: 'facturatie.user.confirmed'),
        'crm.user.updated' => (string) (getenv('CRM_USER_UPDATED_QUEUE') ?: 'facturatie.user.updated'),
        'crm.user.deactivated' => (string) (getenv('CRM_USER_DEACTIVATED_QUEUE') ?: 'facturatie.user.deactivated'),
    ];
    
    foreach ($crmQueues as $rk => $q) {
        echo "- Declaring queue: $q and binding to $rk\n";
        $rabbit->declareAndBindQueue($q, $rk, true, $crmExchange);
    }
    
    $rabbit->close();
    echo "[RabbitMQ Setup] Success!\n";
} catch (\Throwable $e) {
    echo "[RabbitMQ Setup] Error: " . $e->getMessage() . "\n";
    // We don't exit with 1 here to avoid blocking container startup if RabbitMQ is temporarily down
}

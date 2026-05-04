<?php
require_once __DIR__ . '/load.php';
use FOSSBilling\RabbitMQService;

try {
    $rabbit = new RabbitMQService();
    echo "Attempting to log to Control Room...\n";
    $rabbit->logToControlRoom('INFO', 'Test log message');
    echo "Log attempt finished.\n";
    
    echo "Attempting to send status check...\n";
    $rabbit->sendStatusCheck('test_service', 100, 0.1, 0.1);
    echo "Status check attempt finished.\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}

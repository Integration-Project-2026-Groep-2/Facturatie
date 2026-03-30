#!/usr/bin/env php
<?php

declare(strict_types=1);

if (php_sapi_name() !== 'cli') {
    exit('This script can only be run from the command line.');
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'load.php';

use FOSSBilling\RabbitMQService;

$serviceId = (string) (getenv('HEARTBEAT_SERVICE_ID') ?: getenv('SERVICE_ID') ?: 'facturatie');
$routingKey = (string) (getenv('HEARTBEAT_ROUTING_KEY') ?: 'facturatie.heartbeat');
$heartbeatExchange = trim((string) (getenv('HEARTBEAT_EXCHANGE') ?: ''));
$intervalMs = (int) (getenv('HEARTBEAT_INTERVAL_MS') ?: 1000);
$intervalMs = max(100, $intervalMs);
$intervalMicros = $intervalMs * 1000;

$running = true;

if (function_exists('pcntl_async_signals')) {
    pcntl_async_signals(true);
    pcntl_signal(SIGTERM, static function () use (&$running): void {
        $running = false;
    });
    pcntl_signal(SIGINT, static function () use (&$running): void {
        $running = false;
    });
}

$rabbit = null;

while ($running) {
    try {
        if (!$rabbit instanceof RabbitMQService) {
            $rabbit = new RabbitMQService([
                'exchange' => $heartbeatExchange !== '' ? $heartbeatExchange : 'heartbeat.direct',
            ]);
        }

        $rabbit->publishHeartbeat($serviceId, $routingKey);
    } catch (\Throwable $exception) {
        error_log('[heartbeat] ' . $exception->getMessage());

        if ($rabbit instanceof RabbitMQService) {
            $rabbit->close();
        }

        $rabbit = null;
    }

    usleep($intervalMicros);
}

if ($rabbit instanceof RabbitMQService) {
    $rabbit->close();
}

#!/usr/bin/env php
<?php

declare(strict_types=1);

if (php_sapi_name() !== 'cli') {
    exit('This script can only be run from the command line.');
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'load.php';

use FOSSBilling\RabbitMQService;

$startTime = time();
$serviceId = (string) (getenv('SERVICE_ID') ?: 'facturatie');
$interval = 120; // 2 minutes

$di['logger']->setChannel('application')->info('[status-check] Starting status check process');

$rabbit = null;

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

while ($running) {
    try {
        if (!$rabbit instanceof RabbitMQService) {
            $rabbit = new RabbitMQService();
        }

        $uptime = time() - $startTime;
        
        // Memory usage (0.0 to 1.0)
        $memUsage = memory_get_usage(true);
        $memLimitStr = ini_get('memory_limit');
        $memLimit = 128 * 1024 * 1024; // Default
        if ($memLimitStr && $memLimitStr !== '-1') {
            $unit = strtolower(substr($memLimitStr, -1));
            $memLimit = (int) $memLimitStr;
            switch($unit) {
                case 'g': $memLimit *= 1024;
                case 'm': $memLimit *= 1024;
                case 'k': $memLimit *= 1024;
            }
        }
        $memory = min(1.0, $memUsage / $memLimit);

        // Disk usage (0.0 to 1.0)
        $diskTotal = disk_total_space('/') ?: 1;
        $diskFree = disk_free_space('/') ?: 0;
        $disk = min(1.0, ($diskTotal - $diskFree) / $diskTotal);

        $rabbit->sendStatusCheck($serviceId, $uptime, $memory, $disk);
        
        $di['logger']->setChannel('application')->debug(sprintf(
            '[status-check] Sent status check (uptime=%d, memory=%.2f, disk=%.2f)',
            $uptime,
            $memory,
            $disk
        ));

    } catch (\Throwable $exception) {
        $di['logger']->setChannel('application')->err(sprintf(
            '[status-check] Failed to send status check (exception=%s, message=%s)',
            get_class($exception),
            $exception->getMessage()
        ));

        if ($rabbit instanceof RabbitMQService) {
            $rabbit->close();
        }
        $rabbit = null;
    }

    // Wait for the interval, but allow for faster exit on signal
    for ($i = 0; $i < $interval && $running; $i++) {
        sleep(1);
        if (function_exists('pcntl_signal_dispatch')) {
            pcntl_signal_dispatch();
        }
    }
}

if ($rabbit instanceof RabbitMQService) {
    $rabbit->close();
}

$di['logger']->setChannel('application')->info('[status-check] Status check process stopped');

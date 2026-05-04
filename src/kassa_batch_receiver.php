#!/usr/bin/env php
<?php

/**
 * Kassa Batch Receiver — Entrypoint (Contract K-02)
 *
 * Luistert naar de dagafsluitbatch van Kassa:
 *  - kassa.closed (BatchClosed) → individuele facturen per gebruiker + bedrijfsfactuur
 *
 * Gebruik (in container):
 *   php /var/www/html/kassa_batch_receiver.php
 */

declare(strict_types=1);

if (php_sapi_name() !== 'cli') {
    exit('This script can only be run from the command line.');
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'load.php';

use FOSSBilling\KassaBatchReceiverService;
use FOSSBilling\RabbitMQService;
use PhpAmqpLib\Exception\AMQPTimeoutException;
use PhpAmqpLib\Message\AMQPMessage;

// Initialize START_TIME and LAST_STATUS_CHECK
$startTime = time();
$lastStatusCheck = 0;
$serviceId = 'kassa_batch_receiver';

// Initialize RabbitMQ for logging
try {
    $rabbit = new RabbitMQService();
} catch (\Throwable $e) {
    error_log("[FATAL] Could not initialize RabbitMQ for logging: " . $e->getMessage());
    exit(1);
}

// DB connectivity check
try {
    $di['db']->exec('SELECT 1');
    $di['logger']->setChannel($serviceId)->debug("Database connection successful.");
} catch (\Throwable $e) {
    $di['logger']->setChannel($serviceId)->err("Database connection failed: " . $e->getMessage());
    exit(1);
}

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

$exchange     = (string) (getenv('KASSA_BATCH_EXCHANGE')          ?: 'kassa.topic');
$queue        = (string) (getenv('KASSA_BATCH_QUEUE')             ?: 'facturatie.kassa.batch.closed');
$prefetch     = max(1,   (int)   (getenv('KASSA_BATCH_PREFETCH')  ?: 1));
$waitTimeout  = max(0.1, (float) (getenv('KASSA_BATCH_WAIT_TIMEOUT_SEC') ?: 1.0));
$routingKey   = 'kassa.closed';

$msg = 'Starting kassa batch receiver process';
$di['logger']->setChannel($serviceId)->info($msg);

$rabbit = null;
$receiverService = new KassaBatchReceiverService($di);

while ($running) {
    try {
        if (!$rabbit instanceof RabbitMQService || !$rabbit->getChannel()->is_open()) {
            $rabbit = new RabbitMQService(['exchange' => $exchange]);

            $rabbit->declareAndBindQueue($queue, $routingKey, true);
            $rabbit->setPrefetchCount($prefetch);

            $callback = static function (AMQPMessage $message) use ($rabbit, $receiverService, $di, $routingKey, $serviceId): void {
                $body        = $message->getBody();
                $deliveryTag = $message->getDeliveryTag();

                try {
                    $rabbit->validateXMLForRoutingKey($routingKey, $body);

                    $result = $receiverService->process($routingKey, $body);

                    $msg = sprintf(
                        'Processed message (routing_key=%s, result=%s, delivery_tag=%s)',
                        $routingKey,
                        $result,
                        (string) $deliveryTag
                    );
                    $di['logger']->setChannel($serviceId)->info($msg);

                    $message->getChannel()->basic_ack($deliveryTag);
                } catch (\InvalidArgumentException $exception) {
                    $msg = sprintf(
                        'REJECTED: XML validation or parsing failed (routing_key=%s, delivery_tag=%s, reason=%s)',
                        $routingKey,
                        (string) $deliveryTag,
                        $exception->getMessage()
                    );
                    $di['logger']->setChannel($serviceId)->err($msg);
                    $di['logger']->setChannel($serviceId)->debug(sprintf('Rejected XML payload: %s', substr($body, 0, 1000)));

                    $message->getChannel()->basic_ack($deliveryTag);
                } catch (\Throwable $exception) {
                    $msg = sprintf(
                        'Processing failure (routing_key=%s, delivery_tag=%s, exception=%s, message=%s)',
                        $routingKey,
                        (string) $deliveryTag,
                        get_class($exception),
                        $exception->getMessage()
                    );
                    $di['logger']->setChannel($serviceId)->err($msg);
                    $message->getChannel()->basic_nack($deliveryTag, false, false);
                }
            };

            $rabbit->consumeQueue($queue, $callback);

            $di['logger']->setChannel('application')->info(sprintf(
                '[kassa-batch-receiver] Connected to exchange=%s queue=%s routing_key=%s',
                $exchange,
                $queue,
                $routingKey
            ));
        }

        if ($rabbit->hasCallbacks()) {
            $rabbit->waitForMessages($waitTimeout);
        }

        // Status check every 2 minutes
        if (time() - $lastStatusCheck >= 120) {
            $uptime = time() - $startTime;
            
            // Memory usage (0.0 to 1.0)
            $memUsage = memory_get_usage(true);
            $memLimit = (int) ini_get('memory_limit');
            if ($memLimit <= 0) $memLimit = 128 * 1024 * 1024; // fallback
            $memory = min(1.0, $memUsage / $memLimit);

            // Disk usage (0.0 to 1.0)
            $diskTotal = disk_total_space('/') ?: 1;
            $diskFree = disk_free_space('/') ?: 0;
            $disk = min(1.0, ($diskTotal - $diskFree) / $diskTotal);

            $rabbit->sendStatusCheck($serviceId, $uptime, $memory, $disk);
            $lastStatusCheck = time();
        }
    } catch (AMQPTimeoutException) {
        continue;
    } catch (\Throwable $exception) {
        $msg = sprintf(
            'Receiver loop error (exception=%s, message=%s)',
            get_class($exception),
            $exception->getMessage()
        );
        $di['logger']->setChannel($serviceId)->err($msg);

        if ($rabbit instanceof RabbitMQService) {
            $rabbit->close();
        }

        $rabbit = null;
        usleep(500_000);
    }
}

if ($rabbit instanceof RabbitMQService) {
    $rabbit->close();
}

$di['logger']->setChannel('application')->info('[kassa-batch-receiver] Receiver stopped');

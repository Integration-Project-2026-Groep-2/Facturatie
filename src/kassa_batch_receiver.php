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

$di['logger']->setChannel('application')->info('[kassa-batch-receiver] Starting kassa batch receiver process');

$rabbit = null;
$receiverService = new KassaBatchReceiverService($di);

while ($running) {
    try {
        if (!$rabbit instanceof RabbitMQService) {
            $rabbit = new RabbitMQService(['exchange' => $exchange]);

            $rabbit->declareAndBindQueue($queue, $routingKey, true);
            $rabbit->setPrefetchCount($prefetch);

            $callback = static function (AMQPMessage $message) use ($rabbit, $receiverService, $di, $routingKey): void {
                $body        = $message->getBody();
                $deliveryTag = $message->getDeliveryTag();

                try {
                    $rabbit->validateXMLForRoutingKey($routingKey, $body);

                    $result = $receiverService->process($routingKey, $body);

                    $di['logger']->setChannel('application')->info(sprintf(
                        '[kassa-batch-receiver] Processed message (routing_key=%s, result=%s, delivery_tag=%s)',
                        $routingKey,
                        $result,
                        (string) $deliveryTag
                    ));

                    $message->getChannel()->basic_ack($deliveryTag);
                } catch (\InvalidArgumentException $exception) {
                    $di['logger']->setChannel('application')->err(sprintf(
                        '[kassa-batch-receiver] Invalid message: XSD/parsing fout (routing_key=%s, delivery_tag=%s, exception=%s, message=%s)',
                        $routingKey,
                        (string) $deliveryTag,
                        get_class($exception),
                        $exception->getMessage()
                    ));
                    $message->getChannel()->basic_ack($deliveryTag);
                } catch (\Throwable $exception) {
                    $di['logger']->setChannel('application')->err(sprintf(
                        '[kassa-batch-receiver] Processing failure (routing_key=%s, delivery_tag=%s, exception=%s, message=%s)',
                        $routingKey,
                        (string) $deliveryTag,
                        get_class($exception),
                        $exception->getMessage()
                    ));
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
    } catch (AMQPTimeoutException) {
        continue;
    } catch (\Throwable $exception) {
        $di['logger']->setChannel('application')->err(sprintf(
            '[kassa-batch-receiver] Receiver loop error (exception=%s, message=%s)',
            get_class($exception),
            $exception->getMessage()
        ));

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

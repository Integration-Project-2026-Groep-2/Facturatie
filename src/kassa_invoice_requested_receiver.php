#!/usr/bin/env php
<?php

declare(strict_types=1);

if (php_sapi_name() !== 'cli') {
    exit('This script can only be run from the command line.');
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'load.php';

use FOSSBilling\KassaInvoiceRequestedReceiverService;
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

$exchange = (string) (getenv('KASSA_TOPIC_EXCHANGE') ?: 'kassa.topic');
$queue = (string) (getenv('KASSA_INVOICE_REQUESTED_QUEUE') ?: 'facturatie.kassa.invoice.requested');
$routingKey = 'kassa.invoice.requested';
$prefetchCount = max(1, (int) (getenv('KASSA_INVOICE_PREFETCH') ?: 10));
$waitTimeout = max(0.1, (float) (getenv('KASSA_INVOICE_WAIT_TIMEOUT_SEC') ?: 1.0));

$di['logger']->setChannel('application')->info('[kassa-invoice-receiver] Starting Kassa invoice requested receiver process');

$rabbit = null;
$receiverService = new KassaInvoiceRequestedReceiverService($di);

while ($running) {
    try {
        if (!$rabbit instanceof RabbitMQService) {
            $rabbit = new RabbitMQService([
                'exchange' => $exchange,
            ]);

            $rabbit->declareExchange($exchange, 'topic', true);
            $rabbit->declareAndBindQueue($queue, $routingKey, true, $exchange);
            $rabbit->setPrefetchCount($prefetchCount);

            $callback = static function (AMQPMessage $message) use ($rabbit, $receiverService, $di): void {
                $routingKey = (string) $message->getRoutingKey();
                $body = $message->getBody();
                $deliveryTag = $message->getDeliveryTag();

                try {
                    // Validate database connection before processing
                    try {
                        $di['validateDatabaseConnection']();
                    } catch (\PDOException $connException) {
                        // Connection is stale; NACK to requeue and force restart
                        $di['logger']->setChannel('application')->warn(sprintf(
                            '[kassa-invoice-receiver] Stale database connection detected; requeueing message (routing_key=%s, delivery_tag=%s)',
                            $routingKey,
                            (string) $deliveryTag
                        ));
                        $message->getChannel()->basic_nack($deliveryTag, false, true);
                        return;
                    }

                    $rabbit->validateXMLForRoutingKey($routingKey, $body);
                    $result = $receiverService->process($routingKey, $body);

                    $di['logger']->setChannel('application')->info(sprintf(
                        '[kassa-invoice-receiver] Processed message (routing_key=%s, result=%s, delivery_tag=%s)',
                        $routingKey,
                        $result,
                        (string) $deliveryTag
                    ));
                    $message->getChannel()->basic_ack($deliveryTag);
                } catch (\InvalidArgumentException $exception) {
                    $di['logger']->setChannel('application')->err(sprintf(
                        '[kassa-invoice-receiver] Invalid message (routing_key=%s, delivery_tag=%s, exception=%s, message=%s)',
                        $routingKey,
                        (string) $deliveryTag,
                        get_class($exception),
                        $exception->getMessage()
                    ));
                    $message->getChannel()->basic_ack($deliveryTag);
                } catch (\Throwable $exception) {
                    $di['logger']->setChannel('application')->err(sprintf(
                        '[kassa-invoice-receiver] Processing failure (routing_key=%s, delivery_tag=%s, exception=%s, message=%s)',
                        $routingKey,
                        (string) $deliveryTag,
                        get_class($exception),
                        $exception->getMessage()
                    ));
                    $message->getChannel()->basic_nack($deliveryTag, false, false);
                }
            };

            $rabbit->consumeQueue($queue, $callback);

            $di['logger']->setChannel('application')->info(sprintf('[kassa-invoice-receiver] Connected to exchange=%s queue=%s', $exchange, $queue));
        }

        if ($rabbit->hasCallbacks()) {
            $rabbit->waitForMessages($waitTimeout);
        }


    } catch (AMQPTimeoutException) {
        continue;
    } catch (\Throwable $exception) {
        $di['logger']->setChannel('application')->err(sprintf(
            '[kassa-invoice-receiver] Receiver loop error (exception=%s, message=%s)',
            get_class($exception),
            $exception->getMessage()
        ));

        if ($rabbit instanceof RabbitMQService) {
            $rabbit->close();
        }

        $rabbit = null;
        usleep(500000);
    }
}

if ($rabbit instanceof RabbitMQService) {
    $rabbit->close();
}

$di['logger']->setChannel('application')->info('[kassa-invoice-receiver] Receiver stopped');

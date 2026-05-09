#!/usr/bin/env php
<?php

/**
 * CRM Company Receiver — Entrypoint
 *
 * Luistert naar CRM bedrijfssynchronisatie berichten:
 *  - crm.company.confirmed   (Contract 14) → bedrijf aanmaken/updaten
 *  - crm.company.updated     (Contract 19) → bedrijf volledig updaten
 *  - crm.company.deactivated (Contract 23) → bedrijf deactiveren (soft delete)
 *
 * Gebruik (in container):
 *   php /var/www/html/crm_company_receiver.php
 */

declare(strict_types=1);

if (php_sapi_name() !== 'cli') {
    exit('This script can only be run from the command line.');
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'load.php';

use FOSSBilling\CrmCompanyReceiverService;
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

// Configuratie via environment variabelen
$exchange          = (string) (getenv('CRM_COMPANY_EXCHANGE')            ?: 'contact.topic');
$confirmedQueue    = (string) (getenv('CRM_COMPANY_CONFIRMED_QUEUE')     ?: 'facturatie.company.confirmed');
$updatedQueue      = (string) (getenv('CRM_COMPANY_UPDATED_QUEUE')       ?: 'facturatie.company.updated');
$deactivatedQueue  = (string) (getenv('CRM_COMPANY_DEACTIVATED_QUEUE')   ?: 'facturatie.company.deactivated');
$prefetchCount     = max(1,   (int)   (getenv('CRM_COMPANY_PREFETCH')    ?: 5));
$waitTimeout       = max(0.1, (float) (getenv('CRM_COMPANY_WAIT_TIMEOUT_SEC') ?: 1.0));

$di['logger']->setChannel('application')->info('[crm-company-receiver] Starting CRM company receiver process');

$rabbit = null;
$receiverService = new CrmCompanyReceiverService($di);

while ($running) {
    try {
        if (!$rabbit instanceof RabbitMQService) {
            $rabbit = new RabbitMQService(['exchange' => $exchange]);

            // Queues declareren en binden aan de routing keys
            $rabbit->declareAndBindQueue($confirmedQueue,   'crm.company.confirmed',   true);
            $rabbit->declareAndBindQueue($updatedQueue,     'crm.company.updated',     true);
            $rabbit->declareAndBindQueue($deactivatedQueue, 'crm.company.deactivated', true);
            $rabbit->setPrefetchCount($prefetchCount);

            $callback = static function (AMQPMessage $message) use ($rabbit, $receiverService, $di): void {
                $routingKey  = (string) $message->getRoutingKey();
                $body        = $message->getBody();
                $deliveryTag = $message->getDeliveryTag();

                try {
                    // Validate database connection before processing
                    try {
                        $di['validateDatabaseConnection']();
                    } catch (\PDOException $connException) {
                        // Connection is stale; NACK to requeue and force restart
                        $di['logger']->setChannel('application')->warn(sprintf(
                            '[crm-company-receiver] Stale database connection detected; requeueing message (routing_key=%s, delivery_tag=%s)',
                            $routingKey,
                            (string) $deliveryTag
                        ));
                        $message->getChannel()->basic_nack($deliveryTag, false, true);
                        return;
                    }

                    // Stap 1: XSD validatie
                    $rabbit->validateXMLForRoutingKey($routingKey, $body);

                    // Stap 2: Verwerken
                    $result = $receiverService->process($routingKey, $body);

                    $di['logger']->setChannel('application')->info(sprintf(
                        '[crm-company-receiver] Processed message (routing_key=%s, result=%s, delivery_tag=%s)',
                        $routingKey,
                        $result,
                        (string) $deliveryTag
                    ));

                    $message->getChannel()->basic_ack($deliveryTag);
                } catch (\InvalidArgumentException $exception) {
                    // XSD of parsing fout — bericht is ongeldig, weggooien (ACK)
                    $di['logger']->setChannel('application')->err(sprintf(
                        '[crm-company-receiver] Invalid message: XSD/parsing fout (routing_key=%s, delivery_tag=%s, exception=%s, message=%s)',
                        $routingKey,
                        (string) $deliveryTag,
                        get_class($exception),
                        $exception->getMessage()
                    ));
                    $message->getChannel()->basic_ack($deliveryTag);
                } catch (\Throwable $exception) {
                    // Onverwachte fout — NACK zodat bericht terug naar queue gaat
                    $di['logger']->setChannel('application')->err(sprintf(
                        '[crm-company-receiver] Processing failure (routing_key=%s, delivery_tag=%s, exception=%s, message=%s)',
                        $routingKey,
                        (string) $deliveryTag,
                        get_class($exception),
                        $exception->getMessage()
                    ));
                    $message->getChannel()->basic_nack($deliveryTag, false, false);
                }
            };

            $rabbit->consumeQueue($confirmedQueue,   $callback);
            $rabbit->consumeQueue($updatedQueue,     $callback);
            $rabbit->consumeQueue($deactivatedQueue, $callback);

            $di['logger']->setChannel('application')->info(sprintf(
                '[crm-company-receiver] Connected to exchange=%s queues=[%s, %s, %s]',
                $exchange,
                $confirmedQueue,
                $updatedQueue,
                $deactivatedQueue
            ));
        }

        if ($rabbit->hasCallbacks()) {
            $rabbit->waitForMessages($waitTimeout);
        }


    } catch (AMQPTimeoutException) {
        continue;
    } catch (\Throwable $exception) {
        $di['logger']->setChannel('application')->err(sprintf(
            '[crm-company-receiver] Receiver loop error (exception=%s, message=%s)',
            get_class($exception),
            $exception->getMessage()
        ));

        if ($rabbit instanceof RabbitMQService) {
            $rabbit->close();
        }

        $rabbit = null;
        usleep(500_000); // 0.5s wachten voor herverbinding
    }
}

if ($rabbit instanceof RabbitMQService) {
    $rabbit->close();
}

$di['logger']->setChannel('application')->info('[crm-company-receiver] Receiver stopped');

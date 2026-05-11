#!/usr/bin/env php
<?php

declare(strict_types=1);

if (php_sapi_name() !== 'cli') {
    exit('This script can only be run from the command line.');
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'load.php';

use FOSSBilling\CrmUserReceiverService;
use FOSSBilling\MissingCompanyDependencyException;
use FOSSBilling\RabbitMQService;
use PhpAmqpLib\Exception\AMQPTimeoutException;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

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

$exchange = (string) (getenv('CRM_CONTACT_EXCHANGE') ?: 'contact.topic');
$confirmedQueue = (string) (getenv('CRM_USER_CONFIRMED_QUEUE') ?: 'facturatie.user.confirmed');
$updatedQueue = (string) (getenv('CRM_USER_UPDATED_QUEUE') ?: 'facturatie.user.updated');
$deactivatedQueue = (string) (getenv('CRM_USER_DEACTIVATED_QUEUE') ?: 'facturatie.user.deactivated');
$prefetchCount = max(1, (int) (getenv('CRM_USER_PREFETCH') ?: 10));
$waitTimeout = max(0.1, (float) (getenv('CRM_USER_WAIT_TIMEOUT_SEC') ?: 1.0));
$retryExchange = (string) (getenv('CRM_USER_RETRY_EXCHANGE') ?: 'contact.retry');
$retryRoutingKeyConfirmed = (string) (getenv('CRM_USER_RETRY_CONFIRMED_ROUTING_KEY') ?: 'crm.user.retry.confirmed');
$retryRoutingKeyUpdated = (string) (getenv('CRM_USER_RETRY_UPDATED_ROUTING_KEY') ?: 'crm.user.retry.updated');
$retryQueueConfirmed = (string) (getenv('CRM_USER_RETRY_CONFIRMED_QUEUE') ?: 'facturatie.user.confirmed.retry');
$retryQueueUpdated = (string) (getenv('CRM_USER_RETRY_UPDATED_QUEUE') ?: 'facturatie.user.updated.retry');
$retryDelayMs = max(1000, (int) (getenv('CRM_USER_RETRY_DELAY_MS') ?: 30000));
$maxRetryCount = max(1, (int) (getenv('CRM_USER_MAX_RETRIES') ?: 10));
$parkingExchange = (string) (getenv('CRM_USER_PARKING_EXCHANGE') ?: 'contact.parking');
$parkingQueueConfirmed = (string) (getenv('CRM_USER_PARKING_CONFIRMED_QUEUE') ?: 'facturatie.user.confirmed.parking');
$parkingQueueUpdated = (string) (getenv('CRM_USER_PARKING_UPDATED_QUEUE') ?: 'facturatie.user.updated.parking');
$parkingRoutingPrefix = (string) (getenv('CRM_USER_PARKING_ROUTING_PREFIX') ?: 'crm.user.parking');

$di['logger']->setChannel('application')->info('[crm-user-receiver] Starting CRM user receiver process');

$rabbit = null;
$receiverService = new CrmUserReceiverService($di);

while ($running) {
    try {
        if (!$rabbit instanceof RabbitMQService) {
            $rabbit = new RabbitMQService([
                'exchange' => $exchange,
            ]);

            $rabbit->declareAndBindQueue($confirmedQueue, 'crm.user.confirmed', true);
            $rabbit->declareAndBindQueue($updatedQueue, 'crm.user.updated', true);
            $rabbit->declareAndBindQueue($deactivatedQueue, 'crm.user.deactivated', true);
            $rabbit->declareExchange($retryExchange, 'direct', true);
            $rabbit->declareAndBindQueue($retryQueueConfirmed, $retryRoutingKeyConfirmed, true, $retryExchange, [
                'x-message-ttl' => $retryDelayMs,
                'x-dead-letter-exchange' => $exchange,
                'x-dead-letter-routing-key' => 'crm.user.confirmed',
            ]);
            $rabbit->declareAndBindQueue($retryQueueUpdated, $retryRoutingKeyUpdated, true, $retryExchange, [
                'x-message-ttl' => $retryDelayMs,
                'x-dead-letter-exchange' => $exchange,
                'x-dead-letter-routing-key' => 'crm.user.updated',
            ]);

            $rabbit->declareExchange($parkingExchange, 'direct', true);
            $rabbit->declareAndBindQueue($parkingQueueConfirmed, $parkingRoutingPrefix . '.confirmed', true, $parkingExchange);
            $rabbit->declareAndBindQueue($parkingQueueUpdated, $parkingRoutingPrefix . '.updated', true, $parkingExchange);
            $rabbit->setPrefetchCount($prefetchCount);

            $callback = static function (AMQPMessage $message) use (
                $rabbit,
                $receiverService,
                $di,
                $retryExchange,
                $retryRoutingKeyConfirmed,
                $retryRoutingKeyUpdated,
                $retryQueueConfirmed,
                $retryQueueUpdated,
                $maxRetryCount,
                $parkingExchange,
                $parkingRoutingPrefix
            ): void {
                $routingKey = (string) $message->getRoutingKey();
                $body = $message->getBody();
                $deliveryTag = $message->getDeliveryTag();
                $retryCount = getRetryCount($message);

                try {
                    // Validate database connection before processing
                    try {
                        $di['validateDatabaseConnection']();
                    } catch (\PDOException $connException) {
                        // Recovery failed even after refresh attempt in DI
                        $di['logger']->setChannel('application')->err(sprintf(
                            '[crm-user-receiver] Persistent database connection failure; requeueing message (routing_key=%s, delivery_tag=%s, message=%s)',
                            $routingKey,
                            (string) $deliveryTag,
                            $connException->getMessage()
                        ));
                        $message->getChannel()->basic_nack($deliveryTag, false, true);
                        usleep(1000000); // 1s sleep to avoid tight loop
                        return;
                    }

                    $rabbit->validateXMLForRoutingKey($routingKey, $body);
                    $result = $receiverService->process($routingKey, $body);

                    $di['logger']->setChannel('application')->info(sprintf(
                        '[crm-user-receiver] Processed message (routing_key=%s, result=%s, retry_count=%d, delivery_tag=%s)',
                        $routingKey,
                        $result,
                        $retryCount,
                        (string) $deliveryTag
                    ));
                    $message->getChannel()->basic_ack($deliveryTag);
                } catch (\InvalidArgumentException $exception) {
                    $di['logger']->setChannel('application')->err(sprintf(
                        '[crm-user-receiver] Invalid message (routing_key=%s, retry_count=%d, delivery_tag=%s, exception=%s, message=%s)',
                        $routingKey,
                        $retryCount,
                        (string) $deliveryTag,
                        get_class($exception),
                        $exception->getMessage()
                    ));
                    $message->getChannel()->basic_ack($deliveryTag);
                } catch (MissingCompanyDependencyException $exception) {
                    $nextRetryCount = $retryCount + 1;

                    if ($nextRetryCount > $maxRetryCount) {
                        $parkingRoutingKey = getParkingRoutingKey($routingKey, $parkingRoutingPrefix);
                        $rabbit->publishRaw($parkingExchange, $parkingRoutingKey, $body, [
                            'application_headers' => new AMQPTable([
                                'x-retry-count' => $retryCount,
                                'x-error' => 'missing-company-dependency',
                                'x-missing-company-id' => $exception->getCompanyId(),
                                'x-original-routing-key' => $routingKey,
                            ]),
                        ]);

                        $di['logger']->setChannel('application')->err(sprintf(
                            '[crm-user-receiver] Refused message permanently after retries (routing_key=%s, reason=missing-company-dependency, retry_count=%d, max_retries=%d, delivery_tag=%s, missing_company_id=%s)',
                            $routingKey,
                            $retryCount,
                            $maxRetryCount,
                            (string) $deliveryTag,
                            $exception->getCompanyId()
                        ));
                        $message->getChannel()->basic_ack($deliveryTag);

                        return;
                    }

                    $retryQueue = $routingKey === 'crm.user.confirmed' ? $retryQueueConfirmed : $retryQueueUpdated;
                    $retryRoutingKey = $routingKey === 'crm.user.confirmed' ? $retryRoutingKeyConfirmed : $retryRoutingKeyUpdated;

                    $rabbit->publishRaw($retryExchange, $retryRoutingKey, $body, [
                        'application_headers' => new AMQPTable([
                            'x-retry-count' => $nextRetryCount,
                            'x-error' => 'missing-company-dependency',
                            'x-missing-company-id' => $exception->getCompanyId(),
                            'x-original-routing-key' => $routingKey,
                            'x-retry-queue' => $retryQueue,
                        ]),
                    ]);

                    $di['logger']->setChannel('application')->warn(sprintf(
                        '[crm-user-receiver] Refused message for now; scheduled retry (routing_key=%s, reason=missing-company-dependency, retry_count=%d, max_retries=%d, retry_queue=%s, delivery_tag=%s, missing_company_id=%s)',
                        $routingKey,
                        $nextRetryCount,
                        $maxRetryCount,
                        $retryQueue,
                        (string) $deliveryTag,
                        $exception->getCompanyId()
                    ));
                    $message->getChannel()->basic_ack($deliveryTag);
                } catch (\Throwable $exception) {
                    $di['logger']->setChannel('application')->err(sprintf(
                        '[crm-user-receiver] Processing failure (routing_key=%s, retry_count=%d, delivery_tag=%s, exception=%s, message=%s)',
                        $routingKey,
                        $retryCount,
                        (string) $deliveryTag,
                        get_class($exception),
                        $exception->getMessage()
                    ));
                    $message->getChannel()->basic_nack($deliveryTag, false, false);
                }
            };

            $rabbit->consumeQueue($confirmedQueue, $callback);
            $rabbit->consumeQueue($updatedQueue, $callback);
            $rabbit->consumeQueue($deactivatedQueue, $callback);

            $di['logger']->setChannel('application')->info(sprintf('[crm-user-receiver] Connected to exchange=%s queues=[%s,%s,%s]', $exchange, $confirmedQueue, $updatedQueue, $deactivatedQueue));
        }

        if ($rabbit->hasCallbacks()) {
            $rabbit->waitForMessages($waitTimeout);
        }


    } catch (AMQPTimeoutException) {
        continue;
    } catch (\Throwable $exception) {
        $di['logger']->setChannel('application')->err(sprintf(
            '[crm-user-receiver] Receiver loop error (exception=%s, message=%s)',
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

$di['logger']->setChannel('application')->info('[crm-user-receiver] Receiver stopped');

function getRetryCount(AMQPMessage $message): int
{
    if (!$message->has('application_headers')) {
        return 0;
    }

    $headers = $message->get('application_headers');
    if (!$headers instanceof AMQPTable) {
        return 0;
    }

    $nativeData = $headers->getNativeData();
    $count = $nativeData['x-retry-count'] ?? 0;

    return max(0, (int) $count);
}

function getParkingRoutingKey(string $routingKey, string $prefix): string
{
    return match ($routingKey) {
        'crm.user.confirmed' => $prefix . '.confirmed',
        'crm.user.updated' => $prefix . '.updated',
        default => $prefix . '.unknown',
    };
}

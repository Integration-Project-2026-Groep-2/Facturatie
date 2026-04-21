<?php

declare(strict_types=1);
/**
 * Copyright 2022-2025 FOSSBilling
 * Copyright 2011-2021 BoxBilling, Inc.
 * SPDX-License-Identifier: Apache-2.0.
 *
 * @copyright FOSSBilling (https://www.fossbilling.org)
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

namespace FOSSBilling;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class RabbitMQService
{
    private ?AMQPStreamConnection $connection = null;
    private ?AMQPChannel $channel = null;

    private string $host;
    private int $port;
    private string $user;
    private string $password;
    private string $vhost;
    private string $exchange;

    /** @var array<string, string> */
    private array $schemaPaths;

    public function __construct(?array $config = null)
    {
        $config ??= [];

        $this->host = (string) ($config['host'] ?? getenv('RABBITMQ_HOST') ?: 'rabbitmq');
        $this->port = (int) ($config['port'] ?? getenv('RABBITMQ_PORT') ?: 5672);
        $this->user = (string) ($config['user'] ?? getenv('RABBITMQ_USER') ?: getenv('RABBITMQ_DEFAULT_USER') ?: 'devuser');
        $this->password = (string) ($config['password'] ?? getenv('RABBITMQ_PASSWORD') ?: getenv('RABBITMQ_PASS') ?: getenv('RABBITMQ_DEFAULT_PASS') ?: 'devpass');
        $this->vhost = (string) ($config['vhost'] ?? getenv('RABBITMQ_VHOST') ?: '/');
        $this->exchange = (string) ($config['exchange'] ?? getenv('HEARTBEAT_EXCHANGE') ?: 'heartbeat.direct');

        $defaultSchemaPath = dirname(__DIR__, 2) . '/data/contracts/facturatie_contract.xsd';
        $defaultHeartbeatSchemaPath = dirname(__DIR__, 2) . '/data/contracts/hearbeat_contract.xsd';
        $defaultUserSchemaPath = dirname(__DIR__, 2) . '/data/contracts/user_data_contract.xsd';
        $defaultFacturatieUserSchemaPath = dirname(__DIR__, 2) . '/data/contracts/facturatie_user_contract.xsd';
        $defaultFacturatieCompanySchemaPath = dirname(__DIR__, 2) . '/data/contracts/facturatie_company_contract.xsd';

        $this->schemaPaths = $config['schema_paths'] ?? [
            'invoice.finalized' => $defaultSchemaPath,
            'facturatie.invoice.finalized' => $defaultSchemaPath,
            'facturatie.heartbeat' => $defaultHeartbeatSchemaPath,
            'routing.heartbeat' => $defaultHeartbeatSchemaPath,
            'facturatie.user.created' => $defaultFacturatieUserSchemaPath,
            'facturatie.user.updated' => $defaultFacturatieUserSchemaPath,
            'facturatie.user.deactivated' => $defaultFacturatieUserSchemaPath,
            'facturatie.company.created' => $defaultFacturatieCompanySchemaPath,
            'facturatie.company.updated' => $defaultFacturatieCompanySchemaPath,
            'facturatie.company.deactivated' => $defaultFacturatieCompanySchemaPath,
            'crm.user.confirmed' => $defaultUserSchemaPath,
            'crm.user.updated' => $defaultUserSchemaPath,
            'crm.user.deactivated' => $defaultUserSchemaPath,
        ];
    }

    public function publishHeartbeat(string $serviceId, string $routingKey = 'routing.heartbeat', ?\DateTimeInterface $timestamp = null): void
    {
        $timestamp ??= new \DateTimeImmutable('now', new \DateTimeZone('UTC'));

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $root = $dom->createElement('Heartbeat');
        $root->appendChild($dom->createElement('serviceId', $serviceId));
        $root->appendChild($dom->createElement('timestamp', $timestamp->format('Y-m-d\TH:i:sP')));
        $dom->appendChild($root);

        $this->publishXML($routingKey, $dom->saveXML() ?: '');
    }

    public function publishXML(string $routingKey, string $xml): void
    {
        $schemaPath = $this->schemaPaths[$routingKey] ?? null;
        if ($schemaPath === null) {
            throw new \InvalidArgumentException(sprintf('No XML schema configured for routing key "%s".', $routingKey));
        }

        $this->validateXml($xml, $schemaPath);

        $message = new AMQPMessage($xml, [
            'content_type' => 'application/xml',
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
        ]);

        $this->getChannel()->basic_publish($message, $this->exchange, $routingKey);
    }

    public function validateXMLForRoutingKey(string $routingKey, string $xml): void
    {
        $schemaPath = $this->schemaPaths[$routingKey] ?? null;
        if ($schemaPath === null) {
            throw new \InvalidArgumentException(sprintf('No XML schema configured for routing key "%s".', $routingKey));
        }

        $this->validateXml($xml, $schemaPath);
    }

    /**
     * @param array<string, mixed> $arguments
     */
    public function declareAndBindQueue(string $queueName, string $routingKey, bool $durable = true, ?string $exchangeName = null, array $arguments = []): void
    {
        $channel = $this->getChannel();
        $table = $arguments === [] ? null : new AMQPTable($arguments);
        $channel->queue_declare($queueName, false, $durable, false, false, false, $table);
        $channel->queue_bind($queueName, $exchangeName ?: $this->exchange, $routingKey);
    }

    public function declareExchange(string $exchangeName, string $type = 'topic', bool $durable = true): void
    {
        $this->getChannel()->exchange_declare($exchangeName, $type, false, $durable, false);
    }

    public function setPrefetchCount(int $prefetchCount): void
    {
        if ($prefetchCount < 1) {
            return;
        }

        $this->getChannel()->basic_qos(null, $prefetchCount, null);
    }

    public function consumeQueue(string $queueName, callable $callback, bool $autoAck = false, string $consumerTag = ''): void
    {
        $this->getChannel()->basic_consume($queueName, $consumerTag, false, $autoAck, false, false, $callback);
    }

    /**
     * @param array<string, mixed> $properties
     */
    public function publishRaw(string $exchangeName, string $routingKey, string $body, array $properties = []): void
    {
        $defaults = [
            'content_type' => 'application/xml',
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
        ];
        $message = new AMQPMessage($body, $properties + $defaults);
        $this->getChannel()->basic_publish($message, $exchangeName, $routingKey);
    }

    public function waitForMessages(float $timeoutSeconds = 1.0): void
    {
        $timeoutSeconds = max(0.0, $timeoutSeconds);
        $this->getChannel()->wait(null, false, $timeoutSeconds);
    }

    public function hasCallbacks(): bool
    {
        return $this->getChannel()->is_consuming();
    }

    public function getChannel(): AMQPChannel
    {
        if ($this->channel instanceof AMQPChannel) {
            return $this->channel;
        }

        $this->connection = new AMQPStreamConnection(
            $this->host,
            $this->port,
            $this->user,
            $this->password,
            $this->vhost
        );

        $this->channel = $this->connection->channel();
        $exchangeType = $this->exchange === 'heartbeat.direct' ? 'direct' : 'topic';
        $this->channel->exchange_declare($this->exchange, $exchangeType, false, true, false);

        return $this->channel;
    }

    public function close(): void
    {
        if ($this->channel instanceof AMQPChannel) {
            $this->channel->close();
            $this->channel = null;
        }

        if ($this->connection instanceof AMQPStreamConnection) {
            $this->connection->close();
            $this->connection = null;
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    private function validateXml(string $xml, string $schemaPath): void
    {
        if (!is_file($schemaPath)) {
            throw new \RuntimeException(sprintf('XSD schema file not found: %s', $schemaPath));
        }

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $previousUseInternalErrors = libxml_use_internal_errors(true);

        try {
            if (!$dom->loadXML($xml, LIBXML_NONET)) {
                throw new \InvalidArgumentException('Invalid XML payload: ' . $this->formatLibxmlErrors());
            }

            if (!$dom->schemaValidate($schemaPath)) {
                throw new \InvalidArgumentException('XML does not match schema: ' . $this->formatLibxmlErrors());
            }
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousUseInternalErrors);
        }
    }

    private function formatLibxmlErrors(): string
    {
        $errors = libxml_get_errors();
        if ($errors === []) {
            return 'Unknown libxml validation error';
        }

        $messages = [];
        foreach ($errors as $error) {
            $messages[] = trim($error->message);
        }

        return implode(' | ', array_unique($messages));
    }
}

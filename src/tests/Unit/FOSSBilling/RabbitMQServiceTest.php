<?php

declare(strict_types=1);

namespace Tests\Unit\FOSSBilling;

require_once __DIR__ . '/../../../library/FOSSBilling/RabbitMQService.php';

use FOSSBilling\RabbitMQService;
use PHPUnit\Framework\TestCase;

final class RabbitMQServiceTest extends TestCase
{
    public function testValidateXMLForRoutingKeyAcceptsValidConfirmedPayload(): void
    {
        $service = new RabbitMQService();
        $xml = $this->loadFixture('crm_user_confirmed_sample.xml');

        $service->validateXMLForRoutingKey('crm.user.confirmed', $xml);

        $this->addToAssertionCount(1);
    }

    public function testValidateXMLForRoutingKeyRejectsUnknownRoutingKey(): void
    {
        $service = new RabbitMQService();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('No XML schema configured for routing key');

        $service->validateXMLForRoutingKey('crm.user.unknown', '<UserConfirmed/>');
    }

    public function testValidateXMLForRoutingKeyRejectsInvalidPayloadAgainstSchema(): void
    {
        $service = new RabbitMQService();
        $invalidXml = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<UserConfirmed>
  <id>8a9b2a3e-6d1f-4b58-8c20-2f5f3f5c4d11</id>
  <email>company.contact@gmail.com</email>
  <firstName>Emma</firstName>
  <lastName>Janssens</lastName>
</UserConfirmed>
XML;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('XML does not match schema');

        $service->validateXMLForRoutingKey('crm.user.confirmed', $invalidXml);
    }

    public function testValidateXMLForRoutingKeyFailsWhenSchemaFileMissing(): void
    {
        $service = new RabbitMQService([
            'schema_paths' => [
                'crm.user.confirmed' => __DIR__ . '/missing-schema-file.xsd',
            ],
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('XSD schema file not found');

        $service->validateXMLForRoutingKey('crm.user.confirmed', $this->loadFixture('crm_user_confirmed_sample.xml'));
    }

    private function loadFixture(string $filename): string
    {
        $path = __DIR__ . '/../../../../test/' . $filename;
        $contents = file_get_contents($path);
        self::assertNotFalse($contents, 'Failed to load fixture: ' . $path);

        return $contents;
    }
}

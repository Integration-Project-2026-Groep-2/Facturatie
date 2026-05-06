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

use Pimple\Container;

class KassaInvoiceRequestedReceiverService
{
    public function __construct(private readonly Container $di)
    {
    }

    public function process(string $routingKey, string $xml): string
    {
        if ($routingKey !== 'kassa.invoice.requested') {
            throw new \InvalidArgumentException(sprintf('Unsupported routing key "%s" for kassa invoice requested receiver.', $routingKey));
        }

        $payload = $this->parseInvoiceRequested($xml);

        // 1. Upsert client
        $client = $this->upsertClient($payload['user']);

        // 2. Create invoice
        $invoiceId = $this->createInvoice($client, $payload);

        // 3. Publish finalized message
        $this->publishInvoiceFinalized($invoiceId, $payload['user']['email']);

        return 'processed';
    }

    private function upsertClient(array $userData): \Model_Client
    {
        $crmUserId = (string) $userData['userId'];
        $email = (string) $userData['email'];

        $client = $this->di['db']->findOne('Client', 'aid = ?', [$crmUserId]);
        if (!$client instanceof \Model_Client) {
            $client = $this->di['db']->findOne('Client', 'email = ?', [strtolower($email)]);
        }

        $clientService = $this->di['mod_service']('client');
        $data = [
            'aid' => $crmUserId,
            'email' => $email,
            'first_name' => (string) $userData['firstName'],
            'last_name' => (string) $userData['lastName'],
            'status' => \Model_Client::ACTIVE,
            'sync_origin' => 'kassa',
            'suppress_user_topic_publish' => true,
            'custom_2' => (string) $userData['role'],
            'custom_3' => (string) $userData['badgeCode'],
        ];

        if ($client instanceof \Model_Client) {
            // Update existing
            $client->aid = $data['aid'];
            $client->email = strtolower($data['email']);
            $client->first_name = $data['first_name'];
            $client->last_name = $data['last_name'];
            $client->custom_2 = $data['custom_2'];
            $client->custom_3 = $data['custom_3'];
            $client->updated_at = date('Y-m-d H:i:s');
            $this->di['db']->store($client);
            
            return $client;
        }

        // Create new
        $data['password'] = bin2hex(random_bytes(8)) . 'Aa1!';
        $clientId = $clientService->adminCreateClient($data);

        return $this->di['db']->getExistingModelById('Client', $clientId);
    }

    private function createInvoice(\Model_Client $client, array $payload): int
    {
        $invoiceService = $this->di['mod_service']('Invoice');

        $invoice = $invoiceService->prepareInvoice($client, [
            'text_1' => sprintf('Kassa Order %s — %s', $payload['orderId'], $payload['orderedAt']),
        ]);

        $invoiceItemService = $this->di['mod_service']('Invoice', 'InvoiceItem');
        foreach ($payload['items'] as $item) {
            $invoiceItemService->addNew($invoice, [
                'title'    => $item['productName'],
                'price'    => $item['unitPrice'],
                'quantity' => $item['quantity'],
                'taxed'    => false,
            ]);
        }

        $invoice->notes = sprintf(
            'Kassa Invoice Request | orderId: %s | orderedAt: %s | ref: %s',
            $payload['orderId'],
            $payload['orderedAt'],
            $payload['paymentReference'] ?? 'N/A'
        );
        $invoice->updated_at = date('Y-m-d H:i:s');
        $this->di['db']->store($invoice);

        $invoiceService->approveInvoice($invoice, ['id' => $invoice->id]);

        return (int) $invoice->id;
    }

    private function publishInvoiceFinalized(int $invoiceId, string $recipientEmail): void
    {
        try {
            $invoice = $this->di['db']->getExistingModelById('Invoice', $invoiceId);
            $invoiceService = $this->di['mod_service']('Invoice');
            $invoiceArray = $invoiceService->toApiArray($invoice, false, null);

            $pdfBaseUrl = (string) (getenv('APP_URL') ?: 'http://localhost:8080');
            $pdfUrl = rtrim($pdfBaseUrl, '/') . '/invoice/pdf/' . ($invoiceArray['hash'] ?? '');

            $dom = new \DOMDocument('1.0', 'UTF-8');
            $root = $dom->createElement('InvoiceFinalized');
            $invoiceType = ((float) ($invoiceArray['total'] ?? 0)) < 0 ? 'CREDIT' : 'REGULAR';

            $root->appendChild($dom->createElement('invoiceNumber', (string) ($invoiceArray['serie_nr'] ?? '')));
            $root->appendChild($dom->createElement('recipientEmail', $recipientEmail));
            $root->appendChild($dom->createElement('pdfUrl', $pdfUrl));
            $root->appendChild($dom->createElement('totalAmount', (string) round((float) ($invoiceArray['total'] ?? 0), 2)));
            $root->appendChild($dom->createElement('type', $invoiceType));
            $dom->appendChild($root);

            $exchange = getenv('INVOICE_EXCHANGE') ?: 'invoice.topic';
            $rabbit = new RabbitMQService(['exchange' => $exchange]);
            $rabbit->publishXML('invoice.finalized', $dom->saveXML() ?: '');
            $rabbit->close();

            $this->logInfo(sprintf('[kassa-invoice-receiver] invoice.finalized gepubliceerd voor invoice=%s', $invoiceArray['serie_nr'] ?? (string) $invoiceId));
        } catch (\Throwable $exception) {
            $this->logError(sprintf(
                '[kassa-invoice-receiver] invoice.finalized publicatie mislukt (invoice_id=%d, exception=%s, message=%s)',
                $invoiceId,
                get_class($exception),
                $exception->getMessage()
            ));
        }
    }

    private function parseInvoiceRequested(string $xml): array
    {
        $xpath = $this->createXPath($xml);

        $items = [];
        $itemNodes = $xpath->query('/InvoiceRequested/items/item');
        foreach ($itemNodes as $node) {
            $items[] = [
                'productName' => (string) $xpath->evaluate('string(productName)', $node),
                'quantity' => (int) $xpath->evaluate('string(quantity)', $node),
                'unitPrice' => (float) $xpath->evaluate('string(unitPrice)', $node),
            ];
        }

        return [
            'orderId' => (string) $xpath->evaluate('string(/InvoiceRequested/orderId)'),
            'amount' => (float) $xpath->evaluate('string(/InvoiceRequested/amount)'),
            'currency' => (string) $xpath->evaluate('string(/InvoiceRequested/currency)'),
            'orderedAt' => (string) $xpath->evaluate('string(/InvoiceRequested/orderedAt)'),
            'paymentReference' => $this->optionalValue($xpath, '/InvoiceRequested/paymentReference'),
            'user' => [
                'userId' => (string) $xpath->evaluate('string(/InvoiceRequested/User/userId)'),
                'firstName' => (string) $xpath->evaluate('string(/InvoiceRequested/User/firstName)'),
                'lastName' => (string) $xpath->evaluate('string(/InvoiceRequested/User/lastName)'),
                'email' => (string) $xpath->evaluate('string(/InvoiceRequested/User/email)'),
                'role' => (string) $xpath->evaluate('string(/InvoiceRequested/User/role)'),
                'badgeCode' => (string) $xpath->evaluate('string(/InvoiceRequested/User/badgeCode)'),
            ],
            'items' => $items,
        ];
    }

    private function createXPath(string $xml): \DOMXPath
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $internalErrors = libxml_use_internal_errors(true);
        try {
            if (!$dom->loadXML($xml, LIBXML_NONET)) {
                throw new \InvalidArgumentException('Unable to parse incoming InvoiceRequested XML payload.');
            }
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($internalErrors);
        }

        return new \DOMXPath($dom);
    }

    private function optionalValue(\DOMXPath $xpath, string $path): ?string
    {
        $value = trim((string) $xpath->evaluate(sprintf('string(%s)', $path)));

        return $value === '' ? null : $value;
    }

    private function logInfo(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->info($message);
        }
    }

    private function logError(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->err($message);
        }
    }
}

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

namespace Box\Mod\Invoice\Commands;

use FOSSBilling\InformationException;
use FOSSBilling\RabbitMQService;
use PhpAmqpLib\Exception\AMQPTimeoutException;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Kassa Invoice Consumer — Contract K-01
 *
 * Luistert naar de kassa.invoice.requested queue op de kassa.topic exchange.
 * Per ontvangen bericht:
 *  1. XSD-validatie tegen kassa_contract.xsd
 *  2. Deduplicatie op orderId (tabel kassa_processed_orders)
 *  3. Client opzoeken via aid = userId (CRM UUID)
 *  4. Bedrijf verifiëren (company_id == companyId)
 *  5. Individuele factuur aanmaken per client met de items uit het bericht
 *  6. Bedrijfsfactuur genereren via generateCompanySummaryInvoiceByCompanyId()
 *  7. facturatie.invoice.finalized publiceren naar Mailing
 *  8. Message ACK + orderId opslaan in kassa_processed_orders
 */
class ConsumeKassaCommand extends Command
{
    /** @var string Naam van het commando */
    protected static $defaultName = 'invoice:consume-kassa';

    /** @var \Pimple\Container Dependency injection container */
    private $di;

    /** @var bool Runflag voor de main loop (SIGTERM/SIGINT zet dit op false) */
    private bool $running = true;

    public function setDi($di): void
    {
        $this->di = $di;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Consumeert kassa.invoice.requested berichten en genereert bedrijfsfacturen.')
            ->setHelp(
                'Dit commando luistert naar Contract K-01 (Kassa → Facturatie).' . PHP_EOL .
                'Per bericht wordt een individuele factuur aangemaakt en daarna een bedrijfsfactuur gegenereerd.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Signaalafhandeling voor een nette afsluiting
        if (function_exists('pcntl_async_signals')) {
            pcntl_async_signals(true);
            pcntl_signal(SIGTERM, function () use ($output): void {
                $output->writeln('<comment>[kassa-consumer] SIGTERM ontvangen — bezig met afsluiten...</comment>');
                $this->running = false;
            });
            pcntl_signal(SIGINT, function () use ($output): void {
                $output->writeln('<comment>[kassa-consumer] SIGINT ontvangen — bezig met afsluiten...</comment>');
                $this->running = false;
            });
        }

        // Configuratie via env vars (met veilige standaardwaarden)
        $exchange      = (string) (getenv('KASSA_EXCHANGE') ?: 'kassa.topic');
        $queue         = (string) (getenv('KASSA_INVOICE_QUEUE') ?: 'kassa.invoice.requested');
        $routingKey    = 'kassa.invoice.requested';
        $waitTimeout   = max(0.1, (float) (getenv('KASSA_WAIT_TIMEOUT_SEC') ?: 1.0));

        $output->writeln('<info>[kassa-consumer] Kassa Invoice Consumer gestart.</info>');
        $output->writeln(sprintf('<comment>[kassa-consumer] Exchange: %s | Queue: %s</comment>', $exchange, $queue));

        // Zorg dat de deduplicatietabel bestaat
        $this->ensureProcessedOrdersTable();

        $rabbit = null;

        while ($this->running) {
            try {
                // (Her)verbinden indien nodig
                if (!$rabbit instanceof RabbitMQService) {
                    $rabbit = new RabbitMQService(['exchange' => $exchange]);
                    $rabbit->declareAndBindQueue($queue, $routingKey, true, $exchange);
                    $rabbit->setPrefetchCount(1);

                    $callback = function (AMQPMessage $message) use ($output, $rabbit, $routingKey): void {
                        $this->handleMessage($message, $output, $rabbit, $routingKey);
                    };

                    $rabbit->consumeQueue($queue, $callback);
                    $output->writeln(sprintf(
                        '<info>[kassa-consumer] Verbonden met exchange=%s queue=%s</info>',
                        $exchange,
                        $queue
                    ));
                }

                if ($rabbit->hasCallbacks()) {
                    $rabbit->waitForMessages($waitTimeout);
                }
            } catch (AMQPTimeoutException) {
                // Gewoon wachten op het volgende bericht
                continue;
            } catch (\Throwable $exception) {
                $output->writeln(sprintf(
                    '<error>[kassa-consumer] Verbindingsfout: %s | %s</error>',
                    get_class($exception),
                    $exception->getMessage()
                ));
                $this->logError(sprintf(
                    '[kassa-consumer] Verbindingsfout (exception=%s, message=%s)',
                    get_class($exception),
                    $exception->getMessage()
                ));

                if ($rabbit instanceof RabbitMQService) {
                    $rabbit->close();
                }
                $rabbit = null;

                // Wacht even voor herverbinding
                usleep(500_000);
            }
        }

        if ($rabbit instanceof RabbitMQService) {
            $rabbit->close();
        }

        $output->writeln('<info>[kassa-consumer] Consumer gestopt.</info>');

        return Command::SUCCESS;
    }

    // ─── Berichtverwerking ─────────────────────────────────────────────────────

    /**
     * Verwerkt één inkomend RabbitMQ-bericht.
     * Alle fouten worden gelogd en leiden nooit tot een crash.
     */
    private function handleMessage(
        AMQPMessage $message,
        OutputInterface $output,
        RabbitMQService $rabbit,
        string $routingKey
    ): void {
        $deliveryTag = $message->getDeliveryTag();
        $body        = $message->getBody();

        try {
            // Stap 1: XSD-validatie
            $rabbit->validateXMLForRoutingKey($routingKey, $body);

            // Stap 2: XML parsen
            $payload = $this->parseXml($body);
            $orderId    = $payload['orderId'];
            $userId     = $payload['userId'];
            $companyId  = $payload['companyId'];

            $output->writeln(sprintf(
                '<info>[kassa-consumer] Verwerken order=%s user=%s company=%s</info>',
                $orderId,
                $userId,
                $companyId
            ));

            // Stap 3: Deduplicatie — al verwerkt?
            if ($this->isAlreadyProcessed($orderId)) {
                $output->writeln(sprintf(
                    '<comment>[kassa-consumer] Order al verwerkt, overgeslagen (orderId=%s)</comment>',
                    $orderId
                ));
                $this->logWarn(sprintf('[kassa-consumer] Dubbel bericht genegeerd (orderId=%s)', $orderId));
                $message->getChannel()->basic_ack($deliveryTag);

                return;
            }

            // Stap 4: Client opzoeken via CRM userId (aid)
            $client = $this->findClientByAid($userId);
            if (!$client instanceof \Model_Client) {
                $output->writeln(sprintf(
                    '<error>[kassa-consumer] Client niet gevonden voor userId=%s | orderId=%s</error>',
                    $userId,
                    $orderId
                ));
                $this->logError(sprintf(
                    '[kassa-consumer] Client niet gevonden (aid=%s, orderId=%s)',
                    $userId,
                    $orderId
                ));
                $message->getChannel()->basic_ack($deliveryTag);

                return;
            }

            // Stap 5: Verifiëren dat client gelinkt is aan het bedrijf
            if ((string) ($client->company_id ?? '') !== $companyId) {
                $output->writeln(sprintf(
                    '<error>[kassa-consumer] Client #%s is niet gelinkt aan companyId=%s | orderId=%s</error>',
                    $client->id,
                    $companyId,
                    $orderId
                ));
                $this->logError(sprintf(
                    '[kassa-consumer] Client-bedrijf mismatch (client_id=%s, client_company_id=%s, expected_company_id=%s, orderId=%s)',
                    $client->id,
                    $client->company_id ?? 'null',
                    $companyId,
                    $orderId
                ));
                $message->getChannel()->basic_ack($deliveryTag);

                return;
            }

            // Stap 6: Individuele factuur aanmaken voor de client
            $invoiceId = $this->createClientInvoice($client, $payload, $orderId);
            $output->writeln(sprintf(
                '<info>[kassa-consumer] Individuele factuur aangemaakt invoice_id=%d | orderId=%s</info>',
                $invoiceId,
                $orderId
            ));

            // Stap 7: Bedrijfsfactuur genereren
            $summaryInvoice = $this->generateCompanySummary($companyId, $orderId, $output);

            // Stap 8: facturatie.invoice.finalized publiceren (indien bedrijfsfactuur gegenereerd)
            if ($summaryInvoice !== null) {
                $this->publishInvoiceFinalized($summaryInvoice, $client->email ?? '', $output);
                $output->writeln(sprintf(
                    '<info>[kassa-consumer] Bedrijfsfactuur gegenereerd invoice_id=%d | orderId=%s</info>',
                    $summaryInvoice->id,
                    $orderId
                ));
            }

            // Stap 9: Opslaan als verwerkt + ACK
            $this->markAsProcessed($orderId, $invoiceId);
            $message->getChannel()->basic_ack($deliveryTag);

            $output->writeln(sprintf(
                '<info>[kassa-consumer] ✅ Order verwerkt (orderId=%s)</info>',
                $orderId
            ));
        } catch (\InvalidArgumentException $exception) {
            // Ongeldige XML of XSD-fout — weggooien (ACK), niet retrybaar
            $output->writeln(sprintf(
                '<error>[kassa-consumer] Ongeldig bericht: %s</error>',
                $exception->getMessage()
            ));
            $this->logError(sprintf(
                '[kassa-consumer] XSD/XML validatiefout (exception=%s, message=%s)',
                get_class($exception),
                $exception->getMessage()
            ));
            $message->getChannel()->basic_ack($deliveryTag);
        } catch (InformationException $exception) {
            // Verwachte businessfout (bijv. geen facturen voor summary) — ACK + log
            $output->writeln(sprintf(
                '<comment>[kassa-consumer] Bedrijfsfactuur overgeslagen: %s</comment>',
                $exception->getMessage()
            ));
            $this->logWarn(sprintf(
                '[kassa-consumer] Bedrijfsfactuur kon niet gegenereerd worden (message=%s)',
                $exception->getMessage()
            ));
            $message->getChannel()->basic_ack($deliveryTag);
        } catch (\Throwable $exception) {
            // Onverwachte fout — NACK zodat het bericht terug naar de queue gaat
            $output->writeln(sprintf(
                '<error>[kassa-consumer] Onverwachte fout: %s | %s</error>',
                get_class($exception),
                $exception->getMessage()
            ));
            $this->logError(sprintf(
                '[kassa-consumer] Onverwachte verwerkingsfout (exception=%s, message=%s)',
                get_class($exception),
                $exception->getMessage()
            ));
            $message->getChannel()->basic_nack($deliveryTag, false, false);
        }
    }

    // ─── XML Parsing ───────────────────────────────────────────────────────────

    /**
     * Parset het InvoiceRequested XML bericht naar een PHP array.
     *
     * @return array{
     *   orderId: string,
     *   userId: string,
     *   companyId: string,
     *   amount: float,
     *   currency: string,
     *   orderedAt: string,
     *   items: list<array{productName: string, quantity: int, unitPrice: float}>,
     *   email: string|null,
     *   companyName: string|null,
     *   eventId: string|null,
     *   paymentReference: string|null
     * }
     */
    private function parseXml(string $xml): array
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $previousErrors = libxml_use_internal_errors(true);

        try {
            if (!$dom->loadXML($xml, LIBXML_NONET)) {
                throw new \InvalidArgumentException('Kan InvoiceRequested XML niet laden.');
            }
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousErrors);
        }

        $xpath = new \DOMXPath($dom);

        // Verplichte velden ophalen
        $orderId   = $this->xpathRequired($xpath, '/InvoiceRequested/orderId');
        $userId    = $this->xpathRequired($xpath, '/InvoiceRequested/userId');
        $companyId = $this->xpathRequired($xpath, '/InvoiceRequested/companyId');
        $amount    = (float) $this->xpathRequired($xpath, '/InvoiceRequested/amount');
        $currency  = $this->xpathRequired($xpath, '/InvoiceRequested/currency');
        $orderedAt = $this->xpathRequired($xpath, '/InvoiceRequested/orderedAt');

        // Items verwerken
        $items = [];
        $itemNodes = $xpath->query('/InvoiceRequested/items/item');
        if ($itemNodes === false || $itemNodes->length === 0) {
            throw new \InvalidArgumentException('InvoiceRequested bevat geen items.');
        }

        foreach ($itemNodes as $itemNode) {
            $itemXpath    = new \DOMXPath($itemNode->ownerDocument);
            $productName  = trim((string) $itemXpath->evaluate('string(productName)', $itemNode));
            $quantity     = (int) $itemXpath->evaluate('string(quantity)', $itemNode);
            $unitPrice    = (float) $itemXpath->evaluate('string(unitPrice)', $itemNode);

            if ($productName === '' || $quantity < 1) {
                throw new \InvalidArgumentException('Item heeft een ongeldig productName of quantity.');
            }

            $items[] = [
                'productName' => $productName,
                'quantity'    => $quantity,
                'unitPrice'   => $unitPrice,
            ];
        }

        return [
            'orderId'          => $orderId,
            'userId'           => $userId,
            'companyId'        => $companyId,
            'amount'           => $amount,
            'currency'         => $currency,
            'orderedAt'        => $orderedAt,
            'items'            => $items,
            'email'            => $this->xpathOptional($xpath, '/InvoiceRequested/email'),
            'companyName'      => $this->xpathOptional($xpath, '/InvoiceRequested/companyName'),
            'eventId'          => $this->xpathOptional($xpath, '/InvoiceRequested/eventId'),
            'paymentReference' => $this->xpathOptional($xpath, '/InvoiceRequested/paymentReference'),
        ];
    }

    // ─── Facturatie logica ─────────────────────────────────────────────────────

    /**
     * Maakt een individuele factuur aan voor de client met de items uit de order.
     * De factuur wordt direct goedgekeurd zodat de bedrijfsfactuur hem kan oppikken.
     *
     * @return int Het ID van de aangemaakte factuur
     */
    private function createClientInvoice(\Model_Client $client, array $payload, string $orderId): int
    {
        $invoiceService = $this->di['mod_service']('Invoice');

        // Factuur aanmaken (nog niet goedgekeurd)
        $invoice = $invoiceService->prepareInvoice($client, [
            'text_1' => sprintf('Kassabestelling %s — %s', $orderId, $payload['orderedAt']),
        ]);

        // Items toevoegen
        $invoiceItemService = $this->di['mod_service']('Invoice', 'InvoiceItem');
        foreach ($payload['items'] as $item) {
            $invoiceItemService->addNew($invoice, [
                'title'    => $item['productName'],
                'price'    => $item['unitPrice'],
                'quantity' => $item['quantity'],
                'taxed'    => false,
            ]);
        }

        // Notitie met traceerbaarheid toevoegen
        $notes = sprintf(
            'Kassabestelling | orderId: %s | userId: %s | companyId: %s | orderedAt: %s',
            $orderId,
            $payload['userId'],
            $payload['companyId'],
            $payload['orderedAt']
        );
        if ($payload['eventId'] !== null) {
            $notes .= sprintf(' | eventId: %s', $payload['eventId']);
        }
        if ($payload['paymentReference'] !== null) {
            $notes .= sprintf(' | ref: %s', $payload['paymentReference']);
        }

        $invoice->notes = $notes;
        $invoice->updated_at = date('Y-m-d H:i:s');
        $this->di['db']->store($invoice);

        // Factuur goedkeuren zodat de bedrijfsfactuur hem mee kan nemen
        $invoiceService->approveInvoice($invoice, ['id' => $invoice->id]);

        return (int) $invoice->id;
    }

    /**
     * Genereert een bedrijfsfactuur voor alle openstaande facturen van het bedrijf.
     * Geeft null terug als er niet genoeg data is (bijv. geen clients gelinkt).
     */
    private function generateCompanySummary(
        string $companyId,
        string $orderId,
        OutputInterface $output
    ): ?\Model_Invoice {
        try {
            $invoiceService = $this->di['mod_service']('Invoice');

            return $invoiceService->generateCompanySummaryInvoiceByCompanyId($companyId);
        } catch (InformationException $exception) {
            $output->writeln(sprintf(
                '<comment>[kassa-consumer] Bedrijfsfactuur overgeslagen: %s (orderId=%s)</comment>',
                $exception->getMessage(),
                $orderId
            ));
            $this->logWarn(sprintf(
                '[kassa-consumer] Bedrijfsfactuur niet aangemaakt (companyId=%s, orderId=%s, reden=%s)',
                $companyId,
                $orderId,
                $exception->getMessage()
            ));

            return null;
        }
    }

    /**
     * Publiceert een facturatie.invoice.finalized bericht naar de Mailing service.
     */
    private function publishInvoiceFinalized(\Model_Invoice $invoice, string $recipientEmail, OutputInterface $output): void
    {
        try {
            $invoiceService = $this->di['mod_service']('Invoice');
            $invoiceArray   = $invoiceService->toApiArray($invoice, false, null);

            $pdfBaseUrl = (string) (getenv('APP_URL') ?: 'http://localhost:8080');
            $pdfUrl     = rtrim($pdfBaseUrl, '/') . '/invoice/pdf/' . ($invoiceArray['hash'] ?? '');

            $dom  = new \DOMDocument('1.0', 'UTF-8');
            $root = $dom->createElement('invoice_finalized');

            $root->appendChild($dom->createElement('invoiceNumber', (string) ($invoiceArray['serie_nr'] ?? '')));
            $root->appendChild($dom->createElement('recipientEmail', $recipientEmail));
            $root->appendChild($dom->createElement('pdfUrl', $pdfUrl));
            $root->appendChild($dom->createElement('totalAmount', (string) round((float) ($invoiceArray['total'] ?? 0), 2)));
            $root->appendChild($dom->createElement('type', 'invoice_finalized'));
            $dom->appendChild($root);

            $rabbit = new RabbitMQService();
            $rabbit->publishXML('facturatie.invoice.finalized', $dom->saveXML() ?: '');
            $rabbit->close();

            $output->writeln(sprintf(
                '<info>[kassa-consumer] invoice.finalized gepubliceerd voor invoice=%s</info>',
                $invoiceArray['serie_nr'] ?? $invoice->id
            ));
        } catch (\Throwable $exception) {
            // Publicatiefout mag de hoofdflow niet stoppen
            $output->writeln(sprintf(
                '<error>[kassa-consumer] invoice.finalized publicatie mislukt: %s</error>',
                $exception->getMessage()
            ));
            $this->logError(sprintf(
                '[kassa-consumer] invoice.finalized publicatie mislukt (invoice_id=%s, exception=%s, message=%s)',
                $invoice->id,
                get_class($exception),
                $exception->getMessage()
            ));
        }
    }

    // ─── Deduplicatie ──────────────────────────────────────────────────────────

    /**
     * Zorgt dat de kassa_processed_orders tabel bestaat in de database.
     */
    private function ensureProcessedOrdersTable(): void
    {
        $this->di['db']->exec(
            'CREATE TABLE IF NOT EXISTS kassa_processed_orders (
                order_id     VARCHAR(255) NOT NULL,
                processed_at DATETIME     NOT NULL,
                invoice_id   INT          NULL,
                PRIMARY KEY  (order_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
        );
    }

    /**
     * Controleert of een orderId al eerder verwerkt werd.
     */
    private function isAlreadyProcessed(string $orderId): bool
    {
        $result = $this->di['db']->getCell(
            'SELECT order_id FROM kassa_processed_orders WHERE order_id = :order_id LIMIT 1',
            [':order_id' => $orderId]
        );

        return $result !== null && $result !== false;
    }

    /**
     * Slaat een verwerkte orderId op als markering voor deduplicatie.
     */
    private function markAsProcessed(string $orderId, int $invoiceId): void
    {
        $this->di['db']->exec(
            'INSERT IGNORE INTO kassa_processed_orders (order_id, processed_at, invoice_id)
             VALUES (:order_id, :processed_at, :invoice_id)',
            [
                ':order_id'     => $orderId,
                ':processed_at' => date('Y-m-d H:i:s'),
                ':invoice_id'   => $invoiceId,
            ]
        );
    }

    // ─── Client opzoeken ───────────────────────────────────────────────────────

    /**
     * Zoekt een client op basis van het CRM UUID (aid veld).
     * Het 'aid' veld in FOSSBilling bevat de CRM UUID die Kassa als userId meestuurt.
     */
    private function findClientByAid(string $crmUserId): ?\Model_Client
    {
        $client = $this->di['db']->findOne('Client', 'aid = :aid', [':aid' => $crmUserId]);

        return $client instanceof \Model_Client ? $client : null;
    }

    // ─── XPath hulpmethoden ────────────────────────────────────────────────────

    /**
     * Haalt een verplicht tekstwaarde op uit een XPath expressie.
     *
     * @throws \InvalidArgumentException Als het veld leeg of afwezig is
     */
    private function xpathRequired(\DOMXPath $xpath, string $path): string
    {
        $value = trim((string) $xpath->evaluate(sprintf('string(%s)', $path)));
        if ($value === '') {
            throw new \InvalidArgumentException(sprintf('Verplicht veld ontbreekt: %s', $path));
        }

        return $value;
    }

    /**
     * Haalt een optioneel tekstwaarde op uit een XPath expressie.
     * Geeft null terug als het veld leeg of afwezig is.
     */
    private function xpathOptional(\DOMXPath $xpath, string $path): ?string
    {
        $value = trim((string) $xpath->evaluate(sprintf('string(%s)', $path)));

        return $value === '' ? null : $value;
    }

    // ─── Logging hulpmethoden ──────────────────────────────────────────────────

    private function logInfo(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->info($message);
        } else {
            error_log($message);
        }
    }

    private function logWarn(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->warn($message);
        } else {
            error_log($message);
        }
    }

    private function logError(string $message): void
    {
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->err($message);
        } else {
            error_log($message);
        }
    }
}

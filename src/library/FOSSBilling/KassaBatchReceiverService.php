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

use FOSSBilling\InformationException;
use Pimple\Container;

/**
 * Kassa Batch Receiver Service — Contract K-02
 *
 * Verwerkt inkomende BatchClosed berichten van Kassa naar Facturatie.
 *
 * Flow per batch:
 *  1. XML parsen
 *  2. Deduplicatie op batchId
 *  3. Per gebruiker: individuele factuur aanmaken
 *  4. Per bedrijf: samenvattingsfactuur genereren, goedkeuren en publiceren
 *  5. Batch markeren als verwerkt
 */
class KassaBatchReceiverService
{
    public function __construct(private readonly Container $di)
    {
    }

    /**
     * Verwerkt een inkomend kassa.closed bericht.
     *
     * @return string 'processed' | 'already-processed' | 'empty-batch'
     * @throws \InvalidArgumentException Bij ongeldige XML of ontbrekende verplichte velden
     */
    public function process(string $routingKey, string $xml): string
    {
        $this->logInfo('[kassa-batch-receiver] Received message for processing');

        if ($routingKey !== 'kassa.closed') {
            throw new \InvalidArgumentException(
                sprintf('Unsupported routing key "%s" for kassa batch receiver.', $routingKey)
            );
        }

        $this->ensureBatchTable();

        $batch = $this->parseBatchClosed($xml);
        $this->logInfo(sprintf(
            '[kassa-batch-receiver] Parsed batch metadata: batchId=%s, closedAt=%s, totalAmount=%.2f, userCount=%d',
            $batch['batchId'],
            $batch['closedAt'],
            $batch['totalAmount'],
            count($batch['users'])
        ));

        if ($this->isBatchAlreadyProcessed($batch['batchId'])) {
            $this->logWarn(sprintf(
                '[kassa-batch-receiver] Batch already processed, skipping (batchId=%s)',
                $batch['batchId']
            ));

            return 'already-processed';
        }

        $users = $batch['users'];

        if ($users === []) {
            $this->markBatchAsProcessed($batch['batchId'], 0, 0.0);
            $this->logInfo(sprintf(
                '[kassa-batch-receiver] Empty batch or no valid users found (batchId=%s)',
                $batch['batchId']
            ));

            return 'empty-batch';
        }

        $companiesWithNewInvoices = [];
        $processedUserCount = 0;

        foreach ($users as $userData) {
            $userId = $userData['userId'];
            $this->logInfo(sprintf('[kassa-batch-receiver] Processing user: %s (batchId=%s)', $userId, $batch['batchId']));

            $client = $this->findClientByAid($userId);
            if (!$client instanceof \Model_Client) {
                $this->logWarn(sprintf(
                    '[kassa-batch-receiver] Client not found for userId=%s in database (batchId=%s) — skipping user',
                    $userId,
                    $batch['batchId']
                ));

                continue;
            }

            try {
                $invoiceId = $this->createClientInvoice($client, $userData, $batch['batchId'], $batch['closedAt']);
                $this->logInfo(sprintf(
                    '[kassa-batch-receiver] Created individual invoice id=%d for userId=%s (batchId=%s)',
                    $invoiceId,
                    $userId,
                    $batch['batchId']
                ));

                if ($client->company_id !== null && $client->company_id !== '') {
                    $companiesWithNewInvoices[$client->company_id] = true;
                    $this->logInfo(sprintf('[kassa-batch-receiver] User linked to company %s, queued for summary', (string) $client->company_id));
                }

                $processedUserCount++;
            } catch (\Throwable $exception) {
                $this->logError(sprintf(
                    '[kassa-batch-receiver] Failed to create invoice (userId=%s, batchId=%s, exception=%s, message=%s)',
                    $userId,
                    $batch['batchId'],
                    get_class($exception),
                    $exception->getMessage()
                ));
            }
        }

        if ($processedUserCount === 0 && count($users) > 0) {
            $this->logWarn(sprintf(
                '[kassa-batch-receiver] NO INVOICES GENERATED: Batch contained %d users but all were skipped or failed (batchId=%s)',
                count($users),
                $batch['batchId']
            ));
        }

        if ($companiesWithNewInvoices !== []) {
            $this->logInfo(sprintf('[kassa-batch-receiver] Generating summaries for %d companies', count($companiesWithNewInvoices)));
            foreach (array_keys($companiesWithNewInvoices) as $companyId) {
                $this->generateCompanySummary((string) $companyId, $batch['batchId']);
            }
        }

        $this->markBatchAsProcessed($batch['batchId'], $processedUserCount, (float) $batch['totalAmount']);

        $this->logInfo(sprintf(
            '[kassa-batch-receiver] Batch processing completed (batchId=%s, users_processed=%d, companies_processed=%d)',
            $batch['batchId'],
            $processedUserCount,
            count($companiesWithNewInvoices)
        ));

        return 'processed';
    }

    // ─── Facturatie logica ─────────────────────────────────────────────────────

    /**
     * Maakt een individuele factuur aan voor één gebruiker uit de batch.
     * De factuur wordt direct goedgekeurd zodat de bedrijfsfactuur hem oppikt.
     */
    private function createClientInvoice(
        \Model_Client $client,
        array $userData,
        string $batchId,
        string $closedAt
    ): int {
        $invoiceService = $this->di['mod_service']('Invoice');

        $invoice = $invoiceService->prepareInvoice($client, [
            'text_1' => sprintf('Kassabatch %s — afgesloten op %s', $batchId, $closedAt),
        ]);

        $invoiceItemService = $this->di['mod_service']('Invoice', 'InvoiceItem');
        foreach ($userData['items'] as $item) {
            $invoiceItemService->addNew($invoice, [
                'title'    => $item['productName'],
                'price'    => $item['unitPrice'],
                'quantity' => $item['quantity'],
                'taxed'    => false,
            ]);
        }

        $invoice->notes = sprintf(
            'Kassabatch | batchId: %s | userId: %s | closedAt: %s',
            $batchId,
            $userData['userId'],
            $closedAt
        );
        $invoice->updated_at = date('Y-m-d H:i:s');
        $this->di['db']->store($invoice);

        $invoiceService->approveInvoice($invoice, ['id' => $invoice->id]);

        return (int) $invoice->id;
    }

    /**
     * Genereert een bedrijfsfactuur voor alle openstaande facturen van het bedrijf.
     * InformationException (geen openstaande facturen) wordt gelogd en genegeerd.
     */
    private function generateCompanySummary(string $companyId, string $batchId): void
    {
        try {
            $invoiceService = $this->di['mod_service']('Invoice');
            $summary = $invoiceService->generateCompanySummaryInvoiceByCompanyId($companyId);

            $invoiceService->approveInvoice($summary, ['id' => $summary->id]);
            $this->publishInvoiceFinalized($summary, (string) ($summary->buyer_email ?? ''), $batchId);

            $this->logInfo(sprintf(
                '[kassa-batch-receiver] Bedrijfsfactuur aangemaakt, goedgekeurd en gepubliceerd invoice_id=%d (companyId=%s, batchId=%s)',
                $summary->id,
                $companyId,
                $batchId
            ));
        } catch (InformationException $exception) {
            $this->logWarn(sprintf(
                '[kassa-batch-receiver] Bedrijfsfactuur overgeslagen (companyId=%s, batchId=%s, reden=%s)',
                $companyId,
                $batchId,
                $exception->getMessage()
            ));
        } catch (\Throwable $exception) {
            $this->logError(sprintf(
                '[kassa-batch-receiver] Bedrijfsfactuur goedkeuren/publiceren mislukt (companyId=%s, batchId=%s, exception=%s, message=%s)',
                $companyId,
                $batchId,
                get_class($exception),
                $exception->getMessage()
            ));
        }
    }

    /**
     * Publiceert een facturatie.invoice.finalized bericht naar de Mailing service.
     */
    private function publishInvoiceFinalized(
        \Model_Invoice $invoice,
        string $recipientEmail,
        string $batchId
    ): void {
        try {
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

            $rabbit = new RabbitMQService();
            $rabbit->publishXML('facturatie.invoice.finalized', $dom->saveXML() ?: '');
            $rabbit->close();

            $this->logInfo(sprintf(
                '[kassa-batch-receiver] invoice.finalized gepubliceerd voor invoice=%s (batchId=%s)',
                $invoiceArray['serie_nr'] ?? $invoice->id,
                $batchId
            ));
        } catch (\Throwable $exception) {
            $this->logError(sprintf(
                '[kassa-batch-receiver] invoice.finalized publicatie mislukt (invoice_id=%s, batchId=%s, exception=%s, message=%s)',
                $invoice->id,
                $batchId,
                get_class($exception),
                $exception->getMessage()
            ));
        }
    }

    // ─── Client opzoeken ───────────────────────────────────────────────────────

    /**
     * Zoekt een client op via het CRM UUID (aid-veld).
     */
    private function findClientByAid(string $crmUserId): ?\Model_Client
    {
        $client = $this->di['db']->findOne('Client', 'aid = :aid', [':aid' => $crmUserId]);

        return $client instanceof \Model_Client ? $client : null;
    }

    // ─── Deduplicatie ──────────────────────────────────────────────────────────

    private function ensureBatchTable(): void
    {
        $this->di['db']->exec(
            'CREATE TABLE IF NOT EXISTS kassa_batch_processed (
                batch_id     VARCHAR(36)   NOT NULL,
                processed_at DATETIME      NOT NULL,
                user_count   INT           DEFAULT 0,
                total_amount DECIMAL(10,2) DEFAULT 0,
                PRIMARY KEY  (batch_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
        );
    }

    private function isBatchAlreadyProcessed(string $batchId): bool
    {
        $result = $this->di['db']->getCell(
            'SELECT batch_id FROM kassa_batch_processed WHERE batch_id = :batch_id LIMIT 1',
            [':batch_id' => $batchId]
        );

        return $result !== null && $result !== false;
    }

    private function markBatchAsProcessed(string $batchId, int $userCount, float $totalAmount): void
    {
        $this->di['db']->exec(
            'INSERT IGNORE INTO kassa_batch_processed (batch_id, processed_at, user_count, total_amount)
             VALUES (:batch_id, :processed_at, :user_count, :total_amount)',
            [
                ':batch_id'     => $batchId,
                ':processed_at' => date('Y-m-d H:i:s'),
                ':user_count'   => $userCount,
                ':total_amount' => round($totalAmount, 2),
            ]
        );
    }

    // ─── XML Parsing ───────────────────────────────────────────────────────────

    /**
     * Parset een BatchClosed XML bericht (Contract K-02).
     *
     * @return array{
     *   batchId: string,
     *   closedAt: string,
     *   currency: string,
     *   totalAmount: float,
     *   users: list<array{userId: string, totalAmount: float, items: list<array{productName: string, quantity: int, unitPrice: float, totalPrice: float}>}>
     * }
     */
    private function parseBatchClosed(string $xml): array
    {
        $xpath = $this->buildXPath($xml);

        $batchId     = $this->xpathRequired($xpath, '/BatchClosed/batchId');
        $closedAt    = $this->xpathRequired($xpath, '/BatchClosed/closedAt');
        $currency    = $this->xpathRequired($xpath, '/BatchClosed/currency');
        $totalAmount = (float) $this->xpathRequired($xpath, '/BatchClosed/summary/totalAmount');

        $users = [];
        $userNodes = $xpath->query('/BatchClosed/users/user');

        if ($userNodes !== false && $userNodes->length > 0) {
            foreach ($userNodes as $userNode) {
                $userId      = trim((string) $xpath->evaluate('string(userId)', $userNode));
                $userTotal   = (float) $xpath->evaluate('string(totalAmount)', $userNode);

                if ($userId === '') {
                    $this->logWarn('[kassa-batch-receiver] Skipping user node without userId');
                    continue;
                }

                $items = [];
                $itemNodes = $xpath->query('items/item', $userNode);

                if ($itemNodes !== false) {
                    foreach ($itemNodes as $itemNode) {
                        $productName = trim((string) $xpath->evaluate('string(productName)', $itemNode));
                        $quantity    = (int) $xpath->evaluate('string(quantity)', $itemNode);
                        $unitPrice   = (float) $xpath->evaluate('string(unitPrice)', $itemNode);
                        $totalPrice  = (float) $xpath->evaluate('string(totalPrice)', $itemNode);

                        if ($productName === '' || $quantity <= 0) {
                            $this->logWarn(sprintf('[kassa-batch-receiver] Skipping invalid item for user %s', $userId));
                            continue;
                        }

                        $items[] = [
                            'productName' => $productName,
                            'quantity'    => $quantity,
                            'unitPrice'   => $unitPrice,
                            'totalPrice'  => $totalPrice,
                        ];
                    }
                }

                if ($items === []) {
                    $this->logWarn(sprintf('[kassa-batch-receiver] No items found for user %s, skipping', $userId));
                    continue;
                }

                $users[] = [
                    'userId'      => $userId,
                    'totalAmount' => $userTotal,
                    'items'       => $items,
                ];
            }
        }

        return [
            'batchId'     => $batchId,
            'closedAt'    => $closedAt,
            'currency'    => $currency,
            'totalAmount' => $totalAmount,
            'users'       => $users,
        ];
    }

    // ─── XPath hulpmethoden ────────────────────────────────────────────────────

    private function buildXPath(string $xml): \DOMXPath
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);

        try {
            if (!$dom->loadXML($xml, LIBXML_NONET)) {
                throw new \InvalidArgumentException(
                    'Kan BatchClosed XML niet laden: ' . $this->formatLibxmlErrors()
                );
            }
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }

        return new \DOMXPath($dom);
    }

    private function xpathRequired(\DOMXPath $xpath, string $path): string
    {
        $value = trim((string) $xpath->evaluate(sprintf('string(%s)', $path)));
        if ($value === '') {
            throw new \InvalidArgumentException(
                sprintf('Verplicht veld ontbreekt in BatchClosed bericht: %s', $path)
            );
        }

        return $value;
    }

    private function formatLibxmlErrors(): string
    {
        $errors = libxml_get_errors();
        if ($errors === []) {
            return 'Unknown libxml error';
        }

        return implode(' | ', array_unique(array_map(
            static fn(\LibXMLError $e): string => trim($e->message),
            $errors
        )));
    }

    // ─── Logging ──────────────────────────────────────────────────────────────

    private function logInfo(string $message): void
    {
        if (Environment::isCLI()) {
            echo "[INFO] " . $message . PHP_EOL;
        }
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->info($message);
        } else {
            error_log($message);
        }
    }

    private function logWarn(string $message): void
    {
        if (Environment::isCLI()) {
            echo "[WARN] " . $message . PHP_EOL;
        }
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->warn($message);
        } else {
            error_log($message);
        }
    }

    private function logError(string $message): void
    {
        if (Environment::isCLI()) {
            echo "[ERROR] " . $message . PHP_EOL;
        }
        if (isset($this->di['logger'])) {
            $this->di['logger']->setChannel('application')->err($message);
        } else {
            error_log($message);
        }
    }
}

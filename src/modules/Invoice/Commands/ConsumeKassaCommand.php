<?php

declare(strict_types=1);

namespace Box\Mod\Invoice\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpAmqpLib\Message\AMQPMessage;

class ConsumeKassaCommand extends Command
{
    protected static $defaultName = 'invoice:consume-kassa';
    private $di;

    public function setDi($di)
    {
        $this->di = $di;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Consumes Kassa batch XML from RabbitMQ and generates B2B invoices.')
            ->setHelp('This command listens for kassa.closing.finalized events and groups transactions by company.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>Starting Kassa Batch Consumer...</info>');

        $rabbitMQ = new \FOSSBilling\RabbitMQService();
        $channel = $rabbitMQ->getChannel();

        $queueName = 'kassa.closing.finalized';
        // Ensure the queue exists and is bound to the correct routing key on ehb.events
        $channel->queue_declare($queueName, false, true, false, false);
        $channel->queue_bind($queueName, 'ehb.events', 'kassa.closing.finalized');

        $output->writeln("<comment>Waiting for messages on queue '$queueName'...</comment>");

        $callback = function (AMQPMessage $msg) use ($output) {
            $output->writeln('<info>Received XML Message.</info>');
            
            try {
                $xml = new \SimpleXMLElement($msg->body);
                $this->processBatch($xml, $output);
                $msg->ack();
                $output->writeln('<info>Batch verwerkt en bevestigd.</info>');
            } catch (\Exception $e) {
                $output->writeln('<error>Fout bij verwerken batch: ' . $e->getMessage() . '</error>');
                $msg->ack(); // Bevestig toch om lussen te voorkomen, of log voor onderzoek
            }
        };

        $channel->basic_consume($queueName, '', false, false, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        return Command::SUCCESS;
    }

    private function processBatch(\SimpleXMLElement $xml, OutputInterface $output): void
    {
        $transactionsByCompany = [];
        
        // 1. Groepeer transacties per Bedrijf
        // Verwachte structuur: KassaBatch -> users -> user -> [userId, transactions -> transaction -> [description, amount]]
        foreach ($xml->users->user as $userNode) {
            $userId = (int) $userNode->userId;
            
            // Zoek cliënt en hun bedrijf op in FOSSBilling
            $client = $this->getClientByAnyId($userId);
            if (!$client) {
                $output->writeln("<error>Cliënt met ID $userId niet gevonden. Overslaan.</error>");
                continue;
            }

            if (empty($client['company'])) {
                $output->writeln("<comment>Gebruiker $userId is een particuliere klant (geen bedrijf). Overslaan van B2B facturatie.</comment>");
                continue;
            }

            $companyId = $client['company']; 
            $clientId = (int) $client['id'];

            if (!isset($transactionsByCompany[$companyId])) {
                $transactionsByCompany[$companyId] = [
                    'clientId' => $clientId,
                    'clientEmail' => $client['email'],
                    'items' => []
                ];
            }

            foreach ($userNode->transactions->transaction as $tx) {
                $amount = (float) $tx->amount;
                $description = (string) $tx->description;

                $transactionsByCompany[$companyId]['items'][] = [
                    'title' => $description . " (Gebruiker: " . $client['first_name'] . " " . $client['last_name'] . ")",
                    'price' => $amount,
                    'quantity' => 1
                ];
            }
        }

        // 2. Genereer facturen voor elk Bedrijf
        $api = $this->di['api_admin'];
        foreach ($transactionsByCompany as $companyName => $data) {
            $output->writeln("<info>Genereren van geaggregeerde factuur voor bedrijf: $companyName</info>");

            $invoiceId = $api->invoice_prepare(['client_id' => $data['clientId']]);

            $total = 0;
            foreach ($data['items'] as $item) {
                $api->invoice_item_create([
                    'invoice_id' => $invoiceId,
                    'title' => $item['title'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity']
                ]);
                $total += ($item['price'] * $item['quantity']);
            }

            $api->invoice_approve(['id' => $invoiceId]);
            $invoice = $api->invoice_get(['id' => $invoiceId]);
            $output->writeln("<info>Goedgekeurde factuur ID: $invoiceId (Nummer: " . $invoice['serie_nr'] . ")</info>");

            // 3. Publiceer finalisatie notificatie via RabbitMQService
            $this->publishFinalizedNotification($invoice, $data['clientEmail'], $output);
        }
    }

    private function getClientByAnyId(int $id): ?array
    {
        $api = $this->di['api_admin'];
        try {
            // Try direct ID lookup
            return $api->client_get(['id' => $id]);
        } catch (\Exception $e) {
            // Try custom_1 or aid if needed as fallback
            try {
                $clients = $api->client_get_list(['search' => (string) $id]);
                return $clients['list'][0] ?? null;
            } catch (\Exception $e2) {
                return null;
            }
        }
    }

    private function publishFinalizedNotification(array $invoice, string $recipientEmail, OutputInterface $output): void
    {
        $rabbitMQ = new \FOSSBilling\RabbitMQService();
        
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $root = $dom->createElement('invoice_finalized');
        
        // Veldnamen moeten overeenkomen met facturatie_contract.xsd
        $root->appendChild($dom->createElement('invoiceNumber', (string)$invoice['serie_nr']));
        $root->appendChild($dom->createElement('recipientEmail', $recipientEmail));
        
        // Construeer een relatieve of absolute URL voor de PDF
        $pdfUrl = "http://localhost:8080/invoice/pdf/" . $invoice['hash']; 
        $root->appendChild($dom->createElement('pdfUrl', $pdfUrl));
        
        $root->appendChild($dom->createElement('totalAmount', (string)$invoice['total']));
        $root->appendChild($dom->createElement('type', 'invoice_finalized')); // Komt overeen met XSD enumeratie
        
        $dom->appendChild($root);

        try {
            $rabbitMQ->publishXML('facturatie.invoice.finalized', $dom->saveXML() ?: '');
            $output->writeln("<info>Gevalideerde notificatie verzonden voor factuur " . $invoice['serie_nr'] . "</info>");
        } catch (\Exception $e) {
            $output->writeln("<error>Fout bij verzenden gevalideerde notificatie: " . $e->getMessage() . "</error>");
        }
    }
}

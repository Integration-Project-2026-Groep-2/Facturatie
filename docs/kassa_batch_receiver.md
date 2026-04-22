# US-10 — Bedrijfsfactuur vanuit kassagegevens (BatchClosed)

**Branch:** `feature/US-10-invoice-generation-company`  
**Verantwoordelijke:** Bilal Bouchta  
**Datum:** 2026-04-22  
**Status:** Volledig geïmplementeerd en getest  

---

## 1. Overzicht

US-10 maakt Facturatie verantwoordelijk voor het verwerken van de dagelijkse kassaafsluitingen. Telkens wanneer de kassa sluit, publiceert Kassa een `BatchClosed` bericht op de `kassa.topic` exchange. Facturatie consumeert dit bericht, maakt voor elke gebruiker in de batch een individuele factuur aan, en genereert daarna per bedrijf een samenvattingsfactuur over alle openstaande facturen.

**Richting:** Kassa → Facturatie  
**Rol van Facturatie:** Consumer (queue-ontvanger)  
**RabbitMQ exchange:** `kassa.topic` (type: topic, durable: true)  
**Queue:** `facturatie.kassa.batch.closed` (durable: true)  
**Routing key:** `kassa.closed`  

---

## 2. XML contract (Contract K-02)

### Root element: `<BatchClosed>`

| Veld | Type | Verplicht | Beschrijving |
|------|------|-----------|--------------|
| `batchId` | `UUIDType` | ja | Unieke ID van de batch (deduplicatie) |
| `closedAt` | `ISO8601DateTimeType` | ja | Tijdstip waarop de kassa is afgesloten |
| `currency` | `CurrencyType` | ja | Valuta (momenteel enkel `EUR`) |
| `users` | lijst van `user` | nee | Gebruikers met orders op factuur (kan leeg zijn) |
| `summary` | complex type | ja | Totaaloverzicht van de batch |

### `user` element

| Veld | Type | Verplicht | Beschrijving |
|------|------|-----------|--------------|
| `userId` | `UUIDType` | ja | CRM UUID — wordt opgezocht via `aid` in Facturatie |
| `items` | lijst van `item` | ja (min. 1) | Bestelde producten |
| `totalAmount` | `NonNegativeAmountType` | ja | Totaalbedrag voor deze gebruiker |

### `item` element

| Veld | Type | Verplicht | Beschrijving |
|------|------|-----------|--------------|
| `productName` | `xs:string` | ja | Naam van het product |
| `quantity` | `xs:positiveInteger` | ja | Aantal besteld |
| `unitPrice` | `NonNegativeAmountType` | ja | Prijs per stuk (excl. BTW) |
| `totalPrice` | `NonNegativeAmountType` | ja | Totaalprijs voor dit item |

### `summary` element

| Veld | Type | Verplicht | Beschrijving |
|------|------|-----------|--------------|
| `totalOrders` | `xs:nonNegativeInteger` | ja | Aantal verwerkte orders |
| `totalAmount` | `NonNegativeAmountType` | ja | Totaalbedrag van de volledige batch |
| `orderIds` | lijst van `orderId` | nee | Optionele lijst van order-UUIDs |

### Voorbeeld XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<BatchClosed>
  <batchId>550e8400-e29b-41d4-a716-446655440099</batchId>
  <closedAt>2026-04-22T23:59:59+00:00</closedAt>
  <currency>EUR</currency>
  <users>
    <user>
      <userId>550e8400-e29b-41d4-a716-446655440000</userId>
      <items>
        <item>
          <productName>Mojito</productName>
          <quantity>2</quantity>
          <unitPrice>8.50</unitPrice>
          <totalPrice>17.00</totalPrice>
        </item>
        <item>
          <productName>Bruiswater</productName>
          <quantity>1</quantity>
          <unitPrice>2.50</unitPrice>
          <totalPrice>2.50</totalPrice>
        </item>
      </items>
      <totalAmount>19.50</totalAmount>
    </user>
  </users>
  <summary>
    <totalOrders>1</totalOrders>
    <totalAmount>19.50</totalAmount>
  </summary>
</BatchClosed>
```

---

## 3. Gewijzigde en toegevoegde bestanden

### 3.1 `src/data/contracts/kassa_batch_contract.xsd` _(nieuw)_

XSD-schema voor het `BatchClosed` contract (K-02). Hergebruikt dezelfde shared types als `kassa_contract.xsd`:

- `UUIDType` — UUID v4 patroon (`[0-9a-f]{8}-[0-9a-f]{4}-4...`)
- `ISO8601DateTimeType` — `xs:dateTime`
- `CurrencyType` — restrictielijst (`EUR`)
- `NonNegativeAmountType` — decimaal getal, min. 0, max. 2 decimalen

---

### 3.2 `src/library/FOSSBilling/KassaBatchReceiverService.php` _(nieuw)_

Business logic voor het verwerken van `kassa.closed` berichten.

**Publieke methode:**

```php
process(string $routingKey, string $xml): string
```

Geeft terug:
- `'processed'` — batch succesvol verwerkt
- `'already-processed'` — `batchId` al eerder gezien (deduplicatie)
- `'empty-batch'` — `users` lijst is leeg, geen facturen aangemaakt

**Verwerkingsflow:**

```
process('kassa.closed', $xml)
  → ensureBatchTable()               [CREATE TABLE IF NOT EXISTS kassa_batch_processed]
  → parseBatchClosed($xml)           [DOMXPath — haalt batchId, closedAt, users op]
  → isBatchAlreadyProcessed($batchId)
      → return 'already-processed' als al verwerkt
  → Per user in users[]:
      → findClientByAid($userId)     [SELECT FROM client WHERE aid = ?]
          → niet gevonden: log warning + continue (geen crash)
      → createClientInvoice($client, $userData, $batchId, $closedAt)
          → prepareInvoice()         [FOSSBilling factuur aanmaken]
          → addNew() per item        [factuurregels toevoegen]
          → approveInvoice()         [direct goedkeuren voor bedrijfsfactuur]
      → track $companiesWithNewInvoices[$client->company_id]
  → Per unieke company:
      → generateCompanySummary($companyId, $batchId)
          → generateCompanySummaryInvoiceByCompanyId()
          → InformationException: log warning + continue (geen crash)
  → markBatchAsProcessed($batchId, $userCount, $totalAmount)
  → return 'processed'
```

**Foutafhandeling:**

| Situatie | Gedrag |
|----------|--------|
| `userId` niet gevonden als client | Log warning + overslaan, rest van batch gaat door |
| Factuur aanmaken mislukt (exception) | Log error + overslaan, rest van batch gaat door |
| Geen openstaande facturen voor bedrijf (`InformationException`) | Log warning + overslaan, geen crash |
| Dubbele `batchId` | Direct `'already-processed'` teruggeven, niets aanmaken |

**Deduplicatietabel (`kassa_batch_processed`):**

```sql
CREATE TABLE IF NOT EXISTS kassa_batch_processed (
    batch_id     VARCHAR(36)    NOT NULL,
    processed_at DATETIME       NOT NULL,
    user_count   INT            DEFAULT 0,
    total_amount DECIMAL(10,2)  DEFAULT 0,
    PRIMARY KEY  (batch_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
```

De tabel wordt automatisch aangemaakt bij de eerste run (`CREATE TABLE IF NOT EXISTS`).

---

### 3.3 `src/kassa_batch_receiver.php` _(nieuw)_

CLI worker die als Supervisor-managed proces draait. Volgt exact hetzelfde patroon als `crm_company_receiver.php`.

**Werking:**

1. Verbindt met RabbitMQ via `RabbitMQService`
2. Declareert en bindt de queue `facturatie.kassa.batch.closed` aan `kassa.closed`
3. Wacht op berichten in een oneindige loop
4. Per bericht:
   - Valideert XML tegen `kassa_batch_contract.xsd` via `validateXMLForRoutingKey()`
   - Roept `KassaBatchReceiverService::process()` aan
   - ACK bij succes of ongeldige XML (validatiefout = poison message)
   - NACK bij onverwachte fout (bericht blijft in queue)
5. Bij verbindingsverlies: logt de fout, wacht 500ms, herverbindt automatisch
6. SIGTERM / SIGINT: stopt de loop netjes na het huidige bericht

---

### 3.4 `src/library/FOSSBilling/RabbitMQService.php` _(gewijzigd)_

De routing key `kassa.closed` is toegevoegd aan de `$schemaPaths` map zodat XSD-validatie automatisch wordt uitgevoerd:

```php
'kassa.closed' => $defaultKassaBatchSchemaPath,
```

Het schemapad wijst naar `src/data/contracts/kassa_batch_contract.xsd`.

---

### 3.5 `docker/supervisor/supervisord.conf` _(gewijzigd)_

Nieuwe Supervisor-programma-entry voor de kassa batch worker:

```ini
[program:kassa-batch-receiver]
command=/usr/local/bin/php /var/www/html/kassa_batch_receiver.php
autostart=true
autorestart=true
startsecs=0
startretries=999
stderr_logfile=/var/log/supervisor/kassa-batch-receiver.err.log
stdout_logfile=/var/log/supervisor/kassa-batch-receiver.out.log
priority=993
```

---

## 4. Dataflow

### Scenario 1 — Batch met gebruikers

```
Kassa sluit dagelijks af
  → publiceert BatchClosed XML op kassa.topic (routing key: kassa.closed)

kassa_batch_receiver.php (Supervisor worker)
  → ontvangt bericht uit queue facturatie.kassa.batch.closed
  → RabbitMQService::validateXMLForRoutingKey('kassa.closed', $xml)
      → XSD validatie tegen kassa_batch_contract.xsd
  → KassaBatchReceiverService::process('kassa.closed', $xml)
      → ensureBatchTable()
      → parseBatchClosed($xml)
      → isBatchAlreadyProcessed($batchId) → nee
      → Per user:
          → findClientByAid($userId)      → client gevonden
          → createClientInvoice()         → FOSS000XX aangemaakt + goedgekeurd
      → Per bedrijf:
          → generateCompanySummaryInvoiceByCompanyId()  → FOSS000YY aangemaakt
      → markBatchAsProcessed($batchId)
      → return 'processed'
  → basic_ack()
```

### Scenario 2 — Lege batch

```
Kassa publiceert BatchClosed zonder <users>
  → KassaBatchReceiverService::process()
      → users === [] → markBatchAsProcessed($batchId, 0, 0.0)
      → return 'empty-batch'
  → basic_ack()
```

### Scenario 3 — Dubbele batch (deduplicatie)

```
Zelfde batchId opnieuw ontvangen
  → isBatchAlreadyProcessed($batchId) → ja
  → return 'already-processed'
  → basic_ack()   [bericht weggooien, niet opnieuw verwerken]
```

---

## 5. Client-bedrijf koppeling

De koppeling tussen een Kassa-gebruiker en een Facturatie-client verloopt via het `aid`-veld:

| Kassa | Facturatie |
|-------|------------|
| `userId` (UUID) | `client.aid` (UUID) |
| — | `client.company_id` → verwijst naar `company.id` |

De client moet in FOSSBilling een `company_id` hebben om de bedrijfsfactuur te triggeren. Een client zonder `company_id` krijgt wel een individuele factuur, maar er wordt geen bedrijfsfactuur aangemaakt.

---

## 6. Testen

### Smoke test uitvoeren

```bash
# Stap 1: containers bouwen en starten
docker compose up -d --build

# Stap 2: smoke test kopiëren naar container
docker cp test/smoke_kassa_batch_receiver.php facturatie-web-1:/var/www/html/smoke_kassa_batch_receiver.php

# Stap 3: smoke test uitvoeren
docker exec facturatie-web-1 php //var/www/html/smoke_kassa_batch_receiver.php
```

### Verwachte output

```
=== Smoke test: US-10 Kassa Batch Receiver ===

[1] XSD validatie...
   ✅ XSD bestand aanwezig
   ✅ Geldig XML slaagt XSD validatie
   ✅ Ongeldig XML (missing currency) wordt afgewezen door XSD

[2] Testdata aanmaken...
   ✅ Bedrijf aangemaakt (id=...)
   ✅ Client aangemaakt (id=..., aid=...)

[3] Lege batch verwerken...
   ✅ Lege batch geeft 'empty-batch' terug

[4] Batch verwerken (1 user, 2 items)...
   ✅ Batch verwerkt (result='processed')
   ✅ Nieuwe facturen aangemaakt (count=2)
   ✅ Batch opgeslagen in kassa_batch_processed (user_count=1)
   ✅ Individuele factuur aangemaakt (invoice_id=...)
   ✅ Factuur bevat batchId in notes

[5] Deduplicatie (zelfde batchId opnieuw)...
   ✅ Dubbele batch geeft 'already-processed' terug

[6] Onbekende userId wordt overgeslagen (geen crash)...
   ✅ Batch met onbekende userId verwerkt zonder crash (result='processed')
   ✅ Geen factuur aangemaakt voor onbekende userId

[7] Ongeldige routing key geeft exception...
   ✅ Ongeldige routing key gooit InvalidArgumentException

✅ Alle testen geslaagd! US-10 KassaBatchReceiverService werkt correct.
```

### Handmatig testen via RabbitMQ Management UI

1. Open `http://localhost:15672` (user: `devuser`, pass: `devpass`)
2. Ga naar **Exchanges** → `kassa.topic`
3. Klik **Publish message**
4. Routing key: `kassa.closed`
5. Plak een geldig `BatchClosed` XML bericht (zie sectie 2)
6. Controleer facturen in FOSSBilling admin (`http://localhost:8080/admin/invoice`)

### Testresultaat (2026-04-22)

End-to-end test geslaagd op branch `feature/US-10-invoice-generation-company`:
- **FOSS00019** — individuele factuur "Kassa Test" — €9.50
- **FOSS00020** — bedrijfsfactuur "Demo Bedrijf NV" — €54.99

---

## 7. Omgevingsvariabelen

| Variabele | Standaardwaarde | Beschrijving |
|-----------|-----------------|--------------|
| `KASSA_BATCH_EXCHANGE` | `kassa.topic` | Naam van de RabbitMQ exchange |
| `KASSA_BATCH_QUEUE` | `facturatie.kassa.batch.closed` | Naam van de durable queue |
| `KASSA_BATCH_PREFETCH` | `1` | Aantal berichten tegelijk (1 = serieel) |
| `KASSA_BATCH_WAIT_TIMEOUT_SEC` | `1.0` | Wachttijd per poll-iteratie in seconden |
| `RABBITMQ_HOST` | `rabbitmq` | Hostname van de RabbitMQ server |
| `RABBITMQ_PORT` | `5672` | Poort van RabbitMQ |
| `RABBITMQ_USER` | `devuser` | RabbitMQ gebruikersnaam |
| `RABBITMQ_PASS` | `devpass` | RabbitMQ wachtwoord |

---

## 8. Vergelijking met US-09 (individuele kassafactuur)

US-10 bouwt verder op het patroon van US-09 maar verwerkt een **batch** in plaats van één order per bericht:

| Aspect | US-09 (individueel) | US-10 (batch) |
|--------|---------------------|---------------|
| Routing key | `kassa.invoice.requested` | `kassa.closed` |
| XML contract | `InvoiceRequested` (K-01) | `BatchClosed` (K-02) |
| XSD | `kassa_contract.xsd` | `kassa_batch_contract.xsd` |
| Worker | `ConsumeKassaCommand.php` | `kassa_batch_receiver.php` |
| Service | `ConsumeKassaCommand` (intern) | `KassaBatchReceiverService` |
| Deduplicatie op | `order_id` | `batch_id` |
| Bedrijfsfactuur | ja | ja |
| Users per bericht | 1 | 0..n |

# Flow 2 — Company CRUD: Facturatie → CRM

**Branch:** `feature/company-crud-to-crm`
**Verantwoordelijke:** Bilal Bouchta
**Datum:** 2026-04-02
**Status:** Volledig geïmplementeerd en getest

---

## 1. Overzicht

Flow 2 maakt Facturatie (FOSSBilling) verantwoordelijk voor het publiceren van bedrijfsgegevens naar de CRM via RabbitMQ. Telkens wanneer een bedrijf wordt aangemaakt, bijgewerkt of verwijderd in FOSSBilling, wordt er een XML-bericht gepubliceerd op de `company.topic` exchange. De CRM consumeert deze berichten om zijn eigen bedrijfsdata synchroon te houden.

**Richting:** Facturatie → CRM
**Rol van Facturatie:** Producer (publisher) — geen queues aangemaakt
**RabbitMQ exchange:** `company.topic` (type: topic, durable: true)

---

## 2. Routing keys & XML contracten

| Actie              | Routing key                      | XML root element       | XSD element          |
| ------------------ | -------------------------------- | ---------------------- | -------------------- |
| Bedrijf aangemaakt | `facturatie.company.created`     | `<CompanyCreated>`     | `CompanyCreated`     |
| Bedrijf bijgewerkt | `facturatie.company.updated`     | `<CompanyUpdated>`     | `CompanyUpdated`     |
| Bedrijf verwijderd | `facturatie.company.deactivated` | `<CompanyDeactivated>` | `CompanyDeactivated` |

Alle berichten worden vóór het versturen gevalideerd tegen het XSD-schema.

---

## 3. Gewijzigde en toegevoegde bestanden

### 3.1 `src/data/contracts/facturatie_company_contract.xsd` _(nieuw)_

XSD-schema met de definities voor alle drie de outgoing events. Gebaseerd op hetzelfde patroon als `facturatie_user_contract.xsd`.

**Gedeelde simple types:**

- `UUIDType` — UUID v4 patroon
- `ISO8601DateTimeType` — `xs:dateTime`
- `CountryCodeType` — 2-letter ISO landcode (`[A-Z]{2}`)
- `EmailType` — e-mailadres, max 254 tekens
- `BelgianVatNumberType` — Belgisch BTW-nummer (`BE` + 10 cijfers)

**`CompanyCreated` velden:**

| Veld          | Type                   | Verplicht |
| ------------- | ---------------------- | --------- |
| `name`        | `xs:string`            | ja        |
| `vatNumber`   | `BelgianVatNumberType` | nee       |
| `email`       | `EmailType`            | nee       |
| `phone`       | `xs:string`            | nee       |
| `street`      | `xs:string`            | nee       |
| `houseNumber` | `xs:string`            | nee       |
| `postalCode`  | `xs:string`            | nee       |
| `city`        | `xs:string`            | nee       |
| `country`     | `CountryCodeType`      | nee       |
| `createdAt`   | `ISO8601DateTimeType`  | ja        |

**`CompanyUpdated` velden:**

| Veld          | Type                   | Verplicht |
| ------------- | ---------------------- | --------- |
| `id`          | `UUIDType`             | ja        |
| `vatNumber`   | `BelgianVatNumberType` | nee       |
| `name`        | `xs:string`            | ja        |
| `email`       | `EmailType`            | nee       |
| `phone`       | `xs:string`            | nee       |
| `street`      | `xs:string`            | nee       |
| `houseNumber` | `xs:string`            | nee       |
| `postalCode`  | `xs:string`            | nee       |
| `city`        | `xs:string`            | nee       |
| `country`     | `CountryCodeType`      | nee       |
| `isActive`    | `xs:boolean`           | ja        |
| `updatedAt`   | `ISO8601DateTimeType`  | ja        |

**`CompanyDeactivated` velden:**

| Veld            | Type                  | Verplicht |
| --------------- | --------------------- | --------- |
| `id`            | `UUIDType`            | ja        |
| `email`         | `EmailType`           | ja        |
| `deactivatedAt` | `ISO8601DateTimeType` | ja        |

---

### 3.2 `src/library/FOSSBilling/FacturatieCompanyPublisherService.php` _(nieuw)_

Publisher service die de drie company events opbouwt, valideert en publiceert naar RabbitMQ.

**Constanten:**

```php
ROUTING_KEY_CREATED     = 'facturatie.company.created'
ROUTING_KEY_UPDATED     = 'facturatie.company.updated'
ROUTING_KEY_DEACTIVATED = 'facturatie.company.deactivated'
DEFAULT_EXCHANGE        = 'company.topic'
```

**Publieke methoden:**

| Methode                              | Beschrijving                                             |
| ------------------------------------ | -------------------------------------------------------- |
| `publishCreated(array $company)`     | Publiceert een `CompanyCreated` event na aanmaken        |
| `publishUpdated(array $company)`     | Publiceert een `CompanyUpdated` event na bijwerken       |
| `publishDeactivated(array $company)` | Publiceert een `CompanyDeactivated` event na verwijderen |

**Interne werking:**

- `ensureTopology()` — declareert de `company.topic` exchange éénmalig (geen queues, producer-only)
- `buildCreatedPayload()` / `buildUpdatedPayload()` — bouwt het PHP-array payload op uit de ruwe company data
- `buildCreatedXml()` / `buildUpdatedXml()` / `buildDeactivatedXml()` — genereert de XML via `DOMDocument`
- `resolveCompanyId()` — valideert dat het `id` een geldige UUID v4 is voor updated/deactivated events
- `normalizeCountryCode()` — normaliseert landcode naar 2-letter hoofdletters, of `null`
- `toIso8601()` — converteert datum naar ISO 8601 formaat (`Y-m-d\TH:i:sP`)
- Exchange naam leesbaar via env-variabele `FACTURATIE_COMPANY_EXCHANGE` (fallback: `company.topic`)

**Foutafhandeling:**

- Bij een mislukte publish wordt de exception gelogd en opnieuw gegooid
- Bij ontbrekende UUID voor updated/deactivated: logt een waarschuwing en slaat de publish over (geen crash)

---

### 3.3 `src/modules/Company/Service.php` _(gewijzigd)_

De bestaande Company Service is uitgebreid met RabbitMQ-publicatie na elke CRUD-operatie.

**Toegevoegde import:**

```php
use FOSSBilling\FacturatieCompanyPublisherService;
```

**Wijzigingen per methode:**

- `create()` — roept `tryPublishCreated()` aan na de INSERT, met volledige payload inclusief `id`, `created_at`, `updated_at`
- `update()` — roept `tryPublishUpdated()` aan na de UPDATE
- `delete()` — roept `tryPublishDeactivated()` aan **na** beide DB-operaties (UPDATE clients + DELETE company)

**Toegevoegde private methoden:**

```php
tryPublishCreated(array $companyData): void
tryPublishUpdated(array $companyData): void
tryPublishDeactivated(array $companyData): void
logPublishError(string $action, array $companyData, \Throwable $exception): void
```

De `tryPublish*` methoden zijn **non-blocking**: een RabbitMQ-fout gooit de CRUD-operatie niet terug. De fout wordt gelogd via de applicatielogger.

---

### 3.4 `src/library/FOSSBilling/RabbitMQService.php` _(gewijzigd)_

De drie company routing keys zijn geregistreerd in de `$schemaPaths` map zodat `publishXML()` automatisch de juiste XSD-validatie uitvoert:

```php
'facturatie.company.created'     => $defaultFacturatieCompanySchemaPath,
'facturatie.company.updated'     => $defaultFacturatieCompanySchemaPath,
'facturatie.company.deactivated' => $defaultFacturatieCompanySchemaPath,
```

Het schemapad wijst naar `src/data/contracts/facturatie_company_contract.xsd`.

---

## 4. Dataflow per scenario

### Scenario 1 — Bedrijf aanmaken

```
Admin API (POST /admin/company/create)
  → Company\Service::create()
      → INSERT INTO company (...)
      → tryPublishCreated()
          → FacturatieCompanyPublisherService::publishCreated()
              → ensureTopology()  [declareert company.topic exchange]
              → buildCreatedXml() [DOMDocument]
              → RabbitMQService::publishXML('facturatie.company.created', $xml)
                  → validateXml($xml, facturatie_company_contract.xsd)  [XSD validatie]
                  → channel->basic_publish() naar company.topic
```

### Scenario 2 — Bedrijf bijwerken

```
Admin API (POST /admin/company/update)
  → Company\Service::update()
      → UPDATE company SET ... WHERE id = ?
      → tryPublishUpdated()
          → FacturatieCompanyPublisherService::publishUpdated()
              → resolveCompanyId()  [controleert UUID v4]
              → buildUpdatedXml()
              → RabbitMQService::publishXML('facturatie.company.updated', $xml)
                  → XSD validatie + basic_publish()
```

### Scenario 3 — Bedrijf verwijderen

```
Admin API (POST /admin/company/delete)
  → Company\Service::delete()
      → UPDATE client SET company_id = NULL WHERE company_id = ?
      → DELETE FROM company WHERE id = ?
      → tryPublishDeactivated()  [pas NA de DB-operaties]
          → FacturatieCompanyPublisherService::publishDeactivated()
              → resolveCompanyId()
              → buildDeactivatedXml()
              → RabbitMQService::publishXML('facturatie.company.deactivated', $xml)
                  → XSD validatie + basic_publish()
```

---

## 5. Bugs gevonden en opgelost

### Bug 1 — Verkeerd veld in `CompanyDeactivated`

**Probleem:** De initiële implementatie gebruikte `vatNumber` als veld in het `CompanyDeactivated` event, maar het officiële XML-contract specificeert `id`, `email` en `deactivatedAt`.

**Oplossing:**

- `facturatie_company_contract.xsd`: `vatNumber` vervangen door `email` (verplicht, type `EmailType`)
- `FacturatieCompanyPublisherService`: payload en `buildDeactivatedXml()` aangepast

### Bug 2 — Verkeerde volgorde in `delete()`

**Probleem:** `tryPublishDeactivated()` werd aangeroepen **vóór** de DB-operaties. Als de DELETE mislukte, was er al een vals deactivation-event gepubliceerd.

**Oplossing:** `tryPublishDeactivated()` verplaatst naar **na** de twee `exec()`-aanroepen.

---

## 6. Testen

### Smoke test uitvoeren

De smoke test bevindt zich in `test/smoke_company_crud_publish.php`.

```bash
# Stap 1: containers bouwen en starten
docker compose up -d --build

# Stap 2: testbestand kopiëren naar container
docker compose exec web sh -c 'mkdir -p /var/www/html/test'
docker cp test/smoke_company_crud_publish.php facturatie-web-1:/var/www/html/test/smoke_company_crud_publish.php

# Stap 3: smoke test uitvoeren
docker compose exec web sh -c 'php /var/www/html/test/smoke_company_crud_publish.php'
```

### Verwachte output

```
Created company id=<uuid>
Updated company id=<uuid>
Deleted company id=<uuid>
--- Captured messages ---
facturatie.company.created | CompanyCreated
facturatie.company.updated | CompanyUpdated
facturatie.company.deactivated | CompanyDeactivated
--- Assertions ---
created=yes
updated=yes
deactivated=yes
Smoke test passed: Company create/update/delete correctly emits facturatie.company.* CRM sync messages.
```

### Wat de smoke test doet

1. Maakt een tijdelijke probe-queue aan gebonden aan `facturatie.company.*` op `company.topic`
2. Roept create, update en delete aan via de Admin API
3. Wacht op berichten via `basic_get` (max 12 seconden)
4. Controleert of alle drie routing keys aanwezig zijn
5. Verwijdert de probe-queue en sluit de connectie

### Testresultaat (2026-04-02)

Test geslaagd op branch `feature/company-crud-to-crm` na merge van main. Alle drie events correct ontvangen en gevalideerd.

---

## 7. Omgevingsvariabelen

| Variabele                     | Standaardwaarde | Beschrijving                                      |
| ----------------------------- | --------------- | ------------------------------------------------- |
| `FACTURATIE_COMPANY_EXCHANGE` | `company.topic` | Naam van de RabbitMQ exchange voor company events |
| `RABBITMQ_HOST`               | `rabbitmq`      | Hostname van de RabbitMQ server                   |
| `RABBITMQ_PORT`               | `5672`          | Poort van RabbitMQ                                |
| `RABBITMQ_USER`               | `devuser`       | RabbitMQ gebruikersnaam                           |
| `RABBITMQ_PASS`               | `devpass`       | RabbitMQ wachtwoord                               |

---

## 8. Vergelijking met Flow 1 (Users van Facturatie naar CRM)

Flow 2 volgt exact hetzelfde patroon als de user-implementatie van de teamleider:

| Aspect            | Users (teamleider)               | Companies (Bilal)                   |
| ----------------- | -------------------------------- | ----------------------------------- |
| Publisher service | `FacturatieUserPublisherService` | `FacturatieCompanyPublisherService` |
| Exchange          | `user.topic`                     | `company.topic`                     |
| Routing keys      | `facturatie.user.*`              | `facturatie.company.*`              |
| XSD contract      | `facturatie_user_contract.xsd`   | `facturatie_company_contract.xsd`   |
| Geïntegreerd in   | `Client/Service.php`             | `Company/Service.php`               |
| Publish na DB?    | ja                               | ja                                  |
| Non-blocking?     | nee (gooit opnieuw)              | ja (try/catch in Service)           |
| Producer-only?    | ja                               | ja                                  |

# FOSSBilling

Local Docker setup for FOSSBilling `0.7.2`.

## Stack

- `web`: Nginx + PHP-FPM + cron (single container), exposed on `http://localhost:${WEB_PORT}` (default `http://localhost:8080`)
- `db`: MariaDB 10.11
- `rabbitmq`: AMQP + UI (`http://localhost:15672`)

## Prerequisites

Docker Desktop (Win/Mac) or Docker Engine (Linux) running on your machine.

## 1) Clone and configure

```bash
git clone https://github.com/Integration-Project-2026-Groep-2/Facturatie.git
cd Facturatie
```

Copy the following files from `ClickUp` (Important Files Page) to the specified locations:

- `.env` in **project root**.
- `config.php` in **`src`** folder.

## 2) Build and start services

From **project root**, run:

```bash
docker compose up -d --build
docker compose ps
```

- You should see 3 services running: web, db, rabbitmq.
- On first build, the web image may take several minutes.
- Rebuilds are faster now because Docker context is trimmed and PHP dependencies are cached by `composer.lock`.
- Check logs with `docker compose logs -f web`.
- Open `http://localhost:${WEB_PORT}` (default `http://localhost:8080`).

### Build cache behavior

- If only PHP source files change, dependency layers stay cached and rebuilds should be much quicker.
- If `src/composer.json` or `src/composer.lock` changes, Docker will rebuild the Composer dependency layer.
- Use `docker compose build --no-cache` only when you need a full clean rebuild.

## Database bootstrap (schema-first)

The database container now expects:

- `docker/db/init/baseline-schema.sql` (required): schema-only SQL (tables, indexes, routines, triggers)
- `docker/db/init/seed-data.sql` (optional): minimal non-sensitive defaults

Do not commit full local databases. Keep personal and transactional data out of repository SQL files.

### Generate baseline schema from current dump

From project root in PowerShell:

```powershell
./scripts/generate-baseline-schema.ps1
```

This script:

- converts `db-full.sql` to UTF-8 if needed,
- imports it into a temporary MariaDB container,
- exports schema-only SQL to `docker/db/init/baseline-schema.sql`.

After generation, review `docker/db/init/baseline-schema.sql` and keep `docker/db/init/seed-data.sql` minimal.

### Clean bootstrap test

To verify first-start behavior with a fresh DB volume:

```bash
docker compose down -v
docker compose up -d --build
docker compose logs -f db
```

## 3) Create admin user

- Open `http://localhost:${WEB_PORT}/admin` in your browser.
- Log in with admin account
    - Email: admin@ehb.be
    - Password: Fossbilling123

If you see the following message above the dashboard, you can safely ignore it:

```
Danger! Cron was never executed, please ensure you have configured the cronjob or else scheduled tasks within FOSSBilling will not behave correctly.
```

## Daily workflow

```bash
docker compose up -d --build
docker compose logs -f web
docker compose down
```

## Heartbeat publisher

The web container starts a background heartbeat publisher that sends an XML heartbeat every 1 second to RabbitMQ.

- Routing key: `facturatie.heartbeat`
- Exchange: `heartbeat.direct` (or your `HEARTBEAT_EXCHANGE` value)
- Schema: `src/data/contracts/heartbeat_contract.xsd`

Optional environment variables:

- `HEARTBEAT_ENABLED=1` to enable (set to `0` to disable)
- `HEARTBEAT_SERVICE_ID=facturatie` to set service identifier
- `HEARTBEAT_ROUTING_KEY=facturatie.heartbeat` to customize routing key
- `HEARTBEAT_INTERVAL_MS=1000` to change interval in milliseconds

## CI parity: bidirectional user flow tests

The CI pipeline validates user synchronization in both directions:

- Outbound: FOSSBilling -> RabbitMQ (`facturatie.user.*`)
- Inbound: RabbitMQ -> FOSSBilling (`crm.user.*`)

## Port notes for infra

- Keep container port `80` as-is (Nginx listens on 80 internally).
- Set host port via `WEB_PORT` in `.env` (for example `8080` or `80`).
- If multiple systems run on the same host, use different host ports or a reverse proxy.

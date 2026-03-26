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

Copy the following files from `Teams` (Shared) to the specified locations:

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
- Check logs with `docker compose logs -f web`.
- Open `http://localhost:${WEB_PORT}` (default `http://localhost:8080`).

## 3) Create admin user

- Open `http://localhost:${WEB_PORT}/admin` in your browser.
- Create an admin account with your email and password.

If you see the following message above the dashboard, you can safely ignore it:

```
Danger! Cron was never executed, please ensure you have configured the cronjob or else scheduled tasks within FOSSBilling will not behave correctly.
```

## Daily workflow

```bash
docker compose up -d
docker compose logs -f web
docker compose down
```

## Heartbeat publisher

The web container starts a background heartbeat publisher that sends an XML heartbeat every 1 second to RabbitMQ.

- Routing key: `facturatie.heartbeat`
- Exchange: `ehb.events` (or your `RABBITMQ_EXCHANGE` value)
- Schema: `src/data/contracts/hearbeat_contract.xsd`

Optional environment variables:

- `HEARTBEAT_ENABLED=1` to enable (set to `0` to disable)
- `HEARTBEAT_SERVICE_ID=facturatie` to set service identifier
- `HEARTBEAT_ROUTING_KEY=facturatie.heartbeat` to customize routing key
- `HEARTBEAT_INTERVAL_MS=1000` to change interval in milliseconds

## Port notes for infra

- Keep container port `80` as-is (Nginx listens on 80 internally).
- Set host port via `WEB_PORT` in `.env` (for example `8080` or `80`).
- If multiple systems run on the same host, use different host ports or a reverse proxy.

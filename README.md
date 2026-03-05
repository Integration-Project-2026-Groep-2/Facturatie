# FOSSBilling

Local Docker setup for FOSSBilling `0.7.2`.

## Stack

- `web`: Nginx on `http://localhost:8080`
- `app`: PHP-FPM 8.3
- `db`: MariaDB 10.11
- `rabbitmq`: AMQP + UI (`http://localhost:15672`)

<br>

## Prerequisites

Docker Desktop (Win/Mac) or Docker Engine (Linux) running on your machine.

<br>

## 1) Clone and configure

```bash
git clone https://github.com/Integration-Project-2026-Groep-2/Facturatie.git
cd Facturatie
```

Copy the following files from `Teams` (Shared) to the specified locations:

- `.env` in **project root**.
- `compose.yml` in **project root**.
- `config.php` in **`src`** folder.

<br>

## 2) Build and start services

From **project root**, run:

```bash
docker compose up -d --build
docker compose ps
```

- You should see 4 services running: web, app, db, rabbitmq.
- **Wait until app container has finished installing dependencies** (this can take a few minutes). Check logs with `docker compose logs -f app`.
- Open `http://localhost:8080`.

<br>

## 3) Create admin user

- Open `http://localhost:8080/admin` in your browser.
- Create an admin account with your email and password.

If you see the following message above the dashboard, you can safely ignore it:

```
Danger! Cron was never executed, please ensure you have configured the cronjob or else scheduled tasks within FOSSBilling will not behave correctly.
```

<br>

## Daily workflow

```bash
docker compose up -d
docker compose logs -f app
docker compose down
```

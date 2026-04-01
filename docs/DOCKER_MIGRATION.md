# Docker Migration: From "IKEA Model" to "Shipping Container Model"

## What Changed

### Before (Volume-Based IKEA Model)

- **Separate containers**: Nginx and PHP-FPM ran in different containers
- **Volume mounts**: Code was mounted from host machine at runtime via `-v ./src:/var/www/html`
- **Configuration scattered**: Nginx config, PHP code, and entrypoint scripts were on the host filesystem
- **Deployment complexity**: Infra team had to manually place files in exact locations

```
Host Machine                Docker Container
./src         ────────────→  /var/www/html (at runtime)
./docker/nginx/default.conf → /etc/nginx/conf.d/default.conf
```

### After (Image-Based Shipping Container Model)

- **Single combined image**: Nginx + PHP-FPM + Cron all in one container
- **Code baked in**: Source code is `COPY`'d into the image during build
- **Zero host dependencies**: Infra team only needs the image; no files to place manually
- **Atomic versioning**: Update code → rebuild image → deploy new version

```
Build Time                   Runtime
./src  ──┐                  Docker Image
./docker ├─→ docker build → my-registry.com/facturatie:v1.0
config   │                  (everything inside)
         └→ Dockerfile
```

---

## Files Modified

### 1. **`docker/php/Dockerfile`** (Major Changes)

**Added:**

- `nginx` and `supervisor` packages installed at system level
- `COPY src/ /var/www/html/` - Bakes application code into image
- `COPY docker/nginx/default.conf` - Bakes Nginx config into image
- `EXPOSE 80` - Declares HTTP port
- Supervisor configuration copied for process management

**Removed:**

- Volume-dependent commands (code is now here, not mounted at runtime)

### 2. **`docker/supervisor/supervisord.conf`** (New File)

**Purpose**: Manages three processes inside the container:

- **php-fpm**: Web application handler
- **nginx**: Reverse proxy and static file server
- **cron**: Scheduled task runner (FOSSBilling cron jobs)

All three are monitored and auto-restarted if they fail.

### 3. **`docker/php/docker-entrypoint.sh`** (Updated)

**Changes:**

- Removed: `service cron start` (now managed by supervisor)
- Removed: `exec php-fpm -F` (now managed by supervisor)
- Added: `exec /usr/bin/supervisord` - Starts supervisor to manage all processes
- Keeps: Composer install, heartbeat publisher logic

### 4. **`docker/nginx/default.conf`** (Updated)

**Changes:**

- `fastcgi_pass app:9000` → `fastcgi_pass 127.0.0.1:9000`
- **Why**: In the old setup, `app` was a separate container hostname. Now Nginx and PHP-FPM are in the same container, so we use localhost.

### 5. **`compose.yml`** (Simplified)

**Removed:**

- Separate `web:` service (Nginx container)
- All `volumes:` entries (`- ./src:/var/www/html`, etc.)

**Updated:**

- `app:` renamed to `web:` (single combined service)
- Port changed from `8080:80` to `80:80` (infrastructure convention)
- `env_file: .env` and environment variables kept as-is

**New structure:**

```yaml
services:
    web: # Single image = Nginx + PHP + Cron
        build: ./docker/php
        ports: ["80:80"] # Infrastructure team only opens this one port
        env_file: .env
        environment:
            - DB_HOST=db
            - RABBITMQ_HOST=rabbitmq
        depends_on: [db, rabbitmq]

    db, rabbitmq: # Unchanged
```

---

## Deployment Implications

### For Your Team (Development)

```bash
# Old: Manual code sync (IKEA model)
docker compose up
# → Code is mounted, any file change is instant ✓

# New: Code baked in (shipping container model)
docker compose up
# → Code is inside image, changes require rebuild
docker compose up --build   # Rebuild the image first
# → Code updates take effect ✓
```

### For Infra Team (Production)

```bash
# Old: They need to download and place files
scp -r ./src user@server:/opt/facturatie/src
scp ./docker/nginx/default.conf user@server:/opt/facturatie/docker/nginx/
scp ./.env user@server:/opt/facturatie/
# ❌ Risk: Files might be placed wrong, causing crashes

# New: They only need the image
docker pull my-registry.com/facturatie:v1.0
docker run -p 80:80 -d my-registry.com/facturatie:v1.0
# ✓ Atomic, reproducible, no manual file placement
```

### Rollback (Versioning)

```bash
# Old: Manual rollback
scp -r ./src-v0.9 user@server:/opt/facturatie/src
# ❌ Error-prone

# New: Version via image tags
docker pull my-registry.com/facturatie:v0.9  # Easy!
docker run -p 80:80 -d my-registry.com/facturatie:v0.9
# ✓ Instant, guaranteed consistency
```

---

## Architecture Diagram

```
┌─────────────────────────────────────────────┐
│           Docker Image Layer                 │
├─────────────────────────────────────────────┤
│ FROM php:8.3-fpm (base)                     │
│ ├─ System packages (nginx, supervisor)      │
│ ├─ PHP extensions (intl, gd, etc.)          │
│ ├─ Composer binaries                        │
│ ├─ Application code (./src) → COPY          │
│ ├─ Nginx config (default.conf) → COPY       │
│ ├─ Entrypoint script                        │
│ └─ Supervisor config                        │
└─────────────────────────────────────────────┘
                    ↓
         At Runtime (docker run)
                    ↓
┌──────────────────────────────────────┐
│   Docker Container (single)           │
├──────────────────────────────────────┤
│  PID 1: /usr/bin/supervisord         │
│   ├─ [nginx] → port 80 (HTTP)        │
│   ├─ [php-fpm] → 127.0.0.1:9000      │
│   └─ [cron] → FOSSBilling tasks      │
│  PID X: heartbeat.php → RabbitMQ    │
└──────────────────────────────────────┘
         ↓              ↓
      [Redis]      [MariaDB]
    (optional)   (separate service)
```

---

## How It Works at Runtime

1. **Image Build** (`docker build`):
    - OS + PHP extensions installed
    - Source code COPY'd in (no volumes)
    - Nginx config baked in
    - Result: Single image with everything needed

2. **Container Start** (`docker run`):
    - `docker-entrypoint.sh` runs:
        - ✓ Composer install (if needed)
        - ✓ Start heartbeat publisher
        - ✓ Launch supervisor
    - Supervisor starts three processes:
        - **PHP-FPM** (application handler) on 127.0.0.1:9000
        - **Nginx** (reverse proxy) on 0.0.0.0:80
        - **Cron** (scheduled tasks) in background

3. **Request Flow**:
    ```
    Internet → Port 80 (Nginx)
               → Pass FastCGI → PHP-FPM (127.0.0.1:9000)
               → Execute application logic
               → Query Database (mariadb service)
               → Publish to RabbitMQ (rabbitmq service)
               → Return response to client
    ```

---

## Database Bootstrap Strategy (No Full Dump in Git)

The DB bootstrap now uses schema-first initialization instead of importing a full local database dump.

- Required file: `docker/db/init/baseline-schema.sql`
- Optional file: `docker/db/init/seed-data.sql`

### Why this is better

- Avoids committing personal/operational data to source control.
- Keeps first boot deterministic and reproducible.
- Works with persistent Docker volumes across image rebuilds.

### Generate baseline schema from current `db-full.sql`

From project root in PowerShell:

```powershell
./scripts/generate-baseline-schema.ps1
```

The script converts UTF-16LE dumps to UTF-8, imports into a temporary MariaDB 10.11 container, and exports schema-only SQL.

### First-boot behavior

On a clean database volume, the DB init script imports:

1. `docker/db/init/baseline-schema.sql` (required)
2. `docker/db/init/seed-data.sql` only if present and non-empty

The init script then validates that critical tables exist before marking initialization as complete.

### Reset and rebuild

Use this only when you intentionally want a fresh database:

```bash
docker compose down -v
docker compose up -d --build
```

If you do not remove the DB volume, table/data state persists across image rebuilds.

---

## Testing the Migration

```bash
# Build and run
docker compose up --build

# Test the app
curl http://localhost/
# Should see FOSSBilling frontend ✓

# Verify processes are running
docker compose exec web ps aux
# Should see: supervisord, nginx, php-fpm, cron ✓

# Check logs
docker compose logs web
# Should see: all three processes starting successfully ✓

# Stop and verify isolation (no volume coupling)
docker compose down
# All data is inside the image—no cleanup needed ✓
```

---

## Summary: Why This Matters for Infra

| Aspect                    | IKEA Model                                      | Shipping Container                              |
| ------------------------- | ----------------------------------------------- | ----------------------------------------------- |
| **Files Infra Needs**     | `src/`, `docker/`, `.env`, `docker-compose.yml` | `docker-compose.yml` (+ Docker registry access) |
| **Deployment Risk**       | High (files can be misplaced)                   | Low (image is atomic)                           |
| **Rollback Speed**        | Manual (risky)                                  | Instant (image pull)                            |
| **Environment Parity**    | Variable (depends on host setup)                | Guaranteed (image same everywhere)              |
| **Port Management**       | Multiple (nginx on 8080, php on 9000, etc.)     | Single (nginx on 80)                            |
| **Configuration Changes** | Restart container, files already there          | Rebuild image with new config                   |

Your FOSSBilling system is now production-ready for infrastructure deployment! 🎉

#!/bin/sh
set -eu

SQL_DIR="/fossbilling-dump"
BASELINE_SQL="$SQL_DIR/baseline-schema.sql"
SEED_SQL="$SQL_DIR/seed-data.sql"

if [ ! -f "$BASELINE_SQL" ]; then
  echo "Baseline schema not found at $BASELINE_SQL"
  exit 1
fi

echo "Importing baseline schema from $BASELINE_SQL"
mariadb --protocol=socket -u root -p"$MARIADB_ROOT_PASSWORD" "$MARIADB_DATABASE" < "$BASELINE_SQL"

if [ -s "$SEED_SQL" ]; then
  echo "Importing optional seed data from $SEED_SQL"
  mariadb --protocol=socket -u root -p"$MARIADB_ROOT_PASSWORD" "$MARIADB_DATABASE" < "$SEED_SQL"
else
  echo "No seed data file detected (or file is empty); skipping optional seed import"
fi

# Validate a minimal set of required tables so startup fails fast with a clear message.
required_tables="setting client"
for table_name in $required_tables; do
  table_exists="$(mariadb --protocol=socket -N -B -u root -p"$MARIADB_ROOT_PASSWORD" "$MARIADB_DATABASE" -e "SHOW TABLES LIKE '$table_name';")"
  if [ "$table_exists" != "$table_name" ]; then
    echo "Baseline schema validation failed: required table '$table_name' is missing"
    exit 1
  fi
done

echo "FOSSBilling database initialization completed"

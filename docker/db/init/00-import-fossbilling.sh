#!/bin/sh
set -eu

SQL_DIR="/fossbilling-dump"
FULL_SQL="$SQL_DIR/db-full.sql"

if [ -f "$FULL_SQL" ]; then
  echo "Importing consolidated FOSSBilling dump from $FULL_SQL"
  mariadb --protocol=socket -u root -p"$MARIADB_ROOT_PASSWORD" "$MARIADB_DATABASE" < "$FULL_SQL"
  echo "FOSSBilling database initialization completed"
  exit 0
fi

echo "FOSSBilling dump not found at $FULL_SQL"
exit 1

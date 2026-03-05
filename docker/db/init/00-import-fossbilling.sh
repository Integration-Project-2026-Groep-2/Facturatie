#!/bin/sh
set -eu

SQL_DIR="/fossbilling-install-sql"
STRUCTURE_SQL="$SQL_DIR/structure.sql"
CONTENT_SQL="$SQL_DIR/content.sql"

if [ ! -f "$STRUCTURE_SQL" ] || [ ! -f "$CONTENT_SQL" ]; then
  echo "FOSSBilling SQL seed files not found at $SQL_DIR"
  echo "Expected: structure.sql and content.sql"
  exit 1
fi

echo "Importing FOSSBilling schema from $STRUCTURE_SQL"
mariadb --protocol=socket -u root -p"$MARIADB_ROOT_PASSWORD" "$MARIADB_DATABASE" < "$STRUCTURE_SQL"

echo "Importing FOSSBilling seed data from $CONTENT_SQL"
mariadb --protocol=socket -u root -p"$MARIADB_ROOT_PASSWORD" "$MARIADB_DATABASE" < "$CONTENT_SQL"

echo "FOSSBilling database initialization completed"

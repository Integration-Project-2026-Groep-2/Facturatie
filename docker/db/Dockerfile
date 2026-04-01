FROM mariadb:10.11

# Copy initialization scripts into the standard MariaDB init directory.
# These run automatically on first container startup when the database is empty.
COPY docker/db/init/* /docker-entrypoint-initdb.d/

# Copy bootstrap SQL assets.
# - baseline-schema.sql is required and should contain schema-only DDL.
# - seed-data.sql is optional and can contain minimal non-sensitive defaults.
COPY baseline-schema.sql /fossbilling-dump/baseline-schema.sql
COPY seed-data.sql /fossbilling-dump/seed-data.sql

# Make sure init scripts are executable
RUN chmod +x /docker-entrypoint-initdb.d/*.sh

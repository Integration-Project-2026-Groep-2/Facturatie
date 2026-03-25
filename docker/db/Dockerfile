FROM mariadb:10.11

# Copy initialization scripts into the standard MariaDB init directory.
# These run automatically on first container startup when the database is empty.
COPY docker/db/init/* /docker-entrypoint-initdb.d/

# Copy consolidated database dump.
COPY db-full.sql /fossbilling-dump/db-full.sql

# Make sure init scripts are executable
RUN chmod +x /docker-entrypoint-initdb.d/*.sh

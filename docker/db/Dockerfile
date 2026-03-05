FROM mariadb:10.11

# Copy initialization scripts into the standard MariaDB init directory.
# These run automatically on first container startup when the database is empty.
COPY docker/db/init/* /docker-entrypoint-initdb.d/

# Copy FOSSBilling SQL seed files into a directory the init script can access.
COPY src/install/sql/* /fossbilling-install-sql/

# Make sure init scripts are executable
RUN chmod +x /docker-entrypoint-initdb.d/*.sh

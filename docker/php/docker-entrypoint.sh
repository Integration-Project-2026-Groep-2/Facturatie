#!/bin/sh
set -eu

# Install composer dependencies if not already present
if [ ! -f /var/www/html/vendor/autoload.php ]; then
    echo "Composer dependencies not found. Running composer install..."
    composer install --no-interaction --prefer-dist --working-dir=/var/www/html
fi

# Start supervisor to manage Nginx, PHP-FPM, and Cron
echo "Starting supervisor (manages Nginx, PHP-FPM, and Cron)..."
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf

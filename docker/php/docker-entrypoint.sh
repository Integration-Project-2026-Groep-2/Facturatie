#!/bin/sh
set -eu

# Ensure runtime writable directories exist
mkdir -p /var/www/html/data/cache /var/www/html/data/log /var/www/html/data/uploads

# Install composer dependencies if not already present
if [ ! -f /var/www/html/vendor/autoload.php ]; then
    echo "Composer dependencies not found. Running composer install..."
    composer install --no-interaction --prefer-dist --working-dir=/var/www/html
fi

# Setup RabbitMQ infrastructure
echo "Setting up RabbitMQ infrastructure..."
php /var/www/html/setup_rabbitmq.php

# Ensure everything in data is owned by www-data before starting services
echo "Setting permissions for www-data..."
chown -R www-data:www-data /var/www/html/data
chmod -R u+rwX,g+rwX /var/www/html/data

# Start supervisor to manage Nginx, PHP-FPM, and Cron
echo "Starting supervisor (manages Nginx, PHP-FPM, and Cron)..."
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf

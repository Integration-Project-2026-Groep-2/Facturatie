#!/bin/sh
set -eu

if [ ! -f /var/www/html/vendor/autoload.php ]; then
    echo "Composer dependencies not found. Running composer install..."
    composer install --no-interaction --prefer-dist --working-dir=/var/www/html
fi

service cron start

if [ "${HEARTBEAT_ENABLED:-1}" = "1" ]; then
    echo "Starting heartbeat publisher..."
    php /var/www/html/heartbeat.php >> /var/www/html/data/log/heartbeat.log 2>&1 &
fi

echo "Starting PHP-FPM..."
exec php-fpm -F

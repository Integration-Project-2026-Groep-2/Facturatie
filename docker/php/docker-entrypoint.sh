#!/bin/sh
set -eu

if [ ! -f /var/www/html/vendor/autoload.php ]; then
    echo "Composer dependencies not found. Running composer install..."
    composer install --no-interaction --prefer-dist --working-dir=/var/www/html
fi

service cron start

echo "Starting PHP-FPM..."
exec php-fpm -F

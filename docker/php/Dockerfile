FROM php:8.3-fpm

# 1. Install system dependencies (PHP + Nginx + supervisord)
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libmagickwand-dev \
    libbz2-dev \
    unzip \
    git \
    cron \
    nginx \
    supervisor \
    && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install intl gd pdo_mysql zip opcache sockets bz2 \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# 3. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Create cron job file for FOSSBilling
RUN printf 'SHELL=/bin/sh\nPATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin\n*/5 * * * * root /usr/local/bin/php /var/www/html/cron.php >> /var/www/html/data/log/cron.log 2>&1\n' > /etc/cron.d/fossbilling-cron && \
    chmod 0644 /etc/cron.d/fossbilling-cron

# 5. Copy application code into image (no volumes needed)
COPY src/ /var/www/html/

# 6. Copy Nginx configuration
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# 7. Create supervisor configuration to run both Nginx and PHP-FPM
RUN mkdir -p /etc/supervisor/conf.d
COPY docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

# 8. Create necessary directories with proper permissions
RUN mkdir -p /var/www/html/data/log \
    && mkdir -p /var/www/html/data/cache \
    && chmod -R 777 /var/www/html/data \
    && chown -R www-data:www-data /var/www/html

# 9. Copy startup script
COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN tr -d '\r' < /usr/local/bin/docker-entrypoint.sh > /usr/local/bin/docker-entrypoint.sh.lf \
    && mv /usr/local/bin/docker-entrypoint.sh.lf /usr/local/bin/docker-entrypoint.sh \
    && sed -i '1s/^\xEF\xBB\xBF//' /usr/local/bin/docker-entrypoint.sh \
    && chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /var/www/html

# Expose HTTP port
EXPOSE 80

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
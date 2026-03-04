FROM php:8.3-fpm

# 1. Install system dependencies
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

# 5. Copy startup script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN tr -d '\r' < /usr/local/bin/docker-entrypoint.sh > /usr/local/bin/docker-entrypoint.sh.lf \
    && mv /usr/local/bin/docker-entrypoint.sh.lf /usr/local/bin/docker-entrypoint.sh \
    && sed -i '1s/^\xEF\xBB\xBF//' /usr/local/bin/docker-entrypoint.sh \
    && chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /var/www/html

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
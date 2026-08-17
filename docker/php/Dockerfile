FROM php:7.4-apache-buster

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_MEMORY_LIMIT=-1 \
    APP_ENV=prod \
    APP_DEBUG=0

RUN sed -i \
      -e 's|http://deb.debian.org/debian|http://archive.debian.org/debian|g' \
      -e 's|https://deb.debian.org/debian|http://archive.debian.org/debian|g' \
      -e 's|http://security.debian.org/debian-security|http://archive.debian.org/debian-security|g' \
      -e 's|https://security.debian.org/debian-security|http://archive.debian.org/debian-security|g' \
      /etc/apt/sources.list \
    && sed -i '/buster-updates/d' /etc/apt/sources.list \
    && echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libicu-dev \
        libzip-dev \
        openssl \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql intl zip opcache \
    && a2enmod rewrite headers env \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer
COPY docker/php/app.ini "$PHP_INI_DIR/conf.d/app.ini"

WORKDIR /var/www/html

COPY server/composer.json server/composer.lock server/symfony.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --no-scripts --no-plugins

COPY server/ ./
RUN mkdir -p var/cache var/log \
    && composer dump-autoload --optimize --classmap-authoritative --no-dev --no-plugins \
    && chown -R www-data:www-data var

COPY docker/php/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY docker/php/reset-demo-passwords.php /usr/local/bin/reset-demo-passwords.php
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]

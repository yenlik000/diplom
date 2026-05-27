## Stage 1 — install Composer dependencies
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

## Stage 2 — PHP Apache runtime
FROM php:8.2-apache

# Enable mod_rewrite for .htaccess routing
RUN a2enmod rewrite

# Install PostgreSQL PDO driver
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Point document root at public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri 's!DocumentRoot /var/www/html!DocumentRoot ${APACHE_DOCUMENT_ROOT}!g' \
        /etc/apache2/sites-available/000-default.conf \
    && sed -ri 's!<Directory /var/www/html>!<Directory ${APACHE_DOCUMENT_ROOT}>!g' \
        /etc/apache2/apache2.conf \
    && sed -ri 's!AllowOverride None!AllowOverride All!g' \
        /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copy app source and pre-built vendor from Stage 1
COPY . .
COPY --from=vendor /app/vendor ./vendor

# Apply upload size config
COPY uploads.ini /usr/local/etc/php/conf.d/uploads.ini

EXPOSE 80

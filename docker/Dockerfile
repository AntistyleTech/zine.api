FROM php:8.2-fpm-alpine AS base

ARG UID=1000
ARG GID=1000

RUN apk add --no-cache \
      zip unzip git \
      libzip-dev \
      libpq-dev \
      $PHPIZE_DEPS \
    && docker-php-ext-install pdo pdo_pgsql pcntl opcache zip \
    && pecl install redis \
    && docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN addgroup -g ${GID} app && adduser -u ${UID} -G app -D app

WORKDIR /var/www/html

FROM base AS local

RUN apk add --no-cache linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY docker/php/xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini

COPY --chown=${UID}:${GID} composer*.json ./

RUN composer install --no-scripts

COPY --chown=${UID}:${GID} . .

RUN chown -R ${UID}:${GID} storage bootstrap/cache

RUN composer dump-autoload

FROM base AS prod

ENV APP_ENV=production

COPY --chown=${UID}:${GID} composer*.json ./
RUN composer install --no-dev --optimize-autoloader

COPY --chown=${UID}:${GID} . .

RUN chown -R ${UID}:${GID} storage bootstrap/cache

RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan event:cache

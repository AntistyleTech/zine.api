FROM php:8.3-cli as base

ARG UID=1000
ARG GID=1000

ARG SUPERVISOR_PHP_COMMAND

ARG NODE_VERSION=20

RUN apt-get update \
    && apt-get install -y  \
    curl \
    gnupg \
    supervisor \
    libzip-dev \
    zip \
    git \
    libpq-dev \
    procps \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN pecl install \
    swoole \
    redis \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pcntl \
    opcache \
    && docker-php-ext-enable \
    swoole \
    redis \
    pcntl

WORKDIR var/www/html

RUN usermod -u ${UID} www-data
RUN groupmod -g ${GID} www-data

RUN mkdir -p /home/www-data
RUN chown -R www-data /home/www-data
RUN usermod -d /home/www-data www-data

ENV OPCACHE_ENABLE=disable
ENV OPCACHE_ENABLE_CLI=0
ENV OPCACHE_JIT=tracing

COPY docker/app/php.ini $PHP_INI_DIR/php.ini
COPY docker/app/conf.d/opcache.ini $PHP_INI_DIR/conf.d/opcache.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

FROM base AS xdebug

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY docker/app/conf.d/xdebug.ini ${PHP_INI_DIR}/conf.d/xdebug.ini

FROM xdebug AS local

# Only for chokidar
# Required for octane --watch option
RUN curl -sL https://deb.nodesource.com/setup_$NODE_VERSION.x | bash -; \
    apt-get install -y nodejs

COPY --chown=www-data . .

RUN chmod -R 775 bootstrap/cache storage

ENV SUPERVISOR_PHP_USER=www-data
ENV SUPERVISOR_PHP_COMMAND=$SUPERVISOR_PHP_COMMAND
COPY docker/app/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]


FROM base AS production

ENV OPCACHE_ENABLE=1
ENV OPCACHE_ENABLE_CLI=1
ENV OPCACHE_JIT=tracing

ENV APP_ENV=production

COPY --chown=$UID:$GID . .

RUN chmod -R 775 bootstrap/cache storage

RUN composer install \
    --no-interaction \
    --no-dev \
    --optimize-autoloader

RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan event:cache

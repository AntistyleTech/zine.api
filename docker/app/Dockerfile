FROM php:8.3-cli as base

ARG UID=1000
ARG GID=1000

ARG NODE_VERSION=21

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

RUN curl -sL https://deb.nodesource.com/setup_$NODE_VERSION.x | bash -; \
    apt-get install -y nodejs \
    && npm install -g npm

COPY docker/app/php.ini $PHP_INI_DIR/php.ini
COPY docker/app/conf.d/opcache.ini $PHP_INI_DIR/conf.d/opcache.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN usermod -u ${UID} www-data
RUN groupmod -g ${GID} www-data

COPY --chown=www-data . .

RUN chmod -R 775 bootstrap/cache storage

COPY docker/app/base-install /usr/local/bin/base-install
RUN chmod +x /usr/local/bin/base-install
RUN ["base-install"]

FROM base AS local

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY docker/app/conf.d/xdebug.ini ${PHP_INI_DIR}/conf.d/xdebug.ini

FROM local AS local-server

ENV SUPERVISOR_PHP_COMMAND="php -d variables_order=EGPCS /var/www/html/artisan octane:start --host=0.0.0.0 --port=8000 --watch"
ENV SUPERVISOR_PHP_USER=www-data

COPY docker/app/conf.d/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Build stage
FROM base AS production

# Specify environment variable for .env file
ENV APP_ENV=production

ENV OPCACHE_ENABLE=1
ENV OPCACHE_ENABLE_CLI=1
ENV OPCACHE_JIT=tracing

# Copy application files
COPY --chown=$UID:$GID . .

# Specify filesystem permissions
RUN chmod -R 775 bootstrap/cache storage

# Install Composer dependencies
RUN composer install \
    --no-interaction \
    --no-dev \
    --optimize-autoloader

# Optimize config loading
RUN php artisan config:cache \
# Optimize route loading
    && php artisan route:cache \
# Optimize view loading
    && php artisan view:cache \
# Optimize event loading
    && php artisan event:cache

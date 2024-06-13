FROM dunglas/frankenphp:php8.2

WORKDIR /app

COPY docker/app/conf.d/php.ini $PHP_INI_DIR/php.ini
COPY docker/app/conf.d/opcache.ini $PHP_INI_DIR/conf.d/opcache.ini

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY docker/app/conf.d/xdebug.ini ${PHP_INI_DIR}/conf.d/xdebug.ini

RUN install-php-extensions \
    pcntl
    # Add other PHP extensions here...

COPY . /app

ENTRYPOINT ["php", "artisan", "octane:frankenphp"]

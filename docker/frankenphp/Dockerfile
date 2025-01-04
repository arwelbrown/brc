FROM dunglas/frankenphp:1.0.3-php8.3 as base

# Set Caddy server name to "http://" to serve on 80 and not 443
# Read more: https://frankenphp.dev/docs/config/#environment-variables
ENV SERVER_NAME="http://"

RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
    git \
    unzip \
    librabbitmq-dev \
    libpq-dev

RUN install-php-extensions \
    gd \
    pcntl \
    opcache \
    sockets \
    redis \
    amqp \
    intl \
    pdo_mysql \
    mysqli \
    bcmath \
    zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && mkdir vendor \
    && chown www-data:www-data vendor

#COPY files/weroad-php.ini $PHP_INI_DIR/conf.d/
#COPY files/opcache.ini $PHP_INI_DIR/conf.d/

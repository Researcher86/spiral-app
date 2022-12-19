FROM php:8.2-cli

# Install global requirements
RUN \
    apt-get update && \
    apt-get install -y --no-install-recommends zip unzip git ssh-client wget

# Install required libraries and PHP extensions
RUN \
    apt-get install -y \
        libxml2-dev libicu-dev librabbitmq-dev zlib1g-dev \
        libmemcached-dev libcurl4-openssl-dev pkg-config libssl-dev \
        libtidy-dev libxslt-dev libbz2-dev libevent-dev libpng-dev libmcrypt-dev libzmq3-dev \
        && \
    docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-install bcmath intl sockets &&\
    printf "\n" | pecl install amqp && \
    docker-php-ext-enable amqp

RUN pecl install xdebug && docker-php-ext-enable xdebug


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

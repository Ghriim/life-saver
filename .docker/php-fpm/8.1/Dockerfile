FROM php:8.1-fpm

VOLUME /srv/cache

ENV COMPOSER_DISABLE_XDEBUG_WARN 1

RUN apt-get update -qq \
    && apt-get install -y --no-install-recommends \
        git unzip libzip-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libxml2-dev \
        libicu-dev \
        npm \
        nodejs \
        npm \
    && npm i -g corepack \
    && pecl install xdebug && docker-php-ext-enable xdebug \
    && docker-php-ext-install -j$(nproc) \
        zip \
        mysqli \
        pdo_mysql \
        gd \
        dom \
        xml \
        intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
        && cd -

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ARG DOCKER_USER
ARG DOCKER_USER_ID

# Add local user
RUN useradd --shell /bin/bash -u ${DOCKER_USER_ID} -o -c "" -m ${DOCKER_USER} \
    && adduser ${DOCKER_USER} sudo \
    && echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers \
    && export HOME=/home/${DOCKER_USER}


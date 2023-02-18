#https://hub.docker.com/_/php
FROM php:7.4-apache

MAINTAINER vitaliy ilinov <ilinov123@gmail.com>

ARG UID
ARG GID

# Install and enable additional extensions https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

# Install extensions by docker-php-ext-install.
RUN install-php-extensions @composer \
    gd \
    mysqli \
    soap \
    imagick \
    zip \
    opcache \
    memcached \
    pdo_mysql

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    locales \
    nano \
    zip \
    unzip \
    autoconf \
    make \
    wget \
    git \
    npm \
    default-mysql-client \
    curl \
    libxml2-dev

RUN docker-php-ext-install soap && docker-php-ext-enable soap

ARG XDEBUG="off"
RUN if [ "$XDEBUG" = "on" ] ; then pecl install xdebug && docker-php-ext-enable xdebug; fi

WORKDIR /var/www/html
COPY ./after-build.sh /docker/after-build.sh

#additional
RUN bash /docker/after-build.sh
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN a2enmod rewrite ssl vhost_alias

#Create user
RUN groupadd --gid $GID $UID && useradd --uid $UID --gid $GID -m $UID

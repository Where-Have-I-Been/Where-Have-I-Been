FROM php:7.4.9-fpm-alpine

ENV COMPOSER_HOME=/application/.composer
ENV COMPOSER_MEMORY_LIMIT=-1

RUN curl -sS https://getcomposer.org/installer | php -- --version=2.0.7 --install-dir=/usr/local/bin --filename=composer
RUN apk add --no-cache zip libzip-dev libpng-dev git

RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath zip gd
RUN docker-php-ext-configure zip

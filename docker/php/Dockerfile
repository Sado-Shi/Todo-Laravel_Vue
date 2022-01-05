FROM php:8.0.3-fpm

# COPY php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Composer install
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

# install Node.js
# COPY --from=node:10.22 /usr/local/bin /usr/local/bin
# COPY --from=node:10.22 /usr/local/lib /usr/local/lib

RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
  && apt-get install -y nodejs

RUN apt-get update && \
  apt-get -y install \
  git \
  zip \
  unzip \
  vim \
  && docker-php-ext-install pdo_mysql bcmath

WORKDIR /var/www/html

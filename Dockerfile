FROM php:7.1-cli

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

COPY --chown=www-data:www-data . /var/www/rovers/
WORKDIR /var/www/rovers

RUN apt-get update
RUN apt-get install -y git zip unzip

RUN composer install

FROM php:8.0-fpm-alpine

RUN apk update && apk add --no-cache --virtual .build-deps postgresql-dev g++ make autoconf yaml-dev supervisor nginx git composer autoconf && \
apk add bash nano

RUN apk update && docker-php-ext-install pdo pdo_pgsql pgsql

RUN mkdir -p /var/run/php
COPY ./docker/supervisord.conf /etc/supervisor/supervisord.conf
COPY ./docker/nginx.conf /etc/nginx/http.d/default.conf
COPY ./docker/php.ini "$PHP_INI_DIR/php.ini"
COPY ./docker/php-fpm.ini  /usr/local/etc/php-fpm.d/www.conf

WORKDIR /app

COPY composer.json ./
RUN composer install --prefer-dist --no-interaction --no-dev
COPY . .

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]

FROM php:8.2-alpine

WORKDIR /api

RUN apk update && apk add bash

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache nodejs npm

RUN install-php-extensions pcntl sockets pdo_pgsql swoole

COPY ./challenge-adoorei /api

RUN chmod +x ./entrypoint.sh

ENTRYPOINT ["./entrypoint.sh"]

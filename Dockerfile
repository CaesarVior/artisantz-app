FROM composer:2.7 AS vendor
WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM node:20.20.2-alpine AS node-builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build

FROM webdevops/php-nginx:8.3-alpine

ENV WEB_DOCUMENT_ROOT=/app/public
ENV APP_ENV=staging

WORKDIR /app

COPY vhost.conf /opt/docker/etc/nginx/vhost.conf

COPY --chown=application:application . .
COPY --from=vendor --chown=application:application /app/vendor/ ./vendor/

COPY --from=node-builder --chown=application:application /app/public/build/ ./public/build/
COPY --chown=application:application .env.staging .env

RUN chmod -R 775 /app/storage /app/bootstrap/cache

EXPOSE 80
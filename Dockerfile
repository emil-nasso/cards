# Buildstep: Php dependencies
FROM php:7.3-apache as php-deps

RUN apt-get update && apt-get install -y git unzip

COPY . /app
WORKDIR /app

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer install --optimize-autoloader

# Buildstep: Assets compilation
FROM node as node

RUN mkdir /app
WORKDIR /app

COPY . .

COPY --from=php-deps /app .

RUN npm install && npm run production

# Runtime container
FROM php:7.3-apache

WORKDIR /var/www
COPY --from=node /app /var/www

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN php artisan storage:link && php artisan view:cache

RUN chown -R www-data:www-data /var/www

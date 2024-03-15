FROM php:7.4-apache

RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        && docker-php-ext-install zip pdo_mysql

COPY . /var/www/html

WORKDIR /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]

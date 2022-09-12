FROM php:8.0-fpm

ENV TZ=Asia/Tokyo
EXPOSE 8080
RUN apt-get update &&\
    apt-get install apt-utils curl gnupg libzip-dev libicu-dev zlib1g-dev libpng-dev libcurl4-openssl-dev nano -y \
    build-essential mariadb-client supervisor -y &&\
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer &&\
    docker-php-ext-configure intl && \
    docker-php-ext-install -j$(nproc) gd &&\
    docker-php-ext-install pdo pdo_mysql bcmath curl opcache zip intl &&\
    # cd /etc/apache2/mods-enabled &&\v
    # ln -s ../mods-available/rewrite.load ./ &&\
    mkdir /var/www/app

WORKDIR /var/www/app


FROM php:8.2-fpm

WORKDIR /var/www/

RUN docker-php-ext-install pdo pdo_mysql


RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

#
RUN docker-php-ext-install mbstring exif pcntl bcmath gd


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


COPY . .


RUN composer install


EXPOSE 9000

CMD ["php-fpm"]

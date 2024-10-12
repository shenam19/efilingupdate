# base image
FROM php:8.1-fpm

# get composer installer binary
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install composer dependencies 
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    libz-dev \
    mariadb-client-10.5 \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libssl-dev \
    libzip-dev \
    unzip \
    zip \
    nodejs \
    && apt-get clean \
    && docker-php-ext-configure gd \
    && docker-php-ext-configure zip \
    && docker-php-ext-install \
    gd \
    exif \
    opcache \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    pcntl \
    zip \
    && rm -rf /var/lib/apt/lists/*;
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# copy php.ini file to the image
COPY ./laravel.ini /usr/local/etc/php/conf.d/laravel.ini

# copy application code
COPY . /usr/src/app

# set the working directory to the root of the project
WORKDIR /usr/src/app

# update and install composer for laravel, project won't run without composer
RUN composer update
RUN composer install

# owner of the public & storage has to be same as nginx user so that nginx can access it. 
# public, storage and bootstrap directory should be writeable by the server
RUN chown -R www-data:www-data ./public
RUN chown -R www-data:www-data ./storage
RUN chown -R $USER:www-data .
RUN find . -type f -exec chmod 664 {} \;   
RUN find . -type d -exec chmod 775 {} \;
RUN chgrp -R www-data storage bootstrap/cache
RUN chmod -R ug+rwx storage bootstrap/cache

# entrypoint
CMD [ "php-fpm" ]
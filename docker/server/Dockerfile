FROM php:8.3-apache

COPY ./config/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

RUN apt-get update && \
    apt-get install -y libxml2-dev libzip-dev zip vim libfreetype6-dev libjpeg62-turbo-dev libpng-dev libicu-dev && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install intl zip pdo pdo_mysql pcntl gd && \
    chown -R www-data:www-data /var/www/html && \
    a2enmod rewrite && \
    rm -rf /var/lib/apt/lists/*

COPY ./docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENTRYPOINT ["docker-entrypoint"]
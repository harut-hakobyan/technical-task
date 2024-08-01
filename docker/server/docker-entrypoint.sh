#!/bin/bash

composer install --prefer-dist --no-progress --no-interaction

php artisan migrate
php artisan db:seed

chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

exec docker-php-entrypoint apache2-foreground

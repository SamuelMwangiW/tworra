#!/usr/bin/env bash

git pull origin HEAD

composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction

php artisan migrate --force
php artisan optimize
php artisan view:cache

sudo supervisorctl restart all

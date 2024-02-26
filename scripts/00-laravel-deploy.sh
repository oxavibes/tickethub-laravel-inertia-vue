#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

echo "Autoloader Optimization..."
composer install --optimize-autoloader --no-dev

echo "Caching config..."
php artisan config:cache

echo "Caching events..."
php artisan event:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "Running migrations..."
php artisan migrate --seed --force

#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

echo "Autoloader Optimization..."
composer install --optimize-autoloader --no-dev

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --seed --force

echo "Running server"
php artisan serve

echo "Running inertia ssr"
php artisan inertia:start-ssr

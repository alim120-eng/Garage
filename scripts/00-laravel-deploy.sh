#!/usr/bin/env bash

echo "Running migrations..."
php artisan migrate --force

echo "Running seeders..."
php artisan db:seed --force || true

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

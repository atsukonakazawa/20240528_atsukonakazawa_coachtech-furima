#!/bin/bash

# Change to the project directory
cd /var/www/20240528_atsukonakazawa_coachtech-furima/src

# Ensure the script stops if any command fails
set -e

# Pull the latest changes from the Git repository
git pull origin main

# Install PHP dependencies for production
composer install --no-dev --optimize-autoloader

# Run database migrations
php artisan migrate:fresh

# Run database seeds in a specific order    
php artisan db:seed --class=MainCategoriesTableSeeder
php artisan db:seed --class=SubCategoriesTableSeeder
php artisan db:seed --class=ConditionsTableSeeder
php artisan db:seed --class=ColorsTableSeeder
php artisan db:seed --class=PaymentWaysTableSeeder
php artisan db:seed --class=UsersTableSeeder
php artisan db:seed --class=ProfilesTableSeeder
php artisan db:seed --class=ItemsTableSeeder
php artisan db:seed --class=SoldItemsTableSeeder
php artisan db:seed --class=CommentsTableSeeder
php artisan db:seed --class=FavoritesTableSeeder
    
# Clear and cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache
    
# Restart services (depends on your server setup)
sudo systemctl restart nginx
sudo systemctl restart php-fpm

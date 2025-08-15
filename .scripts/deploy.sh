#!/bin/bash
set -e

echo "Deployment Started ..."

# Turn On Maintenance Mode or return true
# if already is in maintenance mode
(php artisan down) || true

# Pull the latest version of the app
git pull origin master

# Check if composer is installed, install if missing
if ! command -v composer &> /dev/null
then
    echo "Composer not found. Installing..."
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
else
    echo "Composer is already installed."
fi

# Install composer dependencies
composer install --optimize-autoloader --no-dev --no-interaction

# Clearing Cache
php artisan cache:clear
php artisan config:clear

# Recreate cache
php artisan optimize

# Run database migrations
php artisan migrate --force

# Turn OFF Maintenance mode
php artisan up

echo "Deployment Finished!!!"
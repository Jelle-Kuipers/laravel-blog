#!/bin/bash

# Exit on error
set -e

# Start a bash shell in the laravel.test container and run the following commands
echo -e "\e[34mStarting setup, this can take a few minutes...\e[0m"

# Install composer dependencies
echo -e "\e[34mInstalling:\e[0m Composer dependencies..."
composer install

# Build and start docker containers
echo -e "\e[34mBuilding and starting:\e[0m Containers..."
./vendor/bin/sail up -d 

# Enter the running container
echo -e "\e[34mEntering:\e[0m Container bash..."
docker compose exec -T laravel.test bash << EOF
set -e
echo -e "\e[32mEntered container! \n \e[0m"

# Set the storage link
echo -e "\e[34mSetting:\e[0m Storage link..."
php artisan storage:link

# Set permissions for sail user
echo -e "\e[34mSetting:\e[0m Permissions..."
chown sail:sail -R storage/logs storage/framework

# Create and set the Application key
echo -e "\e[34mGenerating:\e[0m Application key..."
php artisan key:generate

# Build the database
echo -e "\e[34mBuilding:\e[0m Database..."
php artisan migrate:fresh 
echo -e "\e[32mDatabase built!\e[0m"

# Seed the database
echo -e "\e[34mSeeding:\e[0m Database..."
php artisan db:seed
echo -e "\e[32mDatabase seeded!\e[0m"

EOF
echo -e "\e[32mSetup completed\n\e[0m"
echo -e "You can now open the project in your browser at: \e[34m\e[4mhttp://localhost/\e[0m"
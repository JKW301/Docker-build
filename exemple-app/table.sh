#!/bin/bash

# Mettre à jour le fichier .env pour utiliser MariaDB
sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=mysql/' .env
sed -i '/^DB_HOST/d' .env
sed -i '/^DB_PORT/d' .env
sed -i '/^DB_DATABASE/d' .env
sed -i '/^DB_USERNAME/d' .env
sed -i '/^DB_PASSWORD/d' .env

echo "DB_HOST=127.0.0.1" >> .env
echo "DB_PORT=3306" >> .env
echo "DB_DATABASE=laravel" >> .env
echo "DB_USERNAME=root" >> .env
echo "DB_PASSWORD=debian" >> .env

# Installer les dépendances via Composer
composer install

# Exécuter les migrations de la base de données
php artisan migrate


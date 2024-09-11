#!/bin/bash

# Récupération des informations depuis le fichier .env
DB_HOST="127.0.0.1"
DB_USERNAME="root"
DB_PASSWORD=""
DB_DATABASE="laravel"

# Commande MySQL pour créer la base de données
mysql -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" -e "CREATE DATABASE $DB_DATABASE;"


# Projet de dockerisation

## Présentation

Le projet que nous souhaitons dockeriser consiste en une application python de ticketing et une application web utilisant laravel ayant accès à leurs bases de données respectives.

## Documentation

### Utilisation :

- Linux : Utiliser ``xhost +`` puis ``docker-compose up`` pour lancer l'application
- Windows : Il faut au préalable installer un serveur X comme Xming, autoriser les connexions depuis les clients réseau et utiliser l'IP ``host.docker.internal`` pour que le conteneur puisse se référer à la machine hôte

### App Python :
L'interface graphique de l'application python est la raison pour laquelle il est nécessaire d'autoriser un serveur X à accepter les connexions du conteneur docker.
L'application avec sa propre base de données MySQL.
Les variables d'environnementne sont pas nécessaires ici, puisqu'il est possible de les saisir directement dans l'interface graphique.
Le socket X11 est monté pour permettre à l'application GUI d'afficher son interface graphique sur l'hôte.

### App Laravel :

L'application Laravel communique également avec sa propre base de données MySQL.
Les variables d'environnement établissent en amont les paramètres de connexion.
La base de données a un volume de données pour la persistance.


#### Création des conteneur
Nous avons donc besoin de deux conteneurs:
  - un conteneur PHP-Nginx sous Alpine pour faire le laravel
  - un conteneur pour Mariadb
Le docker-compose.yaml fait donc appel au Dockerfile situé dans le dossier exemple-app. Ce Dockerfile télécharge les dépendance PHP et NGinx dans un OS Alpine.
Ensuite, le docker-compose télécharge une image de MariaDB en spécifiant les coordonnées et logins de la base de données.

D'autre part, nous avons définit des noms aux deux conteneurs :
  - laravel_db
  - laravel_app

Sur la machine locale, il faut également créer les certificats SSL pour pouvoir pleinement profiter du site web (authentification à la page de connexion). Il faut également coder le nginx.conf.
De plus, pour éviter de devoir créer les tables dans le laravel_app via la commande "php artisan migrate", nous avons inclu un init.sql dans le dossier sql-scripts.
En tout, nous avons donc 3 volumes.    

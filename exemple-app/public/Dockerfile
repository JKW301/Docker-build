FROM webdevops/php-nginx:8.3-alpine
# Installation des minimum requis pour le fonctionne Docker dans l'image
RUN apk add oniguruma-dev libxml2-dev
RUN docker-php-ext-install \
bcmath \
ctype \
fileinfo \
mbstring \
pdo_mysql \
xml
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Installation de NodeJS (peut être optionnel ?)
#RUN apk add nodejs npm

ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production
WORKDIR /app
COPY . .
# On copie le fichier .env.example pour le renommer en .env
RUN cp -n .env.example .env
# Installation et configuration de votre site pour la production
# https://laravel.com/docs/10.x/deployment#optimizing-configuration-loading
RUN composer install --no-interaction --optimize-autoloader --no-dev
# Generate security key
RUN php artisan key:generate
# Optimizing Configuration loading
RUN php artisan config:cache
# Optimizing Route loading
RUN php artisan route:cache
# Optimizing View loading
RUN php artisan view:cache
# Compilation des assets de Breeze
# Il s'agit de Javascript
# optionnel
#RUN npm install
#RUN npm run build
RUN chown -R application:application .

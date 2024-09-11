FROM webdevops/php-nginx:8.3-alpine

RUN apk add --no-cache openssl nginx oniguruma-dev libxml2-dev



RUN apk add oniguruma-dev libxml2-dev

RUN docker-php-ext-install \

bcmath \

ctype \

fileinfo \

mbstring \

pdo_mysql \

xml

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer



ENV WEB_DOCUMENT_ROOT /app/public

ENV APP_ENV production

WORKDIR /app

COPY . .


RUN cp -n .env.example .env



RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN php artisan key:generate



RUN php artisan config:cache



#RUN php artisan route:clear

#RUN php artisan route:cache



RUN php artisan view:cache



RUN chown -R application:application .

RUN mkdir -p /etc/nginx/ssl

RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/nginx/ssl/nginx.key -out /etc/nginx/ssl/nginx.crt \
    -subj "/C=US/ST=State/L=City/O=Organization/CN=localhost"

EXPOSE 443



CMD ["nginx", "-g", "daemon off;"]

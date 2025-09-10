FROM php:8.2-apache

# Installer extensions PHP si besoin (ex: mysqli, pdo_mysql)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copier ton projet dans le conteneur
COPY . /var/www/html/

# Exposer le port
EXPOSE 80

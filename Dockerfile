# Dockerfile for Laravel Backend

# Utiliser une image PHP avec Apache
FROM php:8.3-apache

# Installer les extensions requises
RUN docker-php-ext-install pdo pdo_mysql

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application Laravel
COPY . .

# Installer les dépendances de l'application Laravel
RUN composer install

# Exposer le port 80
EXPOSE 80

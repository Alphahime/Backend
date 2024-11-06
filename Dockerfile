# Dockerfile pour le backend Laravel
FROM php:8.3-fpm

# Installe les extensions PHP requises pour Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Installe Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configure le répertoire de travail
WORKDIR /var/www

# Copie les fichiers Laravel dans le conteneur
COPY . .

# Installe les dépendances Laravel
RUN composer install

# Définit les permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Expose le port PHP-FPM
EXPOSE 9000

# Commande de démarrage pour PHP-FPM
CMD ["php-fpm"]

FROM php:8.2-apache

# Set document root ke public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

# Enable apache rewrite
RUN a2enmod rewrite

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        mbstring \
        bcmath \
        gd

# Install Composer (INI YANG KURANG TADI)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Create SQLite database
RUN mkdir -p database \
    && touch database/database.sqlite \
    && chown -R www-data:www-data \
        database \
        storage \
        bootstrap/cache

# Laravel setup
RUN php artisan key:generate || true
RUN php artisan migrate --force || true

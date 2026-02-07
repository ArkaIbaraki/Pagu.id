FROM php:8.2-apache

# Set document root ke public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Enable apache modules
RUN a2enmod rewrite

# Install system deps
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring bcmath gd pdo_sqlite

# Set working dir
WORKDIR /var/www/html

# Copy project
COPY . .

# Create SQLite database file (INI KUNCI)
RUN mkdir -p database \
    && touch database/database.sqlite \
    && chown -R www-data:www-data database storage bootstrap/cache

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Run migrations automatically
RUN php artisan key:generate || true
RUN php artisan migrate --force || true

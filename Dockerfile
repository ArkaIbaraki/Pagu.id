FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    sqlite \
    sqlite-dev \
    nginx

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_sqlite \
    mbstring \
    bcmath \
    gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Create all necessary directories with proper permissions
RUN mkdir -p database storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && touch database/database.sqlite storage/logs/laravel.log \
    && chmod -R 777 database storage bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Configure Nginx
RUN mkdir -p /etc/nginx/http.d && \
    cat > /etc/nginx/http.d/default.conf <<'NGINX'
upstream php {
    server 127.0.0.1:9000;
}

server {
    listen 80 default_server;
    root /var/www/html/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass php;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
NGINX

# Laravel setup - generate key during build
RUN php artisan key:generate --force || true
RUN php artisan config:cache || true

# Expose port
EXPOSE 80

# Create startup script
RUN cat > /start.sh <<'START'
#!/bin/sh
set -e
echo "Starting application..."
# Ensure .env exists
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env || true
fi
# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi
# Fix permissions
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chown -R www-data:www-data /var/www/html
# Clear cache
php artisan config:clear || true
php artisan cache:clear || true
# Run migrations
echo "Running migrations..."
php artisan migrate --force || true
# Start PHP-FPM in background
echo "Starting PHP-FPM..."
php-fpm -D
# Start Nginx in foreground
echo "Starting Nginx..."
nginx -g "daemon off;"
START

RUN chmod +x /start.sh

CMD ["/start.sh"]

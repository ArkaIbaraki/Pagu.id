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

# Create SQLite database
RUN mkdir -p database storage/logs storage/framework/cache storage/framework/sessions storage/framework/views \
    && touch database/database.sqlite \
    && chmod -R 775 database storage bootstrap/cache \
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

# Laravel setup
RUN php artisan key:generate || true
RUN php artisan migrate --force || true

# Expose port
EXPOSE 80

# Create startup script
RUN cat > /start.sh <<'START'
#!/bin/sh
set -e
# Fix permissions
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html
# Run migrations
php artisan migrate --force || true
# Start PHP-FPM in background
php-fpm -D
# Start Nginx in foreground
nginx -g "daemon off;"
START

RUN chmod +x /start.sh

CMD ["/start.sh"]

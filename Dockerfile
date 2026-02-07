FROM php:8.2-fpm-alpine

# Install Node.js and npm
RUN apk add --no-cache \
    nodejs \
    npm

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

# Build frontend assets with Vite
RUN npm install && npm run build
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
    server_name _;

    root /var/www/html/public;
    index index.php;

    # Security headers
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains; preload" always;
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    # Enable gzip compression
    gzip on;
    gzip_types text/plain text/css text/javascript application/javascript application/json;
    gzip_min_length 1000;

    # Logging
    access_log /var/log/nginx/access.log;
    error_log /var/log/nginx/error.log warn;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass php;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTPS $http_x_forwarded_proto;
        fastcgi_param HTTP_SCHEME $http_x_forwarded_proto;
        fastcgi_param HTTP_X_FORWARDED_FOR $proxy_add_x_forwarded_for;
        fastcgi_param HTTP_X_FORWARDED_PROTO $http_x_forwarded_proto;
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
# Clear cache and recreate
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
# Optimize with caching (for production)
php artisan config:cache || true
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

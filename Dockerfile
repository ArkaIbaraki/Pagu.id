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
    nginx \
    supervisor \
    && docker-php-ext-install \
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
RUN mkdir -p database \
    && touch database/database.sqlite \
    && chown -R www-data:www-data \
        database \
        storage \
        bootstrap/cache

# Configure Nginx
COPY <<EOF /etc/nginx/http.d/default.conf
upstream php {
    server 127.0.0.1:9000;
}

server {
    listen 80 default_server;
    root /var/www/html/public;
    index index.php;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass php;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
EOF

# Configure Supervisor
COPY <<EOF /etc/supervisor.d/supervisord.ini
[supervisord]
nodaemon=true
user=root

[program:php-fpm]
command=/usr/sbin/php-fpm -F
autorestart=true

[program:nginx]
command=nginx -g "daemon off;"
autorestart=true
EOF

# Expose port
EXPOSE 80

# Laravel setup
RUN php artisan key:generate || true
RUN php artisan migrate --force || true

# Create startup script
COPY <<EOF /start.sh
#!/bin/sh
php artisan migrate --force || true
exec /usr/bin/supervisord -c /etc/supervisor.d/supervisord.ini
EOF

RUN chmod +x /start.sh

CMD ["/start.sh"]

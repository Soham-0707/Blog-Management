FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    nginx \
    supervisor \
    npm \
    nodejs \
    libxml2-dev \
    oniguruma-dev

# Install PHP extensions with minimal dependencies
RUN docker-php-ext-configure pdo_mysql && \
    docker-php-ext-install -j$(nproc) pdo pdo_mysql && \
    docker-php-ext-install -j$(nproc) xml mbstring

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build frontend
RUN npm install && npm run build

# Set permissions
RUN chmod -R 777 storage bootstrap/cache && \
    mkdir -p storage/logs && \
    chmod -R 777 storage

# Configure Nginx
RUN rm -f /etc/nginx/conf.d/default.conf
COPY laravel-site.conf /etc/nginx/conf.d/default.conf

# Configure Supervisor
RUN mkdir -p /etc/supervisor/conf.d && \
    mkdir -p /var/log/supervisor
COPY supervisor.conf /etc/supervisor/conf.d/laravel.conf

# Prepare Laravel
RUN php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    mkdir -p /tmp && chmod 777 /tmp

EXPOSE 10000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/laravel.conf"]





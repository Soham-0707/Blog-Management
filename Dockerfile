FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    nginx \
    supervisor \
    mysql-client \
    libpq-dev

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    bcmath \
    ctype \
    fileinfo \
    json \
    mbstring \
    tokenizer \
    xml \
    zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build frontend
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install && \
    npm run build

# Set permissions
RUN chmod -R 777 storage bootstrap/cache && \
    chmod -R 777 public/build

# Create Laravel necessary directories
RUN mkdir -p storage/logs && \
    chmod -R 777 storage

# Configure Nginx
RUN rm -f /etc/nginx/sites-enabled/* /etc/nginx/sites-available/*

COPY nginx.conf /etc/nginx/nginx.conf
COPY laravel-site.conf /etc/nginx/conf.d/default.conf

# Configure Supervisor
RUN mkdir -p /etc/supervisor/conf.d
COPY supervisor.conf /etc/supervisor/conf.d/laravel.conf

# Generate Laravel key and run migrations
RUN php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan migrate --force || true

# Start services
EXPOSE 10000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/laravel.conf"]


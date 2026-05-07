FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    nginx \
    supervisor \
    default-mysql-client \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions - core extensions
RUN docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    zip

# Install PHP extensions - additional
RUN docker-php-ext-install -j$(nproc) \
    bcmath \
    ctype \
    fileinfo \
    mbstring \
    tokenizer \
    xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node.js and build frontend
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install && \
    npm run build && \
    rm -rf /var/lib/apt/lists/*

# Set permissions
RUN chmod -R 777 storage bootstrap/cache && \
    chmod -R 777 public && \
    mkdir -p storage/logs && \
    chmod -R 777 storage

# Configure Nginx
RUN rm -f /etc/nginx/sites-enabled/* /etc/nginx/sites-available/*

COPY nginx.conf /etc/nginx/nginx.conf
COPY laravel-site.conf /etc/nginx/conf.d/default.conf

# Configure Supervisor
RUN mkdir -p /etc/supervisor/conf.d
COPY supervisor.conf /etc/supervisor/conf.d/laravel.conf

# Prepare Laravel
RUN php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:cache

EXPOSE 10000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/laravel.conf"]




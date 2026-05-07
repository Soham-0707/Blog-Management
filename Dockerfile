FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm

RUN docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install

RUN npm install

RUN npm run build

RUN chmod -R 777 storage bootstrap/cache

<<<<<<< HEAD
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000
=======
EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000
>>>>>>> 2f31a10 (Added Docker deployment files)

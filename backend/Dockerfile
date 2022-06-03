FROM php:8.0.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y git

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/

COPY . .

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0

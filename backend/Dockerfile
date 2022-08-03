FROM php:8.0.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y git

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql

# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
# COPY composer.json composer.json
#COPY composer.lock composer.lock
# RUN composer install
# COPY . .
# RUN composer dump-autoload
COPY . .

# RUN chown -R www-data:www-data /var/www
# RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www
# RUN chown -R nginx:nginx /var/www && chmod -R 755 /var/www

# EXPOSE 8000

# CMD php artisan serve --host=0.0.0.0


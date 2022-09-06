FROM php:8.0.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y git

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql
RUN apt-get update && apt-get install -y libpng-dev
RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

RUN apt-get install --yes zip unzip
# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
COPY . .

RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

RUN chown -R www-data:www-data /var/www/storage && chmod -R 777 /var/www/storage

# ENTRYPOINT ["sh", "/var/www/entrypoint.sh" ]
# # RUN chown -R www-data:www-data /var/www
# # RUN chmod -R 775 storage bootstrap/cache
# # RUN chown -R nginx:nginx /var/www && chmod -R 755 /var/www

# # EXPOSE 8000

# # CMD php artisan serve --host=0.0.0.0


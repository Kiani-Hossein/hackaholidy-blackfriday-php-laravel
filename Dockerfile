# Use the official PHP 8.3 image
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the Laravel application into the container
COPY ./blackfriday-src /var/www/html

# Install PHP dependencies
RUN composer install --prefer-dist --no-scripts --no-dev --optimize-autoloader

# Set permissions for the Laravel project
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start PHP-FPM server
CMD ["php-fpm"]


# Gunakan PHP 8.2 dengan Apache
FROM php:8.2-apache

# Install ekstensi GD + ZIP + PDO MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file Laravel
COPY . .

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 8080 (Railway pakai ini)
EXPOSE 8080

# Jalankan Laravel (generate key di runtime kalau belum ada)
CMD if [ ! -f .env ]; then cp .env.example .env; fi && \
    if ! grep -q "APP_KEY=" .env || [ -z "$(grep 'APP_KEY=' .env | cut -d '=' -f2)" ]; then php artisan key:generate --force; fi && \
    php artisan serve --host=0.0.0.0 --port=8080

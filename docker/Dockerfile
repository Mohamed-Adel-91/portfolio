# Use specific but not overly pinned PHP version
FROM php:8.1-apache-bullseye-slim

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring exif pcntl bcmath

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer (multi-stage copy)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application
COPY . .

# Install dependencies (production optimized)
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]

# Stage 1: Install PHP dependencies using the official Composer image
FROM composer:2 AS php-base

WORKDIR /var/www

# Copy composer files
COPY composer.json composer.lock* ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Stage 2: Build Node dependencies and assets
FROM node:20-alpine AS node-builder

WORKDIR /var/www

# Copy package files
COPY package.json package-lock.json* ./

# Install node dependencies
RUN npm ci

# Copy application files for asset building
COPY . .

# Build Vite assets
RUN npm run build

# Stage 3: Final production image
# Final production image
FROM php:8.2-fpm-alpine

# Install system dependencies and required PHP extensions in one step
RUN apk add --no-cache \
    curl \
    libpq-dev \
    mysql-client \
    nginx \
    supervisor \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    bcmath \
    ctype \
    fileinfo \
    json \
    mbstring \
    tokenizer \
    xml \
    && docker-php-ext-enable pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy application files from build stage
COPY --chown=www-data:www-data . .

# Copy PHP dependencies from first stage
COPY --from=php-base --chown=www-data:www-data /var/www/vendor ./vendor

# Copy built assets from Node stage
COPY --from=node-builder --chown=www-data:www-data /var/www/public/build ./public/build

# Copy configuration files
COPY docker/php/php.ini /usr/local/etc/php/conf.d/app.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

# Create necessary directories
RUN mkdir -p /var/www/storage/logs \
    && mkdir -p /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www

# Expose ports
EXPOSE 9000 80

# Run supervisor to manage PHP-FPM and Nginx
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]

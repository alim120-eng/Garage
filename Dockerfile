FROM richarvey/nginx-php-fpm:3.1.6

# Install Node.js and NPM (needed to compile Vite assets)
RUN apk add --no-cache nodejs npm

# Copy the application code
COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Run npm install and compile Vite assets
RUN npm install && npm run build

# Run composer install to bundle PHP dependencies at build time
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions for Laravel storage and cache directories
RUN chmod -R 775 storage bootstrap/cache

CMD ["/start.sh"]

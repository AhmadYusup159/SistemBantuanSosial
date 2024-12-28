FROM php:8.0-cli

# Install dependencies
RUN apt-get update && apt-get install -y openssl libssl-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy your project files
COPY . .

# Install Composer dependencies
RUN composer install --no-scripts --no-autoloader

# Command to run your application
CMD ["php", "artisan", "serve"]

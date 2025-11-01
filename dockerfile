# Use official PHP FPM image
FROM php:8.3-fpm

# Set working directory
WORKDIR /app

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git curl unzip libpng-dev libonig-dev libxml2-dev zip \
    nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring bcmath gd exif \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy Composer binary from official Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy backend dependencies first for caching
COPY composer*.json ./

# Copy frontend dependencies first for caching
COPY package*.json ./

# Copy the full Laravel codebase
COPY . .

#Replace the env for docker instead
COPY .env.docker .env

#run the back end dependency
RUN composer install

#sam for front end
RUN npm install



# Set environment variable for port (optional)
ENV PORT=9000

# Expose the port
EXPOSE 9000

# Start Laravel dev server
CMD ["php","artisan","serve","--host=0.0.0.0","--port=9000"]

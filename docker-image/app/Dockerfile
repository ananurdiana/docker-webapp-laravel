# Base image PHP
FROM php:8.4.17-fpm-bookworm

# Set working directory
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    bash \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    libicu-dev \
    zlib1g-dev \
    zip \
    unzip \
    gnupg \
    sqlite3 libsqlite3-dev \
    ca-certificates \
    && rm -rf /var/lib/apt/lists/*

# Configure GD
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql \
    pdo_mysql \
    mysqli \
    pdo_sqlite \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl

# Install NodeJS v23.x
RUN curl -fsSL https://deb.nodesource.com/setup_23.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && npm install -g npm@latest pm2 \
    && rm -rf /var/lib/apt/lists/*

# Install Redis extension
RUN apt-get update && apt-get install -y $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get purge -y --auto-remove $PHPIZE_DEPS \
    && rm -rf /var/lib/apt/lists/*

# Install Composer dari image resmi
COPY --from=composer:2.8.6 /usr/bin/composer /usr/bin/composer

# Expose port php-fpm
EXPOSE 9000

# Default command
CMD ["php-fpm"]
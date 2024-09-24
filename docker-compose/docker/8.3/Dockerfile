FROM php:8.3.11-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    build-essential \
    libzip-dev \
    libmemcached-dev \
    libfreetype6-dev \
    libssl-dev \
    libwebp-dev \
    libxpm-dev \
    libmcrypt-dev \
    libonig-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip intl

RUN docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype

RUN docker-php-ext-install gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN chown -R www-data:www-data /var/www
#RUN chmod -R 755 /var/www

#USER $user

# Install OpenJDK-17
RUN apt-get update && \
    apt-get install -y openjdk-17-jdk && \
    apt-get install -y ant && \
    apt-get clean;

# Fix certificate issues
RUN apt-get update && \
    apt-get install ca-certificates-java && \
    apt-get clean && \
    update-ca-certificates -f;

# Setup JAVA_HOME -- useful for docker commandline
ENV JAVA_HOME /usr/lib/jvm/java-8-openjdk-amd64/
RUN export JAVA_HOME

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

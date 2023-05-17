FROM php:7.4-fpm

RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev jpegoptim optipng pngquant gifsicle g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip

RUN docker-php-ext-install pdo pdo_mysql exif pcntl

RUN pecl install redis \
    && docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

RUN apt-get update && apt-get install -y \
    imagemagick libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick

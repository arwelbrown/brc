FROM php:8.3.2-apache
WORKDIR /var/www/html

# Mod Rewrite
RUN a2enmod rewrite

# Linux library
RUN apt-get update -y && apt-get install -y \
  libicu-dev \
  libmariadb-dev \
  curl \
  unzip zip \
  zlib1g-dev \
  libpng-dev \
  libjpeg-dev \
  libfreetype6-dev \
  libjpeg62-turbo-dev
# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install gettext intl pdo_mysql mysqli gd bcmath
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd

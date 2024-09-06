# Используем образ PHP 8.2-fpm с расширениями, необходимыми для Laravel
FROM php:8.2-fpm

# Установим необходимые расширения PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    curl \
    libzip-dev \
    libonig-dev

# Установим Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установим расширения PHP
RUN docker-php-ext-install pdo_pgsql

# Копируем файлы проекта в контейнер
COPY . /var/www/html

# Установим зависимости Laravel
WORKDIR /var/www/html
RUN composer install

# Переключимся на пользователя www-data
USER www-data

# Запустим PHP-FPM
CMD ["php-fpm"]

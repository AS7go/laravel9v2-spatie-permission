# Использовать официальный образ PHP с предустановленным Apache
FROM php:8.2-apache

# Обновление пакетного менеджера и установка MySQL клиента
RUN apt-get update && apt-get install -y default-mysql-client

# Установить PDO и PDO MySQL расширения PHP
RUN docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql

# Включить модули Apache
RUN a2enmod rewrite

# Установить рабочий каталог в /var/www/html
WORKDIR /var/www/html

# Скопировать каталог вашего проекта Laravel # Копирует все содержимое текущего каталога
COPY ../laravel9 . 

# Установить Composer (если еще не установлен)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установить зависимости проекта На локальном установит и перенесет в контейнер
# RUN composer install -это ненужно  

# Настроить разрешения для каталогов storage и bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Открыть порт (при необходимости изменить)
EXPOSE 80

# Использовать Apache в качестве точки входа по умолчанию
CMD ["apache2-foreground"]

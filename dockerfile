FROM php:apache

# Instalar extensões PHP necessárias para MySQL
RUN docker-php-ext-install mysqli pdo_mysql
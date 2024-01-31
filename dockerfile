FROM php:apache

# Instalar extensões PHP necessárias para MySQL
COPY ./oxe-nerd /var/www/html/


RUN docker-php-ext-install mysqli pdo_mysql
RUN chmod -R 777 /var/www/html/produtos/uploads/
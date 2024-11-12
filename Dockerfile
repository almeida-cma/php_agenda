# Use uma imagem oficial do PHP com Apache
FROM php:8.0-apache

# Instale dependências e extensões
RUN docker-php-ext-install pdo pdo_mysql

# Copie os arquivos do seu projeto para o contêiner
COPY . /var/www/html/

# Ajuste as permissões, se necessário
RUN chown -R www-data:www-data /var/www/html/

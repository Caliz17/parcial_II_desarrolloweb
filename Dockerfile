# Usa una imagen oficial de PHP con Apache
FROM php:7.4-apache

# Instala extensiones de PHP necesarias, como mysqli para MySQL
RUN docker-php-ext-install mysqli

# Copia los archivos de la aplicación al directorio predeterminado de Apache
COPY ./app /var/www/html

# Da permisos de escritura al directorio de trabajo
RUN chown -R www-data:www-data /var/www/html

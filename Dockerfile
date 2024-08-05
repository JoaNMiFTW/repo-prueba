FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Node.js y npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar el contenido del directorio de la aplicación
COPY . /var/www

# Copiar configuración de Nginx
COPY nginx/default.conf /etc/nginx/sites-available/default

# Configurar permisos
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Añadir configuración de permisos adicionales
RUN chmod -R 775 /var/www/storage/framework/views
RUN chown -R www-data:www-data /var/www/storage

# Exponer puertos
EXPOSE 80

# Iniciar Nginx y PHP-FPM
CMD service nginx start && php-fpm

FROM php:8.2-cli

# Paquetes necesarios para PHP y PostgreSQL
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip

WORKDIR /var/www

# Copiar todo el proyecto (incluye public/build desde tu PC)
COPY . /var/www

# Crear carpetas de cache y dar permisos
RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de PHP para producción
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader --no-dev --no-scripts

# Al arrancar el contenedor: migrar + seedear + levantar servidor
CMD php artisan migrate --force --seed && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

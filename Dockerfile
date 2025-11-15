FROM php:8.2-cli

# Instalar dependencias del sistema (incluye node y npm para Vite)
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libzip-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip

# Directorio de la app
WORKDIR /var/www

# Copiar todo el proyecto
COPY . /var/www

# Crear carpetas de cache y dar permisos
RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias PHP sin scripts de artisan en build
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader --no-scripts

# Instalar dependencias JS y construir assets de Vite
RUN npm install && npm run build

# Al arrancar el contenedor: migrar + seedear + levantar servidor
CMD php artisan migrate --force --seed && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

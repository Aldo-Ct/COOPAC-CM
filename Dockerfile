FROM php:8.2-cli

# 1) Paquetes del sistema: PHP + PostgreSQL + Node + npm
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libzip-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip

# 2) Directorio de la aplicación
WORKDIR /var/www

# 3) Copiar todo el proyecto dentro de la imagen
COPY . /var/www

# 4) Crear carpetas de cache de Laravel y dar permisos
RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# 5) Instalar Composer (global)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 6) Instalar dependencias PHP para producción
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader --no-dev

# 7) Instalar dependencias de Node y construir assets (Vite/Tailwind/Flux)
RUN npm install
RUN npm run build

# 8) Al arrancar el contenedor:
#    - limpiar/cachear config y rutas
#    - correr migraciones + seeders
#    - levantar el servidor HTTP de Laravel
CMD php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:clear \
    && php artisan route:cache \
    && php artisan migrate --force --seed \
    && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

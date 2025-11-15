FROM php:8.2-cli

# 1) Paquetes del sistema (incluye node y npm para Vite)
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libzip-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip

# 2) Directorio de la app
WORKDIR /var/www

# 3) Copiar código al contenedor
COPY . /var/www

# 4) Crear carpetas de cache y dar permisos
RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# 5) Instalar Composer (global)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 6) composer install en modo producción
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader --no-dev --no-scripts

# 7) npm install + npm run build (Vite / Tailwind)
RUN npm install && npm run build

# 8) Al arrancar el contenedor:
#    - limpiar/cargar cachés
#    - migrar + seedear
#    - levantar el servidor
CMD php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:clear \
    && php artisan route:cache \
    && php artisan migrate --force --seed \
    && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

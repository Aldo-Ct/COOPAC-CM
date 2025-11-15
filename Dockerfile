FROM php:8.2-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip

# Copiar el proyecto al contenedor
WORKDIR /var/www
COPY . /var/www

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de Laravel (sin dev para producción)
RUN composer install --no-dev --optimize-autoloader

# Generar cachés de Laravel (opcional, pero recomendable)
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan cache:clear \
    && php artisan view:clear

# Comando que ejecutará Render cuando arranque el contenedor
# Usa el puerto que Render le pasa por la variable de entorno PORT
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

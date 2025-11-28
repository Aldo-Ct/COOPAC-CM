# COOPAC-CM

Aplicación Laravel 12 + Livewire para la Cooperativa de Ahorro y Crédito Cabanillas Mañazo. Incluye sitio público, simulador de créditos y un panel interno para gestión de simulaciones, contenidos y RRHH.

## Stack
- PHP 8.2, Laravel 12, MySQL.
- Livewire Volt/Flux para componentes reactivos y tablas.
- Breeze/Fortify para autenticación.
- Spatie Laravel Permission para roles y permisos.
- Vite + Tailwind CSS para assets.

## Qué ofrece
- **Sitio público**: home institucional con carrusel de anuncios vigentes, páginas estáticas (Quiénes somos, Servicios, Agencias, Transparencia), listado de noticias, búsqueda global y simulador de créditos con tabla de amortización.
- **Panel privado**:
  - **Simulaciones (dashboard)**: tabla filtrable/exportable de leads del simulador, cambio rápido de estado, selección masiva y borrado.
  - **Contenidos**: CRUD de anuncios con imágenes/orden/vigencia y CRUD de noticias con imágenes, adjuntos y estado borrador/publicado.
  - **RRHH**: CRUD de asesores.
  - **Ajustes de usuario**: perfil, contraseña, apariencia y 2FA (solo administradores).
- **Seguridad**: rutas protegidas por roles/permisos (`admin`, `asesor`, `imagen`, `rrhh`, `simulaciones.ver`, `anuncios.gestionar`, `noticias.gestionar`) y redirección de `/panel` según rol.

## Arquitectura funcional
- **Rutas públicas**: `/`, `/noticias`, `/buscar`, `/quienes*`, `/servicios*`, `/agencias`, `/transparencia`, `/simulador`.
- **Autenticación**: Breeze/Fortify (`routes/auth.php`).
- **Router de panel**: `/panel` decide destino (`/dashboard`, `/admin/anuncios`, `/rrhh/asesores` o acceso denegado).
- **Dashboard de simulaciones** (`/dashboard` → Livewire `App\Livewire\Modules\Simulaciones`):
  - Filtros: nombre, DNI, celular, monto, plazo, tipo, agencia, estado, rango de fechas y búsqueda rápida.
  - Acciones: exportar CSV/XLS (controlador `App\Http\Controllers\SimulacionExportController`), cambio rápido de estado, selección y eliminación.
  - Modelo `App\Models\Simulacion`: tabla por defecto `simulaciones` (configurable con `SIMULACION_TABLE` o auto-detección de tabla legada `prospectos_credito`).
- **Simulador de créditos** (`/simulador`, `ProspectoCreditoController`):
  - Calcula TEA/TEM, cuota fija y tabla de amortización.
  - Guarda el lead en `prospectos_credito` con estado `nuevo` y muestra resumen en sesión.
- **Contenidos**:
  - Anuncios (`Admin\AnuncioController`): imagen en `public/anuncios`, activo/orden, vigencia por fechas; scope `Anuncio::vigentes`.
  - Noticias (`Admin\NoticiaController`): imagen y adjunto, slug único, estados borrador/publicado con autocompletado de `publicado_en`.
- **RRHH**: `App\Http\Controllers\Rrhh\AsesorController` para CRUD protegido.
- **Asignación de roles**:
  - UI: `admin/usuarios` (listado) y `admin/usuarios/{id}/edit` con checkboxes.
  - Controlador: `App\Http\Controllers\Admin\UserRoleController@update` usando `syncRoles`/`syncPermissions` (modelo `User` con trait `HasRoles`).

## Rutas y middleware clave
- Simulaciones: `auth|role_or_permission:asesor|admin|simulaciones.ver`.
- Anuncios/Noticias admin: `auth|role_or_permission:imagen|admin|anuncios.gestionar` y `...|noticias.gestionar`.
- RRHH: `auth|role_or_permission:rrhh|admin`.
- Ajustes `/settings/*`: `auth|isAdmin`.
- Redirecciones en `/panel` según rol: `admin/asesor`→dashboard, `imagen`→anuncios, `rrhh`→RRHH, otros→denegado.

## Flujo de datos
1) Visitante envía simulación → `ProspectoCreditoController@store` calcula y guarda en `prospectos_credito`.
2) Usuarios con permisos ven/gestionan esas entradas en `/simulaciones` (modelo `Simulacion`, tabla configurable).
3) Contenidos (anuncios/noticias) gestionados en panel alimentan home y búsqueda pública.

## Requisitos previos
- PHP 8.2+ con extensiones habituales de Laravel.
- Composer.
- Node.js 20+ y npm.
- MySQL (o base compatible). Redis opcional para caché/colas.

## Puesta en marcha (local)
```bash
composer install
cp .env.example .env
# Ajusta credenciales de BD en .env
php artisan key:generate
php artisan migrate
npm install
npm run dev   # o npm run build para producción
php artisan serve
```
Colas: `php artisan queue:listen --tries=1` (incluido en `composer dev` con `concurrently`). Usa `php artisan storage:link` si necesitas exponer archivos públicos adicionales.

## Variables de entorno relevantes
- `APP_URL`, `APP_TIMEZONE=America/Lima`.
- `DB_*` para MySQL.
- `QUEUE_CONNECTION=database`, `SESSION_DRIVER=database`, `CACHE_STORE=database` por defecto.
- `SIMULACION_TABLE` (opcional) para apuntar el modelo `Simulacion` a otra tabla.
- Role gate por email (semillas simples): `ADMIN_EMAIL`, `ASESOR_EMAILS`, `IMAGEN_EMAILS`, `RRHH_EMAILS`.

## Seeds y usuarios de ejemplo
- Ejecuta `php artisan migrate --seed` para crear roles/permisos y usuarios demo.
- Usuarios creados por defecto (contraseña `12345678`, cámbialos en producción):
  - Admin: `admin@coopac.pe` (rol `admin`).
  - Contenidos: `imagen@coopac.pe` (rol `imagen`).
  - RRHH: `rrhh@coopac.pe` (rol `rrhh`).
- Seeder clave: `database/seeders/{RolesSeeder,AdminUserSeeder,AdditionalRoleUsersSeeder}.php`.

## Scripts útiles
- `composer setup`: instalación + copia de `.env` + key + migraciones + build front.
- `composer dev`: servidor Laravel, cola y Vite en paralelo.
- `composer test`: limpia caché de config y ejecuta pruebas.
- `npm run dev` / `npm run build`: assets con Vite/Tailwind.

## Operación diaria
- Levantar entorno local: `composer dev` (incluye serve + queue + Vite).
- Procesar colas en producción: `php artisan queue:work --tries=1`.
- Limpiar cachés ante cambios de config/rutas: `php artisan optimize:clear`.
- Enlaces a storage si alojas imágenes: `php artisan storage:link` (imágenes de anuncios ya viven en `public/anuncios`).

## Estructura de vistas y UI
- Layout y menú principal: `resources/views/components/layouts/app/header.blade.php`.
- Páginas públicas: `resources/views/welcome.blade.php`, `resources/views/Nosotros.blade.php`, `resources/views/servicios/ahorro.blade.php`, etc.
- Dashboard simulaciones: `resources/views/livewire/modules/simulaciones.blade.php`.
- Vistas admin: `resources/views/admin` (anuncios/noticias/usuarios).
- Estilos: `public/css/estilos.css` + Tailwind (`tailwind.config.js`).

## Cómo probar rápido
- Público: `/`, `/noticias`, `/buscar?q=ahorro`, `/simulador` (enviar formulario).
- Panel (usuario con rol): `/panel` para redirección automática; `/simulaciones` para tabla; `/admin/anuncios` y `/admin/noticias` para contenidos; `/rrhh/asesores` para RRHH.

## Pruebas y QA
- Backend: `composer test` (usa Pest). Considera `php artisan test --filter NombreTest` para suites específicas.
- Validar exportador: probar `/simulaciones` con filtros y exportar CSV/XLS; revisar BOM en CSV.
- Smoke manual: login con cada rol y verificar redirección `/panel`, CRUD de anuncios/noticias, y simulador público guardando leads.

## Despliegue
- Build front: `npm run build`.
- Config cache recomendado: `php artisan config:cache route:cache view:cache`.
- Asegura permisos de `storage/` y `bootstrap/cache/`. Ejecuta `php artisan migrate --force` en despliegue.

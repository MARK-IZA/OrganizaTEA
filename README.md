# OrganizaTEA

Aplicación web para el apoyo y organización diaria de familias con niños y niñas con TEA.

# Descripción

OrganizaTEA es una aplicación web desarrollada con Laravel que proporciona herramientas visuales y organizativas para facilitar el día a día de familias con niños y niñas con Trastorno del Espectro Autista (TEA).

La aplicación incluye funcionalidades como:

- Agenda semanal visual con colores.
- Notas/Observaciones.
- Temporizador visual.
- Perfil familiar.
- Información y recursos.
- Formulario de contacto.
- Sistema de autenticación y recuperación de contraseña.

# Tecnologías utilizadas

## Backend
- Laravel 12
- PHP 8.2
- MySQL 8.0

## Frontend
- Blade
- Bootstrap 5
- Bootstrap Icons
- JavaScript
- Fetch API (AJAX)
- CSS modularizado
- Vite

## Infraestructura
- Docker
- Docker Compose
- Nginx

## APIs utilizadas
- API CRUD interna desarrollada con Laravel
- API externa OpenStreetMap Nominatim

# Requisitos previos

Para ejecutar el proyecto es necesario tener instalado:

- Docker Desktop
- Node.js
- npm
- Git

# Instalación y puesta en marcha

```bash
# 1. Clonar el repositorio
git clone https://github.com/MARK-IZA/OrganizaTEA.git

# 2. Acceder al proyecto
cd OrganizaTEA

# 3. Copiar archivo de entorno
cp src/.env.example src/.env

# 4. Levantar contenedores Docker
docker compose up -d --build

# 5. Instalar dependencias PHP
docker compose exec app composer install

# 6. Generar APP_KEY
docker compose exec app php artisan key:generate

# 7. Ejecutar migraciones
docker compose exec app php artisan migrate

# 8. Instalar dependencias frontend
cd src
npm install

# 9. Compilar assets
npm run build

# 10. Acceder a la aplicación
http://localhost:8080
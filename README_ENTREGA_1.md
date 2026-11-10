# DataCiudad - Entrega 1 (puntos 1, 2, 3 y 4)

Proyecto basado en Laravel 12. Esta entrega integra:

1. Inicio de sesión y cinco perfiles: administrador, ventanilla, encuestador, calidad y enrutador.
2. Registro de solicitudes con nombres, apellidos, barrio, comuna/corregimiento, celular y dirección.
3. Georreferenciación con Leaflet y OpenStreetMap: el usuario de ventanilla selecciona la ubicación en el mapa y se guardan latitud y longitud.
4. Bitácora diaria para el perfil enrutador, consolidando solicitudes de todos los puntos de atención.

## Requisitos
- PHP 8.2 o superior
- Composer
- MySQL o MariaDB
- Node.js/npm (solo si se desea compilar los recursos front-end de Laravel; las vistas de esta entrega usan CSS propio)

## Instalación
1. Descomprimir el proyecto y abrir la carpeta `Dataciudad` en VS Code.
2. Instalar dependencias: `composer install`.
3. Crear el archivo de entorno: copiar `.env.example` como `.env`.
4. Configurar en `.env` la conexión MySQL (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`). Crear previamente esa base de datos vacía.
5. Generar la clave: `php artisan key:generate`.
6. Ejecutar migraciones: `php artisan migrate`.
7. Crear los cinco usuarios de demostración: `php artisan db:seed`.
8. Iniciar: `php artisan serve`.
9. Abrir `http://127.0.0.1:8000`.

No usar `php artisan migrate:fresh` sobre una base de datos con información que se quiera conservar: ese comando elimina las tablas.

## Usuarios de demostración
Todos tienen la contraseña `Dataciudad2026!`.

| Perfil | Correo |
|---|---|
| Administrador | admin@dataciudad.com |
| Ventanilla | ventanilla@dataciudad.com |
| Encuestador | encuestador@dataciudad.com |
| Calidad | calidad@dataciudad.com |
| Enrutador | enrutador@dataciudad.com |

## Recorrido de prueba
- Iniciar sesión como ventanilla.
- Abrir “Nueva solicitud”, completar los campos y hacer clic en el mapa para fijar coordenadas. Guardar.
- Cerrar sesión e ingresar como enrutador.
- Abrir “Bitácora diaria” y comprobar que aparece la solicitud recién creada.

## Notas
- El mapa requiere conexión a Internet para cargar los mosaicos de OpenStreetMap y la biblioteca Leaflet desde sus CDN.
- Los puntos de atención se registran mediante una lista fija de comunas indicadas en el enunciado. La ubicación exacta de cada punto puede ampliarse en una siguiente etapa.
- Los perfiles administrador, encuestador y calidad pueden autenticarse; sus módulos operativos completos corresponden a funcionalidades posteriores del proyecto.
- Se conserva la estructura y los archivos originales del proyecto, y se integran los módulos de esta primera entrega en Laravel. Las antiguas vistas PHP independientes quedan como referencia y no son usadas por las nuevas rutas Laravel.

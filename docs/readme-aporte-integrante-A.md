# Aporte README — Integrante A (Base de datos / Migración)

## Requisitos

Para ejecutar este proyecto en tu máquina necesitas tener instalado:

- **PHP 8.3 o superior** (recomendado 8.4+, ya que algunas dependencias de Symfony/Laravel lo requieren explícitamente).
- **Composer** (gestor de dependencias de PHP).
- **MySQL / MariaDB** en ejecución localmente (puede usarse a través de XAMPP, que además incluye phpMyAdmin).
- **Git**, para clonar el repositorio y manejar el control de versiones.

> Nota: XAMPP para Windows suele traer una versión de PHP más antigua (8.0.x) que la que exige este proyecto. Si al correr `composer install` aparece un error del tipo `your php version does not satisfy that requirement`, es necesario instalar una versión de PHP más reciente por separado (ver Problemas encontrados) y priorizarla en el `PATH` del sistema, sin reemplazar la carpeta de XAMPP.

## Instalación

1. Clonar el repositorio y entrar a la carpeta del proyecto:
   ```bash
   git clone https://github.com/MrNaserMartinez/laravel-productosAndContadores-crud.git
   cd laravel-productosAndContadores-crud
   ```

2. Instalar las dependencias de PHP con Composer:
   ```bash
   composer install
   ```

3. Copiar el archivo de entorno de ejemplo y generar la clave de la aplicación:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   `key:generate` crea una clave única de seguridad que Laravel usa para cifrar sesiones y datos, y la escribe automáticamente en la variable `APP_KEY` del `.env`.

## Configuración

Dentro del archivo `.env`, las variables relevantes para este proyecto son:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=productos_crud
DB_USERNAME=root
DB_PASSWORD=
```

- `DB_CONNECTION`: motor de base de datos (MySQL/MariaDB en este caso).
- `DB_HOST`: dirección donde corre la base de datos (`127.0.0.1` para desarrollo local).
- `DB_PORT`: puerto de conexión. Por defecto `3306`; si tu MySQL local usa otro puerto (por ejemplo `3307`, en caso de conflicto con otra instalación), debe actualizarse aquí.
- `DB_DATABASE`: nombre de la base de datos que va a usar el proyecto.
- `DB_USERNAME` / `DB_PASSWORD`: credenciales de acceso. En una instalación local con XAMPP, por defecto es el usuario `root` sin contraseña.

## Base de datos

1. Con MySQL corriendo (por ejemplo, iniciando el módulo MySQL desde el XAMPP Control Panel), crear la base de datos vacía. La forma más simple es desde phpMyAdmin:
   - Abrir `http://localhost/phpmyadmin` (requiere que Apache también esté encendido en XAMPP, ya que phpMyAdmin corre sobre él).
   - Clic en **Nueva**, escribir `productos_crud` como nombre, y **Crear**.

   Alternativamente, por SQL:
   ```sql
   CREATE DATABASE productos_crud;
   ```

2. Ejecutar las migraciones, que leen los archivos de `database/migrations/` y crean las tablas reales en la base de datos:
   ```bash
   php artisan migrate
   ```

3. Verificar en phpMyAdmin que las tablas se hayan creado correctamente, incluyendo:
   - `productos` (proyecto base)
   - `contadores`, con las columnas `numero_contador` (string 20), `direccion` (string 150) y `lectura_actual` (decimal 10,2), siguiendo el mismo patrón de la tabla de productos.

## Problemas encontrados (parte de A)

- `php` y `composer` no eran reconocidos como comandos en PowerShell tras instalar XAMPP. Solución: agregar `C:\xampp\php` al `PATH` del sistema y **reiniciar todas las terminales** (los cambios de `PATH` no aplican a ventanas ya abiertas).
- Composer se había instalado como `composer.phar` local dentro de la carpeta del proyecto (usando el script manual de instalación), en vez de como comando global. Solución: usar el instalador oficial `Composer-Setup.exe`, que detecta la ruta de PHP automáticamente y configura el comando `composer` de forma global.
- `composer install` falló con múltiples errores de tipo `your php version does not satisfy that requirement`, ya que XAMPP trae PHP 8.2.12 y el proyecto requiere PHP 8.3+ (y algunas dependencias de Symfony piden 8.4.1+). Solución: descargar PHP 8.4 (versión Non Thread Safe, x64) desde windows.php.net, descomprimirlo en una carpeta aparte (`C:\php84`, sin tocar la carpeta de XAMPP), configurar su `php.ini` habilitando las extensiones necesarias (`curl`, `fileinfo`, `mbstring`, `openssl`, `pdo_mysql`, `mysqli`, `gd`, `zip`), y agregar esa carpeta al `PATH` **por encima** de `C:\xampp\php`, ya que Windows usa la primera coincidencia que encuentra en la lista.
- phpMyAdmin daba `ERR_CONNECTION_REFUSED` al intentar abrirlo. Causa: phpMyAdmin corre sobre Apache, no solo sobre MySQL; hacía falta encender ambos módulos desde el XAMPP Control Panel.
- El remoto `origin` en Git apuntaba a un repositorio distinto al del equipo (`laravel-productos-crud` en vez de `laravel-productosAndContadores-crud`), lo que causaba que los Pull Requests no encontraran las ramas ni los commits. Solución: corregir la URL del remoto en Fork para que apuntara al repositorio correcto, y volver a hacer push de la rama.
- El repositorio correcto del equipo no tenía todavía la rama `develop` (solo `main`). Solución: crear `develop` a partir de `main` y subirla al remoto, para poder usarla como base de las ramas `feature/...` según GitFlow.

## Reflexión técnica — Pregunta 2 (A)

**¿Qué parte de la estructura del proyecto te pareció más importante?**

La parte que me pareció más importante fue la separación clara entre **migración → modelo → controlador → vista → ruta**, ya que ese orden define cómo fluyen los datos desde la base de datos hasta lo que el usuario ve en pantalla. Entender que la migración define la "forma" real de la tabla en la base de datos, y que el modelo (a través de `$fillable`) controla qué datos pueden escribirse de forma masiva, ayuda a evitar errores de seguridad y de datos inconsistentes antes de siquiera llegar al controlador. Además, ver cómo Contadores replica exactamente el mismo patrón que Productos confirmó que Laravel está diseñado para que, una vez entendido un CRUD, todos los demás sigan una estructura predecible — lo cual también hace más fácil dividir el trabajo en equipo, ya que cada rol (migración, modelo/controlador, vistas, rutas) tiene una responsabilidad bien delimitada.

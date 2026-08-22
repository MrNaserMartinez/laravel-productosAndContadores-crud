# Productos + Contadores CRUD — Laravel (Oficina del Agua)

## 📌 Nombre del proyecto
Productos CRUD — Laravel (con ejercicio adicional de Contadores)

Aplicación de práctica hecha con Laravel: un CRUD de productos ya provisto como plantilla, y un CRUD de contadores construido por el equipo siguiendo el mismo patrón, como actividad de familiarización con el stack antes del proyecto integrador "Oficina del Agua".


## 🧱 Stack utilizado
- Framework: Laravel
- Estilo: Bootstrap 5 (vía CDN)
- Base de datos: MariaDB (vía XAMPP)
- ORM: Eloquent
- Plantillas: Blade
- Diseño visual: [SB Admin](https://startbootstrap.com/template/sb-admin) (Start Bootstrap, licencia MIT), integrado vía CDN al layout compartido de la aplicación
- Despliegue previsto: AWS


## ✅ Requisitos
- PHP 8.3 o superior (el proyecto no corre con versiones anteriores)
- Composer
- MySQL / MariaDB (por ejemplo, vía XAMPP)


## ⚙️ Instalación
```bash
composer install
```


## 🔧 Configuración
```bash
cp .env.example .env
php artisan key:generate
```

Revisar en `.env` que `DB_PORT` coincida con el puerto real de tu MySQL local. Por defecto es `3306`; si tu MySQL corre en otro puerto (nos pasó, ver sección de Problemas encontrados), ajústalo ahí.


## 🗄️ Base de datos
Crear la base de datos vacía desde phpMyAdmin (`http://localhost/phpmyadmin` → **Nueva** → nombre `productos_crud` → **Crear**), y luego correr las migraciones:

```bash
php artisan migrate
```


## ▶️ Ejecución
```bash
php artisan serve
```

Abrir en el navegador:
- http://127.0.0.1:8000/productos
- http://127.0.0.1:8000/contadores


## 🐛 Problemas encontrados

**1. "php" y "composer" no se reconocían como comando en la terminal.**
PHP y Composer estaban instalados (vía XAMPP y el instalador de Composer), pero Windows no sabía dónde buscarlos. Se solucionó agregando la ruta de PHP a las Variables de entorno del sistema (PATH), y reiniciando la terminal para que el cambio se aplicara.

**2. MySQL no arrancaba en XAMPP: "Port 3306 in use".**
Otro proceso ya estaba usando el puerto 3306 de MySQL en la máquina. Se solucionó cambiando el puerto de MySQL en XAMPP (archivo `my.ini`) a `3307`, y actualizando también `phpMyAdmin/config.inc.php` y el `.env` del proyecto para que apuntaran al nuevo puerto.

**3. `composer install` fallaba con decenas de errores de versión de PHP.**
El proyecto requiere PHP 8.3 o superior (algunos paquetes internos incluso piden 8.4+), pero el instalador de XAMPP para Windows solo trae hasta PHP 8.0.30. Se solucionó instalando una versión más reciente de PHP por separado (sin desinstalar XAMPP, que se sigue usando para MySQL y phpMyAdmin), y priorizando esa nueva ruta por encima de la de XAMPP en el PATH del sistema.

**4. Laravel adivinaba mal el plural en español de "Contador".**
Por defecto, Eloquent asume que el nombre de la tabla es el plural en inglés del modelo (`Contador` → `contadors`), y `Route::resource` hace lo mismo con el nombre del parámetro de la URL (`{contadore}` en vez de `{contador}`). Esto causaba un error `Base table or view not found` al listar, y `Missing required parameter` al editar. Se solucionó agregando `protected $table = 'contadores';` en el modelo, y `->parameters(['contadores' => 'contador'])` en la ruta.

<!-- Cada integrante: si te pasó algo distinto durante tu instalación, agrégalo aquí siguiendo el mismo formato -->


## 📸 Evidencia — CRUD de Contadores

| Operación | Captura |
|---|---|
| Listar | <img width="1382" height="840" alt="Listado de contadores" src="https://github.com/user-attachments/assets/6080ee91-f42e-4548-9c64-92e2f0cacd48" /> |
| Crear | <img width="1381" height="759" alt="Formulario para crear un contador" src="https://github.com/user-attachments/assets/93ffdb9a-7fdc-42ff-b401-806c9fcee019" /> |
| Editar | <img width="1377" height="831" alt="Formulario para editar un contador" src="https://github.com/user-attachments/assets/823fac1d-614b-4d82-a06d-9eda27b5b5ec" /> |
| Eliminar | <img width="1379" height="846" alt="Confirmación de eliminación de un contador" src="https://github.com/user-attachments/assets/94ebd8ff-f366-446a-9438-2c8d3038ea01" /> |


## 💡 Reflexión técnica

**1. ¿Qué fue lo que más costó entender del framework?**
<!-- Todo el equipo -->


**2. ¿Qué parte de la estructura del proyecto pareció más importante?**
<!-- A -->


**3. Explica con tus propias palabras el flujo de una petición, de principio a fin.**
<!-- B -->


**4. Menciona al menos 3 buenas prácticas investigadas y por qué son importantes.**

- **Directiva `@error` en cada campo del formulario**: en vez de mostrar un mensaje genérico de error, Laravel permite mostrar el mensaje específico de validación justo debajo del campo que falló. Esto mejora la experiencia del usuario porque sabe exactamente qué corregir, sin tener que adivinar.
- **Helper `old()` para conservar los datos ingresados**: cuando un formulario falla la validación y Laravel regresa a la vista anterior, `old('campo')` recupera lo que el usuario ya había escrito, en vez de dejar el formulario vacío. Evita que la persona tenga que volver a llenar todo desde cero.
- **Separación de layout con `@extends` y `@yield`/`@section`**: mantener un solo archivo de layout (`layouts/app.blade.php`) del que heredan todas las vistas evita duplicar el HTML del sidebar, navbar y estructura general en cada página. Si se necesita un cambio visual (como el que hicimos al integrar el template SB Admin), se hace en un solo lugar y se aplica a toda la aplicación automáticamente.


**5. Menciona al menos un problema técnico encontrado y cómo se solucionó.**
<!-- D — se puede apoyar directamente en la sección "Problemas encontrados" de arriba -->


**6. ¿Qué aprendieron que les será útil para el proyecto del módulo?**
<!-- Todo el equipo -->

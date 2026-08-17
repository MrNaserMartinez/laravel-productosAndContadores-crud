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

<!-- Cada integrante: si te pasó algo distinto durante tu instalación, agrégalo aquí siguiendo el mismo formato -->


## 📸 Evidencia — CRUD de Contadores
<!-- D: agregar capturas de las 4 operaciones una vez esté listo el CRUD -->
| Operación | Captura |
|---|---|
| Listar   | |
| Crear    | |
| Editar   | |
| Eliminar | |


## 💡 Reflexión técnica

**1. ¿Qué fue lo que más costó entender del framework?**
<!-- Todo el equipo -->


**2. ¿Qué parte de la estructura del proyecto pareció más importante?**
<!-- A -->


**3. Explica con tus propias palabras el flujo de una petición, de principio a fin.**
<!-- B -->


**4. Menciona al menos 3 buenas prácticas investigadas y por qué son importantes.**
<!-- C -->


**5. Menciona al menos un problema técnico encontrado y cómo se solucionó.**
<!-- D — se puede apoyar directamente en la sección "Problemas encontrados" de arriba -->


**6. ¿Qué aprendieron que les será útil para el proyecto del módulo?**
<!-- Todo el equipo -->

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
El proyecto requiere PHP 8.3 o superior (algunos paquetes internos incluso piden 8.4+), pero el instalador de XAMPP para Windows no trae una versión suficiente por defecto (según la máquina, trajo PHP 8.0.30 o PHP 8.2.12). Se solucionó instalando una versión más reciente de PHP por separado — 8.4 o 8.5 según el caso — (sin desinstalar XAMPP, que se sigue usando para MySQL y phpMyAdmin), configurando sus extensiones necesarias (`curl`, `fileinfo`, `mbstring`, `openssl`, `pdo_mysql`, `mysqli`, `gd`, `zip`) y priorizando esa nueva ruta por encima de la de XAMPP en el PATH del sistema, ya que Windows usa la primera coincidencia que encuentra en la lista.

**4. Laravel adivinaba mal el plural en español de "Contador".**
Por defecto, Eloquent asume que el nombre de la tabla es el plural en inglés del modelo (`Contador` → `contadors`), y `Route::resource` hace lo mismo con el nombre del parámetro de la URL (`{contadore}` en vez de `{contador}`). Esto causaba un error `Base table or view not found` al listar, y `Missing required parameter` al editar. Se solucionó agregando `protected $table = 'contadores';` en el modelo, y `->parameters(['contadores' => 'contador'])` en la ruta.

**5. Composer se había instalado como `composer.phar` local en vez de comando global.**
Al usar el script manual de instalación, Composer quedó como un archivo dentro de la carpeta del proyecto en vez de un comando disponible en toda la terminal. Se solucionó desinstalando esa versión local y usando el instalador oficial `Composer-Setup.exe`, que detecta la ruta de PHP automáticamente y configura el comando `composer` de forma global.

**6. phpMyAdmin daba `ERR_CONNECTION_REFUSED` al intentar abrirlo.**
phpMyAdmin corre sobre Apache, no solo sobre MySQL — hacía falta encender ambos módulos desde el XAMPP Control Panel, no solo MySQL.

**7. El remoto `origin` de Git apuntaba a un repositorio distinto al del equipo.**
Apuntaba a un fork/repo individual en vez del repositorio compartido, lo que causaba que los Pull Requests no encontraran las ramas ni los commits. Se solucionó corrigiendo la URL del remoto para que apuntara al repositorio correcto del equipo, y volviendo a subir la rama.

**8. Al repositorio del equipo le faltaba la rama `develop`.**
Solo existía `main`. Se solucionó creando `develop` a partir de `main` y subiéndola al remoto, para usarla como base de las ramas `feature/...` según el flujo de trabajo de GitFlow.

**9. `php -v` mostraba warnings de `Unable to load dynamic library` para varias extensiones (curl, mbstring, openssl, pdo_mysql, etc.).**
La línea `extension_dir` del `php.ini` apuntaba a una ruta incorrecta. Se solucionó corrigiéndola para que apuntara a la carpeta `ext` real dentro de la instalación de PHP.
 
**10. El instalador de Composer fallaba con `SSL routines::certificate verify failed`.**
Aun con un `cacert.pem` válido y actualizado, y descartando problemas de red o de reloj del sistema, la causa fue que el servidor no enviaba el certificado intermedio necesario para completar la cadena de confianza — algo que los navegadores compensan automáticamente, pero que PHP/OpenSSL no resuelve por defecto. Reintentar con el instalador oficial de Composer completó la instalación correctamente.
 
**11. Al clonar el repositorio en una carpeta nueva, faltaba la carpeta `vendor/`.**
Como nunca se había corrido `composer install` en esa copia recién clonada, el proyecto no tenía las dependencias descargadas. Se solucionó corriendo `composer install` en la carpeta nueva (recordatorio: `vendor/` nunca se sube a Git, cada copia clonada necesita este paso).
 
**12. `php artisan migrate` se interrumpió a mitad de las migraciones.**
El servicio de MySQL en XAMPP se detuvo solo, sin un error claro en el log, dejando la base de datos en un estado intermedio (algunas tablas creadas, pero no registradas como migradas). Se solucionó reiniciando MySQL y corriendo `php artisan migrate:fresh`, que elimina todas las tablas y recrea el esquema completo desde cero.


## 📸 Evidencia — CRUD de Contadores

| Operación | Captura |
|---|---|
| Listar | <img width="1382" height="840" alt="Listado de contadores" src="https://github.com/user-attachments/assets/6080ee91-f42e-4548-9c64-92e2f0cacd48" /> |
| Crear | <img width="1381" height="759" alt="Formulario para crear un contador" src="https://github.com/user-attachments/assets/93ffdb9a-7fdc-42ff-b401-806c9fcee019" /> |
| Editar | <img width="1377" height="831" alt="Formulario para editar un contador" src="https://github.com/user-attachments/assets/823fac1d-614b-4d82-a06d-9eda27b5b5ec" /> |
| Eliminar | <img width="1379" height="846" alt="Confirmación de eliminación de un contador" src="https://github.com/user-attachments/assets/94ebd8ff-f366-446a-9438-2c8d3038ea01" /> |


## 💡 Reflexión técnica

**1. ¿Qué fue lo que más costó entender del framework?**
Más que un concepto de Laravel en sí, lo que más costó fue el entorno alrededor del framework: cada integrante del equipo tuvo problemas distintos para dejar PHP, Composer y MySQL funcionando en su máquina — desde versiones de PHP demasiado antiguas para lo que pedía el proyecto, hasta certificados SSL y rutas mal configuradas en el php.ini. Una vez resuelto eso, el framework en sí fue más predecible de lo esperado: entender el patrón MVC (migración → modelo → controlador → vista → ruta) tomó relativamente poco, porque una vez que se entiende con un CRUD (productos), el siguiente (Contadores) es prácticamente el mismo patrón con otros nombres. Lo más sutil fue algo que no esperábamos: Laravel adivina automáticamente varias cosas (como el nombre de la tabla o el parámetro de una ruta) a partir de reglas de plural en inglés, y eso falla silenciosamente con palabras en español como "contador" — hubo que aprender a ser explícitos en vez de confiar en las convenciones automáticas.


**2. ¿Qué parte de la estructura del proyecto pareció más importante?**
La parte que me pareció más importante fue la separación clara entre migración → modelo → controlador → vista → ruta, ya que ese orden define cómo fluyen los datos desde la base de datos hasta lo que el usuario ve en pantalla. Entender que la migración define la "forma" real de la tabla en la base de datos, y que el modelo (a través de $fillable) controla qué datos pueden escribirse de forma masiva, ayuda a evitar errores de seguridad y de datos inconsistentes antes de siquiera llegar al controlador. Además, ver cómo Contadores replica exactamente el mismo patrón que Productos confirmó que Laravel está diseñado para que, una vez entendido un CRUD, todos los demás sigan una estructura predecible — lo cual también hace más fácil dividir el trabajo en equipo, ya que cada rol (migración, modelo/controlador, vistas, rutas) tiene una responsabilidad bien delimitada.


**3. Explica con tus propias palabras el flujo de una petición, de principio a fin.**
Cuando un usuario visita /contadores o envía un formulario (por ejemplo, al crear un nuevo contador), el navegador manda una petición HTTP que primero pasa por routes/web.php. Ahí, Route::resource('contadores', ContadorController::class) ya dejó registradas las 7 rutas posibles, así que Laravel identifica cuál método del ContadorController debe atender esa petición según la URL y el verbo HTTP (GET, POST, PUT, DELETE). Por ejemplo, un POST a /contadores llama a store().

Dentro del controlador, la petición se valida primero con $request->validate([...]) — si algún campo no cumple las reglas, Laravel corta el flujo ahí mismo y regresa automáticamente a la vista anterior con los errores, sin siquiera tocar la base de datos. Si la validación pasa, el controlador usa el Modelo (Contador::create($request->all())) para hablar con la base de datos a través de Eloquent, que traduce esa instrucción PHP a SQL por debajo. Una vez guardado el registro, el controlador no devuelve datos directamente: hace un redirect()->route('contadores.index'), lo que provoca una nueva petición GET hacia index(), que trae todos los contadores con Contador::all() y se los pasa a la vista Blade (contadores.index) mediante compact('contadores'). Ahí, la vista recorre los datos con @foreach y genera el HTML final que el navegador muestra. Entender este ciclo completo (ruta → controlador → validación → modelo → base de datos → vista → HTML) ayuda a saber exactamente en qué capa buscar cuando algo falla, en vez de revisar todo el proyecto a ciegas.


**4. Menciona al menos 3 buenas prácticas investigadas y por qué son importantes.**

- **Directiva `@error` en cada campo del formulario**: en vez de mostrar un mensaje genérico de error, Laravel permite mostrar el mensaje específico de validación justo debajo del campo que falló. Esto mejora la experiencia del usuario porque sabe exactamente qué corregir, sin tener que adivinar.
- **Helper `old()` para conservar los datos ingresados**: cuando un formulario falla la validación y Laravel regresa a la vista anterior, `old('campo')` recupera lo que el usuario ya había escrito, en vez de dejar el formulario vacío. Evita que la persona tenga que volver a llenar todo desde cero.
- **Separación de layout con `@extends` y `@yield`/`@section`**: mantener un solo archivo de layout (`layouts/app.blade.php`) del que heredan todas las vistas evita duplicar el HTML del sidebar, navbar y estructura general en cada página. Si se necesita un cambio visual (como el que hicimos al integrar el template SB Admin), se hace en un solo lugar y se aplica a toda la aplicación automáticamente.


**5. Menciona al menos un problema técnico encontrado y cómo se solucionó.**
"php" y "composer" no se reconocían como comando en la terminal. PHP y Composer estaban instalados (vía XAMPP y el instalador de Composer), pero Windows no sabía dónde buscarlos. Se solucionó agregando la ruta de PHP a las Variables de entorno del sistema (PATH), y reiniciando la terminal para que el cambio se aplicara.


**6. ¿Qué aprendieron que les será útil para el proyecto del módulo?**
Primero, que vale la pena resolver el entorno de desarrollo (PHP, Composer, base de datos) con calma desde el inicio del proyecto real, porque cualquier problema ahí bloquea todo lo demás — y ya sabemos, por experiencia propia, cuáles son los errores más comunes en Windows y cómo diagnosticarlos. Segundo, que el patrón MVC de Laravel es replicable: una vez que se domina un CRUD completo, construir el siguiente es mucho más rápido, lo que nos da confianza para las entidades del proyecto de "Oficina del Agua". Tercero, que hay que verificar los nombres que Laravel adivina automáticamente (tablas, parámetros de ruta) cuando se usan palabras en español, en vez de asumir que va a funcionar igual que en los ejemplos en inglés. Y por último, en la parte de equipo: dividir el trabajo por roles claros (migración, modelo/controlador, vistas, rutas) funcionó bien porque cada quien pudo avanzar en paralelo, siempre que los nombres de columna se acordaran antes de empezar.

# Aporte README — Integrante B (Modelo y Controlador)

## Mi aporte al proyecto

Adapté el Modelo (`app/Models/Contador.php`) y el Controlador (`app/Http/Controllers/ContadorController.php`) de Contadores, siguiendo el mismo patrón usado en Productos:

- **Modelo**: definí la propiedad `$fillable` con los tres campos de la tabla (`numero_contador`, `direccion`, `lectura_actual`), lo que le permite a Eloquent aceptar la asignación masiva vía `Contador::create($request->all())` de forma segura.
- **Controlador**: implementé las 5 acciones necesarias (`index`, `create`, `store`, `edit`, `update`, `destroy`), incluyendo validación real con `$request->validate([...])` en `store` y `update`, y usando *route model binding* (`Contador $contador` como parámetro) para que Laravel resuelva automáticamente el registro por su `id` sin necesidad de buscarlo manualmente.

## Problemas encontrados (parte de B)

- Al no tener PHP ni Composer instalados en esta máquina, `php -v` y `composer -V` no eran reconocidos como comandos. Se instaló XAMPP (para MySQL/phpMyAdmin) y, aparte, PHP 8.5 en una carpeta independiente (`C:\php84`, sin tocar XAMPP), agregándola al `PATH` del sistema por encima de la carpeta de PHP de XAMPP.
- Al correr `php -v`, aparecían warnings de `Unable to load dynamic library` para varias extensiones (curl, mbstring, openssl, pdo_mysql, etc.). Causa: la línea `extension_dir` del `php.ini` apuntaba a una ruta incorrecta. Solución: corregirla para que apuntara a la carpeta `ext` real dentro de la instalación de PHP.
- Al instalar Composer, el instalador oficial fallaba con `SSL routines::certificate verify failed`, incluso con un `cacert.pem` válido y actualizado. Tras descartar problemas de red, reloj del sistema e interceptación de tráfico (el certificado del sitio era legítimo, emitido por Let's Encrypt), se identificó que el servidor no estaba enviando el certificado intermedio necesario para completar la cadena de confianza — algo que los navegadores compensan automáticamente, pero que PHP/OpenSSL no resuelven por defecto. El instalador oficial de Composer terminó completando la instalación correctamente.
- Al clonar el repositorio en una carpeta nueva (para trabajar desde VS Code en vez de WebStorm), faltaba la carpeta `vendor/`, ya que nunca se había corrido `composer install` en esa copia. Solución: correr `composer install` en la nueva carpeta clonada.
- Al correr `php artisan migrate`, la conexión a MySQL se interrumpió a mitad de las migraciones (el servicio de MySQL en XAMPP se detuvo solo, sin un error claro en el log). Esto dejó la base de datos en un estado intermedio (algunas tablas creadas, pero no registradas como migradas). Solución: reiniciar MySQL y correr `php artisan migrate:fresh`, que elimina todas las tablas y vuelve a crear el esquema completo desde cero.

## Reflexión técnica — Pregunta 3 (B)

**Explica con tus propias palabras cómo funciona una petición desde que el usuario realiza una acción hasta que obtiene una respuesta.**

Cuando un usuario visita `/contadores` o envía un formulario (por ejemplo, al crear un nuevo contador), el navegador manda una petición HTTP que primero pasa por `routes/web.php`. Ahí, `Route::resource('contadores', ContadorController::class)` ya dejó registradas las 7 rutas posibles, así que Laravel identifica cuál método del `ContadorController` debe atender esa petición según la URL y el verbo HTTP (GET, POST, PUT, DELETE). Por ejemplo, un POST a `/contadores` llama a `store()`.

Dentro del controlador, la petición se valida primero con `$request->validate([...])` — si algún campo no cumple las reglas, Laravel corta el flujo ahí mismo y regresa automáticamente a la vista anterior con los errores, sin siquiera tocar la base de datos. Si la validación pasa, el controlador usa el Modelo (`Contador::create($request->all())`) para hablar con la base de datos a través de Eloquent, que traduce esa instrucción PHP a SQL por debajo. Una vez guardado el registro, el controlador no devuelve datos directamente: hace un `redirect()->route('contadores.index')`, lo que provoca una nueva petición GET hacia `index()`, que trae todos los contadores con `Contador::all()` y se los pasa a la vista Blade (`contadores.index`) mediante `compact('contadores')`. Ahí, la vista recorre los datos con `@foreach` y genera el HTML final que el navegador muestra. Entender este ciclo completo (ruta → controlador → validación → modelo → base de datos → vista → HTML) ayuda a saber exactamente en qué capa buscar cuando algo falla, en vez de revisar todo el proyecto a ciegas.
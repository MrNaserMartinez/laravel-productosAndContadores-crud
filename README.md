# Productos + Contadores CRUD — Laravel (Oficina del Agua)

## 📌 Nombre del proyecto
<!-- D: ¿Qué aplicación estás utilizando? -->


## 🧱 Stack utilizado
<!-- D: ¿Qué framework y tecnologías utiliza? -->
- Framework: Laravel
- Estilo: Bootstrap 5
- Base de datos: MariaDB
- Despliegue previsto: AWS


## ✅ Requisitos
<!-- A: ¿Qué necesita una persona para ejecutar el proyecto? -->
- PHP 8.1 o superior
- Composer
- MySQL / MariaDB


## ⚙️ Instalación
<!-- A: ¿Cuáles son los pasos para instalar las dependencias? -->
```bash
composer install
```

## 🔧 Configuración
<!-- A: ¿Qué variables de entorno o configuraciones son necesarias? -->
```bash
cp .env.example .env
php artisan key:generate
```


## 🗄️ Base de datos
<!-- A: ¿Cómo se configura y prepara la base de datos? -->
```sql
CREATE DATABASE productos_crud;
```
```bash
php artisan migrate
```


## ▶️ Ejecución
<!-- D: ¿Qué comandos deben ejecutarse para levantar la aplicación? -->
```bash
php artisan serve
```
Luego abrir:
- http://127.0.0.1:8000/productos
- http://127.0.0.1:8000/contadores


## 🐛 Problemas encontrados
<!-- Todo el equipo: cada quien anota el suyo -->
-
-
-


## 📸 Evidencia — CRUD de Contadores
<!-- D: capturas de las 4 operaciones -->
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
<!-- D -->


**6. ¿Qué aprendieron que les será útil para el proyecto del módulo?**
<!-- Todo el equipo -->

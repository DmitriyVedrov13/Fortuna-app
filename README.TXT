# 🥠 Galleta de la Fortuna

Proyecto web desarrollado en PHP (Laravel 12) con arquitectura MVC y AngularJS. El usuario puede iniciar sesión, hacer clic en una galleta de la fortuna y recibir un mensaje aleatorio sabio.

---

## 🧩 Tecnologías Utilizadas

- **Laravel 12** (PHP ≥ 8.2)
- **MySQL** (vía phpMyAdmin)
- **HTML + CSS**
- **AngularJS**
- **Autenticación con sesiones (middleware `auth`)**

---

## 🏛️ Arquitectura del Proyecto

El sistema sigue una estructura **MVC** y está dividido en capas:

/app
├── Http
│ └── Controllers
│ └── FortunaController.php
/resources
└── views
├── login.blade.php
├── register.blade.php
└── galleta.blade.php
/routes
└── web.php

markdown
Копировать
Редактировать

- **Modelo:** `User` (Laravel default, tabla `users`)
- **Controlador:** `FortunaController` maneja la lógica de vista y API
- **Vista:** archivos `.blade.php` con AngularJS
- **Rutas:** definidas en `web.php`, protegidas con `auth`

---

## 🔐 Autenticación

Laravel maneja la autenticación usando sesiones:

- **Login:** `/login` (formulario HTML)
- **Registro:** `/register`
- **Logout:** `/logout`
- **Protección:** rutas `/galleta` y `/api/fortuna` usan middleware `auth`

El usuario se autentica con email y contraseña. Si no ha iniciado sesión, Laravel redirige a `/login`.

---

## 🗺️ Rutas Definidas

| Ruta              | Método | Middleware | Función                           |
|-------------------|--------|------------|------------------------------------|
| `/login`          | GET    | -          | Mostrar formulario de login        |
| `/login`          | POST   | -          | Procesar credenciales              |
| `/logout`         | POST   | auth       | Cerrar sesión                      |
| `/register`       | GET    | -          | Mostrar formulario de registro     |
| `/register`       | POST   | -          | Crear nuevo usuario y loguear      |
| `/galleta`        | GET    | auth       | Vista protegida de la aplicación   |
| `/api/fortuna`    | GET    | auth       | Retorna una frase aleatoria (JSON) |

---

## 🧠 Lógica del Juego

- El usuario inicia sesión
- AngularJS muestra un botón
- Al hacer clic, se solicita `/api/fortuna`
- Laravel responde con una frase aleatoria
- El resultado se muestra en pantalla

Las frases están almacenadas como array en el backend.

---

## 🛠️ Instalación y Ejecución

1. Clonar o descomprimir el proyecto en `htdocs`
2. Crear base de datos en phpMyAdmin (ej: `fortuna`)
3. Configurar `.env` con datos correctos de MySQL
4. Ejecutar:

```bash
composer install
php artisan migrate
php artisan serve
Acceder a http://127.0.0.1:8000/register para crear usuario

💾 Exportar Base de Datos
Abrir phpMyAdmin

Seleccionar la base de datos (ej: fortuna)

Ir a Exportar

Formato: SQL

Descargar como fortuna.sql

📝 Autor
Desarrollado por Dmitriy Vedrov, 2025.
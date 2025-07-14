Galleta de la Fortuna

# 🥠 Galleta de la Fortuna

Aplicación web desarrollada en Laravel 12 que permite a los usuarios registrados recibir frases sabias aleatorias. Incluye un panel privado para administradores con gestión completa de frases.

## 📌 Requisitos

- PHP 8.2 o superior
- Composer
- MySQL
- Node.js (opcional si se desea usar Vite o AngularJS)
- Laravel 12
---

## ⚙️ Instalación

1. Clonar el repositorio:

git clone https://github.com/DmitriyVedrov13/Fortuna-app
cd galleta-fortuna

Instalar dependencias PHP:

composer install

Crear archivo de entorno:

cp .env.example .env
php artisan key:generate
Configurar .env con los datos de tu base de datos MySQL:

env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=galleta_db
DB_USERNAME=root
DB_PASSWORD=tu_clave

Ejecutar migraciones:

php artisan migrate


👥 Funcionalidades

Registro y Autenticación
Registro de usuarios con validación de email único

Login con persistencia de sesión

Logout seguro

Redirección automática al juego al iniciar sesión

Juego de la Galleta de la Fortuna

Ruta /galleta accesible para usuarios autenticados

Frase aleatoria desde la base de datos

API /api/fortuna para obtener nueva frase sin recargar

Panel de Administración (sólo para administradores)
Ruta protegida: /admin/frases

Agregar nuevas frases

Validar frases duplicadas (control con mensajes amigables)

Eliminar frases

🛡️ Seguridad y Validaciones
PDO: Laravel utiliza PDO por defecto para todas las consultas a la base de datos

Validaciones:

Emails únicos en el registro

Frases no repetidas al guardar

Middleware:

auth para proteger rutas privadas

is_admin para restringir el panel solo a administradores

Errores controlados:

Se muestran mensajes claros en caso de errores o duplicaciones

🧪 Datos de prueba
Incluye el archivo galleta_dump.sql con:

Usuarios:

admin@example.com → contraseña: admin123 (is_admin = 1)

user@example.com → contraseña: user123 (is_admin = 0)

Frases:

"La paciencia es una virtud."

"El conocimiento es poder."

"Cada día es una nueva oportunidad."

📜 Licencia
Este proyecto se entrega con fines académicos bajo la Licencia MIT.
# Proyecto Cybac

Sistema web integral de gestión y administración para centro deportivo y de acondicionamiento físico.

---

## 📋 ¿Qué hace el proyecto?

**Proyecto Cybac** es una plataforma web desarrollada para automatizar y centralizar la administración integral de un centro deportivo o gimnasio. Su objetivo general es optimizar la gestión operativa, la interacción con los clientes y el control de pagos y servicios.

### Principales Funcionalidades por Rol

1. **Administrador (`admin`):**
   * **Gestión de Usuarios:** Registro, edición, baja y asignación de roles.
   * **Servicios y Requisitos:** Configuración de servicios ofrecidos y requisitos de inscripción.
   * **Membresías:** Creación, edición y administración de tarifas y planes de membresía.
   * **Clases y Cupos:** Programación de clases presenciales, asignación de instructores y control de inscritos.
   * **Control de Pagos:** Revisión de comprobantes subidos por usuarios, aprobación o rechazo de transacciones y generación de reportes financieros en PDF.
   * **CMS Informativo:** Gestión de datos de contacto/horarios del centro y slides del carrusel principal.

2. **Instructor (`instructor`):**
   * Panel de control con visualización de clases asignadas y participantes.

3. **Usuario / Cliente (`usuario`):**
   * Consulta y adquisición de planes de membresía.
   * Carga de comprobantes de pago digitales para su validación.
   * Consulta de disponibilidad de clases y reserva/cancelación de cupos.
   * Calificación de clases recibidas e historial de asistencias y pagos.

---

## 🛠️ ¿Qué tecnologías utiliza?

### Backend
* **Lenguaje:** [PHP ^8.1](https://www.php.net/)
* **Framework:** [Laravel 10.x](https://laravel.com)
* **Control de Roles y Permisos:** [Spatie Laravel Permission 6.x](https://spatie.be/docs/laravel-permission)
* **Generación de Reportes PDF:** [Barryvdh Laravel DomPDF 3.x](https://github.com/barryvdh/laravel-dompdf)
* **Componentes Reactivos:** [Livewire 3.x](https://livewire.laravel.com)
* **Autenticación y Seguridad:** Laravel UI / Sanctum

### Frontend
* **Motor de Vistas:** Blade Templating Engine
* **Diseño y Estilos:** Bootstrap 5.3
* **Empaquetador de Módulos:** [Vite 5.x](https://vitejs.dev)
* **Cliente HTTP:** Axios

### Base de Datos
* **Motor:** MySQL 8.0+ / MariaDB 10.x

---

## 💻 ¿Qué se necesita instalar?

Para ejecutar este proyecto en un entorno local se requiere tener instalado:

1. **PHP:** Versión 8.1 o superior con las siguientes extensiones habilitadas:
   * `pdo`, `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `gd` o `imagick`.
2. **Composer:** Gestor de dependencias de PHP (versión 2.x).
3. **Node.js y npm:** Entorno de ejecución JavaScript (Node.js >= 18.x y npm >= 9.x).
4. **Servidor de Base de Datos:** MySQL o MariaDB (a través de entornos como Laragon, XAMPP o MySQL Server independiente).
5. **Git:** Sistema de control de versiones.

---

## 🚀 ¿Cómo se configura e instala?

Sigue estos pasos en tu terminal para configurar el entorno de desarrollo:

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/DanSteven12/ProyectoCybac.git
   cd ProyectoCybac
   ```

2. **Instalar dependencias de Backend (PHP):**
   ```bash
   composer install
   ```

3. **Instalar dependencias de Frontend (Node.js):**
   ```bash
   npm install
   ```

4. **Configurar el archivo de variables de entorno:**
   * Copiar la plantilla `.env.example` para crear el archivo `.env`:
     ```bash
     cp .env.example .env
     ```
   * Abrir `.env` y configurar las credenciales de tu base de datos:
     ```dotenv
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=proyecto
     DB_USERNAME=root
     DB_PASSWORD=tu_contraseña
     ```

5. **Generar la clave de seguridad de la aplicación:**
   ```bash
   php artisan key:generate
   ```

6. **Ejecutar las migraciones y seeders:**
   *(Crea las tablas en la base de datos e inserta los roles y estados iniciales)*
   ```bash
   php artisan migrate --seed
   ```

7. **Crear el enlace simbólico de almacenamiento:**
   *(Permite el acceso público a imágenes y comprobantes de pago)*
   ```bash
   php artisan storage:link
   ```

---

## ▶️ ¿Cómo ejecutar el proyecto?

Para iniciar la aplicación en desarrollo, ejecuta simultáneamente:

1. **Servidor backend de Laravel:**
   ```bash
   php artisan serve
   ```
   *Acceso web por defecto:* `http://127.0.0.1:8000`

2. **Servidor de compilación en tiempo real de Vite:**
   ```bash
   npm run dev
   ```

*Para compilar los assets de producción de manera estática:*
```bash
npm run build
```

---

## 📂 Estructura General del Proyecto

```text
ProyectoCybac/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/             # Controladores del panel de administración (clases, membresías, pagos, servicios, usuarios, CMS)
│   │   ├── Auth/              # Controladores de recuperación y restablecimiento de contraseña
│   │   ├── User/              # Controladores de clientes (dashboard, clases, membresías, historial de pagos)
│   │   ├── AdminController.php
│   │   ├── InstructorController.php
│   │   ├── LoginController.php
│   │   └── RegisterController.php
│   └── Models/                # Modelos Eloquent (User, Role, Membership, Service, Classes, Payment, Registration, etc.)
├── database/
│   ├── migrations/            # Migraciones del esquema de base de datos
│   └── seeders/               # Seeders de roles, estados y datos iniciales
├── public/                    # Punto de entrada público (index.php) y assets estáticos
├── resources/
│   ├── css/                   # Estilos CSS
│   ├── js/                    # Scripts JS
│   └── views/                 # Vistas Blade organizadas por roles (admin, user, instructor, auth, layouts)
├── routes/
│   ├── web.php                # Rutas web del sistema con middlewares de rol y autenticación
│   └── api.php                # Endpoints API (Sanctum)
├── storage/                   # Logs, caché del framework y comprobantes/archivos subidos
└── .env.example               # Plantilla de variables de entorno
```

---

## 🌿 Información de Git y Control de Versiones

* **Ramas principales del repositorio:**
  * `main`: Rama de producción y versión estable del proyecto.
  * `servicios`: Rama para el desarrollo del módulo de servicios.
  * `docs/configuracion-repositorio`: Rama de trabajo para estandarización de configuración, gitignore y documentación.
* **Buenas prácticas:**
  * Nunca incluir el archivo `.env` en los commits.
  * Mantener los archivos de compilación (`public/build`) y dependencias (`vendor/`, `node_modules/`) ignorados en Git.
  * Crear ramas descriptivas para nuevas funcionalidades o correcciones (`feature/...`, `fix/...`, `docs/...`).

---

## 📄 Licencia

Este proyecto está desarrollado sobre el framework Laravel y se distribuye bajo la licencia [MIT](https://opensource.org/licenses/MIT).



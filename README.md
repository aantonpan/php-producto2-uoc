# Proyecto PHP Producto 2 - UOC

Este proyecto es parte del módulo de PHP en la UOC. Desarrollado sin frameworks, está basado en una arquitectura **MVC propia** y preparado para ser migrado posteriormente a **Laravel (Producto 3)**.

## Tecnologías utilizadas

- Docker con Apache, MySQL y PHPMyAdmin
- PHP 8+
- MySQL
- HTML, CSS y JavaScript
- Arquitectura MVC sin framework

---

## Cómo arrancar el proyecto

- Desde **Docker Desktop** instalado. Luego, en la terminal ubicada en la raíz del proyecto, ejecuta:
        docker compose up -d --build
- Se incluye el archivo producto2db.sql en la raíz del repositorio. Puedes importarlo desde PHPMyAdmin accediendo a:
        http://localhost:8084/

        user: phpower2
        password: phpower2

    Crear base de datos producto2db
    Ir a la pestaña Importar y subir el archivo producto2db.sql



## Estructura del proyecto 

C:.
│   .gitignore
│   docker-compose.yml
│   Dockerfile
│   estructura.txt
│   producto2db.sql
│   README.md
│   
└───src
    └───producto2-app
        ├───app
        │   ├───controllers
        │   │       AuthController.php
        │   │       DashboardAdminController.php
        │   │       DashboardClienteController.php
        │   │       DashboardController.php
        │   │       HomeController.php
        │   │       HotelAdminController.php
        │   │       HotelController.php
        │   │       PerfilAdminController.php
        │   │       PerfilController.php
        │   │       PrecioAdminController.php
        │   │       ReservaAdminController.php
        │   │       ReservaController.php
        │   │       TipoReservaAdminController.php
        │   │       UsuarioAdminController.php
        │   │       VehiculoAdminController.php
        │   │       VehiculoController.php
        │   │       ZonaAdminController.php
        │   │       
        │   ├───core
        │   │       db.php
        │   │       router.php
        │   │       
        │   ├───models
        │   │       Evento.php
        │   │       
        │   └───views
        │       │   layout.php
        │       │   
        │       ├───admin
        │       │   │   layout.php
        │       │   │   
        │       │   ├───hotel
        │       │   │       create.php
        │       │   │       edit.php
        │       │   │       index.php
        │       │   │       _form_fields.php
        │       │   │       
        │       │   ├───perfil
        │       │   │       index.php
        │       │   │       
        │       │   ├───precio
        │       │   │       create.php
        │       │   │       edit.php
        │       │   │       index.php
        │       │   │       _form_fields.php
        │       │   │       
        │       │   ├───reserva
        │       │   │       create.php
        │       │   │       edit.php
        │       │   │       index.php
        │       │   │       show.php
        │       │   │       _form_fields.php
        │       │   │       
        │       │   ├───tiporeserva
        │       │   │       create.php
        │       │   │       edit.php
        │       │   │       index.php
        │       │   │       
        │       │   ├───usuario
        │       │   │       create.php
        │       │   │       edit.php
        │       │   │       index.php
        │       │   │       _form_fields.php
        │       │   │       
        │       │   ├───vehiculo
        │       │   │       create.php
        │       │   │       edit.php
        │       │   │       index.php
        │       │   │       _form_fields.php
        │       │   │       
        │       │   └───zona
        │       │           create.php
        │       │           edit.php
        │       │           index.php
        │       │           _form_fields.php
        │       │           
        │       ├───auth
        │       │       login.php
        │       │       register.php
        │       │       
        │       ├───dashboard
        │       │       admin.php
        │       │       cliente.php
        │       │       hotel.php
        │       │       vehiculo.php
        │       │       
        │       ├───home
        │       │       index.php
        │       │       
        │       ├───hotel
        │       │       index.php
        │       │       
        │       ├───perfil
        │       │       index.php
        │       │       
        │       ├───reserva
        │       │       create.php
        │       │       edit.php
        │       │       index.php
        │       │       _form_fields.php
        │       │       
        │       ├───vehiculo
        │       │       index.php
        │       │       
        │       └───zona
        │               index.php
        │               
        ├───html
        └───public
            │   index.php
            │   
            ├───css
            │       style.css
            │       
            ├───img
            │       banner-home.png
            │       banner-login-registro.png
            │       
            ├───js
            │       script.js
            │       
            └───uploads
                └───perfiles
                        perfil_1744745235_CAT-min.png
                        perfil_1744745248_CAT-min.png
                        perfil_1744745447_CAT-min.png
                        perfil_1744746319_curry.png
                        perfil_1744749284_hauser.png
                        perfil_1744824048_doncic.png
                        perfil_1745164593_2025 Tarjetes presentació organizers.png
                        perfil_1745164623_1630596.png
                        

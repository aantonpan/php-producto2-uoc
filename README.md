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

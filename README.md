# Proyecto PHP Producto 2 - UOC

Este proyecto es parte del módulo de PHP en la UOC. Incluye:

- Docker con Apache, MySQL y PHPMyAdmin
- Arquitectura MVC sin framework
- Preparado para Laravel (Producto 3)

## Cómo arrancar

```bash
docker compose up -d --build


## Views

- Home: http://localhost:8083/?r=home/index
- LogIn Particular: http://localhost:8083/?r=auth/login&type=particular
- Login Administrador: http://localhost:8083/?r=auth/login&type=admin
- Dashboard Cliente: http://localhost:8083/?r=dashboard/cliente

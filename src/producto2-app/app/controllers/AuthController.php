<?php
class AuthController {

    public function login() {
        $contenido = __DIR__ . '/../views/auth/login.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function register() {
        $contenido = __DIR__ . '/../views/auth/register.php';
        include __DIR__ . '/../views/layout.php';
    }

}

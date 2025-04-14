<?php
class PerfilController {

    public function index() {
        $contenido = __DIR__ . '/../views/perfil/index.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function edit() {
        $contenido = __DIR__ . '/../views/perfil/edit.php';
        include __DIR__ . '/../views/layout.php';
    }

}

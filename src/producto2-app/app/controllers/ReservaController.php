<?php
class ReservaController {

    public function index() {
        $contenido = __DIR__ . '/../views/reserva/index.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function create() {
        $contenido = __DIR__ . '/../views/reserva/create.php';
        include __DIR__ . '/../views/layout.php';
    }

}

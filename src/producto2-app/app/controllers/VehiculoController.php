<?php
class VehiculoController {

    public function index() {
        $contenido = __DIR__ . '/../views/vehiculo/index.php';
        include __DIR__ . '/../views/layout.php';
    }

}

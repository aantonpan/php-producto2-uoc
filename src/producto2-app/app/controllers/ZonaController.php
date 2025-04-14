<?php
class ZonaController {

    public function index() {
        $contenido = __DIR__ . '/../views/zona/index.php';
        include __DIR__ . '/../views/layout.php';
    }

}

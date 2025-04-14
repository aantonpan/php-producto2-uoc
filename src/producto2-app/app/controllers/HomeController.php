<?php
class HomeController {

    public function index() {
        $contenido = __DIR__ . '/../views/home/index.php';
        include __DIR__ . '/../views/layout.php';
    }

}

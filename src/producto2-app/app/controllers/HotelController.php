<?php
class HotelController {

    public function index() {
        $contenido = __DIR__ . '/../views/hotel/index.php';
        include __DIR__ . '/../views/layout.php';
    }

}

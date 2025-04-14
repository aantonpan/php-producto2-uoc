<?php
require_once __DIR__ . '/../models/Evento.php';

class EventoController {
    public function index() {
        $eventos = Evento::all();
        $contenido = __DIR__ . '/../views/eventos/index.php';
        include __DIR__ . '/../views/layout.php';
    }
}

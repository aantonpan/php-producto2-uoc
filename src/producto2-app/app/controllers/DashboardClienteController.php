<?php

class DashboardClienteController
{
    public function index()
    {
        $contenido = __DIR__ . '/../views/dashboard/cliente.php';
        include __DIR__ . '/../views/layout.php';
    }
}

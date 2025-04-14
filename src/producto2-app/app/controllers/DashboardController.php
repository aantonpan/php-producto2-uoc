<?php

class DashboardController
{
    public function cliente()
    {
        $contenido = __DIR__ . '/../views/dashboard/cliente.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function hotel()
    {
        $contenido = __DIR__ . '/../views/dashboard/hotel.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function vehiculo()
    {
        $contenido = __DIR__ . '/../views/dashboard/vehiculo.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function admin()
    {
        $contenido = __DIR__ . '/../views/dashboard/admin.php';
        include __DIR__ . '/../views/layout.php';
    }
}

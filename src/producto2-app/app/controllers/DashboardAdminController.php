<?php

class DashboardAdminController
{
    public function index()
    {
        $contenido = __DIR__ . '/../views/dashboard/admin.php';
        include __DIR__ . '/../views/admin/layout.php';
    }
}

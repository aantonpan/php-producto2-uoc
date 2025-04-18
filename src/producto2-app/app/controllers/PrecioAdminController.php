<?php

class PrecioAdminController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->query("
            SELECT p.*, v.descripcion AS vehiculo, h.nombre AS hotel
            FROM transfer_precios p
            LEFT JOIN transfer_vehiculo v ON p.id_vehiculo = v.id_vehiculo
            LEFT JOIN transfer_hotel h ON p.id_hotel = h.id_hotel
        ");
        $precios = $stmt->fetchAll();

        $contenido = __DIR__ . '/../views/admin/precio/index.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $vehiculos = $db->query("SELECT * FROM transfer_vehiculo")->fetchAll();
        $hoteles = $db->query("SELECT * FROM transfer_hotel")->fetchAll();
        $precio = [];

        $contenido = __DIR__ . '/../views/admin/precio/create.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function store()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->prepare("INSERT INTO transfer_precios (id_vehiculo, id_hotel, precio) VALUES (?, ?, ?)");
        $stmt->execute([$_POST['id_vehiculo'], $_POST['id_hotel'], $_POST['precio']]);

        header("Location: ?r=precioadmin/index");
        exit;
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'];
        $stmt = $db->prepare("SELECT * FROM transfer_precios WHERE id_precio = ?");
        $stmt->execute([$id]);
        $precio = $stmt->fetch();

        $vehiculos = $db->query("SELECT * FROM transfer_vehiculo")->fetchAll();
        $hoteles = $db->query("SELECT * FROM transfer_hotel")->fetchAll();

        $contenido = __DIR__ . '/../views/admin/precio/edit.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function update()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->prepare("UPDATE transfer_precios SET id_vehiculo = ?, id_hotel = ?, precio = ? WHERE id_precio = ?");
        $stmt->execute([
            $_POST['id_vehiculo'],
            $_POST['id_hotel'],
            $_POST['precio'],
            $_GET['id']
        ]);

        header("Location: ?r=precioadmin/index");
        exit;
    }

    public function delete()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->prepare("DELETE FROM transfer_precios WHERE id_precio = ?");
        $stmt->execute([$_GET['id']]);

        header("Location: ?r=precioadmin/index");
        exit;
    }
}

<?php

class VehiculoAdminController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $vehiculos = $db->query("SELECT * FROM transfer_vehiculo ORDER BY id_vehiculo DESC")->fetchAll();
        $contenido = __DIR__ . '/../views/admin/vehiculo/index.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function create()
    {
        $vehiculo = [];
        $contenido = __DIR__ . '/../views/admin/vehiculo/create.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function store()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $descripcion = $_POST['descripcion'];

        $stmt = $db->prepare("INSERT INTO transfer_vehiculo (descripcion) VALUES (?)");
        $stmt->execute([$descripcion]);

        header("Location: ?r=vehiculoadmin/index");
        exit;
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'];
        $stmt = $db->prepare("SELECT * FROM transfer_vehiculo WHERE id_vehiculo = ?");
        $stmt->execute([$id]);
        $vehiculo = $stmt->fetch();

        $contenido = __DIR__ . '/../views/admin/vehiculo/edit.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function update()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'];
        $descripcion = $_POST['descripcion'];

        $stmt = $db->prepare("UPDATE transfer_vehiculo SET descripcion = ? WHERE id_vehiculo = ?");
        $stmt->execute([$descripcion, $id]);

        header("Location: ?r=vehiculoadmin/index");
        exit;
    }

    public function delete()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'];
        $stmt = $db->prepare("DELETE FROM transfer_vehiculo WHERE id_vehiculo = ?");
        $stmt->execute([$id]);

        header("Location: ?r=vehiculoadmin/index");
        exit;
    }
}

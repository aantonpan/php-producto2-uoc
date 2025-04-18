<?php

class ZonaAdminController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $zonas = $db->query("SELECT * FROM transfer_zona ORDER BY id_zona DESC")->fetchAll();

        $contenido = __DIR__ . '/../views/admin/zona/index.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function create()
    {
        $zona = [];
        $contenido = __DIR__ . '/../views/admin/zona/create.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function store()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $descripcion = $_POST['descripcion'];

        $stmt = $db->prepare("INSERT INTO transfer_zona (descripcion) VALUES (?)");
        $stmt->execute([$descripcion]);

        header("Location: ?r=zonaadmin/index");
        exit;
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'];
        $stmt = $db->prepare("SELECT * FROM transfer_zona WHERE id_zona = ?");
        $stmt->execute([$id]);
        $zona = $stmt->fetch();

        $contenido = __DIR__ . '/../views/admin/zona/edit.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function update()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'];
        $descripcion = $_POST['descripcion'];

        $stmt = $db->prepare("UPDATE transfer_zona SET descripcion = ? WHERE id_zona = ?");
        $stmt->execute([$descripcion, $id]);

        header("Location: ?r=zonaadmin/index");
        exit;
    }

    public function delete()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'];
        $stmt = $db->prepare("DELETE FROM transfer_zona WHERE id_zona = ?");
        $stmt->execute([$id]);

        header("Location: ?r=zonaadmin/index");
        exit;
    }
}

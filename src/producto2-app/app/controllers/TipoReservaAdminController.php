<?php

class TipoReservaAdminController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $tipos = $db->query("SELECT * FROM transfer_tipo_reserva ORDER BY id_tipo_reserva DESC")->fetchAll();
        $contenido = __DIR__ . '/../views/admin/tiporeserva/index.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function create()
    {
        $tipo = [];
        $contenido = __DIR__ . '/../views/admin/tiporeserva/create.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function store()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->prepare("INSERT INTO transfer_tipo_reserva (descripcion) VALUES (?)");
        $stmt->execute([$_POST['descripcion']]);

        header("Location: ?r=tiporeservaadmin/index");
        exit;
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->prepare("SELECT * FROM transfer_tipo_reserva WHERE id_tipo_reserva = ?");
        $stmt->execute([$_GET['id']]);
        $tipo = $stmt->fetch();

        $contenido = __DIR__ . '/../views/admin/tiporeserva/edit.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function update()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->prepare("UPDATE transfer_tipo_reserva SET descripcion = ? WHERE id_tipo_reserva = ?");
        $stmt->execute([$_POST['descripcion'], $_GET['id']]);

        header("Location: ?r=tiporeservaadmin/index");
        exit;
    }

    public function delete()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->prepare("DELETE FROM transfer_tipo_reserva WHERE id_tipo_reserva = ?");
        $stmt->execute([$_GET['id']]);

        header("Location: ?r=tiporeservaadmin/index");
        exit;
    }
}

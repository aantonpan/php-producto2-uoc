<?php

class HotelAdminController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        // Obtener hoteles con descripción de la zona
        $stmt = $db->query("
            SELECT 
                h.*, 
                z.descripcion AS nombre_zona 
            FROM transfer_hotel h
            LEFT JOIN transfer_zona z ON h.id_zona = z.id_zona
        ");

        $hoteles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contenido = __DIR__ . '/../views/admin/hotel/index.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $zonas = $db->query("SELECT * FROM transfer_zona")->fetchAll(PDO::FETCH_ASSOC);
        $hotel = [];

        $contenido = __DIR__ . '/../views/admin/hotel/create.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function store()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->prepare("INSERT INTO transfer_hotel 
            (id_zona, Comision, usuario, password, nombre, direccion) 
            VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $_POST['id_zona'],
            $_POST['Comision'],
            $_POST['usuario'],
            $_POST['password'],
            $_POST['nombre'],
            $_POST['direccion']
        ]);

        header("Location: ?r=hoteladmin/index");
        exit;
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID no proporcionado.";
            return;
        }

        $stmt = $db->prepare("SELECT * FROM transfer_hotel WHERE id_hotel = ?");
        $stmt->execute([$id]);
        $hotel = $stmt->fetch(PDO::FETCH_ASSOC);

        $zonas = $db->query("SELECT * FROM transfer_zona")->fetchAll(PDO::FETCH_ASSOC);

        $contenido = __DIR__ . '/../views/admin/hotel/edit.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function update()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID no válido.";
            return;
        }

        $id_zona = $_POST['id_zona'] ?? null;
        $comision = $_POST['Comision'] ?? null;
        $nombre = $_POST['nombre'] ?? null;
        $direccion = $_POST['direccion'] ?? null;

        if (!$id_zona || !$comision || !$nombre || !$direccion) {
            echo "Todos los campos son obligatorios.";
            return;
        }

        $stmt = $db->prepare("UPDATE transfer_hotel SET 
            id_zona = ?, Comision = ?, nombre = ?, direccion = ?
            WHERE id_hotel = ?");

        $stmt->execute([
            $id_zona,
            $comision,
            $nombre,
            $direccion,
            $id
        ]);

        header("Location: ?r=hoteladmin/index");
        exit;
    }


    public function delete()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID no válido.";
            return;
        }

        $stmt = $db->prepare("DELETE FROM transfer_hotel WHERE id_hotel = ?");
        $stmt->execute([$id]);

        header("Location: ?r=hoteladmin/index");
        exit;
    }
}

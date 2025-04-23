<?php
// HotelAdminController.php

class HotelAdminController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        // Obtenemos hoteles con su zona
        $stmt = $db->query("
            SELECT
                h.*,
                z.descripcion AS nombre_zona
            FROM transfer_hotel h
            LEFT JOIN transfer_zona z ON h.id_zona = z.id_zona
            ORDER BY h.id_hotel DESC
        ");
        $hoteles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Renderizamos la vista
        $contenido = __DIR__ . '/../views/admin/hotel/index.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        // Sólo necesitamos las zonas para el selector
        $zonas = $db
            ->query("SELECT id_zona, descripcion FROM transfer_zona ORDER BY descripcion")
            ->fetchAll(PDO::FETCH_ASSOC);

        // Hotel vacío para el formulario
        $hotel = [];

        // Renderizamos la vista
        $contenido = __DIR__ . '/../views/admin/hotel/create.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function store()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        // Capturamos sólo los campos que importan
        $id_zona   = trim($_POST['id_zona']   ?? '');
        $comision  = trim($_POST['Comision']  ?? '');
        $nombre    = trim($_POST['nombre']    ?? '');
        $direccion = trim($_POST['direccion'] ?? '');

        // Validación: todos obligatorios
        if ($id_zona === '' || $comision === '' || $nombre === '' || $direccion === '') {
            header("Location: ?r=hoteladmin/create&error=empty");
            exit;
        }

        // Insertar
        $stmt = $db->prepare("
            INSERT INTO transfer_hotel
              (id_zona, Comision, nombre, direccion)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([
            $id_zona,
            $comision,
            $nombre,
            $direccion
        ]);

        // Redirigir con alerta de éxito
        header("Location: ?r=hoteladmin/index&success=created");
        exit;
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID no válido.";
            return;
        }

        // Cargamos los datos del hotel
        $stmt = $db->prepare("SELECT * FROM transfer_hotel WHERE id_hotel = ?");
        $stmt->execute([$id]);
        $hotel = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$hotel) {
            echo "Hotel no encontrado.";
            return;
        }

        // Zonas para el selector
        $zonas = $db
            ->query("SELECT id_zona, descripcion FROM transfer_zona ORDER BY descripcion")
            ->fetchAll(PDO::FETCH_ASSOC);

        // Renderizamos la vista
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

        // Capturamos los campos
        $id_zona   = trim($_POST['id_zona']   ?? '');
        $comision  = trim($_POST['Comision']  ?? '');
        $nombre    = trim($_POST['nombre']    ?? '');
        $direccion = trim($_POST['direccion'] ?? '');

        // Validación
        if ($id_zona === '' || $comision === '' || $nombre === '' || $direccion === '') {
            header("Location: ?r=hoteladmin/edit&id={$id}&error=empty");
            exit;
        }

        // Actualizar
        $stmt = $db->prepare("
            UPDATE transfer_hotel SET
              id_zona   = ?,
              Comision  = ?,
              nombre    = ?,
              direccion = ?
            WHERE id_hotel = ?
        ");
        $stmt->execute([
            $id_zona,
            $comision,
            $nombre,
            $direccion,
            $id
        ]);

        // Redirigir con alerta de éxito
        header("Location: ?r=hoteladmin/index&success=updated");
        exit;
    }

    public function delete()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if ($id) {
            $stmt = $db->prepare("DELETE FROM transfer_hotel WHERE id_hotel = ?");
            $stmt->execute([$id]);
        }

        // Alerta de eliminación
        header("Location: ?r=hoteladmin/index&success=deleted");
        exit;
    }
}
?>

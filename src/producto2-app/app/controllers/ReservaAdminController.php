<?php
// ReservaAdminController.php

// NOTIFICACIÓN GLOBAL DE CAMBIOS DE RESERVAS
function notificarCambioReserva(PDO $db, int $usuario_id, string $mensaje): void {
    $stmt = $db->prepare("INSERT INTO transfer_notificaciones (id_usuario, mensaje) VALUES (?, ?)");
    $stmt->execute([$usuario_id, $mensaje]);
}

class ReservaAdminController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->query("
            SELECT 
                r.*,
                -- nombre + apellido actualizado o fallback a username
                COALESCE(vj.nombre, u.username)   AS nombre_usuario,
                COALESCE(vj.apellido1, '')       AS apellido_usuario,
                u.email,
                h.nombre                         AS nombre_hotel,
                z.descripcion                    AS nombre_destino,
                v.descripcion                    AS nombre_vehiculo,
                p.descripcion                    AS tipo_reserva
            FROM transfer_reservas r
            LEFT JOIN usuarios u      ON r.id_cliente    = u.id
            LEFT JOIN transfer_viajeros vj ON u.id = vj.id_usuario
            LEFT JOIN transfer_hotel h ON r.id_hotel      = h.id_hotel
            LEFT JOIN transfer_zona z ON r.id_destino     = z.id_zona
            LEFT JOIN transfer_vehiculo v ON r.id_vehiculo= v.id_vehiculo
            LEFT JOIN transfer_tipo_reserva p ON r.id_tipo_reserva = p.id_tipo_reserva
            ORDER BY r.fecha_entrada DESC
        ");
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contenido = __DIR__ . '/../views/admin/reserva/index.php';
        include __DIR__ . '/../views/admin/layout.php';
    }


    // ReservaAdminController.php

    public function create()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        // formulario vacío
        $reserva = [];

        // usuarios con nombre+apellido actualizados desde transfer_viajeros
        $usuarios = $db->query("
            SELECT 
                u.id, 
                u.email,
                COALESCE(vj.nombre, u.username)   AS nombre,
                COALESCE(vj.apellido1, '')        AS apellido1
            FROM usuarios u
            LEFT JOIN transfer_viajeros vj 
                ON u.id = vj.id_usuario
            ORDER BY nombre
        ")->fetchAll(PDO::FETCH_ASSOC);

        // demás catálogos
        $hoteles   = $db->query("SELECT id_hotel, nombre FROM transfer_hotel ORDER BY nombre")->fetchAll(PDO::FETCH_ASSOC);
        $destinos  = $db->query("SELECT id_zona, descripcion FROM transfer_zona ORDER BY descripcion")->fetchAll(PDO::FETCH_ASSOC);
        $vehiculos = $db->query("SELECT id_vehiculo, descripcion FROM transfer_vehiculo ORDER BY descripcion")->fetchAll(PDO::FETCH_ASSOC);
        $tipos     = $db->query("SELECT id_tipo_reserva, descripcion FROM transfer_tipo_reserva ORDER BY descripcion")->fetchAll(PDO::FETCH_ASSOC);

        // render de la vista
        $contenido = __DIR__ . '/../views/admin/reserva/create.php';
        include __DIR__ . '/../views/admin/layout.php';
    }


    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID de reserva no proporcionado.";
            return;
        }

        // carga de la reserva existente
        $stmt    = $db->prepare("SELECT * FROM transfer_reservas WHERE id_reserva = ?");
        $stmt->execute([$id]);
        $reserva = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$reserva) {
            echo "Reserva no encontrada.";
            return;
        }

        // usuarios con nombre+apellido actualizados
        $usuarios = $db->query("
            SELECT 
                u.id, 
                u.email,
                COALESCE(vj.nombre, u.username)   AS nombre,
                COALESCE(vj.apellido1, '')        AS apellido1
            FROM usuarios u
            LEFT JOIN transfer_viajeros vj 
                ON u.id = vj.id_usuario
            ORDER BY nombre
        ")->fetchAll(PDO::FETCH_ASSOC);

        // demás catálogos
        $hoteles   = $db->query("SELECT id_hotel, nombre FROM transfer_hotel ORDER BY nombre")->fetchAll(PDO::FETCH_ASSOC);
        $destinos  = $db->query("SELECT id_zona, descripcion FROM transfer_zona ORDER BY descripcion")->fetchAll(PDO::FETCH_ASSOC);
        $vehiculos = $db->query("SELECT id_vehiculo, descripcion FROM transfer_vehiculo ORDER BY descripcion")->fetchAll(PDO::FETCH_ASSOC);
        $tipos     = $db->query("SELECT id_tipo_reserva, descripcion FROM transfer_tipo_reserva ORDER BY descripcion")->fetchAll(PDO::FETCH_ASSOC);

        // render de la vista
        $contenido = __DIR__ . '/../views/admin/reserva/edit.php';
        include __DIR__ . '/../views/admin/layout.php';
    }


    public function store()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $localizador = strtoupper(uniqid('LOC'));
        $fecha_reserva = date('Y-m-d H:i:s');

        $stmt = $db->prepare("INSERT INTO transfer_reservas (
            localizador,
            id_hotel,
            id_tipo_reserva,
            id_cliente,
            fecha_reserva,
            id_destino,
            fecha_entrada,
            hora_entrada,
            numero_vuelo_entrada,
            origen_vuelo_entrada,
            hora_vuelo_salida,
            fecha_vuelo_salida,
            num_viajeros,
            id_vehiculo
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $localizador,
            $_POST['id_hotel'],
            $_POST['id_tipo_reserva'],
            $_POST['id_cliente'],
            $fecha_reserva,
            $_POST['id_destino'],
            $_POST['fecha_entrada'],
            $_POST['hora_entrada'],
            $_POST['numero_vuelo_entrada'],
            $_POST['origen_vuelo_entrada'],
            $_POST['hora_vuelo_salida']  ?? null,
            $_POST['fecha_vuelo_salida'] ?? null,
            $_POST['num_viajeros'],
            $_POST['id_vehiculo']
        ]);

        notificarCambioReserva(
            $db,
            $_POST['id_cliente'],
            "Un administrador ha creado una nueva reserva para ti con localizador $localizador."
        );

        header("Location: ?r=reservaadmin/index");
        exit;
    }

    public function update()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID de reserva no válido.";
            return;
        }

        // Capturamos el localizador para notificación
        $stmt = $db->prepare("SELECT localizador FROM transfer_reservas WHERE id_reserva = ?");
        $stmt->execute([$id]);
        $ant = $stmt->fetch(PDO::FETCH_ASSOC);

        $fecha_mod = date('Y-m-d');

        $stmt = $db->prepare("UPDATE transfer_reservas SET
            id_hotel            = ?,
            id_tipo_reserva     = ?,
            id_cliente          = ?,
            fecha_modificacion  = ?,
            id_destino          = ?,
            fecha_entrada       = ?,
            hora_entrada        = ?,
            numero_vuelo_entrada = ?,
            origen_vuelo_entrada = ?,
            hora_vuelo_salida   = ?,
            fecha_vuelo_salida  = ?,
            num_viajeros        = ?,
            id_vehiculo         = ?
            WHERE id_reserva = ?");

        $stmt->execute([
            $_POST['id_hotel'],
            $_POST['id_tipo_reserva'],
            $_POST['id_cliente'],
            $fecha_mod,
            $_POST['id_destino'],
            $_POST['fecha_entrada'],
            $_POST['hora_entrada'],
            $_POST['numero_vuelo_entrada'],
            $_POST['origen_vuelo_entrada'],
            $_POST['hora_vuelo_salida']  ?? null,
            $_POST['fecha_vuelo_salida'] ?? null,
            $_POST['num_viajeros'],
            $_POST['id_vehiculo'],
            $id
        ]);

        notificarCambioReserva(
            $db,
            $_POST['id_cliente'],
            "Un administrador ha modificado tu reserva con localizador {$ant['localizador']}."
        );

        header("Location: ?r=reservaadmin/index");
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

        $stmt = $db->prepare("SELECT id_cliente, localizador FROM transfer_reservas WHERE id_reserva = ?");
        $stmt->execute([$id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res) {
            notificarCambioReserva(
                $db,
                $res['id_cliente'],
                "Un administrador ha eliminado tu reserva con localizador {$res['localizador']}."
            );
        }

        $stmt = $db->prepare("DELETE FROM transfer_reservas WHERE id_reserva = ?");
        $stmt->execute([$id]);

        header("Location: ?r=reservaadmin/index");
        exit;
    }
}
?>

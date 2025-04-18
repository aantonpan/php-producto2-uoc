<?php

class ReservaController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario_id = $_SESSION['usuario']['id'];

        $stmt = $db->prepare("
            SELECT r.*, p.Precio, z.descripcion AS nombre_destino
            FROM transfer_reservas r
            LEFT JOIN transfer_precios p 
                ON r.id_vehiculo = p.id_vehiculo AND r.id_destino = p.id_hotel
            LEFT JOIN transfer_zona z
                ON r.id_destino = z.id_zona
            WHERE r.id_cliente = ?
            ORDER BY r.fecha_entrada DESC
        ");
        $stmt->execute([$usuario_id]);
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contenido = __DIR__ . '/../views/reserva/index.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $reserva = [];

        $destinos = $db->query("SELECT id_zona, descripcion FROM transfer_zona")->fetchAll(PDO::FETCH_ASSOC);
        $vehiculos = $db->query("SELECT id_vehiculo, descripcion FROM transfer_vehiculo")->fetchAll(PDO::FETCH_ASSOC);
        $tipos = $db->query("SELECT id_tipo_reserva, descripcion FROM transfer_tipo_reserva")->fetchAll(PDO::FETCH_ASSOC);

        $esModal = isset($_GET['modal']) && $_GET['modal'] == '1';
        $contenido = __DIR__ . '/../views/reserva/create.php';

        if ($esModal) {
            include $contenido;
        } else {
            include __DIR__ . '/../views/layout.php';
        }
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id_reserva = $_GET['id'] ?? null;
        $usuario_id = $_SESSION['usuario']['id'];

        if (!$id_reserva) {
            echo "ID no proporcionado";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fecha = $_POST['fecha_entrada'];
            $hora = $_POST['hora_entrada'];
            $vuelo = $_POST['numero_vuelo_entrada'];
            $origen = $_POST['origen_vuelo_entrada'];
            $fecha_salida = $_POST['fecha_vuelo_salida'] ?? null;
            $hora_salida = $_POST['hora_vuelo_salida'] ?? null;
            $id_destino = $_POST['id_destino'];
            $id_vehiculo = $_POST['id_vehiculo'];
            $num_viajeros = $_POST['num_viajeros'];

            $fechaHoraReserva = new DateTime($fecha . ' ' . $hora);
            $ahora = new DateTime();

            if ($fechaHoraReserva <= $ahora || $ahora->diff($fechaHoraReserva)->days < 2) {
                echo "No puedes modificar reservas con menos de 48h de antelación.";
                return;
            }

            $stmt = $db->prepare("UPDATE transfer_reservas 
                SET fecha_entrada = ?, hora_entrada = ?, numero_vuelo_entrada = ?, origen_vuelo_entrada = ?, 
                    fecha_vuelo_salida = ?, hora_vuelo_salida = ?, id_destino = ?, id_vehiculo = ?, num_viajeros = ?
                WHERE id_reserva = ? AND id_cliente = ?");
            $stmt->execute([
                $fecha, $hora, $vuelo, $origen,
                $fecha_salida, $hora_salida, $id_destino, $id_vehiculo, $num_viajeros,
                $id_reserva, $usuario_id
            ]);

            if (!empty($_GET['modal'])) {
                echo "<script>window.parent.location.href = '?r=reserva/index';</script>";
                exit;
            } else {
                header("Location: ?r=reserva/index");
                exit;
            }
        } else {
            $stmt = $db->prepare("SELECT * FROM transfer_reservas WHERE id_reserva = ? AND id_cliente = ?");
            $stmt->execute([$id_reserva, $usuario_id]);
            $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$reserva) {
                echo "Reserva no encontrada o no te pertenece.";
                return;
            }

            $destinos = $db->query("SELECT id_zona, descripcion FROM transfer_zona")->fetchAll(PDO::FETCH_ASSOC);
            $vehiculos = $db->query("SELECT id_vehiculo, descripcion FROM transfer_vehiculo")->fetchAll(PDO::FETCH_ASSOC);
            $tipos = $db->query("SELECT id_tipo_reserva, descripcion FROM transfer_tipo_reserva")->fetchAll(PDO::FETCH_ASSOC);

            $esModal = isset($_GET['modal']) && $_GET['modal'] == '1';
            $contenido = __DIR__ . '/../views/reserva/edit.php';

            if ($esModal) {
                include $contenido;
            } else {
                include __DIR__ . '/../views/layout.php';
            }
        }
    }

    public function store()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario_id = $_SESSION['usuario']['id'];

        $fecha = $_POST['fecha_entrada'];
        $hora = $_POST['hora_entrada'];
        $vuelo = $_POST['numero_vuelo_entrada'];
        $origen = $_POST['origen_vuelo_entrada'];
        $tipo_reserva = $_POST['id_tipo_reserva'];
        $destino = $_POST['id_destino'];
        $fecha_salida = $_POST['fecha_vuelo_salida'] ?? null;
        $hora_salida = $_POST['hora_vuelo_salida'] ?? null;
        $num_viajeros = $_POST['num_viajeros'];
        $id_vehiculo = $_POST['id_vehiculo'];

        $fecha_reserva = date('Y-m-d H:i:s');
        $localizador = strtoupper(uniqid('LOC'));

        if (empty($fecha) || empty($hora) || empty($vuelo) || empty($origen) ||
            empty($tipo_reserva) || empty($destino) || empty($num_viajeros) || empty($id_vehiculo)) {
            echo "Todos los campos son obligatorios.";
            return;
        }

        $stmt = $db->prepare("INSERT INTO transfer_reservas (
            localizador, id_tipo_reserva, id_cliente, fecha_reserva, id_destino,
            fecha_entrada, hora_entrada, numero_vuelo_entrada, origen_vuelo_entrada,
            fecha_vuelo_salida, hora_vuelo_salida, num_viajeros, id_vehiculo
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $localizador, $tipo_reserva, $usuario_id, $fecha_reserva, $destino,
            $fecha, $hora, $vuelo, $origen,
            $fecha_salida, $hora_salida, $num_viajeros, $id_vehiculo
        ]);

        if (!empty($_GET['modal'])) {
            echo "<script>window.parent.location.href = '?r=reserva/index';</script>";
            exit;
        } else {
            header("Location: ?r=reserva/index");
            exit;
        }
    }

    public function delete()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        if (!isset($_GET['id'])) {
            echo "ID no proporcionado";
            return;
        }

        $id_reserva = $_GET['id'];
        $usuario_id = $_SESSION['usuario']['id'];
        $tipo = $_SESSION['usuario']['tipo'];

        if ($tipo === 'admin' || $tipo === 'hotel') {
            $stmt = $db->prepare("DELETE FROM transfer_reservas WHERE id_reserva = ?");
            $stmt->execute([$id_reserva]);
        } else {
            $stmt = $db->prepare("SELECT fecha_entrada, hora_entrada FROM transfer_reservas WHERE id_reserva = ? AND id_cliente = ?");
            $stmt->execute([$id_reserva, $usuario_id]);
            $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$reserva) {
                echo "Reserva no encontrada o no te pertenece.";
                return;
            }

            $fechaHoraReserva = new DateTime($reserva['fecha_entrada'] . ' ' . $reserva['hora_entrada']);
            $ahora = new DateTime();
            $interval = $ahora->diff($fechaHoraReserva);
            $puedeEliminar = $fechaHoraReserva > $ahora && $interval->days >= 2;

            if (!$puedeEliminar) {
                echo "No puedes eliminar reservas con menos de 48h de antelación.";
                return;
            }

            $stmt = $db->prepare("DELETE FROM transfer_reservas WHERE id_reserva = ?");
            $stmt->execute([$id_reserva]);
        }

        if (!empty($_GET['modal'])) {
            echo "<script>window.parent.location.href = '?r=reserva/index';</script>";
            exit;
        } else {
            header("Location: ?r=reserva/index");
            exit;
        }
    }
}

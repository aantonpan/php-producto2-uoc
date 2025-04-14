<?php

class ReservaController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario_id = $_SESSION['usuario']['id'];

        $stmt = $db->prepare("SELECT * FROM transfer_reservas WHERE id_cliente = ?");
        $stmt->execute([$usuario_id]);
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contenido = __DIR__ . '/../views/reserva/index.php';
        include __DIR__ . '/../views/layout.php';
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
            // Guardar cambios
            $fecha = $_POST['fecha_entrada'];
            $hora = $_POST['hora_entrada'];
            $vuelo = $_POST['numero_vuelo_entrada'];
            $origen = $_POST['origen_vuelo_entrada'];

            // Validar tiempo antes de actualizar
            $fechaHoraReserva = new DateTime($fecha . ' ' . $hora);
            $ahora = new DateTime();

            if ($ahora->diff($fechaHoraReserva)->days < 2 || $fechaHoraReserva <= $ahora) {
                echo "No puedes modificar reservas con menos de 48h de antelación.";
                return;
            }

            $stmt = $db->prepare("UPDATE transfer_reservas SET fecha_entrada = ?, hora_entrada = ?, numero_vuelo_entrada = ?, origen_vuelo_entrada = ? WHERE id_reserva = ? AND id_cliente = ?");
            $stmt->execute([$fecha, $hora, $vuelo, $origen, $id_reserva, $usuario_id]);

            header("Location: ?r=reserva/index");
            exit;
        } else {
            // Mostrar formulario con datos actuales
            $stmt = $db->prepare("SELECT * FROM transfer_reservas WHERE id_reserva = ? AND id_cliente = ?");
            $stmt->execute([$id_reserva, $usuario_id]);
            $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$reserva) {
                echo "Reserva no encontrada o no te pertenece.";
                return;
            }

            $contenido = __DIR__ . '/../views/reserva/edit.php';
            include __DIR__ . '/../views/layout.php';
        }
    }

    public function create()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        // Obtener zonas de destino
        $destinos = $db->query("SELECT id_zona, descripcion FROM transfer_zona")->fetchAll(PDO::FETCH_ASSOC);

        // Obtener vehículos
        $vehiculos = $db->query("SELECT id_vehiculo, descripcion FROM transfer_vehiculo")->fetchAll(PDO::FETCH_ASSOC);

        $contenido = __DIR__ . '/../views/reserva/create.php';
        include __DIR__ . '/../views/layout.php';
    }


    public function store()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario_id = $_SESSION['usuario']['id'];
        $tipo = $_SESSION['usuario']['tipo'];

        // Recogida de datos del formulario
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

        // Validación de campos obligatorios
        if (empty($fecha) || empty($hora) || empty($vuelo) || empty($origen) ||
            empty($tipo_reserva) || empty($destino) || empty($num_viajeros) || empty($id_vehiculo)) {
            echo "Todos los campos son obligatorios.";
            return;
        }

        // Preparar la inserción
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

        header("Location: ?r=reserva/index");
        exit;
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
            // Admin o hotel pueden eliminar directamente
            $stmt = $db->prepare("DELETE FROM transfer_reservas WHERE id_reserva = ?");
            $stmt->execute([$id_reserva]);
        } else {
            // Cliente particular: verificar propiedad y tiempo
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

        header("Location: ?r=reserva/index");
        exit;
}






}

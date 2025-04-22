

<?php
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
                u.username AS nombre_usuario, u.email, 
                z.descripcion AS nombre_destino, 
                v.descripcion AS nombre_vehiculo,
                p.descripcion AS tipo_reserva
            FROM transfer_reservas r
            LEFT JOIN usuarios u ON r.id_cliente = u.id
            LEFT JOIN transfer_zona z ON r.id_destino = z.id_zona
            LEFT JOIN transfer_vehiculo v ON r.id_vehiculo = v.id_vehiculo
            LEFT JOIN transfer_tipo_reserva p ON r.id_tipo_reserva = p.id_tipo_reserva
            ORDER BY r.fecha_entrada DESC
        ");

        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contenido = __DIR__ . '/../views/admin/reserva/index.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $reserva = [];

        $usuarios = $db->query("SELECT id, username, email FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);
        $destinos = $db->query("SELECT * FROM transfer_zona")->fetchAll(PDO::FETCH_ASSOC);
        $vehiculos = $db->query("SELECT * FROM transfer_vehiculo")->fetchAll(PDO::FETCH_ASSOC);
        $tipos = $db->query("SELECT * FROM transfer_tipo_reserva")->fetchAll(PDO::FETCH_ASSOC);

        $contenido = __DIR__ . '/../views/admin/reserva/create.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function store()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $localizador = strtoupper(uniqid('LOC'));
        $fecha_reserva = date('Y-m-d H:i:s');

        $stmt = $db->prepare("INSERT INTO transfer_reservas (
            localizador, id_tipo_reserva, id_cliente, fecha_reserva, id_destino,
            fecha_entrada, hora_entrada, numero_vuelo_entrada, origen_vuelo_entrada,
            fecha_vuelo_salida, hora_vuelo_salida, num_viajeros, id_vehiculo
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $localizador,
            $_POST['id_tipo_reserva'],
            $_POST['id_cliente'],
            $fecha_reserva,
            $_POST['id_destino'],
            $_POST['fecha_entrada'],
            $_POST['hora_entrada'],
            $_POST['numero_vuelo_entrada'],
            $_POST['origen_vuelo_entrada'],
            $_POST['fecha_vuelo_salida'] ?? null,
            $_POST['hora_vuelo_salida'] ?? null,
            $_POST['num_viajeros'],
            $_POST['id_vehiculo']
        ]);

        notificarCambioReserva($db, $_POST['id_cliente'], "Un administrador ha creado una nueva reserva para ti con localizador $localizador.");

        header("Location: ?r=reservaadmin/index");
        exit;
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

        $stmt = $db->prepare("SELECT * FROM transfer_reservas WHERE id_reserva = ?");
        $stmt->execute([$id]);
        $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$reserva) {
            echo "Reserva no encontrada.";
            return;
        }

        $usuarios = $db->query("SELECT id, username, email FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);
        $destinos = $db->query("SELECT * FROM transfer_zona")->fetchAll(PDO::FETCH_ASSOC);
        $vehiculos = $db->query("SELECT * FROM transfer_vehiculo")->fetchAll(PDO::FETCH_ASSOC);
        $tipos = $db->query("SELECT * FROM transfer_tipo_reserva")->fetchAll(PDO::FETCH_ASSOC);

        $contenido = __DIR__ . '/../views/admin/reserva/edit.php';
        include __DIR__ . '/../views/admin/layout.php';
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

        $stmt = $db->prepare("SELECT localizador FROM transfer_reservas WHERE id_reserva = ?");
        $stmt->execute([$id]);
        $reservaAnterior = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $db->prepare("UPDATE transfer_reservas SET 
            id_tipo_reserva = ?, id_cliente = ?, id_destino = ?, fecha_entrada = ?, hora_entrada = ?,
            numero_vuelo_entrada = ?, origen_vuelo_entrada = ?, fecha_vuelo_salida = ?, hora_vuelo_salida = ?,
            num_viajeros = ?, id_vehiculo = ?
            WHERE id_reserva = ?");

        $stmt->execute([
            $_POST['id_tipo_reserva'],
            $_POST['id_cliente'],
            $_POST['id_destino'],
            $_POST['fecha_entrada'],
            $_POST['hora_entrada'],
            $_POST['numero_vuelo_entrada'],
            $_POST['origen_vuelo_entrada'],
            $_POST['fecha_vuelo_salida'] ?? null,
            $_POST['hora_vuelo_salida'] ?? null,
            $_POST['num_viajeros'],
            $_POST['id_vehiculo'],
            $id
        ]);

        notificarCambioReserva($db, $_POST['id_cliente'], "Un administrador ha modificado tu reserva con localizador {$reservaAnterior['localizador']}.");

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
        $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reserva) {
            notificarCambioReserva($db, $reserva['id_cliente'], "Un administrador ha eliminado tu reserva con localizador {$reserva['localizador']}.");
        }

        $stmt = $db->prepare("DELETE FROM transfer_reservas WHERE id_reserva = ?");
        $stmt->execute([$id]);

        header("Location: ?r=reservaadmin/index");
        exit;
    }
}

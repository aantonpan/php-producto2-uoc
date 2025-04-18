<?php

class DashboardClienteController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario_id = $_SESSION['usuario']['id'];

        $stmt = $db->prepare("
            SELECT 
                r.id_reserva, r.localizador, r.fecha_entrada, r.hora_entrada, r.numero_vuelo_entrada, 
                r.origen_vuelo_entrada, r.fecha_vuelo_salida, r.hora_vuelo_salida,
                r.num_viajeros, r.id_vehiculo, r.id_destino,
                v.descripcion AS nombre_vehiculo,
                z.descripcion AS nombre_destino,
                COALESCE(p.Precio, 'N/D') AS precio
            FROM transfer_reservas r
            LEFT JOIN transfer_vehiculo v ON r.id_vehiculo = v.id_vehiculo
            LEFT JOIN transfer_zona z ON r.id_destino = z.id_zona
            LEFT JOIN transfer_precios p ON p.id_vehiculo = r.id_vehiculo AND p.id_hotel = r.id_destino
            WHERE r.id_cliente = ?
        ");

        $stmt->execute([$usuario_id]);
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $eventos = [];

        foreach ($reservas as $reserva) {
            $eventos[] = [
                'title' => 'Reserva ' . $reserva['localizador'],
                'start' => $reserva['fecha_entrada'] . 'T' . $reserva['hora_entrada'],
                'reservaId' => $reserva['id_reserva'],
                'vuelo' => $reserva['numero_vuelo_entrada'],
                'origen' => $reserva['origen_vuelo_entrada'],
                'fechaSalida' => $reserva['fecha_vuelo_salida'],
                'horaSalida' => $reserva['hora_vuelo_salida'],
                'destino' => $reserva['nombre_destino'],
                'vehiculo' => $reserva['nombre_vehiculo'],
                'numViajeros' => $reserva['num_viajeros'],
                'precio' => $reserva['precio']
            ];
        }

        // Aseguramos que el calendario se actualiza SIEMPRE con eventos actualizados
        $GLOBALS['eventos'] = $eventos;

        $contenido = __DIR__ . '/../views/dashboard/cliente.php';
        include __DIR__ . '/../views/layout.php';
    }
}

<?php

class DashboardClienteController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario_id = $_SESSION['usuario']['id'];

        // Traer solo las reservas del usuario logueado
        $stmt = $db->prepare("SELECT id_reserva, fecha_entrada FROM transfer_reservas WHERE id_cliente = ?");
        $stmt->execute([$usuario_id]);
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Formatear para FullCalendar
        $eventos = array_map(function ($reserva) {
            return [
                'title' => 'Reserva #' . $reserva['id_reserva'],
                'start' => $reserva['fecha_entrada']
            ];
        }, $reservas);

        $contenido = __DIR__ . '/../views/dashboard/cliente.php';
        include __DIR__ . '/../views/layout.php';
    }
}

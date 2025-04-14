<?php

class DashboardClienteController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario_id = $_SESSION['usuario']['id'];

        $stmt = $db->prepare("SELECT localizador, fecha_entrada, hora_entrada FROM transfer_reservas WHERE id_cliente = ?");
        $stmt->execute([$usuario_id]);
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $eventos = [];

        foreach ($reservas as $reserva) {
            $eventos[] = [
                'title' => 'Reserva ' . $reserva['localizador'],
                'start' => $reserva['fecha_entrada'] . 'T' . $reserva['hora_entrada']
            ];
        }
        $GLOBALS['eventos'] = $eventos;

        $contenido = __DIR__ . '/../views/dashboard/cliente.php';
        include __DIR__ . '/../views/layout.php';
    }
}

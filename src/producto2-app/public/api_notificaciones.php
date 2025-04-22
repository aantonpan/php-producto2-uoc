<?php
session_start();
require_once __DIR__ . '/../app/core/db.php';
global $db;

header('Content-Type: application/json');

if (!isset($_SESSION['usuario']['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'No autorizado']);
    exit;
}

$idUsuario = $_SESSION['usuario']['id'];

try {
    // Solo las últimas 10 no leídas (puedes quitar el LIMIT si quieres todas)
    $stmt = $db->prepare("SELECT id, mensaje FROM transfer_notificaciones WHERE id_usuario = ? AND leido = 0 ORDER BY creada_en DESC LIMIT 10");
    $stmt->execute([$idUsuario]);
    $notificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'ok',
        'count' => count($notificaciones),
        'notificaciones' => $notificaciones
    ]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error de base de datos']);
}
exit;

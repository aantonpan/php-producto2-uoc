<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../app/core/db.php';
global $db;

if (!isset($_SESSION['usuario']['id']) || !isset($_GET['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'No autorizado']);
    exit;
}

$idUsuario = $_SESSION['usuario']['id'];
$idNotificacion = $_GET['id'];

$stmt = $db->prepare("UPDATE transfer_notificaciones SET leido = 1 WHERE id = ? AND id_usuario = ?");
$success = $stmt->execute([$idNotificacion, $idUsuario]);

if ($success) {
    echo json_encode(['status' => 'ok']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al marcar como leída']);
}
exit;

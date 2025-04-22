<?php
session_start();
require_once __DIR__ . '/core/db.php';
global $db;

if (!isset($_SESSION['usuario']['id']) || !isset($_GET['id'])) {
    http_response_code(403);
    exit;
}

$idUsuario = $_SESSION['usuario']['id'];
$idNotificacion = $_GET['id'];

$stmt = $db->prepare("UPDATE transfer_notificaciones SET leido = 1 WHERE id = ? AND id_usuario = ?");
$stmt->execute([$idNotificacion, $idUsuario]);

header("Location: ?r=reserva/index");
exit;

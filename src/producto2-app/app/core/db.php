<?php
// app/core/db.php
$host = 'mysql_producto2';
$dbname = 'producto2db';
$user = 'phpower2';
$pass = 'phpower2';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

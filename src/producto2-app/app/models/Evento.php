<?php
// app/models/Evento.php

class Evento {
    public static function all() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM transfer_reservas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

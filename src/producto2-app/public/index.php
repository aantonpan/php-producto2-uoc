<?php
session_start();       // Necesario para login y control de acceso
ob_start();            // Evita problemas con headers

require_once __DIR__ . '/../app/core/db.php';
require_once __DIR__ . '/../app/core/router.php';

header("Content-Type: text/html; charset=UTF-8");

ob_end_flush();

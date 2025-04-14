<?php
ob_start(); // 🔄 ¡Nuevo! evita warning de headers

require_once __DIR__ . '/../app/core/db.php';
require_once __DIR__ . '/../app/core/router.php';

header("Content-Type: text/html; charset=UTF-8");

ob_end_flush();
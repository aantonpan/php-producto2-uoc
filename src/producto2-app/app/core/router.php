<?php
// app/core/router.php

$ruta = $_GET['r'] ?? 'home/index';
list($controlador, $accion) = explode('/', $ruta);

// Ruta absoluta al controlador
$archivoControlador = __DIR__ . '/../controllers/' . ucfirst($controlador) . 'Controller.php';

if (file_exists($archivoControlador)) {
    require_once $archivoControlador;
    $clase = ucfirst($controlador) . 'Controller';
    $obj = new $clase();

    if (method_exists($obj, $accion)) {
        $obj->$accion();
    } else {
        echo "Acción '$accion' no encontrada.";
    }
} else {
    echo "Controlador '$controlador' no encontrado.";
}

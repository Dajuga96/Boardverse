<?php
require_once "autoload.php";

$gestor = new GestorPDO();
$controller = new Controller($gestor);

$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'catalogo':
        $controller->catalogo();
        break;
    case 'producto':
        $controller->producto();
        break;
    default:
        $controller->main();
        break;
}
<?php
session_start();
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

    case 'login':
        $controller->login();
        break;

    case 'registro':
        $controller->registro();
        break;

    case 'logout':
        $controller->logout();
        break;

    case 'carrito':
        $controller->carrito();
        break;

    case 'admin':
        $controller->admin();
        break;
       
    case 'agregarCarrito':
    $controller->agregarCarrito();
    break;

    case 'actualizarCarrito':
        $controller->actualizarCarrito();
        break;

    case 'eliminarCarrito':
        $controller->eliminarCarrito();
        break;

    case 'vaciarCarrito':
        $controller->vaciarCarrito();
        break;

    default:
        $controller->main();
         break;
}

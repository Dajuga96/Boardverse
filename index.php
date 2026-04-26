<?php

require_once "autoload.php";

$gestor = new GestorPDO();
$controller = new Controller($gestor);

$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'catalogo':
        //Aquí podrías cargar un controlador específico para el catálogo
        $controller->catalogo();
        break;
    case 'estrategia':
        //Aquí podrías cargar un controlador específico para la estrategia
        $controller->index();
        break;
    case 'familiar':
        //Aquí podrías cargar un controlador específico para la sección familiar
        $controller->index();
        break;
    case 'party':
        //Aquí podrías cargar un controlador específico para la sección party
        $controller->index();
        break;
    default:
        $controller->index();
        break;
}
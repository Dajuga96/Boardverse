<?php
class Controller {
    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function main() {
        include 'views/main.php';
    }

    public function catalogo() {
        $productos = $this->gestor->obtenerProductos();
        include 'views/catalogo.php';
    }
}
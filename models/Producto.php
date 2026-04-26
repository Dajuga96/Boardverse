<?php
class Producto {
    private $id;
    private $nombre;
    private $distribuidora;
    private $categoria;
    private $precio;
    private $precioDescuento;
    private $stock;
    private $descripcion;

    public function __construct($nombre, $distribuidora, $categoria, $precio, $precioDescuento, $stock, $descripcion, $id = null) {
        $this->nombre = $nombre;
        $this->distribuidora = $distribuidora;
        $this->categoria = $categoria;
        $this->precio = $precio;
        $this->precioDescuento = $precioDescuento;
        $this->stock = $stock;
        $this->descripcion = $descripcion;
        $this->id = $id;
    }

    // Getters y setters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDistribuidora() {
        return $this->distribuidora;
    }

    public function setDistribuidora($distribuidora) {
        $this->distribuidora = $distribuidora;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getPrecioDescuento() {
        return $this->precioDescuento;
    }

    public function setPrecioDescuento($precioDescuento) {
        $this->precioDescuento = $precioDescuento;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
}
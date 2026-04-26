<?php
class DetalleVenta {
    private $id;
    private $idVenta;
    private $idProducto;
    private $cantidad;
    private $precioUnitario;

    public function __construct($idVenta, $idProducto, $cantidad, $precioUnitario, $id = null) {
        $this->idVenta = $idVenta;
        $this->idProducto = $idProducto;
        $this->cantidad = $cantidad;
        $this->precioUnitario = $precioUnitario;
        $this->id = $id;
    }

    // Getters y setters
    public function getId() {
        return $this->id;
    }

    public function getIdVenta() {
        return $this->idVenta;
    }

    public function setIdVenta($idVenta) {
        $this->idVenta = $idVenta;
    }

    public function getIdProducto() {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getPrecioUnitario() {
        return $this->precioUnitario;
    }

    public function setPrecioUnitario($precioUnitario) {
        $this->precioUnitario = $precioUnitario;
    }
}
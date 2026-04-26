<?php
class Venta {
    private $id;
    private $idCliente;
    private $fechaVenta;
    private $total;

    public function __construct($idCliente, $fechaVenta, $total, $id = null) {
        $this->idCliente = $idCliente;
        $this->fechaVenta = $fechaVenta;
        $this->total = $total;
        $this->id = $id;
    }

    // Getters y setters
    public function getId() {
        return $this->id;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function getFechaVenta() {
        return $this->fechaVenta;
    }

    public function setFechaVenta($fechaVenta) {
        $this->fechaVenta = $fechaVenta;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }
}
<?php
class Evento {
    private $id;
    private $nombre;
    private $precio;
    private $precioDescuento;
    private $fecha;
    private $plazas;
    private $descripcion;

    public function __construct($nombre, $precio, $precioDescuento, $fecha, $plazas, $descripcion, $id = null) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->precioDescuento = $precioDescuento;
        $this->fecha = $fecha;
        $this->plazas = $plazas;
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

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getPlazas() {
        return $this->plazas;
    }

    public function setPlazas($plazas) {
        $this->plazas = $plazas;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
}
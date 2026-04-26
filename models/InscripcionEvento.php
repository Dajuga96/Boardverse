<?php
class InscripcionEvento {
    private $id;
    private $idCliente;
    private $idEvento;
    private $fechaInscripcion;

    public function __construct($idCliente, $idEvento, $fechaInscripcion, $id = null) {
        $this->idCliente = $idCliente;
        $this->idEvento = $idEvento;
        $this->fechaInscripcion = $fechaInscripcion;
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

    public function getIdEvento() {
        return $this->idEvento;
    }

    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    public function getFechaInscripcion() {
        return $this->fechaInscripcion;
    }

    public function setFechaInscripcion($fechaInscripcion) {
        $this->fechaInscripcion = $fechaInscripcion;
    }
}
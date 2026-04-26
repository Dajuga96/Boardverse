<?php
class Cliente {
    private $id;
    private $nombre;
    private $dni;
    private $telefono;
    private $email;
    private $direccion;

    public function __construct($nombre, $dni, $telefono, $email, $direccion, $id = null) {
        $this->nombre = $nombre;
        $this->dni = $dni;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
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

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getDni() {
        return $this->dni;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
}
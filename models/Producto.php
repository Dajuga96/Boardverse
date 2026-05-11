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
    private $imagen;
    private $numJugadoresMin;
    private $numJugadoresMax;
    private $duracion;
    private $edad;
    private $dificultad;

    public function __construct($nombre, $distribuidora, $categoria, $precio, $precioDescuento, $stock, $descripcion, $imagen, $numJugadoresMin, $numJugadoresMax, $duracion, $edad, $dificultad, $id = null) {
        $this->nombre = $nombre;
        $this->distribuidora = $distribuidora;
        $this->categoria = $categoria;
        $this->precio = $precio;
        $this->precioDescuento = $precioDescuento;
        $this->stock = $stock;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->numJugadoresMin = $numJugadoresMin;
        $this->numJugadoresMax = $numJugadoresMax;
        $this->duracion = $duracion;
        $this->edad = $edad;
        $this->dificultad = $dificultad;
        $this->id = $id;
    }

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function getDistribuidora() { return $this->distribuidora; }
    public function setDistribuidora($distribuidora) { $this->distribuidora = $distribuidora; }
    public function getCategoria() { return $this->categoria; }
    public function setCategoria($categoria) { $this->categoria = $categoria; }
    public function getPrecio() { return $this->precio; }
    public function setPrecio($precio) { $this->precio = $precio; }
    public function getPrecioDescuento() { return $this->precioDescuento; }
    public function setPrecioDescuento($precioDescuento) { $this->precioDescuento = $precioDescuento; }
    public function getStock() { return $this->stock; }
    public function setStock($stock) { $this->stock = $stock; }
    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function getImagen() { return $this->imagen; }
    public function setImagen($imagen) { $this->imagen = $imagen; }
    public function getNumJugadoresMin() { return $this->numJugadoresMin; }
    public function setNumJugadoresMin($n) { $this->numJugadoresMin = $n; }
    public function getNumJugadoresMax() { return $this->numJugadoresMax; }
    public function setNumJugadoresMax($n) { $this->numJugadoresMax = $n; }
    public function getDuracion() { return $this->duracion; }
    public function setDuracion($duracion) { $this->duracion = $duracion; }
    public function getEdad() { return $this->edad; }
    public function setEdad($edad) { $this->edad = $edad; }
    public function getDificultad() { return $this->dificultad; }
    public function setDificultad($dificultad) { $this->dificultad = $dificultad; }
}

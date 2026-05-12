<?php

class Carrito {

    public static function iniciar() {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    public static function agregar($producto, $cantidad) {
        self::iniciar();

        $id = $producto->getId();

        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
        } else {
            $_SESSION['carrito'][$id] = [
                'id' => $producto->getId(),
                'nombre' => $producto->getNombre(),
                'precio' => (float) str_replace(',', '.', $producto->getPrecio()),
                'imagen' => $producto->getImagen(),
                'cantidad' => $cantidad
            ];
        }
    }

    public static function eliminar($id) {
        self::iniciar();
        unset($_SESSION['carrito'][$id]);
    }

    public static function actualizar($id, $cantidad) {
        self::iniciar();

        if ($cantidad <= 0) {
            self::eliminar($id);
        } elseif (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
        }
    }

    public static function obtener() {
        self::iniciar();
        return $_SESSION['carrito'];
    }

    public static function contar() {
        self::iniciar();

        $total = 0;
        foreach ($_SESSION['carrito'] as $item) {
            $total += $item['cantidad'];
        }

        return $total;
    }

    public static function subtotal() {
        self::iniciar();

        $subtotal = 0;
        foreach ($_SESSION['carrito'] as $item) {
            $subtotal += (float) str_replace(',', '.', $item['precio']) * (int) $item['cantidad'];
        }

        return $subtotal;
    }

    public static function vaciar() {
        $_SESSION['carrito'] = [];
    }
}
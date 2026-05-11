<?php

class GestorPDO {
    private $db;

    public function __construct() {
        $this->db = Connection::getInstance()->getConn();
    }

    // ============================================================
    // Helper: crea un objeto Producto desde una fila de la BBDD
    // ============================================================
    private function rowToProducto($row) {
        $precioConComa = str_replace(".", ",", $row['precio']);
        return new Producto(
            $row['nombre'],
            $row['distribuidora'],
            $row['categoria'],
            $precioConComa,
            $row['precio_descuento'],
            $row['stock'],
            $row['descripcion'],
            $row['imagen'] ?? null,
            $row['num_jugadores_min'],
            $row['num_jugadores_max'],
            $row['duracion'],
            $row['edad'],
            $row['dificultad'],
            $row['id_producto']
        );
    }

    // ============================================================
    // Gestión de usuarios
    // ============================================================
    public function registrarUsuario(Usuario $usuario) {
        try {
            $sql = "INSERT INTO Usuario (email, password) VALUES (:email, :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':password', $usuario->getPassword());
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function buscarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM Usuario WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $value = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($value) {
            return new Usuario($value['email'], $value['password'], $value['id']);
        }
        return false;
    }

    public function obtenerUsuarios() {
        $sql = "SELECT * FROM Usuario ORDER BY id";
        $stmt = $this->db->query($sql);
        $arrayUsuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $arrayUsuarios[] = new Usuario($row['email'], $row['password'], $row['id']);
        }
        return $arrayUsuarios;
    }

    // ============================================================
    // Gestión de productos
    // ============================================================
    public function obtenerProductos() {
        $sql = "SELECT * FROM productos ORDER BY id_producto";
        $stmt = $this->db->query($sql);
        $arrayProductos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $arrayProductos[] = $this->rowToProducto($row);
        }
        return $arrayProductos;
    }

    public function buscarProducto($id) {
        $sql = "SELECT * FROM productos WHERE id_producto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $value = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($value) {
            return $this->rowToProducto($value);
        }
        return false;
    }

    // Productos relacionados (mismo género, distinto al actual)
    public function obtenerRelacionados($idActual, $categoria, $limite = 4) {
        $sql = "SELECT * FROM productos
                WHERE id_producto != :id
                  AND categoria = :categoria
                ORDER BY RAND()
                LIMIT $limite";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $idActual);
        $stmt->bindValue(':categoria', $categoria);
        $stmt->execute();
        $arr = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $arr[] = $this->rowToProducto($row);
        }
        // Si no hay suficientes en la misma categoría, completar con otros aleatorios
        if (count($arr) < $limite) {
            $faltan = $limite - count($arr);
            $sql2 = "SELECT * FROM productos
                     WHERE id_producto != :id AND categoria != :categoria
                     ORDER BY RAND()
                     LIMIT $faltan";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->bindValue(':id', $idActual);
            $stmt2->bindValue(':categoria', $categoria);
            $stmt2->execute();
            while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $arr[] = $this->rowToProducto($row);
            }
        }
        return $arr;
    }

    // Catálogo con filtros (todos opcionales)
    public function obtenerProductosFiltrados($filtros = []) {
        $sql = "SELECT * FROM productos WHERE 1=1";
        $params = [];

        if (!empty($filtros['q'])) {
            $sql .= " AND nombre LIKE :q";
            $params[':q'] = '%' . $filtros['q'] . '%';
        }
        if (!empty($filtros['categoria'])) {
            $sql .= " AND categoria = :categoria";
            $params[':categoria'] = $filtros['categoria'];
        }
        if (!empty($filtros['edad'])) {
            $sql .= " AND edad >= :edad";
            $params[':edad'] = (int)$filtros['edad'];
        }
        // Jugadores: el rango del juego debe contener el filtro
        if (!empty($filtros['jugadores'])) {
            switch ($filtros['jugadores']) {
                case '1-2':
                    $sql .= " AND num_jugadores_min <= 2 AND num_jugadores_max >= 1";
                    break;
                case '3-4':
                    $sql .= " AND num_jugadores_min <= 4 AND num_jugadores_max >= 3";
                    break;
                case '5+':
                    $sql .= " AND num_jugadores_max >= 5";
                    break;
            }
        }
        // Duración (en minutos)
        if (!empty($filtros['duracion'])) {
            switch ($filtros['duracion']) {
                case '30':    $sql .= " AND duracion <= 30"; break;
                case '60':    $sql .= " AND duracion > 30 AND duracion <= 60"; break;
                case '120':   $sql .= " AND duracion > 60 AND duracion <= 120"; break;
                case '120+':  $sql .= " AND duracion > 120"; break;
            }
        }
        // Precio máximo
        if (!empty($filtros['precio'])) {
            $sql .= " AND precio <= :precio";
            $params[':precio'] = (float)$filtros['precio'];
        }

        $sql .= " ORDER BY id_producto";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v);
        }
        $stmt->execute();

        $arr = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $arr[] = $this->rowToProducto($row);
        }
        return $arr;
    }
}

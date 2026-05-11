<?php
class Controller {
    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function main() {
        $productos = $this->gestor->obtenerProductos();
        include 'views/main.php';
    }

    public function catalogo() {
        $productos = $this->gestor->obtenerProductos();
        include 'views/catalogo.php';
    }

    public function producto() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?accion=catalogo');
            exit;
        }
        $producto = $this->gestor->buscarProducto($id);
        if (!$producto) {
            header('Location: index.php?accion=catalogo');
            exit;
        }
        $relacionados = $this->gestor->obtenerProductos();
        include 'views/producto.php';
    }

    public function login() {
        $error = null;
        $tabActiva = 'login';

        // Si llega un POST, procesar el login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $error = 'Por favor, rellena email y contraseña.';
            } else {
                $usuario = $this->gestor->buscarUsuarioPorEmail($email);
                if ($usuario && password_verify($password, $usuario->getPassword())) {
                    $_SESSION['usuario'] = $usuario->getEmail();
                    $_SESSION['usuario_id'] = $usuario->getId();
                    header('Location: index.php');
                    exit;
                } else {
                    $error = 'Email o contraseña incorrectos.';
                }
            }
        }

        include 'views/login.php';
    }

    public function registro() {
        $error = null;
        $tabActiva = 'registro';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $password2 = $_POST['password2'] ?? '';

            if ($email === '' || $password === '' || $password2 === '') {
                $error = 'Rellena todos los campos.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'El email no tiene un formato válido.';
            } elseif (strlen($password) < 6) {
                $error = 'La contraseña debe tener al menos 6 caracteres.';
            } elseif ($password !== $password2) {
                $error = 'Las contraseñas no coinciden.';
            } elseif ($this->gestor->buscarUsuarioPorEmail($email)) {
                $error = 'Ya existe un usuario con ese email.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $nuevo = new Usuario($email, $hash);
                if ($this->gestor->registrarUsuario($nuevo)) {
                    // Auto-login tras registro
                    $usuario = $this->gestor->buscarUsuarioPorEmail($email);
                    $_SESSION['usuario'] = $usuario->getEmail();
                    $_SESSION['usuario_id'] = $usuario->getId();
                    header('Location: index.php');
                    exit;
                } else {
                    $error = 'No se pudo crear la cuenta. Inténtalo de nuevo.';
                }
            }
        }

        include 'views/login.php';
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function carrito() {
        include 'views/carrito.php';
    }

    public function admin() {
        $productos = $this->gestor->obtenerProductos();
        include 'views/admin.php';
    }
}

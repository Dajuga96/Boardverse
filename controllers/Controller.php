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
        $filtros = [
            'q'         => $_GET['q']         ?? '',
            'jugadores' => $_GET['jugadores'] ?? '',
            'edad'      => $_GET['edad']      ?? '',
            'duracion'  => $_GET['duracion']  ?? '',
            'categoria' => $_GET['categoria'] ?? ($_GET['cat'] ?? ''),
            'precio'    => $_GET['precio']    ?? '',
        ];
        $productos = $this->gestor->obtenerProductosFiltrados($filtros);
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
        $relacionados = $this->gestor->obtenerRelacionados(
            $producto->getId(),
            $producto->getCategoria(),
            4
        );
        include 'views/producto.php';
    }

    public function login() {
        $error = null;
        $tabActiva = 'login';

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

    public function admin() {
        $productos = $this->gestor->obtenerProductos();
        $usuarios  = $this->gestor->obtenerUsuarios();
        include 'views/admin.php';
    }

    public function agregarCarrito() {
    $id = $_POST['id'] ?? null;
    $cantidad = (int)($_POST['cantidad'] ?? 1);

    if (!$id || $cantidad < 1) {
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php?accion=catalogo'));
    exit;
    }

    $producto = $this->gestor->buscarProducto($id);

    if ($producto) {
        Carrito::agregar($producto, $cantidad);
    }

    $volver = $_POST['volver'] ?? 'index.php?accion=catalogo';

    header('Location: ' . $volver);
    exit;
    }

    public function actualizarCarrito() {
        $id = $_POST['id'] ?? null;
        $cantidad = (int)($_POST['cantidad'] ?? 1);

        if ($id) {
            Carrito::actualizar($id, $cantidad);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
    }

    public function eliminarCarrito() {
        $id = $_GET['id'] ?? null;

        if ($id) {
            Carrito::eliminar($id);
        }

        header('Location: index.php?accion=carrito');
        exit;
    }

    public function carrito() {
        $carrito = Carrito::obtener();
        $subtotal = Carrito::subtotal();
        $envio = $subtotal > 0 ? 4.95 : 0;
        $total = $subtotal + $envio;

        include 'views/carrito.php';
    }

    public function vaciarCarrito() {

    Carrito::vaciar();

    header('Location: index.php?accion=carrito');
    exit;
}
    }

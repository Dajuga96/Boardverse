<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito — BoardVerse</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header class="cabecera">
        <div class="cabecera-cont">
            <a href="index.php" class="logo">
                <div class="logo-img">BV</div>
                <span class="logo-texto">BoardVerse</span>
            </a>

            <button class="menu-btn" aria-label="Abrir menú" id="btnMenu">
                <span></span>
            </button>

            <nav class="nav" id="navPrincipal">
                <ul class="menu">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="index.php?accion=catalogo">Catálogo</a></li>
                    
                </ul>
                <div class="acciones-cab">
                    <?php if (isset($_SESSION['usuario'])): ?>
                    <span style="font-size:.875rem; color:var(--gris);">👤 <?= htmlspecialchars($_SESSION['usuario']) ?></span>
                    <a href="index.php?accion=logout" class="btn btn-borde btn-peq">Cerrar sesión</a>
                    <?php else: ?>
                    <a href="index.php?accion=login" class="btn btn-borde btn-peq">Iniciar sesión</a>
                    <?php endif; ?>
                    <a href="index.php?accion=carrito" class="btn btn-amarillo">
                        Carrito (<?= Carrito::contar(); ?>)
                    </a>
                    </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">

            <nav class="mb-1" style="font-size:.875rem; color:var(--gris);">
                <a href="index.php">Inicio</a> /
                <span>Carrito</span>
            </nav>

            <h1 style="margin-bottom:1.5rem;">Mi carrito</h1>

            <section class="seccion">
                <div class="panel">
                    <table class="tabla" id="tablaCarrito">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($carrito as $item): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($item['nombre']) ?>
                                </td>

                                <td>
                                    <?= number_format($item['precio'], 2, ',', '.') ?> €
                                </td>

                                <td>
                                    <form method="POST" action="index.php?accion=actualizarCarrito" style="display:flex; gap:.5rem;">
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                        <input class="input" type="number" name="cantidad" value="<?= $item['cantidad'] ?>" min="1" max="99" style="width:80px;">
                                        <button class="btn btn-borde btn-peq" type="submit">Actualizar</button>
                                    </form>
                                </td>

                                <td>
                                    <?= number_format($item['precio'] * $item['cantidad'], 2, ',', '.') ?> €
                                </td>

                                <td>
                                    <a class="btn btn-rojo btn-peq" href="index.php?accion=eliminarCarrito&id=<?= $item['id'] ?>">
                                        Quitar
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>    
                        </tbody>
                    </table>
                    <?php if (empty($carrito)): ?>
                        <p style="padding:1rem; color:var(--gris);">El carrito está vacío.</p>
                    <?php endif; ?>
                </div>
            </section>

            <section class="seccion">
                <div class="panel" style="max-width:420px; margin-left:auto;">
                    <h2>Resumen</h2>
                    <div style="display:flex; justify-content:space-between; margin:.5rem 0;">
                        <span>Subtotal</span>
                        <span><?= number_format($subtotal, 2, ',', '.') ?> €</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin:.5rem 0;">
                        <span>Envío</span>
                        <span><?= number_format($envio, 2, ',', '.') ?> €</span>
                    </div>
                    <hr style="border:none; border-top:1px solid var(--borde); margin:.75rem 0;">
                    <div style="display:flex; justify-content:space-between; font-weight:700; font-size:1.125rem;">
                        <span>Total</span>
                        <span><?= number_format($total, 2, ',', '.') ?> €</span>
                    </div>
                    <button class="btn btn-azul btn-full" onclick="finalizarCompra()">
                    Finalizar compra
                    </button>
                    <a href="index.php?accion=catalogo" class="btn btn-borde btn-full" style="margin-top:.5rem;">Seguir comprando</a>
                </div>
            </section>

        </div>
    </main>

    <footer class="pie">
        <div class="pie-bottom">
            &copy; 2026 BoardVerse · Proyecto Intermodular DAW · Florida Universitària
        </div>
    </footer>

    <script src="js/app.js"></script>
    <script>
    function finalizarCompra() {

        alert("✅ Tu compra ha sido completada con éxito 😊");

        window.location.href = "index.php?accion=vaciarCarrito";
    }
</script>
</body>
</html>

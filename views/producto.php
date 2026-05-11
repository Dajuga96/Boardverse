<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($producto->getNombre()) ?> — BoardVerse</title>
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
                    <a href="index.php?accion=carrito" class="btn btn-amarillo btn-peq">Carrito (0)</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">

            <nav class="mb-1" style="font-size:.875rem; color:var(--gris);">
                <a href="index.php">Inicio</a> /
                <a href="index.php?accion=catalogo">Catálogo</a> /
                <span><?= htmlspecialchars($producto->getNombre()) ?></span>
            </nav>

            <section class="ficha">
                <div class="ficha-img">
                    <?php if ($producto->getImagen()): ?>
                        <img src="img/<?= htmlspecialchars($producto->getImagen()) ?>" alt="<?= htmlspecialchars($producto->getNombre()) ?>" style="width:100%;height:100%;object-fit:cover;">
                    <?php else: ?>
                        <span>Imagen del producto</span>
                    <?php endif; ?>
                </div>

                <div class="ficha-info">
                    <h1 class="ficha-nombre"><?= htmlspecialchars($producto->getNombre()) ?></h1>
                    <span class="ficha-precio"><?= $producto->getPrecio() ?> €</span>

                    <p class="ficha-desc"><?= htmlspecialchars($producto->getDescripcion()) ?></p>

                    <div class="specs">
                        <div class="spec">
                            <span class="spec-label">Jugadores</span>
                            <span class="spec-valor"><?= $producto->getNumJugadoresMin(); ?>-<?= $producto->getNumJugadoresMax(); ?></span>
                        </div>
                        <div class="spec">
                            <span class="spec-label">Edad</span>
                            <span class="spec-valor"><?= $producto->getEdad(); ?>+</span>
                        </div>
                        <div class="spec">
                            <span class="spec-label">Duración</span>
                            <span class="spec-valor"><?= $producto->getDuracion(); ?> min</span>
                        </div>
                        <div class="spec">
                            <span class="spec-label">Dificultad</span>
                            <span class="spec-valor"><?= htmlspecialchars($producto->getDificultad()); ?></span>
                        </div>
                        <div class="spec">
                            <span class="spec-label">Categoría</span>
                            <span class="spec-valor"><?= htmlspecialchars($producto->getCategoria()); ?></span>
                        </div>
                    </div>

                    <form class="cantidad-fila" id="formComprar">
                        <label class="etiqueta" for="cant">Cantidad</label>
                        <div class="cantidad">
                            <button type="button" data-qty="-1">−</button>
                            <input type="number" id="cant" name="cant" value="1" min="1" max="99">
                            <button type="button" data-qty="+1">+</button>
                        </div>
                        <button type="submit" class="btn btn-amarillo">Comprar</button>
                        <button type="button" class="btn btn-borde">♥ Favorito</button>
                    </form>

                </div>
            </section>

            <?php if (!empty($relacionados)): ?>
            <section class="seccion">
                <h2 class="titulo-seccion">Productos relacionados</h2>
                <div class="productos">
                    <?php foreach ($relacionados as $rel): ?>
                        <article class="producto">
                            <a href="index.php?accion=producto&id=<?= $rel->getId(); ?>" class="producto-img">
                                <?php if ($rel->getImagen()): ?>
                                    <img src="img/<?= htmlspecialchars($rel->getImagen()) ?>" alt="<?= htmlspecialchars($rel->getNombre()) ?>">
                                <?php else: ?>
                                    <?= htmlspecialchars($rel->getNombre()); ?>
                                <?php endif; ?>
                            </a>
                            <div class="producto-info">
                                <h3 class="producto-nombre"><?= htmlspecialchars($rel->getNombre()); ?></h3>
                                <span class="producto-precio"><?= $rel->getPrecio(); ?> €</span>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>

        </div>
    </main>

    <footer class="pie">
        <div class="pie-bottom">
            &copy; 2026 BoardVerse · Proyecto Intermodular DAW · Florida Universitària
        </div>
    </footer>

    <script src="js/app.js"></script>
</body>
</html>

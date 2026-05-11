<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoardVerse — Tienda online de juegos de mesa</title>
    <meta name="description" content="BoardVerse, tu tienda especializada en juegos de mesa: estrategia, familiar, party y cooperativos.">
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
                    <li><a href="index.php" class="activo">Inicio</a></li>
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

            <section class="hero">
                <h1>Tu próxima partida empieza aquí</h1>
                <p>Descubre los mejores juegos de mesa con filtros pensados para jugadores: número de jugadores, duración, edad y dificultad.</p>
                <a href="index.php?accion=catalogo" class="btn btn-amarillo">Explorar catálogo</a>
            </section>

            <section class="seccion">
                <div class="banners">
                    <div class="banner banner-azul">
                        <h3 style="color:#fff;">Novedades</h3>
                        <p>Últimos lanzamientos</p>
                    </div>
                    <div class="banner banner-amarillo">
                        <h3>Ofertas de la semana</h3>
                        <p>Hasta un 30% de descuento en juegos seleccionados</p>
                    </div>
                    <div class="banner">
                        <h3>Top ventas</h3>
                        <p>Los más jugados</p>
                    </div>
                </div>
            </section>

            <section class="seccion">
                <h2 class="titulo-seccion">Productos destacados</h2>
                <div class="productos">
                    <?php
                    // Muestra los primeros 4 productos como "destacados"
                    $destacados = array_slice($productos ?? [], 0, 4);
                    foreach ($destacados as $p):
                    ?>
                        <article class="producto">
                            <a href="index.php?accion=producto&id=<?= $p->getId() ?>" class="producto-img">
                                <?php if ($p->getImagen()): ?>
                                    <img src="img/<?= htmlspecialchars($p->getImagen()) ?>" alt="<?= htmlspecialchars($p->getNombre()) ?>">
                                <?php else: ?>
                                    <?= htmlspecialchars($p->getNombre()) ?>
                                <?php endif; ?>
                            </a>
                            <div class="producto-info">
                                <h3 class="producto-nombre"><?= htmlspecialchars($p->getNombre()) ?></h3>
                                <div class="tags">
                                    <span class="tag"><?= $p->getNumJugadoresMin() ?>-<?= $p->getNumJugadoresMax() ?> jugadores</span>
                                    <span class="tag"><?= $p->getDuracion() ?> min</span>
                                </div>
                                <span class="producto-precio"><?= $p->getPrecio() ?> €</span>
                                <a href="index.php?accion=producto&id=<?= $p->getId() ?>" class="btn btn-azul btn-peq">Ver detalles</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

        </div>
    </main>

    <footer class="pie">
        <div class="pie-cont">
            <div>
                <h4>BoardVerse</h4>
                <p>Tienda especializada en juegos de mesa. Proyecto intermodular DAW, Florida Universitària 2025/2026.</p>
            </div>
            <div>
                <h4>Categorías</h4>
                <a href="index.php?accion=catalogo&cat=Estrategia">Estrategia</a>
                <a href="index.php?accion=catalogo&cat=Familiar">Familiar</a>
                <a href="index.php?accion=catalogo&cat=Party">Party</a>
                <a href="index.php?accion=catalogo&cat=Cooperativo">Cooperativos</a>
            </div>
            <div>
                <h4>Ayuda</h4>
                <a href="#">Contacto</a>
                <a href="#">Envíos</a>
                <a href="#">Devoluciones</a>
                <a href="#">Preguntas frecuentes</a>
            </div>
            <div>
                <h4>Cuenta</h4>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <a href="index.php?accion=logout">Cerrar sesión</a>
                <?php else: ?>
                    <a href="index.php?accion=login">Iniciar sesión</a>
                    <a href="index.php?accion=login">Registrarse</a>
                <?php endif; ?>
                <a href="index.php?accion=admin">Panel admin</a>
            </div>
        </div>
        <div class="pie-bottom">
            &copy; 2026 BoardVerse · Andreu Raga · Jonatan Silva · David Jurado
        </div>
    </footer>

    <script src="js/app.js"></script>
</body>
</html>

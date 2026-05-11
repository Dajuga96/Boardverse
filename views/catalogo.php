<?php
$f = [
    'q'         => $_GET['q']         ?? '',
    'jugadores' => $_GET['jugadores'] ?? '',
    'edad'      => $_GET['edad']      ?? '',
    'duracion'  => $_GET['duracion']  ?? '',
    'categoria' => $_GET['categoria'] ?? ($_GET['cat'] ?? ''),
    'precio'    => $_GET['precio']    ?? '',
];
$sel = function($name, $val) use ($f) {
    return ($f[$name] ?? '') == $val ? ' selected' : '';
};
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo — BoardVerse</title>
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
                    <li><a href="index.php?accion=catalogo" class="activo">Catálogo</a></li>
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

            <div class="catalogo-top">
                <h1>Catálogo de juegos</h1>

                <form class="filtros" id="formFiltros" method="GET" action="index.php">
                    <input type="hidden" name="accion" value="catalogo">

                    <div class="busqueda">
                        <input type="search" name="q" placeholder="Buscar por nombre..." value="<?= htmlspecialchars($f['q']) ?>">
                        <button type="submit" class="btn btn-azul">Buscar</button>
                    </div>

                    <label class="campo">
                        <span class="etiqueta">Jugadores</span>
                        <select name="jugadores">
                            <option value=""<?= $sel('jugadores','') ?>>Cualquiera</option>
                            <option value="1-2"<?= $sel('jugadores','1-2') ?>>1-2</option>
                            <option value="3-4"<?= $sel('jugadores','3-4') ?>>3-4</option>
                            <option value="5+"<?= $sel('jugadores','5+') ?>>5 o más</option>
                        </select>
                    </label>

                    <label class="campo">
                        <span class="etiqueta">Edad</span>
                        <select name="edad">
                            <option value=""<?= $sel('edad','') ?>>Cualquiera</option>
                            <option value="6"<?= $sel('edad','6') ?>>6+</option>
                            <option value="8"<?= $sel('edad','8') ?>>8+</option>
                            <option value="12"<?= $sel('edad','12') ?>>12+</option>
                            <option value="16"<?= $sel('edad','16') ?>>16+</option>
                        </select>
                    </label>

                    <label class="campo">
                        <span class="etiqueta">Duración</span>
                        <select name="duracion">
                            <option value=""<?= $sel('duracion','') ?>>Cualquiera</option>
                            <option value="30"<?= $sel('duracion','30') ?>>≤ 30 min</option>
                            <option value="60"<?= $sel('duracion','60') ?>>30–60 min</option>
                            <option value="120"<?= $sel('duracion','120') ?>>60–120 min</option>
                            <option value="120+"<?= $sel('duracion','120+') ?>>&gt; 120 min</option>
                        </select>
                    </label>

                    <label class="campo">
                        <span class="etiqueta">Categoría</span>
                        <select name="categoria">
                            <option value=""<?= $sel('categoria','') ?>>Todas</option>
                            <option value="Estrategia"<?= $sel('categoria','Estrategia') ?>>Estrategia</option>
                            <option value="Familiar"<?= $sel('categoria','Familiar') ?>>Familiar</option>
                            <option value="Party"<?= $sel('categoria','Party') ?>>Party</option>
                            <option value="Cooperativo"<?= $sel('categoria','Cooperativo') ?>>Cooperativo</option>
                        </select>
                    </label>

                    <label class="campo">
                        <span class="etiqueta">Precio máx.</span>
                        <select name="precio">
                            <option value=""<?= $sel('precio','') ?>>Sin límite</option>
                            <option value="20"<?= $sel('precio','20') ?>>Hasta 20 €</option>
                            <option value="40"<?= $sel('precio','40') ?>>Hasta 40 €</option>
                            <option value="60"<?= $sel('precio','60') ?>>Hasta 60 €</option>
                            <option value="100"<?= $sel('precio','100') ?>>Hasta 100 €</option>
                        </select>
                    </label>
                </form>
            </div>

            <section class="productos" id="gridProductos">
                <?php if (empty($productos)): ?>
                    <p style="grid-column:1/-1; padding:2rem; text-align:center; color:var(--gris);">No hay juegos que cumplan los filtros seleccionados. <a href="index.php?accion=catalogo">Limpiar filtros</a></p>
                <?php else: foreach ($productos as $producto): ?>
                    <article class="producto">
                        <a href="index.php?accion=producto&id=<?= $producto->getId(); ?>" class="producto-img">
                            <?php if ($producto->getImagen()): ?>
                                <img src="img/<?= htmlspecialchars($producto->getImagen()) ?>" alt="<?= htmlspecialchars($producto->getNombre()) ?>">
                            <?php else: ?>
                                <?= htmlspecialchars($producto->getNombre()); ?>
                            <?php endif; ?>
                        </a>
                        <div class="producto-info">
                            <h3 class="producto-nombre"><?= htmlspecialchars($producto->getNombre()); ?></h3>
                            <div class="tags">
                                <span class="tag"><?= $producto->getNumJugadoresMin(); ?>-<?= $producto->getNumJugadoresMax(); ?> jugadores</span>
                                <span class="tag"><?= $producto->getDuracion(); ?> min</span>
                                <span class="tag"><?= $producto->getEdad(); ?>+ años</span>
                            </div>
                            <span class="producto-precio"><?= $producto->getPrecio(); ?> €</span>
                        </div>
                    </article>
                <?php endforeach; endif; ?>
            </section>

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

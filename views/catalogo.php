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
                    <li><a href="catalogo.html" class="activo">Catálogo</a></li>
                    <li><a href="catalogo.html?cat=estrategia">Estrategia</a></li>
                    <li><a href="catalogo.html?cat=familiar">Familiar</a></li>
                    <li><a href="catalogo.html?cat=party">Party</a></li>
                </ul>
                <div class="acciones-cab">
                    <a href="login.html" class="btn btn-borde btn-peq">Iniciar sesión</a>
                    <a href="carrito.html" class="btn btn-amarillo btn-peq">Carrito (0)</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">

            <div class="catalogo-top">
                <h1>Catálogo de juegos</h1>

                <form class="filtros" id="formFiltros">
                    <div class="busqueda">
                        <input type="search" name="q" placeholder="Buscar por nombre...">
                        <button type="submit" class="btn btn-azul">Buscar</button>
                    </div>

                    <label class="campo">
                        <span class="etiqueta">Jugadores</span>
                        <select name="jugadores">
                            <option value="">Cualquiera</option>
                            <option value="1-2">1-2</option>
                            <option value="3-4">3-4</option>
                            <option value="5+">5 o más</option>
                        </select>
                    </label>

                    <label class="campo">
                        <span class="etiqueta">Edad</span>
                        <select name="edad">
                            <option value="">Cualquiera</option>
                            <option value="6">6+</option>
                            <option value="8">8+</option>
                            <option value="12">12+</option>
                            <option value="16">16+</option>
                        </select>
                    </label>

                    <label class="campo">
                        <span class="etiqueta">Duración</span>
                        <select name="duracion">
                            <option value="">Cualquiera</option>
                            <option value="30">≤ 30 min</option>
                            <option value="60">30–60 min</option>
                            <option value="120">60–120 min</option>
                            <option value="120+">> 120 min</option>
                        </select>
                    </label>

                    <label class="campo">
                        <span class="etiqueta">Categoría</span>
                        <select name="categoria">
                            <option value="">Todas</option>
                            <option value="estrategia">Estrategia</option>
                            <option value="familiar">Familiar</option>
                            <option value="party">Party</option>
                            <option value="cooperativo">Cooperativo</option>
                        </select>
                    </label>

                    <label class="campo">
                        <span class="etiqueta">Precio máx.</span>
                        <select name="precio">
                            <option value="">Sin límite</option>
                            <option value="20">Hasta 20 €</option>
                            <option value="40">Hasta 40 €</option>
                            <option value="60">Hasta 60 €</option>
                            <option value="100">Hasta 100 €</option>
                        </select>
                    </label>
                </form>
            </div>

            <section class="productos" id="gridProductos">
                <?php foreach ($productos as $producto): ?>
                    <article class="producto">
                        <a href="producto.php?id=<?php echo $producto->getId(); ?>" class="producto-img"><?php echo $producto->getNombre(); ?></a>
                        <div class="producto-info">
                            <h3 class="producto-nombre"><?php echo $producto->getNombre(); ?></h3>
                            <div class="tags">
                                <span class="tag"><?php echo $producto->getNumJugadoresMin(); ?>-<?php echo $producto->getNumJugadoresMax(); ?> jugadores</span>
                                <span class="tag"><?php echo $producto->getDuracion(); ?> min</span>
                                <span class="tag"><?php echo $producto->getEdad(); ?>+ años</span>
                            </div>
                            <span class="producto-precio"><?php echo $producto->getPrecio(); ?> €</span>
                        </div>
                    </article>
                <?php endforeach; ?>
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

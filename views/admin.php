<?php
// Helper para colorear el badge de stock
function badgeStock($stock) {
    if ($stock == 0) return 'badge-rojo';
    if ($stock < 5)  return 'badge-amarillo';
    return 'badge-verde';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración — BoardVerse</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header class="cabecera">
        <div class="cabecera-cont">
            <a href="index.php" class="logo">
                <div class="logo-img">BV</div>
                <span class="logo-texto">BoardVerse · Admin</span>
            </a>
            <nav class="nav">
                <div class="acciones-cab">
                    <span style="font-size:.875rem; color:var(--gris);">👤 <?= isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : 'Admin' ?></span>
                    <a href="index.php?accion=logout" class="btn btn-borde btn-peq">Cerrar sesión</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">

            <div class="admin-top">
                <h1>Panel de administración</h1>
                <span>Bienvenido<?= isset($_SESSION['usuario']) ? ', ' . htmlspecialchars($_SESSION['usuario']) : '' ?></span>
            </div>

            <nav class="filtros-admin">
                <button class="btn activo" data-filtro="productos">Productos</button>
                <button class="btn" data-filtro="usuarios">Usuarios</button>
                <button class="btn" data-filtro="stock">Stock bajo</button>
            </nav>

            <div class="admin-zona">

                <section class="panel">
                    <h2>Productos (<?= count($productos) ?>)</h2>

                    <div style="display:flex; justify-content:flex-end; margin-bottom:.75rem;">
                        <button class="btn btn-amarillo btn-peq">+ Nuevo producto</button>
                    </div>

                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $p): ?>
                                <tr>
                                    <td>#<?= $p->getId() ?></td>
                                    <td><?= htmlspecialchars($p->getNombre()) ?></td>
                                    <td><?= htmlspecialchars($p->getCategoria()) ?></td>
                                    <td><?= $p->getPrecio() ?> €</td>
                                    <td><span class="badge <?= badgeStock($p->getStock()) ?>"><?= $p->getStock() ?></span></td>
                                    <td class="acciones">
                                        <a href="index.php?accion=producto&id=<?= $p->getId() ?>" class="btn btn-borde btn-peq">Ver</a>
                                        <button class="btn btn-borde btn-peq">Editar</button>
                                        <button class="btn btn-rojo btn-peq">Eliminar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>

                <section class="panel">
                    <h2>Usuarios registrados (<?= count($usuarios) ?>)</h2>

                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($usuarios)): ?>
                                <tr><td colspan="3" style="text-align:center; color:var(--gris);">No hay usuarios registrados todavía.</td></tr>
                            <?php else: foreach ($usuarios as $u): ?>
                                <tr>
                                    <td>#<?= $u->getId() ?></td>
                                    <td><?= htmlspecialchars($u->getEmail()) ?></td>
                                    <td class="acciones">
                                        <button class="btn btn-borde btn-peq">Editar</button>
                                        <button class="btn btn-rojo btn-peq">Eliminar</button>
                                    </td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </section>

                <section class="panel panel-full">
                    <h2>Stock bajo (productos con menos de 5 unidades)</h2>

                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $bajo = array_filter($productos, fn($p) => $p->getStock() < 5);
                            if (empty($bajo)): ?>
                                <tr><td colspan="4" style="text-align:center; color:var(--gris);">No hay productos con stock bajo. ¡Todo en orden! ✓</td></tr>
                            <?php else: foreach ($bajo as $p): ?>
                                <tr>
                                    <td><?= htmlspecialchars($p->getNombre()) ?></td>
                                    <td><?= htmlspecialchars($p->getCategoria()) ?></td>
                                    <td><?= $p->getPrecio() ?> €</td>
                                    <td><span class="badge <?= badgeStock($p->getStock()) ?>"><?= $p->getStock() ?></span></td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </section>

            </div>
        </div>
    </main>

    <footer class="pie">
        <div class="pie-bottom">
            &copy; 2026 BoardVerse · Panel de administración
        </div>
    </footer>

    <script src="js/app.js"></script>
</body>
</html>

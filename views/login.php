<?php $tabActiva = $tabActiva ?? 'login'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceder — BoardVerse</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header class="cabecera">
        <div class="cabecera-cont">
            <a href="index.php" class="logo">
                <div class="logo-img">BV</div>
                <span class="logo-texto">BoardVerse</span>
            </a>
            <nav class="nav">
                <ul class="menu">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="index.php?accion=catalogo">Catálogo</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="login-box">
                <h1>Mi cuenta</h1>

                <div class="tabs">
                    <button type="button" class="<?= $tabActiva === 'login' ? 'activo' : '' ?>" data-tab="login">Inicio sesión</button>
                    <button type="button" class="<?= $tabActiva === 'registro' ? 'activo' : '' ?>" data-tab="registro">Registrarse</button>
                </div>

                <?php if (!empty($error)): ?>
                    <div style="background:#fde2e2; border:1px solid #c62828; color:#8b1c1c; padding:.75rem 1rem; border-radius:.5rem; margin-bottom:1rem; font-size:.9rem;">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form class="form <?= $tabActiva === 'login' ? '' : 'oculto' ?>" id="formLogin" data-panel="login" method="POST" action="index.php?accion=login">
                    <div class="campo">
                        <label for="login-email">Email</label>
                        <input class="input" type="email" id="login-email" name="email" required placeholder="tu@email.com">
                    </div>

                    <div class="campo">
                        <label for="login-pass">Contraseña</label>
                        <input class="input" type="password" id="login-pass" name="password" required minlength="6">
                    </div>

                    <a href="#" style="font-size:.875rem; align-self:flex-end;">¿Olvidaste tu contraseña?</a>

                    <button type="submit" class="btn btn-azul btn-full">Entrar</button>
                </form>

                <form class="form <?= $tabActiva === 'registro' ? '' : 'oculto' ?>" id="formRegistro" data-panel="registro" method="POST" action="index.php?accion=registro">
                    <div class="campo">
                        <label for="reg-name">Nombre de usuario</label>
                        <input class="input" type="text" id="reg-name" name="username" minlength="3">
                    </div>

                    <div class="campo">
                        <label for="reg-email">Email</label>
                        <input class="input" type="email" id="reg-email" name="email" required>
                    </div>

                    <div class="campo">
                        <label for="reg-pass">Contraseña</label>
                        <input class="input" type="password" id="reg-pass" name="password" required minlength="6">
                    </div>

                    <div class="campo">
                        <label for="reg-pass2">Repite la contraseña</label>
                        <input class="input" type="password" id="reg-pass2" name="password2" required minlength="6">
                    </div>

                    <label style="display:flex; align-items:center; gap:.5rem; font-size:.875rem;">
                        <input type="checkbox" required>
                        Acepto los términos y la política de privacidad
                    </label>

                    <button type="submit" class="btn btn-amarillo btn-full">Crear cuenta</button>
                </form>

            </div>
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

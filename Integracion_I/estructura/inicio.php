<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilo_inicio.css"> <!-- Enlace al archivo CSS externo -->
</head>
<body>
    <div class="login-container">
        <form class="login-form" method="POST" action="login.php">
            <h2>Iniciar Sesión</h2>
            <?php if (isset($error)): ?>
                <p class="error-message"><?= $error ?></p>
            <?php endif; ?>
            <div class="input-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="button-group">
                <button type="submit" class="btn-login">Iniciar Sesión</button>
                <a href="registro.php" class="btn-registro">Registrarse</a>
            </div>
        </form>
    </div>
</body>
</html>

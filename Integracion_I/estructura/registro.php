<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="registro.css">
</head>
<body>
    <header id="img-uct">
        <img src="../logo.png" alt="Logo Universidad" width="170" height="60">
    </header>

    <main class="conteiner">
        <h2>Registro de Funcionarios y Estudiantes</h2>
        <form action="procesar_registro.php" method="post" enctype="multipart/form-data">
            <label for="username">Nombre de usuario</label>
            <input type="text" id="username" name="username" required>

            <label for="carrera">Carrera</label>
            <input type="text" id="carrera" name="carrera" require>

            <label for="email">Correo institucional</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <label for="photo">Foto de la credencial</label>
            <input type="file" id="photo" name="photo" accept="image/*">

            <input type="submit" value="Registrarse">
        </form>

        <p>¿Ya tienes una cuenta? <a href="inicio.php">Inicia sesión aquí</a>.</p>
    </main>
    <footer class="futer">
        <p>&copy; 2024 Universidad Católica de Temuco. Todos los derechos reservados en su Totalidad.</p>
        <a href="https://www.uct.cl/">Nuestra Página Oficial</a>
    </footer>
</body>
</html>



<?php
session_start();
include('conex.php'); // Asegúrate de tener el archivo de conexión a la base de datos

// Verificar si se envió el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para obtener el usuario por su email
    $query = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $user['contraseña'])) {
            // Configurar la sesión del usuario
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nombre'] = $user['nombre'];

            // Redirigir según el rol del usuario
            if ($user['role'] === 'admin') {
                header('Location: pagina_admin.php'); 
            } else {
                header('Location: index.php'); 
            }
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "No se encontró una cuenta con ese correo.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>

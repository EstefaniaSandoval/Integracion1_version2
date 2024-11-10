<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conex.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['username'];
    $correo = $_POST['email'];
    $contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO INFO1170_RegistroUsuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param("sss", $nombre_usuario, $correo, $contrasena);

    if ($stmt->execute()) {
        echo "Registro exitoso";
        echo "<script>alert('Registro exitoso'); window.location.href = '../inicio.php';</script>";
        exit();
    } else {
        echo "Error al registrar";
    }

    $stmt->close();
}
$conexion->close();
?>

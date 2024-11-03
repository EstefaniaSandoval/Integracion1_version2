<?php
include('conex.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conexion->prepare("SELECT contraseña FROM INFO1170_Usuarios WHERE nombre = ?");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    if ($hashedPassword && password_verify($password, $hashedPassword)) {
        session_start();
        $_SESSION['usuario'] = $username;
        echo "success";
        // Redirigir a la página principal
        echo "<script>window.location.href = './pag_inicio.php';</script>";
        exit();
    } else {
        http_response_code(401); 
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href = './inicio.php';</script>";
    }


    $stmt->close();
}

$conexion->close();
?>

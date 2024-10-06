<?php 
include('cabecera.php'); 

// Mostrar errores para el mejor desarrollo para los programadores
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<h2>Registro de Vehículos</h2>
<form action="registro_vehiculos.php" method="POST">
    <label for="owner_name">Nombre del Propietario:</label><br>
    <input type="text" id="owner_name" name="owner_name" required><br><br>

    <label for="vehicle_plate">Patente del Vehículo:</label><br>
    <input type="text" id="vehicle_plate" name="vehicle_plate" required><br><br>

    <label for="user_type">Tipo de Usuario:</label><br>
    <select id="user_type" name="user_type" required>
        <option value="profesor">Profesor</option>
        <option value="alumno">Alumno</option>
        <option value="visita">Visita</option>
    </select><br><br>

    <label for="parking_space">Espacio de Estacionamiento:</label><br>
    <input type="text" id="parking_space" name="parking_space" required><br><br>

    <input type="submit" value="Registrar Vehículo">
</form>


<?php
include('conex.php'); // Conexion con la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $owner_name = $_POST['owner_name'];
    $vehicle_plate = $_POST['vehicle_plate'];
    $user_type = $_POST['user_type'];
    $parking_space = $_POST['parking_space'];

    // Cambia 'TABLA_TEST' cuando sea seguro, esto es solo un test
    $query_insertar = "INSERT INTO TABLA_TEST (test_1, test_2, test_3, test_4) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($query_insertar);
    
    if (!$stmt) {
        die("Error al preparar la consulta de inserción: " . $conexion->error);
    }

    // Cambia los tipos en bind_param según el tipo de datos de tu tabla
    $stmt->bind_param("ssss", $owner_name, $vehicle_plate, $user_type, $parking_space);

    if ($stmt->execute()) {
        echo "Vehículo registrado exitosamente.";
    } else {
        echo "Error al registrar el vehículo: " . $stmt->error;
    }
    $stmt->close();
}
?>
<?php include('pie.php'); ?>

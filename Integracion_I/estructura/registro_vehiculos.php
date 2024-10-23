<?php include('cabecera.php'); ?>

<link rel="stylesheet" href="styles.css">
<h2>Registro de Vehículos</h2>

<form action="registro_vehiculos.php" method="POST">
    <!-- Nombre -->
    <label for="owner_first_name">Nombre del propietario:</label><br>
    <input type="text" id="owner_first_name" name="owner_first_name" required><br><br>

    <!-- Apellido -->
    <label for="owner_last_name">Apellido del propietario:</label><br>
    <input type="text" id="owner_last_name" name="owner_last_name" required><br><br>

    <!-- Edad -->
    <label for="owner_age">Edad del Propietario:</label><br>
    <input type="number" id="owner_age" name="owner_age" required><br><br>

    <!-- Sexo -->
    <label for="owner_sex">Sexo:</label><br>
    <select id="owner_sex" name="owner_sex" required>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select><br><br>

    <!-- Tipo de Usuario -->
    <label for="user_type">Tipo de Usuario:</label><br>
    <select id="user_type" name="user_type" required>
        <option value="profesor">Profesor</option>
        <option value="alumno">Alumno</option>
        <option value="visita">Visita</option>
    </select><br><br>

    <!-- Patente del Vehículo -->
    <label for="vehicle_plate">Patente del Vehículo:</label><br>
    <input type="text" id="vehicle_plate" name="vehicle_plate" required><br><br>

    <!-- Marca del Vehículo -->
    <label for="vehicle_brand">Marca del Vehículo:</label><br>
    <input type="text" id="vehicle_brand" name="vehicle_brand" required><br><br>

    <!-- Modelo del Vehículo -->
    <label for="vehicle_model">Modelo del Vehículo:</label><br>
    <input type="text" id="vehicle_model" name="vehicle_model" required><br><br>

    <!-- Color del Vehículo -->
    <label for="vehicle_color">Color del Vehículo:</label><br>
    <input type="text" id="vehicle_color" name="vehicle_color" required><br><br>

    <!-- Espacio de Estacionamiento -->
    <label for="parking_space">Espacio de Estacionamiento:</label><br>
    <input type="text" id="parking_space" name="parking_space" required><br><br>

    <input type="submit" value="Registrar Vehículo">
</form>

<?php
include('conex.php'); // Conexión con la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $owner_first_name = $_POST['owner_first_name'];
    $owner_last_name = $_POST['owner_last_name'];
    $owner_age = $_POST['owner_age'];
    $owner_sex = $_POST['owner_sex'];
    $vehicle_plate = $_POST['vehicle_plate'];
    $vehicle_brand = $_POST['vehicle_brand'];
    $vehicle_model = $_POST['vehicle_model'];
    $vehicle_color = $_POST['vehicle_color'];
    $user_type = $_POST['user_type'];
    $parking_space = $_POST['parking_space'];

    // Asegúrate de que el nombre de la tabla y las columnas coincidan
    $query_insertar = "INSERT INTO vehiculos_registrados 
        (nombre, apellido, edad, sexo, tipo_usuario, patente, marca, modelo, color, espacio_estacionamiento) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($query_insertar);
    
    if (!$stmt) {
        die("Error al preparar la consulta de inserción: " . $conexion->error);
    }

    // Vincular parámetros en la consulta preparada
    $stmt->bind_param("ssisssssss", $owner_first_name, $owner_last_name, $owner_age, $owner_sex, $user_type, $vehicle_plate, $vehicle_brand, $vehicle_model, $vehicle_color, $parking_space);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<p style='color:green;'>Vehículo registrado exitosamente.</p>";
    } else {
        echo "<p style='color:red;'>Error al registrar el vehículo: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<?php include('pie.php'); ?>

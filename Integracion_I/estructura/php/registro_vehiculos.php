<?php include('cabecera.php'); ?>

<link rel="stylesheet" href="../css/styles.css">
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

    <!-- Patente del Veh culo -->
    <label for="vehicle_plate">Patente del Veh culo:</label><br>
    <input type="text" id="vehicle_plate" name="vehicle_plate" required><br><br>

    <!-- Marca del Veh culo -->
    <label for="vehicle_brand">Marca del Veh culo:</label><br>
    <input type="text" id="vehicle_brand" name="vehicle_brand" required><br><br>

    <!-- Modelo del Veh culo -->
    <label for="vehicle_model">Modelo del Veh culo:</label><br>
    <input type="text" id="vehicle_model" name="vehicle_model" required><br><br>

    <!-- Color del Veh culo -->
    <label for="vehicle_color">Color del Veh culo:</label><br>
    <input type="text" id="vehicle_color" name="vehicle_color" required><br><br>

    <!-- Filtro de Zona -->
    <label for="zone_filter">Selecciona la zona:</label><br>
    <select id="zone_filter" name="zone_filter" required>
        <option value="">Selecciona una zona</option>
        <option value="Zona A">Zona A</option>
        <option value="Zona B">Zona B</option>
        <option value="Zona C">Zona C</option>
        <option value="Zona D">Zona D</option>
    </select><br><br>

    <!-- Espacio de Estacionamiento -->
    <label for="parking_space">Espacio de Estacionamiento:</label><br>
    <select id="parking_space" name="parking_space" required>
        <option value="">Selecciona un espacio</option>
        <!-- Aqu  se llenar n los espacios din micamente con JavaScript -->
    </select><br><br>

    <input type="submit" value="Registrar Veh culo">
</form>

<?php
include('conex.php'); // Conexi n a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
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

    // Insertar el veh culo en la base de datos
    $query_insertar = "INSERT INTO vehiculos_registrados 
        (nombre, apellido, edad, sexo, tipo_usuario, patente, marca, modelo, color, espacio_estacionamiento) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($query_insertar);
    $stmt->bind_param("ssisssssss", $owner_first_name, $owner_last_name, $owner_age, $owner_sex, $user_type, $vehicle_plate, $vehicle_brand, $vehicle_model, $vehicle_color, $parking_space);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Veh culo registrado exitosamente.</p>";

        // Obtener el ID del veh culo insertado
        $vehiculo_id = $conexion->insert_id;

        // Insertar en historial_registros
        $query_historial = "INSERT INTO historial_registros (vehiculo_id, patente, espacio_estacionamiento, accion) VALUES (?, ?, ?, 'Entrada')";
        $stmt_historial = $conexion->prepare($query_historial);
        $stmt_historial->bind_param("iss", $vehiculo_id, $vehicle_plate, $parking_space);
        $stmt_historial->execute();
        $stmt_historial->close();

        // Actualizar el espacio de estacionamiento a 'Ocupado'
        $query_actualizar_espacio = "UPDATE INFO1170_Estacionamiento SET Estado = 'Ocupado' WHERE IdEstacionamiento = ?";
        $stmt_actualizar = $conexion->prepare($query_actualizar_espacio);
        $stmt_actualizar->bind_param("s", $parking_space); // 's' para string, ya que IdEstacionamiento es varchar
        if ($stmt_actualizar->execute()) {
            echo "<p>Espacio de estacionamiento actualizado correctamente.</p>";
        } else {
            echo "<p style='color:red;'>Error al actualizar el estado del espacio.</p>";
        }
        $stmt_actualizar->close();

    } else {
        echo "<p style='color:red;'>Error al registrar el veh culo: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<script>
// JavaScript para filtrar los espacios de estacionamiento seg n la zona seleccionada
document.getElementById('zone_filter').addEventListener('change', function() {
    var zone = this.value;
    var parkingSpaceSelect = document.getElementById('parking_space');
    
    // Limpiar opciones previas
    parkingSpaceSelect.innerHTML = '<option value="">Selecciona un espacio</option>';

    if (zone) {
        // Realizar una petici n AJAX para obtener los espacios de la zona seleccionada
        fetch('get_parking_spaces.php?zone=' + zone)
            .then(response => response.json())
            .then(data => {
                // Agregar las opciones de los espacios disponibles a la lista desplegable
                data.forEach(space => {
                    var option = document.createElement('option');
                    option.value = space.IdEstacionamiento;
                    option.textContent = space.IdEstacionamiento;
                    parkingSpaceSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al obtener los espacios:', error));
    }
});
</script>

<?php include('pie.php'); ?>

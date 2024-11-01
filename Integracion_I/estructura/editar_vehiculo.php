<?php
include('cabecera.php');
include('conex.php');

// verifica si se pasa un id en la url
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM vehiculos_registrados WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $vehicle = $result->fetch_assoc();
    $stmt->close();
    
    if (!$vehicle) {
        echo "<script>alert('Registro no encontrado'); window.location.href='ver_registros_vehiculos.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID no proporcionado'); window.location.href='ver_registros_vehiculos.php';</script>";
    exit;
}

// Procesar la actualización del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $owner_first_name = $_POST['owner_first_name'];
    $owner_last_name = $_POST['owner_last_name'];
    $owner_age = $_POST['owner_age'];
    $owner_sex = $_POST['owner_sex'];
    $user_type = $_POST['user_type'];
    $vehicle_plate = $_POST['vehicle_plate'];
    $vehicle_brand = $_POST['vehicle_brand'];
    $vehicle_model = $_POST['vehicle_model'];
    $vehicle_color = $_POST['vehicle_color'];
    $parking_space = $_POST['parking_space'];

    $update_query = "UPDATE vehiculos_registrados SET nombre = ?, apellido = ?, edad = ?, sexo = ?, tipo_usuario = ?, patente = ?, marca = ?, modelo = ?, color = ?, espacio_estacionamiento = ? WHERE id = ?";
    $stmt = $conexion->prepare($update_query);
    $stmt->bind_param("ssisssssssi", $owner_first_name, $owner_last_name, $owner_age, $owner_sex, $user_type, $vehicle_plate, $vehicle_brand, $vehicle_model, $vehicle_color, $parking_space, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Registro actualizado exitosamente'); window.location.href='ver_registros_vehiculos.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el registro');</script>";
    }
    $stmt->close();
}

$conexion->close();
?>

<h2 class="text-center my-4">Editar Registro de Vehículo</h2>

<div class="container">
    <form action="" method="POST">
        <label for="owner_first_name">Nombre del propietario:</label>
        <input type="text" id="owner_first_name" name="owner_first_name" value="<?php echo htmlspecialchars($vehicle['nombre']); ?>" required><br><br>

        <label for="owner_last_name">Apellido del propietario:</label>
        <input type="text" id="owner_last_name" name="owner_last_name" value="<?php echo htmlspecialchars($vehicle['apellido']); ?>" required><br><br>

        <label for="owner_age">Edad del Propietario:</label>
        <input type="number" id="owner_age" name="owner_age" value="<?php echo htmlspecialchars($vehicle['edad']); ?>" required><br><br>

        <label for="owner_sex">Sexo:</label>
        <select id="owner_sex" name="owner_sex" required>
            <option value="Masculino" <?php if ($vehicle['sexo'] == 'Masculino') echo 'selected'; ?>>Masculino</option>
            <option value="Femenino" <?php if ($vehicle['sexo'] == 'Femenino') echo 'selected'; ?>>Femenino</option>
        </select><br><br>

        <label for="user_type">Tipo de Usuario:</label>
        <select id="user_type" name="user_type" required>
            <option value="profesor" <?php if ($vehicle['tipo_usuario'] == 'profesor') echo 'selected'; ?>>Profesor</option>
            <option value="alumno" <?php if ($vehicle['tipo_usuario'] == 'alumno') echo 'selected'; ?>>Alumno</option>
            <option value="visita" <?php if ($vehicle['tipo_usuario'] == 'visita') echo 'selected'; ?>>Visita</option>
        </select><br><br>

        <label for="vehicle_plate">Patente del Vehículo:</label>
        <input type="text" id="vehicle_plate" name="vehicle_plate" value="<?php echo htmlspecialchars($vehicle['patente']); ?>" required><br><br>

        <label for="vehicle_brand">Marca del Vehículo:</label>
        <input type="text" id="vehicle_brand" name="vehicle_brand" value="<?php echo htmlspecialchars($vehicle['marca']); ?>" required><br><br>

        <label for="vehicle_model">Modelo del Vehículo:</label>
        <input type="text" id="vehicle_model" name="vehicle_model" value="<?php echo htmlspecialchars($vehicle['modelo']); ?>" required><br><br>

        <label for="vehicle_color">Color del Vehículo:</label>
        <input type="text" id="vehicle_color" name="vehicle_color" value="<?php echo htmlspecialchars($vehicle['color']); ?>" required><br><br>

        <label for="parking_space">Espacio de Estacionamiento:</label>
        <input type="text" id="parking_space" name="parking_space" value="<?php echo htmlspecialchars($vehicle['espacio_estacionamiento']); ?>" required><br><br>

        <input type="submit" value="Actualizar Vehículo" class="btn btn-primary">
    </form>
</div>

<?php include('pie.php'); ?>

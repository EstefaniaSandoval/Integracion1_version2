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
    $owner_first_name = strtoupper($_POST['owner_first_name']);
    $owner_last_name = strtoupper($_POST['owner_last_name']);
    $owner_age = $_POST['owner_age'];
    $owner_sex = $_POST['owner_sex'];
    $user_type = $_POST['user_type'];
    $vehicle_plate = strtoupper($_POST['vehicle_plate']);
    $vehicle_brand = strtoupper($_POST['vehicle_brand']);
    $parking_space = strtoupper($_POST['parking_space']);

    $update_query = "UPDATE vehiculos_registrados SET nombre = ?, apellido = ?, edad = ?, sexo = ?, tipo_usuario = ?, patente = ?, marca = ?, espacio_estacionamiento = ? WHERE id = ?";
    $stmt = $conexion->prepare($update_query);
    $stmt->bind_param("ssisssssi", $owner_first_name, $owner_last_name, $owner_age, $owner_sex, $user_type, $vehicle_plate, $vehicle_brand, $parking_space, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Registro actualizado exitosamente'); window.location.href='ver_registros_vehiculos.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el registro');</script>";
    }
    $stmt->close();
}

$conexion->close();
?>

<link rel="stylesheet" href="../css/estilos_footer.css">
<h2 class="text-center my-4">Editar Registro de Vehículo</h2>

<div class="container">
    <form action="" method="POST">
        <label for="owner_first_name">Nombre del propietario:</label>
        <input type="text" id="owner_first_name" name="owner_first_name" 
               value="<?php echo htmlspecialchars($vehicle['nombre']); ?>" 
               style="text-transform: uppercase;" required><br><br>

        <label for="owner_last_name">Apellido del propietario:</label>
        <input type="text" id="owner_last_name" name="owner_last_name" 
               value="<?php echo htmlspecialchars($vehicle['apellido']); ?>" 
               style="text-transform: uppercase;" required><br><br>

        <label for="owner_age">Edad del Propietario:</label>
        <input type="number" id="owner_age" name="owner_age" 
               value="<?php echo htmlspecialchars($vehicle['edad']); ?>" required><br><br>

        <label for="owner_sex">Sexo:</label>
        <select id="owner_sex" name="owner_sex" required>
            <option value="Masculino" <?php if ($vehicle['sexo'] == 'Masculino') echo 'selected'; ?>>MASCULINO</option>
            <option value="Femenino" <?php if ($vehicle['sexo'] == 'Femenino') echo 'selected'; ?>>FEMENINO</option>
        </select><br><br>

        <label for="user_type">Tipo de Usuario:</label>
        <select id="user_type" name="user_type" required>
            <option value="profesor" <?php if ($vehicle['tipo_usuario'] == 'profesor') echo 'selected'; ?>>PROFESOR</option>
            <option value="alumno" <?php if ($vehicle['tipo_usuario'] == 'alumno') echo 'selected'; ?>>ALUMNO</option>
            <option value="visita" <?php if ($vehicle['tipo_usuario'] == 'visita') echo 'selected'; ?>>VISITA</option>
        </select><br><br>

        <label for="vehicle_plate">Patente del Vehículo:</label>
        <input type="text" id="vehicle_plate" name="vehicle_plate" 
               value="<?php echo htmlspecialchars($vehicle['patente']); ?>" 
               style="text-transform: uppercase;" required><br><br>

        <label for="vehicle_brand">Marca del Vehículo:</label>
        <input type="text" id="vehicle_brand" name="vehicle_brand" 
               value="<?php echo htmlspecialchars($vehicle['marca']); ?>" 
               style="text-transform: uppercase;" required><br><br>

        <label for="parking_space">Espacio de Estacionamiento:</label>
        <input type="text" id="parking_space" name="parking_space" 
               value="<?php echo htmlspecialchars($vehicle['espacio_estacionamiento']); ?>" 
               style="text-transform: uppercase;" required><br><br>

        <input type="submit" value="Actualizar Vehículo" class="btn btn-primary">
    </form>
</div>

<footer>
        <!-- Primera Columna -->
        <div class="footer">

            <!-- Primera Columna -->
            <div class="footer-column">
                <h3>Redes Sociales</h3>
                <div class="social-icons">
                    <a href="https://www.instagram.com/uctemuco/"><img src="../img/footer/instagram.png" alt="Instagram"></a>
                    <a href="https://www.facebook.com/canaluctemuco"><img src="../img/footer/facebook.png" alt="Facebook"></a>
                    <a href="https://twitter.com/uctemuco"><img src="../img/footer/Twitter.png" alt="Twitter"></a>
                    <a href="https://www.youtube.com/user/canaluctemuco"><img src="../img/footer/youtube.png" alt="Youtube"></a>
                </div>
            </div>

            <!-- Segunda Columna -->
            <div class="footer-column">
                <h3>Contáctanos</h3>
                <div class="contactos">
                    <a href="mailto:info@uct.cl">
                        <img src="../img/footer/correo.png" alt="Correo">
                        info@uct.cl
                    </a>
                    <a href="https://maps.app.goo.gl/UpF5DKgBwauTYQys8">
                        <img src="../img/footer/ubicacion.png" alt="Ubicación">
                        Rudecindo Ortega 2959, Temuco
                    </a>
                </div>
            </div>

            <!-- Tercera Columna -->
            <div class="footer-column">
                <h3>Información</h3>
                <div class="info">
                    <a href="terminos.php">
                        <img src="../img/footer/terminos.png" alt="Términos y Condiciones">
                        Términos y Condiciones
                    </a>
                    <a href="https://www.uct.cl/">
                        <img src="../img/footer/oficial.png" alt="Página oficial UCT">
                        Página oficial UCT
                    </a>
                </div>
            </div>

            <!-- Columna Imagen -->
            <div class="footer-column">
                <div class="ing-logo">

                    <img src="../img/footer/uct_inf.png" alt="inf">
                </div> 
            </div>
        </div>

        <!-- Parte de abajo -->
        <div class="derechos-reservados">
            &copy; 2024 Universidad Católica de Temuco. Todos los derechos reservados.
        </div>
</footer>

<?php include('pie.php'); ?>

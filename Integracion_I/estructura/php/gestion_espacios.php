<?php include('cabecera.php'); ?>

<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="../css/estilos_footer.css">
<h2>Gestión de Espacios</h2>

<form action="gestion_espacios.php" method="POST">
    <!-- ID del Espacio -->
    <label for="space_id">ID del Espacio de Estacionamiento:</label><br>
    <input type="text" id="space_id" name="space_id" required><br><br>

    <!-- Ubicación -->
    <label for="location">Ubicación:</label><br>
    <input type="text" id="location" name="location" required><br><br>

    <!-- Estado -->
    <label for="state">Disponibilidad:</label><br>
    <select id="state" name="state" required>
        <option value="Libre">Libre</option>
        <option value="Ocupado">Ocupado</option>
    </select><br><br>

    <!-- Espacio para discapacitados -->
    <label for="disabled">Preferencial:</label>
    <input type="checkbox" id="disabled" name="disabled"><br><br>

    <input type="submit" value="Añadir Espacio">
</form>
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


<?php

// Simulando la existencia del array de espacios de estacionamiento
$parking_spaces = [
    'A1' => ['estado' => 'Libre', 'discapacitado' => false],
    'A2' => ['estado' => 'Ocupado', 'discapacitado' => false],
    'B1' => ['estado' => 'Libre', 'discapacitado' => true],
    'B2' => ['estado' => 'Ocupado', 'discapacitado' => false]
];


include('conex.php'); // Conexión con la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_estac = $_POST['space_id'];
    $ubicacion = $_POST['location'];
    $disponibilidad = $_POST['state'];
    $preferencial = isset($_POST['disabled']) ? 1 : 0; // 1 si está marcada la casilla, 0 si no

    // Comprobar si el espacio ya existe
    $check_sql = "SELECT IdEstacionamiento FROM Estacionamientos WHERE IdEstacionamiento = ?";
    $stmt_check = $conexion->prepare($check_sql);

    if (!$stmt_check) {
        die("Error al preparar la consulta de verificación: " . $conexion->error);
    }

    // Enlazar el parámetro para la verificación 
    $stmt_check->bind_param("s", $id_estac);

    // Ejecutar la consulta de verificación
    $stmt_check->execute();

    // Obtener el resultado de la consulta
    $stmt_check->store_result();
    if ($stmt_check->num_rows > 0) {
        echo "El espacio de estacionamiento con ID $id_estac ya existe.";
    } else {
        // Si el espacio no existe, proceder con la inserción
        $sql_insert = "INSERT INTO Estacionamientos (IdEstacionamiento, ubicacion, disponibilidad, preferencial) 
                       VALUES (?, ?, ?, ?)";
        
        // Preparar la consulta de inserción
        $stmt_insert = $conexion->prepare($sql_insert);

        if (!$stmt_insert) {
            die("Error al preparar la consulta de inserción: " . $conexion->error);
        }

        // Aquí aseguramos que bind_param use "sssi"
        $stmt_insert->bind_param("sssi", $id_estac, $ubicacion, $disponibilidad, $preferencial);

        if ($stmt_insert->execute()) {
            echo "Datos insertados correctamente.";
        } else {
            echo "Error al insertar los datos: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
}

$conexion->close();
?>

<?php include('pie.php'); ?>
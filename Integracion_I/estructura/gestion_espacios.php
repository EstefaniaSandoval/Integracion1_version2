<?php include('cabecera.php'); ?>

<h2>Gestión de Espacios</h2>

<form action="gestion_espacios.php" method="POST">
    <!-- ID del Espacio -->
    <label for="space_id">ID del Espacio de Estacionamiento:</label><br>
    <input type="text" id="space_id" name="space_id" required><br><br>

    <!-- Ubicación -->
    <label for="location">Ubicación:</label><br>
    <input type="text" id="location" name="location" required><br><br>

    <!-- Estado -->
    <label for="state">Estado:</label><br>
    <select id="state" name="state" required>
        <option value="Libre">Libre</option>
        <option value="Ocupado">Ocupado</option>
    </select><br><br>

    <!-- Espacio para discapacitados -->
    <label for="disabled">Preferencial:</label>
    <input type="checkbox" id="disabled" name="disabled"><br><br>

    <input type="submit" value="Añadir Espacio">
</form>

<?php
// Simulando la existencia del array de espacios de estacionamiento
$parking_spaces = [
    'A1' => ['estado' => 'Libre', 'discapacitado' => false],
    'A2' => ['estado' => 'Ocupado', 'discapacitado' => false],
    'B1' => ['estado' => 'Libre', 'discapacitado' => true],
    'B2' => ['estado' => 'Ocupado', 'discapacitado' => false]
];

// Lógica de PHP para manejar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $space_id = $_POST['space_id'];
    $location = $_POST['location'];
    $state = $_POST['state'];
    $disabled = isset($_POST['disabled']) ? true : false;

    // Comprobar si el espacio ya existe
    $check_sql = "SELECT * FROM Estacionamiento WHERE IdEstacionamiento = '$space_id'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "<p style='color:red;'>Error: El ID del espacio ya existe.</p>";
    } else {
        // Convertir el estado y el campo preferencial a valores adecuados
        $availability = $state === 'Libre' ? 1 : 0; // 1 para Libre, 0 para Ocupado
        $preferential = $disabled ? 1 : 0; // 1 para sí, 0 para no

        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO Estacionamiento (IdEstacionamiento, ubicacion, preferenciales, disponibilidad) 
            VALUES ('$space_id', '$location', '$preferential', '$availability')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:green;'>Espacio de estacionamiento añadido exitosamente.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

// Cerrar la conexión
$conn->close();
?>

<?php include('pie.php'); ?>
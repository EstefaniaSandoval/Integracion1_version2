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
    <label for="disabled">Espacio para Discapacitados:</label>
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

    // Verifica si el espacio no existe ya
    if (!isset($parking_spaces[$space_id])) {
        // Agregar el nuevo espacio
        $parking_spaces[$space_id] = [
            'estado' => $state,
            'discapacitado' => $disabled,
            'ubicacion' => $location
        ];

        echo "<p style='color:green;'>Espacio de estacionamiento añadido exitosamente.</p>";
    } else {
        echo "<p style='color:red;'>Error: El ID del espacio ya existe.</p>";
    }
}
?>

<?php include('pie.php'); ?>

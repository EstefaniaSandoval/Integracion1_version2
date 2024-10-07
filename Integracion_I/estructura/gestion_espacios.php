<?php include('cabecera.php'); ?>

<h2>Gestión de Espacios</h2>
<form action="gestion_espacios.php" method="POST">
    <label for="space_id">ID del Espacio de Estacionamiento:</label><br>
    <input type="text" id="space_id" name="space_id" required><br><br>

    <label for="space_id">Ubicacion:</label><br>
    <input type="text" id="space_id" name="space_id" required><br><br>

    <label for="state">Estado:</label><br>
    <select id="state" name="state">
        <option value="Libre">Libre</option>
        <option value="Ocupado">Ocupado</option>
    </select><br><br>

    <label for="disabled">Espacio para Discapacitados:</label>
    <input type="checkbox" id="disabled" name="disabled"><br><br>

    <label for="space_id">Patente:</label><br>
    <input type="text" id="space_id" name="space_id" required><br><br>

    <input type="submit" value="Añadir Espacio">
</form>

<?php
// Lógica de PHP para manejar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $space_id = $_POST['space_id'];
    $state = $_POST['state'];
    $disabled = isset($_POST['disabled']) ? true : false;

    // Verifica si el espacio no existe ya y lo agrega
    if (!isset($parking_spaces[$space_id])) {
        $parking_spaces[$space_id] = [
            'estado' => $state,
            'discapacitado' => $disabled
        ];
        echo "Espacio de estacionamiento añadido exitosamente.";
    } else {
        echo "El ID del espacio ya existe.";
    }
}
?>

<?php include('pie.php'); ?>

<?php include('cabecera.php'); ?>

<h2>Registro de Vehículos</h2>
<form action="registro_vehiculos.php" method="POST">
    <label for="owner_name">Nombre del Propietario:</label><br>
    <input type="text" id="owner_name" name="owner_name" required><br><br>

    <label for="vehicle_plate">Patente del Vehículo:</label><br>
    <input type="text" id="vehicle_plate" name="vehicle_plate" required><br><br>

    <label for="parking_space">Espacio de Estacionamiento:</label><br>
    <select id="parking_space" name="parking_space" required>
        <?php
        // reemplazar con los espacios disponibles en base de datos
        foreach ($parking_spaces as $space_id => $space) {
            if ($space['estado'] === 'Libre') {
                echo "<option value='$space_id'>$space_id</option>";
            }
        }
        ?>
    </select><br><br>

    <input type="submit" value="Registrar Vehículo">
</form>

<?php
// Lógica de PHP para manejar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $owner_name = $_POST['owner_name'];
    $vehicle_plate = $_POST['vehicle_plate'];
    $parking_space = $_POST['parking_space'];

    // Verifica si el espacio está libre y registra el vehículo
    if ($parking_spaces[$parking_space]['estado'] === 'Libre') {
        $vehicles[] = [
            'owner_name' => $owner_name,
            'vehicle_plate' => $vehicle_plate,
            'parking_space' => $parking_space
        ];
        $parking_spaces[$parking_space]['estado'] = 'Ocupado';
        echo "Vehículo registrado exitosamente.";
    } else {
        echo "El espacio seleccionado no está disponible.";
    }
}
?>

<?php include('pie.php'); ?>

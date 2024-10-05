<?php include('cabecera.php'); ?>
<!--Cuando esté listo para conectar la base de datos, 
solo se necesitará reemplazar los arrays simulados por las consultas SQL.--->
<h1>Gestión de Estacionamiento</h1>

<!-- Simulando datos de espacios de estacionamiento -->
<?php
$parking_spaces = [
    'A1' => ['estado' => 'Libre', 'discapacitado' => false],
    'A2' => ['estado' => 'Ocupado', 'discapacitado' => false],
    'B1' => ['estado' => 'Libre', 'discapacitado' => true],
    'B2' => ['estado' => 'Ocupado', 'discapacitado' => false]
];

// Simulando datos de vehículos registrados
$vehicles = [
    ['propietario' => 'Juan Pérez', 'patente' => 'ABC123', 'espacio_id' => 'A2', 'entrada' => '2024-09-12 08:30'],
    ['propietario' => 'Ana García', 'patente' => 'XYZ789', 'espacio_id' => 'B2', 'entrada' => '2024-09-12 09:15']
];

// Resumen de los espacios de estacionamiento
$total_spaces = count($parking_spaces);
$libres = count(array_filter($parking_spaces, fn($space) => $space['estado'] == 'Libre'));
$ocupados = $total_spaces - $libres;
?>

<!-- Resumen de espacios -->
<h2>Resumen de Espacios</h2>
<p>Total de espacios: <?= $total_spaces; ?></p>
<p>Espacios libres: <?= $libres; ?></p>
<p>Espacios ocupados: <?= $ocupados; ?></p>

<!-- Registros recientes de vehículos -->
<h2>Vehículos Registrados Recientemente</h2>
<table>
    <thead>
        <tr>
            <th>Propietario</th>
            <th>Patente</th>
            <th>Espacio</th>
            <th>Entrada</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vehicles as $vehicle): ?>
            <tr>
                <td><?= $vehicle['propietario']; ?></td>
                <td><?= $vehicle['patente']; ?></td>
                <td><?= $vehicle['espacio_id']; ?></td>
                <td><?= $vehicle['entrada']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Acciones rápidas -->
<h2>Acciones</h2>
<a href="registro_vehiculos.php" class="btn">Registrar Vehículo</a>
<a href="gestion_espacios.php" class="btn">Gestionar Espacios</a>

<?php include('pie.php'); ?>

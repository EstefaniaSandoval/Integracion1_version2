<?php include('cabecera.php'); ?>
<!-- Cuando esté listo para conectar la base de datos, solo se necesitará reemplazar los arrays simulados por las consultas SQL. -->
<h1>Gestión de Estacionamiento</h1>

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

<style>

    /* espacios totales, disponibles, ocupados */
    .resumen-grid {
        display: flex;
        gap: 20px;
        margin: 20px 0;
    }
    .resumen-box {
        width: 150px;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        text-align: center;
    }
    .total {
        background-color: blue;
    }
    .libres {
        background-color: green;
    }
    .ocupados {
        background-color: red;
    }
    /* estilo tabla */
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-family: Arial, sans-serif;
    }
    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #e0e0e0;
    }
</style>

<!-- Resumen de espacios en cuadros -->
<h2>Resumen de Espacios</h2>
<div class="resumen-grid">
    <div class="resumen-box total">
        Total: <?= $total_spaces; ?>
    </div>
    <div class="resumen-box libres">
        Libres: <?= $libres; ?>
    </div>
    <div class="resumen-box ocupados">
        Ocupados: <?= $ocupados; ?>
    </div>
</div>


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


<h2>Acciones</h2>
<a href="registro_vehiculos.php" class="btn">Registrar Vehículo</a>
<a href="gestion_espacios.php" class="btn">Gestionar Espacios</a>

<?php include('pie.php'); ?>
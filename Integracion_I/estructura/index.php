<?php include('cabecera.php'); ?> 
<h1 class="text-center my-4">Gestión de Estacionamiento</h1>
<link rel="stylesheet" href="styles.css">

<?php
// Simulando datos de espacios de estacionamiento
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
    .resumen-grid {
        display: flex;
        justify-content: space-around;
        margin: 20px 0;
    }
    .resumen-box {
        width: 150px;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        font-size: 18px;
        font-weight: bold;
        color: white;
        text-align: center;
    }
    .total { background-color: #007bff; } /* Azul para el total */
    .libres { background-color: #28a745; } /* Verde para libres */
    .ocupados { background-color: #dc3545; } /* Rojo para ocupados */
    
    /* Estilo de tabla */
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
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #e0e0e0;
    }
    
    /* Botones de acción */
    .acciones {
        display: flex;
        justify-content: space-around;
        margin-top: 30px;
    }
    .btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .btn:hover {
        background-color: #0056b3;
    }
</style>

<!-- Resumen de espacios en cuadros -->
<h2 class="text-center">Resumen de Espacios</h2>
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

<!-- Tabla de Vehículos Registrados -->
<h2 class="text-center">Vehículos Registrados Recientemente</h2>
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

<!-- Botones de acción -->
<h2 class="text-center">Acciones</h2>
<div class="acciones">
    <a href="registro_vehiculos.php" class="btn">Registrar Vehículo</a>
    <a href="gestion_espacios.php" class="btn">Gestionar Espacios</a>
</div>

<?php include('pie.php'); ?>

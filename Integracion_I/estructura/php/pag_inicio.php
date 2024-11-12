<?php include('cabecera.php'); ?>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

include('conex.php');

$parking_query = "SELECT Estado FROM INFO1170_Estacionamiento";
$parking_result = $conexion->query($parking_query);

$total_spaces = $parking_result->num_rows;
$libres = 0;
$ocupados = 0;

while ($row = $parking_result->fetch_assoc()) {
    if ($row['Estado'] === 'Disponible') {
        $libres++;
    } else {
        $ocupados++;
    }
}

$vehicle_query = "
    SELECT CONCAT(nombre, ' ', apellido) AS propietario, patente, espacio_estacionamiento AS espacio_id, NOW() AS entrada
    FROM vehiculos_registrados
    ORDER BY id DESC
    LIMIT 5";
$vehicle_result = $conexion->query($vehicle_query);
?>

<link rel="stylesheet" href="../css/styles.css">

<!-- Gráficos circulares -->
<h2 class="text-center">Resumen de espacios</h2>
<div class="chart-wrapper">
    <div class="chart-container">
        <canvas id="totalChart"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="libresChart"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="ocupadosChart"></canvas>
    </div>
</div>

<!-- Tabla de Vehículos Registrados -->
<div class="table-container">
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
            <?php if ($vehicle_result->num_rows > 0): ?>
                <?php while ($vehicle = $vehicle_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($vehicle['propietario']); ?></td>
                        <td><?= htmlspecialchars($vehicle['patente']); ?></td>
                        <td><?= htmlspecialchars($vehicle['espacio_id']); ?></td>
                        <td><?= htmlspecialchars($vehicle['entrada']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">No hay registros de vehículos recientes.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Botones de acción -->
<div class="acciones">
    <a href="registro_vehiculos.php" class="btn">Registrar Vehículo</a>
    <a href="gestion_espacios.php" class="btn">Gestionar Espacios</a>
</div>

<footer class="main-footer">
    <p>&copy; 2024 Universidad Católica de Temuco. Todos los derechos reservados.</p>
    <p>
        <a href="https://www.uct.cl" target="_blank">Página oficial UCT</a> |
        <a href="mailto:contacto@uct.cl">Contáctanos Aquí</a>
    </p>
</footer>

<?php 
include('pie.php'); 
$conexion->close(); 
?>

<!-- JavaScript para crear los gráficos -->
<script>
    var ctxTotal = document.getElementById('totalChart').getContext('2d');
    var ctxLibres = document.getElementById('libresChart').getContext('2d');
    var ctxOcupados = document.getElementById('ocupadosChart').getContext('2d');

    var totalChart = new Chart(ctxTotal, {
        type: 'pie',
        data: {
            labels: ['Libres', 'Ocupados'],
            datasets: [{
                data: [<?= $libres; ?>, <?= $ocupados; ?>],
                backgroundColor: ['#36a2eb', '#ff6384'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>
</html>

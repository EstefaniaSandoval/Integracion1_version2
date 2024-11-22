<?php
include('cabecera.php');
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

include('conex.php');

// Resumen de espacios
$query_estacionamiento = "
    SELECT 
        COUNT(*) AS total, 
        SUM(CASE WHEN Estado = 'Disponible' THEN 1 ELSE 0 END) AS libres, 
        SUM(CASE WHEN Estado = 'Ocupado' THEN 1 ELSE 0 END) AS ocupados 
    FROM INFO1170_Estacionamiento";
$result_estacionamiento = $conexion->query($query_estacionamiento);
$data_estacionamiento = $result_estacionamiento->fetch_assoc();

// Historial de registros
$query_historial = "
    SELECT 
        id, vehiculo_id, patente, espacio_estacionamiento, fecha, accion 
    FROM historial_registros 
    ORDER BY fecha DESC 
    LIMIT 10";
$result_historial = $conexion->query($query_historial);

// Datos para el gráfico
$query_grafico = "
    SELECT 
        DATE(fecha) AS fecha, 
        SUM(CASE WHEN accion = 'Entrada' THEN 1 ELSE 0 END) AS entradas, 
        SUM(CASE WHEN accion = 'Salida' THEN 1 ELSE 0 END) AS salidas 
    FROM historial_registros 
    GROUP BY DATE(fecha)";
$result_grafico = $conexion->query($query_grafico);

$grafico_datos = [];
while ($row = $result_grafico->fetch_assoc()) {
    $grafico_datos[] = $row;
}
?>

<link rel="stylesheet" href="../css/stylesnew.css">

<div class="main-container">
    <!-- Dashboard con resumen y gráfico -->
    <div class="dashboard">
        <!-- Resumen General -->
        <div class="dashboard-card resumen-container">
            <div class="resumen-card">
                <span class="card-icon"><i class="fas fa-parking"></i></span>
                <div class="card-content">
                    <h3>Total de Espacios</h3>
                    <span class="number"><?= $data_estacionamiento['total'] ?></span>
                </div>
            </div>
            <div class="resumen-card">
                <span class="card-icon available"><i class="fas fa-check-circle"></i></span>
                <div class="card-content">
                    <h3>Espacios Libres</h3>
                    <span class="number"><?= $data_estacionamiento['libres'] ?></span>
                </div>
            </div>
            <div class="resumen-card">
                <span class="card-icon occupied"><i class="fas fa-times-circle"></i></span>
                <div class="card-content">
                    <h3>Espacios Ocupados</h3>
                    <span class="number"><?= $data_estacionamiento['ocupados'] ?></span>
                </div>
            </div>
        </div>

        <!-- Gráfico -->
        <div class="dashboard-card">
            <h2>Gráfico de Movimientos</h2>
            <canvas id="graficoBarras"></canvas>
        </div>
    </div>

    <!-- Historial -->
    <div class="table-card">
        <h2>Historial de Movimientos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Patente</th>
                    <th>Espacio</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_historial->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['patente'] ?></td>
                        <td><?= $row['espacio_estacionamiento'] ?></td>
                        <td><?= $row['fecha'] ?></td>
                        <td><?= $row['accion'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Script para el gráfico -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoBarras').getContext('2d');
    const data = <?= json_encode($grafico_datos) ?>;
    const labels = data.map(item => item.fecha);
    const entradas = data.map(item => item.entradas);
    const salidas = data.map(item => item.salidas);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Entradas',
                    data: entradas,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Salidas',
                    data: salidas,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: { title: { display: true, text: 'Fecha' } },
                y: { title: { display: true, text: 'Cantidad' } }
            }
        }
    });
</script>

<!-- Botones de acción -->
<div class="actions">
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

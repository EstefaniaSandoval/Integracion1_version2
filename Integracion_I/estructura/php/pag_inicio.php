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
<link rel="stylesheet" href="../css/estilos_footer.css">

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
                    <a href="Terminos.html">
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

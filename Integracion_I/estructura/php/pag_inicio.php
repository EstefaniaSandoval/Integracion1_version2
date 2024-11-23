<?php include('cabecera.php'); ?>
<?php include('procesar_patente.php'); ?>
<?php include('logica_main.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Patente y Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/stylesnew.css">
    <style>
        .custom-alert {
            background-color: #e3f2fd;
            border-color: #90caf9;
            color: #0d47a1;
        }
        .container {
            padding: 20px 15px;
        }
        .alert {
            margin-bottom: 15px;
        }
        .actions {
            display: flex;
            justify-content: center;
            gap: 15px; /* Espacio entre los botones */
            margin-top: 20px;
        }
        footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Contenedor del formulario de patente -->
    <div class="container">
        <h2 class="mb-4 text-center">Verificación de Patente</h2>
        <form action="" method="POST" class="w-50 mx-auto">
            <?php if (!empty($alert_message)): ?>
                <div class="alert <?= htmlspecialchars($alert_type) == 'warning' ? 'custom-alert' : 'alert-' . htmlspecialchars($alert_type) ?> alert-dismissible fade show" role="alert">
                    <?= $alert_message ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="vehicle_plate" class="form-label">Ingrese la patente del vehículo:</label>
                <input type="text" id="vehicle_plate" name="vehicle_plate" class="form-control" required oninput="this.value = this.value.toUpperCase()">
                <div class="form-text">Formato válido: "AA1234" o "AAAA12".</div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Verificar Patente</button>
        </form>
    </div>

    <!-- Contenido adicional -->
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



    <!-- Botones de acción -->
    <div class="actions">
        <a href="registro_vehiculos.php" class="btn btn-primary">Registrar Vehículo</a>
        <a href="gestion_espacios.php" class="btn btn-primary">Gestionar Espacios</a>
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

    <?php include('pie.php'); ?>
</body>
</html>


<?php $conexion->close(); ?>

<?php include('cabecera.php'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<h2 class="text-center my-4">Registros de Vehículos</h2>
<div class="container">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Tipo de Usuario</th>
                <th>Patente</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Espacio de Estacionamiento</th>
                <th>Acciones</th> <!-- Nueva columna para los botones -->
            </tr>
        </thead>
        <tbody>
            <?php
            include('conex.php'); 

            // Manejo de la salida del vehículo
            if (isset($_GET['exit_id'])) {
                $id = $_GET['exit_id'];
                $query_vehicle = "SELECT patente, espacio_estacionamiento FROM vehiculos_registrados WHERE id = ?";
                $stmt_vehicle = $conexion->prepare($query_vehicle);
                $stmt_vehicle->bind_param("i", $id);
                $stmt_vehicle->execute();
                $stmt_vehicle->bind_result($patente, $espacio_estacionamiento);
                $stmt_vehicle->fetch();
                $stmt_vehicle->close();

                $query_salida = "INSERT INTO historial_registros (vehiculo_id, patente, espacio_estacionamiento, accion) VALUES (?, ?, ?, 'Salida')";
                $stmt_salida = $conexion->prepare($query_salida);
                $stmt_salida->bind_param("iss", $id, $patente, $espacio_estacionamiento);
                $stmt_salida->execute();
                $stmt_salida->close();

                echo "<script>alert('Registro de salida exitoso'); window.location.href='ver_registros_vehiculos.php';</script>";
            }

            $query = "SELECT id, nombre, apellido, edad, sexo, tipo_usuario, patente, marca, modelo, color, espacio_estacionamiento FROM vehiculos_registrados";
            $result = $conexion->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['edad']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['sexo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tipo_usuario']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['patente']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['color']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['espacio_estacionamiento']) . "</td>";
                    
                    // Botones de acción (editar, eliminar y salida)
                    echo "<td>
                            <a href='editar_vehiculo.php?id=" . $row['id'] . "' class='btn btn-warning'>Editar</a>
                            <a href='ver_registros_vehiculos.php?delete=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro de eliminar este registro?\")' class='btn btn-danger'>Eliminar</a>
                            <a href='ver_registros_vehiculos.php?exit_id=" . $row['id'] . "' class='btn btn-secondary'>Salida</a>
                          </td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11' class='text-center'>No hay registros de vehículos.</td></tr>";
            }

            // Eliminar el registro si el parámetro 'delete' está presente en la URL
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $delete_query = "DELETE FROM vehiculos_registrados WHERE id = ?";
                $stmt = $conexion->prepare($delete_query);
                $stmt->bind_param("i", $id);
                
                if ($stmt->execute()) {
                    echo "<script>alert('Registro eliminado correctamente');</script>";
                    echo "<script>window.location.href='ver_registros_vehiculos.php';</script>";
                } else {
                    echo "<script>alert('Error al eliminar el registro');</script>";
                }
                $stmt->close();
            }

            $conexion->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Tabla de Historial de Registros -->
<h2 class="text-center my-4">Historial de Registros</h2>

<div class="container">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Patente</th>
                <th>Espacio</th>
                <th>Fecha</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('conex.php'); // Conexión a la base de datos para el historial

            $query_historial = "SELECT patente, espacio_estacionamiento, fecha, accion FROM historial_registros ORDER BY fecha DESC";
            $result_historial = $conexion->query($query_historial);

            if ($result_historial->num_rows > 0) {
                while ($row = $result_historial->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['patente']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['espacio_estacionamiento']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['accion']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No hay registros en el historial.</td></tr>";
            }

            $conexion->close();
            ?>
        </tbody>
    </table>
</div>

<?php include('pie.php'); ?>

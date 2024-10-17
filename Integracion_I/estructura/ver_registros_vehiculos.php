<?php include('cabecera.php'); ?>

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
            </tr>
        </thead>
        <tbody>
            <?php
            include('conex.php'); 

            $query = "SELECT nombre, apellido, edad, sexo, tipo_usuario, patente, marca, modelo, color, espacio_estacionamiento FROM vehiculos_registrados";
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
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10' class='text-center'>No hay registros de vehículos.</td></tr>";
            }

            $conexion->close();
            ?>
        </tbody>
    </table>
</div>

<?php include('pie.php'); ?>

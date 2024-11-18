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
                <th>Espacio de Estacionamiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('conex.php');

            // Paginación
            $limit = 10; // Número de registros por página
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            $query = "SELECT id, nombre, apellido, edad, sexo, tipo_usuario, patente, marca, espacio_estacionamiento 
                      FROM vehiculos_registrados 
                      LIMIT $limit OFFSET $offset";
            $result = $conexion->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['nombre']}</td>
                            <td>{$row['apellido']}</td>
                            <td>{$row['edad']}</td>
                            <td>{$row['sexo']}</td>
                            <td>{$row['tipo_usuario']}</td>
                            <td>{$row['patente']}</td>
                            <td>{$row['marca']}</td>
                            <td>{$row['espacio_estacionamiento']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='editar_vehiculo.php?id={$row['id']}'>Editar</a>
                                <a class='btn btn-danger btn-sm' href='eliminar_registro.php?id={$row['id']}'>Eliminar</a>
                                <a class='btn btn-success btn-sm' href='ver_registros_vehiculos.php?exit_id={$row['id']}'>Salida</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9' class='text-center'>No hay registros</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php
        // Obtener el total de registros
        $result_total = $conexion->query("SELECT COUNT(*) AS total FROM vehiculos_registrados");
        $total_rows = $result_total->fetch_assoc()['total'];
        $total_pages = ceil($total_rows / $limit);

        // Generar los enlaces de paginación
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='ver_registros_vehiculos.php?page=$i' class='btn btn-link'>$i</a> ";
        }
        ?>
    </div>
</div>
<?php include('pie.php'); ?>

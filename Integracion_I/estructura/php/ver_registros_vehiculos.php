<?php include('cabecera.php'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/estilos_footer.css">

<h2 class="text-center my-4">Registros de Vehículos</h2>

<div class="container">
    <!-- Bloque de Filtro -->
    <div class="container mb-4">
        <h3>Filtrar Registros</h3>
        <select id="filtro-principal" class="form-control mb-3">
            <option value="">Seleccionar Filtro</option>
            <option value="nombre">Nombre</option>
            <option value="apellido">Apellido</option>
            <option value="patente">Patente</option>
            <option value="espacio_estacionamiento">Espacio de Estacionamiento</option>
            <option value="quitar_filtros">Quitar Filtros</option>
        </select>
        <div id="filtro-opciones" class="mt-3"></div> <!-- Aquí se generarán dinámicamente las opciones -->
    </div>

    <!-- Tabla de Registros -->
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Patente</th>
                <th>Espacio de Estacionamiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tabla-registros">
        <?php
        include('conex.php');

        // Paginación
        $limit = 10; // Número de registros por página
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Variables para el filtro
        $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : null;
        $valor = isset($_GET['valor']) ? $_GET['valor'] : null;

        // Construir la consulta SQL
        $query = "SELECT id, nombre, apellido, patente, espacio_estacionamiento 
                FROM INFO1170_VehiculosRegistrados";

        // Si hay un filtro, agrega una condición WHERE
        if ($filtro && $valor) {
            $query .= " WHERE $filtro LIKE ?";
        }

        $query .= " LIMIT $limit OFFSET $offset";

        // Preparar y ejecutar la consulta
        $stmt = $conexion->prepare($query);
        if ($filtro && $valor) {
            $valor = "%$valor%"; // Usar comodines para búsqueda parcial
            $stmt->bind_param("s", $valor);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        // Mostrar los resultados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nombre']}</td>
                        <td>{$row['apellido']}</td>
                        <td>{$row['patente']}</td>
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

    <!-- Botón para generar PDF -->
    <form action="generar_pdf.php" method="get">
        <input type="hidden" name="page" value="<?php echo isset($_GET['page']) ? $_GET['page'] : 1; ?>">
        <input type="hidden" name="filtro" value="<?php echo isset($_GET['filtro']) ? $_GET['filtro'] : ''; ?>">
        <input type="hidden" name="valor" value="<?php echo isset($_GET['valor']) ? $_GET['valor'] : ''; ?>">
        <button type="submit" class="btn btn-success mb-3">Generar PDF</button>
    </form>

    <!-- Paginación -->
    <div class="pagination">
        <?php
        // Obtener el total de registros
        $result_total = $conexion->query("SELECT COUNT(*) AS total FROM INFO1170_VehiculosRegistrados");
        $total_rows = $result_total->fetch_assoc()['total'];
        $total_pages = ceil($total_rows / $limit);

        // Generar los enlaces de paginación
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='ver_registros_vehiculos.php?page=$i' class='btn btn-link'>$i</a> ";
        }
        ?>
    </div>
</div>

<script>
    document.getElementById('filtro-principal').addEventListener('change', function () {
        const filtro = this.value; // Obtiene el filtro seleccionado
        const opcionesDiv = document.getElementById('filtro-opciones');
        opcionesDiv.innerHTML = ''; // Limpia las opciones previas

        if (filtro) {
            // Si selecciona "Quitar Filtros"
            if (filtro === 'quitar_filtros') {
                opcionesDiv.innerHTML = `
                    <button id="aplicar-filtro" class="btn btn-primary mt-2">Quitar Filtros</button>`;
                
                document.getElementById('aplicar-filtro').addEventListener('click', function () {
                    // Redirigir a la página original sin filtros
                    window.location.href = 'ver_registros_vehiculos.php';
                });

                return; // Salir del resto del código
            }
            
            let campo = '';
            // Genera el campo de entrada según el filtro seleccionado
            if (['nombre', 'apellido', 'patente'].includes(filtro)) {
                campo = `<input type="text" id="filtro-valor" class="form-control" placeholder="Ingrese ${filtro}">`;
        
            } else if (filtro === 'espacio_estacionamiento') {
                campo = `<input type="texto" id="filtro-valor" class="form-control" placeholder="Ingrese espacio de estacionamiento">`;
            }

            if (campo) {
                opcionesDiv.innerHTML = `
                    ${campo}
                    <button id="aplicar-filtro" class="btn btn-primary mt-2">Aplicar Filtro</button>`;
            }

            // Agrega el evento de aplicar filtro
            document.getElementById('aplicar-filtro').addEventListener('click', function () {
                const valor = document.getElementById('filtro-valor').value;
                if (valor) {
                    window.location.href = `ver_registros_vehiculos.php?filtro=${filtro}&valor=${valor}`;
                } else {
                    alert('Por favor, complete el campo para aplicar el filtro.');
                }
            });
        }
    });
</script>

<?php include('pie.php'); ?>
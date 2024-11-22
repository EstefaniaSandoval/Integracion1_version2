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
            <option value="edad">Edad</option>
            <option value="sexo">Sexo</option>
            <option value="tipo_usuario">Tipo de Usuario</option>
            <option value="patente">Patente</option>
            <option value="marca">Marca</option>
            <option value="espacio_estacionamiento">Espacio de Estacionamiento</option>
        </select>
        <div id="filtro-opciones" class="mt-3"></div> <!-- Aquí se generarán dinámicamente las opciones -->
    </div>

    <!-- Tabla de Registros -->
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
        $query = "SELECT id, nombre, apellido, edad, sexo, tipo_usuario, patente, marca, espacio_estacionamiento 
                FROM vehiculos_registrados";

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

<!-- Footer -->
<footer>
    <!-- Contenido del footer tal cual estaba -->
    <div class="footer">
        <!-- Redes sociales -->
        <div class="footer-column">
            <h3>Redes Sociales</h3>
            <div class="social-icons">
                <a href="https://www.instagram.com/uctemuco/"><img src="../img/footer/instagram.png" alt="Instagram"></a>
                <a href="https://www.facebook.com/canaluctemuco"><img src="../img/footer/facebook.png" alt="Facebook"></a>
                <a href="https://twitter.com/uctemuco"><img src="../img/footer/Twitter.png" alt="Twitter"></a>
                <a href="https://www.youtube.com/user/canaluctemuco"><img src="../img/footer/youtube.png" alt="Youtube"></a>
            </div>
        </div>

        <!-- Contacto -->
        <div class="footer-column">
            <h3>Contáctanos</h3>
            <div class="contactos">
                <a href="mailto:info@uct.cl">
                    <img src="../img/footer/correo.png" alt="Correo"> info@uct.cl
                </a>
                <a href="https://maps.app.goo.gl/UpF5DKgBwauTYQys8">
                    <img src="../img/footer/ubicacion.png" alt="Ubicación"> Rudecindo Ortega 2959, Temuco
                </a>
            </div>
        </div>

        <!-- Información -->
        <div class="footer-column">
            <h3>Información</h3>
            <div class="info">
                <a href="terminos.php">
                    <img src="../img/footer/terminos.png" alt="Términos y Condiciones"> Términos y Condiciones
                </a>
                <a href="https://www.uct.cl/">
                    <img src="../img/footer/oficial.png" alt="Página oficial UCT"> Página oficial UCT
                </a>
            </div>
        </div>

        <!-- Logo -->
        <div class="footer-column">
            <div class="ing-logo">
                <img src="../img/footer/uct_inf.png" alt="inf">
            </div>
        </div>
    </div>

    <!-- Derechos reservados -->
    <div class="derechos-reservados">
        &copy; 2024 Universidad Católica de Temuco. Todos los derechos reservados.
    </div>
</footer>

<script>
    document.getElementById('filtro-principal').addEventListener('change', function () {
        const filtro = this.value; // Obtiene el filtro seleccionado
        const opcionesDiv = document.getElementById('filtro-opciones');
        opcionesDiv.innerHTML = ''; // Limpia las opciones previas

        if (filtro) {
            let campo = '';
            // Genera el campo de entrada según el filtro seleccionado
            if (['nombre', 'apellido', 'patente', 'marca'].includes(filtro)) {
                campo = `<input type="text" id="filtro-valor" class="form-control" placeholder="Ingrese ${filtro}">`;
            } else if (filtro === 'edad') {
                campo = `<input type="number" id="filtro-valor" class="form-control" placeholder="Ingrese edad">`;
            } else if (filtro === 'sexo') {
                campo = `
                    <select id="filtro-valor" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>`;
            } else if (filtro === 'tipo_usuario') {
                campo = `
                    <select id="filtro-valor" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="Alumno">Alumno</option>
                        <option value="Profesor">Profesor</option>
                        <option value="Visita">Visita</option>
                    </select>`;
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
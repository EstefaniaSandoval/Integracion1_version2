<?php include('cabecera.php'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/estilos_footer.css">
<h2 class="text-center my-4">Historial de Vehículos</h2>
<div class="container">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Vehículo ID</th>
                <th>Patente</th>
                <th>Espacio de Estacionamiento</th>
                <th>Acción</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('conex.php'); 

            // Paginación
            $limit = 10; // Número de registros por página
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            $query = "SELECT vehiculo_id, patente, espacio_estacionamiento, accion, fecha FROM historial_registros LIMIT $limit OFFSET $offset";
            $result = $conexion->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['vehiculo_id']}</td>
                            <td>{$row['patente']}</td>
                            <td>{$row['espacio_estacionamiento']}</td>
                            <td>{$row['accion']}</td>
                            <td>{$row['fecha']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No hay registros</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php
        $result_total = $conexion->query("SELECT COUNT(*) AS total FROM historial_registros");
        $total_rows = $result_total->fetch_assoc()['total'];
        $total_pages = ceil($total_rows / $limit);

        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='ver_historial_vehiculos.php?page=$i'>$i</a> ";
        }
        ?>
    </div>
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
                    <a href="terminos.php">
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
<?php include('pie.php'); ?>
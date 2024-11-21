<?php include('cabecera.php'); ?>

<link rel="stylesheet" href="../css/registro_vehiculos.css">
<link rel="stylesheet" href="../css/estilos_footer.css">
<h2>Registro de Vehículos</h2>
<form action="registro_vehiculos.php" method="POST">
    <!-- Primera fila: Nombre y Apellido -->
    <div class="form-row">
        <div>
            <label for="owner_first_name">Nombre del propietario:</label>
            <input type="text" id="owner_first_name" name="owner_first_name" required>
        </div>
        <div>
            <label for="owner_last_name">Apellido del propietario:</label>
            <input type="text" id="owner_last_name" name="owner_last_name" required>
        </div>
    </div>

    <!-- Segunda fila: Edad y Sexo -->
    <div class="form-row">
        <div>
            <label for="owner_age">Edad del Propietario:</label>
            <input type="number" id="owner_age" name="owner_age" required>
        </div>
        <div>
            <label for="owner_sex">Sexo:</label>
            <select id="owner_sex" name="owner_sex" required>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </div>
    </div>

    <!-- Tercera fila: Tipo de Usuario y Patente -->
    <div class="form-row">
        <div>
            <label for="user_type">Tipo de Usuario:</label>
            <select id="user_type" name="user_type" required>
                <option value="profesor">Profesor</option>
                <option value="alumno">Alumno</option>
                <option value="visita">Visita</option>
            </select>
        </div>
        <div>
            <label for="vehicle_plate">Patente del Vehículo:</label>
            <input type="text" id="vehicle_plate" name="vehicle_plate" required>
        </div>
    </div>

    <!-- Cuarta fila: Marca del Vehículo y Zona -->
    <div class="form-row">
        <div>
            <label for="vehicle_brand">Marca del Vehículo:</label>
            <select id="vehicle_brand" name="vehicle_brand" class="select-search" required>
                <option value="">Selecciona una marca</option>
            </select>
        </div>
        <div>
            <label for="zone_filter">Selecciona la zona:</label>
            <select id="zone_filter" name="zone_filter" required>
                <option value="">Selecciona una zona</option>
                <option value="Zona A">Zona A</option>
                <option value="Zona B">Zona B</option>
                <option value="Zona C">Zona C</option>
                <option value="Zona D">Zona D</option>
            </select>
        </div>
    </div>

    <!-- Última fila: Espacio de Estacionamiento -->
    <div class="form-row">
        <div>
            <label for="parking_space">Espacio de Estacionamiento:</label>
            <select id="parking_space" name="parking_space" required>
                <option value="">Selecciona un espacio</option>
            </select>
        </div>
    </div>

    <!-- Botón de envío -->
    <div>
        <input type="submit" value="Registrar Vehículo">
    </div>
</form>

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

<script>
// Cargar marcas dinámicamente al cargar la página
document.addEventListener('DOMContentLoaded', function () {
    const brandSelect = document.getElementById('vehicle_brand');

    // Petición AJAX para obtener las marcas de vehículos
    fetch('get_vehicle_brands.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            data.forEach(brand => {
                const option = document.createElement('option');
                option.value = brand.name;
                option.textContent = brand.name;
                brandSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar marcas:', error));
});

// Habilitar búsqueda dentro del select
document.addEventListener('DOMContentLoaded', function () {
    const selectSearch = document.querySelector('.select-search');
    $(selectSearch).select2({
        placeholder: 'Busca una marca',
        allowClear: true
    });
});
</script>

<script>
// JavaScript para filtrar los espacios de estacionamiento según la zona seleccionada
document.getElementById('zone_filter').addEventListener('change', function() {
    var zone = this.value;
    var parkingSpaceSelect = document.getElementById('parking_space');
    
    // Limpiar opciones previas
    parkingSpaceSelect.innerHTML = '<option value="">Selecciona un espacio</option>';

    if (zone) {
        // Realizar una petición AJAX para obtener los espacios de la zona seleccionada
        fetch('get_parking_spaces.php?zone=' + zone)
            .then(response => response.json())
            .then(data => {
                // Agregar las opciones de los espacios disponibles a la lista desplegable
                data.forEach(space => {
                    var option = document.createElement('option');
                    option.value = space.IdEstacionamiento;
                    option.textContent = space.IdEstacionamiento;
                    parkingSpaceSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al obtener los espacios:', error));
    }
});
</script>

<script>
// Convertir a mayúsculas solo los campos de texto
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('input[type="text"], input[type="number"]');

    inputs.forEach(input => {
        input.addEventListener('input', function () {
            this.value = this.value.toUpperCase();
        });
    });
});
</script>




<?php
include('conex.php'); // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $owner_first_name = $_POST['owner_first_name'];
    $owner_last_name = $_POST['owner_last_name'];
    $owner_age = $_POST['owner_age'];
    $owner_sex = $_POST['owner_sex'];
    $vehicle_plate = $_POST['vehicle_plate'];
    $vehicle_brand = $_POST['vehicle_brand'];
    $user_type = $_POST['user_type'];
    $parking_space = $_POST['parking_space'];

    // Insertar el vehículo en la base de datos
    $query_insertar = "INSERT INTO vehiculos_registrados 
        (nombre, apellido, edad, sexo, tipo_usuario, patente, marca, espacio_estacionamiento) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($query_insertar);
    $stmt->bind_param("ssisssss", $owner_first_name, $owner_last_name, $owner_age, $owner_sex, $user_type, $vehicle_plate, $vehicle_brand, $parking_space);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Vehículo registrado exitosamente.</p>";

        // Obtener el ID del vehículo insertado
        $vehiculo_id = $conexion->insert_id;

        // Insertar en historial_registros
        $query_historial = "INSERT INTO historial_registros (vehiculo_id, patente, espacio_estacionamiento, accion) VALUES (?, ?, ?, 'Entrada')";
        $stmt_historial = $conexion->prepare($query_historial);
        $stmt_historial->bind_param("iss", $vehiculo_id, $vehicle_plate, $parking_space);
        $stmt_historial->execute();
        $stmt_historial->close();

        // Actualizar el espacio de estacionamiento a 'Ocupado'
        $query_actualizar_espacio = "UPDATE INFO1170_Estacionamiento SET Estado = 'Ocupado' WHERE IdEstacionamiento = ?";
        $stmt_actualizar = $conexion->prepare($query_actualizar_espacio);
        $stmt_actualizar->bind_param("s", $parking_space); // 's' para string, ya que IdEstacionamiento es varchar
        if ($stmt_actualizar->execute()) {
            echo "<p>Espacio de estacionamiento actualizado correctamente.</p>";
        } else {
            echo "<p style='color:red;'>Error al actualizar el estado del espacio.</p>";
        }
        $stmt_actualizar->close();

    } else {
        echo "<p style='color:red;'>Error al registrar el vehículo: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>


<script>
// JavaScript para filtrar los espacios de estacionamiento según la zona seleccionada
document.getElementById('zone_filter').addEventListener('change', function() {
    var zone = this.value;
    var parkingSpaceSelect = document.getElementById('parking_space');
    
    // Limpiar opciones previas
    parkingSpaceSelect.innerHTML = '<option value="">Selecciona un espacio</option>';

    if (zone) {
        // Realizar una petición AJAX para obtener los espacios de la zona seleccionada
        fetch('get_parking_spaces.php?zone=' + zone)
            .then(response => response.json())
            .then(data => {
                // Agregar las opciones de los espacios disponibles a la lista desplegable
                data.forEach(space => {
                    var option = document.createElement('option');
                    option.value = space.IdEstacionamiento;
                    option.textContent = space.IdEstacionamiento;
                    parkingSpaceSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al obtener los espacios:', error));
    }
});
</script>
<script>
// Convertir a mayúsculas solo los campos de texto
document.addEventListener('DOMContentLoaded', function () {
    // Selecciona solo los campos de texto (input[type="text"] y input[type="number"])
    const inputs = document.querySelectorAll('input[type="text"], input[type="number"]');

    inputs.forEach(input => {
        input.addEventListener('input', function () {
            // Convierte el valor a mayúsculas
            this.value = this.value.toUpperCase();
        });
    });
});
</script>


<?php include('pie.php'); ?>
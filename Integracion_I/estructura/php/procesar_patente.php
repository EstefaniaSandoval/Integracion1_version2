<?php
include('conex.php'); // Conexión a la base de datos

$alert_message = null;
$alert_type = '';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['vehicle_plate'])) {
        $patente = strtoupper(trim($_POST['vehicle_plate']));

        if (preg_match('/^[A-Z]{2}\d{4}$|^[A-Z]{4}\d{2}$/', $patente)) {
            $query = "SELECT * FROM vehiculos_registrados WHERE patente = ?";
            $stmt = $conexion->prepare($query);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
            }

            $stmt->bind_param("s", $patente);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $query_historial = "SELECT * FROM historial_registros WHERE patente = ? AND accion = 'Entrada' AND NOT EXISTS (
                    SELECT 1 FROM historial_registros WHERE patente = ? AND accion = 'Salida' AND fecha > (
                        SELECT MAX(fecha) FROM historial_registros WHERE patente = ? AND accion = 'Entrada'
                    )
                )";
                $stmt_historial = $conexion->prepare($query_historial);
                if (!$stmt_historial) {
                    throw new Exception("Error en la preparación de la consulta de historial: " . $conexion->error);
                }

                $stmt_historial->bind_param("sss", $patente, $patente, $patente);
                $stmt_historial->execute();
                $result_historial = $stmt_historial->get_result();

                if ($result_historial->num_rows > 0) {
                    $alert_message = "El vehículo con la patente <strong>$patente</strong> ya se encuentra dentro del estacionamiento.";
                    $alert_type = "warning";
                } else {
                    $query_estacionamiento = "SELECT IdEstacionamiento FROM INFO1170_Estacionamiento WHERE Estado = 'Disponible' LIMIT 1";
                    $result_estacionamiento = $conexion->query($query_estacionamiento);

                    if (!$result_estacionamiento) {
                        throw new Exception("Error en la consulta de espacios disponibles: " . $conexion->error);
                    }

                    if ($result_estacionamiento->num_rows > 0) {
                        $espacio = $result_estacionamiento->fetch_assoc();
                        $espacio_estacionamiento = $espacio['IdEstacionamiento'];

                        $vehiculo = $result->fetch_assoc();
                        $query_insert_historial = "INSERT INTO historial_registros (vehiculo_id, patente, espacio_estacionamiento, accion, fecha) 
                                                   VALUES (?, ?, ?, 'Entrada', NOW())";
                        $stmt_insert_historial = $conexion->prepare($query_insert_historial);
                        if (!$stmt_insert_historial) {
                            throw new Exception("Error en la preparación de la consulta de inserción: " . $conexion->error);
                        }

                        $stmt_insert_historial->bind_param("iss", $vehiculo['id'], $patente, $espacio_estacionamiento);
                        $stmt_insert_historial->execute();

                        $query_update_estacionamiento = "UPDATE INFO1170_Estacionamiento SET Estado = 'Ocupado' WHERE IdEstacionamiento = ?";
                        $stmt_update_estacionamiento = $conexion->prepare($query_update_estacionamiento);
                        if (!$stmt_update_estacionamiento) {
                            throw new Exception("Error en la preparación de la consulta de actualización de espacio: " . $conexion->error);
                        }

                        $stmt_update_estacionamiento->bind_param("s", $espacio_estacionamiento);
                        $stmt_update_estacionamiento->execute();

                        $alert_message = "El vehículo con la patente <strong>$patente</strong> ha ingresado al estacionamiento en el espacio <strong>$espacio_estacionamiento</strong>.";
                        $alert_type = "success";
                    } else {
                        $alert_message = "No hay espacios disponibles en el estacionamiento.";
                        $alert_type = "warning";
                    }
                }
            } else {
                echo "<script>
                    alert('La patente no está registrada, será redirigido a la página de registro.');
                    window.location.href = 'registro_vehiculos.php?patente=$patente';
                </script>";
                exit;
            }
        } else {
            $alert_message = "La patente ingresada no tiene un formato válido. Debe ser 'AA1234' o 'AAAA12'.";
            $alert_type = "danger";
        }
    }
} catch (Exception $e) {
    $alert_message = "Ha ocurrido un error: " . $e->getMessage();
    $alert_type = "danger";
}
?>

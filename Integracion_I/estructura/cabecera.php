<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Archivo CSS de estilos personalizados -->
    <link rel="stylesheet" href="styles.css">

<!-- Bootstrap CSS desde CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery desde CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JS desde CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


    <title>Registro de Vehículos - Universidad</title>
</head>
<body style="background-color: #e9f7fd;">
    <header class="bg-primary py-3">
        <nav class="navbar navbar-expand-lg navbar-dark container">
            <a class="navbar-brand" href="#">
                <img src="../logo.png" alt="Logo Universidad" width="170" height="60"> <!-- Logo de la universidad -->
        
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="pag_inicio.php">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="opcionesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </a>
                        <div class="dropdown-menu" aria-labelledby="opcionesDropdown">
                            <a class="dropdown-item" href="registro_vehiculos.php">Registro de Vehículos</a>
                            <a class="dropdown-item" href="gestion_espacios.php">Gestión de Espacios</a>
                            <a class="dropdown-item" href="informe_ocupacion.php">Informe de Ocupación</a>
                            <a class="dropdown-item" href="ver_registros_vehiculos.php">Ver Registros de Vehículos</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
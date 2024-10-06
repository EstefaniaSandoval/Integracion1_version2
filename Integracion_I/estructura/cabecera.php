
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Estacionamiento</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        header { background-color: #333; padding: 10px 0; }
        nav { display: flex; justify-content: center; }
        nav ul { list-style: none; padding: 0; margin: 0; }
        nav ul li { display: inline; }
        nav ul li a { color: white; padding: 10px 20px; text-decoration: none; display: inline-block; }
        nav ul li a:hover { background-color: #555; }

        /* Menú desplegable */
        .dropdown { position: relative; display: inline-block; }
        .dropdown-content { 
            display: none; 
            position: absolute; 
            background-color: #f9f9f9; 
            min-width: 160px; 
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); 
            z-index: 1; 
        }
        .dropdown-content a {
            color: black; 
            padding: 12px 16px; 
            text-decoration: none; 
            display: block;
        }
        .dropdown-content a:hover { background-color: #f1f1f1; }
        .dropdown:hover .dropdown-content { display: block; }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li class="dropdown">
                    <a href="#">Opciones</a>
                    <div class="dropdown-content">
                        <a href="registro_vehiculos.php">Registro de Vehículos</a>
                        <a href="gestion_espacios.php">Gestión de Espacios</a>
                        <a href="informe_ocupacion.php">Informe de Ocupación</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

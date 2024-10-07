
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
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
                        <a href="cambio_de_turno">Cambio de Turno</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <button id="loginBtn">Iniciar Sesión</button> 
            <button id="registerBtn">Registrarse</button> 
        </div>
    </header>
    <div id="loginModal" class="modal"> <!-- Modal oculto para iniciar sesión, aparecerá cuando se haga clic en el botón correspondiente. -->
        <div class="modal-content">
            <span class="close">&times;</span> <!-- Botón para cerrar el modal, representado por una 'X'. -->
            <h2>Iniciar Sesión</h2> <!-- Título del modal de inicio de sesión. -->
            <form id="loginForm"> <!-- Formulario de inicio de sesión. -->
                <label for="loginEmail">Email:</label> <!-- Etiqueta para el campo del email. -->
                <input type="email" id="loginEmail" required> <!-- Campo de entrada de email, es obligatorio. -->
                <label for="loginPassword">Contraseña:</label> <!-- Etiqueta para el campo de contraseña. -->
                <input type="password" id="loginPassword" required> <!-- Campo de entrada de contraseña, es obligatorio. -->
                <button type="submit">Iniciar Sesión</button> <!-- Botón para enviar el formulario de inicio de sesión. -->
            </form>
        </div>
    </div>

    <div id="registerModal" class="modal"> 
        <div class="modal-content">
            <span class="close">&times;</span> <!-- Botón para cerrar el modal, representado por una 'X'. -->
            <h2>Registrarse</h2> 
            <form id="registerForm"> 
                <label for="registerEmail">Email:</label> <!-- Etiqueta para el campo del email. -->
                <input type="email" id="registerEmail" required> <!-- Campo de entrada de email, es obligatorio. -->
                <label for="registerPassword">Contraseña:</label> <!-- Etiqueta para el campo de contraseña. -->
                <input type="password" id="registerPassword" required> <!-- Campo de entrada de contraseña, es obligatorio. -->
                <label for="registerConfirmPassword">Confirmar Contraseña:</label> <!-- Etiqueta para confirmar la contraseña. -->
                <input type="password" id="registerConfirmPassword" required> <!-- Campo de entrada para confirmar la contraseña, es obligatorio. -->
                <button type="submit">Registrarse</button> 
            </form>
        </div>
    </div>

    <script src="Inicio-Register.js"></script>
</body>
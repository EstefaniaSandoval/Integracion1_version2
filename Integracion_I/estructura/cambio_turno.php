<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Turno</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Cambio de Turno</h1>
    
    <!-- Contenedor de pestañas -->
    <div class="tab-container">
        <button class="tablinks" onclick="openTab(event, 'encargado1')">Encargado 1</button>
        <button class="tablinks" onclick="openTab(event, 'encargado2')">Encargado 2</button>
        <button class="tablinks" onclick="openTab(event, 'encargado3')">Encargado 3</button>
    </div>

    <!-- Formulario para el Encargado 1 -->
    <div id="encargado1" class="tabcontent">
        <h2>Encargado 1</h2>
        <form class="encargado-form">
            <label for="name1">Nombre:</label>
            <input type="text" id="name1" name="name1" placeholder="Ingrese nombre del encargado">

            <label for="turno1">Turno:</label>
            <input type="text" id="turno1" name="turno1" placeholder="Ingrese turno">

            <label for="notes1">Notas:</label>
            <textarea id="notes1" name="notes1" placeholder="Ingrese notas del encargado"></textarea>

            <button type="submit" class="btn-save">Guardar</button>
        </form>
    </div>

    <!-- Formulario para el Encargado 2 -->
    <div id="encargado2" class="tabcontent">
        <h2>Encargado 2</h2>
        <form class="encargado-form">
            <label for="name2">Nombre:</label>
            <input type="text" id="name2" name="name2" placeholder="Ingrese nombre del encargado">

            <label for="turno2">Turno:</label>
            <input type="text" id="turno2" name="turno2" placeholder="Ingrese turno">

            <label for="notes2">Notas:</label>
            <textarea id="notes2" name="notes2" placeholder="Ingrese notas del encargado"></textarea>

            <button type="submit" class="btn-save">Guardar</button>
        </form>
    </div>

    <!-- Formulario para el Encargado 3 -->
    <div id="encargado3" class="tabcontent">
        <h2>Encargado 3</h2>
        <form class="encargado-form">
            <label for="name3">Nombre:</label>
            <input type="text" id="name3" name="name3" placeholder="Ingrese nombre del encargado">

            <label for="turno3">Turno:</label>
            <input type="text" id="turno3" name="turno3" placeholder="Ingrese turno">

            <label for="notes3">Notas:</label>
            <textarea id="notes3" name="notes3" placeholder="Ingrese notas del encargado"></textarea>

            <button type="submit" class="btn-save">Guardar</button>
        </form>
    </div>

    <script src="tabs.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <link rel="stylesheet" href="registro.css">
  <!-- partial -->
  <script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
  <script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
</head>
<body>
<!-- partial:index.partial.html -->
<section>
  <div class="form-box">
    <div class="form-value">
      <form action="#">
        <h2>Registrate</h2>
        <div class="inputbox">
            <ion-icon name="person-outline"></ion-icon>
            <input type="text" required>
            <label for="">Nombre Usuario</label>
        </div>
        <div class="inputbox">
          <ion-icon name="mail-outline"></ion-icon>
          <input type="email" required>
          <label for="">Correo</label>
        </div>
        <div class="inputbox">
          <ion-icon name="lock-closed-outline"></ion-icon>
          <input type="password" required>
          <label for="">Contraseña</label>
        </div>
        <div>
        <button>Registrarse</button>
        <div class="register">
          <p>¿Ya tienes una cuenta? <a href="./inicio.php">Inicia Sesion aquí</a></p>
        </div>
      </form>
    </div>
  </div>
</section>
</body>
</html>



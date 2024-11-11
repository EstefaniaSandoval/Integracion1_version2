<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/registro.css">
  <script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
  <script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
</head>
<body>
<section>
  <div class="form-box">
    <div class="form-value">
      <form action="./registrar_user.php" method="POST" id="registerForm">
        <h2>Registrate</h2>
        <div class="inputbox">
            <ion-icon name="person-outline"></ion-icon>
            <input type="text" name="username" required>
            <label for="">Nombre Usuario</label>
        </div>
        <div class="inputbox">
          <ion-icon name="mail-outline"></ion-icon>
          <input type="email" name="email" required>
          <label for="">Correo</label>
        </div>
        <div class="inputbox">
          <ion-icon name="lock-closed-outline"></ion-icon>
          <input type="password" name="password" required>
          <label for="">Contraseña</label>
        </div>
        <button type="submit">Registrarse</button>
        <div class="register">
          <p>¿Ya tienes una cuenta? <a href="./">Inicia Sesión aquí</a></p>
        </div>
      </form>
    </div>
  </div>
</section>
</body>
</html>

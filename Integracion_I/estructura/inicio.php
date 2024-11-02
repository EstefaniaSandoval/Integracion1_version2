<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="./estilo_inicio.css">
  <!-- partial -->
  <script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js' type="module"></script>
  <script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js' type="module"></script>
</head>
<body>
<!-- partial:index.partial.html -->
<section>
  <div class="form-box">
    <div class="form-value">
      <form action="">
        <h2>Inicio Sesión</h2>
        <div class="inputbox">
          <ion-icon name="mail-outline"></ion-icon>
          <input type="text" required>
          <label for="">Nombre Usuario</label>
        </div>
        <div class="inputbox">
          <ion-icon name="lock-closed-outline"></ion-icon>
          <input type="password" required>
          <label for="">Contraseña</label>
        </div>
        <div class="forget">
          <label>
            <input type="checkbox"> Recuérdame
          </label>
          <label>
            <a href="#">¿Olvidaste tu contraseña?</a>
          </label>
        </div>
        <button>Iniciar Sesión</button>
        <div class="register">
          <p>¿No tienes una cuenta? <a href="./registro.php">Registrate por aquí</a></p>
        </div>
      </form>
    </div>
  </div>
</section>
</body>
</html>

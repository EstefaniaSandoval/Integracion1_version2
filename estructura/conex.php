<?php
  $host= "db.inf.uct.cl";
  $user= "dvasquez";
  $password= "aVOeGU27CWrnwXMyx";
  $BD= "A2024_dvasquez";
  $conexion = mysqli_connect($host, $user, $password, $BD);

  // Verificar conexión
  if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
  }
  echo "Conexión exitosa!  ";
?>



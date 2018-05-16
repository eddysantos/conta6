<?php

  $servername = "localhost";
  $db_user = "root";
  $db_pass = "root";
  $db = "pruebas";
  $port = 8888;

  $conn = mysqli_connect($servername,$db_user,$db_pass,$db,$port) or die("Conexion sin exito" . mysqli_error($conn));

?>

<?php
/*
  $servername = "localhost";
  $db_user = "root";
  $db_pass = "root";
  $db = "pruebas";
  $port = 8888;

*/
	$servername = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db = "cplaa_v6";
	$port = 3306;


  $conn = mysqli_connect($servername,$db_user,$db_pass,$db,$port) or die("Conexion sin exito" . mysqli_error($conn));
?>

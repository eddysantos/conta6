<?php




// $servername = "localhost";
// $db_user = "root";
// $db_pass = "";
// $db = "cplaa_v6";
// $port = 3306;

$servername = "localhost";
$db_user = "root";
$db_pass = "root";
$db = "conta6";
$port = 8889;


$db = mysqli_connect($servername,$db_user,$db_pass,$db,$port) or die("Conexion sin exito" . mysqli_error($conn));

?>

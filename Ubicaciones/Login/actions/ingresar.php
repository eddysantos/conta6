<?php

session_start();
$root = $_SERVER['DOCUMENT_ROOT'];

require $root . "/conta6/Resources/PHP/Databases/conexion.php";

$usuario = $conn->real_escape_string($_POST['lg_usuario']);
$contra = $conn->real_escape_string($_POST['lg_password']);

$response = array(
  "code"=>"",
  "msg"=>"",
  "data"=>"",
);

  $query = $conn->query("SELECT * FROM sesiones WHERE usuario = '$usuario' AND password = '$contra'");

  if ($result = mysqli_fetch_array($query)) {
    $_SESSION['u_usuario'] = $usuario;
    $response['code'] = "1";
    $response = json_encode($response);
    echo $response;
    //$redirect = $root . "/conta6/Ubicaciones/Bienvenida.php";
    //header($redirect);
    die();

  }else {
    $response['code']="200";
    $response['msg']="El usuario o contraseña es incorrecto";
  }

  $response = json_encode($response);
  echo $response;

 ?>

<?php
// session_start();

// $root = $_SERVER['DOCUMENT_ROOT'];
// require $root . '/Resources/PHP/Utilities/initialScript.php';
//
// // $usuario = $db->real_escape_string($_POST['lg_usuario']);
// // $contra = $db->real_escape_string($_POST['lg_password']);
// $usuario = $db->real_escape_string($_POST['user']);
// $contra = $db->real_escape_string($_POST['pass']);
//
// $response = array(
//   "code"=>"",
//   "msg"=>"",
//   "data"=>"",
// );
//
//   $query = $db->query("SELECT * FROM conta_cu_permisos WHERE pk_usuario = '$usuario' AND s_pwd = '$contra'");
//
//
//   if ($result = mysqli_fetch_array($query)) {
//     $_SESSION['user'] = $usuario;
//     $response['code'] = "1";
//     $response = json_encode($response);
//     echo $response;
//     die();
//
//   }else {
//     $response['code']="200";
//     $response['msg']="El usuario o contraseña es incorrecto";
//     $response['data'] = mysqli_error($db);
//   }
//
//   $response = json_encode($response);
//   echo $response;





session_start();
$root = $_SERVER['DOCUMENT_ROOT'];

// require $root . '/Resources/PHP/Utilities/initialScript.php';
require $root . '/Resources/PHP/Databases/Conexion.php';


$aduanaSelect = $_POST['aduanaSelect'];
$response = array(
  "code"=>"",
  "msg"=>"",
  "data"=>"",
);


  #if ($results == 1) {
    unset($_SESSION['user']['fk_id_aduana']);
    $_SESSION['user']['fk_id_aduana'] = $aduanaSelect;
    print_r($_SESSION['user']);

    $response['code'] = "1";
    $response = json_encode($response);
    echo $response;
    //die();
  // } else {
  //   $response['code']="200";
     //$response['msg']="El usuario o contraseña es incorrecto";
     //$response['data'] = mysqli_error($db);
  // }

  #$response = json_encode($response);
  #echo $response;


 ?>

<?php
error_reporting(0);

#require $root . '/conta6/Resources/PHP/Utilities/session.php';
$_SESSION['user_name'] = 'admado';
$usuario = $_SESSION['user_name'];
$aduana = 240;
//$aduana = 470;

include($root . '/conta6/Resources/PHP/Databases/Conexion.php');
date_default_timezone_set('America/Monterrey');

 require $root . '/conta6/Resources/PHP/actions/consultaPermisos.php';
 require $root . '/conta6/Resources/PHP/actions/consultaDatosCIA.php';

function exit_script($input_array){
  $json_string = json_encode($input_array);
  echo $json_string;
  global $db;
  $db->close();
  die();

}

// error_reporting(E_ALL);
// $root = $_SERVER['DOCUMENT_ROOT'];
// require $root . '/Conta6/Resources/PHP/Utilities/session.php';
//
//
// session_start();
// if (!isset($_SESSION['user'])) {
//  header("Location: /Conta6/index.php");
// }
//
// $aduana = $_SESSION['user']['fk_id_aduana'];
// $usuario = $_SESSION['user']['pk_usuario'];
//
//
//
// include($root . '/Conta6/Resources/PHP/Databases/Conexion.php');
// date_default_timezone_set('America/Monterrey');
//
// require $root . '/Conta6/Resources/PHP/actions/consultaPermisos.php';
// require $root . '/Conta6/Resources/PHP/actions/consultaDatosCIA.php';
//
// function exit_script($input_array){
//  $json_string = json_encode($input_array);
//  echo $json_string;
//  global $db;
//  $db->close();
//  die();
//
// }


 ?>

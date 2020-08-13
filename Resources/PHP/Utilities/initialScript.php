<?php
error_reporting(0);

error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'];
// require $root . '/Resources/PHP/Utilities/session.php';
require $root . "/Resources/vendor/autoload.php";


// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }


// date_default_timezone_set('America/Monterrey');

session_start();
if (!isset($_SESSION['user'])) {
  header("Location: /conta6/index.php");
}

$aduana = $_SESSION['user']['fk_id_aduana'];
$usuario = $_SESSION['user']['pk_usuario'];



include($root . '/Resources/PHP/Databases/Conexion.php');
date_default_timezone_set('America/Monterrey');

 require $root . '/Resources/PHP/actions/consultaPermisos.php';
 require $root . '/Resources/PHP/actions/consultaDatosCIA.php';

function exit_script($input_array){
  $json_string = json_encode($input_array);
  echo $json_string;
  global $db;
  $db->close();
  die();

}

// error_reporting(E_ALL);
// $root = $_SERVER['DOCUMENT_ROOT'];
// require $root . '/Resources/PHP/Utilities/session.php';
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
// include($root . '/Resources/PHP/Databases/Conexion.php');
// date_default_timezone_set('America/Monterrey');
//
// require $root . '/Resources/PHP/actions/consultaPermisos.php';
// require $root . '/Resources/PHP/actions/consultaDatosCIA.php';
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

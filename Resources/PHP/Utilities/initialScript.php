<?php

error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/session.php';


// session_start();
if (!isset($_SESSION['user'])) {
  header("Location: /conta6/index.php");
}

$aduana = $_SESSION['user']['fk_id_aduana'];
$usuario = $_SESSION['user']['pk_usuario'];



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


 ?>

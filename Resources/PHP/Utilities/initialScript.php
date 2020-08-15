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




// include($root . '/Resources/PHP/Databases/Conexion.php');
// funciones de encriptacion
$cipher = "AES-256-CBC";
$sha = 'sha256';
$hashing = 'ewgdhfjjluo3pip4l';
$hashing_iv = 'sdfkljsadf567890saf';

function encrypt($password = NULL){
  $cipher = "AES-256-CBC";
  $sha = 'sha256';
  $hashing = 'ewgdhfjjluo3pip4l';
  $hashing_iv = 'sdfkljsadf567890saf';
  $key = hash($sha, $hashing);
  $iv = substr(hash($sha, $hashing_iv), 0, 16);
  $token = openssl_encrypt($password, $cipher, $key, 0, $iv);
  $token = base64_encode($token);
  return $token;
}
function decrypt($encrypted){
  $cipher = "AES-256-CBC";
  $sha = 'sha256';
  $hashing = 'ewgdhfjjluo3pip4l';
  $hashing_iv = 'sdfkljsadf567890saf';
  $key = hash($sha, $hashing);
  $iv = substr(hash($sha, $hashing_iv), 0, 16);
  $decrypted = openssl_decrypt(base64_decode($encrypted),$cipher, $key, 0, $iv);
  return $decrypted;
}

$db = new Queryi();

$aduana = $_SESSION['user']['fk_id_aduana'];
$usuario = $_SESSION['user']['pk_usuario'];

// $login_aduana = $_SESSION['user']['fk_id_aduana'];
// $login_pk_usuario = $_SESSION['user']['pk_usuario'];
$lg_pk_usuario_encrypt = encrypt($usuario);
// $login_usuario = $_SESSION['user']['s_usuario'];
$fecha_reg =  date("Y-m-d H:i:s");

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



 ?>

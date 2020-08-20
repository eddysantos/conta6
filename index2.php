<?php
// require $root . '/Resources/php/Utilities/initialScript.php';
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . "/Resources/vendor/autoload.php";

$user_agent = $_SERVER['HTTP_USER_AGENT'];

function isMobileDevice($agent) {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $agent);
}

function encrypt($password = NULL){
  $cipher = "AES-256-CBC";
  $sha = 'sha256';
  $hashing = 'ewgdhfjjluo3pip4l';
  $hashing_iv = 'sdfkljsadf567890saf';

  $key = hash($sha, $hashing);
  $iv = substr(hash($sha, $hashing_iv), 0, 16);
  // $key = hash('sha256', "ewgdhfjjluo3pip4l");
  // $iv = substr(hash('sha256', "sdfkljsadf567890saf"), 0, 16);
  $token = openssl_encrypt($password, $cipher, $key, 0, $iv);
  $token = base64_encode($token);
  return $token;
}
function decrypt($encrypted){
  $cipher = "AES-256-CBC";
  $sha = 'sha256';
  $hashing = 'ewgdhfjjluo3pip4l';
  $hashing_iv = 'sdfkljsadf567890saf';
  // $encrypted = $this->password_input;
  $key = hash($sha, $hashing);
  $iv = substr(hash($sha, $hashing_iv), 0, 16);
  $decrypted = openssl_decrypt(base64_decode($encrypted),$cipher, $key, 0, $iv);
  return $decrypted;
}

$loginToken = $_COOKIE['loginToken'];
$mobile = isMobileDevice($user_agent);
if ($loginToken != "") {
  $login = new Login();
  $login->setToken($loginToken);
  if ($login->login()) {
    header("Location: /bienvenido.php");
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/Resources/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Resources/css/login.css?1">
    <link rel="stylesheet" href="/Resources/css/custom_responsive.css?1">
    <link rel="stylesheet" href="/Resources/sweetalert/css/sweetalert.css">
    <link rel="icon" href="/Resources/iconos/spectrum.ico">

    <title>SpecTools</title>
  </head>
  <body>
    <?php if (isMobileDevice($user_agent)): ?>
      <div class="container">
        <img src="/Resources/imagenes/spectrum_worldwide.svg" class="position-relative my-5" width="100%" class='ml-50'>
        <h2 class="forms_title">Entrar</h2>
        <form id="login-form">
          <div class="forms_field mb-2">
            <input id="usuario" type="text" placeholder="Usuario" class="form-control" required autocomplete="off">
          </div>
          <div class="forms_field mb-2">
            <input id="pwd" type="password" placeholder="Contraseña" class="form-control" required autocomplete="off">
          </div>
          <input type="text" id="intended_uri" name="" hidden value="<?php echo urldecode($_GET['intended']) ?>">
          <button type="button" class="btn btn-dark ingresar_login w-100" name="button">Ingresar</button>
        </form>
      </div>
    <?php else: ?>
      <section class="user">
        <div class="user_options-container">
          <div class="user_options-text">
            <img src="/Resources/imagenes/spectrum_worldwide.svg" class="img-login">
          </div>
          <div class="user_options-forms">
            <div class="user_forms-login">
              <h2 class="forms_title">Entrar</h2>
              <form id="login-form">
                <div class="forms_field">
                  <input id="usuario" type="text" placeholder="Usuario" class="forms_field-input" required autocomplete="off">
                </div>
                <div class="forms_field">
                  <input id="pwd" type="password" placeholder="Contraseña" class="forms_field-input" required autocomplete="off">
                </div>
                <input type="text" id="intended_uri" hidden name="" value="<?php echo urldecode($_GET['intended']) ?>">
                <div class="forms_buttons" align="right">
                  <a href="#" class='forms_buttons-action ingresar_login'>Ingresar</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>

  </body>


<script src="/Resources/jquery/jquery.min.js"></script>
<script src="/login/js/ingresar.js?3"></script>
<script src="/Resources/sweetalert/js/sweetalert.min.js"></script>

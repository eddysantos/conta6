<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="/Resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Resources/fontAwesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Resources/css/loginstyle.css">
    <link href='//fonts.googleapis.com/css?family=Text+Me+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/Resources/sweetalert/css/sweetalert.css">
  </head>
  <body>
    <div class="text-center" style="padding-top:180px">
    	<div class="login-form-1">
        <form id="login-form" class="text-left" onsubmit="return false;" method="post">
          <div class="main-login-form">
            <div class="login-group">
              <label for="lg_usuario"></label>
              <input type="text" placeholder="Usuario" id="lg_usuario" required autocomplete="off">

              <label for="lg_password"></label>
              <input type="password" placeholder="Contraseña" id="lg_password" required autocomplete="off">
            </div>
            <button type="submit" id="loginUsuario" class="login-button"><i class="fa fa-angle-double-right fa-2x"></i></button>
          </div>
        </form>
    	</div>
    </div>
    <script src="/Resources/sweetalert/js/sweetalert.min.js"></script>
    <script src="/Resources/JQuery/jquery.min.js"></script>
    <script src="/Resources/JQuery/popper.min.js"></script>
    <script src="/Resources/JQuery/tether.min.js"></script>
    <script src="/Resources/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Ubicaciones/Login/js/login.js"></script>
  </body>
</html>

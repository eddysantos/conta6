<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>

  <!-- ESTILOS -->
  <link rel="stylesheet" href="/conta6/Resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/conta6/Resources/fontAwesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/conta6/Resources/css/loginstyle.css">
  <!-- Font recordar descargarla -->
  <link href='//fonts.googleapis.com/css?family=Text+Me+One' rel='stylesheet' type='text/css'>

</head>
<body>
  <div class="text-center" style="padding:50px 0">
	<!-- Comienza el formulario-->

  <div class="text-center">
    <div id="loginError" class="alert alert-danger alert-dismissible fade show" style="display: none" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      Usuario o contraseña incorrectos!
    </div>
  </div>

	<div class="login-form-1">
		<form id="login-form" class="text-left">
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="text">
						<label for="lg_usuario"></label>
						<input type="text" class="text" id="lg_usuario" placeholder="Usuario" autocomplete="off" required>
					</div>
					<div class="text">
						<label for="lg_password"></label>
						<input type="password" class="text" id="lg_password" placeholder="Contraseña" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label for="lg_recordar" class="anim">
              <input type="checkbox" class="checkbox" id="lg_recordar" name="lg_recordar">
              Recordar
            </label>
            <label  style="margin-left:70px;">
              <a href="#">olvidaste tu contraseña?</a>
            </label>
					</div>

				</div>
				<button type="submit" class="login-button"><i class="fa fa-angle-double-right fa-2x"></i></button>
			</div>
		</form>
	</div>
	<!-- termino del formulario-->
</div>


<script src="/conta6/Resources/JQuery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="/conta6/Resources/bootstrap/js/bootstrap.min.js"></script>
<script src="/conta6/Ubicaciones/Login/js/login.js"></script>

</body>
</html>

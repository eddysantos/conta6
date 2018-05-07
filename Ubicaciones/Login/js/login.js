$(document).ready(function(){

	$('#login-form').submit(function(){
		var user = $(this).find('#lg_usuario').val();
		var pwd = $(this).find('#lg_password').val();

		$.ajax({
			method: 'POST',
			url: "/conta6/Ubicaciones/Login/actions/ingresar.php",
			data: {
				lg_usuario: user,
				lg_password: pwd
			},
			success: function(result){
				response = jQuery.parseJSON(result);
				switch (response.code) {
					case "200":
						$('#loginError').fadeIn();
						return false;
						break;

					case "1":
						window.location.replace("/conta6/Ubicaciones/Bienvenida.php");
						return false;
						break;

					default:
						alert("Something went terribly wrong");
				}
			},
			error: function(exception){
				console.error(exception);
			}
		});
	});



});

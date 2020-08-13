$(document).ready(function(){

	$('#login-form').submit(function(){
		var user = $(this).find('#lg_usuario').val();
		var pwd = $(this).find('#lg_password').val();

		$.ajax({
			method: 'POST',
			url: "/Ubicaciones/Login/actions/ingresar.php",
			data: {
				lg_usuario: user,
				lg_password: pwd
			},
			success: function(result){
				response = jQuery.parseJSON(result);
				switch (response.code) {
					case "200":
						swal("Usuario o contraseña incorrectos","Favor de Verificar","error");
						console.log(response);
						return false;
						break;

					case "1":
						window.location.replace("/Ubicaciones/Bienvenida.php");
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


// $(document).ready(function(){
//
// 	$('#loginUsuario').click(function(){
// 			var data = {
// 				user : $('#lg_usuario').val(),
// 				pass : $('#lg_password').val()
// 			}
//
// 		$.ajax({
// 			method: 'POST',
// 			url: "/Ubicaciones/Login/actions/ingresar.php",
// 			data: data,
// 			success: function(result){
// 				response = jQuery.parseJSON(result);
// 				console.log(response);
// 				switch (response.code) {
// 					case "200":
// 						swal("Usuario o contraseña incorrectos","Favor de Verificar","error");
// 						return false;
// 						break;
//
// 					case "1":
// 						window.location.replace("/Ubicaciones/Bienvenida.php");
// 						return false;
// 						break;
//
// 					default:
// 						alert("Something went terribly wrong");
// 				}
// 			},
// 			error: function(exception){
// 				console.error(exception);
// 			}
// 		});
// 	});



	// $('#loginUser').click(function(){
	// 	var data = {
	// 		user : $('#lg_usuario').val(),
	// 		pass :$ ('#lg_password').val()
	// 	}
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "/Ubicaciones/Login/actions/ingresar.php",
	// 		data: data,
	// 		success: 	function(r){
	// 			console.log(r);
	// 			r = JSON.parse(r);
	// 			switch (r.code) {
	// 				case "200":
	// 					swal("Usuario o contraseña incorrectos","Favor de Verificar","error");
	// 					console.log(r);
	// 					return false;
	// 					break;
	//
	// 				case "1":
	// 					window.location.replace("/fitcoControl/Ubicaciones/Bienvenido.php");
	// 					return false;
	// 					break;
	//
	// 				default:
	// 					alert("Something went terribly wrong");
	// 			}
	// 		},
	// 		error: function(x){
	// 			console.error(x);
	// 		}
	// 	});
	// });

// });

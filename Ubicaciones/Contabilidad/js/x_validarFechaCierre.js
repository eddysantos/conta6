function validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso){
		var data = {
			diatipo: tipoDoc,
			diaaduana: aduana,
			diafecha: fecha,
			usuario: usuario,
			permiso: permiso
		}

		response = false;

		var validar_fecha = $.ajax({
			type: "POST",
			url: "/conta6/Ubicaciones/Contabilidad/actions/validarFechaCierreDoc.php",
			data: data,
			async: false
		});

		validar_fecha.done(function(r){
			//console.log(r);
			r = JSON.parse(r);
			if (r.code == 1) {
				if(r.data == "fechaValida"){
					response = true;
					//console.log(response);
				}else{
					swal(r.data, "Solicite cambio de fechas a Contabilidad", "info");
					//response = false;
			}
		}
			return response;
	}).fail(function(x){
		console.error(x);
	})

		console.log(response);
		return response;
		;
}

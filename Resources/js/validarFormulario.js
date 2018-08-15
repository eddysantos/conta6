function validarCtaBancaria(Obj){
	ctaBco = $(Obj).val();
	if(ctaBco.match(/^([A-Z0-9_]{10,50})$/i)){
		$(Obj).css("color", "#000000");
		return true;
	}else{
		$(Obj).css("color", "#FF0000");
		alertify.error("Ingrese mínimo 10, máximo 50 caracteres");
		return false;
	}
}

function validaRFC(Obj){
	RFC = $(Obj).val();
	if(RFC.match(/^([A-Z]{4})([0-9]{6})([A-Z0-9]{3})$/i)){
		$(Obj).css("color", "#000000");
		return true;
	}else{
		if(RFC.match(/^([A-Z]{3})([0-9]{6})([A-Z0-9]{3})$/i)){
			$(Obj).css("color", "#000000");
			return true;
		}else{
			if( RFC == 'XAXX010101000' || RFC == 'XEXX010101000' ){
				$(Obj).css("color", "#000000");
				return true;
			}else{
				$(Obj).css("color", "#FF0000");
				alertify.error("RFC formato incorrecto");
				return false;
			}
		}
	}
}

function eliminaBlancosIntermedios(frmObj){
  texto = $(frmObj).val();
  texto = $.trim(texto.replace(/\s+/g," "));
  $(frmObj).val(texto);
}

function todasMayusculas(frmObj){
  texto = $(frmObj).val();
  texto = $.trim(texto.toUpperCase());
  $(frmObj).val(texto);
}

function validaIntDec(frmObj){
	importe = $(frmObj).val();
  importe = $.trim(importe);
	if( String(importe).search(/^\d+$/) != -1 || String(importe).search(/^\d+(\.\d+)?$/) != -1 ){
    $(frmObj).val(importe);
	}else{
		alertify.error("Ingrese solo enteros o decimales");
		$(frmObj).focus();
	}
}

function validaReferencia(frmObj){
  Referencia = $(frmObj).val();
  Referencia = $.trim(Referencia);
	if( (!/^([A-Za-z]\d[0-9]{6,8}|0)$/.test(Referencia)) ){
		if (Referencia == "SN" || Referencia == "sn"){
		    $(frmObj).val(Referencia);
        $(frmObj).attr('db-id',Referencia)
		}else{
			alertify.error("Referencia: Z12345678\nReferencia: 0\nReferencia: SN");
			$(frmObj).focus();
		}
    $(frmObj).val(Referencia);
  }
}

function validaSoloNumeros(frmObj){
  campo = $(frmObj).val();
  campo = $.trim(campo);
  if( (!/^([0-9])*$/.test(campo)) || campo == "" ){
    alertify.error("Ingrese solo numeros")
		$(frmObj).focus();
  }else{
		$(frmObj).val(campo);
  }
}

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

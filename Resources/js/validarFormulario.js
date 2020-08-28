function TildesHtml(cadena){
	var rp = String(cadena);
	//
	rp = rp.replace(/á/g, '&aacute;');
	rp = rp.replace(/é/g, '&eacute;');
	rp = rp.replace(/í/g, '&iacute;');
	rp = rp.replace(/ó/g, '&oacute;');
	rp = rp.replace(/ú/g, '&uacute;');
	rp = rp.replace(/ñ/g, '&ntilde;');
	rp = rp.replace(/ü/g, '&uuml;');
	//
	rp = rp.replace(/Á/g, '&Aacute;');
	rp = rp.replace(/É/g, '&Eacute;');
	rp = rp.replace(/Í/g, '&Iacute;');
	rp = rp.replace(/Ó/g, '&Oacute;');
	rp = rp.replace(/Ú/g, '&Uacute;');
	rp = rp.replace(/Ñ/g, '&Ntilde;');
	rp = rp.replace(/Ü/g, '&Uuml;');
	//
	return rp;
}

function TildesHtml_decode(cadena){
	var rp = String(cadena);
	//
	rp = rp.replace(/&aacute;/g, 'á');
	rp = rp.replace(/&eacute;/g, 'é');
	rp = rp.replace(/&iacute;/g, 'í');
	rp = rp.replace(/&oacute;/g, 'ó');
	rp = rp.replace(/&uacute;/g, 'ú');
	rp = rp.replace(/&ntilde;/g, 'ñ');
	rp = rp.replace(/&uuml;/g, 'ü');
	//
	rp = rp.replace(/&Aacute;/g, 'Á');
	rp = rp.replace(/&Eacute;/g, 'É');
	rp = rp.replace(/&Iacute;/g, 'Í');
	rp = rp.replace(/&Oacute;/g, 'Ó');
	rp = rp.replace(/&Uacute;/g, 'Ú');
	rp = rp.replace(/&Ñtilde;/g, 'Ñ');
	rp = rp.replace(/&Üuml;/g, 'Ü');
	//
	return rp;
};

function cortarDecimalesObj(frmObj,truncar){
	num = $(frmObj).val();
	n = num.toString();

	if(n.indexOf('.') != -1){
		elem = n.split('.');
		entero = elem[0];
		decimal = elem[1];
		decimal = decimal.substr(0,truncar);
		$(frmObj).val(entero+"."+decimal);
	}
}

function cortarDecimales(num,truncar){
	n = num.toString();

	if(n.indexOf('.') != -1){
		elem = n.split('.');
		entero = elem[0];
		decimal = elem[1];
		decimal = decimal.substr(0,truncar);
		valor = entero+"."+decimal;
		return valor
	}else{return num}
}

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

function validaCURP(Obj){
   CURP =  $(Obj).val();
    if (CURP.match(/^([a-z]{4})([0-9]{6})([a-z]{6})([0-9]{2})$/i)) {
      $(Obj).css('cssText','color:rgb(0, 0, 0) !important');
     return true;
   }else {
     $(Obj).css('cssText','color:rgb(255, 0, 0) !important');
     alertify.error("CURP incorrecto");
     return false;
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

/*
function validaReferenciaBlanco(frmObj){
  Referencia = $(frmObj).val();
  Referencia = $.trim(Referencia);

	if( (!/^([A-Za-z]\d[0-9]{6,8}|0)$/.test(Referencia)) ){
		return true;
	}else{
			alertify.error("Referencia: Z12345678");
			$(frmObj).focus();
			$(frmObj).val(Referencia);
	}
}
*/

function validaSoloNumeros(frmObj){
  campo = $(frmObj).val();
  campo = $.trim(campo);
	if( (!/^([0-9])*$/.test(campo))){
	// NOTE: quite cuando campo esta vacio, porque si no nunca sale del ciclo
  // if( (!/^([0-9])*$/.test(campo)) || campo == "" ){
    alertify.error("Ingrese solo numeros")
		$(frmObj).focus();
		return false; // agregue *fany* cambiarlo si hace falta
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
			url: "/Ubicaciones/Contabilidad/actions/validarFechaCierreDoc.php",
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

function validarRFCfac(frmObj){
		RFC_1 = $(frmObj).val();
		if( RFC_1 == 'XEXX010101000' || RFC_1 == 'XAXX010101000' ){
			$('T_usoCFDI').val('P01');
			swal('Alerta','Cuándo sea el caso de un RFC genérico\n(XEXX010101000, XAXX010101000),\nel uso de CFDI siempre será -P01 Por definir','info');
		}else if( RFC_1.indexOf('XEXX') != -1 && RFC_1 != 'XEXX010101000' ){
				$(frmObj).css("color", "#FF0000");
				swal("Error", "RFC INCORRECTO\nVerifique con el ejecutivo de Tráfico\nRFC extrangeros: XEXX010101000", "error");
			}else if( RFC_1.indexOf('XAXX') != -1 && RFC_1 != 'XAXX010101000' ){
					$(frmObj).css("color", "#FF0000");
					swal("Error", "RFC INCORRECTO\nVerifique con el ejecutivo de Tráfico\nRFC generico: XAXX010101000", "error");
				}else{
					minimo = 12;
					maximo = 13;
					RFC =  $(frmObj).val().length;
					if(RFC < minimo || RFC > maximo){
						$(frmObj).css("color", "#FF0000");
						$('#guardar').prop( 'disabled',true );
						swal("Error", "RFC potencialmente INCORRECTO\nVerifique con el ejecutivo de Trafico\nRFC generico: XAXX010101000\nRFC extrangeros: XEXX010101000\nPersonas Fisicas: 13 caracteres\nPesonas Morales: 12 caracteres", "error");
					}
				}
}

function quitarNoUsar(frmObj){
		var str = $(frmObj).val();
		var nuevaCadena = str.replace("NO USAR", "");
		var nuevaCadena = str.replace("()", "");
		$(frmObj).val(nuevaCadena);
}

/****************************************************************
	VALIDA CARACTERES PERMITIDOS POR EL SAT ANEXO20 VERSION 3.3
*****************************************************************/

				/* Valida input*/
				function validarStringSAT(frmObj){
					var cadenaAnalizar = $(frmObj).val();
					var nuevaCadena='';
					letras = " \"áéíóúÁÉÍÓÚüÜabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789!%&'´-:;>=<@_,{}`~";
					for (var i = 0; i< $(frmObj).val().length; i++) {
						 var caracter = $(frmObj).val().charAt(i);

						 if(letras.indexOf(caracter) == -1 ){ }else{
							nuevaCadena=nuevaCadena.concat(caracter);
						  }

					}
					$(frmObj).val(nuevaCadena);
				}

				/****************************************************************
				VALIDA TECLA PULSADA
				EN FORMULARIO ESCRIBA
				onkeypress="return validarStringSATteclaPulsada(event);" onblur="limpia()"
				*****************************************************************/
				function validarStringSATteclaPulsada(e) {
				    key = e.keyCode || e.which;
				    tecla = String.fromCharCode(key).toLowerCase();
				    letras = " \"áéíóúÁÉÍÓÚüÜabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789!%&'´-:;>=<@_,{}`~";
				    especiales = [8, 37, 39, 46];

				    tecla_especial = false
				    for(var i in especiales) {
				        if(key == especiales[i]) {
				            tecla_especial = true;
				            break;
				        }
				    }

				    if(letras.indexOf(tecla) == -1 && !tecla_especial)
				        return false;
				}

				function limpia(frmObj) {
				    var val = $(frmObj).val();
				    var tam = $(frmObj).val().length;
				    for(i = 0; i < tam; i++) {
				        if(!isNaN($(frmObj)[i]))
				            $(frmObj).val('');
				    }
				}
// TERMINA VALIDA CARACTERES PERMITIDOS POR EL SAT ANEXO20 VERSION 3.3 **************************************************************

$(document).ready(function(){

	$('#cfdi-pagoprovisionbtn').click(function(){
		//console.log(UUID+','+RFC+','+importe+','+subtotal+','+BeneficiarioOpc+','+iva+','+iva_aplicado+','+prov+','+folio+','+fecha_Poliza+','+seleccion+','+id_poliza+','+proveedor+','+ctaproveedor);
		seleccion = $('#opcionespolizas').val();

		//CompNal
		if( seleccion == '2' ){
			UUID = $('#cfdi-uuid').val();
			RFC = $('#cfdi-rfc').val();
			prov = $('#cfdi-prov').attr('db-id');
			cadenaTexto = $('#cfdi-prov').val();
			fragmentoTexto = cadenaTexto.split('-');
			numProv = fragmentoTexto[0];
			proveedor = fragmentoTexto[1];
			ctaproveedor = fragmentoTexto[3]+'-'+fragmentoTexto[4];

			accion = 'pagarProvision';

			if(UUID == ""){
				alertify.error("UUID es requerido");
				$('#cfdi-uuid').focus();
				return false;
			}

			if(RFC == ""){
				alertify.error("RFC es requerido");
				 $('#cfdi-rfc').focus();
				return false;
			}

			if(prov == ""){
				alertify.error("Proveedor es requerido");
				$('#cfdi-prov').focus();
				return false;
			}

			var data = {
				seleccion : seleccion,
				accion : accion,
				UUID : UUID,
				RFC : RFC,
				prov : prov,
				seleccion : seleccion,
				numProv : numProv,
				proveedor : proveedor,
				ctaproveedor : ctaproveedor,
				importe : $('#cfdi-total').val(),
				subtotal : $('#cfdi-total').val(),
				BeneficiarioOpc : $('#cfdi-razonsocial').val(),
				iva : $('#cfdi-ivatrasladado').val(),
				iva_aplicado : $('#cfdi-ivaaplicado').val(),
				folio : $('#cfdi-folio').val(),
				fecha_Poliza : $('#mstpol-fecha').val(),
				id_poliza : $('#mst-poliza').val(),
				tipo : $('#mstpol-tipo').val(),
				moneda: $('#cfdi-moneda').val(),
				tipoCamb: $('#cfdi-tc').val(),
				retenido:  $('#cfdi-ivaretenido').val()
			}
			$.ajax({
				type: "POST",
				url: "/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/accionesProvisionar.php",
				data: data,
				success: function(r){
					console.log(data);
					r = JSON.parse(r);
					console.log(r);
						if (r.code == 1) {
							//$('#datosProvision').html(r.data);
							swal("Exito", "Se guardo correctamente.", "success");
							infAdd_detalle(id_poliza);
						} else {
							console.error(r.message);
						}
					},
					error: function(x){
						console.error(x);
					}
			});
		}
	});

	$('#cfdi-provisionbtn').click(function(){
		//console.log(UUID+','+RFC+','+importe+','+subtotal+','+BeneficiarioOpc+','+iva+','+iva_aplicado+','+prov+','+folio+','+fecha_Poliza+','+seleccion+','+id_poliza+','+proveedor+','+ctaproveedor);
		seleccion = $('#opcionespolizas').val();

		//CompNal
	  if( seleccion == '2' ){
			UUID = $('#cfdi-uuid').val();
		  RFC = $('#cfdi-rfc').val();
			prov = $('#cfdi-prov').attr('db-id');
			cadenaTexto = $('#cfdi-prov').val();
			fragmentoTexto = cadenaTexto.split('-');
			numProv = fragmentoTexto[0];
			proveedor = fragmentoTexto[1];
			ctaproveedor = fragmentoTexto[3]+'-'+fragmentoTexto[4];

			accion = 'provisionar';

			if(UUID == ""){
		    alertify.error("UUID es requerido");
		    $('#cfdi-uuid').focus();
		    return false;
		  }

		  if(RFC == ""){
		    alertify.error("RFC es requerido");
		     $('#cfdi-rfc').focus();
		    return false;
		  }

		  if(prov == ""){
		    alertify.error("Proveedor es requerido");
				$('#cfdi-prov').focus();
		    return false;
		  }

			var data = {
				seleccion : seleccion,
				accion : accion,
				UUID : UUID,
			  RFC : RFC,
				prov : prov,
				seleccion : seleccion,
				numProv : numProv,
				proveedor : proveedor,
				ctaproveedor : ctaproveedor,
				importe : $('#cfdi-total').val(),
				subtotal : $('#cfdi-total').val(),
				BeneficiarioOpc : $('#cfdi-razonsocial').val(),
				iva : $('#cfdi-ivatrasladado').val(),
				iva_aplicado : $('#cfdi-ivaaplicado').val(),
				folio : $('#cfdi-folio').val(),
				fecha_Poliza : $('#mstpol-fecha').val(),
				id_poliza : $('#mst-poliza').val(),
				tipo : $('#mstpol-tipo').val(),
				moneda: $('#cfdi-moneda').val(),
		    tipoCamb: $('#cfdi-tc').val(),
				retenido:  $('#cfdi-ivaretenido').val()
			}
			$.ajax({
		    type: "POST",
				url: "/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/accionesProvisionar.php",
		    data: data,
		    success: function(r){
					console.log(data);
		      r = JSON.parse(r);
					console.log(r);
		        if (r.code == 1) {
							//$('#datosProvision').html(r.data);
							swal("Exito", "Se guardo correctamente.", "success");
		          infAdd_detalle(id_poliza);
		        } else {
		          console.error(r.message);
		        }
		      },
		      error: function(x){
		        console.error(x);
		      }
		  });
		}
	});

	$('#trans-embtn').click(function(){
		idbanco = $('#transf-idbanco').val();
		nomBancExtj = $('#transf-nombancoextj').val();
		ctabanco = $('#transf-nocuenta').val();
		razonsocial = $('#transf-nombre').val();
		rfc = $('#transf-rfc').val();

		if( idbanco == '' ){
			alertify.error("Seleccione datos de transferencia");
	    return false;
		}

		$('#trans-emidbanco').val(idbanco);
		$('#trans-emext').val(nomBancExtj);
		$('#trans-emnocuenta').val(ctabanco);
		$('#trans-emnombre').val(razonsocial);
		$('#trans-emrfc').val(rfc);
	});

	$('#trans-desbtn').click(function(){
		idbanco = $('#transf-idbanco').val();
		nomBancExtj = $('#transf-nombancoextj').val();
		ctabanco = $('#transf-nocuenta').val();
		razonsocial = $('#transf-nombre').val();
		rfc = $('#transf-rfc').val();

		if( idbanco == '' ){
			alertify.error("Seleccione datos de transferencia");
	    return false;
		}

		$('#trans-desidbanco').val(idbanco);
		$('#trans-desext').val(nomBancExtj);
		$('#trans-desnocuenta').val(ctabanco);
		$('#trans-desnombre').val(razonsocial);
		$('#trans-desrfc').val(rfc);
	});

	$('#transf-bancossat').change(function(){
		$('#transf-bancosplaa').attr('value','').attr('db-id','');
		$('#transf-benef').attr('value','').attr('db-id','');
		$('#transf-clientes').attr('value','').attr('db-id','');
		$('#transf-empleados').attr('value','').attr('db-id','');
		$('#transf-proveedores').attr('value','').attr('db-id','');
		$('#transf-nombancoextj').attr('value','').attr('db-id','');

		cadena = $('#transf-bancossat').val();
		parte = cadena.split('-');
		$('#transf-idbanco').attr('value',parte[1]).val(parte[1]);
		$('#transf-nocuenta').attr('value','No identificado').val('No identificado');
	});

	$('#transf-bancosplaa').change(function(){
		$('#transf-benef').attr('value','').attr('db-id','');
		$('#transf-clientes').attr('value','').attr('db-id','');
		$('#transf-empleados').attr('value','').attr('db-id','');
		$('#transf-proveedores').attr('value','').attr('db-id','');
		$('#transf-nombancoextj').attr('value','').attr('db-id','');
		$('#transf-bancossat').attr('value','').attr('db-id','');

		cadena = $('#transf-bancosplaa').val();
		parte = cadena.split('-');
		$('#transf-idbanco').attr('value',parte[4]).val(parte[4]);
		$('#transf-nocuenta').attr('value',parte[5]).val(parte[5]);
		$('#transf-nombre').attr('value',parte[2]).val(parte[2]);
		$('#transf-rfc').attr('value',parte[3]).val(parte[3]);
	});

	$('#transf-benef').change(function(){
		$('#transf-clientes').attr('value','').attr('db-id','');
		$('#transf-empleados').attr('value','').attr('db-id','');
		$('#transf-proveedores').attr('value','').attr('db-id','');
		$('#transf-nombancoextj').attr('value','').attr('db-id','');
		$('#transf-bancossat').attr('value','').attr('db-id','');
		$('#transf-bancosplaa').attr('value','').attr('db-id','');

		cadena = $('#transf-benef').val();
		parte = cadena.split('-');
		$('#transf-idbanco').attr('value',parte[2]).val(parte[2]);
		$('#transf-nocuenta').attr('value',parte[3]).val(parte[3]);
		$('#transf-nombre').attr('value',parte[0]).val(parte[0]);
		$('#transf-rfc').attr('value',parte[1]).val(parte[1]);
		$('#transf-nombancoextj').attr('value',parte[4]).val(parte[4]);
	});

	$('#transf-clientes').change(function(){
		$('#transf-empleados').attr('value','').attr('db-id','');
		$('#transf-proveedores').attr('value','').attr('db-id','');
		$('#transf-nombancoextj').attr('value','').attr('db-id','');
		$('#transf-bancossat').attr('value','').attr('db-id','');
		$('#transf-bancosplaa').attr('value','').attr('db-id','');
		$('#transf-benef').attr('value','').attr('db-id','');

		cadena = $('#transf-clientes').val();
		parte = cadena.split('-');
		$('#transf-idbanco').attr('value',parte[3]).val(parte[3]);
		$('#transf-nocuenta').attr('value',parte[4]).val(parte[4]);
		$('#transf-nombre').attr('value',parte[1]).val(parte[1]);
		$('#transf-rfc').attr('value',parte[2]).val(parte[2]);
		$('#transf-nombancoextj').attr('value',parte[5]).val(parte[5]);
	});

	$('#transf-empleados').change(function(){
		$('#transf-proveedores').attr('value','').attr('db-id','');
		$('#transf-nombancoextj').attr('value','').attr('db-id','');
		$('#transf-bancossat').attr('value','').attr('db-id','');
		$('#transf-bancosplaa').attr('value','').attr('db-id','');
		$('#transf-benef').attr('value','').attr('db-id','');
		$('#transf-clientes').attr('value','').attr('db-id','');

		cadena = $('#transf-empleados').val();
		parte = cadena.split('-');
		$('#transf-idbanco').attr('value',parte[2]).val(parte[2]);
		$('#transf-nocuenta').attr('value',parte[3]).val(parte[3]);
		$('#transf-nombre').attr('value',parte[0]).val(parte[0]);
		$('#transf-rfc').attr('value',parte[1]).val(parte[1]);
	});

	$('#transf-proveedores').change(function(){
		$('#transf-nombancoextj').attr('value','').attr('db-id','');
		$('#transf-bancossat').attr('value','').attr('db-id','');
		$('#transf-bancosplaa').attr('value','').attr('db-id','');
		$('#transf-benef').attr('value','').attr('db-id','');
		$('#transf-clientes').attr('value','').attr('db-id','');
		$('#transf-empleados').attr('value','').attr('db-id','');

		cadena = $('#transf-proveedores').val();
		parte = cadena.split('-');
		$('#transf-idbanco').attr('value',parte[2]).val(parte[2]);
		$('#transf-nocuenta').attr('value',parte[3]).val(parte[3]);
		$('#transf-nombre').attr('value',parte[0]).val(parte[0]);
		$('#transf-rfc').attr('value',parte[1]).val(parte[1]);
		$('#transf-nombancoextj').attr('value',parte[4]).val(parte[4]);
	});

	$('#ch-origen').click(function(){
		$('#ch-cheques').val('');
		$('#ch-emextran').val('');
		$('#ch-tc').val('');
		$('#chmoneda').val('');
		$('#ch-cheque1').val('');
		$('#ch-importe').val('');
		$('#ch-fecha').val('');
		$('#ch-nombrebenef').val('');
		$('#ch-rfcbenef').val('');
	});

	$('#ch-origen').change(function(){
		idcta = $('#ch-origen').attr('db-id');
		cadena = $('#ch-origen').val();
		parte = cadena.split('-');
		idbanco = parte[3];

		var data = {
			idcta : idcta,
			idbanco : idbanco
		}
		$.ajax({
	    type: "POST",
	    url: "/Resources/PHP/actions/consulta_cheques.php",
	    data: data,
	    success: function(r){
				console.log(data);
	      r = JSON.parse(r);
				console.log(r.data);
	        if (r.code == 1) {
	          $('#numcheques').html(r.data);
	        } else {
	          console.error(r.message);
	        }
	      },
	      error: function(x){
	        console.error(x);
	      }
	  });
	});

	$('#ch-cheques').change(function(){
     numerocheque = $(this).val();
		 idcta = $('#ch-origen').attr('db-id');

		 var data = {
			 idcta : idcta,
			 numcheque : numerocheque
		 }

		 $.ajax({
			 type: "POST",
			 url: "/Resources/PHP/actions/consulta_chequeDatos.php",
			 data: data,
			 success: function(r){
				 //console.log(data);
				 //console.log(r);
				 r = JSON.parse(r);
					 if (r.code == 1) {
						 $('#ch-cheque1').val(numerocheque);
						 $('#ch-importe').val(r.valor);
						 $('#ch-fecha').val(r.fecha);
						 $('#ch-nombrebenef').val(r.nombre);
						 $('#ch-rfcbenef').val(r.rfc);
					 } else {
						 console.error(r.message);
					 }
				 },
				 error: function(x){
					 console.error(x);
				 }
		 });
  });

	$('.infAddbeneficiario').click(function(){
		$('#infAddbeneficiario1').show();
		$('#infAddbeneficiario').focus();
		$('#infAddcliente1,#infAddempleado1,#infAddproveedor1').hide();
		$('#pagadoA').val('beneficiario');
	});

	$('.infAddcliente').click(function(){
		$('#infAddcliente1').show();
		$('#infAddcliente').focus();
		$('#infAddbeneficiario1,#infAddempleado1,#infAddproveedor1').hide();
		$('#pagadoA').val('cliente');
	});

	$('.infAddempleado').click(function(){
		$('#infAddempleado1').show();
		$('#infAddempleado').focus();
		$('#infAddcliente1,#infAddbeneficiario1,#infAddproveedor1').hide();
		$('#pagadoA').val('empleado');
	});

	$('.infAddproveedor').click(function(){
		$('#infAddproveedor1').show();
		$('#infAddproveedor').focus();
		$('#infAddbeneficiario1,#infAddcliente1,#infAddempleado1').hide();
		$('#pagadoA').val('proveedor');
	});








});
// MOSTRAR DETALLE DE ANTICIPO
// function infAdd_detallePoliza(id_poliza){
//       var data = {
//         id_poliza: id_poliza
//       }
//       $.ajax({
//         type: "POST",
//         url: "/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/tabla_detallepoliza_infAdd.php",
//         data: data,
//         success: 	function(request){
// 					r = JSON.parse(request);
//           console.log(r);
// 					if (r.code == 1) {
// 						// $('#infAddtabla_detallePoliza').html(r.data);
// 					}
//         }
//       });
// };



function processFiles(files) {
			var file = files[0];
			var reader = new FileReader();

			reader.onload = function (e) {
				fileXML = $('#archivo').val();
				if( /\\/.test(fileXML) ){
					numeroLetras = fileXML.length;
					ultimaPosicionSeparador = fileXML.lastIndexOf('\\');
					ultimaPosicionSeparador = ultimaPosicionSeparador + 1;
					fileXML = fileXML.substring(ultimaPosicionSeparador,numeroLetras);
				}

				if( /.xml$/i.test(fileXML) ){
					contenido_XML = e.target.result;
          procesaXML(fileXML,contenido_XML);
				}else{
           alertify.error("No es un XML");
          return false;
				}
			};
			reader.readAsText(file);
}

function procesaXML(fileXML,contenido_XML){
  var data = {
    contenido_XML: contenido_XML,
    fileXML: fileXML,
    tipo: $('#mstpol-tipo').val(),
    partidaDoc: 0,
    id_poliza:$('#mst-poliza').val()
  }
  $.ajax({
    type: "POST",
    url: "/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/procesaArchivo.php",
    data: data,
    success: function(r){
      //console.log(data);
			//console.log(r);
      r = JSON.parse(r);
        if (r.code == 1) {
          $('#datosUUID').html(r.data);
          cadena = r.data;
          parte = cadena.split('|');
          $('#cfdi-uuid').val(parte[0]);
          $('#cfdi-rfc').val(parte[1]);
          $('#cfdi-total').val(parte[2]);
          $('#cfdi-razonsocial').val(TildesHtml_decode(parte[3]));
          $('#cfdi-subtotal').val(parte[4]);
          $('#cfdi-ivatrasladado').val(parte[5]);
          $('#cfdi-isrretenido').val(parte[6]);
          $('#cfdi-ivaretenido').val(parte[7]);
          $('#cfdi-moneda').val(parte[8]);
          $('#cfdi-tc').val(parte[9]);
					$('#cfdi-folio').val(parte[10]);
          $('#cfdi-ivaaplicado').val(parte[11]);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
  });
}

function infAddPartida(id_partida){
  seleccion = $('#opcionespolizas').val();
  //CompNal
  if( seleccion == '2' ){ guardarCompNal(id_partida); }
	// Cheque
	if( seleccion == '3' ){ guardarCheque(id_partida); 	}
	//CompExt
	if( seleccion == '4' ){ guardarCompExt(id_partida); }
	//OtrMetodoPago
	if( seleccion == '5' ){ guardarOtrMetodoPago(id_partida); }
  //Transferencia
  if( seleccion == '6' ){ guardarTransfer(id_partida); }
}

function guardarCompNal(id_partida){
  tipoInf = "CompNal";

  UUID = $('#cfdi-uuid').val();
  RFC = $('#cfdi-rfc').val();
  BeneficiarioOpc = $('#cfdi-razonsocial').val();
  aplicar = $('#cfdi-aplicar').val();
  id_poliza = $('#mst-poliza').val();

  if(aplicar == "subtotal"){ importe = $('#cfdi-subtotal').val();}
  if(aplicar == "iva"){ importe = $('#cfdi-ivatrasladado').val();}
  if(aplicar == "isr"){ importe = $('cfdi-isrretenido').val();}
	if(aplicar == "ivaRet"){ importe = $('#cfdi-ivaretenido').val();}
  if(aplicar == "total"){ importe = $('#cfdi-total').val();}

  if(UUID == ""){
    alertify.error("UUID es requerido");
    $('#cfdi-uuid').focus();
    return false;
  }

  if(RFC == ""){
    alertify.error("RFC es requerido");
     $('#cfdi-rfc').focus();
    return false;
  }

  if(importe == 0){
    alertify.error("Importe es requerido");
    return false;
  }

  var data = {
    partidaDoc: id_partida,
		tipoInf: tipoInf,
		tipo: $('#tipoDoc').val(),
		id_poliza: id_poliza,
    UUID: UUID,
    importe: importe,
    RFC: RFC,
    BeneficiarioOpc: BeneficiarioOpc,
    moneda: $('#cfdi-moneda').val(),
    tipoCamb: $('#cfdi-tc').val()
  }

	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/accionesDetalle.php",
		data: data,
		success: 	function(r){
			r = JSON.parse(r);
			if (r.code == 1) {
				swal("Exito", "Se guardo correctamente.", "success");
				infAdd_detalle(id_poliza);
			} else {
				console.error(r.message);
			}
		}
	});
}

function guardarCheque(id_partida){
	tipoInf = "Cheque";
	id_poliza = $('#mst-poliza').val();
	tipo = $('#tipoDoc').val();
	cadena = $('#ch-origen').val();
	parte = cadena.split('-');
	idbanco = parte[3];
	idcta = $('#ch-origen').attr('db-id');
	nomExtj = $('#ch-emextran').val();
	tc = $('#ch-tc').val();
	moneda = $('#chmoneda').val();
	cheque = $('#ch-cheque1').val();
	importe = $('#ch-importe').val();
	fecha = $('#ch-fecha').val();
	benef = $('#ch-nombrebenef').val();
	rfcbenef = $('#ch-rfcbenef').val();

	if(cheque == ""){
    alertify.error("Número de cheque es requerido");
    return false;
  }

	var data = {
		partidaDoc: id_partida,
		tipoInf: tipoInf,
		tipo: tipo,
		id_poliza: id_poliza,
		idbanco : idbanco,
		idcta : idcta,
		nomExtj : nomExtj,
		tc : tc,
		moneda : moneda,
		cheque : cheque,
		importe : importe,
		fecha : fecha,
		benef : benef,
		rfcbenef : rfcbenef
	}

	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/accionesDetalle.php",
		data: data,
		success: 	function(r){
			r = JSON.parse(r);
			if (r.code == 1) {
				swal("Exito", "Se guardo correctamente.", "success");
				infAdd_detalle(id_poliza);
			} else {
				console.error(r.message);
			}
		}
	});
}

function guardarCompExt(id_partida){
	tipoInf = "CompExt";
	id_poliza = $('#mst-poliza').val();
	tipo = $('#tipoDoc').val();
	tax = $('#comext-tax').val();
	razsocial = $('#comext-razsocial').val();
	fact = $('#comext-fact').val();
	moneda = $('#comext-moneda').val();
	tc = $('#comext-tc').val();
	total = $('#comext-total').val();

	if(tax == ""){
		alertify.error("TaxID es requerido");
		return false;
	}

	if(fact == ""){
		alertify.error("Número de factura es requerido");
		return false;
	}

	if(total == ""){
		alertify.error("Total es requerido");
		return false;
	}

	if( moneda == 'MXN' || moneda == '' ){
		alertify.error("Moneda es requerido");
		return false;
	}

	if( tc == '' || tc <= 1){
		alertify.error("Tipo de cambio es requerido");
		return false;
	}

	var data = {
		partidaDoc: id_partida,
		tipoInf: tipoInf,
		tipo: tipo,
		id_poliza: id_poliza,
		tax : tax,
		razsocial : razsocial,
		fact : fact,
		moneda : moneda,
		tc : tc,
		total : total
	}

	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/accionesDetalle.php",
		data: data,
		success: 	function(r){
			r = JSON.parse(r);
			if (r.code == 1) {
				swal("Exito", "Se guardo correctamente.", "success");
				infAdd_detalle(id_poliza);
			} else {
				console.error(r.message);
			}
		}
	});
}

function guardarTransfer(id_partida){
	tipoInf = "Transferencia";
	id_poliza = $('#mst-poliza').val();
	tipo = $('#tipoDoc').val();

	idbanco_o = $('#trans-emidbanco').val();
	nomBancExtj_o = $('#trans-emext').val();
	ctabanco_o = $('#trans-emnocuenta').val();
	razonsocial_o = $('#trans-emnombre').val();
	rfc_o = $('#trans-emrfc').val();

	idbanco_d = $('#trans-desidbanco').val();
	nomBancExtj_d = $('#trans-desext').val();
	ctabanco_d = $('#trans-desnocuenta').val();
	razonsocial_d = $('#trans-desnombre').val();
	rfc_d = $('#trans-desrfc').val();

	tc = $('#trans-tc').val();
	moneda = $('#trans-mon').val();
	fecha = $('#trans-fecha').val();
	importe = $('#trans-imp').val();
	observ = $('#trans-observ').val();

	if( moneda == '' ){ moneda = 'MXN'; }
	if( tc == '' ){ tc = 1; }

	if( idbanco_o == '' ){
		alertify.error("Asigne datos del emisor");
		return false;
	}

	if( idbanco_d == '' ){
		alertify.error("Asigne datos del receptor");
		return false;
	}

	if( importe == '' || importe == 0 ){
		alertify.error("Asigne un importe");
		$('#trans-imp').focus();
		return false;
	}

	var data = {
		partidaDoc: id_partida,
		tipoInf: tipoInf,
		tipo: tipo,
		id_poliza: id_poliza,

		idbanco_o : idbanco_o,
		nomBancExtj_o : nomBancExtj_o,
		ctabanco_o : ctabanco_o,
		razonsocial_o : razonsocial_o,
		rfc_o : rfc_o,

		idbanco_d : idbanco_d,
		nomBancExtj_d : nomBancExtj_d,
		ctabanco_d : ctabanco_d,
		razonsocial_d : razonsocial_d,
		rfc_d : rfc_d,

		moneda : moneda,
		tc : tc,
		fecha : fecha,
		importe : importe,
		observ : observ
	}

	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/accionesDetalle.php",
		data: data,
		success: 	function(r){
			r = JSON.parse(r);
			if (r.code == 1) {
				swal("Exito", "Se guardo correctamente.", "success");
				infAdd_detalle(id_poliza);
			} else {
				console.error(r.message);
			}
		}
	});
}

function guardarOtrMetodoPago(id_partida){
	tipoInf = "OtrMetodoPago";
	id_poliza = $('#mst-poliza').val();
	tipo = $('#tipoDoc').val();
	formaPago = $('#otr-pago').val();
	fecha = $('#otr-fecha').val();
	importe = $('#otr-imp').val();
	moneda = $('#otr-moneda').val();
	tc = $('#otr-tc').val();
	seleccion = $('#pagadoA').val();
	nombre = '';
	rfc = '';

	if( seleccion == 'cliente' ){
		cadena = $('#infAddcliente').val();
		parte = cadena.split('-');
		nombre = parte[1];
		rfc = parte[2];
	}
	if( seleccion == 'empleado' ){
		cadena = $('#infAddempleado').val();
		parte = cadena.split('-');
		nombre = parte[1];
		rfc = parte[2];
	}
	if( seleccion == 'proveedor' ){
		cadena = $('#infAddproveedor').val();
		parte = cadena.split('-');
		nombre = parte[1];
		rfc = parte[2];
	}
	if( seleccion == 'beneficiario' ){
		cadena = $('#infAddempleado').val();
		parte = cadena.split('-');
		nombre = parte[0];
		rfc = parte[1];
	}

	if(formaPago == ""){
		alertify.error("Forma de pago es requerido");
		return false;
	}
	if(rfc == ""){
		alertify.error("Seleccione pagado a");
		return false;
	}
	if(fecha == ""){
		alertify.error("Fecha es requerido");
		return false;
	}
	if(importe == ""){
		alertify.error("Importe es requerido");
		return false;
	}

	var data = {
		partidaDoc: id_partida,
		tipoInf: tipoInf,
		tipo: tipo,
		id_poliza: id_poliza,
		formaPago : formaPago,
		fecha : fecha,
		importe : importe,
		moneda : moneda,
		tc : tc,
		nombre : nombre,
		rfc : rfc
	}

	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/accionesDetalle.php",
		data: data,
		success: 	function(r){
			r = JSON.parse(r);
			if (r.code == 1) {
				swal("Exito", "Se guardo correctamente.", "success");
				infAdd_detalle(id_poliza);
			} else {
				console.error(r.message);
			}
		}
	});

}



function eliminarPartida(partida){
	id_poliza = $('#mst-poliza').val();
	swal({
	title: "Estas Seguro?",
	text: "Ya no se podra recuperar el registro! "+ partida +" ",
	type: "warning",
	showCancelButton: true,
	confirmButtonClass: "btn-danger",
	confirmButtonText: "Si, Eliminar",
	cancelButtonText: "No, cancelar",
	closeOnConfirm: false,
	closeOnCancel: false
	},
	function(isConfirm) {
		if (isConfirm) {
			var data = {
				partida: partida,
        id_poliza: id_poliza
			}

			$.ajax({
				type: "POST",
				url: "/Resources/PHP/actions/contaElect_eliminarPartida.php",
				data: data,
				success: 	function(r){
	        r = JSON.parse(r);
					swal("Eliminado!", "Se elimino correctamente.", "success");
	        infAdd_detalle(id_poliza);
				},
				error: function(x){
					console.error(x)
				}
			});
		} else {
			swal("Cancelado", "El registro esta a salvo :)", "error");
		}
	});
}



function infAdd_detalle(id_poliza){
  var data = {
    id_poliza: id_poliza
  }
  $.ajax({
    type: "POST",
    url: "/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/tabla_infAdd.php",
    data: data,
    success: 	function(request){
			r = JSON.parse(request);
			if (r.code == 1) {
				$('#infAddtabla_detallePoliza').html(r.data);
			}
    }
  });
}

function cargarXML_backupsxml(nombre,poliza,formato){
	window.open('/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/consultarBackUpsXML.php?archivo='+nombre+'&poliza='+poliza+'&formato='+formato);
}

function cargarXML_factura(anio,id_cliente,id_referencia,id_factura,poliza,formato){
	window.open('/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/consultarFacturasXML.php?id_factura='+id_factura+'&oficina='+oficina+'&anio='+anio+'&id_cliente='+id_cliente+'&id_referencia='+id_referencia+'&poliza='+poliza+'&formato='+formato)
}

function cargarXML_nomina(nombre,poliza,formato){
	window.open('/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/consultarNominaXML.php?archivo='+nombre+'&poliza='+poliza+'&formato='+formato)
}

function cargarXML_pago(anio,id_cliente,nombreArchivo,poliza,formato){
	window.open('/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/consultarPagoXML.php?anio='+anio+'&id_cliente='+id_cliente+'&nombreArchivo='+nombreArchivo+'&poliza='+poliza+'&formato='+formato)
}

function cargarXML_nc(anio,id_cliente,id_referencia,id_NC,poliza,formato){
	window.open('/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/consultarNCXML.php?id_NC='+id_NC+'&oficina='+oficina+'&anio='+anio+'&id_cliente='+id_cliente+'&id_referencia='+id_referencia+'&poliza='+poliza+'&formato='+formato)
}

// <script>
// Add the following code if you want the name of the file appear on select

// </script>

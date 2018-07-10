// function borrarRegistro(partida){
// 	if (confirm("Borrar&aacute; este Registro, "+ partida +" ¿Desea continuar?")) {
// 		var data = {
// 			partida: partida,
// 			id_poliza: $('#id_poliza').val()
// 		}
//
// 		$.ajax({
// 			type: "POST",
// 			url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/eliminar.php",
// 			data: data,
// 			success: 	function(r){
// 				console.log(r);
// 				r = JSON.parse(r);
// 				if (r.code == 1) {
// 					swal("Exito", "Se elimino correctamente.", "success");
// 					location.reload();
// 				} else {
// 					console.error(r.message);
// 				}
// 			},
// 			error: function(x){
// 				console.error(x);
// 			}
//
// 		});
// 	}else {
// 		return false;
// 	}
// }

function borrarRegistro(partida){
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
				id_poliza: $('#id_poliza').val()
			}
			$.ajax({
				type: "POST",
				url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/eliminar.php",
				data: data,

					success: 	function(r){
						console.log(r);
					if (r.code == 1) {
						swal("Eliminado!", "Se elimino correctamente.", "success");
						// $('#tabla_detallepoliza').html(r.data);
						setTimeout('document.location.reload()',700);

						// location.reload();
					} else {
						console.error(r.message);
					}
				},
				error: function(x){
					console.error(x)
				}
			});
			swal("Eliminado!", "Se elimino correctamente.", "success");
			// $('#tabla_detallepoliza').html(r.data);
			setTimeout('document.location.reload()',700);
			// location.reload();
		} else {
			swal("Cancelado", "El registro esta a salvo :)", "error");
		}
	});
}


function cambiarStatus(){
	fecha = $('#mstpol-fecha').val();
	aduana = $('#aduana_activa').val();
	tipoDoc = $('#mstpol-tipo').val();
	usuario = $('#usuario_activo').val();

	statusPoliza = $('#mstpol-cancela').val();
	if( statusPoliza == 1 ){ permiso = "s_cancelar_libre_polizas"; }
	if( statusPoliza == 0 ){ permiso = "s_descancelar_polizas"; }


	var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
	if(continuar == true) {
		var data = {
			id_poliza: $('#id_poliza').val(),
			statusPoliza: $('#mstpol-cancela').val()
		}

			$.ajax({
				type: "POST",
				url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/editarStatusPoliza.php",
				data: data,
				success: 	function(r){
					console.log(r);
					r = JSON.parse(r);
					if (r.code == 1) {
						swal("Exito", "Se actualizó correctamente.", "success");
						location.reload();
						//$('.real-time-search').keyup();
					} else {
						console.error(r.message);
					}
				},
				error: function(x){
					console.error(x);
				}

			});
	}else{
		return false;
	}
}
function validarCtasGastoOficina(st){
	/* CUENTAS QUE REQUIEREN ASIGNAR OFICINA PARA REFLEJAR EL GASTO */
	nombreCta = st.split('-');

	if(st.substring(0,2) == '05' ||
	   st.substring(0,4) == '0147' || st.substring(0,4) == '0148' || st.substring(0,4) == '0149' ||
		 st.substring(0,4) == '0420' || st.substring(0,4) == '0430' ||
		 st.substring(0,10) == '0168-00005' ||
		 st.substring(0,10) == '0201-00002' || st.substring(0,10) == '0201-00003' || st.substring(0,10) == '0201-00004' ||
		 st.substring(0,10) == '0201-00005' || st.substring(0,10) == '0201-00006' || st.substring(0,10) == '0201-00007' ){

		 return true;
	}
}

function validarCtasCliente(st){
	/* CUENTAS QUE REQUIEREN ASIGNAR CLIENTE */
	nombreCta = st.split('-');

	if(st.substring(0,4) == '0108' || st.substring(0,4) == '0208' || st.substring(0,4) == '0106' || st.substring(0,4) == '0203'){
		 return true;
	}
}

function validarCtasPagosCliente(st){
	/* CUENTAS QUE REQUIEREN ASIGNAR CLIENTE */
	nombreCta = st.split('-');

	if(st.substring(0,4) == '0110'){
		 return true;
	}
}

function inserta(){
		var data = {
			id_poliza: $('#id_poliza').val(),
			fecha: $('#mstpol-fecha').val(),
			id_referencia: $('#detpol-referencia').attr('db-id'),
			tipo: $('#mstpol-tipo').val(),
			cuenta: $('#detpol-cuenta').attr('db-id'),
			id_cliente: $('#detpol-cliente').attr('db-id'),
			documento: $('#detpol-documento').val(),
			factura: $('#detpol-factura').attr('db-id'),
			anticipo: $('#detpol-anticipo').attr('db-id'),
			cheque: $('#detpol-cheque').attr('db-id'),
			cargo: $('#detpol-cargo').val(),
			abono: $('#detpol-abono').val(),
			desc: $('#detpol-concepto').val(),
			gastoOficina: $('#detpol-gtoficina').attr('db-id'),
			proveedor: $('#detpol-proveedores').attr('db-id')
		}

		$.ajax({
			type: "POST",
			url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/agregar.php",
			data: data,
			success: 	function(r){
				console.log(r);
				r = JSON.parse(r);
				if (r.code == 1) {
					swal("Exito", "Se registro correctamente.", "success");
					location.reload();

					//$('.real-time-search').keyup();
				} else {
					console.error(r.message);
				}
			},
			error: function(x){
				console.error(x);
			}

		});
}



function buscarPoliza(Accion){
	if( Accion == 'consultar' ){ id_poliza = $('#folioPolconsulta').val(); }
	if( Accion == 'modificar' ){ id_poliza = $('#folioPol').val(); }
	window.location.replace('/conta6/Ubicaciones/Contabilidad/polizas/actions/buscar_poliza.php?id_poliza='+id_poliza+'&Accion='+Accion);
}

function genPol(){
	var data = {
		diafecha: $('#diafecha').val(),
		diaconcepto: $('#diaconcepto').val(),
		diaaduana: $('#diaaduana').val(),
		diatipo: $('#diatipo').attr('db-id')
	}

	tipo = $('#diatipo').attr('db-id');
	$.ajax({
		type: "POST",
		url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/generarFolioPoliza.php",
		data: data,
		success: 	function(request){
			r = JSON.parse(request);
			//window.location.replace('Detallepoliza.php?id_poliza='+r+'&tipo='+tipo);
			if (r.code == 1) {
				poliza = r.data;
				window.location.replace('Detallepoliza.php?id_poliza='+poliza+'&tipo='+tipo);
			} else {
				swal("Error", "No se generó la póliza.", "error");
				console.error(r.message);
			}
		}
	});
}


function Actualiza_Cuenta(){
		st = $('#detpol-cuenta').val();
    nombreCta = st.split('-');

		if( validarCtasGastoOficina(st) == true ){
      //ACTIVAR GASTO OFICINA
      $('#detpol-gtoficina').prop( 'disabled', false );
      $('#detpol-gtoficina').val('');
			$('#detpol-gtoficina').attr('db-id','');
      $('#detpol-cliente').attr('db-id','')
		}else{
      $('#detpol-gtoficina').prop( 'disabled', true );
      $('#detpol-gtoficina').val('');
			$('#detpol-gtoficina').attr('db-id','');
		}

		if(st.substring(0,4) == '0110'){
			$('#detpol-referencia').focus();
      alertify.error("Referencia es requerido");
      $('#detpol-cliente').val('');
      $('#detpol-cliente').attr('db-id','');
		}else{
      $('#detpol-cliente').attr('action','clientes');
		}

		if(st.substring(0,4) == '0206'){
			//ACTIVAR PROVEEDORES
			$('#detpol-proveedores').prop( 'disabled', false );
			$('#detpol-proveedores').val('');
			$('#detpol-proveedores').attr('db-id','');
		}else{
			$('#detpol-proveedores').prop( 'disabled', true );
			$('#detpol-proveedores').val('');
			$('#detpol-proveedores').attr('db-id','');
		}


    $('#detpol-concepto').val($.trim(nombreCta[2]));
}

function valDescripOficina(){
		/********************************************************************************************************
		PARAMETRO DE DISTINCION EN EL GASTO, NO BASTA SOLO CON ASIGNAR LA OFICINA.
		CUANDO ES EL CASO QUE HAY MAS DE UN REGISTRO IGUAL EN LA MISMA POLIZA, SE REPIDE LA PARTIDA EN EL GASTO;
		PARA EVITAR ESTO SE ASIGNA UN PARAMETRO QUE HACE LA DISTINCION EN LA DESCRIPCION
		*/
		desc = $('#detpol-concepto').val();
		desc = desc.replace(" ::160::","");
		desc = desc.replace(" ::240::","");
		desc = desc.replace(" ::430::","");
		desc = desc.replace(" ::470::","");
		desc = desc.replace(" ::241::","");

		gastoOficina = $('#detpol-gtoficina').attr('db-id');
		descOficina = "";

		if (gastoOficina == 160){ descOficina = "::160::"; }
		if (gastoOficina == 240){ descOficina = "::240::"; }
		if (gastoOficina == 430){ descOficina = "::430::"; }
		if (gastoOficina == 470){ descOficina = "::470::"; }
		if (gastoOficina == 241){ descOficina = "::241::"; }

 		desc = desc + " " + descOficina;
		$('#detpol-concepto').val(desc);
}


$(document).ready(function(){
	if( $('#mstpol-cancela') == 0){ $('#detpol-btnguardar').prop( 'disabled', false ); }

	$('#detpol-btnguardar').click(function(){
			if($('#mstpol-fecha').val() == ""){
				alertify.error("Seleccione una fecha");
				$('#mstpol-fecha').focus();
				return false;
			}

			fecha = $('#mstpol-fecha').val();
			aduana = $('#aduana_activa').val();
			tipoDoc = $('#mstpol-tipo').val();
			usuario = $('#usuario_activo').val();
			permiso = "s_generar_x_fecha_polizas";

			var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
			if(continuar == true) {
				id_poliza = $('#id_poliza').val();
				fecha = $('#mstpol-fecha').val();
				id_referencia = $('#detpol-referencia').attr('db-id');
				tipo = $('#mstpol-tipo').val();
				cuenta = $('#detpol-cuenta').attr('db-id');
				id_cliente = $('#detpol-cliente').attr('db-id');
				documento = $('#detpol-documento').val();
				factura = $('#detpol-factura').attr('db-id');
				anticipo = $('#detpol-anticipo').attr('db-id');
				cheque = $('#detpol-cheque').attr('db-id');
				cargo = $('#detpol-cargo').val();
				abono = $('#detpol-abono').val();
				desc = $('#detpol-concepto').val();
				gastoOficina = $('#detpol-gtoficina').attr('db-id');
				proveedor = $('#detpol-proveedores').attr('db-id');

				if(cuenta == ""){
					alertify.error("Seleccione una cuenta");
					$('#detpol-cuenta').focus();
					return false;
				}else{
					if(desc == ""){
						alertify.error("Ingrese una descripción");
						$('#detpol-concepto').focus();
						return false;
					}else{
						if( (cargo == 0 && abono == 0) || (cargo > 0 && abono > 0) ){
							alertify.error("Ingrese un importe")
							$('#detpol-cargo').focus();
							if(cargo > 0 && abono > 0){ $('#detpol-cargo').val(0); $('#detpol-abono').val(0); }
							return false
						}else{
							st = $('#detpol-cuenta').val();
							if( validarCtasGastoOficina(st) == true || validarCtasCliente(st) || validarCtasPagosCliente(st) ){

								if( validarCtasGastoOficina(st) == true ){
									if( gastoOficina == ''){
										alertify.error("Seleccione una Oficina");
										$('#detpol-gtoficina').focus();
										return false
									}else{
										inserta();
									}
								}

								if( validarCtasCliente(st) == true ){
									if( cuenta == '0208-00001'){
										$('#detpol-cliente').attr('db-id')='';
										$('#detpol-cliente').val('');
										id_cliente = 0;
										inserta();
									}else{
										if(id_cliente == ''){
											alertify.error("Seleccione un Cliente");
											$('#detpol-cliente').focus();
											return false
										}else{
											parte_Cuenta = cuenta.split('-');
											parte_Cliente = id_cliente.split('_');
											if( parte_Cuenta[1].search(parte_Cliente[1]) == -1){
												alertify.error("La cuenta contable no corresponde al cliente seleccionado");
												$('#detpol-cliente').focus();
												return false
											}else{
												Inserta();
											}
										}
									}
								}

							}else{
								inserta();
							}
						}
					}
				}
			}else{
				return false;
			}
  });

  $('.consultar').click(function(){
        var accion = $(this).attr('accion');
        var status = $(this).attr('status');

        $('#selecTipoPoliza').find('a').css('color', "");
        $('#selecTipoPoliza').find('a').css('font-size', "");
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');


        switch (accion) {
          case "poldiario":
						$('#gpoliza').fadeIn();
						$('#diatipo').val('4 Diario');
						$('#diatipo').attr('db-id','4');
            $('#cheques').hide();
            $('#anticipos').hide();
            break;

          case "polingreso":
						$('#gpoliza').fadeIn();
						$('#diatipo').val('2 Ingreso');
						$('#diatipo').attr('db-id','2');
            $('#cheques').hide();
            $('#anticipos').hide();
            break;

            case "dtospol":
            if (status == 'cerrado') {
              $('#datospoliza').fadeIn();
              $(this).attr('status', 'abierto');
              $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
              $(this).css('font-size', '20px');
            } else {
              $('#datospoliza').fadeOut();
              $(this).attr('status', 'cerrado');
              $(this).css('color', "");
              $(this).css('font-size', "");
            }
              break;
          default:
          console.error("Something went terribly wrong...");

        }

    });

		$('#genFolioPolDia').click(function(){

				if($('#diafecha').val() == ""){
					alertify.error("Seleccione una fecha");
					$('#diafecha').focus();
					return false;
				}

				if($('#diaconcepto').val() == ""){
					alertify.error("Escriba un concepto");
					$('#diaconcepto').focus();
					return false;
				}

				fecha = $('#diafecha').val();
				aduana = $('#diaaduana').val();
				tipoDoc = $('#diatipo').attr('db-id');
				usuario = $('#diausuario').val();
				permiso = "s_generar_x_fecha_polizas";

				var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
				//console.log(continuar);
				if(continuar == true) {
					genPol();
				}else{
					//swal("Oops!", "Solicite cambio de fechas a Contabilidad", 'error');
					return false;
				}
		});

		$('#guardarPolMST').click(function(){
			var data = {
				tipo: $('#mstpol-tipo').val(),
				id_poliza: $('#id_poliza').val(),
				fecha: $('#mstpol-fecha').val(),
				concepto: $('#mstpol-concepto').val()
			}

			$.ajax({
				type: "POST",
				url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/editarMST.php",
				data: data,
				success: 	function(r){
					console.log(r);
					r = JSON.parse(r);
					if (r.code == 1) {
						swal("Exito", "La Póliza se actualizó correctamente.", "success");
						//$('.real-time-search').keyup();
					} else {
						console.error(r.message);
					}
				},
				error: function(x){
					console.error(x);
				}

			});

		});


    $('#detallepoliza').click(function(){
      var data = {
        id_poliza: $('#id_poliza').val()
      }
      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/tabladetallepoliza.php",
        data: data,
        success: 	function(request){
					r = JSON.parse(request);

					if (r.code == 1) {
						$('#tabla_detallepoliza').html(r.data);
					}
        }
      });
    });

		$('tbody').on('click', '.editar-partidaPol', function(){
	    var dbid = $(this).attr('db-id');
	    var tar_modal = $($(this).attr('href'));
	    var fetch_cuenta = $.ajax({
	      method: 'POST',
	      data: {dbid: dbid},
	      url: 'actions/fetchPartidaPol.php'
	    });

	    fetch_cuenta.done(function(r){
	      r = JSON.parse(r);
	      if (r.code == 1) {

	      for (var key in r.data) {
	        if ($('#' + key).is('select')) {
	          continue;
	        }

	        if (r.data.hasOwnProperty(key)) {
	          $('#' + key).html(r['data'][key]).val(r['data'][key]).addClass('tiene-contenido');
	          if ( typeof($('#'+key).attr('db-id')) != 'undefined' && $('#'+key).attr('db-id') !== false) {
	            $('#' + key).attr('db-id', r['data'][key]);
	          }
	        }
	      }

	      //$('#s_cta_status').val(r.data.s_cta_status);
	      $('#medit-ctas').attr('db-id', r.data.pk_partida);

	      tar_modal.modal('show');
	      } else {
	        console.error(r);
	      }
	    })

	  })

		$('#medit-partida').click(function(){
		//Código para editar el modal, declaración de variables y ajax.

/*
			if($('#medit-ctaSAT').attr('db-id') == ""){
				alertify.error("Seleccione cuenta del SAT");
				$('#medit-ctaSAT').focus();
				return false;
			}

			if($('#medit-concepto').val() == ""){
				alertify.error("Asigne un concepto");
				$('#medit-concepto').focus();
				return false;
			}

			if($('#medit-status').val() == ""){
				alertify.error("Seleccione el estatutus de captura");
				$('#medit-status').focus();
				return false;
			}


			if($('#medit-naturSAT').attr('db-id') == ""){
				alertify.error("Seleccione Naturaleza de la cuenta");
				$('#medit-naturSAT').focus();
				return false;
			}

			if($('#medit-prodServ').attr('db-id') == ""){
				alertify.error("Seleccione clave de producto");
				$('#medit-prodServ').focus();
				return false;
			}
*/
			alert( $('#fk_id_poliza').val());
				var data = {
					partida: $('#pk_partida').val(),
					id_poliza: $('#fk_id_poliza').val(),
					fecha: $('#d_fecha').val(),
					id_referencia: $('#fk_referencia').attr('db-id'),
					tipo: $('#fk_tipo').val(),
					cuenta: $('#fk_id_cuenta').attr('db-id'),
					id_cliente: $('#fk_id_cliente').attr('db-id'),
					documento: $('#s_folioCFDIext').val(),
					factura: $('#fk_factura').attr('db-id'),
					anticipo: $('#fk_anticipo').attr('db-id'),
					cheque: $('#fk_cheque').attr('db-id'),
					cargo: $('#n_cargo').val(),
					abono: $('#n_abono').val(),
					desc: $('#s_desc').val(),
					$gastoOficina: $('#fk_gastoAduana').attr('db-id'),
					$proveedor: $('#fk_id_proveedor').attr('db-id')

				}

				$.ajax({
					type: "POST",
					url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/editar.php",
					data: data,
					success: 	function(r){
						console.log(r);
						r = JSON.parse(r);
						if (r.code == 1) {
							swal("Exito", "La cuenta se actualizó correctamente.", "success");
							$('.real-time-search').keyup();
						} else {
							console.error(r.message);
						}
					},
					error: function(x){
						console.error(x);
					}

				});
		$('#detpol-editarRegPolDiario').modal('hide');
	})
});

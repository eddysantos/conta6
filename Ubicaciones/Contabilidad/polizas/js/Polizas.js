$(document).ready(function(){
	ultReg_Det();
	detallePoliza();

	$('#fk_id_cuenta').change(function(){
	    st = $('#fk_id_cuenta').val();
	    nombreCta = st.split('-');

	    if( validarCtasGastoOficina(st) == true ){
	      //ACTIVAR GASTO OFICINA
	      $('.gto_fk_gastoAduana').show();
	      $('#fk_gasto').val('');
	      $('#fk_gasto').attr('db-id','');
	      $('#fk_id_cliente').attr('db-id','')
	    }else{
	      $('.gto_fk_gastoAduana').hide();
	      $('#fk_gasto').val('');
	      $('#fk_gasto').attr('db-id','');
	    }

	    if(st.substring(0,4) == '0110' && $('#fk_referencia').val() == ""){
	      $('#fk_referencia').focus();
	      alertify.error("Referencia es requerido");
	      $('#fk_id_cliente').val('');
	      $('#fk_id_cliente').attr('db-id','');
	      $('#detpol-clienteCorresp').val('');
	    }else{
	      $('#fk_id_cliente').attr('action','clientes');
	    }

	    if(st.substring(0,4) == '0206'){
	      //ACTIVAR PROVEEDORES
	      $('.gto_fk_gastoAduana').show();
	      $('#fk_id_proveedor').val('');
	      $('#fk_id_proveedor').attr('db-id','');
	    }else{
	      // $('#fk_id_proveedor').prop( 'disabled', true );
	      $('#fk_id_proveedor').val('');
	      $('#fk_id_proveedor').attr('db-id','');
	    }


	    $('#s_desc').val($.trim(nombreCta[2]));

	});

	$('#detpol-referencia' || '#fk_referencia').change(function(){
    eliminaBlancosIntermedios(this);
		todasMayusculas(this);
    validaReferencia(this);
  });

	$('#detpol-referencia').change(function(){
		 buscarReferenciaPol();
	 });
	$('#fk_referencia').change(function(){ buscarReferenciaPolModal(); });
  $('#detpol-cliente').change(function(){ lstCuentasPol(); });
  $('#detpol-clienteCorresp').change(function(){ lstCuentasPol(); });


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
			documento = $('#detpol-documento').val();
			factura = $('#detpol-factura').attr('db-id');
			anticipo = $('#detpol-anticipo').attr('db-id');
			cheque = $('#detpol-cheque').attr('db-id');
			cargo = $('#detpol-cargo').val();
			abono = $('#detpol-abono').val();
			desc = $('#detpol-concepto').val();
			gastoOficina = $('#detpol-gtoficina').attr('db-id');
			proveedor = $('#detpol-proveedores').attr('db-id');

			if (id_referencia == 'SN' || id_referencia == '') {
				id_cliente = $('#detpol-cliente').attr('db-id');
			}else {
				id_cliente = $('#detpol-clienteCorresp').val();
			}

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
						if( validarCtasGastoOficina(st) == true || validarCtasCliente(st) == true || validarCtasPagosCliente(st) == true ){

							if( validarCtasGastoOficina(st) == true ){
								if( gastoOficina == ''){
									alertify.error("Seleccione una Oficina");
									$('#detpol-gtoficina').focus();
									return false
								}else{
									inserta();
								}
							}

							if (validarCtasPagosCliente(st) == true) {
								if (id_referencia == 0){
									alertify.error("Ingrese n\u00FAmero de Referencia");
									$('#detpol-referencia').focus();
									return false;
								}else{
									//SIEMPRE VALIDAR QUE LA REFERENCIA EXISTA EN LA TABLA DE REFERENCIAS
									if (id_referencia != "SN" ){
										if (id_cliente == 0){
											alertify.error("Seleccione un Cliente");
											$('#detpol-cliente').focus();
											return false
										}else{
											inserta();
										}
									}else{
										if (id_cliente == 0){
											alertify.error("Seleccione un Cliente");
											$('#detpol-cliente').focus();
											return false
										}else{
											inserta();
										}
									}
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
											inserta();
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



	// NOTE: se movio directamente al archivo de generar poliza
  // $('.pol').click(function(){
  //   var accion = $(this).attr('accion');
  //   var status = $(this).attr('status');
	//
  //   $('#selecTipoPoliza').find('a').css('color', "");
  //   $('#selecTipoPoliza').find('a').css('font-size', "");
  //   $(this).attr('status', 'abierto');
	// 	$(this).css('cssText', 'color: #58595b!important');
  //   $(this).css('cssText', 'font-weight: bold!important');
  //   $(this).css('font-size', '18px');
	//
	//
  //   switch (accion) {
  //     case "poldiario":
	// 			$('#gpoliza').fadeIn();
	// 			$('#diatipo').val('4 Diario');
	// 			$('#diatipo').attr('db-id','4');
  //       break;
	//
  //     case "polingreso":
	// 			$('#gpoliza').fadeIn();
	// 			$('#diatipo').val('2 Ingreso');
	// 			$('#diatipo').attr('db-id','2');
  //       break;
	//
  //       case "dtospol":
  //       if (status == 'cerrado') {
  //         $('#datospoliza').fadeIn();
  //         $(this).attr('status', 'abierto');
  //         $(this).css('cssText', 'color: #58595b!important');
	// 				$(this).css('cssText', 'font-weight: bold!important');
  //         $(this).css('font-size', '18px');
  //       } else {
  //         $('#datospoliza').fadeOut();
  //         $(this).attr('status', 'cerrado');
  //         $(this).css('color', "");
  //         $(this).css('font-size', "");
  //       }
  //         break;
  //     default:
  //     console.error("Something went terribly wrong...");
	//
  //   }
	//
  //   });
	//
	// $('#genFolioPolDia').click(function(){
	// 	if($('#diafecha').val() == ""){
	// 		alertify.error("Seleccione una fecha");
	// 		$('#diafecha').focus();
	// 		return false;
	// 	}
	//
	// 	if($('#diaconcepto').val() == ""){
	// 		alertify.error("Escriba un concepto");
	// 		$('#diaconcepto').focus();
	// 		return false;
	// 	}
	//
	// 	fecha = $('#diafecha').val();
	// 	aduana = $('#diaaduana').val();
	// 	tipoDoc = $('#diatipo').attr('db-id');
	// 	usuario = $('#diausuario').val();
	// 	permiso = "s_generar_x_fecha_polizas";
	//
	// 	var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
	// 	if(continuar == true) {
	// 		genPol(); //funsion para generar poliza
	// 	}else{
	// 		return false;
	// 	}
	// });



		$('#guardarPolMST').click(function(){
			var data = {
				tipo: $('#mstpol-tipo').val(),
				id_poliza: $('#id_poliza').val(),
				fecha: $('#mstpol-fecha').val(),
				concepto: $('#mstpol-concepto').val()
			}

			$.ajax({
				type: "POST",
				url: "/Ubicaciones/Contabilidad/polizas/actions/editarMST.php",
				data: data,
				success: 	function(r){
					console.log(r);
					r = JSON.parse(r);
					if (r.code == 1) {
						swal("Exito", "La Póliza se actualizó correctamente.", "success");
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
        url: "/Ubicaciones/Contabilidad/polizas/actions/tabladetallepoliza.php",
        data: data,
        success: 	function(request){
					r = JSON.parse(request);

					if (r.code == 1) {
						$('#tabla_detallepoliza').html(r.data);
					}
        }
      });
    });


//
		$('div').on('click', '.buscarFacturas-sueldos', function(){
			var data = {
				regimen : '02'
			}
//console.log(data);
			$.ajax({
				type: "POST",
				url: "/Ubicaciones/Contabilidad/polizas/actions/buscarFacturasNomina_lista.php",
				data: data,
				success: 	function(r){
					r = JSON.parse(r);
					if (r.code == 1) {
						//console.log(r);
						$('#detpol-Sueldos-lista').html(r.data);
					} else {
						console.error(r.message);
					}
				},
				error: function(x){
					console.error(x);
				}
			});

		});

		$('div').on('click', '.buscarFacturas-honorarios', function(){
			var data = {
				regimen : '09'
			}
//console.log(data);
			$.ajax({
				type: "POST",
				url: "/Ubicaciones/Contabilidad/polizas/actions/buscarFacturasNomina_lista.php",
				data: data,
				success: 	function(r){
					r = JSON.parse(r);
					if (r.code == 1) {
						//console.log(r);
						$('#detpol-Honorarios-lista').html(r.data);
					} else {
						console.error(r.message);
					}
				},
				error: function(x){
					console.error(x);
				}
			});

		});

		$('tbody').on('click', '.buscarFacturas-polizas', function(){
			cadena = $('#detpol-cliente').val();
			parte = cadena.split('-');
			nombre = parte[0] + parte[1];
			$('#detpol-cliente-nombre').val(nombre);

			var data = {
				cliente : $('#detpol-cliente').attr('db-id'),
				fecha : $('#mstpol-fecha').val(),
				id_poliza : $('#id_poliza').val(),
				tipo : $('#mstpol-tipo').val()
			}

			$.ajax({
				type: "POST",
				url: "/Ubicaciones/Contabilidad/polizas/actions/buscarFacturas_lista.php",
				data: data,
				success: 	function(r){
					r = JSON.parse(r);
					if (r.code == 1) {
						$('#detpol-buscarfacturas-lista').html(r.data);
					} else {
						console.error(r.message);
					}
				},
				error: function(x){
					console.error(x);
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

	      $('#medit-partida').attr('db-id', r.data.pk_partida);
	      tar_modal.modal('show');
	      } else {
	        console.error(r);
	      }
	    })

	  })

// adri: lo pase a modales.js => actualizaRegPol()
	// 	$('#medit-partida').click(function(){
	// 		var id_referencia = $('#fk_referencia').attr('db-id');
	//
	// 	  if (id_referencia == 'SN' || id_referencia == '') {
	// 	    cliente = $('#fk_id_cliente').attr('db-id');
	// 	  }else {
	// 	    cliente = $('#modalpol-clienteCorresp').val();
	// 	  }
	//
	//
	// 		var data = {
	// 			partida: $('#pk_partida').val(),
	// 			id_poliza: $('#fk_id_poliza').val(),
	// 			fecha: $('#d_fecha').val(),
	// 			id_referencia: id_referencia,
	// 			tipo: $('#fk_tipo').val(),
	// 			cuenta: $('#fk_id_cuenta').attr('db-id'),
	// 			id_cliente: cliente,
	// 			documento: $('#s_folioCFDIext').val(),
	// 			factura: $('#fk_factura').attr('db-id'),
	// 			anticipo: $('#fk_anticipo').attr('db-id'),
	// 			cheque: $('#fk_cheque').attr('db-id'),
	// 			cargo: $('#n_cargo').val(),
	// 			abono: $('#n_abono').val(),
	// 			desc: $('#s_desc').val(),
	// 			gastoOficina: $('#fk_gastoAduana').attr('db-id'),
	// 			proveedor: $('#fk_id_proveedor').attr('db-id')
	// 		}
	//
	// 		$.ajax({
	// 			type: "POST",
	// 			url: "/Ubicaciones/Contabilidad/polizas/actions/editar.php",
	// 			data: data,
	// 			success: 	function(r){
	// 				console.log(r);
	// 				r = JSON.parse(r);
	// 				if (r.code == 1) {
	// 					swal("Exito", "La cuenta se actualizó correctamente.", "success");
	//
	// 					window.location.reload();
	// 				} else {
	// 					console.error(r.message);
	// 				}
	// 			},
	// 			error: function(x){
	// 				console.error(x);
	// 			}
	// 		});
	// 	$('#detpol-editarRegPolDiario').modal('hide');
	// });

	$('body').on('')


	$('#detpol-buscarfacturas-lista').on('click','.checkbox-facpend',function(){
		//alert('si di click');
		// return false;
		activado = $(this).parents('tr').find('.facpend-check').prop('checked');
		cadena = $('#detpol-cliente').val();
		parte = cadena.split('-');

		if( activado == true ){
			accion = "insertar";
		}else{
			accion = "borrar";
		}

		var data = {
			id_poliza : $('#id_poliza').val(),
			id_cliente : parte[0],
			nombre : parte[1],
			fecha : $('#mstpol-fecha').val(),
			tipo : $('#mstpol-tipo').val(),
			referencia : $(this).parents('tr').find('.facpend-referencia').val(),
			factura : $(this).parents('tr').find('.facpend-factura').val(),
			ctagastos : $(this).parents('tr').find('.facpend-ctagastos').val(),
			nc : $(this).parents('tr').find('.facpend-nc').val(),
			saldo : $(this).parents('tr').find('.facpend-saldo').val(),
			pago : $(this).parents('tr').find('.facpend-pago').val(),
			cuenta : $(this).parents('tr').find('.facpend-cta').val(),
			accion : accion
		}

		$.ajax({
			type: "POST",
			url: "/Ubicaciones/Contabilidad/polizas/actions/buscarFacturas_insertaReg_detallePoliza.php",
			data: data,
			success: 	function(r){
				// console.log(data);
				// console.log(r);
				r = JSON.parse(r);
				if (r.code == 1) {
					alertify.success(r.data);
					ultReg_Det();
				} else {
					console.error(r.message);
				}
			},
			error: function(x){
				console.error(x);
			}
		});

	});

	$('#detpol-Sueldos-lista,#detpol-Honorarios-lista').on('click','.checkbox-nompend',function(){
		activado = $(this).parents('tr').find('.nompend-check').prop('checked');
		if( activado == true ){
			accion = "insertar";
		}else{
			accion = "borrar";
		}
		var data = {
			id_poliza : $('#id_poliza').val(),
			concepto : $('#mstpol-concepto').val(),
			fecha : $('#mstpol-fecha').val(),
			tipo : $('#mstpol-tipo').val(),
			factura : $(this).parents('tr').find('.nompend-factura').val(),
			nombre : $(this).parents('tr').find('.nompend-nombre').val(),
			importe : $(this).parents('tr').find('.nompend-neto').val(),
			regimen : $(this).parents('tr').find('.nompend-regimen').val(),
			accion : accion
		}
		$.ajax({
			type: "POST",
			url: "/Ubicaciones/Contabilidad/polizas/actions/buscarFacturasNomina_insertaReg_detallePoliza.php",
			data: data,
			success: 	function(r){
				r = JSON.parse(r);
				if (r.code == 1) {
					alertify.success(r.data);
					ultReg_Det();
					detallePoliza();
				} else {
					console.error(r.message);
				}
			},
			error: function(x){
				console.error(x);
			}
		});

	});

	$('#folioPol').keydown(function(e){
		if (e.keyCode === 13 || e.keyCode === 9) {
			 buscarPoliza('modificar');
		}
	})

	$('#folioPolconsulta').keydown(function(e){
		if (e.keyCode === 13 || e.keyCode === 9) {
			 buscarPoliza('consultar');
		}
	})

}); // fin del documento


function inserta(){
	var id_referencia = $('#detpol-referencia').attr('db-id');

	if (id_referencia == 'SN' || id_referencia == '') {
		cliente = $('#detpol-cliente').attr('db-id');
	}else {
		cliente = $('#detpol-clienteCorresp').val();
	}
	var data = {
		id_poliza: $('#id_poliza').val(),
		fecha: $('#mstpol-fecha').val(),
		id_referencia: id_referencia,
		tipo: $('#mstpol-tipo').val(),
		cuenta: $('#detpol-cuenta').attr('db-id'),
		id_cliente: cliente,
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
		url: "/Ubicaciones/Contabilidad/polizas/actions/agregar.php",
		data: data,
		success: 	function(r){
			console.log(r);
			r = JSON.parse(r);
			if (r.code == 1) {
				swal("Exito", "Se registro correctamente.", "success");
				ultReg_Det();
				location.reload();
			} else {
				alertify.error("No puede haber registros iguales!");
				console.error(r.message);
				return false;
			}
		},
		error: function(x){
			console.error(x);
		}

	});
}

// MOSTRAR ULTIMOS 3 REGISTROS
function ultReg_Det(){
	var data = {
    id_poliza: $('#id_poliza').val()
  }
	$.ajax({
    type: "POST",
    url: "/Ubicaciones/Contabilidad/polizas/actions/ultimosRegistros.php",
    data: data,
    success: 	function(request){
			r = JSON.parse(request);

			if (r.code == 1) {
				$('#ultimosRegistros').html(r.data);
			}
    }
  });
}


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
				url: "/Ubicaciones/Contabilidad/polizas/actions/eliminar.php",
				data: data,

					success: 	function(r){
						r = JSON.parse(r);
						console.log(data);
						console.log(r);
					if (r.code == 1) {
						swal("Eliminado!", "Se elimino correctamente.", "success");
						// $('#detallepoliza').click();
						ultReg_Det();
						location.reload();
					} else {
						console.error(r.message);
					}
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
				url: "/Ubicaciones/Contabilidad/polizas/actions/cancelaDescancelaPoliza.php",
				data: data,
				success: 	function(r){
					console.log(r);
					r = JSON.parse(r);
					if (r.code == 1) {
						swal("Exito", "Se actualizó correctamente.", "success");
						$('#datospoliza').fadeIn();
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



// NOTE: se movio a modales.js porque se utiliza en mas de un modulo
// function validarCtasGastoOficina(st){
// 	/* CUENTAS QUE REQUIEREN ASIGNAR OFICINA PARA REFLEJAR EL GASTO */
// 	nombreCta = st.split('-');
//
// 	if(st.substring(0,2) == '05' ||
// 	   st.substring(0,4) == '0147' || st.substring(0,4) == '0148' || st.substring(0,4) == '0149' ||
// 		 st.substring(0,4) == '0420' || st.substring(0,4) == '0430' ||
// 		 st.substring(0,10) == '0168-00005' ||
// 		 st.substring(0,10) == '0201-00002' || st.substring(0,10) == '0201-00003' || st.substring(0,10) == '0201-00004' ||
// 		 st.substring(0,10) == '0201-00005' || st.substring(0,10) == '0201-00006' || st.substring(0,10) == '0201-00007' ){
//
// 		 return true;
// 	}
// }


// function validarCtasCliente(st){
// 	/* CUENTAS QUE REQUIEREN ASIGNAR CLIENTE */
// 	nombreCta = st.split('-');
//
// 	if(st.substring(0,4) == '0108' || st.substring(0,4) == '0208' || st.substring(0,4) == '0106' || st.substring(0,4) == '0203'){
// 		 return true;
// 	}
// }
//
//
// function validarCtasPagosCliente(st){
// 	/* CUENTAS QUE REQUIEREN ASIGNAR CLIENTE */
// 	nombreCta = st.split('-');
//
// 	if(st.substring(0,4) == '0110'){
// 		 return true;
// 	}
// }



$('#folioPol').keydown(function(e){
	if (e.keyCode === 13 || e.keyCode === 9) {
		 buscarPoliza('modificar');
	}
})

$('#folioPolconsulta').keydown(function(e){
	if (e.keyCode === 13 || e.keyCode === 9) {
		 buscarPoliza('consultar');
	}
});


// NOTE: se movieron para archivo modales.js ya que se llaman en toda la pagina

// $('#btn_asignarProveedor').click(function(){
// 	id_poliza = $('#folioPolAsignar').val();
// 	window.location.replace('/Ubicaciones/Contabilidad/Proveedores/AsignarProveedor.php?id_poliza='+id_poliza);
// });
//
// function buscarPoliza(Accion){
// 	if( Accion == 'consultar'){ id_poliza = $('#folioPolconsulta').val(); }
// 	if( Accion == 'modificar'){ id_poliza = $('#folioPol').val(); }
// 	window.location.replace('/Ubicaciones/Contabilidad/polizas/actions/buscar_poliza.php?id_poliza='+id_poliza+'&Accion='+Accion);
// }

function Actualiza_Cuenta(){
		st = $('#detpol-cuenta').val();
    nombreCta = st.split('-');

		if( validarCtasGastoOficina(st) == true ){
      //ACTIVAR GASTO OFICINA
      $('.gto').show();
      $('#detpol-gtoficina').val('');
			$('#detpol-gtoficina').attr('db-id','');
      $('#detpol-cliente').attr('db-id','')
		}else{
      $('.gto').hide();
      $('#detpol-gtoficina').val('');
			$('#detpol-gtoficina').attr('db-id','');
		}

		if(st.substring(0,4) == '0110' && $('#detpol-referencia').val() == ""){
			$('#detpol-referencia').focus();
      alertify.error("Referencia es requerido");
      $('#detpol-cliente').val('');
      $('#detpol-cliente').attr('db-id','');
			$('#detpol-clienteCorresp').val('');
		}else{
      $('#detpol-cliente').attr('action','clientes');
		}

		if(st.substring(0,4) == '0206'){
			//ACTIVAR PROVEEDORES
			$('.gto').show();
			$('#detpol-proveedores').val('');
			$('#detpol-proveedores').attr('db-id','');
		}else{
			// $('#detpol-proveedores').prop( 'disabled', true );
			$('#detpol-proveedores').val('');
			$('#detpol-proveedores').attr('db-id','');
		}


    $('#detpol-concepto').val($.trim(nombreCta[2]));
		console.log(st);
}

// NOTE: se movio  a modales.js
// adry: lo descomente porque en formulario se llama detpol-concepto,detpol-gtoficina y en modal s_desc,fk_gastoAduana => valDescripOficina_modal()
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

// BOTON IMPRIMIR
function btn_printPoliza(id_poliza,aduana){
	// window.location.replace('/Ubicaciones/Contabilidad/polizas/actions/impresionPoliza.php?id_poliza='+id_poliza+'&aduana='+aduana);
	window.open('/Ubicaciones/Contabilidad/polizas/impresionPoliza.php?id_poliza='+id_poliza+'&aduana='+aduana);
};


function lstClientesReferenciaPol(){
	var data = {
		referencia: $('#detpol-referencia').attr('db-id')
	}

	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Contabilidad/actions/lst_clienteCorresponsal.php",
		data: data,
		success: 	function(r){

			r = JSON.parse(r);
			if (r.code == 1) {
				$('#detpol-clienteCorresp').html(r.data);
			} else {
				console.error(r.message);
			}
		},
		error: function(x){
			console.error(x);
		}
	});
}


function lstClientesReferenciaPolModal(){
	var data = {
		referencia: $('#fk_referencia').attr('db-id')
	}

	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Contabilidad/actions/lst_clienteCorresponsal.php",
		data: data,
		success: 	function(r){

			r = JSON.parse(r);
			if (r.code == 1) {
				//console.log(r.data);
				$('#modalpol-clienteCorresp').html(r.data);
			} else {
				console.error(r.message);
			}
		},
		error: function(x){
			console.error(x);
		}
	});
}


function buscarReferenciaPol(){
  ref = $('#detpol-referencia').val();
  Referencia = $('#detpol-referencia').attr('db-id');
  $('#detpol-btnguardar').prop('disabled',true);
  $('#detpol-lstClientes').hide();
  $('#detpol-lstClientesCorresp').val();
  $('#detpol-lstClientesCorresp').hide();


		if(ref == "0" || ref == "SN" || ref  == ""){
	    $('#detpol-btnguardar').prop('disabled',false);
	    $('#detpol-lstClientes').show();
	    $('#detpol-lstClientesCorresp').val();
	    $('#detpol-lstClientesCorresp').hide();
		}else{
	    if(Referencia != ""){
	      $('#detpol-lstClientesCorresp').val();
	      lstClientesReferenciaPol();
				$('#detpol-btnguardar').prop('disabled',false);
	      $('#detpol-lstClientes').hide();
	      $('#detpol-lstClientesCorresp').show();
			}
	}
}


function buscarReferenciaPolModal(){
  ref = $('#fk_referencia').val();
  Referencia = $('#fk_referencia').attr('db-id');
  $('#medit-partida').prop('disabled',true);
  $('#modalpol-lstClientes').hide();
  $('#modalpol-lstClientesCorresp').val();
  $('#modalpol-lstClientesCorresp').hide();


		if(ref == "0" || ref == "SN" || ref  == ""){

    $('#medit-partida').prop('disabled',false);
    $('#modalpol-lstClientes').show();
    $('#modalpol-lstClientesCorresp').val();
    $('#modalpol-lstClientesCorresp').hide();
		$('#fk_id_cliente').removeAttr("readonly").focus().val("");


		}else{
    if(Referencia != ""){
      $('#modalpol-lstClientesCorresp').val();
      lstClientesReferenciaPolModal();
			$('#medit-partida').prop('disabled',false);
      $('#modalpol-lstClientes').hide();
      $('#modalpol-lstClientesCorresp').show();
		}
	}
}


function lstCuentasPol(){
	ref = $('#detpol-referencia').val();
	if(ref == "0" || ref == "SN" || ref == ""){
		id_cliente = $('#detpol-cliente').attr('db-id');
	}else{
		id_cliente = $('#detpol-clienteCorresp').val();
	}

	var data = {
		id_cliente: id_cliente
	}

	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Contabilidad/actions/lst_clienteCorresponsal_ctas.php",
		data: data,
		success: 	function(r){

			r = JSON.parse(r);
			if (r.code == 1) {
				//console.log(r.data);
				$('#detpol-clienteCorrespCtas').html(r.data);
			} else {
				console.error(r.message);
			}
		},
		error: function(x){
			console.error(x);
		}
	});
}


function detallePoliza(){
	var data = {
		id_poliza: $('#id_poliza').val()
	}

	var ajaxCall = $.ajax({
      method: 'POST',
      data: data,
      url: "/Ubicaciones/Contabilidad/polizas/actions/tabladetallepoliza.php",
  });

  ajaxCall.done(function(r) {
    r = JSON.parse(r);
    if (r.code == 1) {
      $('#tabla_detallepoliza').html(r.data);
    } else {
      console.error(r.message);
    }
  });
}

$(document).ready(function(){
  //detalleanticipo.php
  $('#lstClientesCorresp').hide();
  $('#ant-referencia').change(function(){
    eliminaBlancosIntermedios(this);
    todasMayusculas(this);
    buscarReferenciaAnt();
  });
  $('#ant-referencia').change(function(){ buscarReferenciaAnt(); });
  $('#ant-cliente').change(function(){ lstCuentasAnt(); });
  $('#ant-clienteCorresp').change(function(){ lstCuentasAnt(); });
  ///////////////////////

  //editarRegistro.php no FUNCIONA
  $('#lstClientesCorrespPartida').hide();
  $('#fk_referencia').change(function(){
    console.log($('#fk_referencia').val());
    eliminaBlancosIntermedios(this);
    todasMayusculas(this);
    buscarReferenciaAntPartida();
  });
  $('#fk_referencia').change(function(){ buscarReferenciaAntPartida(); });
  // $('#fk_id_cliente_antdet').change(function(){ lstCuentasAnt(); });
  //$('#ant-clienteCorresp').change(function(){ lstCuentasAnt(); });
  ///////////////////////////


//******************************************************************************
//                             GENERAR ANTICIPO
//******************************************************************************



//GENERAR FOLIO ANTICIPO
$('#genFolioAnticipo').click(function(){

  if($('#antfecha').val() == ""){
    alertify.error("Seleccione una fecha");
    $('#antfecha').focus();
    return false;
  }

  if($('#antimporte').val() == "" || $('#antimporte').val() == 0){
    alertify.error("Ingrese un importe");
    $('#antimporte').focus();
    return false;
  }

  if($('#antcliente').attr('db-id') == ""){
    alertify.error("Seleccione un cliente");
    $('#antcliente').focus();
    return false;
  }

  if($('#antbcocliente').val() == "" || $('#antbcocliente').val() == 0){
    alertify.error("Seleccione un banco");
    $('#antbcocliente').focus();
    return false;
  }

  if($('#antcuenta').val() == "" || $('#antcuenta').val() == 0){
    alertify.error("Seleccione una cuenta");
    $('#antcuenta').focus();
    return false;
  }

  if($('#antconcepto').val() == ""){
    alertify.error("Ingrese un concepto");
    $('#antconcepto').focus();
    return false;
  }

  fecha = $('#antfecha').val();
  aduana = $('#txt_aduana').val();
  tipoDoc = 5;
  usuario = $('#txt_usuario').val();
  permiso = "s_generar_x_fecha_anticipos";

  var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
  //console.log(continuar);
  if(continuar == true) {
    genAnt();
  }else{
    //swal("Oops!", "Solicite cambio de fechas a Contabilidad", 'error');
    return false;
  }
});

// GENERAR FOLIO DE ANTICIPO
function genAnt(){
  bancoclinte = $('#antbcocliente').val();
  parte = bancoclinte.split('+');
  banco = parte[0];
  bancocta = parte[1];

	var data = {
		antfecha: $('#antfecha').val(),
    antvalor: $('#antimporte').val(),
    antcliente: $('#antcliente').attr('db-id'),
    antbanco: banco,
    bancocta: bancocta,
		antconcepto: $('#antconcepto').val(),
		antaduana: $('#txt_aduana').val(),
    antusuario: $('#txt_usuario').val(),
		antcuenta: $('#antcuenta').val()
	}

	tipo = 5;
	$.ajax({
		type: "POST",
		url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/generarFolioAnticipo.php",
		data: data,
		success: 	function(r){
		r = JSON.parse(r);
    if (r.code == 1) {
        //console.log(r.data);
        id_anticipo = r.data;
        window.location.replace('Detalleanticipo.php?id_anticipo='+id_anticipo);
      } else {
        console.error(r.message);
      }
    },
    error: function(x){
      console.error(x);
    }
	});
}

//BOTON GENERAR POLIZA DE ANTICIPO
  $('#btn_generarPolAnt').click(function(){
    var data = {
  		diafecha: $('#mst-fecha').val(),
  		diaconcepto: $('#mst-concepto').val(),
  		diaaduana: $('#aduana_activa').val(),
  		diatipo: 5,
      anticipo: $('#mst-anticipo').val(),
      cuentaMST: $('#mst-ctaMST').val(),
      importe: $('#mst-importe').val(),
	    id_cliente: $('#mst-cliente').val()
  	}

    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/generarPolizaAnticipo.php",
      data: data,
      success: 	function(r){
        console.log(r);
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Exito", "Se generó correctamente.", "success");
          setTimeout('document.location.reload()',700);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }

    });
  });



//*******************************************************************************
//                              DATOS DE ANTICIPO
//*******************************************************************************

//VISUALIZAR DIV DATOS DE ANTICIPO
  $('.dant').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    switch (accion) {
      case "dtosant":
      if (status == 'cerrado') {
        $('#datosanticipo').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#datosanticipo').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
      default:
        console.error("Something went terribly wrong...");
    }
  });


// MOSTRAR EN MODAL DATOS DE ANTICIPO
  $('tbody').on('click', '.editar-anticipoMST', function(){
      var dbid = $(this).attr('db-id');
      var tar_modal = $($(this).attr('href'));

      data_lst = {
        modulo: 'antGenClt',
        cliente: $('#antcliente').attr('db-id')
      }

      var lista_cuentas = $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/lst_cuentas.php",
        data: data_lst
      });

      var fetch_cuenta = $.ajax({
        method: 'POST',
        data: {dbid: dbid},
        url: 'actions/fetchAnticipoMST.php'
      });

      $.when(lista_cuentas, fetch_cuenta).done(function(r1, r2){
        //r1 = JSON.parse(r1);
        //console.log(r2);
        //console.log(r1);
        r1 = JSON.parse(r1[0]);
        r2 = JSON.parse(r2[0]);
        console.log(r2);
        if (r2.code == 1) {

        $('#fk_id_cuentaMST').html(r1.data);

        for (var key in r2.data) {


          if (r2.data.hasOwnProperty(key)) {

            if ($('#' + key).is('select')) {
              if (key == 'fk_id_cuentaMST') {
                $('#fk_id_cuentaMST').children().each(function(e){
                  var valor = $(this).val();
                  console.log(r2.data.fk_id_cuentaMST);
                  if (valor == r2.data.fk_id_cuentaMST) {
                    $(this).attr('selected', true);
                  } else {
                    $(this).attr('selected', false);
                  }
                });
              }
              continue;
            }

            $('#' + key).html(r2['data'][key]).val(r2['data'][key]).addClass('tiene-contenido');
            if ( typeof($('#'+key).attr('db-id')) != 'undefined' && $('#'+key).attr('db-id') !== false) {
              $('#' + key).attr('db-id', r2['data'][key]);
            }
          }
        }

        //$('#s_cta_status').val(r.data.s_cta_status);
        $('#medit-anticipoMST').attr('db-id', r2.data.pk_id_cuenta);

        tar_modal.modal('show');
        } else {
          console.error(r2);
        }
      });

      // fetch_cuenta.done(function(r){
      //   r = JSON.parse(r);
      //   if (r.code == 1) {
      //
      //   for (var key in r.data) {
      //     if ($('#' + key).is('select')) {
      //       continue;
      //     }
      //
      //     if (r.data.hasOwnProperty(key)) {
      //       $('#' + key).html(r['data'][key]).val(r['data'][key]).addClass('tiene-contenido');
      //       if ( typeof($('#'+key).attr('db-id')) != 'undefined' && $('#'+key).attr('db-id') !== false) {
      //         $('#' + key).attr('db-id', r['data'][key]);
      //       }
      //     }
      //   }
      //
      //   //$('#s_cta_status').val(r.data.s_cta_status);
      //   $('#medit-anticipoMST').attr('db-id', r.data.pk_id_cuenta);
      //
      //   tar_modal.modal('show');
      //   } else {
      //     console.error(r);
      //   }
      // })
  });


// VALIDACION DATOS DE ANTICIPO EN MODAL
  $('#medit-anticipoMST').click(function(){
      //Código para editar el modal, declaración de variables y ajax.
      if($('#d_fecha').val() == ""){
        alertify.error("Seleccione una fecha");
        $('#d_fecha').focus();
        return false;
      }

      if($('#n_valor').val() == "" || $('#n_valor').val() == 0){
        alertify.error("Ingrese un importe");
        $('#n_valor').focus();
        return false;
      }

      if($('#fk_id_cliente_antmst').attr('db-id') == ""){
        alertify.error("Seleccione un cliente");
        $('#fk_id_cliente_antmst').focus();
        return false;
      }

      if($('#s_bancoOri').val() == "" || $('#s_bancoOri').val() == 0){
        alertify.error("Seleccione un banco");
        $('#s_bancoOri').focus();
        return false;
      }

      if($('#fk_id_cuentaMST').val() == "" || $('#fk_id_cuentaMST').val() == 0){
        alertify.error("Seleccione una cuenta");
        $('#fk_id_cuentaMST').focus();
        return false;
      }

      if($('#s_concepto').val() == ""){
        alertify.error("Ingrese un concepto");
        $('#s_concepto').focus();
        return false;
      }

      fecha = $('#d_fecha').val();
      aduana = $('#txt_aduana').val();
      tipoDoc = 5;
      usuario = $('#txt_usuario').val();
      permiso = "s_generar_x_fecha_anticipos";

      var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
      //console.log(continuar);
      if(continuar == true) {
        modificarAntMST();
        //tar_modal.modal('show');
      }else{
        //swal("Oops!", "Solicite cambio de fechas a Contabilidad", 'error');
        return false;
      }
  });


// ACTUALIZAR DATOS DE ANTICIPO
  function modificarAntMST(){
    bancoclinte = $('#s_bancoOri').val();
    parte = bancoclinte.split('+');
    banco = parte[0];
    bancocta = parte[1];
    id_anticipo: $('#pk_id_anticipo').val();

    var data = {
      antfecha: $('#d_fecha').val(),
      antvalor: $('#n_valor').val(),
      antcliente: $('#fk_id_cliente_antmst').attr('db-id'),
      antbanco: banco,
      bancocta: bancocta,
      antconcepto: $('#s_concepto').val(),
      id_anticipo: $('#pk_id_anticipo').val(),
      antcuenta: $('#fk_id_cuentaMST').val(),
      id_poliza: $('#mst-poliza').val()
    }

    //console.log(data);
    tipo = 5;
    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/editarAnticipoMST.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
          if (r.code == 1) {
            swal("Exito", "La cuenta se actualizó correctamente.", "success");
            $('.real-time-search').keyup();
            setTimeout('document.location.reload()',700);
          } else {
            console.error(r.message);
          }
        },
        error: function(x){
          console.error(x);
        }
    });
  }


//*******************************************************************************
//                      CAPTURA DETALLE DE ANTICPO  (PARTIDA)
//*******************************************************************************


//BOTON REGISTRO EN DETALLE DE ANTICPO
  $('#btnRegDetAnt').click(function(){
		id_anticipo = $('#mst-anticipo').val();
		fecha = $('#mst-fecha').val();
		referencia = $('#ant-referencia').attr('db-id');
		cuenta= $('#ant-clienteCorrespCtas').val();
		cargo = $('#ant-cargo').val();
		abono = $('#ant-abono').val();

    if( referencia == 'SN' ){
      cliente = $('#ant-cliente').attr('db-id');
    }else{
      cliente = $('#ant-clienteCorresp').val();
    }

		parte_Cuenta = cuenta.split('+');
    id_cuenta = parte_Cuenta[0];
    id_cliente = parte_Cuenta[1];
    descrip = parte_Cuenta[2];
    parteCuentaMST = id_cuenta.split('-');

    if( referencia == "" ){
      alertify.error("Seleccione una Referencia");
      $('#ant-referencia').focus();
      return false;
    }
		//VALIDO CUENTA CONTABLE
		if (cuenta == "" || cuenta == null || cuenta == 0){
			alertify.error("Seleccione una Cuenta");
			$('#ant-clienteCorrespCtas').focus();
			return false;
		}else{
			//VALIDO QUE SE HAYA CAPTURADO UN IMPORTE
			if ( (cargo == 0 && abono == 0)|| (cargo > 0 && abono > 0) ){
				alertify.error("Ingrese un importe");
				$('#ant-cargo').focus();
				if( cargo > 0 && abono > 0){ $('#ant-cargo').val('0'); $('#ant-abono').val('0'); }
				return false
			}else{
				// VALIDO QUE LA CUENTA CONTABLE 0108 Y 0208 SEAN DEL MISMO CLIENTE
				if (parteCuentaMST[0] == '0108' || parteCuentaMST[0] == '0208'){
					if( id_cuenta == '0208-00001'){
						$('#ant-cliente').attr('db-id') = 0;
						Inserta();
					}else{
						if (id_cliente == 0){
							alertify.error("Seleccione un Cliente");
							return false
						}else{
							if( id_cliente.search(cliente) == -1){
								alertify.error("Cliente Incorrecto");
								return false
							}else{
								Inserta();
							}
						}
					}
				}else{
					Inserta();
				}//FIN CUENTAS
			}//FIN IMPORTE
		}//FIN CUENTA
  });


// AGREGAR PARTIDA A DETALLE DE ANTICIPO
    function Inserta(){
      anticipo = $('#mst-anticipo').val();
      referencia = $('#ant-referencia').attr('db-id');
      cuenta = $('#ant-clienteCorrespCtas').val();
      cargo = $('#ant-cargo').val();
      abono = $('#ant-abono').val();

      if( referencia == 'SN' ){
        cliente = $('#ant-cliente').attr('db-id');
      }else{
        cliente = $('#ant-clienteCorresp').val();
      }

      parte_Cuenta = cuenta.split('+');
      id_cuenta = parte_Cuenta[0];
      id_cliente = parte_Cuenta[1];
      descrip = parte_Cuenta[2];
      parteCuentaMST = id_cuenta.split('-');

      var data = {
        anticipo: $('#mst-anticipo').val(),
        fecha: $('#mst-fecha').val(),
        referencia: $('#ant-referencia').attr('db-id'),
        cuenta: id_cuenta,
        cliente: id_cliente,
        cargo: $('#ant-cargo').val(),
        abono: $('#ant-abono').val(),
        id_poliza: $('#mst-poliza').val(),
        descrip: descrip
      }

      fecha = $('#mst-fecha').val();
      aduana = $('#aduana_activa').val();
      tipoDoc = 5;
      usuario = $('#usuario_activo').val();
      permiso = "s_generar_x_fecha_anticipos";

      var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
      //console.log(continuar);
      if(continuar == true) {
        var continuarInsert = validarRegIgualAnticipo(anticipo,id_cuenta,referencia,id_cliente,descrip,cargo,abono);
        console.log(continuarInsert);
        if(continuarInsert == true) {
            $.ajax({
              type: "POST",
              url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/agregar.php",
              data: data,
              success: 	function(r){
                console.log(r);
                r = JSON.parse(r);
                if (r.code == 1) {
                  swal("Exito", "Se registro correctamente.", "success");
                  setTimeout('document.location.reload()',700);
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
      }else{
      	return false;
      }
    }


//*******************************************************************************
//                         DETALLE DE ANTICPO  (PARTIDAS)
//*******************************************************************************


// MOSTRAR DETALLE DE ANTICIPO
  $('#detalleanticipo').click(function(){
      var data = {
        id_anticipo: $('#mst-anticipo').val(),
      }
      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/tabla_detalleanticipo.php",
        data: data,
        success: 	function(request){
					r = JSON.parse(request);

					if (r.code == 1) {
						$('#tabla_detalleanticipo').html(r.data);
					}
        }
      });
  });

// MOSTRAR EN MODAL DATOS DE PARTIDA ANTICIPO
  $('tbody').on('click', '.editar-partidaAnt', function(){
    var dbid = $(this).attr('db-id');
    var tar_modal = $($(this).attr('href'));

    var fetch_cuenta = $.ajax({
      method: 'POST',
      data: {dbid: dbid},
      url: 'actions/fetchPartidaAnt.php'
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
      $('#btnRegDetAntPartida').attr('db-id', r.data.pk_partida);
      tar_modal.modal('show');
      } else {
        console.error(r);
      }
    })
  })

// EDITAR DATOS DE PARTIDA
  $('#btnRegDetAntPartida').click(function(){
    // validacion
    if($('#s_desc').val() == ""){
      alertify.error("Ingrese un concepto");
      $('#s_desc').focus();
      return false;
    }

    var data = {
      partida: $('#pk_partida').attr('db-id'),
      id_anticipo: $('#fk_id_anticipo').val(),
      id_referencia: $('#fk_referencia').attr('db-id'),
      id_cliente: $('#fk_id_cliente_antdet').attr('db-id'),
      cuenta: $('#fk_id_cuenta').val(),
      desc: $('#s_desc').val(),
      cargo: $('#n_cargo').val(),
      abono: $('#n_abono').val(),

      // fecha: $('#d_fecha').val(),
      // tipo: $('#fk_tipo').val(),
      // documento: $('#s_folioCFDIext').val(),
      // factura: $('#fk_factura').attr('db-id'),
      // anticipo: $('#fk_anticipo').attr('db-id'),
      // cheque: $('#fk_cheque').attr('db-id'),
      // $gastoOficina: $('#fk_gastoAduana').attr('db-id'),
      // $proveedor: $('#fk_id_proveedor').attr('db-id')
    }

    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/editar.php",
      data: data,
      success: 	function(r){
        console.log(r);
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Exito", "La cuenta se actualizó correctamente.", "success");
          $('.real-time-search').keyup();
          $('#detalleanticipo').click();
          // sumasCAanticipos();
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });
    $('#detant-editar').modal('hide');
  })
});



//*******************************************************************************
//                                 B O T O N E S
//*******************************************************************************


// BOTON IMPRIMIR ANTICIPO
$('#btn_prinAnt').click(function(){
  id_anticipo = $('#mst-anticipo').val();
  window.location.replace('/conta6/Ubicaciones/Contabilidad/anticipos/actions/impresion_anticipo.php?id_anticipo='+id_anticipo);
});


// BOTON REUSAR ANTICIPO
$('#btn_reusarAnt').click(function(){
  id_anticipo = $('#mst-anticipo').val();

	swal({
	title: "Estas Seguro?",
	text: "Ya no se podra recuperar los registros! "+ id_anticipo +" ",
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
				id_anticipo: id_anticipo,
        id_poliza: $('#mst-poliza').val()
			}
			$.ajax({
				type: "POST",
				url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/reusarAnticipo.php",
				data: data,

					success: 	function(r){
						console.log(r);
					if (r.code == 1) {
						swal("Eliminado!", "Se elimino correctamente.", "success");
						setTimeout('document.location.reload()',700);
					} else {
						console.error(r.message);
					}
				},
				error: function(x){
					console.error(x)
				}
			});
			swal("Eliminado!", "Se elimino correctamente.", "success");
			setTimeout('document.location.reload()',700);
		} else {
			swal("Cancelado", "El registro esta a salvo :)", "error");
		}
	});
});


//BOTON CANCELAR
$('#ant-cancela').change(function(){
	fecha = $('#mst-fecha').val();
	aduana = $('#aduana_activa').val();
	tipoDoc = 5;
	usuario = $('#usuario_activo').val();

	status = $('#ant-cancela').val();
	if( status == 1 ){ permiso = "s_cancelar_libre_anticipos"; }
	if( status == 0 ){ permiso = "s_descancelar_anticipos"; }


	var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
	if(continuar == true) {
		var data = {
			id_anticipo: $('#mst-anticipo').val(),
			status: $('#ant-cancela').val()
		}

			$.ajax({
				type: "POST",
				url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/editarStatusAnticipo.php",
				data: data,
				success: 	function(r){
					//console.log(fecha);
					r = JSON.parse(r);
					if (r.code == 1) {
						swal("Exito", "Se actualizó correctamente.", "success");
						setTimeout('document.location.reload()',700);
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
});


//*******************************************************************************
//                        ELIMINAR PARTIDA DE ANTICIPO
//*******************************************************************************

// ELIMINAR PARTIDA REGISTRO DE ANTICIPO
function borrarRegistroAnticipo(partida){
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
				id_anticipo: $('#mst-anticipo').val(),
        id_poliza: $('#mst-poliza').val()
			}
			$.ajax({
				type: "POST",
				url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/eliminar.php",
				data: data,

					success: 	function(r){
            r = JSON.parse(r);
						console.log(r);
					// if (r.code == 1) {
						swal("Eliminado!", "Se elimino correctamente.", "success");
            // setTimeout('document.location.reload()',700);
            $('#detalleanticipo').click();
            sumasCAanticipos();
					// } else {
					// 	console.error(r.message);
					// }
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



//*******************************************************************************
//                        OTRAS FUNCIONES Y VALIDACIONES
//*******************************************************************************

// VALIDAR REGISTRO DUPLICADO
  function validarRegIgualAnticipo(anticipo,cuenta,referencia,cliente,desc,cargo,abono){
  		var data = {
        anticipo: anticipo,
        cuenta: cuenta,
        referencia: referencia,
        cliente: cliente,
        desc: desc,
        cargo:cargo,
        abono:abono
  		}
      //console.log(data);
  		response = false;

  		var validar_reg = $.ajax({
  			type: "POST",
  			url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/validarRegIgualAnticipo.php",
  			data: data,
  			async: false
  		});

  		validar_reg.done(function(r){
  			//console.log(r);
  			r = JSON.parse(r);
  			if (r.code == 1) {
  				if(r.data == "conceptoValido"){
  					response = true;
  					//console.log(response);
  				}else{
  					swal(r.data, "Ya existe un concepto igual", "info");
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

  function Actualiza_Expedido_Cliente(){
    id_cliente = $('#antcliente').attr('db-id');
    lstCuentas('antGenClt',id_cliente);
    bcosClientes(id_cliente);
  }

  function Actualiza_Expedido_Cliente_MST(){
    id_cliente = $('#fk_id_cliente_antmst').attr('db-id');
    lstCuentas_MST('antGenClt',id_cliente);
    bcosClientes_MST(id_cliente);
  }

  function lstCuentas(modulo,id_cliente){
  	var data = {
      id_cliente: id_cliente,
      modulo: modulo
    }

    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/lst_cuentas.php",
      data: data,
      success: 	function(r){

        r = JSON.parse(r);
        if (r.code == 1) {
          //console.log(r.data);
          $('#antcuenta').html(r.data);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });
  }

  function lstCuentas_2(modulo,id_cliente){
  	var data = {
      id_cliente: id_cliente,
      modulo: modulo
    }

    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/lst_cuentas.php",
      data: data,
      success: 	function(r){

        r = JSON.parse(r);
        if (r.code == 1) {
          //console.log(r.data);
          console.log(r.data);
          return r.data;
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });
  }

  function lstCuentas_MST(modulo,id_cliente){
      var data = {
        id_cliente: id_cliente,
        modulo: modulo
      }

      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/lst_cuentas.php",
        data: data,
        success: 	function(r){

          r = JSON.parse(r);
          if (r.code == 1) {
            //console.log(r.data);
            $('#fk_id_cuentaMST').html(r.data);
          } else {
            console.error(r.message);
          }
        },
        error: function(x){
          console.error(x);
        }
      });
  }

  function lstCuentasAnt(){
    ref = $('#ant-referencia').val();
    if(ref == "0" || ref == "SN"){
      id_cliente = $('#ant-cliente').attr('db-id');
    }else{
      id_cliente = $('#ant-clienteCorresp').val();
    }

    var data = {
      id_cliente: id_cliente
    }

    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/actions/lst_clienteCorresponsal_ctas.php",
      data: data,
      success: 	function(r){

        r = JSON.parse(r);
        if (r.code == 1) {
          //console.log(r.data);
          $('#ant-clienteCorrespCtas').html(r.data);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });
  }

  function lstClientesReferencia(){
    var data = {
      referencia: $('#ant-referencia').attr('db-id')
    }

    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/actions/lst_clienteCorresponsal.php",
      data: data,
      success: 	function(r){

        r = JSON.parse(r);
        if (r.code == 1) {
          //console.log(r.data);
          $('#ant-clienteCorresp').html(r.data);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });
  }

  function bcosClientes(id_cliente){
    var data = {
      id_cliente: id_cliente
    }

    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/lst_bancos_clientes.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          //console.log(r.data);
          $('#antbcocliente').html(r.data);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });
  }


//LISTA BANCO DEL CLIENTE
function bcosClientes_MST(id_cliente){
  var data = {
    id_cliente: id_cliente
  }

  $.ajax({
    type: "POST",
    url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/lst_bancos_clientes.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        //console.log(r.data);
        $('#s_bancoOri').html(r.data);
      } else {
        console.error(r.message);
      }
    },
    error: function(x){
      console.error(x);
    }
  });
}



// BUSCAR ANTICIPO
function buscarAnticipo(Accion){
	if( Accion == 'consultar' ){
    id_anticipo = $('#folioAntConsulta').val();
    window.location.replace('/conta6/Ubicaciones/Contabilidad/anticipos/ConsultarAnticipo.php?id_anticipo='+id_anticipo);
  }
	if( Accion == 'modificar' ){
    id_anticipo = $('#folioAnt').val();
    window.location.replace('/conta6/Ubicaciones/Contabilidad/anticipos/Detalleanticipo.php?id_anticipo='+id_anticipo);
  }
}

// BUSCAR REFERENCIA
function buscarReferenciaAnt(){
  ref = $('#ant-referencia').val();
  Referencia = $('#ant-referencia').attr('db-id');
  $('#btnRegDetAnt').prop('disabled',true);
  $('#lstClientes').hide();
  $('#lstClientesCorresp').val();
  $('#lstClientesCorresp').hide();


		if(ref == "0" || ref == "SN"){
    $('#btnRegDetAnt').prop('disabled',false);
    $('#lstClientes').show();
    $('#lstClientesCorresp').val();
    $('#lstClientesCorresp').hide();

		}else{
    if(Referencia != ""){
      $('#lstClientesCorresp').val();
      lstClientesReferencia();
			$('#btnRegDetAnt').prop('disabled',false);
      $('#lstClientes').hide();
      $('#lstClientesCorresp').show();
		}
	}
}

// BUSCAR REFERENCIA EN PARTIDA
function buscarReferenciaAntPartida(){
  ref = $('#fk_referencia').val();
  Referencia = $('#fk_referencia').attr('db-id');
  $('#btnRegDetAntPartida').prop('disabled',true);
  $('#lstClientesPartida').hide();
  $('#lstClientesCorrespPartida').val();
  $('#lstClientesCorrespPartida').hide();


		if(ref == "0" || ref == "SN"){
    $('#btnRegDetAntPartida').prop('disabled',false);
    $('#lstClientesPartida').show();
    $('#lstClientesCorrespPartida').val();
    $('#lstClientesCorrespPartida').hide();

		}else{
    if(Referencia != ""){
      $('#lstClientesCorrespPartida').val();
      lstClientesReferencia();
			$('#btnRegDetAntPartida').prop('disabled',false);
      $('#lstClientesPartida').hide();
      $('#lstClientesCorrespPartida').show();
		}
	}
}

//SUMA DE CARGOS Y ABONOS
function sumasCAanticipos(){
  var data = {
    anticipo: $('#mst-anticipo').val()
  }

  $.ajax({
    type: "POST",
    url: "/conta6/Ubicaciones/Contabilidad/anticipos/actions/sumaCargosAbonos.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
      console.log(r);
      $('#sumCargos1').val(r.cargos);
      $('#sumAbonos1').val(r.abonos);
      $('#sumCargos2').val(r.cargos);
      $('#sumAbonos2').val(r.abonos);
    },
    error: function(x){
      console.error(x);
    }
  });
}

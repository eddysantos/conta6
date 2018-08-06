$(document).ready(function(){

  $('.che').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    switch (accion) {
      case "dtosch":
      if (status == 'cerrado') {
        $('#datoscheque').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !importche');
        $(this).css('font-size', '20px');
      } else {
        $('#datoscheque').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
        default:
          console.error("Something went terribly wrong...");
      }
    });

//******************************************************************************
//                             GENERAR CHEQUE
//******************************************************************************

    $('#chebeneficiario').change(function(){
        $('#opcionActivada').val("BEN");
        $('#checliente').val('');
        $('#cheempleado').val('');
        $('#cheproveedor').val('');
    });

    $('#checliente').change(function(){
        $('#opcionActivada').val('CLT');
        $('#chebeneficiario').val('');
        $('#cheempleado').val('');
        $('#cheproveedor').val('');
    });

    $('#cheempleado').change(function(){
        $('#opcionActivada').val('EMPL');
        $('#chebeneficiario').val('');
        $('#checliente').val('');
        $('#cheproveedor').val('');
    });

    $('#cheproveedor').change(function(){
        $('#opcionActivada').val('PROV');
        $('#chebeneficiario').val('');
        $('#cheempleado').val('');
        $('#checliente').val('');
    });

    $('#btn_genFolioCheque').click(function(){
      if($('#chefecha').val() == ""){
        alertify.error("Seleccione una fecha");
        $('#chefecha').focus();
        return false;
      }
      if($('#checuenta').attr('db-id') == ""){
        alertify.error("Seleccione una cuenta");
        $('#chequecuenta').focus();
        return false;
      }
      if($('#chenumero').val() == ""){
        alertify.error("Ingrese número de cheque");
        $('#chenumero').focus();
        return false;
      }
      if($('#cheimporte').val() == ""){
        alertify.error("Ingrese valor del cheque");
        $('#cheimporte').focus();
        return false;
      }
      if($('#opcionActivada').val() == ""){
        alertify.error("Seleccione nombre a pagar");
        $('#opcionActivada').focus();
        return false;
      }
      if($('#checoncepto').val() == ""){
        alertify.error("Escriba un concepto");
        $('#checoncepto').focus();
        return false;
      }

      fecha = $('#chefecha').val();
      aduana = $('#txt_aduana').val();
      tipoDoc = 1;
      usuario = $('#txt_usuario').val();
      permiso = "s_generar_x_fecha_cheques";

      var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
      //console.log(continuar);
      if(continuar == true) {
        genChe();
      }else{
        //swal("Oops!", "Solicite cambio de fechas a Contabilidad", 'error');
        return false;
      }
    });

    //*******************************************************************************
    //                                 EDITAR CHEQUE MST
    //*******************************************************************************

    $('#chBen').change(function(){
        $('#opcAct').val("BEN");
        $('#chClt').val('');
        $('#chEmp').val('');
        $('#chProv').val('');
    });

    $('#chClt').change(function(){
        $('#opcAct').val('CLT');
        $('#chBen').val('');
        $('#chEmp').val('');
        $('#chProv').val('');
    });

    $('#chEmp').change(function(){
        $('#opcAct').val('EMPL');
        $('#chBen').val('');
        $('#chClt').val('');
        $('#chProv').val('');
    });

    $('#chProv').change(function(){
        $('#opcAct').val('PROV');
        $('#chBen').val('');
        $('#chEmp').val('');
        $('#chClt').val('');
    });
    // VALIDACION DATOS EN MODAL
      $('#medit-chequeMST').click(function(){
          //Código para editar el modal, declaración de variables y ajax.
          if($('#chFecha').val() == ""){
            alertify.error("Seleccione una fecha");
            $('#chFecha').focus();
            return false;
          }
          if($('#chCta').attr('db-id') == ""){
            alertify.error("Seleccione una cuenta");
            $('#chCta').focus();
            return false;
          }
          if($('#chNum').val() == ""){
            alertify.error("Ingrese número de cheque");
            $('#chNum').focus();
            return false;
          }
          if($('#chImporte').val() == ""){
            alertify.error("Ingrese valor del cheque");
            $('#chImporte').focus();
            return false;
          }
          if($('#opcAct').val() == ""){
            alertify.error("Seleccione nombre a pagar");
            $('#opcAct').focus();
            return false;
          }
          if($('#chConcep').val() == ""){
            alertify.error("Escriba un concepto");
            $('#chConcep').focus();
            return false;
          }

          fecha = $('#chFecha').val();
          aduana = $('#txt_aduana').val();
          tipoDoc = 1;
          usuario = $('#txt_usuario').val();
          permiso = "s_generar_x_fecha_anticipos";

          var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
          console.log(continuar);
          if(continuar == true) {
            modificarChequeMST();
            //tar_modal.modal('show');
          }else{
            //swal("Oops!", "Solicite cambio de fechas a Contabilidad", 'error');
            return false;
          }
      });


    // ACTUALIZAR DATOS

      function modificarChequeMST(){
        if($('#opcAct').val() == "BEN"){ id_expedidor = $('#chBen').attr('db-id'); }
        if($('#opcAct').val() == "CLT"){ id_expedidor = $('#chClt').attr('db-id'); }
        if($('#opcAct').val() == "EMPL"){ id_expedidor = $('#chEmp').attr('db-id'); }
        if($('#opcAct').val() == "PROV"){ id_expedidor = $('#chProv').attr('db-id'); }

        var data = {
      		fecha: $('#chFecha').val(),
          cuenta: $('#chCta').attr('db-id'),
          cheque: $('#chNum').val(),
          importe: $('#chImporte').val(),
          concepto: $('#chConcep').val(),
          opcion: $('#opcAct').val(),
          id_expedidor: id_expedidor,
          id_poliza: $('#dchPoliza').val(),
          idcheque_folControl: $('#idcheque_folControl').val()
      	}
        console.log(data);
        tipo = 1;
        $.ajax({
          type: "POST",
          url: "/conta6/Ubicaciones/Contabilidad/cheques/actions/editarChequeMST.php",
          data: data,
          success: 	function(r){
            r = JSON.parse(r);
            console.log(r.data);
              if (r.code == 1) {
                console.log(r.data);
                swal("Exito", "El cheque se actualizó correctamente.", "success");
                //setTimeout('document.location.reload()',700);
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
      //                                 CAPTURAR DETALLE CHEQUE
      //*******************************************************************************
      //if( $('#dchCancela').val() == 0){ $('#cdch_btnRegistrar').prop( 'disabled', false ); }

      $('#cdch_btnRegistrar').click(function(){
          fecha = $('#dchFechafecha').val();
          aduana = $('#aduana_activa').val();
          tipoDoc = 1;
          usuario = $('#usuario_activo').val();
          permiso = "s_generar_x_fecha_cheques";

          var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
          if(continuar == true) {
            id_poliza = $('#dchPoliza').val();
            fecha = $('#dchFecha').val();
            id_referencia = $('#cdchReferencia').attr('db-id');
            tipo = 1;
            cuenta = $('#cdchCuenta').attr('db-id');
            id_cliente = $('#cdchCliente').attr('db-id');
            documento = $('#cdchDocumento').val();
            factura = $('#cdchFactura').attr('db-id');
            anticipo = $('#cdchAnticipo').attr('db-id');
            cheque = $('#cdchCheque').attr('db-id');
            cargo = $('#cdchCargo').val();
            abono = $('#cdchAbono').val();
            desc = $('#cdchConcepto').val();
            gastoOficina = $('#cdchGtoficina').attr('db-id');
            proveedor = $('#cdchProveedores').attr('db-id');

            if(cuenta == ""){
              alertify.error("Seleccione una cuenta");
              $('#cdchCuenta').focus();
              return false;
            }else{
              if(desc == ""){
                alertify.error("Ingrese una descripción");
                $('#cdchConcepto').focus();
                return false;
              }else{
                if( (cargo == 0 && abono == 0) || (cargo > 0 && abono > 0) ){
                  alertify.error("Ingrese un importe")
                  $('#cdchCargo').focus();
                  if(cargo > 0 && abono > 0){ $('#cdchCargo').val(0); $('#cdchAbono').val(0); }
                  return false
                }else{
                  st = $('#cdchCuenta').val();
                  if( validarCtasGastoOficina(st) == true || validarCtasCliente(st) || validarCtasPagosCliente(st) ){

                    if( validarCtasGastoOficina(st) == true ){
                      if( gastoOficina == ''){
                        alertify.error("Seleccione una Oficina");
                        $('#cdchGtoficina').focus();
                        return false
                      }else{
                        insertaDetCh();
                      }
                    }

                    if( validarCtasCliente(st) == true ){
                      if( cuenta == '0208-00001'){
                        $('#cdchCliente').attr('db-id')='';
                        $('#cdchCliente').val('');
                        id_cliente = 0;
                        insertaDetCh();
                      }else{
                        if(id_cliente == ''){
                          alertify.error("Seleccione un Cliente");
                          $('#cdchCliente').focus();
                          return false
                        }else{
                          parte_Cuenta = cuenta.split('-');
                          parte_Cliente = id_cliente.split('_');
                          if( parte_Cuenta[1].search(parte_Cliente[1]) == -1){
                            alertify.error("La cuenta contable no corresponde al cliente seleccionado");
                            $('#cdchCliente').focus();
                            return false
                          }else{
                            insertaDetCh();
                          }
                        }
                      }
                    }

                  }else{
                    insertaDetCh();
                  }
                }
              }
            }
          }else{
            return false;
          }
      });



      //*******************************************************************************
      //                         DETALLE DE ANTICPO  (PARTIDAS)
      //*******************************************************************************

      $('#detallecheque').click(function(){
        var data = {
          idcheque_folControl: $('#dchIdcheque_folControl').val(),
          id_cheque: $('#dchIdcheque').val(),
          id_ctaMST: $('#dchCtaMST').val()

        }

        $.ajax({
          type: "POST",
          url: "/conta6/Ubicaciones/Contabilidad/cheques/actions/tabla_detallecheque.php",
          data: data,
          success: 	function(request){
  					r = JSON.parse(request);
  					if (r.code == 1) {
  						$('#tabla_detallecheque').html(r.data);
  					}
          }
        });
      });

      // MOSTRAR EN MODAL DATOS DE PARTIDA ANTICIPO
        $('tbody').on('click', '.editar-partidaCh', function(){
          var dbid = $(this).attr('db-id');
          var tar_modal = $($(this).attr('href'));

          var fetch_cuenta = $.ajax({
            method: 'POST',
            data: {dbid: dbid},
            url: 'actions/fetchPartidaCh.php'
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
            $('#btnRegDetChPartida').attr('db-id', r.data.pk_partida);
            tar_modal.modal('show');
            } else {
              console.error(r);
            }
          });
        });


        // EDITAR DATOS DE PARTIDA
        $('#btnRegDetChPartida').click(function(){
            // validacion
            id_poliza = $('#dchPoliza').val();
            fecha = $('#dchFecha').val();
            id_referencia = $('#che_referencia').attr('db-id');
            tipo = 1;
            cuenta = $('#che_cuenta').attr('db-id');
            id_cliente = $('#che_cliente').attr('db-id');
            documento = $('#che_documento').val();
            factura = $('#che_factura').attr('db-id');
            anticipo = $('#che_anticipo').attr('db-id');
            cheque = $('#che_cheque').attr('db-id');
            cargo = $('#che_cargo').val();
            abono = $('#che_abono').val();
            desc = $('#che_desc').val();
            gastoOficina = $('#che_gastoaduana').attr('db-id');
            proveedor = $('#che_proveedor').attr('db-id');

            if(cuenta == ""){
              alertify.error("Seleccione una cuenta");
              $('#che_cuenta').focus();
              return false;
            }else{
              if(desc == ""){
                alertify.error("Ingrese una descripción");
                $('#che_desc').focus();
                return false;
              }else{
                if( (cargo == 0 && abono == 0) || (cargo > 0 && abono > 0) ){
                  alertify.error("Ingrese un importe")
                  $('#che_cargo').focus();
                  if(cargo > 0 && abono > 0){ $('#che_cargo').val(0); $('#che_abono').val(0); }
                  return false
                }else{
                  st = $('#che_cuenta').val();
                  if( validarCtasGastoOficina(st) == true || validarCtasCliente(st) || validarCtasPagosCliente(st) ){

                    if( validarCtasGastoOficina(st) == true ){
                      if( gastoOficina == ''){
                        alertify.error("Seleccione una Oficina");
                        $('#che_gastoaduana').focus();
                        return false
                      }else{
                        actualizaPartCh();
                      }
                    }

                    if( validarCtasCliente(st) == true ){
                      if( cuenta == '0208-00001'){
                        $('#che_cliente').attr('db-id')='';
                        $('#ch_cliente').val('');
                        id_cliente = 0;
                        actualizaPartCh();
                      }else{
                        if(id_cliente == ''){
                          alertify.error("Seleccione un Cliente");
                          $('#che_cliente').focus();
                          return false
                        }else{
                          parte_Cuenta = cuenta.split('-');
                          parte_Cliente = id_cliente.split('_');
                          if( parte_Cuenta[1].search(parte_Cliente[1]) == -1){
                            alertify.error("La cuenta contable no corresponde al cliente seleccionado");
                            $('#che_cliente').focus();
                            return false
                          }else{
                            actualizaPartCh();
                          }
                        }
                      }
                    }

                  }else{
                    actualizaPartCh();
                  }
                }
              }
            }


            $('.modal').modal('hide');
          });
        //});




    //*******************************************************************************
    //                                 B O T O N E S
    //*******************************************************************************

    // BOTON IMPRIMIR
    $('#btn_printChe').click(function(){
      id_cheque = $('#dchIdcheque').val();
      id_cuentaMST = $('#dchCtaMST').val();
      id_poliza = $('#dchPoliza').val();
      window.location.replace('/conta6/Ubicaciones/Contabilidad/cheques/actions/impresion_cheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST+'&id_poliza='+id_poliza);
    });

    //BOTON GENERAR POLIZA DE CHEQUE
      $('#btn_generarPolChe').click(function(){
        var data = {
          diatipo: 1,
          diaaduana: $('#aduana_activa').val(),
          diafecha: $('#dchFecha').val(),
          diaconcepto: $('#dchConcepto').val(),
          cheque: $('#dchIdcheque').val(),
          cuentaMST: $('#dchCtaMST').val(),
          importe: $('#dchImporte').val()
      	}
        //id_cliente: $('#mst-cliente').val()
        $.ajax({
          type: "POST",
          url: "/conta6/Ubicaciones/Contabilidad/cheques/actions/generarPolizaCheque.php",
          data: data,
          success: 	function(r){
            console.log(r);
            r = JSON.parse(r);
            if (r.code == 1) {
              console.log(r);
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


    // BOTON EDITAR DATOS DEL CHEQUE MST
    $('#btn_editDatosCheMST').click(function(){
      id_cheque = $('#mst-cheque').val();
      id_cuentaMST = $('#mst-ctaMST').val();
      window.location.replace('/conta6/Ubicaciones/Contabilidad/cheques/EditarChequeMST.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
    });

    //BOTON CANCELAR
    $('#dchCancela').change(function(){

    	fecha = $('#dchFecha').val();
    	aduana = $('#aduana_activa').val();
    	tipoDoc = 5;
    	usuario = $('#usuario_activo').val();

    	status = $('#dchCancela').val();
    	if( status == 1 ){ permiso = "s_cancelar_libre_cheques"; }
    	if( status == 0 ){ permiso = "s_descancelar_cheques"; }


    	var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
    	if(continuar == true) {
    		var data = {
          id_poliza: $('#dchPoliza').val(),
    			id_cheque: $('#dchIdcheque').val(),
          id_cuentaMST: $('#dchCtaMST').val(),
    			status: $('#dchCancela').val()
    		}
 console.log(data);
    			$.ajax({
    				type: "POST",
    				url: "/conta6/Ubicaciones/Contabilidad/cheques/actions/cancelaDescancelaCheque.php",
    				data: data,
    				success: 	function(r){
    					//console.log(fecha);
    					r = JSON.parse(r);
    					if (r.code == 1) {
    						swal("Exito", "Se actualizó correctamente.", "success");
    						//setTimeout('document.location.reload()',700);
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

    // BUSCAR CHEQUE Consultar
    $('#btn_busCheConsulta').click(function(){
      id_cheque = $('#mConsChIdcheque').val();
      id_cuentaMST = $('#mConsChCtaMST').attr('db-id');
      window.location.replace('/conta6/Ubicaciones/Contabilidad/cheques/ConsultarCheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
    });

    // BUSCAR CHEQUE Modificar
    $('#btn_busCheModifi').click(function(){
      id_cheque = $('#mModifiChIdcheque').val();
      id_cuentaMST = $('#mModifiChCtaMST').attr('db-id');
      window.location.replace('/conta6/Ubicaciones/Contabilidad/cheques/Detallecheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
    });




});



    //*******************************************************************************
    //                        PARTIDA DE CHEQUE
    //*******************************************************************************

    // ELIMINAR PARTIDA REGISTRO DE CHEQUE
    function borrarRegistroCheque(partida){
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
    				idcheque_folControl: $('#dchIdcheque_folControl').val(),
            id_poliza: $('#dchPoliza').val(),
            id_cheque: $('#dchIdcheque').val(),
            id_ctaMST: $('#dchCtaMST').val()
    			}
    			$.ajax({
    				type: "POST",
    				url: "/conta6/Ubicaciones/Contabilidad/cheques/actions/eliminar.php",
    				data: data,

    					success: 	function(r){
                r = JSON.parse(r);
    						console.log(r);
    					  if (r.code == 1) {
      						swal("Eliminado!", "Se elimino correctamente.", "success");
                  $('#detallecheque').click();
                  sumasCAcheques();
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


    // ACTUALIZAR PARTIDA REGISTRO DE CHEQUE
    function actualizaPartCh(){
        var data = {
          id_poliza: $('#dchPoliza').val(),
          fecha: $('#dchFecha').val(),
          id_referencia: $('#che_referencia').attr('db-id'),
          tipo: 1,
          cuenta: $('#che_cuenta').attr('db-id'),
          id_cliente: $('#che_cliente').attr('db-id'),
          documento: $('#che_documento').val(),
          factura: $('#che_factura').attr('db-id'),
          anticipo: $('#che_anticipo').attr('db-id'),
          cargo: $('#che_cargo').val(),
          abono: $('#che_abono').val(),
          desc: $('#che_desc').val(),
          gastoOficina: $('#che_gastoaduana').attr('db-id'),
          proveedor: $('#che_proveedor').attr('db-id'),
          id_cheque: $('#dchIdcheque').val(),
          cuentaMST: $('#dchCtaMST').val(),
          partidaCheque: $('#che_partida').attr('db-id')
        }

        $.ajax({
          type: "POST",
          url: "/conta6/Ubicaciones/Contabilidad/Cheques/actions/editar.php",
          data: data,
          success: 	function(r){
            console.log(r);
            r = JSON.parse(r);
            if (r.code == 1) {
              swal("Exito", "Se actualizó correctamente.", "success");
              //setTimeout('document.location.reload()',700);
              $('#detallecheque').click();
              sumasCAcheques();
            } else {
              console.error(r.message);
            }
          },
          error: function(x){
            console.error(x);
          }
        });
      }

//SUMA DE CARGOS Y ABONOS
function sumasCAcheques(){
  var data = {
    id_cheque: $('#dchIdcheque').val(),
    id_ctaMST: $('#dchCtaMST').val(),
    importeChe: $('#dchImporte').val()
  }

  $.ajax({
    type: "POST",
    url: "/conta6/Ubicaciones/Contabilidad/cheques/actions/sumaCargosAbonos.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
      console.log(r);
      $('#sumCargos1_ch').val(r.cargos);
      $('#sumAbonos1_ch').val(r.abonos);
      $('#sumCargos2_ch').val(r.cargos);
      $('#sumAbonos2_ch').val(r.abonos);
    },
    error: function(x){
      console.error(x);
    }
  });
}

function genChe(){
    if($('#opcionActivada').val() == "BEN"){ id_expedidor = $('#chebeneficiario').attr('db-id'); }
    if($('#opcionActivada').val() == "CLT"){ id_expedidor = $('#checliente').attr('db-id'); }
    if($('#opcionActivada').val() == "EMPL"){ id_expedidor = $('#cheempleado').attr('db-id'); }
    if($('#opcionActivada').val() == "PROV"){ id_expedidor = $('#cheproveedor').attr('db-id'); }

    id_cuentaMST = $('#checuenta').attr('db-id');

    var data = {
  		fecha: $('#chefecha').val(),
      cuenta: $('#checuenta').attr('db-id'),
      cheque: $('#chenumero').val(),
      importe: $('#cheimporte').val(),
      concepto: $('#checoncepto').val(),
      opcion: $('#opcionActivada').val(),
      id_expedidor: id_expedidor
  	}

  	tipo = 5;
  	$.ajax({
  		type: "POST",
  		url: "/conta6/Ubicaciones/Contabilidad/cheques/actions/generarFolioCheque.php",
  		data: data,
  		success: 	function(r){
  		r = JSON.parse(r);
      if (r.code == 1) {
          console.log(r.data);
          id_cheque = r.data;
          window.location.replace('Detallecheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
  	});

}


function Actualiza_CuentaCapCh(){
		st = $('#cdchCuenta').val();
    nombreCta = st.split('-');

		if( validarCtasGastoOficina(st) == true ){ //function en Polizas.js
      //ACTIVAR GASTO OFICINA
      $('#cdchGtoficina').prop( 'disabled', false );
      $('#cdchGtoficina').val('');
			$('#cdchGtoficina').attr('db-id','');
      $('#cdchCliente').attr('db-id','')
		}else{
      $('#cdchGtoficina').prop( 'disabled', true );
      $('#cdchGtoficina').val('');
			$('#cdchGtoficina').attr('db-id','');
		}

		if(st.substring(0,4) == '0110'){
			$('#cdchReferencia').focus();
      alertify.error("Referencia es requerido");
      $('#cdchCliente').val('');
      $('#cdchCliente').attr('db-id','');
		}else{
      $('#cdchCliente').attr('action','clientes');
		}


		if(st.substring(0,4) == '0206'){
			//ACTIVAR PROVEEDORES
			$('#cdchProveedores').prop( 'disabled', false );
			$('#cdchProveedores').val('');
			$('#cdchProveedores').attr('db-id','');
		}else{
			$('#cdchProveedores').prop( 'disabled', true );
			$('#cdchProveedores').val('');
			$('#cdchProveedores').attr('db-id','');
		}


    $('#cdchConcepto').val($.trim(nombreCta[2]));
}
function Actualiza_CuentaCapCh_modal(){
		st = $('#che_cuenta').val();
    nombreCta = st.split('-');

		if( validarCtasGastoOficina(st) == true ){ //function en Polizas.js
      //ACTIVAR GASTO OFICINA
      $('#che_gastoaduana').prop( 'disabled', false );
      $('#che_gastoaduana').val('');
			$('#che_gastoaduana').attr('db-id','');
      $('#che_cliente').attr('db-id','')
		}else{
      $('#che_gastoaduana').prop( 'disabled', true );
      $('#che_gastoaduana').val('');
			$('#che_gastoaduana').attr('db-id','');
		}

		if(st.substring(0,4) == '0110'){
			$('#che_referencia').focus();
      alertify.error("Referencia es requerido");
      $('#che_cliente').val('');
      $('#che_cliente').attr('db-id','');
		}else{
      $('#che_cliente').attr('action','clientes');
		}


		if(st.substring(0,4) == '0206'){
			//ACTIVAR PROVEEDORES
			$('#che_proveedor').prop( 'disabled', false );
			$('#che_proveedor').val('');
			$('#che_proveedor').attr('db-id','');
		}else{
			$('#che_proveedor').prop( 'disabled', true );
			$('#che_proveedor').val('');
			$('#che_proveedor').attr('db-id','');
		}


    $('#che_concepto').val($.trim(nombreCta[2]));
}

function valDescripOficinaCapCh(){
		/********************************************************************************************************
		PARAMETRO DE DISTINCION EN EL GASTO, NO BASTA SOLO CON ASIGNAR LA OFICINA.
		CUANDO ES EL CASO QUE HAY MAS DE UN REGISTRO IGUAL EN LA MISMA POLIZA, SE REPIDE LA PARTIDA EN EL GASTO;
		PARA EVITAR ESTO SE ASIGNA UN PARAMETRO QUE HACE LA DISTINCION EN LA DESCRIPCION
		*/
		desc = $('#cdchConcepto').val();
		desc = desc.replace(" ::160::","");
		desc = desc.replace(" ::240::","");
		desc = desc.replace(" ::430::","");
		desc = desc.replace(" ::470::","");
		desc = desc.replace(" ::241::","");

		gastoOficina = $('#cdchGtoficina').attr('db-id');
		descOficina = "";

		if (gastoOficina == 160){ descOficina = "::160::"; }
		if (gastoOficina == 240){ descOficina = "::240::"; }
		if (gastoOficina == 430){ descOficina = "::430::"; }
		if (gastoOficina == 470){ descOficina = "::470::"; }
		if (gastoOficina == 241){ descOficina = "::241::"; }

 		desc = desc + " " + descOficina;
		$('#cdchConcepto').val(desc);
}
function valDescripOficinaCapCh_modal(){
		/********************************************************************************************************
		PARAMETRO DE DISTINCION EN EL GASTO, NO BASTA SOLO CON ASIGNAR LA OFICINA.
		CUANDO ES EL CASO QUE HAY MAS DE UN REGISTRO IGUAL EN LA MISMA POLIZA, SE REPIDE LA PARTIDA EN EL GASTO;
		PARA EVITAR ESTO SE ASIGNA UN PARAMETRO QUE HACE LA DISTINCION EN LA DESCRIPCION
		*/
		desc = $('#che_desc').val();
		desc = desc.replace(" ::160::","");
		desc = desc.replace(" ::240::","");
		desc = desc.replace(" ::430::","");
		desc = desc.replace(" ::470::","");
		desc = desc.replace(" ::241::","");

		gastoOficina = $('#che_gastoaduana').attr('db-id');
		descOficina = "";

		if (gastoOficina == 160){ descOficina = "::160::"; }
		if (gastoOficina == 240){ descOficina = "::240::"; }
		if (gastoOficina == 430){ descOficina = "::430::"; }
		if (gastoOficina == 470){ descOficina = "::470::"; }
		if (gastoOficina == 241){ descOficina = "::241::"; }

 		desc = desc + " " + descOficina;
		$('#che_desc').val(desc);
}

function insertaDetCh(){
		var data = {
			id_poliza: $('#dchPoliza').val(),
			fecha: $('#dchFecha').val(),
			id_referencia: $('#cdchReferencia').attr('db-id'),
			tipo: 1,
			cuenta: $('#cdchCuenta').attr('db-id'),
			id_cliente: $('#cdchCliente').attr('db-id'),
			documento: $('#cdchDocumento').val(),
			factura: $('#cdchFactura').attr('db-id'),
			anticipo: $('#cdchAnticipo').attr('db-id'),
			cargo: $('#cdchCargo').val(),
			abono: $('#cdchAbono').val(),
			desc: $('#cdchConcepto').val(),
			gastoOficina: $('#cdchGtoficina').attr('db-id'),
      proveedor: $('#cdchProveedores').attr('db-id'),
      id_cheque: $('#dchIdcheque').val(),
      cuentaMST: $('#dchCtaMST').val(),
      idcheque_folControl: $('#dchIdcheque_folControl').val()
		}

		$.ajax({
			type: "POST",
			url: "/conta6/Ubicaciones/Contabilidad/cheques/actions/agregar.php",
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
}

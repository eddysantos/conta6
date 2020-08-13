$(document).ready(function(){
  ultReg_DetChe();


  $('#cdchReferencia' || '#che_referencia').change(function(){
    eliminaBlancosIntermedios(this);
    todasMayusculas(this);
    validaReferencia(this);
  });

  $('#cdchReferencia').change(function(){ buscarReferenciaCh(); });
  $('#che_referencia').change(function(){ buscarReferenciaChModal(); });


  $('.che').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    switch (accion) {
      case "dtosch":
      if (status == 'cerrado') {
        $('#datoscheque').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
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


    $('.chebeneficiario').click(function(){
      $('#chebeneficiario1').show();
      $('#chebeneficiario').focus();
      $('#checliente1,#cheempleado1,#cheproveedor1').hide();
    });

    $('.checliente').click(function(){
      $('#checliente1').show();
      $('#checliente').focus();
      $('#chebeneficiario1,#cheempleado1,#cheproveedor1').hide();
    });

    $('.cheempleado').click(function(){
      $('#cheempleado1').show();
      $('#cheempleado').focus();
      $('#checliente1,#chebeneficiario1,#cheproveedor1').hide();
    });

    $('.cheproveedor').click(function(){
      $('#cheproveedor1').show();
      $('#cheproveedor').focus();
      $('#chebeneficiario1,#checliente1,#cheempleado1').hide();
    });



//******************************************************************************
//                             GENERAR CHEQUE
//******************************************************************************

// $('#mModifiChCtaMST').keydown(function(e){
$('#mModifiChIdcheque').keydown(function(e){
  if (e.keyCode === 13 || e.keyCode === 9) {
    id_cheque = $('#mModifiChIdcheque').val();
    id_cuentaMST = $('#mModifiChCtaMST').attr('db-id');
    window.location.replace('/Ubicaciones/Contabilidad/cheques/Detallecheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
	}
})


// $('#mConsChCtaMST').keydown(function(e){
$('#mConsChIdcheque').keydown(function(e){
	if (e.keyCode === 13 || e.keyCode === 9) {
    id_cheque = $('#mConsChIdcheque').val();
    id_cuentaMST = $('#mConsChCtaMST').attr('db-id');
    window.location.replace('/Ubicaciones/Contabilidad/cheques/ConsultarCheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
	}
})

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
        if($('#opcAct').val() == "BEN"){
          id_expedidor = $('#chBen').attr('db-id');
        }
        if($('#opcAct').val() == "CLT"){
          id_expedidor = $('#chClt').attr('db-id');
        }
        if($('#opcAct').val() == "EMPL"){
          id_expedidor = $('#chEmp').attr('db-id');
        }
        if($('#opcAct').val() == "PROV"){
          id_expedidor = $('#chProv').attr('db-id');
        }

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
        tipo = 1;
        console.log(data);

        $.ajax({
          type: "POST",
          url: "/Ubicaciones/Contabilidad/cheques/actions/editarChequeMST.php",
          data: data,
          // dataType: "json",
          success: function(r){
            console.log(r);
            r = JSON.parse(r);
              if (r.code == 1) {
              console.log(r.data);
                $('.modal').modal('hide');
                // swal('Exito', 'Los cambios fueron realizados exitosamente').then(function(){
                //   console.log("Something needs to happen.");
                // });
                alertify.alert('Exito!', 'Los cambios fueron realizados exitosamente', function(){
                  document.location.replace('/Ubicaciones/Contabilidad/cheques/Detallecheque.php?id_cheque=' + data.cheque + '&id_cuentaMST=' + data.cuenta);
                });
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
            documento = $('#cdchDocumento').val();
            factura = $('#cdchFactura').attr('db-id');
            anticipo = $('#cdchAnticipo').attr('db-id');
            cheque = $('#cdchCheque').attr('db-id');
            cargo = $('#cdchCargo').val();
            abono = $('#cdchAbono').val();
            desc = $('#cdchConcepto').val();
            gastoOficina = $('#cdchGtoficina').attr('db-id');
            proveedor = $('#cdchProveedores').attr('db-id');

            if (id_referencia == 'SN' || id_referencia == '') {
    					id_cliente = $('#cdchCliente').attr('db-id');
    				}else {
    					id_cliente = $('#cdch-ClienteCorresp').val();
    				}

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

                    if (validarCtasPagosCliente(st) == true) {
                      if (id_referencia == 0){
                        alertify.error("Ingrese n\u00FAmero de Referencia");
                        $('#cdchReferencia').focus();
                        return false;
                      }else{
                        //SIEMPRE VALIDAR QUE LA REFERENCIA EXISTA EN LA TABLA DE REFERENCIAS
                        if (id_referencia != "SN" ){
                          if (id_cliente == 0){
                            alertify.error("Seleccione un Cliente");
                            $('#cdchCliente').focus();
                            return false
                          }else{
                            insertaDetCh();
                          }
                        }else{
                          if (id_cliente == 0){
                            alertify.error("Seleccione un Cliente");
                            $('#cdchCliente').focus();
                            return false
                          }else{
                            insertaDetCh();
                          }
                        }
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
          url: "/Ubicaciones/Contabilidad/cheques/actions/tabla_detallecheque.php",
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

            if (r.data.che_referencia == "" || r.data.che_referencia == "0" || r.data.che_referencia == "SN") {
              $('#che_cliente').removeAttr("readonly");
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
            // id_cliente = $('#che_cliente').attr('db-id');
            documento = $('#che_documento').val();
            factura = $('#che_factura').attr('db-id');
            anticipo = $('#che_anticipo').attr('db-id');
            cheque = $('#che_cheque').attr('db-id');
            cargo = $('#che_cargo').val();
            abono = $('#che_abono').val();
            desc = $('#che_desc').val();
            gastoOficina = $('#che_gastoaduana').attr('db-id');
            proveedor = $('#che_proveedor').attr('db-id');

            if (id_referencia == 'SN' || id_referencia == '') {
      		    id_cliente = $('#che_cliente').attr('db-id');
      		  }else {
      		    id_cliente = $('#modalCh-clienteCorresp').val();
      		  }

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
      window.open('/Ubicaciones/Contabilidad/cheques/actions/impresionCheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST+'&id_poliza='+id_poliza);
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
          url: "/Ubicaciones/Contabilidad/cheques/actions/generarPolizaCheque.php",
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
      window.location.replace('/Ubicaciones/Contabilidad/cheques/EditarChequeMST.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
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
    				url: "/Ubicaciones/Contabilidad/cheques/actions/cancelaDescancelaCheque.php",
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
      window.location.replace('/Ubicaciones/Contabilidad/cheques/ConsultarCheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
    });

    // BUSCAR CHEQUE Modificar
    $('#btn_busCheModifi').click(function(){
      id_cheque = $('#mModifiChIdcheque').val();
      id_cuentaMST = $('#mModifiChCtaMST').attr('db-id');
      window.location.replace('/Ubicaciones/Contabilidad/cheques/Detallecheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
    });


    // $('#mConsChCtaMST').keydown(function(e){
    //   // id_cheque = $('#mConsChIdcheque').val();
    //   // id_cuentaMST = $('#mConsChCtaMST').attr('db-id');
    //   //
    //   // if($('#mConsChIdcheque').val() == "" || $('#mConsChCtaMST').attr('db-id') == ""){
    //   //   return false;
    //   // }
    // 	if (e.keyCode === 13) {
    //     id_cheque = $('#mConsChIdcheque').val();
    //     id_cuentaMST = $('#mConsChCtaMST').attr('db-id');
    //     window.location.replace('/Ubicaciones/Contabilidad/cheques/ConsultarCheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
    // 	}
    // });
    //
    // $('#btn_busCheModifi').keydown(function(e){
    //   // id_cheque = $('#mModifiChIdcheque').val();
    //   // id_cuentaMST = $('#mModifiChCtaMST').attr('db-id');
    //   //
    //   // if($('#mModifiChIdcheque').val() == "" || $('#mModifiChCtaMST').attr('db-id') == ""){
    //   //   return false;
    //   // }
    // 	if (e.keyCode === 13) {
    //     id_cheque = $('#mModifiChIdcheque').val();
    //     id_cuentaMST = $('#mModifiChCtaMST').attr('db-id');
    //     window.location.replace('/Ubicaciones/Contabilidad/cheques/Detallecheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
    // 	}
    // });

    $('tbody').on('click', '.buscarFacturas-cheques', function(){
      cadena = $('#cdchCliente').val();
      parte = cadena.split('-');
      nombre = parte[0] + parte[1];
      $('#detche-cliente-nombre').val(nombre);

      var data = {
        cliente : $('#cdchCliente').attr('db-id'),
        fecha : $('#dchFecha').val(),
        id_poliza : $('#dchPoliza').val(),
        tipo : 1
      }

      $.ajax({
        type: "POST",
        url: "/Ubicaciones/Contabilidad/polizas/actions/buscarFacturas_lista.php",
        data: data,
        success: 	function(r){
          r = JSON.parse(r);
          if (r.code == 1) {
            $('#detche-buscarfacturas-lista').html(r.data);
          } else {
            console.error(r.message);
          }
        },
        error: function(x){
          console.error(x);
        }
      });

    });

    $('#detche-buscarfacturas-lista').on('click','.checkbox-facpend',function(){
      activado = $(this).parents('tr').find('.facpend-check').prop('checked');
      cadena = $('#cdchCliente').val();
      parte = cadena.split('-');

      if( activado == true ){
        accion = "insertar";
      }else{
        accion = "borrar";
      }

      objPartida = $(this).parents('tr').find('.facpend-partida').attr('id');

      var data = {
        id_poliza : $('#dchPoliza').val(),
        id_cliente : parte[0],
        nombre : parte[1],
        fecha : $('#dchFecha').val(),
        tipo : 1,
        referencia : $(this).parents('tr').find('.facpend-referencia').val(),
        factura : $(this).parents('tr').find('.facpend-factura').val(),
        ctagastos : $(this).parents('tr').find('.facpend-ctagastos').val(),
        nc : $(this).parents('tr').find('.facpend-nc').val(),
        saldo : $(this).parents('tr').find('.facpend-saldo').val(),
        pago : $(this).parents('tr').find('.facpend-pago').val(),
        cuenta : $(this).parents('tr').find('.facpend-cta').val(),
        accion : accion,
        id_cheque : $('#dchIdcheque').val(),
        cuentaMST : $('#dchCtaMST').val(),
        idcheque_folControl : $('#dchIdcheque_folControl').val(),
        partidaCh : $(this).parents('tr').find('.facpend-partida').val()
      }

      $.ajax({
        type: "POST",
        url: "/Ubicaciones/Contabilidad/cheques/actions/buscarFacturas_insertaReg_detalleCheque.php",
        data: data,
        success: 	function(r){
          r = JSON.parse(r);
          console.log(r);
          if (r.code == 1) {
            $('#'+objPartida).attr('value',r.partida);
            alertify.success(r.data);
            ultReg_DetChe();
          } else {
            console.error(r.message);
          }
        },
        error: function(x){
          console.error(x);
        }
      });

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
    				url: "/Ubicaciones/Contabilidad/cheques/actions/eliminar.php",
    				data: data,

    					success: 	function(r){
                r = JSON.parse(r);
    						console.log(r);
    					  if (r.code == 1) {
      						swal("Eliminado!", "Se elimino correctamente.", "success");
                  setTimeout('document.location.reload()',700);

                  // $('#detallecheque').click();
                  sumasCAcheques();
                  ultReg_DetChe();
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
      var id_referencia = $('#che_referencia').attr('db-id');

  		if (id_referencia == 'SN' || id_referencia == '') {
  			cliente = $('#che_cliente').attr('db-id');
  		}else {
  			cliente = $('#modalCh-clienteCorresp').val();
  		}

        var data = {
          id_poliza: $('#dchPoliza').val(),
          fecha: $('#dchFecha').val(),
          id_referencia: id_referencia,
          tipo: 1,
          cuenta: $('#che_cuenta').attr('db-id'),
          id_cliente: cliente,
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
          url: "/Ubicaciones/Contabilidad/Cheques/actions/editar.php",
          data: data,
          success: 	function(r){
            console.log(r);
            r = JSON.parse(r);
            if (r.code == 1) {
              swal("Exito", "Se actualizó correctamente.", "success");
              setTimeout('document.location.reload()',700);
              // $('#detallecheque').click();
              sumasCAcheques();
              ultReg_DetChe();
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
    url: "/Ubicaciones/Contabilidad/cheques/actions/sumaCargosAbonos.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
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
  		url: "/Ubicaciones/Contabilidad/cheques/actions/generarFolioCheque.php",
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
      // $('#cdchGtoficina').prop( 'disabled', false );
      $('.cdchGtoficina').show();
      $('#cdchGtoficina').val('');
			$('#cdchGtoficina').attr('db-id','');
      $('#cdchCliente').attr('db-id','')
		}else{
      // $('#cdchGtoficina').prop( 'disabled', true );
      $('.cdchGtoficina').hide();
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
      // $('#cdchProveedores').prop( 'disabled', false );
			$('.cdchProveedores').show();
			$('#cdchProveedores').val('');
			$('#cdchProveedores').attr('db-id','');
		}else{
      // $('.cdchProveedores').prop( 'disabled', true );
			$('.cdchProveedores').hide();
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
      $('.che_gastoaduana').show();
      $('#che_gastoaduana').val('');
			$('#che_gastoaduana').attr('db-id','');
      $('#che_cliente').attr('db-id','')
		}else{
      $('.che_gastoaduana').hide();
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
			$('.che_proveedor').show();
			$('#che_proveedor').val('');
			$('#che_proveedor').attr('db-id','');
		}else{
			$('.che_proveedor').hide();
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
  var id_referencia = $('#cdchReferencia').attr('db-id');

  if (id_referencia == 'SN' || id_referencia == '') {
    cliente = $('#cdchCliente').attr('db-id');
  }else {
    cliente = $('#cdch-ClienteCorresp').val();
  }
		var data = {
			id_poliza: $('#dchPoliza').val(),
			fecha: $('#dchFecha').val(),
			id_referencia: id_referencia,
			tipo: 1,
			cuenta: $('#cdchCuenta').attr('db-id'),
			id_cliente: cliente,
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
			url: "/Ubicaciones/Contabilidad/cheques/actions/agregar.php",
			data: data,
			success: 	function(r){
				console.log(r);
				r = JSON.parse(r);
				if (r.code == 1) {
					swal("Exito", "Se registro correctamente.", "success");
				  setTimeout('document.location.reload()',700);
          ultReg_DetChe();
				} else {
					console.error(r.message);
				}
			},
			error: function(x){
				console.error(x);
			}

		});
}


// ultimos
function ultReg_DetChe(){
  var data = {
    idcheque_folControl: $('#dchIdcheque_folControl').val(),
    id_cheque: $('#dchIdcheque').val(),
    id_ctaMST: $('#dchCtaMST').val()
  }

  $.ajax({
    type: "POST",
    url: "/Ubicaciones/Contabilidad/cheques/actions/ultimosRegistros.php",
    data: data,
    success: 	function(request){
      r = JSON.parse(request);
      if (r.code == 1) {
        $('#ultimosRegistrosCheque').html(r.data);
      }
    }
  });
}


// $('#detallecheque').click(function(){
//   var data = {
//     idcheque_folControl: $('#dchIdcheque_folControl').val(),
//     id_cheque: $('#dchIdcheque').val(),
//     id_ctaMST: $('#dchCtaMST').val()
//
//   }
//
//   $.ajax({
//     type: "POST",
//     url: "/Ubicaciones/Contabilidad/cheques/actions/tabla_detallecheque.php",
//     data: data,
//     success: 	function(request){
//       r = JSON.parse(request);
//       if (r.code == 1) {
//         $('#tabla_detallecheque').html(r.data);
//       }
//     }
//   });
// });

function lstClientesReferenciaChe(){
	var data = {
		referencia: $('#cdchReferencia').attr('db-id')
	}

	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Contabilidad/actions/lst_clienteCorresponsal.php",
		data: data,
		success: 	function(r){

			r = JSON.parse(r);
			if (r.code == 1) {
				//console.log(r.data);
				$('#cdch-ClienteCorresp').html(r.data);
			} else {
				console.error(r.message);
			}
		},
		error: function(x){
			console.error(x);
		}
	});
}

function lstClientesReferenciaChModal(){
	var data = {
		referencia: $('#che_referencia').attr('db-id')
	}

	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Contabilidad/actions/lst_clienteCorresponsal.php",
		data: data,
		success: 	function(r){

			r = JSON.parse(r);
			if (r.code == 1) {
				//console.log(r.data);
				$('#modalCh-clienteCorresp').html(r.data);
			} else {
				console.error(r.message);
			}
		},
		error: function(x){
			console.error(x);
		}
	});
}

function buscarReferenciaCh(){
  ref = $('#cdchReferencia').val();
  Referencia = $('#cdchReferencia').attr('db-id');
  $('#cdch_btnRegistrar').prop('disabled',true);
  $('#Ch-lstClientes').hide();
  $('#Ch-lstClientesCorresp').val();
  $('#Ch-lstClientesCorresp').hide();


		if(ref == "0" || ref == "SN" || ref  == ""){
    $('#cdch_btnRegistrar').prop('disabled',false);
    $('#Ch-lstClientes').show();
    $('#Ch-lstClientesCorresp').val();
    $('#Ch-lstClientesCorresp').hide();

		}else{
    if(Referencia != ""){
      $('#Ch-lstClientesCorresp').val();
      lstClientesReferenciaChe();
			$('#cdch_btnRegistrar').prop('disabled',false);
      $('#Ch-lstClientes').hide();
      $('#Ch-lstClientesCorresp').show();
		}
	}
}

function buscarReferenciaChModal(){
  ref = $('#che_referencia').val();
  Referencia = $('#che_referencia').attr('db-id');
  $('#btnRegDetChPartida').prop('disabled',true);
  $('#modalCh-lstClientes').hide();
  $('#modalCh-lstClientesCorresp').val();
  $('#modalCh-lstClientesCorresp').hide();


		if(ref == "0" || ref == "SN" || ref  == ""){
    $('#btnRegDetChPartida').prop('disabled',false);
    $('#modalCh-lstClientes').show();
    $('#modalCh-lstClientesCorresp').val();
    $('#modalCh-lstClientesCorresp').hide();
    $('#che_cliente').removeAttr("readonly").focus().val("");


		}else{
    if(Referencia != ""){
      $('#modalCh-lstClientesCorresp').val();
      lstClientesReferenciaChModal();
			$('#btnRegDetChPartida').prop('disabled',false);
      $('#modalCh-lstClientes').hide();
      $('#modalCh-lstClientesCorresp').show();
		}
	}
}

// function consultaCheque(){
//   var ajaxCall = $.ajax({
//       method: 'POST',
//       url: 'actions/consultaCheque.php'
//   });
//
//   ajaxCall.done(function(r) {
//     r = JSON.parse(r);
//     if (r.code == 1) {
//       $('#tabla').html(r.data);
//     } else {
//       console.error(r.message);
//     }
//   });
// }

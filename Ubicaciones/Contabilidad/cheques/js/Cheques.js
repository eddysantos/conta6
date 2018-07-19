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

    $('#genFolioCheque').click(function(){
      if($('#chfecha').val() == ""){
        alertify.error("Seleccione una fecha");
        $('#chfecha').focus();
        return false;
      }
      if($('#checuenta').attr('db-id') == ""){
        alertify.error("Seleccione una cuenta");
        $('#chequecuenta').focus();
        return false;
      }
      if($('#chnumero').val() == ""){
        alertify.error("Ingrese número de cheque");
        $('#chnumero').focus();
        return false;
      }
      if($('#chimporte').val() == ""){
        alertify.error("Ingrese valor del cheque");
        $('#chimporte').focus();
        return false;
      }
      if($('#opcionActivada').val() == ""){
        alertify.error("Seleccione nombre a pagar");
        $('#opcionActivada').focus();
        return false;
      }
      if($('#chconcepto').val() == ""){
        alertify.error("Seleccione nombre a pagar");
        $('#chconcepto').focus();
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

    $('#chCta').change(function(){
      cta = $('#chCta').attr('db-id');
      desc = $('#chCta').val();
      $('#ch-cuenta').val(cta);
      $('#ch-cuenta').attr('db-id',cta);
    });
    $('#chBen').change(function(){
        $('#opcAct').val("BEN");
        $('#chClt').val('');
        $('#chEmp').val('');
        $('#chProv').val('');

        nom = $('#chBen').val();
        idnom = $('#chBen').attr('db-id');
        $('#ch-beneficiario').val(nom);
        $('#ch-beneficiario').attr('db-id',idnom);
    });

    $('#chClt').change(function(){
        $('#opcAct').val('CLT');
        $('#chBen').val('');
        $('#chEmp').val('');
        $('#chProv').val('');

        nom = $('#chClt').val();
        idnom = $('#chClt').attr('db-id');
        $('#ch-beneficiario').val(nom);
        $('#ch-beneficiario').attr('db-id',idnom);
    });

    $('#chEmp').change(function(){
        $('#opcAct').val('EMPL');
        $('#chBen').val('');
        $('#chClt').val('');
        $('#chProv').val('');

        nom = $('#chEmp').val();
        idnom = $('#chEmp').attr('db-id');
        $('#ch-beneficiario').val(nom);
        $('#ch-beneficiario').attr('db-id',idnom);
    });

    $('#chProv').change(function(){
        $('#opcAct').val('PROV');
        $('#chBen').val('');
        $('#chEmp').val('');
        $('#chClt').val('');

        nom = $('#chProv').val();
        idnom = $('#chProv').attr('db-id');
        $('#ch-beneficiario').val(nom);
        $('#ch-beneficiario').attr('db-id',idnom);
    });

    //*******************************************************************************
    //                                 B O T O N E S
    //*******************************************************************************


    // BOTON EDITAR DATOS DEL CHEQUE MST
    $('#btn_editDatosCheMST').click(function(){
      id_cheque = $('#mst-cheque').val();
      id_cuentaMST = $('#mst-ctaMST').val();
      window.location.replace('/conta6/Ubicaciones/Contabilidad/cheques/EditarChequeMST.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
    });

    //BOTON CANCELAR
    $('#che-cancela').change(function(){
    	fecha = $('#mst-fecha').val();
    	aduana = $('#aduana_activa').val();
    	tipoDoc = 5;
    	usuario = $('#usuario_activo').val();

    	status = $('#che-cancela').val();
    	if( status == 1 ){ permiso = "s_cancelar_libre_cheques"; }
    	if( status == 0 ){ permiso = "s_descancelar_cheques"; }


    	var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
    	if(continuar == true) {
    		var data = {
    			id_cheque: $('#mst-cheque').val(),
          id_cuentaMST: $('#mst-ctaMST').val(),
    			status: $('#che-cancela').val()
    		}

    			$.ajax({
    				type: "POST",
    				url: "/conta6/Ubicaciones/Contabilidad/cheques/actions/editarStatusCheque.php",
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


});


function genChe(){
    if($('#opcionActivada').val() == "BEN"){ id_expedidor = $('#chebeneficiario').attr('db-id'); }
    if($('#opcionActivada').val() == "CLT"){ id_expedidor = $('#checliente').attr('db-id'); }
    if($('#opcionActivada').val() == "EMPL"){ id_expedidor = $('#cheempleado').attr('db-id'); }
    if($('#opcionActivada').val() == "PROV"){ id_expedidor = $('#cheproveedor').attr('db-id'); }

    id_cuentaMST = $('#checuenta').attr('db-id');

    var data = {
  		fecha: $('#chefecha').val(),
      cuenta: $('#checuenta').attr('db-id'),
      cheque: $('#chnumero').val(),
      importe: $('#chimporte').val(),
      concepto: $('#chconcepto').val(),
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

$(document).ready(function(){
  $('#lstClientesCorresp').hide();

  $('.visualizar').click(function(){
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



  $('tbody').on('click', '.editar-anticipoMST', function(){
      var dbid = $(this).attr('db-id');
      var tar_modal = $($(this).attr('href'));
      var fetch_cuenta = $.ajax({
        method: 'POST',
        data: {dbid: dbid},
        url: 'actions/fetchAnticipoMST.php'
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
        $('#medit-anticipoMST').attr('db-id', r.data.pk_id_cuenta);

        tar_modal.modal('show');
        } else {
          console.error(r);
        }
      })
  });

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

      if($('#fk_id_cliente').attr('db-id') == ""){
        alertify.error("Seleccione un cliente");
        $('#fk_id_cliente').focus();
        return false;
      }

      if($('#s_bancoOri').val() == "" || $('#s_bancoOri').val() == 0){
        alertify.error("Seleccione un banco");
        $('#s_bancoOri').focus();
        return false;
      }

      if($('#fk_id_cuentaMST').val() == "" || $('#fk_id_cuentaMST').val() == 0){
        alertify.error("Seleccione una cuenta");
        $('#antcuenta').focus();
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
        tar_modal.modal('show');
      }else{
        //swal("Oops!", "Solicite cambio de fechas a Contabilidad", 'error');
        return false;
      }
  });

  $('.modal').modal('hide');






});


  function Actualiza_Expedido_Cliente(){
    id_cliente = $('#antcliente').attr('db-id');
    lstCuentas('antGenClt',id_cliente);
    bcosClientes(id_cliente);
  }

  function Actualiza_Expedido_Cliente_MST(){
    id_cliente = $('#fk_id_cliente').attr('db-id');
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
            console.log(r.data);
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

function modificarAntMST(){
  bancoclinte = $('#s_bancoOri').val();
  parte = bancoclinte.split('+');
  banco = parte[0];
  bancocta = parte[1];
  id_anticipo: $('#pk_id_anticipo').val();

  var data = {
    antfecha: $('#d_fecha').val(),
    antvalor: $('#n_valor').val(),
    antcliente: $('#fk_id_cliente').attr('db-id'),
    antbanco: banco,
    bancocta: bancocta,
    antconcepto: $('#s_concepto').val(),
    id_anticipo: $('#pk_id_anticipo').val(),
    antcuenta: $('#fk_id_cuentaMST').val()
  }

console.log(data);
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
          location.reload();
           //console.log(r.data);
          //window.location.replace('Detalleanticipo.php?id_anticipo='+id_anticipo);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
  });

}




function cambiarStatusAnticipo(){
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
					console.log(fecha);
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

function buscarReferenciaAnt(){
    ref = $('#ant-referencia').val();
    Referencia = $('#ant-referencia').attr('db-id');
    $('#btn-registrar').prop('disabled',true);

 		if(ref == "0" || ref == "SN"){
      $('#btn-registrar').prop('disabled',false);
      $('#lstClientes').show();
      $('#lstClientesCorresp').hide();
 			//lstClientes();
 		}else{
      if(Referencia != ""){
				$('#btn-registrar').prop('disabled',false);
        $('#lstClientes').hide();
        $('#lstClientesCorresp').show();
				//lstClientesReferencia();
			}
		}
}

$(document).ready(function(){
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

  });


  function Actualiza_Expedido_Cliente(){
    id_cliente = $('#antcliente').attr('db-id');
    lstCuentas('antGenClt',id_cliente);
    bcosClientes(id_cliente);
  }

  function Actualiza_Expedido_Cliente_MST(){
    id_cliente = $('#ant-cliente').attr('db-id');
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
            $('#ant-cuenta').html(r.data);
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
          $('#ant-bcocliente').html(r.data);
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
  		success: 	function(request){
  			r = JSON.parse(request);
        console.log(r);
  			//window.location.replace('Detallepoliza.php?id_poliza='+r+'&tipo='+tipo);
  		}
  	});
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

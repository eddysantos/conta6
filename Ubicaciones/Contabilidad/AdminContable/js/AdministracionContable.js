
$(document).ready(function(){

  $('.consultar').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    switch (accion) {
	     //CIERRE DE MES Y CATALOGO
        case "eCap":
        if (status == 'cerrado') {
          $('#contornoEmp').fadeIn();
          $('#empleadosCap').fadeIn();
          $(this).attr('status', 'abierto');
          $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
          $(this).css('font-size', '20px');
        } else {
          $('#contornoEmp').fadeOut();
          $('#empleadosCap').fadeOut();
          $(this).attr('status', 'cerrado');
          $(this).css('color', "");
          $(this).css('font-size', "");
        }
          break;

    		//CIERRE DE MES
    		case "generar":
    		if (status == 'cerrado') {
    		  $('#contornoGen').fadeIn();
    		  $(this).attr('status', 'abierto');
    		  $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
    		  $(this).css('font-size', '20px');
    		} else {
    		  $('#contornoGen').fadeOut();
    		  $(this).attr('status', 'cerrado');
    		  $(this).css('color', "");
    		  $(this).css('font-size', "");
    		}
    		  break;

        case "modificar":
        if (status == 'cerrado') {
          $('#contornoMod').fadeIn();
          $(this).attr('status', 'abierto');
          $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
          $(this).css('font-size', '20px');
        } else {
          $('#contornoMod').fadeOut();
          $(this).attr('status', 'cerrado');
          $(this).css('color', "");
          $(this).css('font-size', "");
        }
          break;

        case "consultar":
        if (status == 'cerrado') {
          $('#contornoCon').fadeIn();
          $(this).attr('status', 'abierto');
          $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
          $(this).css('font-size', '20px');
        } else {
          $('#contornoCon').fadeOut();
          $(this).attr('status', 'cerrado');
          $(this).css('color', "");
          $(this).css('font-size', "");
        }
          break;

        case "eCap":
        if (status == 'cerrado') {
          $('#contornoEmp').fadeIn();
          $('#empleadosCap').fadeIn();
          $(this).attr('status', 'abierto');
          $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
          $(this).css('font-size', '20px');
        } else {
          $('#contornoEmp').fadeOut();
          $('#empleadosCap').fadeOut();
          $(this).attr('status', 'cerrado');
          $(this).css('color', "");
          $(this).css('font-size', "");
        }
          break;
            default:
              console.error("Something went terribly wrong...");
      }
    });


    $('#ctamaestra').click(function(){
      $(this).val('0000-00000').attr('value', '0000-00000').prop('value', '0000-00000').select();
    });

    $('#generarCtaMst').click(function(){

      if($('#ctaSAT').attr('db-id') == ""){
        alertify.error("Seleccione Cuenta del SAT");
        $('#ctaSAT').focus();
        return false;
      }

      if($('#naturSAT').attr('db-id') == ""){
        alertify.error("Seleccione Naturaleza de la cuenta");
        $('#naturSAT').focus();
        return false;
      }

      if($('#tipo').val() == ""){
        alertify.error("Seleccione un Tipo");
        $('#tipo').focus();
        return false;
      }

      if($('#ctamaestra').val() == ""){
        alertify.error("Asigne una cuenta");
        $('#ctamaestra').focus();
        return false;
      }

      if($('#concepto').val() == ""){
        alertify.error("Asigne una descripción");
        $('#concepto').focus();
        return false;
      }


        var data = {
          ctaSAT: $('#ctaSAT').attr('db-id'),
          naturSAT: $('#naturSAT').attr('db-id'),
          tipo: $('#tipo').val(),
          ctamaestra: $('#ctamaestra').val(),
          concepto: $('#concepto').val(),
          accion: 'MST'
        }

        $.ajax({
    			type: "POST",
    			url: "/conta6/Ubicaciones/Contabilidad/AdminContable/actions/agregar.php",
    			data: data,
    			success: 	function(request, settings){
            //$('#respuestaCtasMST').html(request);
            mensaje = request;
            if(mensaje.indexOf("Error during query execution [1062]") > -1){
  						swal("La cuenta ya existe");
              console.error(request);
  						return false;
  					}else{
              swal("La cuenta se guardo correctamente");
              console.error(request);
              return true;
    		    }
          }

    		});


    });


    $('#generarCtaDet').click(function(){
        if($('#ctaSAT1').attr('db-id') == ""){
          alertify.error("Seleccione Cuenta del SAT");
          $('#ctaSAT1').focus();
          return false;
        }

        if($('#naturSAT1').attr('db-id') == ""){
          alertify.error("Seleccione Naturaleza de la cuenta");
        	$('#naturSAT1').focus();
        	return false;
        }

        if($('#ctamaestra1').attr('db-id') == ""){
          alertify.error("Asigne una cuenta");
          $('#ctamaestra1').focus();
          return false;
        }

        if($('#concepto1').val() == ""){
        	alertify.error("Asigne una descripción");
        	$('#concepto1').focus();
        	return false;
        }


        var data = {
          ctaSAT: $('#ctaSAT1').attr('db-id'),
          naturSAT: $('#naturSAT1').attr('db-id'),
          ctamaestra: $('#ctamaestra1').attr('db-id'),
          concepto: $('#concepto1').val(),
          accion: 'DET'
        }

        $.ajax({
    			type: "POST",
    			url: "/conta6/Ubicaciones/Contabilidad/AdminContable/actions/agregar.php",
    			data: data,
    			success: 	function(request, settings){
            //$('#respuestaCtasDET').html(request);
            mensaje = request;
            if(mensaje.indexOf("Error") > -1){
  						$('#respuestaCtasDET').html(request);
              console.error(request);
  						return false;
  					}else{
              swal("La cuenta se guardo correctamente");
              console.error(request);
              return true;
    		    }
    		  }
        });

      });


      $('#generarCtaCLT').click(function(){
        if($('#clt').attr('db-id') == ""){
          alertify.error("Seleccioe un cliente");
          $('#clt').focus();
          return false;
        }

        var data = {
          cliente: $('#clt').attr('db-id'),
          accion: 'cliente'
        }

        $.ajax({
    			type: "POST",
    			url: "/conta6/Ubicaciones/Contabilidad/AdminContable/actions/agregar.php",
    			data: data,
    			success: 	function(request, settings){
            $('#respuestaCtasClientes').html(request);
    		  }


        });

      });




      $('#medit-ctas').click(function(){

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


          var data = {
            ctaSAT: $('#medit-ctaSAT').attr('db-id'),
            concepto: $('#medit-concepto').val(),
            status: $('#medit-status').val(),
            naturSAT: $('#medit-naturSAT').attr('db-id'),
            prodServ: $('#medit-prodServ').attr('db-id'),
          }

          $.ajax({
            type: "POST",
            url: "/conta6/Ubicaciones/Contabilidad/AdminContable/actions/editar.php",
            data: data,
            success: 	function(request, settings){
              //$('#respuestaCtasMST').html(request);
              console.error(request);
              mensaje = request;
              /*if(mensaje.indexOf("Error during query execution [1062]") > -1){
                swal("La cuenta ya existe");
                console.error(request);
                return false;
              }else{
                swal("La cuenta se guardo correctamente");
                console.error(request);
                return true;
              }*/
            }

          });


      });

  $('tbody').on('click', '.editar-cuenta', function(){
    var dbid = $(this).attr('db-id');
    var tar_modal = $($(this).attr('href'));
    var fetch_cuenta = $.ajax({
      method: 'POST',
      data: {dbid: dbid},
      url: 'actions/fetchCuentaDetalle.php'
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
            $('#' + key).attr('db-id', r['data'][key + 'id']);
          }
        }
      }

      $('#s_cta_status').val(r.data.s_cta_status);
      $('#medit-ctas').attr('db-id', r.data.pk_id_cuenta);

      tar_modal.modal('show');
      } else {
        console.error(r);
      }
    })

  })

  $('#medit-ctas').click(function(){

  //Código para editar el modal, declaración de variables y ajax.

  $('.modal').modal('hide');
  })

});

function valida_ctamaestra(){
  var ctamaestra = $('#ctamaestra').val();
  // 0400-00000
  if( (!/^(\d{4})\-(\d{5})+$/.test(ctamaestra)) || ctamaestra == "" ){
     alertify.error("La Cuenta Maestra no corresponde al formato: 0000-00000");
     $('#ctamaestra').focus();
    return false;
  }else{
    if(ctamaestra == '0000-00000'){
      swal("Ingrese una cuenta");
       $('#ctamaestra').focus();
       return false;
    }else{
      $('#respuestaCtasMST').html("");
      return true;
    }
  }
}

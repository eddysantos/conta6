
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






    $('#generarCtaMst').click(function(){

        if($('#ctaSAT').val() == ""){
          $('#respuestaCtasMST').html("<center><font size=3 color=#FF0000>Seleccione Cuenta del SAT</font></center>");
          $('#ctaSAT').focus();
          return false;
        }


        var data = {
          ctaSAT: $('#ctaSAT').val(),
          naturSAT: $('#naturSAT').val(),
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
            $('#respuestaCtasMST').html(request);
    		    }
    		});


    });


});

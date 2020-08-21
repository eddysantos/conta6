$(document).ready(function () {


// NOTE: borrar si funciona
// 	$('.sueldosysalarios').click(function(){
//     var accion = $(this).attr('accion');
//     var status = $(this).attr('status');
//
// /*Comienza Editar Datos Generales*/
// 		switch (accion) {
//
// 				case "dgenerales":
// 	      if (status == 'cerrado') {
// 	        $('#contornogen').fadeIn();
// 	        $(this).attr('status', 'abierto');
// 	        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
// 	        $(this).css('font-size', '20px');
// 	      } else {
// 	        $('#contornogen').fadeOut();
// 	        $(this).attr('status', 'cerrado');
// 	        $(this).css('color', "");
// 	        $(this).css('font-size', "");
// 	      }
// 	        break;
// 	      case "dlaborales":
// 	      if (status == 'cerrado') {
// 	        $('#contornolab').fadeIn();
// 	        $(this).attr('status', 'abierto');
// 	        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
// 	        $(this).css('font-size', '20px');
// 	      } else {
// 	        $('#contornolab').fadeOut();
// 	        $(this).attr('status', 'cerrado');
// 	        $(this).css('color', "");
// 	        $(this).css('font-size', "");
// 	      }
// 	        break;
// 				case "dpago":
// 	      if (status == 'cerrado') {
// 	        $('#contornopago').fadeIn();
// 	        $(this).attr('status', 'abierto');
// 	        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
// 	        $(this).css('font-size', '20px');
// 	      } else {
// 	        $('#contornopago').fadeOut();
// 	        $(this).attr('status', 'cerrado');
// 	        $(this).css('color', "");
// 	        $(this).css('font-size', "");
// 	      }
// 	        break;
//
//
//         default:
//           console.error("Something went terribly wrong...");
//     }
//   });


	$('#generarDocNominaSuel').click(function(){
		num_nomsig = $('#num_nomsig').val();
		fp_nomsig = $('#fp_nomsig').val();
		mesCorresponde = $('#mesCorresponde').val();

		if( fp_nomsig == ""){
				alertify.success('Asigne fecha pago');
				return false;
		}
		if( mesCorresponde == ""){
				alertify.success('Seleccione mes al que corresponde la nómina');
				return false;
		}

		var data = {
			anio_nomsig : $('#anio_nomsig').val(),
			num_nomsig : num_nomsig,
			fi_nomsig : $('#fi_nomsig').val(),
			ff_nomsig : $('#ff_nomsig').val(),
			fp_nomsig : fp_nomsig,
			lstValesDespensa : $('#pagarVales').val(),
			lstPremioAsistencia : $('#pagarAsistencia').val(),
			mesCorresponde : mesCorresponde
		}

	  var ajaxCall = $.ajax({
	      method: 'POST',
	      data: data,
	      url: '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel.php'
	  });

	  ajaxCall.done(function(r) {
	    r = JSON.parse(r);
	    if (r.code == 1) {
				// NOTE: eliminar si funciona
				// $('#VistaPrevia').removeClass('d-none');
				// $('#resGenNomSuel').html(r.data); // no esta funcionando
				// alertify.alert('Sueldos Nómina: '+num_nomsig, 'Generado correctamente', function(){
				// 	document.location.replace('/Ubicaciones/Nomina/sueldosysalarios/Generar_Nomina.php');
				// });
				// alertify.alert('Generada Correctamente');
				//
				// swal({type: "success",
        //     title: "¡Generada Correctamente!"
        // }).then(function() {
        //     window.location = "/Ubicaciones/Nomina/SueldosySalarios/consultar_Nomina.php";
				//
        // });

				swal({
             title: "¡Se genero correctamente!",
             type: "success",
        },
        function(){
           window.location.href = "/Ubicaciones/Nomina/SueldosySalarios/consultar_Nomina.php";
        })
	    } else {
	      console.error(r.message);
				alertify.alert('Algo salio mal');
	    }
	  });
	});

	// $('#generarDocNominaSuel').click(function(){
	//
	// 	console.log(data);
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel.php",
	// 		data: data,
	// 		success: 	function(r){
	// 			r = JSON.parse(r);
	// 			if (r.code == 1) {
	//
	//
	// 				alertify.alert('Generada Correctamente');
	// 			}else {
	//
	// 			}
	// 		}
	// 	})
	// });

});

function calcularBase(){
	base = $('#baseDeduccion_penAlim').val();
	porcentaje = $('#porcentajeDeduccion_penAlim').val();
	total = base*porcentaje;
	console.log(total);
	$('#importeExentoDeduccion_penAlim').val(total);
}

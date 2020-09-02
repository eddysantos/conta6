$(document).ready(function () {
	//tablasParametros113();
	ocultarFormato();

	// $('.honorarios').click(function(){
  //   var accion = $(this).attr('accion');
  //   var status = $(this).attr('status');
	//
	// 	switch (accion) {
	// 	  case "eCapHon":
	// 	  if (status == 'cerrado') {
	// 	    $('#contornoEmpHon').fadeIn();
	// 	    $(this).attr('status', 'abierto');
	// 	    $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
	// 	    $(this).css('font-size', '15px');
	// 	  } else {
	// 	    $('#contornoEmpHon').fadeOut();
	// 	    $(this).attr('status', 'cerrado');
	// 	    $(this).css('color', "");
	// 	    $(this).css('font-size', "");
	// 	  }
	// 	    break;
	// 		case "dgenHon":
	// 	  if (status == 'cerrado') {
	// 	    $('#hon_dg').fadeIn();
	// 	    $(this).attr('status', 'abierto');
	// 	    $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
	// 	    $(this).css('font-size', '15px');
	// 	  } else {
	// 	    $('#hon_dg').fadeOut();
	// 	    $(this).attr('status', 'cerrado');
	// 	    $(this).css('color', "");
	// 	    $(this).css('font-size', "");
	// 	  }
	//     	break;
	// 		case "dlabHon":
	// 		if (status == 'cerrado') {
	// 			$('#hon_dl').fadeIn();
	// 			$(this).attr('status', 'abierto');
	// 			$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
	// 			$(this).css('font-size', '15px');
	// 		} else {
	// 			$('#hon_dl').fadeOut();
	// 			$(this).attr('status', 'cerrado');
	// 			$(this).css('color', "");
	// 			$(this).css('font-size', "");
	// 		}
	// 			break;
	// 		case "dsalHon":
	// 		if (status == 'cerrado') {
	// 			$('#hon_ds').fadeIn();
	// 			$(this).attr('status', 'abierto');
	// 			$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
	// 			$(this).css('font-size', '15px');
	// 		} else {
	// 			$('#hon_ds').fadeOut();
	// 			$(this).attr('status', 'cerrado');
	// 			$(this).css('color', "");
	// 			$(this).css('font-size', "");
	// 		}
	// 			break;
	//
	// 		case "gnominaHon":
	//     if (status == 'cerrado') {
	//       $('#contornognomHon').fadeIn();
	//       $(this).attr('status', 'abierto');
	//       $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
	//       $(this).css('font-size', '20px');
	//     } else {
	//       $('#contornognomHon').fadeOut();
	//       $(this).attr('status', 'cerrado');
	//       $(this).css('color', "");
	//       $(this).css('font-size', "");
	//     }
  //     	break;
	//
	// 		case "gcfdiHon":
  //     if (status == 'cerrado') {
  //       $('#contornogcfdiHon').fadeIn();
  //       $(this).attr('status', 'abierto');
  //       $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
  //       $(this).css('font-size', '20px');
  //     } else {
  //       $('#contornogcfdiHon').fadeOut();
  //       $(this).attr('status', 'cerrado');
  //       $(this).css('color', "");
  //       $(this).css('font-size', "");
  //     }
  //       break;
	//
  //     case "paramHon":
  //     if (status == 'cerrado') {
  //       $('#contornoparamHon').fadeIn();
  //       $(this).attr('status', 'abierto');
  //       $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
  //       $(this).css('font-size', '20px');
  //     } else {
  //       $('#contornoparamHon').fadeOut();
  //       $(this).attr('status', 'cerrado');
  //       $(this).css('color', "");
  //       $(this).css('font-size', "");
  //     }
  //       break;
  //     default:
  //       console.error("Something went terribly wrong...");
  //   }
  // });


	$('#generarDocNominaHon').click(function(){
		num_nomsig = $('#num_nomsig').val();
		fp_nomsig = $('#fp_nomsig').val();
		mesCorresponde = $('#mesCorresponde').val();

		if( fp_nomsig == ""){
				alertify.success('Asigne fecha pago');
				return false;
		}
		if( mesCorresponde == ""){
				alertify.success('Asigne el mes al que corresponde la nómina');
				return false;
		}

		var data = {
			anio_nomsig : $('#anio_nomsig').val(),
			num_nomsig : num_nomsig,
			fi_nomsig : $('#fi_nomsig').val(),
			ff_nomsig : $('#ff_nomsig').val(),
			fp_nomsig : fp_nomsig,
			mesCorresponde : mesCorresponde
	  }
		console.log(data);
	  $.ajax({
	    type: "POST",
	    url: "/Ubicaciones/Nomina/Honorarios/actions/generarNominaHon.php",
	    data: data,
	    success: 	function(r){
	      r = JSON.parse(r);
	      if (r.code == 1) {
	        // $('#resGenNomHon').html(r.data);
					// alertify.alert('Honorarios Semana: '+num_nomsig, 'Generado correctamente', function(){
					// 	document.location.replace('/Ubicaciones/Nomina/Honorarios/GenerarNominaCFDI.php');
					// });
					swal({
	             title: "¡Se genero correctamente!",
	             type: "success",
	        },
	        function(){
	           window.location.href = "/Ubicaciones/Nomina/Honorarios/consultar_Nomina.php";
	        })
	      }else {
					console.error(r.message);
					alertify.alert('Algo salio mal');
	      }
	    }
	  })
	});


/*******************************************************************/
// funciona para sueldos y honorarios



	$("#tbodyPercepciones").on('click', '.remove-percep',function(e){
	  $(this).closest("tr").hide();
	  $(this).parents('tr')
	    .removeClass('elemento-percep')
	    .addClass('elemento-percep-eliminar');
	  var gravado = $(this).parents('tr').find('.T_PERCEP_GRAVADO');
	  gravado.removeClass('T_PERCEP_GRAVADO');
	  var exento = $(this).parents('tr').find('.T_PERCEP_EXENTO');
	  exento.removeClass('T_PERCEP_EXENTO');
	  sumaGeneralNomina();
	});

	$("#tbodyPercepcionesOP").on('click', '.remove-PERCEPOP',function(e){
	  $(this).closest("tr").hide();
	  $(this).parents('tr')
	    .removeClass('elemento-percepop')
	    .addClass('elemento-percepop-eliminar');
	  var exento = $(this).parents('tr').find('.T_PERCEPOP_EXENTO');
	  exento.removeClass('T_PERCEPOP_EXENTO');
	  sumaGeneralNomina();
	});

	$("#tbodyPercepcionesSepIndem").on('click', '.remove-PERCEPSepIndem',function(e){
	  $(this).closest("tr").hide();
	  $(this).parents('tr')
	    .removeClass('elemento-percepSepIndem')
	    .addClass('elemento-percepSepIndem-eliminar');
	  var gravado = $(this).parents('tr').find('.T_PERCEPSepIndem_GRAVADO');
	  gravado.removeClass('T_PERCEPSepIndem_GRAVADO');
		var exento = $(this).parents('tr').find('.T_PERCEPSepIndem_EXENTO');
	  exento.removeClass('T_PERCEPSepIndem_EXENTO');
	  sumaGeneralNomina();
	});

	$("#tbodyPercepcionesHrExtra").on('click', '.remove-PERCEPHrExtra',function(e){
	  $(this).closest("tr").hide();
	  $(this).parents('tr')
	    .removeClass('elemento-percepHrExtra')
	    .addClass('elemento-percepHrExtra-eliminar');
	  var gravado = $(this).parents('tr').find('.T_PERCEPHrExtra_GRAVADO');
	  gravado.removeClass('T_PERCEPHrExtra_GRAVADO');
	  var exento = $(this).parents('tr').find('.T_PERCEPHrExtra_EXENTO');
	  exento.removeClass('T_PERCEPHrExtra_EXENTO');
	  sumaGeneralNomina();
	});

	$("#tbodyDeducciones").on('click', '.remove-DEDUC',function(e){
		$(this).closest("tr").hide();
		$(this).parents('tr')
			.removeClass('elemento-deduc')
			.addClass('elemento-deduc-eliminar');
		var gravado = $(this).parents('tr').find('.T_DEDUC_GRAVADO');
		gravado.removeClass('T_DEDUC_GRAVADO');
		var exento = $(this).parents('tr').find('.T_DEDUC_EXENTO');
		exento.removeClass('T_DEDUC_EXENTO');
		sumaGeneralNomina();
	});

	$("#tbodyDeduccionesPenAlim").on('click', '.remove-DEDUCPA',function(e){
		$(this).closest("tr").hide();
		$(this).parents('tr')
			.removeClass('elemento-deducPA')
			.addClass('elemento-deducPA-eliminar');
		var gravado = $(this).parents('tr').find('.T_DEDUCPA_GRAVADO');
		gravado.removeClass('T_DEDUCPA_GRAVADO');
		var exento = $(this).parents('tr').find('.T_DEDUCPA_EXENTO');
		exento.removeClass('T_DEDUCPA_EXENTO');
		sumaGeneralNomina();
	});


});

// para sueldos y honorarios

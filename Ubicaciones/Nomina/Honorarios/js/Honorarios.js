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



	$('#generarNuevoDocumento').click(function(){
		idRegimen = $('#nom_regimen').val();
		var data = {
			anio : $('#anio').val(),
			semana : $('#semana').val(),
			tipo : $('#opcionestipo').val(),
			descrip : $('#opcionesdescNom').val(),
			empleado : $('#empleado').val(),
			idRegimen : idRegimen
		}
		//console.log(data);
		$.ajax({
	    type: "POST",
	    url: "/Ubicaciones/Nomina/actions/docNomina_generarNuevo.php",
	    data: data,
	    success: 	function(r){
	      r = JSON.parse(r);
	      if (r.code == 1) {
					alertify.alert('Documento generado correctamente', function(){

						if( idRegimen == '02'){
							document.location.replace('/Ubicaciones/Nomina/SueldosySalarios/Generar_Nomina.php');
						}
						if( idRegimen == '09'){
							document.location.replace('/Ubicaciones/Nomina/Honorarios/GenerarNominaCFDI.php');
						}

					});
	      }
	    }
	  })
	});

	$(function(){
		  var ajaxCall = $.ajax({
		      method: 'POST',
		      url: '/Ubicaciones/Nomina/Honorarios/actions/catalogo_percepcionesCompNomina.php'
		  });

		  ajaxCall.done(function(r) {
		    r = JSON.parse(r);
		    if (r.code == 1) {
					$('#percepcionesComplementoNomina').html(r.data);
					$('#otrosPagosComplementoNomina').html(r.dataOtrosPagos);
		      $('#deduccionesComplementoNomina').html(r.datadeducciones);
		    } else {
		      console.error(r.message);
		    }
		  });
		});

	$('#guardar-editarDocNomina').click(function(){
		//$('#guardar-editarDocNomina').prop('disabled',true);
		idRegimen = $('#idRegimen').val();


		var data = {
			percepciones: {},
			percepcionesDelete: {},
			otrospagos: {},
			otrospagosDelete: {},
			horasextras: {},
			horasextrasDelete: {},
			percepSepIndem: {},
			percepSepIndemDelete: {},
			deducciones: {},
			deduccionesDelete: {},
			penalim: {},
			penalimDelete: {},
			idRegimen: $('#idRegimen').val(),
			idDocNomina: $('#doc').val(),
			fechaPago: $('#fechaPago').val(),
			valorUnitario: $('#valorUnitario').val(),
			valorImporte: $('#valorImporte').val(),
			tipo: $('#tipo').val(),
			indias: $('#indias').val(),
			indescontar: $('#indescontar').val(),
			inpagar: $('#inpagar').val(),
			totvacaciones: $('#totvac').val(),
			totfaltas: $('#totfaltas').val(),
			totpagar: $('#totpagar').val(),
			totpercep: $('#totpercep').val(),
			totdeduc: $('#totdeduc ').val(),
			tottotal: $('#tottotal').val(),
			tototrospagos: $('#tototrospagos').val(),
			totneto: $('#totneto').val(),
			anioserv: $('#anioserv').val(),
			ultsuelmesord: $('#ultsuelmesord').val(),
			ingacum: $('#ingacum').val(),
			ingnoacum: $('#ingnoacum').val(),
			totalpagado: $('#totalpagado').val(),
		};
console.log(data);
		$( ".elemento-percep" ).each(function(i) {
			var parsed_data = {
				cve: $(this).find('.cve').val(),
				ordenRep: $(this).find('.ordenRep').val(),
				idpartida: $(this).find('.id-partida').val(),
				cta: $(this).find('.cta').val(),
				desc: $(this).find('.desc').val(),
				gravado: $(this).find('.gravado').val(),
				exento: $(this).find('.exento').val()
			}
			data.percepciones[i] = parsed_data;
		});

		$( ".elemento-percep-eliminar" ).each(function(i) {
			var parsed_data = {
				idpartida: $(this).find('.id-partida').val()
			}
			data.percepcionesDelete[i] = parsed_data;
		});

		$( ".elemento-percepop" ).each(function(i) {
			var parsed_data = {
				cve: $(this).find('.cve').val(),
				ordenRep: $(this).find('.ordenRep').val(),
				idpartida: $(this).find('.id-partida').val(),
				cta: $(this).find('.cta').val(),
				desc: $(this).find('.desc').val(),
				exento: $(this).find('.exento').val(),
				subcausado: $(this).find('.subcausado').val(),
				anio: $(this).find('.anio').val(),
				saldofavor: $(this).find('.saldofavor').val()
			}
			data.otrospagos[i] = parsed_data;
		});

		$( ".elemento-percepop-eliminar" ).each(function(i) {
			var parsed_data = {
				idpartida: $(this).find('.id-partida').val()
			}
			data.otrospagosDelete[i] = parsed_data;
		});

		$( ".elemento-percepHrExtra" ).each(function(i) {
			var parsed_data = {
				cve: $(this).find('.cve').val(),
				ordenRep: $(this).find('.ordenRep').val(),
				idpartida: $(this).find('.id-partida').val(),
				cta: $(this).find('.cta').val(),
				desc: $(this).find('.desc').val(),
				dias: $(this).find('.dias').val(),
				horas: $(this).find('.horas').val(),
				gravado: $(this).find('.gravado').val(),
				exento: $(this).find('.exento').val()
			}
			data.horasextras[i] = parsed_data;
		});

		$( ".elemento-percepHrExtra-eliminar" ).each(function(i) {
			var parsed_data = {
				idpartida: $(this).find('.id-partida').val()
			}
			data.horasextrasDelete[i] = parsed_data;
		});

		$( ".elemento-percepSepIndem" ).each(function(i) {
		  var parsed_data = {
		    cve: $(this).find('.cve').val(),
		    ordenRep: $(this).find('.ordenRep').val(),
		    idpartida: $(this).find('.id-partida').val(),
		    cta: $(this).find('.cta').val(),
		    desc: $(this).find('.desc').val(),
		    gravado: $(this).find('.gravado').val(),
		    exento: $(this).find('.exento').val()
		  }
		  data.percepSepIndem[i] = parsed_data;
		});

		$( ".elemento-percepSepIndem-eliminar" ).each(function(i) {
		  var parsed_data = {
		    idpartida: $(this).find('.id-partida').val()
		  }
		  data.percepSepIndemDelete[i] = parsed_data;
		});

		$( ".elemento-deduc" ).each(function(i) {
			var parsed_data = {
				cve: $(this).find('.cve').val(),
				ordenRep: $(this).find('.ordenRep').val(),
				idpartida: $(this).find('.id-partida').val(),
				cta: $(this).find('.cta').val(),
				desc: $(this).find('.desc').val(),
				gravado: $(this).find('.gravado').val(),
				exento: $(this).find('.exento').val()
			}
			data.deducciones[i] = parsed_data;
		});

		$( ".elemento-deduc-eliminar" ).each(function(i) {
			var parsed_data = {
				idpartida: $(this).find('.id-partida').val()
			}
			data.deduccionesDelete[i] = parsed_data;
		});

		$( ".elemento-deducPA" ).each(function(i) {
			var parsed_data = {
				cve: $(this).find('.cve').val(),
				ordenRep: $(this).find('.ordenRep').val(),
				idpartida: $(this).find('.id-partida').val(),
				cta: $(this).find('.cta').val(),
				desc: $(this).find('.desc').val(),
				base: $(this).find('.base').val(),
				porcentaje: $(this).find('.porcentaje').val(),
				gravado: $(this).find('.gravado').val(),
				exento: $(this).find('.exento').val()
			}
			data.penalim[i] = parsed_data;
		});

		$( ".elemento-deducPA-eliminar" ).each(function(i) {
			var parsed_data = {
				idpartida: $(this).find('.id-partida').val()
			}
			data.penalimDelete[i] = parsed_data;
		});
	//console.log(data);

		$.ajax({
			type: "POST",
			url: "/Ubicaciones/Nomina/actions/docNomina_modificar.php",
			data: data,
			success: 	function(r){
				r = JSON.parse(r);
					console.log(r);
					console.log(r.message2);
				if (r.code == 1) {
					folio = r.data;

					alertify.alert('Modificado correctamente' , function(){
/*
						if( idRegimen == '02'){
							document.location.replace('/Ubicaciones/Nomina/SueldosySalarios/Generar_Nomina.php');
						}
						if( idRegimen == '09'){
							document.location.replace('/Ubicaciones/Nomina/Honorarios/GenerarNominaCFDI.php');
						}
*/
					});
				} else {
					console.error(r.message);
				}
			},
			error: function(x){
				console.error(x);
			}
		});

	});

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

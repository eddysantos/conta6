$(document).ready(function () {
	//tablasParametros113();
	ocultarFormato();

	$('.honorarios').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');


		/*Comienza Editar Datos Generales*/
		switch (accion) {
		  case "eCapHon":
		  if (status == 'cerrado') {
		    $('#contornoEmpHon').fadeIn();
		    $(this).attr('status', 'abierto');
		    $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
		    $(this).css('font-size', '15px');
		  } else {
		    $('#contornoEmpHon').fadeOut();
		    $(this).attr('status', 'cerrado');
		    $(this).css('color', "");
		    $(this).css('font-size', "");
		  }
		    break;
			case "dgenHon":
		  if (status == 'cerrado') {
		    $('#hon_dg').fadeIn();
		    $(this).attr('status', 'abierto');
		    $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
		    $(this).css('font-size', '15px');
		  } else {
		    $('#hon_dg').fadeOut();
		    $(this).attr('status', 'cerrado');
		    $(this).css('color', "");
		    $(this).css('font-size', "");
		  }
	    	break;
			/*Comienza Editar Datos Laborales*/
			case "dlabHon":
			if (status == 'cerrado') {
				$('#hon_dl').fadeIn();
				$(this).attr('status', 'abierto');
				$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
				$(this).css('font-size', '15px');
			} else {
				$('#hon_dl').fadeOut();
				$(this).attr('status', 'cerrado');
				$(this).css('color', "");
				$(this).css('font-size', "");
			}
				break;
			/*Comienza Editar Distribucion de Salario*/
			case "dsalHon":
			if (status == 'cerrado') {
				$('#hon_ds').fadeIn();
				$(this).attr('status', 'abierto');
				$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
				$(this).css('font-size', '15px');
			} else {
				$('#hon_ds').fadeOut();
				$(this).attr('status', 'cerrado');
				$(this).css('color', "");
				$(this).css('font-size', "");
			}
				break;
			/*Comienza Editar Honorarios*/
			// case "Hon":
			// if (status == 'cerrado') {
			// 	$('#hon_has').fadeIn();
			// 	$(this).attr('status', 'abierto');
			// 	$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
			// 	$(this).css('font-size', '15px');
			// } else {
			// 	$('#hon_has').fadeOut();
			// 	$(this).attr('status', 'cerrado');
			// 	$(this).css('color', "");
			// 	$(this).css('font-size', "");
			// }
			// 	break;

			case "gnominaHon":
	    if (status == 'cerrado') {
	      $('#contornognomHon').fadeIn();
	      // $('#generarnominaHon').fadeIn();
	      $(this).attr('status', 'abierto');
	      $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
	      $(this).css('font-size', '20px');
	    } else {
	      $('#contornognomHon').fadeOut();
	      // $('#generarnominaHon').fadeOut();
	      $(this).attr('status', 'cerrado');
	      $(this).css('color', "");
	      $(this).css('font-size', "");
	    }
      	break;

			case "gcfdiHon":
      if (status == 'cerrado') {
        $('#contornogcfdiHon').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#contornogcfdiHon').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;

      case "paramHon":
      if (status == 'cerrado') {
        $('#contornoparamHon').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#contornoparamHon').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
      default:
        console.error("Something went terribly wrong...");
    }
  });


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
	        $('#resGenNomHon').html(r.data);
					alertify.alert('Honorarios Semana: '+num_nomsig, 'Generado correctamente', function(){
						document.location.replace('/Ubicaciones/Nomina/Honorarios/GenerarNominaCFDI.php');
					});
	      }
	    }
	  })
	});


/*******************************************************************/
// funciona para sueldos y honorarios

	$('#buscaranio').change(function(){
		var data = {
			anio : $('#buscaranio').val(),
			regimen : $('#nom_regimen').val()
	  }
	  $.ajax({
	    type: "POST",
	    url: "/Resources/PHP/actions/consulta_nomina_semana.php",
	    data: data,
	    success: 	function(r){
	      r = JSON.parse(r);
	      if (r.code == 1) {
	        $('#resConNomSem').html(r.data);
	      }
	    }
	  })
	});

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
function consultaDocNominas(anio,nomina){
	if( nomina == null ){ nomina = $('#buscarsem').val(); }
	if( anio == null ){ anio = $('#buscaranio').val(); }

	consultaDatosGenNom(anio,nomina);
	consultaDatosDocNom(anio,nomina);
}

function consultaDatosGenNom(anio,nomina){
	var data = {
		anio : anio,
		nomina : nomina,
		regimen : $('#nom_regimen').val()
	}
	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Nomina/Honorarios/actions/consulta_nomina_generales.php",
		data: data,
		success: 	function(r){
			r = JSON.parse(r);
			if (r.code == 1) {
				$('#resConNomGenerales').html(r.data);
			}
		}
	})
}

function consultaDatosDocNom(anio,nomina){
	regimen = $('#nom_regimen').val();
	var data = {
		anio : anio,
		nomina : nomina,
		regimen : regimen
	}
	console.log(data);
	$.ajax({
		type: "POST",
		url: "/Ubicaciones/Nomina/Honorarios/actions/consulta_nomina_documentos.php",
		data: data,
		success: 	function(r){
			r = JSON.parse(r);
			console.log(r);
			if (r.code == 1) {
				$('#resConNomDcocumentos').html(r.data);

			}
		}
	})
}

function sustituirDocNomina(idDocNomina){
	swal({
	title: "Estas Seguro?",
	text: "Sustituir el documento! "+ idDocNomina +" ",
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
					idDocNomina : idDocNomina
				}
				$.ajax({
					type: "POST",
					url: "/Ubicaciones/Nomina/actions/docNomina_sustituir_cfdi.php",
					data: data,
					success: 	function(r){
						r = JSON.parse(r);
						console.log(r);
						if (r.code == 1) {
							swal("Copiado!", "Se copio correctamente.", "success");
							consultaDocNominas();
						}
					}
				});
			} else {
				swal("Cancelado", "El registro no se copio :)", "error");
			}
		});
}

function borrarDocNomina(idDocNomina){
	swal({
	title: "Estas Seguro?",
	text: "Ya no se podra recuperar el registro! "+ idDocNomina +" ",
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
					idDocNomina : idDocNomina
				}
				$.ajax({
					type: "POST",
					url: "/Ubicaciones/Nomina/actions/docNomina_borrar.php",
					data: data,
					success: 	function(r){
						r = JSON.parse(r);
						console.log(r);
						if (r.code == 1) {
							swal("Eliminado!", "Se elimino correctamente.", "success");
							consultaDocNominas();
						}
					}
				});
			} else {
				swal("Cancelado", "El registro esta a salvo :)", "error");
			}
		});
}

function borrarDocNominaTodos(){
			swal({
			title: "Estas Seguro?",
			text: "Ya no se podra recuperar los registros! ",
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
							semana : $('#buscarsem').val(),
							anio : $('#buscaranio').val(),
							idRegimen : $('#nom_regimen').val(),
							docNominaDelete: {}
						}
						$( ".elemento-docNomina" ).each(function(i) {
			        var parsed_data = {
			          idDocNomina: $(this).find('.id-docNomina').val()
			        }
			        data.docNominaDelete[i] = parsed_data;
			      });
						console.log(data);

						$.ajax({
							type: "POST",
							url: "/Ubicaciones/Nomina/actions/docNomina_borrarTodos.php",
							data: data,
							success: 	function(r){
								r = JSON.parse(r);
								console.log(r);
								if (r.code == 1) {
									swal("Eliminado!", "Se elimino correctamente.", "success");
									consultaDocNominas();
								}
							}
						});


					} else {
						swal("Cancelado", "El registro esta a salvo :)", "error");
					}
				});
}

function editarDocNomina(idDocNomina){
	document.location.replace('/Ubicaciones/Nomina/ModificarCFDI.php?idDocNomina='+idDocNomina);
}

function nuevoDocNomina(){
	regimen = $('#nom_regimen').val();
	semana = $('#buscarsem').val();
	anio = $('#buscaranio').val();
	document.location.replace('/Ubicaciones/Nomina/nuevoDoc.php?regimen='+regimen+'&semana='+semana+'&anio='+anio);
}

function imprimirNomina(anio,semana,tipo,regimen){
	if( regimen == '09' ){
		window.open('/Ubicaciones/Nomina/Honorarios/actions/impresionNominaCompleto.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
	}
	if( regimen == '02' ){
		window.open('/Ubicaciones/Nomina/SueldosySalarios/actions/impresionNominaCompletoSuel.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
	}
}

function imprimirNominaExcel(anio,semana,tipo,regimen){
	if( regimen == '09' ){
		window.open('/Ubicaciones/Nomina/Honorarios/actions/impresionNominaCompleto_excel.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
	}
	if( regimen == '02' ){
		window.open('/Ubicaciones/Nomina/SueldosySalarios/actions/impresionNominaCompletoSuel_excel.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
	}
}


/*
function imprimirNominaOrdinaria(anio,semana,tipo){
	tipo = 'O';
	window.open('/Ubicaciones/Nomina/Honorarios/actions/impresionNominaOrdinaria.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
}

function imprimirNominaExtra(anio,semana,tipo){
	tipo = 'E';
	window.open('/Ubicaciones/Nomina/Honorarios/actions/impresionNominaOrdinaria.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
}
*/
function impresionCFDICompleto(){
	anio = $('#buscaranio').val();
	semana = $('#buscarsem').val();
	tipo = 'Todas';
	window.open('/Ubicaciones/Nomina/Honorarios/actions/impresion_Nomina_HAS.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
}


function ocultarFormato(){
	idRegimen = $('#idRegimen').val();
	if( idRegimen == '09' ){
		$('#formOtrospagos').attr('style', 'display:none');
		$('#formHorasextras').attr('style', 'display:none');
		$('#formPension').attr('style', 'display:none');
	}
}

function concepPercepciones(){
	cadena = $('#percepcionConceptos').val();
	parteCadena = cadena.split("+");
	$('#claveSATpercepcion').val(parteCadena[0]).attr('value',parteCadena[0]);
	$('#claveInternaPercepcion').val(parteCadena[1]).attr('value',parteCadena[1]);
	$('#desPercepcion').val(parteCadena[2]).attr('value',parteCadena[2]);
	$('#ordenReportePercepcion').val(parteCadena[3]);
}
function concepPercepcionesHrExtra(){
	cadena = $('#percepcionConceptosHrExtra').val();
	parteCadena = cadena.split("+");
	$('#claveSATpercepcionHrExtra').val(parteCadena[0]).attr('value',parteCadena[0]);
	$('#claveInternapercepcionHrExtra').val(parteCadena[1]).attr('value',parteCadena[1]);
	$('#despercepcionHrExtra').val(parteCadena[2]).attr('value',parteCadena[2]);
	$('#ordenReportepercepcionHrExtra').val(parteCadena[3]);
}
function concepPercepcionesSepIndem(){
	cadena = $('#percepcionConceptosSepIndem').val();
	parteCadena = cadena.split("+");
	$('#claveSATpercepcionSepIndem').val(parteCadena[0]).attr('value',parteCadena[0]);
	$('#claveInternapercepcionSepIndem').val(parteCadena[1]).attr('value',parteCadena[1]);
	$('#despercepcionSepIndem').val(parteCadena[2]).attr('value',parteCadena[2]);
	$('#ordenReportepercepcionSepIndem').val(parteCadena[3]);
}
function concepPercepcionesOP(){
	cadena = $('#percepcionConceptosOP').val();
	parteCadena = cadena.split("+");
	cveSAT = parteCadena[0];
	$('#claveSATpercepcionOP').val(parteCadena[0]).attr('value',cveSAT);
	$('#claveInternaPercepcionOP').val(parteCadena[1]).attr('value',parteCadena[1]);
	$('#desPercepcionOP').val(parteCadena[2]).attr('value',parteCadena[2]);
	$('#ordenReportePercepcionOP').val(parteCadena[3]);

	// si es la cveSAT=='002' DEBE ACTIVAR IMPORTE Y SUBSIDIO CUSADO
	if(cveSAT == '004'){ //ISR A FAVOR, se captura año y saldo a favor
		$('#anioPercepcionOP').attr('class','').attr('class','efecto');
		$('#anioPercepcionOP').removeAttr("readonly") ;
		//$('#anioPercepcionOP').removeAttr("readOnly",true);
    //$('#anioPercepcionOP').removeClass("readOnly");

		$('#saldoFavorPercepcionOP').attr('class','').attr('class','efecto');
		$('#saldoFavorPercepcionOP').removeAttr("readonly") ;
		//$('#saldoFavorPercepcionOP').removeAttr("readOnly",true);
    //$('#saldoFavorPercepcionOP').removeClass("readOnly");
	}else{
		$('#anioPercepcionOP').attr('class','').attr('class','efecto h22 border-0');
		$('#anioPercepcionOP').addAatrr("readOnly",'readOnly');
    //$('#anioPercepcionOP').addClass("readOnly");

		$('#saldoFavorPercepcionOP').attr('class','').attr('class','efecto h22 border-0');
		$('#saldoFavorPercepcionOP').addAtrr("readOnly",'readOnly');
		//$('#saldoFavorPercepcionOP').prop("readOnly",'');
    //$('#saldoFavorPercepcionOP').addClass("readOnly");
	}
}

function concepDeducciones(){
	cadena = $('#deduccionConceptos').val();
	parteCadena = cadena.split("+");
	$('#claveSATDeduccion').val(parteCadena[0]).attr('value',parteCadena[0]);
	$('#claveInternaDeduccion').val(parteCadena[1]).attr('value',parteCadena[1]);
	$('#desDeduccion').val(parteCadena[2]).attr('value',parteCadena[2]);
	$('#ordenReporteDeduccion').val(parteCadena[3]);
}

function concepDeducPenAlim(){
	cadena = $('#deduccionPenAlim').val();
	parteCadena = cadena.split("+");
	$('#claveSATDeduccion_penAlim').val(parteCadena[0]).attr('value',parteCadena[0]);
	$('#claveInternaDeduccion_penAlim').val(parteCadena[1]).attr('value',parteCadena[1]);
	$('#desDeduccion_penAlim').val(parteCadena[2]).attr('value',parteCadena[2]);
	$('#ordenReporteDeduccion_penAlim').val(parteCadena[3]);
}

function agregarPercep(){
  cve = $('#claveSATpercepcion').val();
	ordenRep = $('#ordenReportePercepcion').val();
	cta =  $('#claveInternaPercepcion').val();
	concepto = $('#desPercepcion').val();
	gravado = $('#importeGravadoPercepcion').val();
	exento = $('#importeExentoPercepcion').val();

  if( cta == "" ){
    alertify.success('Seleccione un concepto');
  }else {

      var element = $('.T_PERCEP_DESC').length;

			newtr = "<tr class='row mt-4 m-0 trPERCEP elemento-percep' id='"+element+"'>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEP_cve"+element+"' class='T_PERCEP_CVE cve efecto border-0' readonly>";
			newtr = newtr + "    		<input type='hidden' id='T_PERCEP_ordenRep"+element+"' class='T_PERCEP_ORDENREP ordenRep' >";
			newtr = newtr + "    		<input type='hidden' id='T_PERCEP_ID-PARTIDA"+element+"' class='T_PERCEP_ID-PARTIDA id-partida' >";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEP_cta"+element+"' class='T_PERCEP_CTA cta efecto border-0' readonly>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-4 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEP_desc"+element+"' class='T_PERCEP_DESC desc efecto'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEP_gravado"+element+"' class='T_PERCEP_GRAVADO gravado efecto' onblur='validaIntDec(this); sumaGeneralNomina();'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEP_exento"+element+"' class='T_PERCEP_EXENTO exento efecto' onblur='validaIntDec(this); sumaGeneralNomina()'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td>";
			newtr = newtr + "    		<a><img class='icomediano remove-percep' src='/Resources/iconos/002-trash.svg'></a>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    </tr>";

      $('#tbodyPercepciones').append(newtr);

      $(".remove-percep").click(function(e){
        $(this).closest("tr").remove();
        alertify.success('Se elimino correctamente');
        sumaGeneralNomina();
      });

      var element = $('.T_PERCEP_DESC').length;
      $( ".T_PERCEP_DESC" ).each(function( x ) {
    	  if( $('.T_PERCEP_DESC').eq(x).val() == "" ){

          $('.T_PERCEP_CVE').eq(x).val(cve);
          $('.T_PERCEP_ORDENREP').eq(x).val(ordenRep);
          $('.T_PERCEP_CTA').eq(x).val(cta);
          $('.T_PERCEP_DESC').eq(x).val(concepto);
    		  $('.T_PERCEP_GRAVADO').eq(x).val(gravado);
    		  $('.T_PERCEP_EXENTO').eq(x).val(exento);

    		  $('#percepcionConceptos').val(0);
    			$('#claveSATpercepcion').val("");
          $('#ordenReportePercepcion').val("");
          $('#claveInternaPercepcion').val("");
    			$('#desPercepcion').val("");
    			$('#importeGravadoPercepcion').val("");
    			$('#importeExentoPercepcion').val("");
    			sumaGeneralNomina();

    		  return false;
    	  }
      });

    }
}

function agregarPercepHrExtra(){
  cve = $('#claveSATpercepcionHrExtra').val();
	ordenRep = $('#ordenReportepercepcionHrExtra').val();
	cta =  $('#claveInternapercepcionHrExtra').val();
	concepto = $('#despercepcionHrExtra').val();
	dias = $('#diaspercepcionHrExtra').val();
	horas = $('#hrpercepcionHrExtra').val();
	gravado = $('#importeGravadopercepcionHrExtra').val();
	exento = $('#importeExentopercepcionHrExtra').val();

  if( cta == "" ){
    alertify.success('Seleccione un concepto');
  }else {

      var element = $('.T_PERCEPHrExtra_DESC').length;

			newtr = "<tr class='row mt-4 m-0 trPERCEPHrExtra elemento-percepHrExtra' id='"+element+"'>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPHrExtra_cve"+element+"' class='T_PERCEPHrExtra_CVE cve efecto border-0' readonly>";
			newtr = newtr + "    		<input type='hidden' id='T_PERCEPHrExtra_ordenRep"+element+"' class='T_PERCEPHrExtra_ORDENREP ordenRep' >";
			newtr = newtr + "    		<input type='hidden' id='T_PERCEPHrExtra_id-partida"+element+"' class='T_PERCEPHrExtra_ID-PARTIDA id-partida' >";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPHrExtra_cta"+element+"' class='T_PERCEPHrExtra_CTA cta efecto border-0' readonly>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-4 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPHrExtra_desc"+element+"' class='T_PERCEPHrExtra_DESC desc efecto'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPHrExtra_dias"+element+"' class='T_PERCEPHrExtra_DIAS dias efecto'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPHrExtra_horas"+element+"' class='T_PERCEPHrExtra_HORAS horas efecto'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPHrExtra_gravado"+element+"' class='T_PERCEPHrExtra_GRAVADO gravado efecto' onblur='validaIntDec(this); sumaGeneralNomina()'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPHrExtra_exento"+element+"' class='T_PERCEPHrExtra_EXENTO exento efecto' onblur='validaIntDec(this); sumaGeneralNomina()'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td>";
			newtr = newtr + "    		<a><img class='icomediano remove-PERCEPHrExtra' src='/Resources/iconos/002-trash.svg'></a>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    </tr>";

      $('#tbodyPercepcionesHrExtra').append(newtr);

      $(".remove-PERCEPHrExtra").click(function(e){
        $(this).closest("tr").remove();
        alertify.success('Se elimino correctamente');
        sumaGeneralNomina();
      });

      var element = $('.T_PERCEPHrExtra_DESC').length;
      $( ".T_PERCEPHrExtra_DESC" ).each(function( x ) {
    	  if( $('.T_PERCEPHrExtra_DESC').eq(x).val() == "" ){

          $('.T_PERCEPHrExtra_CVE').eq(x).val(cve);
          $('.T_PERCEPHrExtra_ORDENREP').eq(x).val(ordenRep);
          $('.T_PERCEPHrExtra_CTA').eq(x).val(cta);
          $('.T_PERCEPHrExtra_DESC').eq(x).val(concepto);
					$('.T_PERCEPHrExtra_DIAS').eq(x).val(dias);
					$('.T_PERCEPHrExtra_HORAS').eq(x).val(horas);
    		  $('.T_PERCEPHrExtra_GRAVADO').eq(x).val(gravado);
    		  $('.T_PERCEPHrExtra_EXENTO').eq(x).val(exento);

    		  $('#percepcionConceptosHrExtra').val(0);
    			$('#claveSATpercepcionHrExtra').val("");
          $('#ordenReportepercepcionHrExtra').val("");
          $('#claveInternapercepcionHrExtra').val("");
    			$('#despercepcionHrExtra').val("");
					$('#diaspercepcionHrExtra').val("");
					$('#hrpercepcionHrExtra').val("");
    			$('#importeGravadopercepcionHrExtra').val("");
    			$('#importeExentopercepcionHrExtra').val("");

    			sumaGeneralNomina();

    		  return false;
    	  }
      });

    }
}

function agregarPercepSepIndem(){
  cve = $('#claveSATpercepcionSepIndem').val();
	ordenRep = $('#ordenReportepercepcionSepIndem').val();
	cta =  $('#claveInternapercepcionSepIndem').val();
	concepto = $('#despercepcionSepIndem').val();
	dias = $('#diaspercepcionSepIndem').val();
	horas = $('#hrpercepcionSepIndem').val();
	gravado = $('#importeGravadopercepcionSepIndem').val();
	exento = $('#importeExentopercepcionSepIndem').val();

  if( cta == "" ){
    alertify.success('Seleccione un concepto');
  }else {

      var element = $('.T_PERCEPSepIndem_DESC').length;

			newtr = "<tr class='row mt-4 m-0 trPERCEPSepIndem elemento-percepSepIndem' id='"+element+"'>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPSepIndem_cve"+element+"' class='T_PERCEPSepIndem_CVE cve efecto border-0' readonly>";
			newtr = newtr + "    		<input type='hidden' id='T_PERCEPSepIndem_ordenRep"+element+"' class='T_PERCEPSepIndem_ORDENREP ordenRep' >";
			newtr = newtr + "    		<input type='hidden' id='T_PERCEPSepIndem_id-partida"+element+"' class='T_PERCEPSepIndem_ID-PARTIDA id-partida' >";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPSepIndem_cta"+element+"' class='T_PERCEPSepIndem_CTA cta efecto border-0' readonly>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-4 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPSepIndem_desc"+element+"' class='T_PERCEPSepIndem_DESC desc efecto'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPSepIndem_gravado"+element+"' class='T_PERCEPSepIndem_GRAVADO gravado efecto' onblur='validaIntDec(this); sumaGeneralNomina()'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPSepIndem_exento"+element+"' class='T_PERCEPSepIndem_EXENTO exento efecto' onblur='validaIntDec(this); sumaGeneralNomina()'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td>";
			newtr = newtr + "    		<a><img class='icomediano remove-PERCEPSepIndem' src='/Resources/iconos/002-trash.svg'></a>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    </tr>";

      $('#tbodyPercepcionesSepIndem').append(newtr);

      $(".remove-PERCEPSepIndem").click(function(e){
        $(this).closest("tr").remove();
        alertify.success('Se elimino correctamente');
        sumaGeneralNomina();
      });

      var element = $('.T_PERCEPSepIndem_DESC').length;
      $( ".T_PERCEPSepIndem_DESC" ).each(function( x ) {
    	  if( $('.T_PERCEPSepIndem_DESC').eq(x).val() == "" ){

          $('.T_PERCEPSepIndem_CVE').eq(x).val(cve);
          $('.T_PERCEPSepIndem_ORDENREP').eq(x).val(ordenRep);
          $('.T_PERCEPSepIndem_CTA').eq(x).val(cta);
          $('.T_PERCEPSepIndem_DESC').eq(x).val(concepto);
    		  $('.T_PERCEPSepIndem_GRAVADO').eq(x).val(gravado);
    		  $('.T_PERCEPSepIndem_EXENTO').eq(x).val(exento);

    		  $('#percepcionConceptosSepIndem').val(0);
    			$('#claveSATpercepcionSepIndem').val("");
          $('#ordenReportepercepcionSepIndem').val("");
          $('#claveInternapercepcionSepIndem').val("");
    			$('#despercepcionSepIndem').val("");
    			$('#importeGravadopercepcionSepIndem').val("");
    			$('#importeExentopercepcionSepIndem').val("");

    			sumaGeneralNomina();

    		  return false;
    	  }
      });

    }
}

function agregarPercepOtrosPagos(){
  cve = $('#claveSATpercepcionOP').val();
	ordenRep = $('#ordenReportePercepcionOP').val();
	cta =  $('#claveInternaPercepcionOP').val();
	concepto = $('#desPercepcionOP').val();
	exento = $('#importeExentoPercepcionOP').val();
	subCausado = $('#subCausadoPOP').val();
	anio = $('#anioPercepcionOP').val();
	saldo = $('#saldoFavorPercepcionOP').val();

  if( cta == "" ){
    alertify.success('Seleccione un concepto');
  }else {

      var element = $('.T_PERCEPOP_DESC').length;

			newtr = "<tr class='row mt-4 m-0 trPERCEPOP elemento-percepop' id='"+element+"'>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_cve"+element+"' class='T_PERCEPOP_CVE cve efecto border-0' readonly>";
			newtr = newtr + "    		<input type='hidden' id='T_PERCEPOP_ordenRep"+element+"' class='T_PERCEPOP_ORDENREP ordenRep' >";
			newtr = newtr + "    		<input type='hidden' id='T_PERCEPOP_id-partida"+element+"' class='T_PERCEPOP_ID-PARTIDA id-partida' >";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_cta"+element+"' class='T_PERCEPOP_CTA cta efecto border-0' readonly>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-3 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_desc"+element+"' class='T_PERCEPOP_DESC desc efecto'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_exento"+element+"' class='T_PERCEPOP_EXENTO exento efecto' onblur='validaIntDec(this); sumaGeneralNomina()'>";
			newtr = newtr + "    	</td>";

			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_subCausado"+element+"' class='T_PERCEPOP_SUBCAUSADO subCausado efecto' onblur='validaIntDec(this)';'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_anio"+element+"' class='T_PERCEPOP_ANIO anio efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_saldoFavor"+element+"' class='T_PERCEPOP_SALDOFAVOR saldofavor efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td>";
			newtr = newtr + "    		<a><img class='icomediano remove-PERCEPOP' src='/Resources/iconos/002-trash.svg'></a>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    </tr>";

      $('#tbodyPercepcionesOP').append(newtr);

      $(".remove-PERCEPOP").click(function(e){
        $(this).closest("tr").remove();
        alertify.success('Se elimino correctamente');
        sumaGeneralNomina();
      });

      var element = $('.T_PERCEPOP_DESC').length;
      $( ".T_PERCEPOP_DESC" ).each(function( x ) {
    	  if( $('.T_PERCEPOP_DESC').eq(x).val() == "" ){

          $('.T_PERCEPOP_CVE').eq(x).val(cve);
          $('.T_PERCEPOP_ORDENREP').eq(x).val(ordenRep);
          $('.T_PERCEPOP_CTA').eq(x).val(cta);
          $('.T_PERCEPOP_DESC').eq(x).val(concepto);
    		  $('.T_PERCEPOP_EXENTO').eq(x).val(exento);
					$('.T_PERCEPOP_SUBCAUSADO').eq(x).val(subCausado);
					$('.T_PERCEPOP_ANIO').eq(x).val(anio);
					$('.T_PERCEPOP_SALDOFAVOR').eq(x).val(saldo);

    		  $('#percepcionConceptosOP').val(0);
    			$('#claveSATpercepcionOP').val("");
          $('#ordenReportePercepcionOP').val("");
          $('#claveInternaPercepcionOP').val("");
    			$('#desPercepcionOP').val("");
    			$('#importeExentoPercepcionOP').val("");
					$('#subCausadoPOP').val("");
					$('#anioPercepcionOP').val("");
					$('#saldoFavorPercepcionOP').val("");
    			sumaGeneralNomina();

    		  return false;
    	  }
      });

    }
}

function agregarDeduc(){
  cve = $('#claveSATDeduccion').val();
	ordenRep = $('#ordenReporteDeduccion').val();
	cta =  $('#claveInternaDeduccion').val();
	concepto = $('#desDeduccion').val();
	gravado = $('#importeGravadoDeduccion').val();
	exento = $('#importeExentoDeduccion').val();

  if( cta == "" ){
    alertify.success('Seleccione un concepto');
  }else {

      var element = $('.T_DEDUC_DESC').length;

			newtr = "<tr class='row mt-4 m-0 trDEDUC elemento-deduc' id='"+element+"'>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUC_cve"+element+"' class='T_DEDUC_CVE cve efecto border-0' readonly>";
			newtr = newtr + "    		<input type='hidden' id='T_DEDUC_ordenRep"+element+"' class='T_DEDUC_ORDENREP ordenRep' >";
			newtr = newtr + "    		<input type='hidden' id='T_DEDUC_id-partida"+element+"' class='T_DEDUC_ID-PARTIDA id-partida' >";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUC_cta"+element+"' class='T_DEDUC_CTA cta efecto border-0' readonly>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-4 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUC_desc"+element+"' class='T_DEDUC_DESC desc efecto'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUC_gravado"+element+"' class='T_DEDUC_GRAVADO gravado efecto' onblur='validaIntDec(this); sumaGeneralNomina()'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUC_exento"+element+"' class='T_DEDUC_EXENTO exento efecto' onblur='validaIntDec(this); sumaGeneralNomina()'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td>";
			newtr = newtr + "    		<a><img class='icomediano remove-DEDUC' src='/Resources/iconos/002-trash.svg'></a>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    </tr>";

      $('#tbodyDeducciones').append(newtr);

      $(".remove-DEDUC").click(function(e){
        $(this).closest("tr").remove();
        alertify.success('Se elimino correctamente');
        sumaGeneralNomina();
      });

      var element = $('.T_DEDUC_DESC').length;
      $( ".T_DEDUC_DESC" ).each(function( x ) {
    	  if( $('.T_DEDUC_DESC').eq(x).val() == "" ){

          $('.T_DEDUC_CVE').eq(x).val(cve);
          $('.T_DEDUC_ORDENREP').eq(x).val(ordenRep);
          $('.T_DEDUC_CTA').eq(x).val(cta);
          $('.T_DEDUC_DESC').eq(x).val(concepto);
    		  $('.T_DEDUC_GRAVADO').eq(x).val(gravado);
    		  $('.T_DEDUC_EXENTO').eq(x).val(exento);

    		  $('#deduccionConceptos').val(0);
    			$('#claveSATdeduccion').val("");
          $('#ordenReporteDeduccion').val("");
          $('#claveInternaDeduccion').val("");
    			$('#desDeduccion').val("");
    			$('#importeGravadoDeduccion').val("");
    			$('#importeExentoDeduccion').val("");
    			sumaGeneralNomina();

    		  return false;
    	  }
      });

    }
}

function agregarDeducPenAlimen(){
  cve = $('#claveSATDeduccion_penAlim').val();
	ordenRep = $('#ordenReporteDeduccion_penAlim').val();
	cta =  $('#claveInternaDeduccion_penAlim').val();
	concepto = $('#desDeduccion_penAlim').val();
  base = $('#baseDeduccion_penAlim').val();
  porcentaje = $('#porcentajeDeduccion_penAlim').val();
	gravado = $('#importeGravadoDeduccion_penAlim').val();
	exento = $('#importeExentoDeduccion_penAlim').val();

  if( cta == "" ){
    alertify.success('Seleccione un concepto');
  }else {

      var element = $('.T_DEDUCPA_DESC').length;

			newtr = "<tr class='row mt-4 m-0 trDEDUCPA elemento-deducPA' id='"+element+"'>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUCPA_cve"+element+"' class='T_DEDUCPA_CVE cve efecto border-0' readonly>";
			newtr = newtr + "    		<input type='hidden' id='T_DEDUCPA_ordenRep"+element+"' class='T_DEDUCPA_ORDENREP ordenRep' >";
			newtr = newtr + "    		<input type='hidden' id='T_DEDUCPA_id-partida"+element+"' class='T_DEDUCPA_ID-PARTIDA id-partida' >";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUCPA_cta"+element+"' class='T_DEDUCPA_CTA cta efecto border-0' readonly>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-4 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUCPA_desc"+element+"' class='T_DEDUCPA_DESC desc efecto'>";
			newtr = newtr + "    	</td>";
      newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUCPA_base"+element+"' class='T_DEDUCPA_BASE base efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUCPA_porcentaje"+element+"' class='T_DEDUCPA_PORCENTAJE porcentaje efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
      newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUCPA_gravado"+element+"' class='T_DEDUCPA_GRAVADO gravado efecto' onblur='validaIntDec(this); sumaGeneralNomina()'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUCPA_exento"+element+"' class='T_DEDUCPA_EXENTO exento efecto' onblur='validaIntDec(this); sumaGeneralNomina()'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td>";
			newtr = newtr + "    		<a><img class='icomediano remove-DEDUCPA' src='/Resources/iconos/002-trash.svg'></a>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    </tr>";

      $('#tbodyDeduccionesPenAlim').append(newtr);

      $(".remove-DEDUCPA").click(function(e){
        $(this).closest("tr").remove();
        alertify.success('Se elimino correctamente');
        sumaGeneralNomina();
      });

      var element = $('.T_DEDUCPA_DESC').length;
      $( ".T_DEDUCPA_DESC" ).each(function( x ) {
    	  if( $('.T_DEDUCPA_DESC').eq(x).val() == "" ){

          $('.T_DEDUCPA_CVE').eq(x).val(cve);
          $('.T_DEDUCPA_ORDENREP').eq(x).val(ordenRep);
          $('.T_DEDUCPA_CTA').eq(x).val(cta);
          $('.T_DEDUCPA_DESC').eq(x).val(concepto);
          $('.T_DEDUCPA_BASE').eq(x).val(base);
          $('.T_DEDUCPA_PORCENTAJE').eq(x).val(porcentaje);
    		  $('.T_DEDUCPA_GRAVADO').eq(x).val(gravado);
    		  $('.T_DEDUCPA_EXENTO').eq(x).val(exento);

    		  $('#deduccionConceptos_penAlim').val(0);
    			$('#claveSATdeduccion_penAlim').val("");
          $('#ordenReporteDeduccion_penAlim').val("");
          $('#claveInternaDeduccion_penAlim').val("");
    			$('#desDeduccion_penAlim').val("");
          $('#baseDeduccion_penAlim').val("");
          $('#porcentajeDeduccion_penAlim').val("");
    			$('#importeGravadoDeduccion_penAlim').val("");
    			$('#importeExentoDeduccion_penAlim').val("");
    			sumaGeneralNomina();

    		  return false;
    	  }
      });

    }
}

function sumaGeneralNomina(){
	//*********************************** SUMA PERCEPCIONES $sum_percepcion = $sum_percep + $sum_horasExtras;
	totalVales = 0;
	totalPercepHrExtra = 0;
	totalPercepSepIndem = 0;
	totalPercep = 0;
	neto = 0;
	$( ".T_PERCEP_GRAVADO" ).each(function( x ) {
		cve = $('.T_PERCEP_CVE').eq(x).val();
		gravado = $('.T_PERCEP_GRAVADO').eq(x).val();
		exento = $('.T_PERCEP_EXENTO').eq(x).val();

		if( gravado == "" ){ gravado = 0; }
		if( exento == "" ){ exento = 0; }

		if( cve == '029' ){ // 029 VALES DE DESPENSA
			totalVales = cortarDecimales(CalcADD(gravado,exento),2);
		}

		totalP = cortarDecimales(CalcADD(gravado,exento),2);
		totalPercep = cortarDecimales(CalcADD(totalPercep,totalP),2);
	});

	$( ".T_PERCEPHrExtra_GRAVADO" ).each(function( x ) {
		gravado = $('.T_PERCEPHrExtra_GRAVADO').eq(x).val();
		exento = $('.T_PERCEPHrExtra_EXENTO').eq(x).val();

		if( gravado == "" ){ gravado = 0; }
		if( exento == "" ){ exento = 0; }


		totalPercepHrE = cortarDecimales(CalcADD(gravado,exento),2);
		totalPercepHrExtra = cortarDecimales(CalcADD(totalPercepHrExtra,totalPercepHrE),2);
	});

	$( ".T_PERCEPSepIndem_GRAVADO" ).each(function( x ) {
		gravado = $('.T_PERCEPSepIndem_GRAVADO').eq(x).val();
		exento = $('.T_PERCEPSepIndem_EXENTO').eq(x).val();

		if( gravado == "" ){ gravado = 0; }
		if( exento == "" ){ exento = 0; }


		totalPercepIndem = cortarDecimales(CalcADD(gravado,exento),2);
		totalPercepSepIndem = cortarDecimales(CalcADD(totalPercepSepIndem,totalPercepIndem),2);
	});

	totalPercepciones = cortarDecimales(CalcADD(totalPercep,totalPercepHrExtra),2);
	totalPercepciones = cortarDecimales(CalcADD(totalPercepciones,totalPercepSepIndem),2);
	$('#totpercep').val(totalPercepciones).attr('value',totalPercepciones);



	//*********************************** SUMA DEDUCCIONES
	suma_DEDUC_GRAVADO = 0;
	suma_DEDUC_EXENTO = 0;
	suma_DEDUCPA_EXENTO = 0;

	$( ".T_DEDUC_GRAVADO" ).each(function( x ) {
			gravado = $(this).val();
			if( gravado == "" ){ gravado = 0; }
			suma_DEDUC_GRAVADO = cortarDecimales(CalcADD(suma_DEDUC_GRAVADO,gravado),2);
	});

	$( ".T_DEDUC_EXENTO" ).each(function( x ) {
			exento = $(this).val();
			if( exento == "" ){ exento = 0; }
			suma_DEDUC_EXENTO = cortarDecimales(CalcADD(suma_DEDUC_EXENTO,exento),2);
	});

	//pension alimenticia
	$( ".T_DEDUCPA_EXENTO" ).each(function( x ) {
			exento = $(this).val();
			if( exento == "" ){ exento = 0; }
			suma_DEDUCPA_EXENTO = cortarDecimales(CalcADD(suma_DEDUCPA_EXENTO,exento),2);
	});

	totalDeduc = cortarDecimales(CalcADD(suma_DEDUC_GRAVADO, suma_DEDUC_EXENTO),2);
	totalDeduc = cortarDecimales(CalcADD(totalDeduc, suma_DEDUCPA_EXENTO),2);
	$('#totdeduc').val(totalDeduc).attr('value',totalDeduc);

	//*********************************** TOTAL #TOTAL = PERCEPCIONES - DEDUCCIONES
	total = cortarDecimales(CalcSUB(totalPercep, totalDeduc),2);
	$('#tottotal').val(total).attr('value',total);
	$('#valorUnitario').val(totalPercepciones).attr('value',totalPercepciones);
	$('#valorImporte').val(totalPercepciones).attr('value',totalPercepciones);

	//*********************************** OTROS PAGOS
	otrosPagos = 0;
	$( ".T_PERCEPOP_EXENTO" ).each(function( x ) {
			exento = $(this).val();
			if( exento == "" ){ exento = 0; }
			otrosPagos = cortarDecimales(CalcADD(otrosPagos,exento),2);
			console.log(otrosPagos);
	});
	$('#tototrospagos').val(otrosPagos).attr('value',otrosPagos);


	//*********************************** NETO $neto = $resta_percepcionDeduccion - $sum_valesDespensa;
	neto1 = cortarDecimales(CalcSUB(total,totalVales),2);
	neto = cortarDecimales(CalcADD(neto1,otrosPagos),2);
	$('#totneto').val(neto).attr('value',neto);

}

function concepIncapacidad(){
	$('#tipo').val( $('#incapacidadConceptos').val() );
}

// Timbrar factura electronica
function timbrarDocNomina(idDocNomina,regimenNomina){
  var data = {
    idDocNomina: idDocNomina,
		regimen: regimenNomina
  }

  $.ajax({
    type: "POST",
    url: "/Ubicaciones/Nomina/actions/generarCFDI_docNomina.php",
    data: data,
    beforeSend: function(){
        $('body').append('<div class="overlay"><div class="overlay-loading">Timbrando Documento ... Porfavor espere.</div></div>');
    },

      success: 	function(r){
        r = JSON.parse(r);
        console.log(r);
        if (r.code == 1) {
          //$('#respTimbrado').val(r);
          resp = r.message;
          $('.overlay').remove();

          swal({
            title: 'Timbrar Factura',
            text: resp,
            type: 'success'
            }, function() {
                setTimeout('document.location.reload()',700);
            });

        }else if( r.code == 3 ) {
          resp = r.message;
          $('.overlay').remove();
          swal("Respuesta del PAC:",resp, "error");
          console.error(r.message);
        }else{
          resp = r.message;
          $('.overlay').remove();
          swal("Error",resp, "error");
          console.error(r.message);
        }
    },
    error: function(x){
      console.error(x)
    }
  });
}

function modificarPolizaNomina(id_poliza){
	window.location.replace('/Ubicaciones/Contabilidad/polizas/DetallePoliza.php?id_poliza='+id_poliza+'&tipo=4');
}

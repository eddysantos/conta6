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

		if( fp_nomsig == ""){
				alertify.success('Asigne fecha pago');
				return false;
		}

		var data = {
			anio_nomsig : $('#anio_nomsig').val(),
			num_nomsig : num_nomsig,
			fi_nomsig : $('#fi_nomsig').val(),
			ff_nomsig : $('#ff_nomsig').val(),
			fp_nomsig : fp_nomsig,
			mesCorresponde : $('#mesCorresponde').val()
	  }
	  $.ajax({
	    type: "POST",
	    url: "/conta6/Ubicaciones/Nomina/Honorarios/actions/generarNominaHon.php",
	    data: data,
	    success: 	function(r){
	      r = JSON.parse(r);
	      if (r.code == 1) {
	        $('#resGenNomHon').html(r.data);
					alertify.alert('Honorarios Semana: '+num_nomsig, 'Generado correctamente', function(){
						document.location.replace('/conta6/Ubicaciones/Nomina/Honorarios/GenerarNominaCFDI.php');
					});
	      }
	    }
	  })
	});

 // funciona para sueldos y honorarios
	$('#buscaranio').change(function(){
		var data = {
			anio : $('#buscaranio').val(),
			regimen : $('#nom_regimen').val()
	  }
	  $.ajax({
	    type: "POST",
	    url: "/conta6/Resources/PHP/actions/consulta_nomina_semana.php",
	    data: data,
	    success: 	function(r){
	      r = JSON.parse(r);
	      if (r.code == 1) {
	        $('#resConNomSem').html(r.data);
	      }
	    }
	  })
	});


	$(function(){
		  var ajaxCall = $.ajax({
		      method: 'POST',
		      url: '/Conta6/Ubicaciones/Nomina/Honorarios/actions/catalogo_percepcionesCompNomina.php'
		  });

		  ajaxCall.done(function(r) {
		    r = JSON.parse(r);
		    if (r.code == 1) {
					$('#percepcionesComplementoNomina').html(r.data);
		      $('#deduccionesComplementoNomina').html(r.datadeducciones);
		    } else {
		      console.error(r.message);
		    }
		  });
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
		url: "/conta6/Ubicaciones/Nomina/Honorarios/actions/consulta_nomina_generales.php",
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
	var data = {
		anio : anio,
		nomina : nomina,
		regimen : $('#nom_regimen').val()
	}
	$.ajax({
		type: "POST",
		url: "/conta6/Ubicaciones/Nomina/Honorarios/actions/consulta_nomina_documentos.php",
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
					url: "/conta6/Ubicaciones/Nomina/actions/borrar_docNomina.php",
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
	document.location.replace('/conta6/Ubicaciones/Nomina/ModificarCFDI.php?idDocNomina='+idDocNomina);
}

function imprimirNomina(anio,semana,tipo,regimen){
	if( regimen == '09' ){
		window.open('/conta6/Ubicaciones/Nomina/Honorarios/actions/impresionNominaCompleto.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
	}
}
/*
function imprimirNominaOrdinaria(anio,semana,tipo){
	tipo = 'O';
	window.open('/conta6/Ubicaciones/Nomina/Honorarios/actions/impresionNominaOrdinaria.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
}

function imprimirNominaExtra(anio,semana,tipo){
	tipo = 'E';
	window.open('/conta6/Ubicaciones/Nomina/Honorarios/actions/impresionNominaOrdinaria.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
}
*/
function impresionCFDICompleto(){
	anio = $('#buscaranio').val();
	semana = $('#buscarsem').val();
	tipo = 'Todas';
	window.open('/conta6/Ubicaciones/Nomina/Honorarios/actions/impresionCFDICompleto.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
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
function concepPercepcionesOP(){
	cadena = $('#percepcionConceptosOP').val();
	parteCadena = cadena.split("+");
	cveSAT = parteCadena[0];
	$('#claveSATpercepcionOP').val(parteCadena[0]).attr('value',cveSAT);
	$('#claveInternaPercepcionOP').val(parteCadena[1]).attr('value',parteCadena[1]);
	$('#desPercepcionOP').val(parteCadena[2]).attr('value',parteCadena[2]);
	$('#ordenReportePercepcionOP').val(parteCadena[3]);


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
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEP_cta"+element+"' class='T_PERCEP_CTA cta efecto border-0' readonly>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-4 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEP_desc"+element+"' class='T_PERCEP_DESC desc efecto'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEP_gravado"+element+"' class='T_PERCEP_GRAVADO gravado efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEP_exento"+element+"' class='T_PERCEP_EXENTO exento efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td>";
			newtr = newtr + "    		<a><img class='icomediano remove-PERCEP' src='/conta6/Resources/iconos/002-trash.svg'></a>";
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

			newtr = "<tr class='row mt-4 m-0 trPERCEP elemento-percepHrExtra' id='"+element+"'>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPHrExtra_cve"+element+"' class='T_PERCEPHrExtra_CVE cve efecto border-0' readonly>";
			newtr = newtr + "    		<input type='hidden' id='T_PERCEPHrExtra_ordenRep"+element+"' class='T_PERCEPHrExtra_ORDENREP ordenRep' >";
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
			newtr = newtr + "    		<input type='text' id='T_PERCEPHrExtra_gravado"+element+"' class='T_PERCEPHrExtra_GRAVADO gravado efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPHrExtra_exento"+element+"' class='T_PERCEPHrExtra_EXENTO exento efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td>";
			newtr = newtr + "    		<a><img class='icomediano remove-PERCEPHrExtra' src='/conta6/Resources/iconos/002-trash.svg'></a>";
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
    			$('#importeGravadopercepcionHrExtra').val("");
    			$('#importeExentopercepcionHrExtra').val("");
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
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_cta"+element+"' class='T_PERCEPOP_CTA cta efecto border-0' readonly>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-4 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_desc"+element+"' class='T_PERCEPOP_DESC desc efecto'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_exento"+element+"' class='T_PERCEPOP_EXENTO exento efecto' onblur='validaIntDec(this)'; onchange='sumaGeneralNomina()'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-1 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_anio"+element+"' class='T_PERCEPOP_ANIO anio efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_PERCEPOP_saldoFavor"+element+"' class='T_PERCEPOP_SALDOFAVOR saldofavor efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td>";
			newtr = newtr + "    		<a><img class='icomediano remove-PERCEPOP' src='/conta6/Resources/iconos/002-trash.svg'></a>";
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
					$('.T_PERCEPOP_ANIO').eq(x).val(anio);
					$('.T_PERCEPOP_SALDOFAVOR').eq(x).val(saldo);

    		  $('#percepcionConceptosOP').val(0);
    			$('#claveSATpercepcionOP').val("");
          $('#ordenReportePercepcionOP').val("");
          $('#claveInternaPercepcionOP').val("");
    			$('#desPercepcionOP').val("");
    			$('#importeExentoPercepcionOP').val("");
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
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUC_cta"+element+"' class='T_DEDUC_CTA cta efecto border-0' readonly>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-4 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUC_desc"+element+"' class='T_DEDUC_DESC desc efecto'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUC_gravado"+element+"' class='T_DEDUC_GRAVADO gravado efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td class='col-md-2 input-effect'>";
			newtr = newtr + "    		<input type='text' id='T_DEDUC_exento"+element+"' class='T_DEDUC_EXENTO exento efecto' onblur='validaIntDec(this);'>";
			newtr = newtr + "    	</td>";
			newtr = newtr + "    	<td>";
			newtr = newtr + "    		<a><img class='icomediano remove-DEDUC' src='/conta6/Resources/iconos/002-trash.svg'></a>";
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

function sumaGeneralNomina(){
	//*********************************** SUMA PERCEPCIONES $sum_percepcion = $sum_percep + $sum_horasExtras;
	totalVales = 0;
	$( ".T_PERCEP_GRAVADO" ).each(function( x ) {
		cve = $('.T_PERCEP_CVE').eq(x).val();
		gravado = $('.T_PERCEP_GRAVADO').eq(x).val();
		exento = $('.T_PERCEP_EXENTO').eq(x).val();

		if( gravado == "" ){ gravado = 0; }
		if( exento == "" ){ exento = 0; }

		if( cve == '029' ){ // 029 VALES DE DESPENSA
			totalVales = cortarDecimales(CalcADD(gravado,exento),2);
		}

		totalPercep = cortarDecimales(CalcADD(gravado,exento),2);
	});

	$( ".T_PERCEPHrExtra_GRAVADO" ).each(function( x ) {
		gravado = $('.T_PERCEPHrExtra_GRAVADO').eq(x).val();
		exento = $('.T_PERCEPHrExtra_EXENTO').eq(x).val();

		if( gravado == "" ){ gravado = 0; }
		if( exento == "" ){ exento = 0; }


		totalPercepHrExtra = cortarDecimales(CalcADD(gravado,exento),2);

	});

	totalPercepciones = cortarDecimales(CalcADD(totalPercep,totalPercepHrExtra),2);
	$('#totpercep').val(totalPercepciones).attr('value',totalPercepciones);



	//*********************************** SUMA DEDUCCIONES
	suma_DEDUC_GRAVADO = 0;
	suma_DEDUC_EXENTO = 0;

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

	totalDeduc = cortarDecimales(CalcADD(suma_DEDUC_GRAVADO, suma_DEDUC_EXENTO),2);
	$('#totdeduc').val(totalDeduc).attr('value',totalDeduc);

	//*********************************** TOTAL #TOTAL = PERCEPCIONES - DEDUCCIONES
	total = cortarDecimales(CalcSUB(totalPercep, totalDeduc),2);
	$('#tottotal').val(total).attr('value',total);


	//*********************************** OTROS PAGOS
	otrosPagos = 0;
	$( ".T_PERCEPOP_EXENTO" ).each(function( x ) {
			exento = $(this).val();
			if( exento == "" ){ exento = 0; }
			otrosPagos = cortarDecimales(CalcADD(otrosPagos,exento),2);
	});
	$('#tototrospagos').val(otrosPagos).attr('value',otrosPagos);


	//*********************************** NETO $neto = $resta_percepcionDeduccion - $sum_valesDespensa;
	neto = cortarDecimales(CalcSUB(total,totalVales),2);
	neto = cortarDecimales(CalcADD(neto,otrospagos),2);
	$('#totneto').val(neto).attr('value',neto);

}

function concepIncapacidad(){
	$('#tipo').val( $('#incapacidadConceptos').val() );
}

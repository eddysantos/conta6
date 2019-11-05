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
		var data = {
			anio_nomsig : $('#anio_nomsig').val(),
			num_nomsig : num_nomsig,
			fi_nomsig : $('#fi_nomsig').val(),
			ff_nomsig : $('#ff_nomsig').val(),
			fp_nomsig : $('#fp_nomsig').val()
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





});

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

function imprimirNomina(anio,semana,tipo){
	window.open('/conta6/Ubicaciones/Nomina/actions/impresionNomina_completo.php?anio='+anio+'&semana='+semana+'&tipo='+tipo+'&id_empleado=Todas');
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

      $(".remove-PERCEP").click(function(e){
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
		$('#totpercep').val(totalPercep).attr('value',totalPercep);

	});




	//*********************************** SUMA DEDUCCIONES
	Suma_DEDUC_GRAVADO = 0;
	Suma_DEDUC_EXENTO = 0;

	$( ".T_DEDUC_GRAVADO" ).each(function( x ) {
			gravado = $(this).val();
			if( gravado == "" ){ gravado = 0; }
			Suma_DEDUC_GRAVADO = cortarDecimales(CalcADD(Suma_DEDUC_GRAVADO,gravado),2);
	});

	$( ".T_DEDUC_EXENTO" ).each(function( x ) {
			exento = $(this).val();
			if( exento == "" ){ exento = 0; }
			Suma_DEDUC_EXENTO = cortarDecimales(CalcADD(Suma_DEDUC_EXENTO,exento),2);
	});

	totalDeduc = cortarDecimales(CalcADD(Suma_DEDUC_GRAVADO, Suma_DEDUC_EXENTO),2);
	$('#totdeduc').val(totalDeduc).attr('value',totalDeduc);

	//*********************************** TOTAL #TOTAL = PERCEPCIONES - DEDUCCIONES
	total = totalPercep - totalDeduc;
	$('#tottotal').val(total).attr('value',total);

	//*********************************** NETO $neto = $resta_percepcionDeduccion - $sum_valesDespensa;
	neto = total - totalVales;
	$('#totneto').val(neto).attr('value',neto);

}

function concepIncapacidad(){
	$('#tipo').val( $('#incapacidadConceptos').val() );
}

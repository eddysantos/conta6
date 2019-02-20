$(document).ready(function(){
  //IMPUESTOS
  IVA = $('#IVA').val();
  IVARETENIDO = $('#IVARETENIDO').val();
  IVA_MENOS_RETENCION = $('#IVA_MENOS_RETENCION').val();
  IVA_GRAL = $('#IVA_GRAL').val();

  // ******************** CUENTA DE GASTOS ********************
  $('#T_Cliente_RFC').change();
  $('#T_Nombre_Cliente').change();


/**********************************************************************************************/


  /*Input se hace mas grande al enfocar*/
  $('#bRef').focus(function(){
    $('#referencia').css('height', '100px');
    $('#labelRef').css('font-size', '24pt');
    $(this).css('height', '140px');
  });


/*Oculta todos los divs y hace visible solo el submenu*/
  $('.fele').click(function(){
    var accion = $(this).attr('accion');
    switch (accion) {

// verificado que funciona
    case "generarctagastos":
    $('#g-ctagastos').fadeIn();
    $('#SeleccionarAccion').slideUp();
      break;
    case "buscarctagastos":
    $('#b-ctagastos').fadeIn();
    $('#SeleccionarAccion').slideUp();
      break;

    case "cuadroBusqueda":
    $('#b-ctagastos').fadeOut();
    $('#SeleccionarAccion').slideDown();
      break;
    case "cuadroGenerar":
    $('#g-ctagastos').fadeOut();
    $('#SeleccionarAccion').slideDown();
      break;




// pendiente por verificar

      case "cuadroConsultar":
      $('#m-ctagastos').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      case "BuscarOtro":
      $('#m-factura').fadeOut();
      $('#b-ctagastos').slideDown();
        break;
        case "cuadroObservaciones":
        $('#b-ctagastos').slideDown();
        $('#m-ctagastos').fadeOut();

          break;
      default:
        console.error("Something went terribly wrong...");
    }
  });

  /*Oculta todos los divs y hace visible solo el submenu*/
    $('.ver').click(function(){
      var accion = $(this).attr('accion');
      switch (accion) {
        case "cuadroConsultar":
        $('#buscarfactura').fadeOut();
        $('#ConsulFactura').fadeIn();
          break;

        case "cuadroCancelar":
        $('#buscarfactura').fadeOut();
        $('#CancelFactura').fadeIn();
          break;

        case "cuadroCancelar2":
        $('#buscarfactura').fadeOut();
        $('#CancelFactura').fadeIn();
          break;


        default:
          console.error("Something went terribly wrong...");
      }
    });

  $('#mostrarConsulta').submit(function(){
    $('#m-ctagastos').fadeIn();
    $('#b-ctagastos').slideUp();

    var data = {
      id_captura: $('#bRef').val(),
      accion: 'consulMod'
    }
    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/1-CuentaGastos_lstCapturadas.php",
      data: data,
      success: 	function(r){
        console.log(r);
      r = JSON.parse(r);
        if (r.code == 1) {
          console.log(r);
          $('#lst_cuentasGastos_capturadas').html(r.data);
        } else {
          swal("Error", "La cuenta o Referencia no existen", "error");
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });


  });

  $('#mostrarConsulta').submit(function(){
    $('#m-factura').fadeIn();
    $('#b-ctagastos').slideUp();

    var data = {
      id_captura: $('#bRef').val(),
      accion: 'timbrar'
    }
    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/1-CuentaGastos_lstCapturadas.php",
      data: data,
      success: 	function(r){
        console.log(r);
      r = JSON.parse(r);
        if (r.code == 1) {
          console.log(r);
          $('#lst_cuentasGastos_capturadas_timbrar').html(r.data);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });

  });

  $('.visualizar').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    switch (accion) {
      case "Ver-cliente":
      if (status == 'cerrado') {
        $('#detalleCliente').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#detalleCliente').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
      case "Ver-iEmbarque":
      if (status == 'cerrado') {
        $('#detalleEmbarque').fadeIn();
        $(this).attr('status','abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      }else {
        $('#detalleEmbarque').fadeOut();
        $(this).attr('status','cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
      break;

      case "datinfo":
      if (status == 'cerrado') {
        $('#contornoInfo').fadeIn();
        $(this).attr('status','abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      }else {
        $('#contornoInfo').fadeOut();
        $(this).attr('status','cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
      break;
        case "Ver-iUsuario":
        if (status == 'cerrado') {
          $('#detalleUsuario').fadeIn();
          $(this).attr('status','abierto');
          $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
          $(this).css('font-size', '20px');
        }else {
          $('#detalleUsuario').fadeOut();
          $(this).attr('status','cerrado');
          $(this).css('color', "");
          $(this).css('font-size', "");
        }
          break;
      default:
        console.error("Something went terribly wrong...");
    }

  });


  $('#btn_buscarDatosEmbarque').click(function(){
    var data = {
  		id_referencia: $('#ctagatos-cReferencia').attr('db-id')
  	}

  	$.ajax({
  		type: "POST",
  		url: "/conta6/Ubicaciones/Contabilidad/facturaelectronica/1-CuentaGastos_datosReferencia.php",
  		data: data,
  		success: 	function(r){
  		r = JSON.parse(r);
        if (r.code == 1) {
          console.log(r);
          $('#datosEmbarque').html(r.data);
          $('#T_Dias').focus();
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
  	});

  });

});

// ******************** DATOS DEL EMBARQUE ************************************************************
function asignar_facturarA(){
  idcliente = $('#DGE_Lst_Datos').val();
  nombre = $('#DGE_Lst_Datos option:selected').text();
  $('#id_cliente').val(idcliente);
  $('#nombreCliente').html(nombre);
  buscaCuentascontables('ref',idcliente);
}

function cargarClienteSinReferencia(){
		$('#ctagatos-cReferencia').val("").attr('db-id',"");
    idcliente = $('#ctagatos-sReferencia').attr('db-id');
		buscaCuentascontables('sinref',idcliente);
}
function cargarOtroCliente(){
  idcliente = $('#DGEcliente').attr('db-id');
  nombre = $('#DGEcliente').val();
  $('#id_cliente').val(idcliente);
  $('#nombreCliente').html(nombre);
  $('#DGE_Lst_Datos').val(0);
  buscaCuentascontables('ref',idcliente);
}

function buscaCuentascontables(opcion,id_cliente){
    var data = {
      id_cliente: id_cliente
    }

    $.ajax({
      type: "POST",
      url: "/conta6/Resources/PHP/actions/busca_Referencia_CuentasContables.php",
      data: data,
      success: 	function(request){
        r = JSON.parse(request);
        console.log(r);
        if(opcion == 'ref'){
          $('#nombreCliente').html(r.data);
          if (r.code == 1) { $('#Btn_conReferencia').show(); }
          if (r.code == 2) { $('#Btn_conReferencia').hide(); }
        }
        if(opcion == 'sinref'){
          $('#nombreCliente_sinReferencia').html("");
          $('#nombreCliente_sinReferencia').html(r.data);

          if (r.code == 1) {
            $('#Btn_Busca_Ref_Cta_Gtos_2').show();
            $('#Btn_Busca_Ref_Cta_Gtos_3').show();
          }

          if (r.code == 2) {
            $('#Btn_Busca_Ref_Cta_Gtos_2').hide();
            $('#Btn_Busca_Ref_Cta_Gtos_3').hide();
          }

        }

      }
    });
}

function cargarCtaAme(){
  $('#docto').val('ctaAme');
  folioNo = $('#DGEctaAme').val();
  $('#folio').val(folioNo);
  $('select#DGEproforma').val(0);
}

function cargarSolicitudAnticipo(){
  $('#docto').val('Proforma');
  folioNo = $('#DGEproforma').val();
  $('#folio').val(folioNo);
  $('select#DGEctaAme').val(0);
}

function validaDatosReferencia(){
  id_cliente = $('#DGE_idcliente').val();
  dias = $('#T_Dias').val();
  extraerfolio = $('#folio').val();
  opcionDoc = $('#opcionDoc').val();
  docto = $('#docto').val();
  cobrarFlete = $('#cobrarFlete').val();

  if ( id_cliente == ""){
    alertify.error("seleccione Cliente o Corresponsal");
    return false;
  }

  if( dias == ""){
    alertify.error("asigne un numero de dias");
    $('#T_Dias').focus();
    return false;
  }

  referencia = $('#DGE_referencia').val();
  consolidado = $('#DGE_consolidado').val();
  entradas = $('#DGE_entradas').val();
  shipper = $('#DGE_shipper').val();
  inbond = $('#DGE_inbond').val();
  flete = $('#DGE_flete').val();

  window.location.replace('1-CuentaGastos_elaborar.php?referencia='+referencia+'&consolidado='+consolidado+'&entradas='+entradas+'&shipper='+shipper+'&inbond='+inbond+'&flete='+flete+'&id_cliente='+id_cliente+'&docto='+docto+'&opcionDoc='+opcionDoc+'&extraerfolio='+extraerfolio+'&cobrarFlete='+cobrarFlete+'&dias='+dias+'&tasa=IVA');
}

function cargarCuentaSinReferencia(tasa){
    referencia = "SN";
    consolidado = "FTL";
    entradas = 0;
    shipper = 0;
    inbond = 0;
    flete = 0;
    id_cliente = $('#ctagatos-sReferencia').attr('db-id');
    dias = 1;
    extraerfolio = 0;
    docto = "cliente";
    opcionDoc = 'ctagastos';
    cobrarFlete = "no";

    if ( id_cliente == ""){
      alertify.console.error("seleccione Cliente o Corresponsal");
      return false;
    }
    window.location.replace('1-CuentaGastos_elaborar.php?referencia='+referencia+'&consolidado='+consolidado+'&entradas='+entradas+'&shipper='+shipper+'&inbond='+inbond+'&flete='+flete+'&id_cliente='+id_cliente+'&docto='+docto+'&opcionDoc='+opcionDoc+'&extraerfolio='+extraerfolio+'&cobrarFlete='+cobrarFlete+'&dias='+dias+'&tasa='+tasa);
}





// ******************** CUENTA DE GASTOS ************************************************************
/* SOMBREAR LOS RENGLONES EN EL DETALLE */
function cambiar_color_over(fila){
	fila.style.backgroundColor="#FCD6D7"
}

function cambiar_color_out(fila){
	fila.style.backgroundColor="#FFFFFF"
}

//INFORMACION DEL EMBARQUE
$('#T_IGED_1').prop('readonly',true);
$('#T_IGED_2,#T_IGED_3,#T_IGED_4,#T_IGED_5,#T_IGED_6,#T_IGED_7,#T_IGED_8,#T_IGED_9,#T_IGED_10,#T_IGED_11,#T_IGED_12,#T_IGET_1,#T_IGET_2,#T_IGET_3,#T_IGET_4,#T_IGET_5,#T_IGET_6,#T_IGET_7,#T_IGET_8,#T_IGET_9,#T_IGET_10,#T_IGET_11,#T_IGET_12,#T_IGET_13')
  .change(function(){ eliminaBlancosIntermedios(this); });
$('#T_IGED_13').change(function(){ validaIntDec(this); });

//PAGOS O COBROS EN MONEDA EXTRANJERA
function tarifaCliente(){
		cadena = $('#Lst_tarifa_cliente').val();
		parteCadena = cadena.split("+");
		$('#T_POCME_idConcep').val(parteCadena[0]);
		$('#T_POCME_Eng').val(parteCadena[1]);
		$('#T_no_calculo').val(parteCadena[2]);
		$('#T_POCME_Valor').val(parteCadena[3]);
		$('#T_POCME').val(parteCadena[4]);
    $('#T_POCME_Cta').val(parteCadena[5]);
	$('#Lst_tarifa_general').val(0);
}

function tarifaGeneral(){
	cadena = $('#Lst_tarifa_general').val();
	parteCadena = cadena.split("+");
  $('#T_POCME_idConcep').val(parteCadena[0]);
  $('#T_POCME_Eng').val(parteCadena[1]);
  $('#T_no_calculo').val(parteCadena[2]);
  $('#T_POCME_Valor').val(parteCadena[3]);
  $('#T_POCME').val(parteCadena[4]);
  $('#T_POCME_Cta').val(parteCadena[5]);
  $('#Lst_tarifa_cliente').val(0);
}

// funciones TAB
$('#Lst_tarifa_general').change(function(){
  $('#T_POCME_Valor').focus();
})

$('#T_POCME_Valor').keydown(function(e){
 if (e.keyCode == 9) {
   agregarImporte();
   agregarImporte_CtaAme();
 }
})


$('#Lst_CA').change(function(){
  $('#T_Valor_Concepto_Gral').focus();
})

$('#T_Valor_Concepto_Gral').keydown(function(e){
 if (e.keyCode == 9) {
   agregarCargo();
 }
})

$('#Lst_CHL').change(function(){
  $('#T_Valor_Concepto_Honorarios').focus();
})

$('#T_Valor_Concepto_Honorarios').keydown(function(e){
 if (e.keyCode == 9) {
   agregarHonorarios();
 }
})

$(document).keydown(function(e){
  if (e.keyCode == 9) {
    Suma_Valor_Honorarios();
  }
})
// ---Aqui acaba funciones TAB



function agregarImporte(){
  tipoDocumento = $('#tipoDocumento').val();
	unidades = $('#T_no_calculo').val();
	cta =  $('#T_POCME_Cta').val();
  idConcepto = $('#T_POCME_idConcep').val();
	concepto = $('#T_POCME').val();
	concepto_eng = $('#T_POCME_Eng').val();
	importe = $('#T_POCME_Valor').val();
	total =  cortarDecimales(CalcMUL(unidades,importe),2);

  if( cta == "" ){
    alertify.success('Seleccione un concepto');
  }else {
      if(tipoDocumento == 'elaborar'){
        btnEliminar = "<a href='#' class='remove-POCME'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
        inputPartida = "";
      }
      if(tipoDocumento == 'modificar'){
        btnEliminar = "<a href='#' class='eliminar-POCME'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
        inputPartida = "<input class='id-partida' type='hidden' id='T_partida_' value='0'>";
      }

      var element = $('.T_POCME_CONCEPTOS').length;

      newtr = "<tr class='row m-0 trPOCME elemento-pocme' id='"+element+"'>";
      newtr = newtr + "    <td class='col-md-1 p-2'>";
      newtr = newtr + inputPartida;
      newtr = newtr + "        <input type='text' id='T_POCME_Cantidad"+element+"' class='T_POCME_CANTIDAD cantidad efecto h22' onblur='validaSoloNumeros(this);importe_POCME();' size='4'/>";
      newtr = newtr + "      </td>";
      newtr = newtr + "      <td class='col-md-3 p-2 datos-transferibles'>";
      newtr = newtr + "        <input type='hidden' id='T_POCME_idTipoCta"+element+"' class='T_POCME_CUENTAS id-cuenta'>";
      newtr = newtr + "        <input type='hidden' id='T_POCME_idConcep"+element+"' class='T_POCME_idCONCEPTOS id-concepto'>";
      newtr = newtr + "        <input type='text' id='T_POCME_Concepto"+element+"' class='T_POCME_CONCEPTOS efecto h22 concepto-espanol' size='45' readonly/>";
      newtr = newtr + "        <input type='hidden' id='T_POCME_ConceptoEng"+element+"' class='T_POCME_CONCEPTOS_ENG concepto-ingles'>";
      newtr = newtr + "      </td>";
      newtr = newtr + "      <td class='col-md-3 p-2'>";
      newtr = newtr + "        <input type='text' id='T_POCME_Descripcion"+element+"' class='T_POCME_DESCRIPCION descripcion efecto h22' size='45' maxlength='40'>";
      newtr = newtr + "      </td>";
      newtr = newtr + "      <td class='col-md-1 p-2 text-left'>";
      newtr = newtr + btnEliminar;
      newtr = newtr + "      </td>";

      newtr = newtr + "      <td class='col-md-2 p-2'>";
      newtr = newtr + "        <input type='text' id='T_POCME_Importe"+element+"' class='T_POCME_IMPORTES importe efecto h22' onblur='validaIntDec(this);validaDescImporte(1,"+element+");importe_POCME();cortarDecimalesObj(this,2);' size='17' >";
      newtr = newtr + "      </td>";
      newtr = newtr + "      <td class='col-md-2 p-2'>";
      newtr = newtr + "        <input type='text' id='T_POCME_Subtotal"+element+"' class='T_POCME_SUBTOTALES subtotal efecto h22' size='17' readonly>";
      newtr = newtr + "      </td>";
      newtr = newtr + "    </tr>";

      $('#tbodyPOCME').append(newtr);

      $(".remove-POCME").click(function(e){
        $(this).closest("tr").remove();
        alertify.success('Se elimino correctamente');
        sumaGeneral();
      });

      var element = $('.T_POCME_CONCEPTOS').length;
      $( ".T_POCME_CONCEPTOS" ).each(function( x ) {
    	  if( $('.T_POCME_CONCEPTOS').eq(x).val() == "" ){

          $('.T_POCME_CUENTAS').eq(x).val(cta);
          $('.T_POCME_idCONCEPTOS').eq(x).val(idConcepto);
          $('.T_POCME_CONCEPTOS').eq(x).val(concepto);
          $('.T_POCME_CONCEPTOS_ENG').eq(x).val(concepto_eng);

      		if( $('.T_POCME_CONCEPTOS').eq(x).val() == "Otros"){
      		  $('.T_POCME_CONCEPTOS').eq(x).prop('readonly',false);
      		  $('.T_POCME_CONCEPTOS').eq(x).css('background-color','#FFFFFF');
      		}

      		if(importe == 0 || importe == ""){
      		  $('.T_POCME_CANTIDAD').eq(x).val(0);
      		  $('.T_POCME_IMPORTES').eq(x).val(0);
      		  $('.T_POCME_SUBTOTALES').eq(x).val(0);
      		  alertify.error("Ingrese un Importe");
      			$('.T_POCME_IMPORTES').eq(x).focus();
      		}else{
      		  $('.T_POCME_CANTIDAD').eq(x).val(unidades);
      		  $('.T_POCME_IMPORTES').eq(x).val(importe);
      		  $('.T_POCME_SUBTOTALES').eq(x).val(total);
      		}

    		  $('#Lst_tarifa_cliente').val(0);
    			$('#Lst_tarifa_general').val(0);
    			$('#T_no_calculo').val("");
          $('#T_POCME_Cta').val("");
          $('#T_POCME_idConcep').val("");
    			$('#T_POCME').val("");
    			$('#T_POCME_Eng').val("");
    			$('#T_POCME_Valor').val("");
    			sumaGeneral();

    		  return false;
    	  }
      });

    }
}



function agregarImporte_CtaAme(){
  tipoDocumento = $('#tipoDocumento').val();
	unidades = $('#T_no_calculo').val();
	cta =  $('#T_POCME_Cta').val();
  idConcepto = $('#T_POCME_idConcep').val();
	concepto = $('#T_POCME').val();
	concepto_eng = $('#T_POCME_Eng').val();
	importe = $('#T_POCME_Valor').val();
	total =  cortarDecimales(CalcMUL(unidades,importe),2);

  if( cta == "" ){
    alertify.success('Seleccione un concepto');
  }else {
      if(tipoDocumento == 'elaborar'){
        btnEliminar = "<a href='#' class='remove-POCME'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
        inputPartida = "";
      }
      if(tipoDocumento == 'modificar'){
        btnEliminar = "<a href='#' class='eliminar-POCME'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
        inputPartida = "<input class='id-partida' type='hidden' id='T_partida_' value='0'>";
      }

      var element = $('.T_POCME_CONCEPTOS').length;

// en la linea 588 solo agregue la clase justify-content-center para centrar los inputs
      newtr = "<tr class='row m-0 trPOCME elemento-pocme justify-content-center' id='"+element+"'>";
      newtr = newtr + "    <td class='col-md-1 p-2'>";
      newtr = newtr + inputPartida;
      newtr = newtr + "        <input type='text' id='T_POCME_Cantidad"+element+"' class='T_POCME_CANTIDAD cantidad efecto h22' onblur='validaSoloNumeros(this);importe_POCME();' size='4'/>";
      newtr = newtr + "      </td>";
      newtr = newtr + "      <td class='col-md-3 p-2 datos-transferibles'>";
      newtr = newtr + "        <input type='hidden' id='T_POCME_idTipoCta"+element+"' class='T_POCME_CUENTAS id-cuenta'>";
      newtr = newtr + "        <input type='hidden' id='T_POCME_idConcep"+element+"' class='T_POCME_idCONCEPTOS id-concepto'>";
      newtr = newtr + "        <input type='text' id='T_POCME_Concepto"+element+"' class='T_POCME_CONCEPTOS efecto h22 concepto-espanol' size='45' readonly/>";
      newtr = newtr + "        <input type='hidden' id='T_POCME_ConceptoEng"+element+"' class='T_POCME_CONCEPTOS_ENG concepto-ingles'>";
      newtr = newtr + "      </td>";
      newtr = newtr + "      <td class='col-md-3 p-2'>";
      newtr = newtr + "        <input type='text' id='T_POCME_Descripcion"+element+"' class='T_POCME_DESCRIPCION descripcion efecto h22' size='45' maxlength='40'>";
      newtr = newtr + "      </td>";

  //AQUI COMIENZA LO QUE AGREGUE O MODIFIQUE  03 DIC 2018
      newtr = newtr + "      <td class=' p-2 text-left'>";
      newtr = newtr + btnEliminar;
      newtr = newtr + "      </td>";

      newtr = newtr + "      <td class='pt-2 mt-2'>";
      newtr = newtr + "        <input type='checkbox'>";
      newtr = newtr + "      </td>";

      newtr = newtr + "      <td class='col-md-1 p-2 text-left' id='spend_ctaAme'>";
      newtr = newtr + "        <input type='text' class='efecto h22'>";
      newtr = newtr + "      </td>";

      newtr = newtr + "      <td class='col-md-1 p-2 text-left' id='gain_ctaAme'>";
      newtr = newtr + "        <input type='text' class='efecto h22'>";
      newtr = newtr + "      </td>";


      newtr = newtr + "      <td class='col-md-1 p-2'>";
      newtr = newtr + "        <input type='text' id='T_POCME_Importe"+element+"' class='T_POCME_IMPORTES importe efecto h22' onblur='validaIntDec(this);validaDescImporte(1,"+element+");importe_POCME();cortarDecimalesObj(this,2);' size='17' >";
      newtr = newtr + "      </td>";
      newtr = newtr + "      <td class='col-md-1 p-2'>";
      newtr = newtr + "        <input type='text' id='T_POCME_Subtotal"+element+"' class='T_POCME_SUBTOTALES subtotal efecto h22' size='17' readonly>";
      newtr = newtr + "      </td>";
      newtr = newtr + "    </tr>";

      // AQUI ACABA --- 03 DIC 2018

      $('#tbodyPOCME').append(newtr);

      $(".remove-POCME").click(function(e){
        $(this).closest("tr").remove();
        alertify.success('Se elimino correctamente');
        sumaGeneral();
      });

      var element = $('.T_POCME_CONCEPTOS').length;
      $( ".T_POCME_CONCEPTOS" ).each(function( x ) {
    	  if( $('.T_POCME_CONCEPTOS').eq(x).val() == "" ){

          $('.T_POCME_CUENTAS').eq(x).val(cta);
          $('.T_POCME_idCONCEPTOS').eq(x).val(idConcepto);
          $('.T_POCME_CONCEPTOS').eq(x).val(concepto);
          $('.T_POCME_CONCEPTOS_ENG').eq(x).val(concepto_eng);

      		if( $('.T_POCME_CONCEPTOS').eq(x).val() == "Otros"){
      		  $('.T_POCME_CONCEPTOS').eq(x).prop('readonly',false);
      		  $('.T_POCME_CONCEPTOS').eq(x).css('background-color','#FFFFFF');
      		}

      		if(importe == 0 || importe == ""){
      		  $('.T_POCME_CANTIDAD').eq(x).val(0);
      		  $('.T_POCME_IMPORTES').eq(x).val(0);
      		  $('.T_POCME_SUBTOTALES').eq(x).val(0);
      		  alertify.error("Ingrese un Importe");
      			$('.T_POCME_IMPORTES').eq(x).focus();
      		}else{
      		  $('.T_POCME_CANTIDAD').eq(x).val(unidades);
      		  $('.T_POCME_IMPORTES').eq(x).val(importe);
      		  $('.T_POCME_SUBTOTALES').eq(x).val(total);
      		}

    		  $('#Lst_tarifa_cliente').val(0);
    			$('#Lst_tarifa_general').val(0);
    			$('#T_no_calculo').val("");
          $('#T_POCME_Cta').val("");
          $('#T_POCME_idConcep').val("");
    			$('#T_POCME').val("");
    			$('#T_POCME_Eng').val("");
    			$('#T_POCME_Valor').val("");
    			sumaGeneral();

    		  return false;
    	  }
      });

    }
}

$("#tbodyPOCME").on('click', '.eliminar-POCME',function(e){
  $(this).closest("tr").hide();
  $(this).parents('tr')
    .removeClass('elemento-pocme')
    .addClass('elemento-pocme-eliminar');
  var subtotal = $(this).parents('tr').find('.T_POCME_SUBTOTALES');
  subtotal.removeClass('T_POCME_SUBTOTALES');
  sumaGeneral();
});

$("#tbodyCargos").on('click', '.eliminar-Cargos',function(e){
  $(this).closest("tr").hide();
  $(this).parents('tr')
    .removeClass('elemento-Cargos')
    .addClass('elemento-cargos-eliminar');
  var subtotal = $(this).parents('tr').find('.T_Cargo_Subtotal');
  subtotal.removeClass('T_Cargo_Subtotal');
  sumaGeneral();
});

$("#tbodyHonorarios").on('click', '.eliminar-Honorarios',function(e){
  $(this).closest("tr").hide();
  $(this).parents('tr')
    .removeClass('elemento-Honorarios')
    .addClass('elemento-honorarios-eliminar');
  var importe = $(this).parents('tr').find('.T_Honorarios_Importe');
  importe.removeClass('T_Honorarios_Importe');
  var iva = $(this).parents('tr').find('.T_Honorarios_IVA');
  iva.removeClass('T_Honorarios_IVA');
  var ret = $(this).parents('tr').find('.T_Honorarios_RET');
  ret.removeClass('T_Honorarios_RET');
  sumaGeneral();
});


//CANTIDAD * IMPORTE = SUBTOTAL DE POCME
function importe_POCME(){
	POCME_Importes = 0;
	POCME_Cantidad = 0;
	POCME_Subtotal = 0;

  var elementosImporte = $('.T_POCME_IMPORTES').length;
  $( ".T_POCME_IMPORTES" ).each(function( x ) {
      importe = $(this).val();
      cantidad =  $('.T_POCME_CANTIDAD').eq(x).val();

      if( importe == "" ){ importe = 0; }
      if( cantidad == "" ){ cantidad = 0; }

      subtotal = cortarDecimales(CalcMUL(importe,cantidad),2);
      $('.T_POCME_SUBTOTALES').eq(x).val(subtotal).attr('value',subtotal);
  });
	sumaGeneral();
}

function sumaGeneral(){
  Suma_POCME();
  Conversion_Tipo_Cambio();
  Suma_Subtotales();
}

function Suma_POCME(){
  Suma_Totales = 0;

  //var elementosImporte = $('.T_POCME_SUBTOTALES').length;
  $( ".T_POCME_SUBTOTALES" ).each(function( x ) {
      importe = $(this).val();
      if( importe == "" ){ importe = 0; }
      Suma_Totales = cortarDecimales(CalcADD(Suma_Totales,importe),2);
  });

  $('#T_POCME_Total').val(Suma_Totales).attr('value',Suma_Totales);
	Conversion_Tipo_Cambio();
	Suma_Subtotales();
}

function Conversion_Tipo_Cambio(){
	POCME_Total = $('#T_POCME_Total').val();
  POCME_Tipo_Cambio = $('#T_POCME_Tipo_Cambio').val();
	Total_POCME_MN =  cortarDecimales(CalcMUL(POCME_Total,POCME_Tipo_Cambio),2);
	$('#T_POCME_Total_MN').val(Total_POCME_MN).attr('value',Total_POCME_MN);
	Suma_Subtotales();
}

function totalManiobras(){
  custodia = $('#T_Valor_Custodia_Aer').val();
  manejo = $('#T_Valor_Manejo_Aer').val();
  almacenaje = $('#T_Valor_Almacenaje_Aer').val();
  suma = cortarDecimales(CalcADD(custodia,manejo),2);
  suma = cortarDecimales(CalcADD(suma,almacenaje),2)
  $('#T_Valor_Total_Maniobras').val(suma);
}

function Pasa_Valor_Maniobras(){
		if($('#T_ID_Aduana_Oculto').val() == 470){
      $('#T_CA_idconcepto').val('7').attr('value','7');
      $('#T_CA_idcuenta').val('0110-00009').attr('value','0110-00009');
      $('#T_CA').val('MANIOBRAS. (CUSTODIA, MANEJO Y ALMACENAJE)').attr('value','MANIOBRAS. (CUSTODIA, MANEJO Y ALMACENAJE)');

      total = $('#T_Valor_Total_Maniobras').val();
			$('#T_Valor_Concepto_Gral').val(total).attr('value',total);
      $('#Btn_Cargo').click();
		}
}

function Suma_Subtotales(){
		var Suma_Importes = 0.00;
    var Suma_IVA = 0.00;
		var Suma_Totales_Cargos = 0.00;
		var Suma_Saldo = 0.00;
		var Iva_Retenido = 0.00;
		var Subtotal_Hon = 0.00;
		var Total_Hon = 0.00;
		var Total_Cta = 0.00;

    //SUMA DE IMPORTES DE HONORARIOS
    $('.T_Honorarios_Importe').each(function( x ) {
        importe = $(this).val();
        if( importe == "" ){ importe = 0; }
        Suma_Importes = cortarDecimales(CalcADD(Suma_Importes,importe),2);
        Suma_Importes = parseFloat(Suma_Importes).toFixed(2);

    });
    $('#T_Total_Importes').val(Suma_Importes).attr('value',Suma_Importes);

    //SUMA DE IVA DE HONORARIOS
    $('.T_Honorarios_IVA').each(function( x ) {
        importe = $(this).val();
        if( importe == "" ){ importe = 0; }
        Suma_IVA = cortarDecimales(CalcADD(Suma_IVA,importe),2);
        Suma_IVA = parseFloat(Suma_IVA).toFixed(2);
    });
    $('#T_Total_IVA').val(Suma_IVA);

    //SUMA IVA RETENIDO
    $('.T_Honorarios_RET').each(function( x ) {
        importe = $(this).val();
        if( importe == "" ){ importe = 0; }
        Iva_Retenido = cortarDecimales(CalcADD(Iva_Retenido,importe),2);
        Iva_Retenido = parseFloat(Iva_Retenido).toFixed(2);

    });
    $('#T_IVA_RETENIDO').val(Iva_Retenido).attr('value',Iva_Retenido);

    //SUBTOTAL DE HONORARIOS
		Subtotal_Hon = cortarDecimales(CalcADD(Suma_Importes,Suma_IVA),2);
    Subtotal_Hon = parseFloat(Subtotal_Hon).toFixed(2);
		$('#T_SUBTOTAL_HON').val(Subtotal_Hon).attr('value',Subtotal_Hon);

		//TOTAL
		Total_Hon = cortarDecimales(CalcSUB(Subtotal_Hon,Iva_Retenido),2);
    Total_Hon = parseFloat(Total_Hon).toFixed(2);
		$('#T_Total_Gral').val(Total_Hon).attr('value',Total_Hon);

		//TOTAL PAGOS O CARGOS EN MONEDA EXTRANJERA
    totalPOCME = $('#T_POCME_Total_MN').val();
    totalPOCME = parseFloat(totalPOCME).toFixed(2);
		$('#T_Total_MN_Extranjera').val(totalPOCME).attr('value',totalPOCME);

    //SUMA TOTALES PAGOS REALIZADOS POR SU CUENTA
    $('.T_Cargo_Subtotal').each(function( x ) {
        importe = $(this).val();
        if( importe == "" ){ importe = 0; }
        // console.log(parseFloat(importe));
        Suma_Totales_Cargos = cortarDecimales(CalcADD(Suma_Totales_Cargos,importe),2);
        Suma_Totales_Cargos = parseFloat(Suma_Totales_Cargos).toFixed(2);

    });

    $('#T_Total_Pagos').val(Suma_Totales_Cargos).attr('value',Suma_Totales_Cargos);

    //TOTAL CUENTA DE GASTOS
		Total_Cta = cortarDecimales(CalcADD(Total_Hon, $('#T_POCME_Total_MN').val() ),2);
		Total_Cta = cortarDecimales(CalcADD(Total_Cta,Suma_Totales_Cargos),2);
    Total_Cta = parseFloat(Total_Cta).toFixed(2);
		$('#T_Cta_Gastos').val(Total_Cta).attr('value', Total_Cta);


    //SUMA ANTICIPOS
    Suma_Anticipos = $('#T_Total_Anticipos').val();

    //SALDO DE LA CUENTA
		Suma_Saldo = cortarDecimales(CalcSUB(Total_Cta,Suma_Anticipos),2)
    Suma_Saldo = parseFloat(Suma_Saldo).toFixed(2);
		$('#T_SALDO_GRAL').val(Suma_Saldo).attr('value',Suma_Saldo);

    //TOTAL DE CUENTA DE GASTOS EN LETRA
    totalLetra();

}// fin Suma_Subtotales()


function totalLetra(){
  var data = {
    total: $('#T_Cta_Gastos').val()
  }

  $.ajax({
    type: "POST",
    url: "/conta6/Resources/PHP/actions/numtoletras_div.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);

      if (r.code == 1) {
        $('#total_CuentaGastos').val(r.data).attr('value',r.data);
      } else {
        console.error(r.message);
      }
    },
    error: function(x){
      console.error(x);
    }
  });
}


function limpiarCampos(seccion,posicion){


  //POCME
  if( seccion == '1'){
    $( ".T_POCME_SUBTOTALES" ).each(function( x ) {

      posicion = posicion - 1;
      if( posicion == x ){
        $('.T_POCME_CANTIDAD').eq(posicion).val('');
        $('.T_POCME_CUENTAS').eq(posicion).val('');
        $('.T_POCME_idCONCEPTOS').eq(posicion).val('');
        $('.T_POCME_CONCEPTOS').eq(posicion).val('');
        $('.T_POCME_CONCEPTOS_ENG').eq(posicion).val('');
        $('.T_POCME_DESCRIPCION').eq(posicion).val('');
        $('.T_POCME_IMPORTES').eq(posicion).val('');
        $('.T_POCME_SUBTOTALES').eq(posicion).val('');
        return false;
      }
      posicion = posicion + 1;
    });
  }

  //COBROS POR CUENTA DEL CLIENTE
  if( seccion == '2'){
    $( ".T_Cargo_Subtotal" ).each(function( x ) {
      posicion = posicion - 1;
      if( posicion == x ){
        if( posicion == 0 ){ txt = "Impuestos y/o derechos pagados o garantizados al Com. Ext."; }else{ txt = ""; }
        $('.T_Cargo').eq(posicion).val(txt);
        $('.T_Cargo_Subtotal').eq(posicion).val('');
        return false;
      }
      posicion = posicion + 1;
    });
  }

  //HONORARIOS
  if( seccion == '3'){
    $( ".T_Honorarios" ).each(function( x ) {
      if( posicion == x ){
        $('.T_Honorarios').eq(posicion).val('');
        $('.T_Honorarios_idcta').eq(posicion).val('');
        $('.T_Honorarios_idps').eq(posicion).val('');
        $('.T_Honorarios_Importe').eq(posicion).val('');
        $('.T_Honorarios_IVA').eq(posicion).val('');
        $('.T_Honorarios_RET').eq(posicion).val('');
        $('.T_Honorarios_Subtotal').eq(posicion).val('');
        return false;
      }
    });
  }

  //DEPOSITOS
  if( seccion == '4'){
    $( ".T_dep_numero" ).each(function( x ) {
      posicion = posicion - 1;
      if( posicion == x ){
        $('.T_dep_numero').eq(posicion).val('');
        $('.T_dep_importe').eq(posicion).val('');
        return false;
      }
      posicion = posicion + 1;
    });
  }

  sumaGeneral();
}


//PAGOS REALIZADOS POR SU CUENTA
function tarifaAlmacen(){
	cadena = $('#Lst_Conceptos').val();
	parteCadena = cadena.split("+");
	$('#T_CA').val(parteCadena[0]);
	$('#T_Valor_Concepto_Gral').val(parteCadena[1]);
  $('#T_CA_idconcepto').val(parteCadena[2]);
  $('#T_CA_idcuenta').val(parteCadena[3]);
	$('#Lst_CA').val(0);
}

function tarifaAlmacenLibre(){
  cadena = $('#Lst_CA').val();
  parteCadena = cadena.split("+");
  $('#T_CA').val(parteCadena[0]);
  $('#T_Valor_Concepto_Gral').val('0');
  $('#T_CA_idconcepto').val(parteCadena[1]);
  $('#T_CA_idcuenta').val(parteCadena[2]);
  $('#Lst_Conceptos').val(0);
}

function agregarCargo(){
  tipoDocumento = $('#tipoDocumento').val();
  id_concepto = $('#T_CA_idconcepto').val();
  id_cuenta = $('#T_CA_idcuenta').val();
  concepto = $('#T_CA').val();
	importe = $('#T_Valor_Concepto_Gral').val();
	oficina = $('#T_ID_Aduana_Oculto').val();
	id_cliente = $('#T_ID_Cliente_Oculto').val();

  if( id_cuenta == "" ){
    alertify.success('Seleccione un concepto');
  }else {
      if(tipoDocumento == 'elaborar'){
        btnEliminar = "<a href='#' class='remove-Cargos'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
        inputPartida = "";
      }
      if(tipoDocumento == 'modificar'){
        btnEliminar = "<a href='#' class='eliminar-Cargos'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
        inputPartida = "<input class='id-partida' type='hidden' id='T_partida_' value='0'>";
      }

      var element = $('.T_Cargo').length;

      newtr = "<tr class='row m-0 trCargos elemento-cargos' id='"+element+"'>";
      newtr = newtr + "                <td class='col-md-6 p-1'>";
      newtr = newtr + inputPartida;
      newtr = newtr + "                  <input class='T_Cargo_idconcepto id-concepto' type='hidden' id='T_Cargo_idconcepto_"+element+"'>";
      newtr = newtr + "                  <input class='T_Cargo_idcuenta id-cuenta' type='hidden' id='T_Cargo_idcuenta_"+element+"'>";
      newtr = newtr + "                  <input class='efecto h22 T_Cargo concepto-espanol' type='text' id='T_Cargo_"+element+"' size='60' onchange='javascript:eliminaBlancosIntermedios(this);' readonly>";
      newtr = newtr + "                </td>";
      newtr = newtr + "                <td class='col-md-4 p-1 text-left'>";
      newtr = newtr + btnEliminar;
      newtr = newtr + "                </td>";
      newtr = newtr + "                <td class='col-md-2 p-1'>";
      newtr = newtr + "                  <input class='efecto h22 T_Cargo_Subtotal subtotal' type='text' id='T_Cargo_3"+element+"' size='20' onblur='validaIntDec(this);validaDescImporte(2,"+element+");cortarDecimalesObj(this,2);Suma_Subtotales();' value='0'>";
      newtr = newtr + "                </td>";
      newtr = newtr + "              </tr>";

      $('#tbodyCargos').append(newtr);

      $(".remove-Cargos").click(function(e){
        $(this).closest("tr").remove();
        alertify.success('Se elimino correctamente');
        sumaGeneral();
      });

      $(".T_Cargo").each(function( x ) {

          if( $('.T_Cargo').eq(x).val() == "" ){

            $('.T_Cargo_idconcepto').eq(x).val(id_concepto);
            $('.T_Cargo_idcuenta').eq(x).val(id_cuenta);
            $('.T_Cargo').eq(x).val(concepto);

            if( $('.T_Cargo').eq(x).val() == "Otros Gastos Comprobados" || $('.T_Cargo').eq(x).val() == "Venta de activos fijos" ){
        		  $('.T_Cargo').eq(x).prop('readonly',false);
        		  $('.T_Cargo').eq(x).css('background-color','#FFFFFF');
        		}
            //else{
        		  //$('.T_Cargo').eq(x).prop('readOnly',false);
        		  //$('.T_Cargo').eq(x).css('background-color','#DCDCDC');
        		//}


            if(importe == 0 || importe == ""){
        		  $('.T_Cargo_Subtotal').eq(x).val(0);
        		  alertify.error("Ingrese un Importe");
        			$('.T_Cargo_Subtotal').eq(x).focus();
        		}else{
        		  $('.T_Cargo_Subtotal').eq(x).val(importe);

              if(concepto == "Flete Terrestre" || concepto == "Flete Terrestre Franja Fronteriza"){
                // CLT_06050 Industrias Alimenticias FABP S.A. 5-Julio-13 pide que en el concepto Flete terrestre se sumen otros conceptos.
      						if(concepto == "Flete Terrestre" && oficina == 430 && id_cliente == "CLT_06050"){
      							impuesto = cortarDecimales(CalcMUL(importe,IVA),2);
      						}else{
      							impuesto = cortarDecimales(CalcMUL(importe,IVA_GRAL),2);
      						}
              }else{
                impuesto = cortarDecimales(CalcMUL(importe,IVA),2);
              }

              if(concepto == "GANANCIA CAMBIARIA" || concepto == "Ganancia Cambiaria"){
      						signo = "-";
      						$('.T_Cargo_Subtotal').eq(x).prop('readOnly',false);
      						$('.T_Cargo_Subtotal').eq(x).css('background-color','#DCDCDC');
      					}else{ signo = ""; }

      					total = cortarDecimales(CalcADD(importe,impuesto),2);
      					$('.T_Cargo_Subtotal').eq(x).val(signo+total);
        		}
            $('#Lst_CA').eq(x).val(0);
      			$('#Lst_Conceptos').eq(x).val(0);
            $('#T_CA_idconcepto').val("");
            $('#T_CA_idcuenta').val("");
      			$('#T_CA').val("");
      			$('#T_Valor_Concepto_Gral').val("");
      			sumaGeneral();
      			return false;
          }
      });
  }
}

//HONORARIOS
function asignarTarifaHlibres(){
    cadena = $('#Lst_CHL').val();
  	parteCadena = cadena.split("+");
		$('#T_Hcta').val(parteCadena[0]);
		$('#T_Hps').val(parteCadena[1]);
		$('#T_CH').val(parteCadena[2]);
		$('#T_Valor_Concepto_Honorarios').val(0);
		$('#Lst_Conceptos_Honorarios').val(0);
}

function asignarTarifaH(){
		cadena = $('#Lst_Conceptos_Honorarios').val();
		parteCadena = cadena.split("+");
		Cuenta = parteCadena[0];
		claveProdServ = parteCadena[1];
		importe = parteCadena[2];
    concepto = parteCadena[3];
		$('#T_Hcta').val(Cuenta);
		$('#T_Hps').val(claveProdServ);
		$('#T_Valor_Concepto_Honorarios').val(importe);
		$('#T_CH').val(concepto);
		$('#Lst_CHL').val(0);
}

function agregarHonorarios(){
    tipoDocumento = $('#tipoDocumento').val();
		id_cuenta = $('#T_Hcta').val();
		id_prodServ = $('#T_Hps').val();
		concepto = $('#T_CH').val();
		importe = $('#T_Valor_Concepto_Honorarios').val();
    oficina = $('#T_ID_Aduana_Oculto').val();
  	id_cliente = $('#T_ID_Cliente_Oculto').val();

    if( id_prodServ == "" ){
      alertify.success('Seleccione un concepto');
    }else {
        if(tipoDocumento == 'elaborar'){
          btnEliminar = "<a href='#' class='remove-Honorarios'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
          inputPartida = "";
        }
        if(tipoDocumento == 'modificar'){
          btnEliminar = "<a href='#' class='eliminar-Honorarios'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
          inputPartida = "<input class='id-partida' type='hidden' id='T_partida_' value='0'>";
        }

        var element = $('.T_Honorarios').length;

        newtr = "<tr class='row m-0 trHonorarios elemento-honorarios' id='"+element+"'>";
        newtr = newtr + "<td class='col-md-4 p-1'>";
        newtr = newtr + inputPartida;
        newtr = newtr + "  <input class='efecto h22 T_Honorarios concepto-espanol' type='text' id='T_Honorarios_"+element+"' size='60' onchange='javascript:eliminaBlancosIntermedios(this);validarStringSAT(this);' readonly>";
        newtr = newtr + "</td>";
        newtr = newtr + "<td class='col-md-2 p-1 text-left'>";
        newtr = newtr + btnEliminar;
        newtr = newtr + "</td>";
        newtr = newtr + "<td class='col-md-1 p-1'>";
        newtr = newtr + "  <input class='efecto h22 T_Honorarios_idcta id-cuenta' type='text' id='T_Hcta_"+element+"' size='15' readonly>";
        newtr = newtr + "</td>";
        newtr = newtr + "<td class='col-md-1 p-1'>";
        newtr = newtr + "  <input class='efecto h22 T_Honorarios_idps id-cveProd' type='text' id='T_Hps_"+element+"' size='15' readonly>";
        newtr = newtr + "</td>";
        newtr = newtr + "<td class='col-md-1 p-1'>";
        newtr = newtr + "  <input class='efecto h22 T_Honorarios_Importe importe' type='text' id='T_Honorarios_Importe_"+element+"' onblur='validaIntDec(this);validaDescImporte(3,"+element+");cortarDecimalesObj(this,2);Iva_Importe_Hon("+element+")' size='18' value='0'>";
        newtr = newtr + "</td>";
        newtr = newtr + "<td class='col-md-1 p-1'>";
        newtr = newtr + "  <input class='efecto h22 T_Honorarios_IVA iva' type='text' id='T_Honorarios_IVA_"+element+"' size='20' value='0' readonly>";
        newtr = newtr + "</td>";
        newtr = newtr + "<td class='col-md-1 p-1'>";
        newtr = newtr + "  <input class='efecto h22 T_Honorarios_RET ret' type='text' id='T_Honorarios_RET_"+element+"' size='20' value='0' readonly>";
        newtr = newtr + "</td>";
        newtr = newtr + "<td class='col-md-1 p-1'>";
        newtr = newtr + "  <input class='efecto h22 T_Honorarios_Subtotal subtotal' type='text' id='T_Honorarios_Subtotal_"+element+"' size='20' value='0' readonly>";
        newtr = newtr + "</td>";
        newtr = newtr + "</tr>";

        $('#tbodyHonorarios').append(newtr);

        $(".remove-Honorarios").click(function(e){
          $(this).closest("tr").remove();
          alertify.success('Se elimino correctamente');
          sumaGeneral();
        });

        $(".T_Honorarios").each(function( x ) {
            if( $('.T_Honorarios').eq(x).val() == "" ){

              $('.T_Honorarios').eq(x).val(concepto);
              $('.T_Honorarios_idcta').eq(x).val(id_cuenta);
              $('.T_Honorarios_idps').eq(x).val(id_prodServ);

              if( $('.T_Honorarios').eq(x).val() == "Otros Gastos Comprobados"){
          		  $('.T_Honorarios').eq(x).prop('readonly',false);
          		  $('.T_Honorarios').eq(x).css('background-color','#FFFFFF');
          		}
              // else{
          		//   $('.T_Honorarios').eq(x).prop('readOnly',false);
          		//   $('.T_Honorarios').eq(x).css('background-color','#DCDCDC');
          		// }


              if(importe == 0 || importe == ""){
          		  $('.T_Honorarios_Importe').eq(x).val(0);
          		  alertify.error("Ingrese un Importe");
          			$('.T_Honorarios_Importe').eq(x).focus();
          		}else{
                ret = iva_retenido(concepto,importe);
      					impuesto = cortarDecimales(CalcMUL(importe,IVA),2);
      					total = cortarDecimales(parseFloat(importe) + parseFloat(impuesto),2);

      					$('.T_Honorarios_Importe').eq(x).val(importe);
      					$('.T_Honorarios_IVA').eq(x).val(impuesto);
      					$('.T_Honorarios_RET').eq(x).val(ret);
      					$('.T_Honorarios_Subtotal').eq(x).val(total);
              }
              $('#Lst_CHL').val(0);
      				$('#Lst_Conceptos_Honorarios').val(0);
      				$('#T_CH').val("");
      				$('#T_Hcta').val("");
      				$('#T_Hps').val("");
      				$('#T_Valor_Concepto_Honorarios').val("");
      				sumaGeneral();
      				return false;
            }
        });
    }
}

function iva_retenido(concepto,importe){
  ret = 0;
  concepto1 = 'Arrastre';
  concepto2 = 'Entrega de Mercancía';
  concepto3 = 'Entrega y Recolección {LOCAL}';
  concepto4 = 'Entrega y Recolección { FUERA DEL CDMX AREA METROPOLITANA }';
  concepto5 = 'Flete local';

  if (concepto==concepto1 || concepto==concepto2 || concepto==concepto3 || concepto==concepto4 || concepto==concepto5){
    ret = cortarDecimales(CalcMUL(importe,IVARETENIDO),2);
  }
  return ret;
}

function Suma_Valor_Honorarios(){
  total_POCME_MN = $('#T_POCME_Total_MN').val();
  total_mercancias = $('#T_IGED_13').val();
  subsidio = $('#T_Subsidio').val();
  total_cargos = $('#T_Total_Pagos').val();
  Suma_Totales = 0;

	Suma_Totales = cortarDecimales(CalcADD(total_POCME_MN,total_mercancias),2);
	Suma_Totales = cortarDecimales(CalcADD(Suma_Totales,subsidio),2);
	Suma_Totales = cortarDecimales(CalcADD(Suma_Totales,total_cargos),2);

	$('#T_Honorarios_Base_Honorarios').val(Suma_Totales);
	calculoHonorarios();
}

function calculoHonorarios(){
		Suma_Totales = $('#T_Honorarios_Base_Honorarios').val();
    porcentaje = $('#T_Honorarios_Porcentaje').val();
    descuento = $('#T_Honorarios_Descuento').val();
    min_hon = $('#T_Honorarios_Minimo_Honorarios').val();
		calculoPorcentaje = cortarDecimales(CalcMUL(porcentaje,Suma_Totales),2);
		calculoDescuento = cortarDecimales(CalcMUL(descuento,calculoPorcentaje),2);
		Total_Honorarios =  cortarDecimales(cortarDecimales(CalcSUB(calculoPorcentaje,calculoDescuento),2)/100,2) ;

	  if( parseFloat(Total_Honorarios) < parseFloat(min_hon) ){
		  $('#T_Honorarios_Importe_0').val(min_hon);
      hon = min_hon;
		}else{
		  $('#T_Honorarios_Importe_0').val(Total_Honorarios);
      hon = Total_Honorarios;
		}

    total_hon_iva = cortarDecimales(CalcMUL(hon,IVA),2)
		$('#T_Honorarios_IVA').val(total_hon_iva);
    total = cortarDecimales(CalcADD(total_hon_iva,hon),2)
		$('#T_Honorarios_Total').val(total);

    Iva_Importe_Hon(0);
}

function Iva_Importe_Hon(posicion){
  $( ".T_Honorarios_Importe" ).each(function( x ) {
    if( posicion == x ){
      concepto = $('.T_Honorarios').eq(posicion).val();
      importe = $('.T_Honorarios_Importe').eq(posicion).val();
      iva = cortarDecimales(CalcMUL(importe,IVA),2);
      total = cortarDecimales(CalcADD(importe,iva),2);

      ret = iva_retenido(concepto,importe);

      $('.T_Honorarios_IVA').eq(posicion).val(iva);
      $('.T_Honorarios_RET').eq(posicion).val(ret);
      $('.T_Honorarios_Subtotal').eq(posicion).val(total);

      sumaGeneral();
      return false;
    }
  });
}

function validaDescImporte(seccion,posicion){
  //POCME
  if( seccion == '1'){
    $( ".T_POCME_SUBTOTALES" ).each(function( x ) {
      posicion = posicion - 1;
      if( posicion == x ){
        concepto = $('.T_POCME_CONCEPTOS').eq(posicion).val();
        importe = $('.T_POCME_IMPORTES').eq(posicion).val();

        if( importe > 0 && concepto == "" ){
          $('.T_POCME_CONCEPTOS').eq(posicion).css('background-color','#FF0000');
          alertify.error("Ingrese un concepto");
        }

        return false;
      }
      posicion = posicion + 1;
    });
  }

  //COBROS POR CUENTA DEL CLIENTE
  if( seccion == '2'){
    $( ".T_Cargo_Subtotal" ).each(function( x ) {
      posicion = posicion - 1;
      if( posicion == x ){
        concepto = $('.T_Cargo').eq(posicion).val();
        importe = $('.T_Cargo_Subtotal').eq(posicion).val();

        if( importe > 0 && concepto == "" ){
          $('.T_Cargo').eq(posicion).css('background-color','#FF0000');
          alertify.error("Ingrese un concepto");
        }

        return false;
      }
      posicion = posicion + 1;
    });
  }

  //HONORARIOS
  if( seccion == '3'){
    $( ".T_Honorarios" ).each(function( x ) {
      if( posicion == x ){
        concepto = $('.T_Honorarios').eq(posicion).val();
        importe = $('.T_Honorarios_Importe').eq(posicion).val();
        cta = $('.T_Honorarios_idcta').eq(posicion).val();
        cveProd = $('.T_Honorarios_idps').eq(posicion).val();

        if( importe > 0 && concepto == "" ){
          $('.T_Honorarios').eq(posicion).css('background-color','#FF0000');
          alertify.error("Ingrese un concepto");
          if( cta == "" || cveProd == "" ){
            $('.T_Honorarios_idcta').eq(posicion).css('background-color','#FF0000');
            $('.T_Honorarios_idps').eq(posicion).css('background-color','#FF0000');
            swal("Error", "Concepto, Cuenta, claveProdServ son requeridos", "error");
          }
        }
        return false;
      }
    });
  }
}

//AGREGAR DEPOSITO
$('#depositos-disponibles, #tbodyDepAplic').on('click', '.agregar-deposito', function(){
  var tr = $(this).parents('tr');
  var destino = $(this).attr('destino');
  var valor = $(this).parents('.row').find('.T_Anticipo.importe').val();
  var totalAnticipos = $('#T_Total_Anticipos').val();

  if (destino == '#tbodyDepAplic') {
    $(this).attr('destino', '#depositos-disponibles');
    tr.addClass('elemento-depositos');
    tr.removeClass('elemento-depositos-disponibles');
    $(this).parents('.row').find('.dep_aplic').val(1);


    totalAnticipos = CalcADD(totalAnticipos,valor);
  } else {
    $(this).attr('destino', '#tbodyDepAplic');
    tr.removeClass('elemento-depositos');
    tr.addClass('elemento-depositos-disponibles');
    // $('#dep_aplic').val(sinAplic);

    $(this).parents('.row').find('.dep_aplic').val(0);
    totalAnticipos = CalcSUB(totalAnticipos,valor);
  }

  tr.appendTo(destino);
  $('#T_Total_Anticipos').val(totalAnticipos);
  sumaGeneral();
});
/*
function asignarMetodoPago(){
	metodoPago = $('#Lst_metodoPago').val();
	$('#T_metodoPago').attr('value',metodoPago).val(metodoPago);

	if( metodoPago == 'PPD' ){
    $('#T_FormaPago').val('99').attr('value','99');
    $('#T_CuentaPago').val('').attr('value','');
		$('#Lst_formaPago').prop( 'disabled',true );
	}else{
    $('#T_FormaPago').val('').attr('value','');
    $('#T_CuentaPago').val('').attr('value','');
		$('#Lst_formaPago').prop( 'disabled',false );
	}
}*/
function asignarMetodoPago(){
	metodoPago = $('#T_metodoPago').val();
	//$('#T_metodoPago').attr('value',metodoPago).val(metodoPago);

	if( metodoPago == 'PPD' ){
    $('#T_FormaPago').val('99').attr('value','99');
    $('#T_CuentaPago').val('').attr('value','');
		$('#Lst_formaPago').prop( 'disabled',true );
	}else{
    $('#T_FormaPago').val('').attr('value','');
    $('#T_CuentaPago').val('').attr('value','');
		$('#Lst_formaPago').prop( 'disabled',false );
	}
}

function asignarFormaPago(){
  metodoPago = $('#Lst_formaPago').val();
  $('#T_FormaPago').attr('value',metodoPago);
  $('#T_FormaPago').val(metodoPago);

  if(metodoPago == "02" || metodoPago == "03" ){
    $('#Lst_cuentaPago').prop( 'disabled',false );
    id_cliente = $('#T_ID_Cliente_Oculto').val();
    buscarNumeroCuentaBanco(id_cliente);
  }else{
    $('#Lst_cuentaPago').val(0);
    $('#Lst_cuentaPago').prop( 'disabled',true );
    $('#numerosCuenta').html('');
    $('#T_CuentaPago').attr('value',"");
    $('#T_CuentaPago').val("");
  }
}

function buscarNumeroCuentaBanco(id_cliente){
  var data = {
    id_cliente: id_cliente
  }

  $.ajax({
    type: "POST",
    url: "/conta6/Resources/PHP/actions/lst_bancos_clientes.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        //console.log(r.data);
        $('#Lst_cuentaPago').html(r.data);
      } else {
        console.error(r.message);
      }
    },
    error: function(x){
      console.error(x);
    }
  });
}

function asignarCtaBanco(){
  cadena = $('#Lst_cuentaPago').val();
  parteCadena = cadena.split("+");
  $('#T_CuentaPago').val(parteCadena[1]).attr('value',parteCadena[1]);
}

function asignarMoneda(){
		moneda = $('#lst_moneda').val();
		$('#T_Moneda').val(moneda);
    $('#T_Moneda').attr('value',moneda);

		if( moneda == 'MXN' ){
			$('#T_monedaTipoCambio').val('')
                              .attr('value','')
			                        .prop('readOnly',true)
			                        .css('background-color','#DCDCDC');
		}else{
			$('#T_monedaTipoCambio').prop('readOnly',false)
			                        .css('background-color','#FFFFFF');
		}
}
/*
function asignarUsoCFDI(){
	usoCFDI = $('#Lst_usoCFDI').val();
	$('#T_usoCFDI').val(usoCFDI).attr('value',usoCFDI);
}
*/
function valFormaPago(){
		if( $('#T_FormaPago').val() == "" && $('#T_FormaPago').val() == "" ){
      swal("Forma de pago", "Es requerido", "error");
			$('#Lst_formaPago').focus();
			return false;
		}else{
			//02 CHEQUE 03 TRANSFERENCIA
			if( ($('#T_FormaPago').val() == "02" || $('#T_FormaPago').val() == "03") && $('#T_CuentaPago').val() == "" ){
        swal("Error", "Requerido, Cuenta Bancaria, Seleccione una Cuenta", "error");
				$('#Lst_cuentaPago').focus();
				return false;
			}else{
				return true;
			}
		}
}

function valMoneda(){
		if( $('#T_Moneda').val() != "MXN" && $('#T_monedaTipoCambio').val() == "" ){
      swal("Tipo de cambio", "Ingrese un valor", "error");
			$('#T_monedaTipoCambio').focus();
			return false;
		}else{
			return true;
		}
}

function valUsoCFDI(){
		if( $('#T_usoCFDI').val() == "0" || $('#T_usoCFDI').val() == "" ){
      swal("Uso de CFDI", "Es requerido", "error");
			$('#T_usoCFDI').focus();
			return false;
		}else{
			return true;
		}
}

$('#modificar-cta').click(function(){
  folio = $('#id_cuenta_captura').val();

  Suma_Subtotales();
  if( valFormaPago()==true && valMoneda()==true && valUsoCFDI()==true ){

      $('#mensaje').html("Guardando . . .");

      var data = {
        folio: folio,
        T_No_calculoTarifa : $('#T_No_calculoTarifa').val(),
        Txt_Usuario : $('#Txt_Usuario').val(),
        T_IGED_1 : $('#T_IGED_1').val(),
        // T_IGED_2 : $('#T_IGED_2').val(),
        T_ID_Aduana_Oculto : $('#T_ID_Aduana_Oculto').val(),
        T_ID_Almacen_Oculto : $('#T_ID_Almacen_Oculto').val(),
        T_ID_Cliente_Oculto : $('#T_ID_Cliente_Oculto').val(),
        T_Nombre_Cliente : $('#T_Nombre_Cliente').val(),
        T_Cliente_Calle : $('#T_Cliente_Calle').val(),
        T_Cliente_No_Ext : $('#T_Cliente_No_Ext').val(),
        T_Cliente_No_Int : $('#T_Cliente_No_Int').val(),
        T_Cliente_Colonia : $('#T_Cliente_Colonia').val(),
        T_Cliente_CP : $('#T_Cliente_CP').val(),
        T_Cliente_Ciudad : $('#T_Cliente_Ciudad').val(),
        T_Cliente_Estado : $('#T_Cliente_Estado').val(),
        T_Cliente_Pais : $('#T_Cliente_Pais').val(),
        T_Cliente_taxid : $('#T_Cliente_taxid').val(),
        T_Cliente_RFC : $('#T_Cliente_RFC').val(),
        T_Proveedor_Destinatario : $('#T_Proveedor_Destinatario').val(),
        T_Tipo : $('#T_Tipo').val(),
        T_Valor : $('#T_Valor').val(),
        T_Peso : $('#T_Peso').val(),
        T_Dias : $('#T_Dias').val(),
        T_Valor_Custodia_Aer : $('#T_Valor_Custodia_Aer').val(),
        T_Valor_Manejo_Aer : $('#T_Valor_Manejo_Aer').val(),
        T_Valor_Almacenaje_Aer : $('#T_Valor_Almacenaje_Aer').val(),
        T_Valor_Total_Maniobras : $('#T_Valor_Total_Maniobras').val(),
        T_Subsidio : $('#T_Subsidio').val(),
        T_derechosPagados : $('#T_derechosPagados').val(),
        T_Honorarios_Porcentaje : $('#T_Honorarios_Porcentaje').val(),
        T_Honorarios_Base_Honorarios : $('#T_Honorarios_Base_Honorarios').val(),
        T_Honorarios_Descuento : $('#T_Honorarios_Descuento').val(),
        T_Honorarios_Minimo : $('#T_Honorarios_Minimo_Honorarios').val(),

        T_Total_Importes : $('#T_Total_Importes').val(),
        T_Total_IVA : $('#T_Total_IVA').val(),
        T_IVA_RETENIDO : $('#T_IVA_RETENIDO').val(),
        T_Total_Gral : $('#T_Total_Gral').val(),
        T_Total_MN_Extranjera : $('#T_Total_MN_Extranjera').val(),
        T_SALDO_GRAL : $('#T_SALDO_GRAL').val(),
        CUSTOMS : $('#CUSTOMS').val(),
        T_IVA_Porcentaje : $('#T_IVA_Porcentaje').val(),
        T_SUBTOTAL_HON : $('#T_SUBTOTAL_HON').val(),
        Txt_Total_MN_Extranjera : $('#Txt_Total_MN_Extranjera').val(),
        T_Cta_Gastos : $('#T_Cta_Gastos').val(),
        T_Total_Anticipos : $('#T_Total_Anticipos').val(),
        Txt_Total_Importe : $('#Txt_Total_Importe').val(),
        Txt_Total_IVA : $('#Txt_Total_IVA').val(),
        Txt_SUBTOTAL_HON : $('#Txt_SUBTOTAL_HON').val(),
        Txt_IVA_RETENIDO : $('#Txt_IVA_RETENIDO').val(),
        Txt_Total_Gral : $('#Txt_Total_Gral').val(),
        Txt_Cta_Gastos : $('#Txt_Cta_Gastos').val(),
        Txt_Total_Anticipos : $('#Txt_Total_Anticipos').val(),
        Txt_Saldo_Gral : $('#Txt_Saldo_Gral').val(),
        Txt_Total_Pagos : $('#Txt_Total_Pagos').val(),
        T_Total_Pagos : $('#T_Total_Pagos').val(),
        Txt_Honorarios : $('#Txt_Total_Importe').val(),
        T_POCME_Total : $('#T_POCME_Total').val(),
        T_POCME_Tipo_Cambio : $('#T_POCME_Tipo_Cambio').val(),
        T_POCME_Total_MN : $('#T_POCME_Total_MN').val(),
        Total_Letra : $('#total_CuentaGastos').val(),
        T_FormaPago : $('#T_FormaPago').val(),
        T_metodoPago : $('#T_metodoPago').val(),
        T_CuentaPago : $('#T_CuentaPago').val(),
        T_Moneda : $('#T_Moneda').val(),
        T_monedaTipoCambio : $('#T_monedaTipoCambio').val(),
        T_usoCFDI: $('#T_usoCFDI').val(),
        dge: {},
        pocme: {},
        cargos: {},
        honorarios: {},
        pocmeDelete: {},
        cargoDelete: {},
        honDelete: {},
        depositos: {},
        depositosDisponibles: {}
      }

      $( ".elementos-dge" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          concepto_esp: $(this).find('.concepto-espanol').val(),
          descripcion: $(this).find('.descripcion').val()
        }
        data.dge[i] = parsed_data;
      });

      $( ".elemento-pocme" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          cantidad: $(this).find('.cantidad').val(),
          idcuenta: $(this).find('.id-cuenta').val(),
          idconcepto: $(this).find('.id-concepto').val(),
          concepto_esp: $(this).find('.concepto-espanol').val(),
          concepto_ing: $(this).find('.concepto-ingles').val(),
          descripcion: $(this).find('.descripcion').val(),
          importe: $(this).find('.importe').val(),
          subtotal: $(this).find('.subtotal').val()
        }
        data.pocme[i] = parsed_data;
      });

      $( ".elemento-pocme-eliminar" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val()
        }
        data.pocmeDelete[i] = parsed_data;
      });

      $( ".elemento-cargos" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          idcuenta: $(this).find('.id-cuenta').val(),
          idconcepto: $(this).find('.id-concepto').val(),
          concepto_esp: $(this).find('.concepto-espanol').val(),
          subtotal: $(this).find('.subtotal').val()
        }
        data.cargos[i] = parsed_data;
      });

      $( ".elemento-honorarios" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          idcuenta: $(this).find('.id-cuenta').val(),
          idcveprod: $(this).find('.id-cveProd').val(),
          concepto_esp: $(this).find('.concepto-espanol').val(),
          importe: $(this).find('.importe').val(),
          iva: $(this).find('.iva').val(),
          ret: $(this).find('.ret').val(),
          subtotal: $(this).find('.subtotal').val()
        }
        data.honorarios[i] = parsed_data;
      });

      $( ".elemento-depositos" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          idDeposito: $(this).find('.id-deposito').val(),
          importe: $(this).find('.importe').val(),
        }
        data.depositos[i] = parsed_data;
      });

      $( ".elemento-depositos-disponibles" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          idDeposito: $(this).find('.id-deposito').val(),
          importe: $(this).find('.importe').val(),
        }
        data.depositosDisponibles[i] = parsed_data;
      });

      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/1-CuentaGastos_modificar.php",
        data: data,
        success: 	function(r){
          r = JSON.parse(r);
          if (r.code == 1) {
            //console.log(r);
            folio = r.data;
            alertify.alert('Folio: '+folio, 'Actualizado correctamente' , function(){
              //setTimeout('document.location.reload()',700);
              setTimeout("window.location.replace('/conta6/Ubicaciones/Contabilidad/facturaelectronica/1-CuentaGastos.php')",700);
            });

          } else {
            console.error(r.message);
          }
        },
        error: function(x){
          console.error(x);
        }
      });
  }
});


$('#guardar-cta').click(function(){
  Suma_Subtotales();
  if( valFormaPago()==true && valMoneda()==true && valUsoCFDI()==true ){
      $('#guardar').prop('disabled',true);
      $('#mensaje').html("Guardando . . .");

      var data = {
        depositos: {},
        honorarios: {},
        cargos: {},
        pocme: {},
        T_No_calculoTarifa : $('#T_No_calculoTarifa').val(),
        Txt_Usuario : $('#Txt_Usuario').val(),
        T_IGED_1 : $('#T_IGED_1').val(),
        T_IGED_2 : $('#T_IGED_2').val(),
        T_IGED_3 : $('#T_IGED_3').val(),
        T_IGED_4 : $('#T_IGED_4').val(),
        T_IGED_5 : $('#T_IGED_5').val(),
        T_IGED_6 : $('#T_IGED_6').val(),
        T_IGED_7 : $('#T_IGED_7').val(),
        T_IGED_8 : $('#T_IGED_8').val(),
        T_IGED_9 : $('#T_IGED_9').val(),
        T_IGED_10 : $('#T_IGED_10').val(),
        T_IGED_11 : $('#T_IGED_11').val(),
        T_IGED_12 : $('#T_IGED_12').val(),
        T_IGED_13 : $('#T_IGED_13').val(),
        T_IGET_1 : $('#T_IGET_1').val(),
        T_IGET_2 : $('#T_IGET_2').val(),
        T_IGET_3 : $('#T_IGET_3').val(),
        T_IGET_4 : $('#T_IGET_4').val(),
        T_IGET_5 : $('#T_IGET_5').val(),
        T_IGET_6 : $('#T_IGET_6').val(),
        T_IGET_7 : $('#T_IGET_7').val(),
        T_IGET_8 : $('#T_IGET_8').val(),
        T_IGET_9 : $('#T_IGET_9').val(),
        T_IGET_10 : $('#T_IGET_10').val(),
        T_IGET_11 : $('#T_IGET_11').val(),
        T_IGET_12 : $('#T_IGET_12').val(),
        T_IGET_13 : $('#T_IGET_13').val(),
        T_ID_Aduana_Oculto : $('#T_ID_Aduana_Oculto').val(),
        T_ID_Almacen_Oculto : $('#T_ID_Almacen_Oculto').val(),
        T_ID_Cliente_Oculto : $('#T_ID_Cliente_Oculto').val(),
        T_Nombre_Cliente : $('#T_Nombre_Cliente').val(),
        T_Cliente_Calle : $('#T_Cliente_Calle').val(),
        T_Cliente_No_Ext : $('#T_Cliente_No_Ext').val(),
        T_Cliente_No_Int : $('#T_Cliente_No_Int').val(),
        T_Cliente_Colonia : $('#T_Cliente_Colonia').val(),
        T_Cliente_CP : $('#T_Cliente_CP').val(),
        T_Cliente_Ciudad : $('#T_Cliente_Ciudad').val(),
        T_Cliente_Estado : $('#T_Cliente_Estado').val(),
        T_Cliente_Pais : $('#T_Cliente_Pais').val(),
        T_Cliente_taxid : $('#T_Cliente_taxid').val(),
        T_Cliente_RFC : $('#T_Cliente_RFC').val(),
        T_Proveedor_Destinatario : $('#T_Proveedor_Destinatario').val(),
        T_Tipo : $('#T_Tipo').val(),
        T_Valor : $('#T_Valor').val(),
        T_Peso : $('#T_Peso').val(),
        T_Dias : $('#T_Dias').val(),
        T_Valor_Custodia_Aer : $('#T_Valor_Custodia_Aer').val(),
        T_Valor_Manejo_Aer : $('#T_Valor_Manejo_Aer').val(),
        T_Valor_Almacenaje_Aer : $('#T_Valor_Almacenaje_Aer').val(),
        T_Valor_Total_Maniobras : $('#T_Valor_Total_Maniobras').val(),
        T_Subsidio : $('#T_Subsidio').val(),
        T_derechosPagados : $('#T_derechosPagados').val(),
        T_Honorarios_Porcentaje : $('#T_Honorarios_Porcentaje').val(),
        T_Honorarios_Base_Honorarios : $('#T_Honorarios_Base_Honorarios').val(),
        T_Honorarios_Descuento : $('#T_Honorarios_Descuento').val(),
        T_Honorarios_Minimo : $('#T_Honorarios_Minimo_Honorarios').val(),
        T_Honorarios_0 : $('#T_Honorarios_0').val(),
        T_Hcta_0 : $('#T_Hcta_0').val(),
        T_Hps_0 : $('#T_Hps_0').val(),
        T_Honorarios_Importe_0 : $('#T_Honorarios_Importe_0').val(),
        T_Honorarios_IVA_0 : $('#T_Honorarios_IVA_0').val(),
        T_Honorarios_RET_0 : $('#T_Honorarios_RET_0').val(),
        T_Honorarios_Subtotal_0 : $('#T_Honorarios_Subtotal_0').val(),
        T_Total_Importes : $('#T_Total_Importes').val(),
        T_Total_IVA : $('#T_Total_IVA').val(),
        T_IVA_RETENIDO : $('#T_IVA_RETENIDO').val(),
        T_Total_Gral : $('#T_Total_Gral').val(),
        T_Total_MN_Extranjera : $('#T_Total_MN_Extranjera').val(),
        T_SALDO_GRAL : $('#T_SALDO_GRAL').val(),
        CUSTOMS : $('#CUSTOMS').val(),
        T_IVA_Porcentaje : $('#T_IVA_Porcentaje').val(),
        T_SUBTOTAL_HON : $('#T_SUBTOTAL_HON').val(),
        Txt_Total_MN_Extranjera : $('#Txt_Total_MN_Extranjera').val(),
        T_Cta_Gastos : $('#T_Cta_Gastos').val(),
        T_Total_Anticipos : $('#T_Total_Anticipos').val(),
        Txt_Total_Importe : $('#Txt_Total_Importe').val(),
        Txt_Total_IVA : $('#Txt_Total_IVA').val(),
        Txt_SUBTOTAL_HON : $('#Txt_SUBTOTAL_HON').val(),
        Txt_IVA_RETENIDO : $('#Txt_IVA_RETENIDO').val(),
        Txt_Total_Gral : $('#Txt_Total_Gral').val(),
        Txt_Cta_Gastos : $('#Txt_Cta_Gastos').val(),
        Txt_Total_Anticipos : $('#Txt_Total_Anticipos').val(),
        Txt_Saldo_Gral : $('#Txt_Saldo_Gral').val(),
        Txt_Total_Pagos : $('#Txt_Total_Pagos').val(),
        T_Total_Pagos : $('#T_Total_Pagos').val(),
        Txt_Honorarios : $('#Txt_Total_Importe').val(),
        T_POCME_Total : $('#T_POCME_Total').val(),
        T_POCME_Tipo_Cambio : $('#T_POCME_Tipo_Cambio').val(),
        T_POCME_Total_MN : $('#T_POCME_Total_MN').val(),
        Total_Letra : $('#total_CuentaGastos').val(),
        T_FormaPago : $('#T_FormaPago').val(),
        T_metodoPago : $('#T_metodoPago').val(),
        T_CuentaPago : $('#T_CuentaPago').val(),
        T_Moneda : $('#T_Moneda').val(),
        T_monedaTipoCambio : $('#T_monedaTipoCambio').val(),
        T_usoCFDI: $('#T_usoCFDI').val()
      };

      $( ".elemento-pocme" ).each(function(i) {
        var parsed_data = {
          cantidad: $(this).find('.cantidad').val(),
          idcuenta: $(this).find('.id-cuenta').val(),
          idconcepto: $(this).find('.id-concepto').val(),
          concepto_esp: $(this).find('.concepto-espanol').val(),
          concepto_ing: $(this).find('.concepto-ingles').val(),
          descripcion: $(this).find('.descripcion').val(),
          importe: $(this).find('.importe').val(),
          subtotal: $(this).find('.subtotal').val()
        }
        data.pocme[i] = parsed_data;
      });

      $( ".elemento-cargos" ).each(function(i) {
        var parsed_data = {
          idcuenta: $(this).find('.id-cuenta').val(),
          idconcepto: $(this).find('.id-concepto').val(),
          concepto_esp: $(this).find('.concepto-espanol').val(),
          subtotal: $(this).find('.subtotal').val()
        }
        data.cargos[i] = parsed_data;
      });

      $( ".elemento-honorarios" ).each(function(i) {
        var parsed_data = {
          idcuenta: $(this).find('.id-cuenta').val(),
          idcveprod: $(this).find('.id-cveProd').val(),
          concepto_esp: $(this).find('.concepto-espanol').val(),
          importe: $(this).find('.importe').val(),
          iva: $(this).find('.iva').val(),
          ret: $(this).find('.ret').val(),
          subtotal: $(this).find('.subtotal').val()
        }
        data.honorarios[i] = parsed_data;
      });

      $( ".elemento-depositos" ).each(function(i) {
        var parsed_data = {
          idDeposito: $(this).find('.id-deposito').val(),
          importe: $(this).find('.importe').val(),
          dep_aplic: $(this).find('.dep_aplic').val(),
        }
        data.depositos[i] = parsed_data;
      });
      console.log(data);

      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/1-CuentaGastos_agregar.php",
        data: data,
        success: 	function(r){
          r = JSON.parse(r);
          if (r.code == 1) {
            folio = r.data;
            alertify.alert('Folio: '+folio, 'Generado correctamente' , function(){
              //setTimeout('document.location.reload()',700);
              setTimeout("window.location.replace('/conta6/Ubicaciones/Contabilidad/facturaelectronica/1-CuentaGastos.php')",700);
            });
          } else {
            console.error(r.message);
          }
        },
        error: function(x){
          console.error(x);
        }
      });
  }
});


//BUSCAR CUANTA DE GASTOS
function ctaGastosCapturaModificar(referencia,dias,cliente,almacen,tipo,valor,peso,cuenta,shipper,consolidado,inbond,entradas,flete,reexpedicion,cobrarFlete,status_flete,entradasAdicionales){
  window.location.replace('1-CuentaGastos_modificar.php?referencia='+referencia+'&dias='+dias+'&id_cliente='+cliente+'&almacen='+almacen+'&tipo='+tipo+'&valor='+valor+'&peso='+peso+'&cuenta='+cuenta+'&shipper='+shipper+'&consolidado='+consolidado+'&inbond='+inbond+'&entradas='+entradas+'&flete='+flete+'&reexpedicion='+reexpedicion+'&cobrarFlete='+cobrarFlete
    +'&status_flete='+status_flete+'&entradasAdicionales='+entradasAdicionales);
}

function ctaGastosCapturaConsultar(cuenta,accion){
    window.location.replace('1-CuentaGastos_Consultar.php?cuenta='+cuenta+'&accion='+accion);
}
function ctaGastosCapturaImprimir(cuenta){
  window.open('impresionCuentaGastos.php?cuenta='+cuenta);
}
function ctaGastosCapturaEliminar(partida){
  swal({
  title: "Estas Seguro?",
  text: "Ya no se podra recuperar el registro! "+ partida +" ",
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
        partida: partida
      }
      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/1-CuentaGastos_eliminar.php",
        data: data,

          success: 	function(r){
            r = JSON.parse(r);
            console.log(r);
            if (r.code == 1) {
              swal("Eliminado!", "Se elimino correctamente.", "success");
              setTimeout('document.location.reload()',700);
            } else {
                   console.error(r.message);
            }
        },
        error: function(x){
          console.error(x)
        }
      });
    } else {
      swal("Cancelado", "El registro esta a salvo :)", "error");
    }
  });
}

// Timbrar factura electronica
function timbrarFactura(cuenta,referencia,cliente){
  var data = {
    cuenta: cuenta,
    referencia: referencia,
    cliente: cliente
  }

  $.ajax({
    type: "POST",
    url: "/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura.php",
    data: data,
    beforeSend: function(){
        $('body').append('<div class="overlay"><div class="overlay-loading">Timbrando Factura ... Porfavor espere.</div></div>');
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

function cancelarFactura(cuenta,referencia,cliente){
  var data = {
    cuenta: cuenta,
    referencia: referencia,
    cliente: cliente
  }

  $.ajax({
    type: "POST",
    url: "/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/cancelarCFDI_factura.php",
    data: data,
    beforeSend: function(){
        $('body').append('<div class="overlay"><div class="overlay-loading">Cancelando Factura ... Porfavor espere.</div></div>');
    },

      success: 	function(r){
        r = JSON.parse(r);
        console.log(r);
        if (r.code == 1) {
          $('#respTimbrado').val(r);
          resp = r.message;
          $('.overlay').remove();
          swal("Timbrar Factura",resp, "success");
          console.error(r.message);
          setTimeout('document.location.reload()',700);
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

//buscar Facturas Timbradas
$('#b-referencia').click(function(){
  $('#b-factura').attr('db-id','').val('');
  $('#b-cliente').attr('db-id','').val('');
});
$('#b-factura').click(function(){
  $('#b-referencia').attr('db-id','').val('');
  $('#b-cliente').attr('db-id','').val('');
});
$('#b-cliente').click(function(){
  $('#b-factura').attr('db-id','').val('');
  $('#b-referencia').attr('db-id','').val('');
});

$('#b-referencia1').click(function(){
  $('#b-factura1').attr('db-id','').val('');
  $('#b-cliente1').attr('db-id','').val('');
});
$('#b-factura1').click(function(){
  $('#b-referencia1').attr('db-id','').val('');
  $('#b-cliente1').attr('db-id','').val('');
});
$('#b-cliente1').click(function(){
  $('#b-factura1').attr('db-id','').val('');
  $('#b-referencia1').attr('db-id','').val('');
});

$('#btn_buscarFacturasTimbradas').click(function(){
  id_referencia = $('#b-referencia').attr('db-id');
  id_factura = $('#b-factura').attr('db-id');
  id_cliente = $('#b-cliente').attr('db-id');
  if( id_referencia != "" ){
    buscar = id_referencia;
  }else if( id_factura != "" ){
      buscar = id_factura;
    }else if( id_cliente != "" ){
      buscar = id_cliente;
    }else{
      alertify.error("No hay resultados");
    }
  accion = 'consultar';
  window.location.replace('/conta6/Ubicaciones/Contabilidad/facturaelectronica/4-Consultarfactura.php?buscar='+buscar+'&accion='+accion);
});

$('#btn_buscarFacturasTimbradas_cancela').click(function(){
  id_referencia = $('#b-referencia1').attr('db-id');
  id_factura = $('#b-factura1').attr('db-id');
  id_cliente = $('#b-cliente1').attr('db-id');
  if( id_referencia != "" ){
    buscar = id_referencia;
  }else if( id_factura != "" ){
      buscar = id_factura;
    }else if( id_cliente != "" ){
      buscar = id_cliente;
    }else{
      alertify.error("No hay resultados");
    }
  accion = 'cancelar';
  window.location.replace('/conta6/Ubicaciones/Contabilidad/facturaelectronica/4-Consultarfactura.php?buscar='+buscar+'&accion='+accion);
});

function docTimbrado_download(nombreArchivo,ruta){
  window.open('/conta6/Resources/PHP/actions/docTimbrado_download.php?nombreArchivo='+nombreArchivo+'&ruta='+ruta);
}
function docTimbrado_ver(nombreArchivo,ruta){
  window.open('/conta6/Resources/PHP/actions/docTimbrado_ver.php?nombreArchivo='+nombreArchivo+'&ruta='+ruta);
}

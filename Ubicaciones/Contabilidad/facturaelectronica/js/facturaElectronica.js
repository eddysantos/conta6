$(document).ready(function(){

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
  // $('.bg').click(function(){
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
        default:
          console.error("Something went terribly wrong...");
      }
    });

  $('#mostrarConsulta').submit(function(){
    $('#m-ctagastos').fadeIn();
    $('#b-ctagastos').slideUp();
  });

  $('#mostrarConsulta').submit(function(){
    $('#m-factura').fadeIn();
    $('#b-ctagastos').slideUp();
  });
  // $('#mostrar').submit(function(){
  //   $('#capmod').fadeIn();
  // });

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
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
  	});

  });

  //generar cuenta de gastos
  //$('#Btn_cambioRegimen').click(function(){


  //});


});

// ******************** DATOS DEL EMBARQUE ************************************************************
function asignar_facturarA(){
  idcliente = $('#DGE_Lst_Datos').val();
  nombre = $('#DGE_Lst_Datos option:selected').text();
  $('#id_cliente').val(idcliente);
  $('#nombreCliente').html(nombre);
  //idcliente = $('#DGEcliente').attr('db-id','');
  //nombre = $('#DGEcliente').val('');
  buscaCuentascontables('ref',idcliente);
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
        if (r.code == 1) {
          if(opcion == 'ref'){ $('#nombreCliente').html(r.data); }
          if(opcion == 'ref'){ $('#nombreCliente_sinReferencia').html(r.data); }
        }
      }
    });
}

function cargarCtaAme(){
  folioNo = $('#DGEctaAme').val();
  $('#folio').val(folioNo);
  $('select#DGEproforma').val(0);
}

function cargarSolicitudAnticipo(){
  folioNo = $('#DGEproforma').val();
  $('#folio').val(folioNo);
  $('select#DGEctaAme').val(0);
}

//function validaDatosReferencia(referencia,consolidado,entradas,shipper,inbond,flete){
function validaDatosReferencia(){

      id_cliente = $('#DGE_idcliente').val();
      dias = $('#T_Dias').val();
      extraerfolio = $('#folio').val();
      opcion = $('#opcion').val();
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

      if( opcion = 'ctagastos'){ }
      window.location.replace('1-CuentaGastos_elaborar.php?referencia='+referencia+'&consolidado='+consolidado+'&entradas='+entradas+'&shipper='+shipper+'&inbond='+inbond+'&flete='+flete+'&id_cliente='+id_cliente+'&opcion='+opcion+'&extraerfolio='+extraerfolio+'&cobrarFlete='+cobrarFlete+'&dias='+dias+'&tasa=IVA');

      //parent.contenidoFrame.location.href='elabora_Cuenta_Gastos_Referencia.php?referencia='+referencia+'&consolidado='+consolidado+'&entradas='+entradas+'&shipper='+shipper+'&inbond='+inbond+'&flete='+flete+'&id_cliente='+id_cliente+'&opcion='+opcion+'&extraerfolio='+extraerfolio+'&cobrarFlete='+cobrarFlete+'&dias='+dias+'&tasa=IVA';
}





// ******************** CUENTA DE GASTOS ************************************************************
/* SOMBREAR LOS RENGLONES EN EL DETALLE */
function cambiar_color_over(fila){
	fila.style.backgroundColor="#FCD6D7"
}

function cambiar_color_out(fila){
	fila.style.backgroundColor="#FFFFFF"
}

//PAGOS O COBROS EN MONEDA EXTRANJERA
function tarifaCliente(){
		cadena = $('#Lst_tarifa_cliente').val();
		parteCadena = cadena.split("+");
		$('#T_POCME_Cta').val(parteCadena[0]);
		$('#T_POCME_Eng').val(parteCadena[1]);
		$('#T_no_calculo').val(parteCadena[2]);
		$('#T_POCME_Valor').val(parteCadena[3]);
		$('#T_POCME').val(parteCadena[4]);
	$('#Lst_tarifa_general').val(0);
}

function tarifaGeneral(){
	cadena = $('#Lst_tarifa_general').val();
	parteCadena = cadena.split("+");
  $('#T_POCME_Cta').val(parteCadena[0]);
  $('#T_POCME_Eng').val(parteCadena[1]);
  $('#T_no_calculo').val(parteCadena[2]);
  $('#T_POCME_Valor').val(parteCadena[3]);
  $('#T_POCME').val(parteCadena[4]);
  $('#Lst_tarifa_cliente').val(0);
}

function agregarImporte(){
	unidades = $('#T_no_calculo').val();
	cta =  $('#T_POCME_Cta').val();
	concepto = $('#T_POCME').val();
	concepto_eng = $('#T_POCME_Eng').val();
	importe = $('#T_POCME_Valor').val();
	total =  cortarDecimales(CalcMUL(unidades,importe),2);

  var element = $('.T_POCME_CONCEPTOS').length;
  $( ".T_POCME_CONCEPTOS" ).each(function( x ) {
	for (x=0; x < element; x++){
	  if( $('.T_POCME_CONCEPTOS').eq(x).val() == "" ){

		if( $('.T_POCME_CONCEPTOS').eq(x).val() == "Otros"){
		  $('.T_POCME_CONCEPTOS').eq(x).prop('readOnly',true);
		  $('.T_POCME_CONCEPTOS').eq(x).css('background-color','#FFFFFF');
		}else{
		  $('.T_POCME_CONCEPTOS').eq(x).prop('readOnly',false);
		  $('.T_POCME_CONCEPTOS').eq(x).css('background-color','#DCDCDC');
		}

		$('.T_POCME_CUENTAS').eq(x).val(cta);
		$('.T_POCME_CONCEPTOS').eq(x).val(concepto);
		$('.T_POCME_CONCEPTOS_ENG').eq(x).val(concepto_eng);

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
				$('#T_POCME').val("");
				$('#T_POCME_Eng').val("");
				$('#T_POCME_Valor').val("");
				sumaGeneral();

		return false;
	  }
	}
  });
}

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
      $('.T_POCME_SUBTOTALES').eq(x).val(subtotal);
  });
	sumaGeneral();
}

function sumaGeneral(){
  Suma_POCME();
  Conversion_Tipo_Cambio();
  //Suma_Subtotales();
}

function Suma_POCME(){
  Suma_Totales = 0;

  var elementosImporte = $('.T_POCME_SUBTOTALES').length;
  $( ".T_POCME_SUBTOTALES" ).each(function( x ) {
      importe = $(this).val();
      if( importe == "" ){ importe = 0; }
      Suma_Totales = cortarDecimales(CalcADD(Suma_Totales,importe),2);
  });

  $('#T_POCME_Total').val(Suma_Totales);
	Conversion_Tipo_Cambio();
	//Suma_Subtotales();
}

function Conversion_Tipo_Cambio(){
	POCME_Total = $('#T_POCME_Total').val();
  POCME_Tipo_Cambio = $('#T_POCME_Tipo_Cambio').val();
	Total_POCME_MN =  cortarDecimales(CalcMUL(POCME_Total,POCME_Tipo_Cambio),2);
	$('#T_POCME_Total_MN').val(Total_POCME_MN);
	//Suma_Subtotales();
}

function limpiarCampos(seccion,posicion){
  //POCME
  if( seccion == '1'){
    var elementosImporte = $('.T_POCME_SUBTOTALES').length;
    $( ".T_POCME_SUBTOTALES" ).each(function( x ) {
      posicion = posicion - 1;
      console.log(posicion);
      if( posicion == x ){
        $('.T_POCME_CANTIDAD').eq(posicion).val('');
        $('.T_POCME_CUENTAS').eq(posicion).val('');
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





}


//TODOS LOS CONCEPTO EN LA FACTURA DEBEN TENER UN IMPORTE
function validaDescImporte(frmObj_Desc,frmObj_Imp){

	if(frmObj_Imp.value > 0 && (frmObj_Desc.value == '' || frmObj_Desc.value == null)){
		alert("Ingrese un Concepto");
		frmObj_Desc.focus();
		frmObj_Imp.value = 0;
	}

	if(frmObj_Imp.value == 0 && frmObj_Desc.value != ''){
		alert("Ingrese un Importe");
		frmObj_Imp.focus();
	}
}

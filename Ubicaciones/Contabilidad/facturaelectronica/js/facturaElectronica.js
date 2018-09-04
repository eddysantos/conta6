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

  $('#T_POCME_Total').val(Suma_Totales);
	Conversion_Tipo_Cambio();
	Suma_Subtotales();
}

function Conversion_Tipo_Cambio(){
	POCME_Total = $('#T_POCME_Total').val();
  POCME_Tipo_Cambio = $('#T_POCME_Tipo_Cambio').val();
	Total_POCME_MN =  cortarDecimales(CalcMUL(POCME_Total,POCME_Tipo_Cambio),2);
	$('#T_POCME_Total_MN').val(Total_POCME_MN);
	Suma_Subtotales();
}

function Suma_Subtotales(){
		var Suma_Importes = 0;
    var Suma_IVA = 0;
		var Suma_Totales_Cargos = 0;
		var Suma_Anticipos = 0;
		var Suma_Saldo = 0;
		var Iva_Retenido = 0;
		var Subtotal_Hon = 0;
		var Total_Hon = 0;
		var Total_Cta = 0;

    //SUMA DE IMPORTES DE HONORARIOS
    $('.T_Honorarios_Importe').each(function( x ) {
        importe = $(this).val();
        if( importe == "" ){ importe = 0; }
        Suma_Importes = cortarDecimales(CalcADD(Suma_Importes,importe),2);
    });
    $('#T_Total_Importes').val(Suma_Importes);

    //SUMA DE IVA DE HONORARIOS
    $('.T_Honorarios_IVA').each(function( x ) {
        importe = $(this).val();
        if( importe == "" ){ importe = 0; }
        Suma_IVA = cortarDecimales(CalcADD(Suma_IVA,importe),2);
    });
    $('#T_Total_IVA').val(Suma_IVA);

    //SUMA IVA RETENIDO
    $('.T_Honorarios_RET').each(function( x ) {
        importe = $(this).val();
        if( importe == "" ){ importe = 0; }
        Iva_Retenido = cortarDecimales(CalcADD(Iva_Retenido,importe),2);
    });
    $('#T_IVA_RETENIDO').val(Iva_Retenido);

    //SUBTOTAL DE HONORARIOS
		Subtotal_Hon = cortarDecimales(CalcADD(Suma_Importes,Suma_IVA),2);
		$('#T_SUBTOTAL_HON').val(Subtotal_Hon);

		//TOTAL
		Total_Hon = cortarDecimales(CalcSUB(Subtotal_Hon,Iva_Retenido),2);
		$('#T_Total_Gral').val(Total_Hon);

		//TOTAL PAGOS O CARGOS EN MONEDA EXTRANJERA
		$('#T_Total_MN_Extranjera').val( $('#T_POCME_Total_MN').val() );

    //SUMA TOTALES PAGOS REALIZADOS POR SU CUENTA
    $('.T_Cargo_Subtotal').each(function( x ) {
        importe = $(this).val();
        if( importe == "" ){ importe = 0; }
        Suma_Totales_Cargos = cortarDecimales(CalcADD(Suma_Totales_Cargos,importe),2);
    });
    $('#T_Total_Pagos').val(Suma_Totales_Cargos);

    //TOTAL CUENTA DE GASTOS
		Total_Cta = cortarDecimales(CalcADD(Total_Hon, $('#T_POCME_Total_MN').val() ),2);
		Total_Cta = cortarDecimales(CalcADD(Total_Cta,Suma_Totales_Cargos),2);
		$('#T_Cta_Gastos').val(Total_Cta);

    //SUMA ANTICIPOS
    $('.T_Anticipo').each(function( x ) {
        importe = $(this).val();
        if( importe == "" ){ importe = 0; }
        Suma_Anticipos = cortarDecimales(CalcADD(Suma_Anticipos,importe),2);
    });
    $('#T_Total_Anticipos').val(Suma_Anticipos);

    //SALDO DE LA CUENTA
		Suma_Saldo = cortarDecimales(CalcSUB(Total_Cta,Suma_Anticipos),2)
		$('#T_SALDO_GRAL').val(Suma_Saldo);

    //TOTAL DE CUENTA DE GASTOS EN LETRE
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
        $('#total_CuentaGastos').html(r.data);
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
    //var elementosImporte = $('.T_POCME_SUBTOTALES').length;
    $( ".T_POCME_SUBTOTALES" ).each(function( x ) {
      posicion = posicion - 1;
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
	$('#Lst_CA').val(0);
}

function tarifaAlmacenLibre(){
  cadena = $('#Lst_CA').val();
  $('#T_CA').val(cadena);
  $('#T_Valor_Concepto_Gral').val('0');
  $('#Lst_Conceptos').val(0);
}

function agregarCargo(){
  concepto = $('#T_CA').val();
	importe = $('#T_Valor_Concepto_Gral').val();
	oficina = $('#T_ID_Aduana_Oculto').val();
	id_cliente = $('#T_ID_Cliente_Oculto').val();

  var element = $('.T_Cargo').length;
  $(".T_Cargo").each(function( x ) {
  	for (x=0; x < element; x++){
      if( $('.T_Cargo').eq(x).val() == "" ){

        if( $('.T_Cargo').eq(x).val() == "Otros Gastos Comprobados" || $('.T_Cargo').eq(x).val() == "Venta de activos fijos" ){
    		  $('.T_Cargo').eq(x).prop('readOnly',true);
    		  $('.T_Cargo').eq(x).css('background-color','#FFFFFF');
    		}else{
    		  $('.T_Cargo').eq(x).prop('readOnly',false);
    		  $('.T_Cargo').eq(x).css('background-color','#DCDCDC');
    		}

        $('.T_Cargo').eq(x).val(concepto);

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
  			$('#T_CA').val("");
  			$('#T_Valor_Concepto_Gral').val("");
  			sumaGeneral();
  			return false;
      }
    }
  });
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
		id_cuenta = $('#T_Hcta').val();
		id_prodServ = $('#T_Hps').val();
		concepto = $('#T_CH').val();
		importe = $('#T_Valor_Concepto_Honorarios').val();
    oficina = $('#T_ID_Aduana_Oculto').val();
  	id_cliente = $('#T_ID_Cliente_Oculto').val();

    var element = $('.T_Honorarios').length;
    $(".T_Honorarios").each(function( x ) {
      for (x=0; x < element; x++){
        if( $('.T_Honorarios').eq(x).val() == "" ){
          if( $('.T_Honorarios').eq(x).val() == "Otros Gastos Comprobados"){
      		  $('.T_Honorarios').eq(x).prop('readOnly',true);
      		  $('.T_Honorarios').eq(x).css('background-color','#FFFFFF');
      		}else{
      		  $('.T_Honorarios').eq(x).prop('readOnly',false);
      		  $('.T_Honorarios').eq(x).css('background-color','#DCDCDC');
      		}

          $('.T_Honorarios').eq(x).val(concepto);
  				$('.T_Honorarios_idcta').eq(x).val(id_cuenta);
  				$('.T_Honorarios_idps').eq(x).val(id_prodServ);

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
      }
    });
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
  total_mercancias = $('#T_IGED_11').val();
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
		  $('#T_Honorarios_Importe').val(min_hon);
      hon = min_hon;
		}else{
		  $('#T_Honorarios_Importe').val(Total_Honorarios);
      hon = Total_Honorarios;
		}

    total_hon_iva = cortarDecimales(CalcMUL(hon,IVA),2)
		$('#T_Honorarios_IVA').val(total_hon_iva);
    total = cortarDecimales(CalcADD(total_hon_iva,hon),2)
		$('#T_Honorarios_Total').val(total);
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


function asignarMetodoPago(){
	metodoPago = $('#Lst_metodoPago').val();
	$('#T_metodoPago').val(metodoPago);

	if( metodoPago == 'PPD' ){
		$('#T_FormaPago').val('99');
		$('#T_CuentaPago').val('');
		$('#Lst_formaPago').prop( 'disabled',true );
	}else{
		$('#T_FormaPago').val('');
		$('#T_CuentaPago').val('');
		$('#Lst_formaPago').prop( 'disabled',false );
	}
}

function asignarFormaPago(){
  metodoPago = $('#Lst_formaPago').val();
  $('#T_FormaPago').val(metodoPago);

  if(metodoPago == "02" || metodoPago == "03" ){
    $('#Lst_cuentaPago').prop( 'disabled',false );
    id_cliente = $('#T_ID_Cliente_Oculto').val();
    buscarNumeroCuentaBanco(id_cliente);
  }else{
    $('#Lst_cuentaPago').val(0);
    $('#Lst_cuentaPago').prop( 'disabled',true );
    $('#numerosCuenta').html('');
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
  $('#T_CuentaPago').val(parteCadena[1]);
}

function asignarMoneda(){
		moneda = $('#Lst_moneda').val();
		$('#T_Moneda').val(moneda);

		if( moneda == 'MXN' ){
			$('#T_monedaTipoCambio').val("");
			$('#T_monedaTipoCambio').prop('readOnly',true);
			$('#T_monedaTipoCambio').css('background-color','#DCDCDC');
		}else{
			$('#T_monedaTipoCambio').prop('readOnly',false)
			$('#T_monedaTipoCambio').css('background-color','#FFFFFF');
		}
}

function asignarUsoCFDI(){
	usoCFDI = $('#Lst_usoCFDI').val();
	$('#T_usoCFDI').val(usoCFDI);
}

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
/*
function guardarCta(){
		Suma_Subtotales();
		if( valFormaPago()==true && valMoneda()==true && valUsoCFDI()==true ){
				//$('#guardar').prop('disabled',true);
				$('#mensaje').html("Guardando . . .");

        var data = {
          pocme: {},
          pacme: {},
          picme:{},
        }

        $('#POCME_body tr').each(function(i){
          $(this).find('td').each(function(e){
            var campo = $(this).attr('name');
            data.pocme[i][campo] = $(this).val();
          })
        });

        var data = {
*/
function guardarCta(){
		Suma_Subtotales();
		if( valFormaPago()==true && valMoneda()==true && valUsoCFDI()==true ){
				//$('#guardar').prop('disabled',true);
				$('#mensaje').html("Guardando . . .");

        var data = {
            T_No_calculoTarifa : $('#T_No_calculoTarifa').val(),
            Txt_Usuario : $('#Txt_Usuario').val(),
            T_IGED_1 : $('#T_IGED_1').val(),
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
            T_IGET_0 : $('#T_IGET_0').val(),
            T_IGED_0 : $('#T_IGED_0').val(),
            T_IGET_1 : $('#T_IGET_1').val(),
            T_IGED_1 : $('#T_IGED_1').val(),
            T_IGET_2 : $('#T_IGET_2').val(),
            T_IGED_2 : $('#T_IGED_2').val(),
            T_IGET_3 : $('#T_IGET_3').val(),
            T_IGED_3 : $('#T_IGED_3').val(),
            T_IGET_4 : $('#T_IGET_4').val(),
            T_IGED_4 : $('#T_IGED_4').val(),
            T_IGET_5 : $('#T_IGET_5').val(),
            T_IGED_5 : $('#T_IGED_5').val(),
            T_IGET_6 : $('#T_IGET_6').val(),
            T_IGED_6 : $('#T_IGED_6').val(),
            T_IGET_7 : $('#T_IGET_7').val(),
            T_IGED_7 : $('#T_IGED_7').val(),
            T_IGET_8 : $('#T_IGET_8').val(),
            T_IGED_8 : $('#T_IGED_8').val(),
            T_IGET_9 : $('#T_IGET_9').val(),
            T_IGED_9 : $('#T_IGED_9').val(),
            T_IGET_10 : $('#T_IGET_10').val(),
            T_IGED_10 : $('#T_IGED_10').val(),
            T_IGET_11 : $('#T_IGET_11').val(),
            T_IGED_11 : $('#T_IGED_11').val(),
            T_IGET_12 : $('#T_IGET_12').val(),
            T_IGED_12 : $('#T_IGED_12').val(),
            T_IGET_13 : $('#T_IGET_13').val(),
            T_IGED_13 : $('#T_IGED_13').val(),
            T_POCME_Cantidad1 : $('#T_POCME_Cantidad1').val(),
            T_POCME_idTipoCta1 : $('#T_POCME_idTipoCta1').val(),
            T_POCME_Concepto1 : $('#T_POCME_Concepto1').val(),
            T_POCME_ConceptoEng1 : $('#T_POCME_ConceptoEng1').val(),
            T_POCME_Descripcion1 : $('#T_POCME_Descripcion1').val(),
            T_POCME_Importe1 : $('#T_POCME_Importe1').val(),
            T_POCME_Subtotal1 : $('#T_POCME_Subtotal1').val(),
            T_POCME_Cantidad2 : $('#T_POCME_Cantidad2').val(),
            T_POCME_idTipoCta2 : $('#T_POCME_idTipoCta2').val(),
            T_POCME_Concepto2 : $('#T_POCME_Concepto2').val(),
            T_POCME_ConceptoEng2 : $('#T_POCME_ConceptoEng2').val(),
            T_POCME_Descripcion2 : $('#T_POCME_Descripcion2').val(),
            T_POCME_Importe2 : $('#T_POCME_Importe2').val(),
            T_POCME_Subtotal2 : $('#T_POCME_Subtotal2').val(),
            T_POCME_Cantidad3 : $('#T_POCME_Cantidad3').val(),
            T_POCME_idTipoCta3 : $('#T_POCME_idTipoCta3').val(),
            T_POCME_Concepto3 : $('#T_POCME_Concepto3').val(),
            T_POCME_ConceptoEng3 : $('#T_POCME_ConceptoEng3').val(),
            T_POCME_Descripcion3 : $('#T_POCME_Descripcion3').val(),
            T_POCME_Importe3 : $('#T_POCME_Importe3').val(),
            T_POCME_Subtotal3 : $('#T_POCME_Subtotal3').val(),
            T_POCME_Cantidad4 : $('#T_POCME_Cantidad4').val(),
            T_POCME_idTipoCta4 : $('#T_POCME_idTipoCta4').val(),
            T_POCME_Concepto4 : $('#T_POCME_Concepto4').val(),
            T_POCME_ConceptoEng4 : $('#T_POCME_ConceptoEng4').val(),
            T_POCME_Descripcion4 : $('#T_POCME_Descripcion4').val(),
            T_POCME_Importe4 : $('#T_POCME_Importe4').val(),
            T_POCME_Subtotal4 : $('#T_POCME_Subtotal4').val(),
            T_POCME_Cantidad5 : $('#T_POCME_Cantidad5').val(),
            T_POCME_idTipoCta5 : $('#T_POCME_idTipoCta5').val(),
            T_POCME_Concepto5 : $('#T_POCME_Concepto5').val(),
            T_POCME_ConceptoEng5 : $('#T_POCME_ConceptoEng5').val(),
            T_POCME_Descripcion5 : $('#T_POCME_Descripcion5').val(),
            T_POCME_Importe5 : $('#T_POCME_Importe5').val(),
            T_POCME_Subtotal5 : $('#T_POCME_Subtotal5').val(),
            T_POCME_Cantidad6 : $('#T_POCME_Cantidad6').val(),
            T_POCME_idTipoCta6 : $('#T_POCME_idTipoCta6').val(),
            T_POCME_Concepto6 : $('#T_POCME_Concepto6').val(),
            T_POCME_ConceptoEng6 : $('#T_POCME_ConceptoEng6').val(),
            T_POCME_Descripcion6 : $('#T_POCME_Descripcion6').val(),
            T_POCME_Importe6 : $('#T_POCME_Importe6').val(),
            T_POCME_Subtotal6 : $('#T_POCME_Subtotal6').val(),
            T_POCME_Cantidad7 : $('#T_POCME_Cantidad7').val(),
            T_POCME_idTipoCta7 : $('#T_POCME_idTipoCta7').val(),
            T_POCME_Concepto7 : $('#T_POCME_Concepto7').val(),
            T_POCME_ConceptoEng7 : $('#T_POCME_ConceptoEng7').val(),
            T_POCME_Descripcion7 : $('#T_POCME_Descripcion7').val(),
            T_POCME_Importe7 : $('#T_POCME_Importe7').val(),
            T_POCME_Subtotal7 : $('#T_POCME_Subtotal7').val(),
            T_POCME_Cantidad8 : $('#T_POCME_Cantidad8').val(),
            T_POCME_idTipoCta8 : $('#T_POCME_idTipoCta8').val(),
            T_POCME_Concepto8 : $('#T_POCME_Concepto8').val(),
            T_POCME_ConceptoEng8 : $('#T_POCME_ConceptoEng8').val(),
            T_POCME_Descripcion8 : $('#T_POCME_Descripcion8').val(),
            T_POCME_Importe8 : $('#T_POCME_Importe8').val(),
            T_POCME_Subtotal8 : $('#T_POCME_Subtotal8').val(),
            T_POCME_Total : $('#T_POCME_Total').val(),
            T_POCME_Tipo_Cambio : $('#T_POCME_Tipo_Cambio').val(),
            T_POCME_Total_MN : $('#T_POCME_Total_MN').val(),
            T_Cargo_1 : $('#T_Cargo_1').val(),
            T_Cargo_13 : $('#T_Cargo_13').val(),
            T_Cargo_2 : $('#T_Cargo_2').val(),
            T_Cargo_23 : $('#T_Cargo_23').val(),
            T_Cargo_3 : $('#T_Cargo_3').val(),
            T_Cargo_33 : $('#T_Cargo_33').val(),
            T_Cargo_4 : $('#T_Cargo_4').val(),
            T_Cargo_43 : $('#T_Cargo_43').val(),
            T_Cargo_5 : $('#T_Cargo_5').val(),
            T_Cargo_53 : $('#T_Cargo_53').val(),
            T_Cargo_6 : $('#T_Cargo_6').val(),
            T_Cargo_63 : $('#T_Cargo_63').val(),
            T_Cargo_7 : $('#T_Cargo_7').val(),
            T_Cargo_73 : $('#T_Cargo_73').val(),
            T_Cargo_8 : $('#T_Cargo_8').val(),
            T_Cargo_83 : $('#T_Cargo_83').val(),
            T_Hps0 : $('#T_Hps0').val(),
            T_Hps1 : $('#T_Hps1').val(),
            T_Hps2 : $('#T_Hps2').val(),
            T_Hps3 : $('#T_Hps3').val(),
            T_Hps4 : $('#T_Hps4').val(),
            T_Hps5 : $('#T_Hps5').val(),
            T_Hps6 : $('#T_Hps6').val(),
            T_Hps7 : $('#T_Hps7').val(),
            T_Hps8 : $('#T_Hps8').val(),
            T_Hcta0 : $('#T_Hcta0').val(),
            T_Hcta1 : $('#T_Hcta1').val(),
            T_Hcta2 : $('#T_Hcta2').val(),
            T_Hcta3 : $('#T_Hcta3').val(),
            T_Hcta4 : $('#T_Hcta4').val(),
            T_Hcta5 : $('#T_Hcta5').val(),
            T_Hcta6 : $('#T_Hcta6').val(),
            T_Hcta7 : $('#T_Hcta7').val(),
            T_Hcta8 : $('#T_Hcta8').val(),
            T_Honorarios_RET : $('#T_Honorarios_RET').val(),
            T_Honorarios_14 : $('#T_Honorarios_14').val(),
            T_Honorarios_24 : $('#T_Honorarios_24').val(),
            T_Honorarios_34 : $('#T_Honorarios_34').val(),
            T_Honorarios_44 : $('#T_Honorarios_44').val(),
            T_Honorarios_54 : $('#T_Honorarios_54').val(),
            T_Honorarios_64 : $('#T_Honorarios_64').val(),
            T_Honorarios_74 : $('#T_Honorarios_74').val(),
            T_Honorarios_84 : $('#T_Honorarios_84').val(),
            T_usoCFDI : $('#T_usoCFDI').val(),
            T_Honorarios_Porcentaje : $('#T_Honorarios_Porcentaje').val(),
            T_Honorarios_Base_Honorarios : $('#T_Honorarios_Base_Honorarios').val(),
            T_Honorarios_Descuento : $('#T_Honorarios_Descuento').val(),
            Txt_Descuento : $('#Txt_Descuento').val(),
            T_Honorarios_Importe : $('#T_Honorarios_Importe').val(),
            T_Honorarios_IVA : $('#T_Honorarios_IVA').val(),
            T_Honorarios_Total : $('#T_Honorarios_Total').val(),
            T_Honorarios_1 : $('#T_Honorarios_1').val(),
            T_Honorarios_11 : $('#T_Honorarios_11').val(),
            T_Honorarios_12 : $('#T_Honorarios_12').val(),
            T_Honorarios_13 : $('#T_Honorarios_13').val(),
            T_Honorarios_2 : $('#T_Honorarios_2').val(),
            T_Honorarios_21 : $('#T_Honorarios_21').val(),
            T_Honorarios_22 : $('#T_Honorarios_22').val(),
            T_Honorarios_23 : $('#T_Honorarios_23').val(),
            T_Honorarios_3 : $('#T_Honorarios_3').val(),
            T_Honorarios_31 : $('#T_Honorarios_31').val(),
            T_Honorarios_32 : $('#T_Honorarios_32').val(),
            T_Honorarios_33 : $('#T_Honorarios_33').val(),
            T_Honorarios_4 : $('#T_Honorarios_4').val(),
            T_Honorarios_41 : $('#T_Honorarios_41').val(),
            T_Honorarios_42 : $('#T_Honorarios_42').val(),
            T_Honorarios_43 : $('#T_Honorarios_43').val(),
            T_Honorarios_5 : $('#T_Honorarios_5').val(),
            T_Honorarios_51 : $('#T_Honorarios_51').val(),
            T_Honorarios_52 : $('#T_Honorarios_52').val(),
            T_Honorarios_53 : $('#T_Honorarios_53').val(),
            T_Honorarios_6 : $('#T_Honorarios_6').val(),
            T_Honorarios_61 : $('#T_Honorarios_61').val(),
            T_Honorarios_62 : $('#T_Honorarios_62').val(),
            T_Honorarios_63 : $('#T_Honorarios_63').val(),
            T_Honorarios_7 : $('#T_Honorarios_7').val(),
            T_Honorarios_71 : $('#T_Honorarios_71').val(),
            T_Honorarios_72 : $('#T_Honorarios_72').val(),
            T_Honorarios_73 : $('#T_Honorarios_73').val(),
            T_Honorarios_8 : $('#T_Honorarios_8').val(),
            T_Honorarios_81 : $('#T_Honorarios_81').val(),
            T_Honorarios_82 : $('#T_Honorarios_82').val(),
            T_Honorarios_83 : $('#T_Honorarios_83').val(),
            T_No_Anticipo_1 : $('#T_No_Anticipo_1').val(),
            T_Anticipo_1 : $('#T_Anticipo_1').val(),
            T_No_Anticipo_2 : $('#T_No_Anticipo_2').val(),
            T_Anticipo_2 : $('#T_Anticipo_2').val(),
            T_No_Anticipo_3 : $('#T_No_Anticipo_3').val(),
            T_Anticipo_3 : $('#T_Anticipo_3').val(),
            T_No_Anticipo_4 : $('#T_No_Anticipo_4').val(),
            T_Anticipo_4 : $('#T_Anticipo_4').val(),
            T_No_Anticipo_5 : $('#T_No_Anticipo_5').val(),
            T_Anticipo_5 : $('#T_Anticipo_5').val(),
            T_No_Anticipo_6 : $('#T_No_Anticipo_6').val(),
            T_Anticipo_6 : $('#T_Anticipo_6').val(),
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
            Txt_Honorarios : $('#Txt_Honorarios').val(),
            Txt_POCME_Total : $('#Txt_POCME_Total').val(),
            Txt_POCME_Tipo_Cambio : $('#Txt_POCME_Tipo_Cambio').val(),
            Total_Letra : $('#Total_Letra').val(),
            T_FormaPago : $('#T_FormaPago').val(),
            T_metodoPago : $('#T_metodoPago').val(),
            T_CuentaPago : $('#T_CuentaPago').val(),
            T_Moneda : $('#T_Moneda').val(),
            T_monedaTipoCambio : $('#T_monedaTipoCambio').val()
        }//fin data

        $.ajax({
          type: "POST",
          url: "/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/1-CuentaGastos_agregar.php",
          data: data,
          success: 	function(r){
            //console.log(r);
            r = JSON.parse(r);
            if (r.code == 1) {
              //console.log(r.hon);
              folio = r.data;
              swal("Folio: "+folio, "generado correctamente", "success");
              //setTimeout('document.location.reload()',700);
            } else {
              console.error(r.message);
            }
          },
          error: function(x){
            console.error(x);
          }
        });
		}

}

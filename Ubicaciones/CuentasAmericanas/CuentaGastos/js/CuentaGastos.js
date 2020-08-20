$(document).ready(function(){

  //$oRst_permisos
  marcarPagada = $('#cta_ame_marcarPagada').val();
  if( marcarPagada == 0 ){
    $('#T_pagada').prop('disabled',true);
  }
  verGstoGana = $('#cta_ame_verGstoGana').val();
  if(verGstoGana == 0 ){
    $('.spend').hide();
    $('.gain').hide();
    $('#T_gasto_Total').attr('type','hidden');
    $('#T_gana_Total').attr('type','hidden');
  }
  //******************************

    $('.ctagastos').click(function(){
      var accion = $(this).attr('accion');
      var status = $(this).attr('status');


      switch (accion) {
        case "buscar":
        $('#buscarRef').fadeIn();
        $('#SeleccionarAccion').slideUp();
          break;
        case "generar":
        $('#gctaGastos').fadeIn();
        $('#SeleccionarAccion').slideUp();
          break;

          case "datcliente_CtaGtos":
          if (status == 'cerrado') {
            $('#contornoCliente').fadeIn();
            $(this).attr('status', 'abierto');
            $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
            $(this).css('font-size', '20px');
          } else {
            $('#contornoCliente').fadeOut();
            $(this).attr('status', 'cerrado');
            $(this).css('color', "");
            $(this).css('font-size', "");
          }
            break;
            case "datinfo_CtaGtos":
            if (status == 'cerrado') {
              $('#contornoInfo').fadeIn();
              $(this).attr('status', 'abierto');
              $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
              $(this).css('font-size', '20px');
            } else {
              $('#contornoInfo').fadeOut();
              $(this).attr('status', 'cerrado');
              $(this).css('color', "");
              $(this).css('font-size', "");
            }
            break;

        default:
          console.error("Something went terribly wrong...");
      }
    });

  $('.atras').click(function(){
    var accion = $(this).attr('accion');
    switch (accion) {
      case "cuadroBusqueda":
      $('#buscarRef').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      case "cuadroGenerar":
      $('#gctaGastos').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      case "cuadroConsultar":
      $('#repoSol').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      default:
        console.error("Something went terribly wrong...");
    }
  });


  $('#mostrarConsulta_ame').submit(function(){
    $('#repoSol').fadeIn();
    $('#buscarRef').slideUp();

        var data = {
          id_captura: $('#bRef').val(),
          accion: 'consulMod'
        }
        $.ajax({
          type: "POST",
          url: "/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_lstCapturadas.php",
          data: data,
          success: 	function(r){
            console.log(r);
          r = JSON.parse(r);
            if (r.code == 1) {
              console.log(r);
              $('#lst_cuentasGastos_ame').html(r.data);
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

  $('#bRef').focus(function(){
    $('#referencia').css('height', '100px');
    $('#labelRef').css('font-size', '24pt');
    $(this).css('height', '140px');
  });

  $('#gRef').focus(function(){
    $('#gctaGastosRef').css('height', '100px');
    $('#labelgRef').css('font-size', '24pt');
    $(this).css('height', '140px');
  });



  $('#btn_buscarDatosEmbarque_ctaAme').click(function(){
    var data = {
      id_referencia: $('#btn_ctaAme').attr('db-id')
    }

    $.ajax({
      type: "POST",
      url: "/Ubicaciones/CuentasAmericanas/CuentaGastos/CuentaGastos_datosReferencia.php",
      data: data,
      success: 	function(r){
      r = JSON.parse(r);
        if (r.code == 1) {
          $('#datosEmbarque').show();

          // $('#btn_buscarDatosEmbarque_ctaAme').html(r.data);
          $('#datosEmbarque').html(r.data);
          $('#T_Dias').val('1').attr('value','1');
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });
  });


  $('#Btn_new_ctaAme').click(function(){
    window.location.replace('/Ubicaciones/CuentasAmericanas/CuentaGastos/CuentaGastos.php');
  });

  $('#guardar-ctaAme').click(function(){
    if( $('#T_Date').val() == '' ){
      alertify.success('Asigne una fecha');
      $('#T_Date').focus();
      return false;
    }

    Suma_POCME_ctaAme();

    if( $('#T_Sub_Total').val() == 0 ){
      alertify.success('Ingrese un importe');
      $('#T_Sub_Total').focus();
      return false;
    }

    var data = {
      anticipos: {},
      pocme: {},
      T_No_calculoTarifa : $('#T_No_calculoTarifa').val(),
      Txt_Usuario : $('#Txt_Usuario').val(),
      T_Referencia : $('#T_Referencia').val(),
      T_Tipo : $('#T_Tipo').val(),
      T_Freight : $('#T_Freight').val(),
      T_Quantity : $('#T_Quantity').val(),
      T_Type : $('#T_Type').val(),
      T_Descripction : $('#T_Descripction').val(),
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
      T_ID_Proveedor : $('#T_ID_Proveedor').val(),
      T_Proveedor_Destinatario : $('#T_Proveedor_Destinatario').val(),
      T_Proveedor_Calle : $('#T_Proveedor_Calle').val(),
      T_Proveedor_Calle : $('#T_Proveedor_Calle').val(),
      T_Proveedor_No_Ext : $('#T_Proveedor_No_Ext').val(),
      T_Proveedor_No_Int : $('#T_Proveedor_No_Int').val(),
      T_Proveedor_Colonia : $('#T_Proveedor_Colonia').val(),
      T_Proveedor_Pais : $('#T_Proveedor_Pais').val(),
      T_Proveedor_Entidad : $('#T_Proveedor_Entidad').val(),
      T_Proveedor_Ciudad : $('#T_Proveedor_Ciudad').val(),
      T_Proveedor_tel : $('#Proveedoreedor_tel').val(),
      T_Proveedor_fax : $('#T_Proveedor_fax').val(),
      T_Invoice_No : $('#T_Invoice_No').val(),
      T_Invoice_Value : $('#T_Invoice_Value').val(),
      T_Date : $('#T_Date').val(),
      T_Weight : $('#T_Weight').val(),
      T_Customer_Order : $('#T_Customer_Order').val(),
      T_pagada : $('#T_pagada').val(),
      T_gasto_Total : $('#T_gasto_Total').val(),
      T_gana_Total : $('#T_gana_Total').val(),
      T_Sub_Total : $('#T_Sub_Total').val(),
      T_Total : $('#T_Total').val()
    }

    $( ".elemento-pocme" ).each(function(i) {
      $activado = $(this).find('.check').prop('checked');
      if( $activado == true ){ $valResp = 1; }else{ $valResp = 0; }
      var parsed_data = {
        cantidad: $(this).find('.cantidad').val(),
        idcuenta: $(this).find('.id-cuenta').val(),
        idconcepto: $(this).find('.id-concepto').val(),
        concepto_esp: $(this).find('.concepto-espanol').val(),
        concepto_ing: $(this).find('.concepto-ingles').val(),
        descripcion: $(this).find('.descripcion').val(),
        check: $valResp,
        gasto: $(this).find('.gasto').val(),
        ganancia: $(this).find('.ganancia').val(),
        importe: $(this).find('.importe').val(),
        subtotal: $(this).find('.subtotal').val()
      }
      data.pocme[i] = parsed_data;
    });

    $( ".elemento-advance" ).each(function(i) {
      var parsed_data = {
        anticipo: $(this).find('.advanceNum').val(),
        importe: $(this).find('.advanceImporte').val()
      }
      data.anticipos[i] = parsed_data;
    });

    $.ajax({
      type: "POST",
      url: "/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_agregar.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        console.log(data);
        if (r.code == 1) {
          folio = r.data;
          alertify.alert('Folio: '+folio, 'Generado correctamente' , function(){
            $('#guardar-ctaAme').prop('disabled',true);
            $('#print').show();
            $('#Btn_print_ctaAme').attr('onclick','ctaGastosAmeImprimir('+folio+')')
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

  $('#modificar-ctaAme').click(function(){
    folio = $('#T_Invoice_No').val();

    if( $('#T_Date').val() == '' ){
      alertify.success('Asigne una fecha');
      $('#T_Date').focus();
      return false;
    }

    Suma_POCME_ctaAme();

    if( $('#T_Sub_Total').val() == 0 ){
      alertify.success('Ingrese un importe');
      $('#T_Sub_Total').focus();
      return false;
    }

        var data = {
          folio: folio,
          T_No_calculoTarifa : $('#T_No_calculoTarifa').val(),
          Txt_Usuario : $('#Txt_Usuario').val(),
          T_Referencia : $('#T_Referencia').val(),
          T_Tipo : $('#T_Tipo').val(),
          T_Freight : $('#T_Freight').val(),
          T_Quantity : $('#T_Quantity').val(),
          T_Type : $('#T_Type').val(),
          T_Descripction : $('#T_Descripction').val(),
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
          T_ID_Proveedor : $('#T_ID_Proveedor').val(),
          T_Proveedor_Destinatario : $('#T_Proveedor_Destinatario').val(),
          T_Proveedor_Calle : $('#T_Proveedor_Calle').val(),
          T_Proveedor_Calle : $('#T_Proveedor_Calle').val(),
          T_Proveedor_No_Ext : $('#T_Proveedor_No_Ext').val(),
          T_Proveedor_No_Int : $('#T_Proveedor_No_Int').val(),
          T_Proveedor_Colonia : $('#T_Proveedor_Colonia').val(),
          T_Proveedor_Pais : $('#T_Proveedor_Pais').val(),
          T_Proveedor_Entidad : $('#T_Proveedor_Entidad').val(),
          T_Proveedor_Ciudad : $('#T_Proveedor_Ciudad').val(),
          T_Proveedor_tel : $('#Proveedoreedor_tel').val(),
          T_Proveedor_fax : $('#T_Proveedor_fax').val(),
          T_Invoice_No : $('#T_Invoice_No').val(),
          T_Invoice_Value : $('#T_Invoice_Value').val(),
          T_Date : $('#T_Date').val(),
          T_Weight : $('#T_Weight').val(),
          T_Customer_Order : $('#T_Customer_Order').val(),
          T_pagada : $('#T_pagada').val(),
          T_gasto_Total : $('#T_gasto_Total').val(),
          T_gana_Total : $('#T_gana_Total').val(),
          T_Sub_Total : $('#T_Sub_Total').val(),
          T_Total : $('#T_Total').val(),
          anticipos: {},
          pocme: {},
          pocmeDelete: {}
        }

        $( ".elemento-pocme" ).each(function(i) {
          $activado = $(this).find('.check').prop('checked');
          if( $activado == true ){ $valResp = 1; }else{ $valResp = 0; }
          var parsed_data = {
            idpartida: $(this).find('.id-partida').val(),
            cantidad: $(this).find('.cantidad').val(),
            idcuenta: $(this).find('.id-cuenta').val(),
            idconcepto: $(this).find('.id-concepto').val(),
            concepto_esp: $(this).find('.concepto-espanol').val(),
            concepto_ing: $(this).find('.concepto-ingles').val(),
            descripcion: $(this).find('.descripcion').val(),
            check: $valResp,
            gasto: $(this).find('.gasto').val(),
            ganancia: $(this).find('.ganancia').val(),
            importe: $(this).find('.importe').val(),
            subtotal: $(this).find('.subtotal').val()
          }
          data.pocme[i] = parsed_data;
        });

        $( ".elemento-advance" ).each(function(i) {
          var parsed_data = {
            idpartida: $(this).find('.id-partida').val(),
            anticipo: $(this).find('.advanceNum').val(),
            importe: $(this).find('.advanceImporte').val()
          }
          data.anticipos[i] = parsed_data;
        });

        $( ".elemento-pocme-eliminar" ).each(function(i) {
          var parsed_data = {
            idpartida: $(this).find('.id-partida').val()
          }
          data.pocmeDelete[i] = parsed_data;
        });


        $.ajax({
          type: "POST",
          url: "/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_modificar.php",
          data: data,
          success: 	function(r){
            r = JSON.parse(r);
            if (r.code == 1) {
              console.log(data);
              console.log(r);
              folio = r.data;
              alertify.alert('Folio: '+folio, 'Actualizado correctamente' , function(){
                $('#guardar-ctaAme').prop('disabled',true);
                $('#print').show();
                $('#Btn_print_ctaAme').attr('onclick','ctaGastosAmeImprimir('+folio+')');
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


  $("#tbodyPOCME").on('click', '.eliminar-POCME-ame',function(e){
    $(this).closest("tr").hide();
    $(this).parents('tr')
      .removeClass('elemento-pocme')
      .addClass('elemento-pocme-eliminar');

    var subtotal = $(this).parents('tr').find('.T_POCME_SUBTOTALES');
        subtotal.removeClass('T_POCME_SUBTOTALES');

    var ganancia = $(this).parents('tr').find('.T_POCME_GANA');
        ganancia.removeClass('T_POCME_GANA');

    var gasto = $(this).parents('tr').find('.T_POCME_GASTO');
        gasto.removeClass('T_POCME_GASTO');

    Suma_POCME_ctaAme();
  });


});

function importe_POCME_ctaAme(){
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
      //console.log(subtotal);
  });
	Suma_POCME_ctaAme();
}

function agregarImporte_ctaAme(){
  tipoDocumento = $('#tipoDocumento').val();
	unidades = $('#T_no_calculo').val();
	cta =  $('#T_POCME_Cta').val();
  idConcepto = $('#T_POCME_idConcep').val();
	concepto = $('#T_POCME').val();
	concepto_eng = $('#T_POCME_Eng').val();
	importe = $('#T_POCME_Valor').val();
	total =  cortarDecimales(CalcMUL(unidades,importe),2);

  //$oRst_permisos
  txt_verGstoGana = '';
  verGstoGana = $('#cta_ame_verGstoGana').val();
  if( verGstoGana == 0 ){
    txt_verGstoGana = "style='display:none'";
  }
  txt_editGstoGana = '';
  txt_editGstoGana_check = '';
  editGstoGana = $('#cta_ame_editGstoGana').val();
  if( editGstoGana == 0 ){
    txt_editGstoGana = 'readOnly';
    txt_editGstoGana_check = 'disabled';
  }


  if( cta == "" ){
    alertify.success('Seleccione un concepto');
  }else {
      if(tipoDocumento == 'elaborar'){
        btnEliminar = "<a href='#' class='remove-POCME'><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>";
        inputcuenta = "";
      }
      if(tipoDocumento == 'modificar'){
        btnEliminar = "<a href='#' class='eliminar-POCME-ame'><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>";
        inputPartida = "<input class='id-partida' type='hidden' id='T_partida_' value='0'>";
      }

      var element = $('.T_POCME_CONCEPTOS').length;

// en la linea 588 solo agregue la clase justify-content-center para centrar los inputs
      newtr = "<tr class='row m-0 trPOCME elemento-pocme justify-content-center' id='"+element+"'>";
      newtr = newtr + "    <td class='col-md-1 p-2'>";
      newtr = newtr + inputPartida;
      newtr = newtr + "        <input type='text' id='T_POCME_Cantidad"+element+"' class='T_POCME_CANTIDAD cantidad efecto h22' onblur='validaSoloNumeros(this);importe_POCME_ctaAme();' size='4'/>";
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

      newtr = newtr + "      <td class='pt-2 mt-2' "+txt_verGstoGana+">";
      newtr = newtr + "        <input type='checkbox' class='check' "+txt_editGstoGana_check+">";
      newtr = newtr + "      </td>";

      newtr = newtr + "      <td class='col-md-1 p-2 text-left' id='spend_ctaAme' "+txt_verGstoGana+">";
      newtr = newtr + "        <input type='text' class='efecto h22 T_POCME_GASTO gasto' name='T_POCME_gasto_$idFila' value='0.00' onblur='validaIntDec(this);gasto_POCME()' "+txt_editGstoGana+">";
      newtr = newtr + "      </td>";

      newtr = newtr + "      <td class='col-md-1 p-2 text-left' id='gain_ctaAme' "+txt_verGstoGana+">";
      newtr = newtr + "        <input type='text' class='efecto h22 T_POCME_GANA ganancia' name='T_POCME_gana_$idFila' value='0.00' onblur='validaIntDec(this);gana_POCME()' "+txt_editGstoGana+">";
      newtr = newtr + "      </td>";


      newtr = newtr + "      <td class='col-md-1 p-2'>";
      newtr = newtr + "        <input type='text' id='T_POCME_Importe"+element+"' class='T_POCME_IMPORTES importe efecto h22' onblur='validaIntDec(this);validaDescImporte(1,"+element+");importe_POCME_ctaAme();cortarDecimalesObj(this,2);' size='17' >";
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
        Suma_POCME_ctaAme();
      });

      var element = $('.T_POCME_CONCEPTOS').length;
      $( ".T_POCME_CONCEPTOS" ).each(function( x ) {
    	  if( $('.T_POCME_CONCEPTOS').eq(x).val() == "" ){

          $('.T_POCME_CUENTAS').eq(x).val(cta);
          $('.T_POCME_idCONCEPTOS').eq(x).val(idConcepto);
          $('.T_POCME_CONCEPTOS').eq(x).val(concepto).attr('value',concepto);
          $('.T_POCME_CONCEPTOS_ENG').eq(x).val(concepto_eng).attr('value',concepto_eng);

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
      		  $('.T_POCME_CANTIDAD').eq(x).val(unidades).attr('value',unidades);
      		  $('.T_POCME_IMPORTES').eq(x).val(importe).attr('value',importe);
      		  $('.T_POCME_SUBTOTALES').eq(x).val(total).attr('value',total);
      		}

    		  $('#Lst_tarifa_cliente').val(0);
    			$('#Lst_tarifa_general').val(0);
    			$('#T_no_calculo').val("");
          $('#T_POCME_Cta').val("");
          $('#T_POCME_idConcep').val("");
    			$('#T_POCME').val("");
    			$('#T_POCME_Eng').val("");
    			$('#T_POCME_Valor').val("");
    			Suma_POCME_ctaAme();

    		  return false;
    	  }
      });

    }
}

function gasto_POCME(){
  Suma_gastoTotales = 0;
  $( ".T_POCME_GASTO" ).each(function( x ) {
    importe = $(this).val();
    if( importe == "" ){ importe = 0; }
    Suma_gastoTotales = cortarDecimales(CalcADD(Suma_gastoTotales,importe),2);
  });
  $('#T_gasto_Total').val(Suma_gastoTotales).attr('value',importe);
}

function gana_POCME(){
  Suma_ganaTotales = 0;
  $( ".T_POCME_GANA" ).each(function( x ) {
    importe = $(this).val();
    if( importe == "" ){ importe = 0; }
    Suma_ganaTotales = cortarDecimales(CalcADD(Suma_ganaTotales,importe),2);
  });
  $('#T_gana_Total').val(Suma_ganaTotales).attr('value',importe);
}


function Suma_POCME_ctaAme(){
  Suma_subTotales = 0;
  Suma_Anticipos = 0;
  Total = 0;

  $( ".T_POCME_SUBTOTALES" ).each(function( x ) {
      subtotal = $(this).val();

      if( subtotal == "" ){
        subtotal = 0;
      }
      if( subtotal == 0 ){
        alertify.success('Todos los conceptos deben tener un importe');
        $('.importe').eq(x).css('background-color','#F2F5A9')
      }
      if( subtotal > 0 ){
        $('.importe').eq(x).css('background-color','#FFFFFF')
      }
      Suma_subTotales = cortarDecimales(CalcADD(Suma_subTotales,subtotal),2);
  });

  $('#T_Sub_Total').val(Suma_subTotales).attr('value',Suma_subTotales);

  ant1 = $('#T_Advance1_Total').val();
  ant2 = $('#T_Advance2_Total').val();
  Suma_Anticipos = cortarDecimales(CalcADD(Suma_Anticipos,ant1),2);
  Suma_Anticipos = cortarDecimales(CalcADD(Suma_Anticipos,ant2),2);
  Suma_Saldo = cortarDecimales(CalcSUB(Suma_subTotales,Suma_Anticipos),2)
  Suma_Saldo = parseFloat(Suma_Saldo).toFixed(2);
  $('#T_Total').val(Suma_Saldo).attr('value',Suma_Saldo);

  gasto_POCME();
  gana_POCME();
}

function ctaGastosAmeImprimir(cuenta){
  window.open('CuentaGastos_imprimir.php?cuenta='+cuenta);
}

function ctaGastosAmeModificar(cuenta){
  window.location.replace('/Ubicaciones/CuentasAmericanas/CuentaGastos/CuentaGastos_modificar.php?cuenta='+cuenta);
}

function ctaGastosAmeConsultar(cuenta){
  window.location.replace('/Ubicaciones/CuentasAmericanas/CuentaGastos/CuentaGastos_consultar.php?cuenta='+cuenta);
}


function ctaGastosAmeBorrar(cuenta){
  swal({
  title: "Estas Seguro?",
  text: "Ya no se podra recuperar el registro! "+ cuenta +" ",
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
        cuenta: cuenta
      }
      $.ajax({
        type: "POST",
        url: "/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_eliminar.php",
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

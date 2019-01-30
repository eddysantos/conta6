$(document).ready(function(){
  $('.pgos').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    switch (accion) {
      case "Ver-cliente":
      if (status == 'cerrado') {
        $('#detalleCliente').fadeIn();
        $(this).attr('status', 'abierto').addClass('subrojo');
      } else {
        $('#detalleCliente').fadeOut();
        $(this).attr('status', 'cerrado').removeClass('subrojo');
      }
        break;

      case "datinfo":
      if (status == 'cerrado') {
        $('#InfoPagos').fadeIn();
        $(this).attr('status', 'abierto').addClass('subrojo');
      } else {
        $('#InfoPagos').fadeOut();
        $(this).attr('status', 'cerrado').removeClass('subrojo');
      }
        break;

      case "folio":
      if (status == 'cerrado') {
        $('#folioSustituir').fadeIn();
        $(this).attr('status', 'abierto').addClass('subrojo');
      } else {
        $('#folioSustituir').fadeOut();
        $(this).attr('status', 'cerrado').removeClass('subrojo');
      }
        break;

      case "pgos-factura":
      if (status == 'cerrado') {
        $('#pagosMismaFact').fadeIn();
        $(this).attr('status', 'abierto').addClass('subrojo');
      } else {
        $('#pagosMismaFact').fadeOut();
        $(this).attr('status', 'cerrado').removeClass('subrojo');
      }
        break;

      default:
        console.error("Something went terribly wrong...");
    }
  });

  $('#b-facturasPagos').click(function(){
    bRef = $('#bRef').val();

    if( bRef == ""){
      alertify.error("asigne una factura");
      $('#bRef').focus();
      return false;
    }

    window.location.replace('pagos_buscar.php?bRef='+bRef+'&accion=facturas');
  });

  $('#b-pagos').click(function(){
    bRef = $('#bRef').val();

    if( bRef == ""){
      alertify.error("asigne una folio de captura");
      $('#bRef').focus();
      return false;
    }

    window.location.replace('pagos_buscar.php?bRef='+bRef+'&accion=pagosCaptura');
  });

  $('#b-pagosElect').click(function(){
    bRef = $('#bRef').val();

    if( bRef == ""){
      alertify.error("asigne una pago electrónico");
      $('#bRef').focus();
      return false;
    }

    window.location.replace('pagos_buscar.php?bRef='+bRef+'&accion=pagosElect');
  });


  $('#btn_buscarFactura_pagos').click(function(){

    cadena = $('#pagos-factura').attr('db-id');
    parteCadena = cadena.split("+");
    id_aduana = parteCadena[0];
    referencia = parteCadena[1];
    UUID = parteCadena[2];
    id_factura = parteCadena[3];
    moneda = parteCadena[4];
    tipoCambio = parteCadena[5];
    metodoPago = parteCadena[6];
    total_gral = parteCadena[7];
    id_cliente = parteCadena[8];

    clientePago = $('#T_ID_Cliente_Oculto').val();
    if( id_cliente != clientePago ){
      $('#pagos-factura').attr('db-id','').val('');
      swal("Error", "La factura no pertenece al mismo cliente", "error");
      return false;
    }


    $('#aduana_DR').val(id_aduana);
    $('#referencia_DR').val(referencia);
    $('#UUID_DR').val(UUID);
    $('#factura_DR').val(id_factura);
    $('#moneda_DR').val(moneda);
    $('#tipoCambio_DR').val(tipoCambio);
    $('#totalHon_DR').val(total_gral);
    $('#metPago_DR').val(metodoPago);
    //$('#parcialidad').val(0);

    buscarParcSalInsoluto(id_factura);
      parcialidad = $('#pagos-factura-parcialidad').attr('value');
      saldoAnterior = $('#pagos-factura-saldoAnterior').attr('value');
      if( parcialidad == 1 ){ saldoAnterior = total_gral; }
      $('#parcialidad').val(parcialidad);
      $('#T_saldoAnterior').val(saldoAnterior);

      // console.log(parcialidad);
      // console.log(saldoAnterior);

    //$('#buscar_factura').hide(); //ocultar modal


  });

  $('#guardar-pago').click(function(){
    var element = $('.t-factura').length;
    if( element == 0 ){
      swal("Error", "Agregue detalle", "error");
      return false;
    }

    var data = {
      pagos: {},
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
      idPago_sust : $('#idPago_sust').val(),
      uuid_sust : $('#uuid_sust').val(),
      tipoRel_sust : $('#tipoRel_sust').val()
    }

    $( ".elemento-pagos" ).each(function(i) {
      var parsed_data = {
        aduanaDR: $(this).find('.t-aduanaDR').val(),
        referenciaDR: $(this).find('.t-referencia').val(),
        uuidDR: $(this).find('.t-uuid').val(),
        facturaDR: $(this).find('.t-factura').val(),
        monedaDR: $(this).find('.t-monedaDR').val(),
        totalDR: $(this).find('.t-total').val(),
        metPagoDR: $(this).find('.t-metodoPagoDR').val(),
        tipoCambioDR: $(this).find('.t-tipoCambioDR').val(),
        parcialidad: $(this).find('.t-parcialidad').val(),
        fecha: $(this).find('.t-fecha').val(),
        formaPago: $(this).find('.t-formaPago').val(),
        operacion: $(this).find('.t-operacion').val(),
        moneda: $(this).find('.t-moneda').val(),
        tipoCambio: $(this).find('.t-tipoCambio').val(),
        importe: $(this).find('.t-importe').val(),
        iva: $(this).find('.t-iva').val(),
        deposito: $(this).find('.t-deposito').val(),
        rfcE: $(this).find('.t-rfcE').val(),
        ctaE: $(this).find('.t-ctaE').val(),
        bcoExt: $(this).find('.t-bcoExt').val(),
        rfcR: $(this).find('.t-rfcR').val(),
        ctaR: $(this).find('.t-ctaR').val(),
        tipoCadena: $(this).find('.t-tipoCadena').val(),
        certificado: $(this).find('.t-certificado').val(),
        cadenaOrig: $(this).find('.t-cadenaOrig').val(),
        sello: $(this).find('.t-sello').val(),
        saldoAnterior: $(this).find('.t-saldoAnterior').val(),
        pagado: $(this).find('.t-pagado').val(),
        saldoInsoluto: $(this).find('.t-saldoInsoluto').val()
      }
      data.pagos[i] = parsed_data;
    });

    console.log(data);

    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/Pagos/actions/pagos_agregar.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        console.log(r);
        if (r.code == 1) {
          folio = r.data;
          alertify.alert('Folio: '+folio, 'Generado correctamente' , function(){
          setTimeout("window.location.replace('/conta6/Ubicaciones/Contabilidad/Pagos/Pagos.php')",700);
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










});


function pagosGenerar(cuenta,id_cliente){
  window.location.replace('pagos_generar.php?cuenta='+cuenta+'&id_cliente='+id_cliente);
}

function pagosModificar(cuenta,id_cliente){
  window.location.replace('pagos_modificar.php?cuenta='+cuenta+'&id_cliente='+id_cliente);
}

function pagosConsultar(cuenta,id_cliente){
  window.location.replace('pagos_consultar.php?cuenta='+cuenta+'&id_cliente='+id_cliente+'&accion=consulta');
}

function pagosTimbrar(cuenta,id_cliente){
  window.location.replace('pagos_consultar.php?cuenta='+cuenta+'&id_cliente='+id_cliente+'&accion=timbrar');
}

function pagosImprimir(cuenta){
  window.open('pagos_imprimir_reciboCaptura.php?cuenta='+cuenta+'&accion=consulta');
}

function asignarMonedaPago(){
		moneda = $('#lst_moneda').val();

		if( moneda == 'MXN' ){
			$('#T_monedaTipoCambio').val('1')
                              .attr('value','1')
			                        .prop('readOnly',true)
			                        .css('background-color','#DCDCDC');
		}else{
			$('#T_monedaTipoCambio').prop('readOnly',false)
			                        .css('background-color','#FFFFFF');
		}
}

function calculaDepIVA(){
  importe = $('#T_importePagado').val();
  deposito = cortarDecimales( cortarDecimales(importe,2) / 1.16 ,2);
  ivaDep = cortarDecimales(CalcSUB(importe,deposito) ,2); //resta

  $('#T_deposito').val(deposito);
  $('#T_iva').val(ivaDep);
  //$('#T_importePagado').val(importe);

  //id_cliente = $('#T_ID_Cliente_Oculto').val();
  suma_saldoInsoluto();
  //buscarNumeroCuentaBanco(id_cliente);
}

function suma_saldoInsoluto(){
    saldoAnterior = $('#T_saldoAnterior').val();
    importePagado = $('#T_importe').val();
		saldoInsoluto = cortarDecimales(CalcSUB( saldoAnterior , importePagado ),2);
		$('#T_saldoInsoluto').val( Math.abs(saldoInsoluto) );
}

function valFecha(){
  fecha = $('#fecha').val();
  if( fecha == "" ){
    alertify.error("Fecha es requerido");
    $('#fecha').focus();
    return false;
  }else{
    return true;
  }
}

function valFormaPago(){
  formaPago = $('#Lst_formaPago').val();
  if( formaPago == "" ){
    alertify.error("Forma de Pago es requerido");
    $('#Lst_formaPago').focus();
    return false;
  }else{
    return true;
  }
}

function valMoneda(){
  moneda = $('#lst_moneda').val();
  tipoCambio = $('#T_monedaTipoCambio').val();
  if( moneda == "" ){
    alertify.error("Moneda es requerido");
    $('#lst_moneda').focus();
    return false;
  }else{
    if( moneda != "MXN" && tipoCambio == "" ){
      alertify.error("Tipo Cambio es requerido");
      $('#T_monedaTipoCambio').focus();
       return false;
     }else{
       return true;
     }
   }
}

function valImporte(){
  importe = $('#T_importe').val();
  if( importe == "" || importe == 0 ){
    alertify.error("Importe es requerido");
    $('#T_importe').focus();
    return false;
  }else{
    return true;
  }
}

function valrfcOrd(){
  rfcOrd = $('#T_RFCemisor').val();
  nomBancoOrdExt = $('#Txt_nomBancoExt').val();
  if( rfcOrd == "XEXX010101000" && nomBancoOrdExt == "" ){
    alertify.error("Nombre del Banco es requerido");
    $('#Txt_nomBancoExt').focus();
    return false;
  }else{
    return true;
  }
}

function Btn_agregarPago(){
  tipoDocumento = $('#tipoDocumento').val();
  aduana_DR = $('#aduana_DR').val();
  referencia_DR = $('#referencia_DR').val();
  UUID_DR = $('#UUID_DR').val();
  factura_DR = $('#factura_DR').val();
  moneda_DR = $('#moneda_DR').val();
  tipoCambio_DR = $('#tipoCambio_DR').val();
  totalHon_DR = $('#totalHon_DR').val();
  metPago_DR = $('#metPago_DR').val();
  parcialidad = $('#parcialidad').val();

  fecha = $('#fecha').val();
  hora = $('#hora').val();
    if( hora == "" || hora == "00:00" ){ hora = "12:00"; }
    fechaHora = fecha+" "+hora;

  formaPago = $('#Lst_formaPago').val();
  numOper = $('#Txt_numOper').val();
  moneda = $('#lst_moneda').val();
  tipoCambio = $('#T_monedaTipoCambio').val();
  importe = $('#T_importe').val();
  iva = $('#T_iva').val();
  deposito = $('#T_deposito').val();
  rfcE = $('#T_RFCemisor').val();

  cadena = $('#Lst_cuentaPago').val();
    parteCadena = cadena.split("+");
    cuentaPago = parteCadena[1];

  bcoExt = $('#T_nomBancoExt').val();
  rfcR = $('#T_RFCreceptor').val();
  bcoCIA = $('#lst_bancoCIA').val();
  tipoCadena = $('#Lst_tipoCadena').val();
  cert = $('#Txt_cert').val();
  cadenaOrig = $('#Txt_cadOrig').val();
  sello = $('#Txt_sello').val();
  salAnt = $('#T_saldoAnterior').val();
  impPago = $('#T_importePagado').val();
  salInsoluto = $('#T_saldoInsoluto').val();

  //if( valFecha()== true && valFormaPago()==true && valMoneda()==true && valImporte()==true ){
    //valrfcOrd();

      importe = $('#T_importe').val();
      totalHon = $('#totalHon_DR').val();

      // if( parseFloat(importe) >  parseFloat(totalHon)  ){
      //  alertify.error("El pago debe ser menor o igual al total de honorarios");
      // }else{

        if(tipoDocumento == 'elaborar'){
          btnEliminar = " <a href='#' class='remove-Pagos'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
          inputPartida = "";
        }
        if(tipoDocumento == 'modificar'){
          btnEliminar = "<a href='#' class='eliminar-Honorarios'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
          inputPartida = "<input class='id-partida' type='hidden' id='T_partida_' value='0'>";
        }

        var element = $('.t-factura').length;

        // newtr = "<tr class='row m-0 font12 elemento-pagos borderojo remove_"+element+"'' id='"+element+"'>";
        //   newtr = newtr + " <td class='col-md-1 text-right p-2 b'><b>Tipo Cadena:</b> </td>";
        //   newtr = newtr + " <td class='col-md-3 p-1'> <input class='h22 text-left t-tipoCadena efecto border-0 bt' type='text' id='tipoCadena_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'><b> Cuenta Emisor:</b> </td>";
        //   newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-ctaE' type='text' id='ctaE_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'><b> Fecha: </b></td>";
        //   newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-fecha' type='text' id='fecha_"+element+"' readonly>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //   newtr = newtr + " <td class='p-1'>";
        //   newtr = newtr + btnEliminar;
        //   newtr = newtr + " </td>";
        //
        //   newtr = newtr + " <td class='col-md-1 text-right p-2 b'><b> Certificado: </b></td>";
        //   newtr = newtr + " <td class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-certificado' type='text' id='certificado_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'><b> Banco Ext.: </b></td>";
        //   newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-bcoExt' type='text' id='bcoExt_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'><b> Forma Pago:</b> </td>";
        //   newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-formaPago' type='text' id='formaPago_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //
        //   newtr = newtr + " <td class='col-md-1 text-right p-2 b'><b> Cadena Original:</b> </td>";
        //   newtr = newtr + " <td class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-cadenaOrig' type='text' id='cadenaOrig_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'> <b>Cta Receptor:</b> </td>";
        //   newtr = newtr + " <td class='col-md-2 p-1 mb-3'> <input class='h22 efecto border-0 bt text-left t-ctaR' type='text' id='ctaR_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'><b> # Autorización:</b></td>";
        //   newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-operacion' type='text' id='operacion_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //
        //   newtr = newtr + " <td class='col-md-1 text-right p-2 b'><b> Sello:</b></td>";
        //   newtr = newtr + " <td class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-sello' type='text' id='sello_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1'> <input class=' t-rfcE' type='hidden' id='rfcE_"+element+"'></td>";
        //   newtr = newtr + " <td class='col-md-1'> <input class=' t-rfcR' type='hidden' id='rfcR_"+element+"'></td>";
        //   newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-4'><b> Importe: </b></td>";
        //   newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-importe' type='text' id='importe_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //
        //   newtr = newtr + " <td class='p-1'></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //
        //   newtr = newtr + " <td class='p-1'>REf.</td>";
        //   newtr = newtr + " <td class='p-1'>Fac.</td>";
        //   newtr = newtr + " <td class='p-1'>Parc.</td>";
        //   newtr = newtr + " <td class='p-1'>S. Anterior</td>";
        //   newtr = newtr + " <td class='p-1'>Imp. Pagado</td>";
        //   newtr = newtr + " <td class='p-1'>IVA</td>";
        //   newtr = newtr + " <td class='p-1'>S.Insoluto</td>";
        //   newtr = newtr + " <td class='p-1'></td>";
        //
        //   newtr = newtr + " <td class='col-md-1 ml-2'> <input class=' t-referencia' type='text' id='referencia_"+element+"'></td>";
        //   newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-factura' type='text' id='factura_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-parcialidad' type='text' id='parcialidad_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-saldoAnterior' type='text' id='saldoAnterior_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-pagado' type='text' id='pagado_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-iva' type='text' id='iva_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-saldoInsoluto' type='text' id='saldoInsoluto_"+element+"' readonly></td>";
        //   newtr = newtr + " <td class='p-1'>";
        //
        //   newtr = newtr + " <input class='h22 efecto border-0 bt text-left t-tipoCambio' type='hidden' id='tipoCambio_"+element+"' readonly>";
        //   newtr = newtr + " <input type='hidden' class='h22 efecto border-0 bt text-left t-monedaDR' id='monedaDR_&quot;+element+&quot;' readonly />";
        //   newtr = newtr + " <input class='h22 efecto border-0 bt text-left t-uuid' type='hidden' id='uuid_"+element+"' readonly>";
        //   newtr = newtr + " <input name='text' type='hidden' class='h22 efecto border-0 bt text-left t-total' id='total_"+element+"' readonly />";
        //   newtr = newtr + " <input class=' t-tipoCambioDR' type='hidden' id='tipoCambioDR_"+element+"'>";
        //   newtr = newtr + " <input class=' t-moneda' type='hidden' id='moneda_"+element+"'><input class=' t-deposito' type='hidden' id='deposito_"+element+"'>";
        //   newtr = newtr + " <input class=' t-metodoPagoDR' type='hidden' id='metodoPagoDR_"+element+"'><input class=' t-aduanaDR' type='hidden' id='aduanaDR_"+element+"'>";
        //   newtr = newtr + " </td>";
        //
        // newtr = newtr + "</tr> ";



        newdiv = "<div class='row m-0 font12 elemento-pagos remove_"+element+"'' id='"+element+"'>";
          newdiv = newdiv + " <div class='col-md-1 text-right p-2 b'><b>Tipo Cadena:</b> </div>";
          newdiv = newdiv + " <div class='col-md-3 p-1'><input class='h22 efecto text-left t-tipoCadena border-0 bt' type='text' id='tipoCadena_"+element+"' readonly></div>";
          newdiv = newdiv + " <div class='col-md-1 text-right p-2 b'><b> Cuenta Emisor:</b> </div>";
          newdiv = newdiv + " <div class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-ctaE' type='text' id='ctaE_"+element+"' readonly></div>";
          newdiv = newdiv + " <div class='col-md-1 text-right p-2 b'><b> Fecha: </b></div>";
          newdiv = newdiv + " <div class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-fecha' type='text' id='fecha_"+element+"' readonly></div>";
          newdiv = newdiv + " <div class='col-md-1 p-1'>";
          newdiv = newdiv + btnEliminar;
          newdiv = newdiv + " </div>";

          newdiv = newdiv + " <div class='col-md-1 text-right p-2 b'><b> Certificado: </b></div>";
          newdiv = newdiv + " <div class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-certificado' type='text' id='certificado_"+element+"' readonly></div>";
          newdiv = newdiv + " <div class='col-md-1 text-right p-2 b'><b> Banco Ext.: </b></div>";
          newdiv = newdiv + " <div class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-bcoExt' type='text' id='bcoExt_"+element+"' readonly></div>";
          newdiv = newdiv + " <div class='col-md-1 text-right p-2 b'><b> Forma Pago:</b> </div>";
          newdiv = newdiv + " <div class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-formaPago' type='text' id='formaPago_"+element+"' readonly></div>";
          newdiv = newdiv + " <div class='col-md-1'></div>";



          newdiv = newdiv + " <div class='col-md-1 text-right p-2 b'><b> Cadena Original:</b> </div>";
          newdiv = newdiv + " <div class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-cadenaOrig' type='text' id='cadenaOrig_"+element+"' readonly></div>";
          newdiv = newdiv + " <div class='col-md-1 text-right p-2 b'> <b>Cta Receptor:</b> </div>";
          newdiv = newdiv + " <div class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-ctaR' type='text' id='ctaR_"+element+"' readonly></div>";
          newdiv = newdiv + " <div class='col-md-1 text-right p-2 b'><b> # Autorización:</b></div>";
          newdiv = newdiv + " <div class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-operacion' type='text' id='operacion_"+element+"' readonly></div>";
          newdiv = newdiv + " <div class='col-md-1'></div>";


          newdiv = newdiv + " <div class='col-md-1 text-right p-2 b'><b> Sello:</b></div>";
          newdiv = newdiv + " <div class='col-md-3 p-1'><input class='h22 efecto border-0 bt text-left t-sello' type='text' id='sello_"+element+"' readonly></div>";
          newdiv = newdiv + " <div class='col-md-1'> <input class=' t-rfcE' type='hidden' id='rfcE_"+element+"'></div>";
          newdiv = newdiv + " <div class='col-md-3'> <input class=' t-rfcR' type='hidden' id='rfcR_"+element+"'></div>";
          newdiv = newdiv + " <div class='col-md-1 text-right p-2 b'><b> Importe: </b></div>";
          newdiv = newdiv + " <div class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-importe' type='text' id='importe_"+element+"' readonly></div>";
          newdiv = newdiv + " <div class='col-md-1 p-1'></div>";
        newdiv = newdiv + " </div>"; //termino del registro pago





        newtr = "<tr class='row m-0 font12 elemento-pagos borderojo remove_"+element+"'' id='"+element+"'>";
          newtr = newtr + " <td class='col-md-2 p-1'> <input class='efecto h22 border-0 bt t-referencia' type='text' id='referencia_"+element+"'></td>";
          newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt t-factura' type='text' id='factura_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt t-parcialidad' type='text' id='parcialidad_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt t-saldoAnterior' type='text' id='saldoAnterior_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt t-pagado' type='text' id='pagado_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt t-iva' type='text' id='iva_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt t-saldoInsoluto' type='text' id='saldoInsoluto_"+element+"' readonly></td>";
          // newtr = newtr + " <td class='p-1'>";

          newtr = newtr + " <input class='h22 efecto border-0 bt text-left t-tipoCambio' type='hidden' id='tipoCambio_"+element+"' readonly>";
          newtr = newtr + " <input type='hidden' class='h22 efecto border-0 bt text-left t-monedaDR' id='monedaDR_&quot;+element+&quot;' readonly />";
          newtr = newtr + " <input class='h22 efecto border-0 bt text-left t-uuid' type='hidden' id='uuid_"+element+"' readonly>";
          newtr = newtr + " <input name='text' type='hidden' class='h22 efecto border-0 bt text-left t-total' id='total_"+element+"' readonly />";
          newtr = newtr + " <input class=' t-tipoCambioDR' type='hidden' id='tipoCambioDR_"+element+"'>";
          newtr = newtr + " <input class=' t-moneda' type='hidden' id='moneda_"+element+"'><input class=' t-deposito' type='hidden' id='deposito_"+element+"'>";
          newtr = newtr + " <input class=' t-metodoPagoDR' type='hidden' id='metodoPagoDR_"+element+"'><input class=' t-aduanaDR' type='hidden' id='aduanaDR_"+element+"'>";
          newtr = newtr + "</td>";
        newtr = newtr + "</tr> ";

        // $('#tbodyPagos').append(newtr);

        $('#tbodyPagos').append(newdiv);
        $('#tbodyPagosDesglose').append(newtr);

        // $(".remove-Pagos").click(function(e){
        //   $(this).closest("tr").remove();
        //   alertify.success('Se elimino correctamente');
        // });

        $(".remove-Pagos").click(function(e){
          $(this).closest(".row").remove();
          alertify.success('Se elimino correctamente');
        });

        var element = $('.t-factura').length;
        $( ".t-factura" ).each(function( x ) {
          if( $('.t-factura').eq(x).val() == "" ){

            $('.t-aduanaDR').eq(x).val(aduana_DR);
            $('.t-referencia').eq(x).val(referencia_DR);
            $('.t-uuid').eq(x).val(UUID_DR);
            $('.t-factura').eq(x).val(factura_DR);
            $('.t-monedaDR').eq(x).val(moneda_DR);
            $('.t-tipoCambioDR').eq(x).val(tipoCambio_DR);
            $('.t-total').eq(x).val(totalHon_DR);
            $('.t-metodoPagoDR').eq(x).val(metPago_DR);
            $('.t-parcialidad').eq(x).val(parcialidad);
            $('.t-fecha').eq(x).val(fechaHora);
            $('.t-formaPago').eq(x).val(formaPago);
            $('.t-operacion').eq(x).val(numOper);
            $('.t-moneda').eq(x).val(moneda);
            $('.t-tipoCambio').eq(x).val(tipoCambio);
            $('.t-importe').eq(x).val(importe);
            $('.t-iva').eq(x).val(iva);
            $('.t-deposito').eq(x).val(deposito);
            $('.t-rfcE').eq(x).val(rfcE);
            $('.t-ctaE').eq(x).val(cuentaPago);
            $('.t-bcoExt').eq(x).val(bcoExt);
            $('.t-rfcR').eq(x).val(rfcR);
            $('.t-ctaR').eq(x).val(bcoCIA);
            $('.t-tipoCadena').eq(x).val(tipoCadena);
            $('.t-certificado').eq(x).val(cert);
            $('.t-cadenaOrig').eq(x).val(cadenaOrig);
            $('.t-sello').eq(x).val(sello);
            $('.t-saldoAnterior').eq(x).val(salAnt);
            $('.t-pagado').eq(x).val(impPago);
            $('.t-saldoInsoluto').eq(x).val(salInsoluto);

             $('#T_saldoAnterior').val(salInsoluto);
            return false;
          }
        });

        parcialidad = parseInt(parcialidad) + parseInt(1);
        $('#parcialidad').val(parcialidad);

  //}
}

function buscarParcSalInsoluto(id_factura){
  var data = {
    id_cliente: id_factura
  }

  $.ajax({
    type: "POST",
    url: "/conta6/Ubicaciones/Contabilidad/Pagos/actions/pagos_buscarUltimaParcialidad.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        console.log(r.data);
        cadena2 = r.data;
        parteCadena2 = cadena2.split("+");
        parcialidad = parteCadena2[0];
        saldoAnterior = parteCadena2[1];
        $('#pagos-factura-parcialidad').val(parcialidad).attr('value',parcialidad);
        $('#pagos-factura-saldoAnterior').val(saldoAnterior).attr('value',saldoAnterior);
      } else {
        console.error(r.message);
      }
    },
    error: function(x){
      console.error(x);
    }
  });
}

function pagosCapturaEliminar(partida){
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
        url: "/conta6/Ubicaciones/Contabilidad/Pagos/actions/pagos_eliminar.php",
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

function timbrarPago(cuenta,referencia,cliente){
  var data = {
    cuenta: cuenta,
    referencia: referencia,
    cliente: cliente
  }

  $.ajax({
    type: "POST",
    url: "/conta6/Ubicaciones/Contabilidad/Pagos/actions/generarCFDI_pago.php",
    data: data,
    beforeSend: function(){
        $('body').append('<div class="overlay"><div class="overlay-loading">Timbrando Pago ... Porfavor espere.</div></div>');
    },

      success: 	function(r){
        r = JSON.parse(r);
        console.log(r);
        if (r.code == 1) {
          //$('#respTimbrado').val(r);
          resp = r.message;
          $('.overlay').remove();

          swal({
            title: 'Timbrar Pago',
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

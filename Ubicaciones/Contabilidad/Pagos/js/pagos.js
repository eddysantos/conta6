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

    window.location.replace('pagos_buscar.php?bRef='+bRef);

  });
});


function pagosGenerar(cuenta,id_cliente){
  window.location.replace('pagos_generar.php?cuenta='+cuenta+'&id_cliente='+id_cliente);
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
  importe = $('#T_importe').val();
  deposito = cortarDecimales( cortarDecimales(importe,2) / 1.16 ,2);
  ivaDep = cortarDecimales(CalcSUB(importe,deposito) ,2); //resta

  $('#T_deposito').val(deposito);
  $('#T_iva').val(ivaDep);
  $('#T_importePagado').val(importe);

  id_cliente = $('#T_ID_Cliente_Oculto').val();
  suma_saldoInsoluto();
  buscarNumeroCuentaBanco(id_cliente);
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
  metPago_DR = $('#metPago_D').val();
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

      if( parseFloat(importe) >  parseFloat(totalHon)  ){
       alertify.error("El pago debe ser menor o igual al total de honorarios");
      }else{

        if(tipoDocumento == 'elaborar'){
          btnEliminar = " <a href='#' class='remove-Pagos'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
          inputPartida = "";
        }
        if(tipoDocumento == 'modificar'){
          btnEliminar = "<a href='#' class='eliminar-Honorarios'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
          inputPartida = "<input class='id-partida' type='hidden' id='T_partida_' value='0'>";
        }

        var element = $('.t-factura').length;

        newtr = "<tr class='row m-0 font12 elemento-pagos borderojo remove_"+element+"'' id='"+element+"'>";
        //newtr = newtr + "<table><tr>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b'><b>Tipo Cadena:</b> </td>";
          newtr = newtr + " <td class='col-md-3 p-1'> <input class='h22 text-left t-tipoCadena efecto border-0 bt' type='text' id='tipoCadena_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-2'><b> Parcialidad: </b> </td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-parcialidad' type='text' id='parcialidad_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-4'><b> Importe: </b></td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-importe' type='text' id='importe_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'><b> Fecha: </b></td>";
          newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-fecha' type='text' id='fecha_"+element+"' readonly>";
          newtr = newtr + " <td class='p-1'>";
          newtr = newtr + btnEliminar;
          newtr = newtr + " </td>";
        // newtr = newtr + " </tr>";
        // newtr = newtr + " <tr class='row m-0 elemento-pagos remove_"+element+"'' id='"+element+"'>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b'><b> Certificado: </b></td>";
          newtr = newtr + " <td class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-certificado' type='text' id='certificado_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-2'><b> Factura: </b></td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-factura' type='text' id='factura_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-4'><b> IVA: </b></td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-iva' type='text' id='iva_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'><b> Forma Pago:</b> </td>";
          newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-formaPago' type='text' id='formaPago_"+element+"' readonly></td>";
          newtr = newtr + " <td class='p-1'></td>";

        // newtr = newtr + " </tr>";
        // newtr = newtr + " <tr class='row m-0 elemento-pagos remove_"+element+"'' id='"+element+"'>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b'><b> Cadena Original:</b> </td>";
          newtr = newtr + " <td class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-cadenaOrig' type='text' id='cadenaOrig_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-2'><b> T. Cambio:</b> </td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-tipoCambio' type='text' id='tipoCambio_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-4'><b> Saldo Anterior:</b> </td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-saldoAnterior' type='text' id='saldoAnterior_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'><b> # Autorización:</b></td>";
          newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-operacion' type='text' id='operacion_"+element+"' readonly></td>";
          newtr = newtr + " <td class='p-1'></td>";

        // newtr = newtr + " </tr>";
        // newtr = newtr + " <tr class='row m-0 elemento-pagos remove_"+element+"'' id='"+element+"'>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b'><b> Sello:</b></td>";
          newtr = newtr + " <td class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-sello' type='text' id='sello_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-2'><b> Moneda:</b></td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input type='text' class='h22 efecto border-0 bt text-left t-monedaDR' id='monedaDR_&quot;+element+&quot;' readonly /></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-4'><b> Imp. Pagado:</b> </td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-pagado' type='text' id='pagado_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'><b> Cuenta Emisor:</b> </td>";
          newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-ctaE' type='text' id='ctaE_"+element+"' readonly></td>";
          newtr = newtr + " <td class='p-1'></td>";

        // newtr = newtr + " </tr>";
        // newtr = newtr + " <tr class='row m-0 elemento-pagos remove_"+element+"'' id='"+element+"'>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b'><b> UUID:</b></td>";
          newtr = newtr + " <td class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-uuid' type='text' id='uuid_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-2'><b> Total:</b></td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input name='text' type='text' class='h22 efecto border-0 bt text-left t-total' id='total_"+element+"' readonly /></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-4'><b> Saldo Insoluto:</b> </td>";
          newtr = newtr + " <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-saldoInsoluto' type='text' id='saldoInsoluto_"+element+"' readonly></td>";
          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'><b> Banco Ext.: </b></td>";
          newtr = newtr + " <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-bcoExt' type='text' id='bcoExt_"+element+"' readonly></td>";
          newtr = newtr + " <td class='p-1'></td>";


          newtr = newtr + " <td class='col-md-1'> <input class=' t-rfcE' type='hidden' id='rfcE_"+element+"'></td>";
          newtr = newtr + " <td class='col-md-3'> <input class=' t-rfcR' type='hidden' id='rfcR_"+element+"'></td>";
          newtr = newtr + " <td class='col-md-1 ml-2'> <input class=' t-referencia' type='hidden' id='referencia_"+element+"'></td>";
          newtr = newtr + " <td class='col-md-1'> <input class=' t-tipoCambioDR' type='hidden' id='tipoCambioDR_"+element+"'></td>";
          newtr = newtr + " <td class='col-md-1 ml-4'> <input class=' t-moneda' type='hidden' id='moneda_"+element+"'><input class=' t-deposito' type='hidden' id='deposito_"+element+"'></td>";
          newtr = newtr + " <td class='col-md-1'> <input class=' t-metodoPagoDR' type='hidden' id='metodoPagoDR_"+element+"'><input class=' t-aduanaDR' type='hidden' id='aduanaDR_"+element+"'></td>";

          newtr = newtr + " <td class='col-md-1 text-right p-2 b ml-5'> <b>Cta Receptor:</b> </td>";
          newtr = newtr + " <td class='col-md-2 p-1 mb-3'> <input class='h22 efecto border-0 bt text-left t-ctaR' type='text' id='ctaR_"+element+"' readonly></td>";

        // newtr = newtr + " </tr>";
        // newtr = newtr + " <tr class='row m-0 elemento-pagos remove_"+element+"' id='"+element+"'>";
          newtr = newtr + " <td> <input class=' t-referencia' type='hidden' id='referencia_"+element+"'></td>";
          newtr = newtr + " <td> <input class=' t-tipoCambioDR' type='hidden' id='tipoCambioDR_"+element+"'></td>";
          newtr = newtr + " <td> <input class=' t-moneda' type='hidden' id='moneda_"+element+"'><input class=' t-deposito' type='hidden' id='deposito_"+element+"'></td>";
          newtr = newtr + " <td> <input class=' t-metodoPagoDR' type='hidden' id='metodoPagoDR_"+element+"'><input class=' t-aduanaDR' type='hidden' id='aduanaDR_"+element+"'></td>";

        //newtr = newtr + " </tr></table> ";
        newtr = newtr + "</tr> ";

        $('#tbodyPagos').append(newtr);

        $(".remove-Pagos").click(function(e){
          $(this).closest("tr").remove();
          // $(borrar).closest("tr").remove();
          alertify.success('Se elimino correctamente');
          //sumaGeneral();
        });

        var element = $('.t-factura').length;
        $( ".t-factura" ).each(function( x ) {
          if( $('.t-factura').eq(x).val() == "" ){

            $('.t-aduanaDR').eq(x).val(aduana_DR);
            $('.t-referencia_DR').eq(x).val(referencia_DR);
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

            return false;
          }
        });

  //  }
  }
}

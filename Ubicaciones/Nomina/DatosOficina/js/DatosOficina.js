
$(document).ready(function(){
  $('.dtosOficina').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    switch (accion) {
      case "dFiscal":
      if (status == 'cerrado') {
        $('#contornoDom').fadeIn();
        // $('#DomicilioFiscal').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#contornoDom').fadeOut();
        // $('#DomicilioFiscal').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
      case "eDomicilio":
      if (status == 'cerrado') {
        $('#contornoEdit').fadeIn();
        // $('#EditarDomicilio').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#contornoEdit').fadeOut();
        // $('#EditarDomicilio').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
      case "dOficina":
      if (status == 'cerrado') {
        $('#contornoDatos').fadeIn();
        // $('#DatosOficina').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#contornoDatos').fadeOut();
        // $('#DatosOficina').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;

        default:
          console.error("Something went terribly wrong...");
      }
    });

  });

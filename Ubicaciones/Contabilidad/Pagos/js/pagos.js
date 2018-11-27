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
})

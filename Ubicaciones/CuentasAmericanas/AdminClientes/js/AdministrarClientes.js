$(document).ready(function(){

  $('.adminclientes').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    $('#selecTipoPoliza').find('a').css('color', "");
    $('#selecTipoPoliza').find('a').css('font-size', "");
    $(this).attr('status', 'abierto');
    $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
    $(this).css('font-size', '20px');

    switch (accion) {
      case "ca-generar":
        $('#cta-Generar').fadeIn();
        $('#cta-Modificar').hide();
        $('#cta-Consultar').hide();
        $('#cta-credito').hide();
        break;

      case "ca-modificar":
        $('#cta-Modificar').fadeIn();
        $('#cta-Generar').hide();
        $('#cta-Consultar').hide();
        $('#cta-credito').hide();
        break;

      case "ca-consultar":
        $('#cta-Consultar').fadeIn();
        $('#cta-Generar').hide();
        $('#cta-Modificar').hide();
        $('#cta-credito').hide();
        break;

      case "ca-creditos":
        $('#cta-credito').fadeIn();
        $('#cta-Generar').hide();
        $('#cta-Modificar').hide();
        $('#cta-Consultar').hide();
        break;
      default:
      console.error("Something went terribly wrong...");

    }
  });
});

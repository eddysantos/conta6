
$(document).ready(function(){
  $('.consultar').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    switch (accion) {
//CIERRE DE MES Y CATALOGO
      case "eCap":
      if (status == 'cerrado') {
        $('#contornoEmp').fadeIn();
        $('#empleadosCap').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#contornoEmp').fadeOut();
        $('#empleadosCap').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;

//CIERRE DE MES
    case "generar":
    if (status == 'cerrado') {
      $('#contornoGen').fadeIn();
      $(this).attr('status', 'abierto');
      $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
      $(this).css('font-size', '20px');
    } else {
      $('#contornoGen').fadeOut();
      $(this).attr('status', 'cerrado');
      $(this).css('color', "");
      $(this).css('font-size', "");
    }
      break;
    case "modificar":
    if (status == 'cerrado') {
      $('#contornoMod').fadeIn();
      $(this).attr('status', 'abierto');
      $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
      $(this).css('font-size', '20px');
    } else {
      $('#contornoMod').fadeOut();
      $(this).attr('status', 'cerrado');
      $(this).css('color', "");
      $(this).css('font-size', "");
    }
      break;
    case "consultar":
    if (status == 'cerrado') {
      $('#contornoCon').fadeIn();
      $(this).attr('status', 'abierto');
      $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
      $(this).css('font-size', '20px');
    } else {
      $('#contornoCon').fadeOut();
      $(this).attr('status', 'cerrado');
      $(this).css('color', "");
      $(this).css('font-size', "");
    }
      break;
    case "eCap":
    if (status == 'cerrado') {
      $('#contornoEmp').fadeIn();
      $('#empleadosCap').fadeIn();
      $(this).attr('status', 'abierto');
      $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
      $(this).css('font-size', '20px');
    } else {
      $('#contornoEmp').fadeOut();
      $('#empleadosCap').fadeOut();
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
$(document).ready(function () {
	$('.honorarios').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');


/*Comienza Editar Datos Generales*/
	switch (accion) {
  case "eCapHon":
  if (status == 'cerrado') {
    $('#contornoEmpHon').fadeIn();
    $(this).attr('status', 'abierto');
    $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
    $(this).css('font-size', '15px');
  } else {
    $('#contornoEmpHon').fadeOut();
    $(this).attr('status', 'cerrado');
    $(this).css('color', "");
    $(this).css('font-size', "");
  }
    break;
	case "dgenHon":
  if (status == 'cerrado') {
    $('#hon_dg').fadeIn();
    $(this).attr('status', 'abierto');
    $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
    $(this).css('font-size', '15px');
  } else {
    $('#hon_dg').fadeOut();
    $(this).attr('status', 'cerrado');
    $(this).css('color', "");
    $(this).css('font-size', "");
  }
    break;
/*Comienza Editar Datos Laborales*/
	case "dlabHon":
	if (status == 'cerrado') {
		$('#hon_dl').fadeIn();
		$(this).attr('status', 'abierto');
		$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
		$(this).css('font-size', '15px');
	} else {
		$('#hon_dl').fadeOut();
		$(this).attr('status', 'cerrado');
		$(this).css('color', "");
		$(this).css('font-size', "");
	}
		break;
/*Comienza Editar Distribucion de Salario*/
	case "dsalHon":
	if (status == 'cerrado') {
		$('#hon_ds').fadeIn();
		$(this).attr('status', 'abierto');
		$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
		$(this).css('font-size', '15px');
	} else {
		$('#hon_ds').fadeOut();
		$(this).attr('status', 'cerrado');
		$(this).css('color', "");
		$(this).css('font-size', "");
	}
		break;
/*Comienza Editar Honorarios*/
	case "Hon":
	if (status == 'cerrado') {
		$('#hon_has').fadeIn();
		$(this).attr('status', 'abierto');
		$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
		$(this).css('font-size', '15px');
	} else {
		$('#hon_has').fadeOut();
		$(this).attr('status', 'cerrado');
		$(this).css('color', "");
		$(this).css('font-size', "");
	}
		break;

		case "gnominaHon":
    if (status == 'cerrado') {
      $('#contornognomHon').fadeIn();
      // $('#generarnominaHon').fadeIn();
      $(this).attr('status', 'abierto');
      $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
      $(this).css('font-size', '20px');
    } else {
      $('#contornognomHon').fadeOut();
      // $('#generarnominaHon').fadeOut();
      $(this).attr('status', 'cerrado');
      $(this).css('color', "");
      $(this).css('font-size', "");
    }
      break;

			case "gcfdiHon":
      if (status == 'cerrado') {
        $('#contornogcfdiHon').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#contornogcfdiHon').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;

      case "paramHon":
      if (status == 'cerrado') {
        $('#contornoparamHon').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#contornoparamHon').fadeOut();
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

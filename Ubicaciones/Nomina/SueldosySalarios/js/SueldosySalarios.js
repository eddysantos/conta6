$(document).ready(function () {
	

	$('.sueldosysalarios').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');




/*Comienza Editar Datos Generales*/
		switch (accion) {

				case "dgenerales":
	      if (status == 'cerrado') {
	        $('#contornogen').fadeIn();
	        $(this).attr('status', 'abierto');
	        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
	        $(this).css('font-size', '20px');
	      } else {
	        $('#contornogen').fadeOut();
	        $(this).attr('status', 'cerrado');
	        $(this).css('color', "");
	        $(this).css('font-size', "");
	      }
	        break;
	      case "dlaborales":
	      if (status == 'cerrado') {
	        $('#contornolab').fadeIn();
	        $(this).attr('status', 'abierto');
	        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
	        $(this).css('font-size', '20px');
	      } else {
	        $('#contornolab').fadeOut();
	        $(this).attr('status', 'cerrado');
	        $(this).css('color', "");
	        $(this).css('font-size', "");
	      }
	        break;
				case "dpago":
	      if (status == 'cerrado') {
	        $('#contornopago').fadeIn();
	        $(this).attr('status', 'abierto');
	        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
	        $(this).css('font-size', '20px');
	      } else {
	        $('#contornopago').fadeOut();
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

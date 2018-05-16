$(document).ready(function () {
	$('.sueldosysalarios').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');


/*Comienza Editar Datos Generales*/
		switch (accion) {
			//SUELDOS Y SALARIOS-- EMPLEADOS
      case "eCap":
      if (status == 'cerrado') {
        $('#contornoEmp').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#contornoEmp').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;

			case "dgen":
      if (status == 'cerrado') {
        $('#contorno1').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#contorno1').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
/*Comienza Editar Datos Laborales*/
			case "dlab":
			if (status == 'cerrado') {
				$('#contorno2').fadeIn();
				$(this).attr('status', 'abierto');
				$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
				$(this).css('font-size', '20px');
			} else {
				$('#contorno2').fadeOut();
				$(this).attr('status', 'cerrado');
				$(this).css('color', "");
				$(this).css('font-size', "");
			}
				break;
/*Comienza Editar Distribucion de Salario*/
			case "dsal":
			if (status == 'cerrado') {
				$('#contorno3').fadeIn();
				$(this).attr('status', 'abierto');
				$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
				$(this).css('font-size', '20px');
			} else {
				$('#contorno3').fadeOut();
				$(this).attr('status', 'cerrado');
				$(this).css('color', "");
				$(this).css('font-size', "");
			}
				break;


/*Comienza Editar Distribucion de Salario*/
			case "suelysal":
			if (status == 'cerrado') {
				$('#contorno4').fadeIn();
				$(this).attr('status', 'abierto');
				$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
				$(this).css('font-size', '20px');
			} else {
				$('#contorno4').fadeOut();
				$(this).attr('status', 'cerrado');
				$(this).css('color', "");
				$(this).css('font-size', "");
			}
				break;

/*Comienza Editar Distribucion de Salario*/
			case "perc":
			if (status == 'cerrado') {
				$('#contorno5').fadeIn();
				$(this).attr('status', 'abierto');
				$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
				$(this).css('font-size', '20px');
			} else {
				$('#contorno5').fadeOut();
				$(this).attr('status', 'cerrado');
				$(this).css('color', "");
				$(this).css('font-size', "");
			}
				break;

/*Comienza Editar Deducciones*/
			case "deduc":
			if (status == 'cerrado') {
				$('#contorno6').fadeIn();
				$(this).attr('status', 'abierto');
				$(this).css('cssText', 'color: rgb(209, 28, 28) !important');
				$(this).css('font-size', '20px');
			} else {
				$('#contorno6').fadeOut();
				$(this).attr('status', 'cerrado');
				$(this).css('color', "");
				$(this).css('font-size', "");
			}
				break;

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


					case "consul":
		      $('#consul').hide();
		      $('#gnom2').show();
		      $('#contornoparam').fadeOut();
		      $('#contgenerarnom').fadeOut();
		      $('#contpagination').fadeIn();
		        break;

		      case "gnom2":
		      $('#gnom2').hide();
		      $('#consul').show();
		      $('#contornoparam').fadeOut();
		      $('#contpagination').fadeOut();
		      $('#contgenerarnom').fadeIn();
		        break;

		      case "param":
		      $('#param').hide();
		      $('#gnom').show();
		      $('#contgenerarnom').fadeOut();
		      $('#contpagination').fadeOut();
		      $('#contornoparam').fadeIn();
		        break;

		      case "gnom":
		      $('#gnom').hide();
		      $('#param').show();
		      $('#contornoparam').fadeOut();
		      $('#contpagination').fadeOut();
		      $('#contgenerarnom').fadeIn();
		        break;


		      case "vnomina":
		        $('#switchs').fadeOut();
		        $(this).fadeOut();
		        $('#generarnom').fadeIn();
		        $('#visualizarnomina').fadeIn();
		        break;


		      case "GenerarNomina":
		        $(this).fadeOut();
		        $('#visualizarnomina').fadeOut();
		        $('#preytimbrar').fadeIn();
		        $('#visualizaCFDI').fadeIn();

		        break;


        default:
          console.error("Something went terribly wrong...");
    }
  });
});

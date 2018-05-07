$(document).ready(function(){

  $('.consultar').click(function(){
        var accion = $(this).attr('accion');
        var status = $(this).attr('status');

        $('#selecTipoPoliza').find('a').css('color', "");
        $('#selecTipoPoliza').find('a').css('font-size', "");
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');


        switch (accion) {
          case "poldiario":
            $('#polizadiario').fadeIn();
            $('#polizaingresos').hide();
            $('#cheques').hide();
            $('#anticipos').hide();
            break;

          case "polingreso":
            $('#polizaingresos').fadeIn();
            $('#polizadiario').hide();
            $('#cheques').hide();
            $('#anticipos').hide();
            break;
          case "gcheque":
            $('#cheques').fadeIn();
            $('#polizadiario').hide();
            $('#polizaingresos').hide();
            $('#anticipos').hide();
            break;

          case "ganticipo":
            $('#anticipos').fadeIn();
            $('#polizadiario').hide();
            $('#polizaingresos').hide();
            $('#cheques').hide();
            break;

            case "dtospol":
            if (status == 'cerrado') {
              $('#datospoliza').fadeIn();
              $(this).attr('status', 'abierto');
              $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
              $(this).css('font-size', '20px');
            } else {
              $('#datospoliza').fadeOut();
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

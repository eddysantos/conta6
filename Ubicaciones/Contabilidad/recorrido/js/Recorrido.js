$(document).ready(function(){



  $('.consultar').click(function(){
        var accion = $(this).attr('accion');
        var status = $(this).attr('status');

        $('#AsignarEntregas').find('a').css('color', "");
        $('#AsignarEntregas').find('a').css('font-size', "");
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');


        switch (accion) {
          case "Entregas":
            $('#otrasEntregas').fadeIn();
            $('#Afacturas').hide();
            $('#Consul').hide();
            $('#Recor').hide();
            break;

          case "AgregarFactura":
            $('#Afacturas').fadeIn();
            $('#otrasEntregas').hide();
            $('#Consul').hide();
            $('#Recor').hide();
            break;
          case "Consultas":
            $('#Consul').fadeIn();
            $('#otrasEntregas').hide();
            $('#Afacturas').hide();
            $('#Recor').hide();
            break;

          case "Recorrido":
            $('#Recor').fadeIn();
            $('#otrasEntregas').hide();
            $('#Afacturas').hide();
            $('#Consul').hide();
            break;
          default:
          console.error("Something went terribly wrong...");
        }
      });

      $('#afact').focus(function(){
        $('#factura').css('height', '100px');
        $('#labelFact').css('font-size', '24pt');
        $(this).css('height', '140px');
      });

  });

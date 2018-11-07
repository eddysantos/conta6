$(document).ready(function(){

  $('.consultar').click(function(){
        var accion = $(this).attr('accion');
        var status = $(this).attr('status');

        $('#selecRepo').find('a').css('color', "");
        $('#selecRepo').find('a').css('font-size', "");
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');

        switch (accion) {
          case "rOficina":
            $('#RepoxOficina').fadeIn();
            $('#RepoxCliente').hide();
            break;

          case "rCliente":
            $('#RepoxCliente').fadeIn();
            $('#RepoxOficina').hide();
            break;
          default:
          console.error("Something went terribly wrong...");

        }

    });

    $('#bRef').focus(function(){
      $('#referencia').css('height', '100px');
      $('#labelRef').css('font-size', '24pt');
      $(this).css('height', '140px');
    });


    $('.mostrarbusqueda').click(function(){
      $('#repoPed').fadeIn();
      $('#buscarRef').slideUp();
    });

    $('#mostrarConsulta').submit(function(){
      $('#repoPed').fadeIn();
      $('#buscarRef').slideUp();
    });

    $('.nc').click(function(){
      $('#repoPed').fadeOut();
      $('#buscarRef').slideDown();
    });

  });

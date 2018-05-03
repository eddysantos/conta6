
$(document).ready(function(){
    /*Input se hace mas grande al enfocar*/
    $('#bRef').focus(function(){
      $('#referencia').css('height', '100px');
      $('#labelRef').css('font-size', '24pt');
      $(this).css('height', '140px');
    });


    $('#mostrarConsulta').submit(function(){
      $('#repoPed').fadeIn();
      $('#buscarRef').slideUp();
    });

    $('.atras').click(function(){
      var accion = $(this).attr('accion');
      switch (accion) {

        case "datosPedimento":
        $('#repoPed').fadeOut();
        $('#buscarRef').slideDown();
          break;
        default:

          console.error("Something went terribly wrong...");
      }
    });

  });


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

    $('.rg').click(function(){
      $('#repoPed').fadeOut();
      $('#buscarRef').slideDown();
    });

  });

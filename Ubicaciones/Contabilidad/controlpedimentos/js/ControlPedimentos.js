
$(document).ready(function(){
  $('.conPed').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    switch (accion) {
      case "pCap":
      if (status == 'cerrado') {
        $('#contornoPed').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#contornoPed').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
        default:
          console.error("Something went terribly wrong...");
      }
    });

    $('#mostrarConsulta').submit(function(){
      $('#repoPed').fadeIn();
      $('#buscarRef').slideUp();
    });
  });


  $('.rg').click(function(){
    $('#repoPed').fadeOut();
    $('#buscarRef').slideDown();
  });

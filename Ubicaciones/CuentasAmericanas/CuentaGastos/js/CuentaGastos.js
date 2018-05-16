$(document).ready(function(){

    $('.ctagastos').click(function(){
      var accion = $(this).attr('accion');
      var status = $(this).attr('status');


    switch (accion) {
        case "buscar":
        $('#buscarRef').fadeIn();
        $('#SeleccionarAccion').slideUp();
          break;
        case "generar":
        $('#gctaGastos').fadeIn();
        $('#SeleccionarAccion').slideUp();
          break;

          case "datcliente":
          if (status == 'cerrado') {
            $('#contornoCliente').fadeIn();
            $(this).attr('status', 'abierto');
            $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
            $(this).css('font-size', '20px');
          } else {
            $('#contornoCliente').fadeOut();
            $(this).attr('status', 'cerrado');
            $(this).css('color', "");
            $(this).css('font-size', "");
          }
            break;
          case "datinfo":
          if (status == 'cerrado') {
            $('#contornoInfo').fadeIn();
            $(this).attr('status','abierto');
            $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
            $(this).css('font-size', '20px');
          }else {
            $('#contornoInfo').fadeOut();
            $(this).attr('status','cerrado');
            $(this).css('color', "");
            $(this).css('font-size', "");
          }
            break;

        default:
          console.error("Something went terribly wrong...");
      }
    });

  $('.atras').click(function(){
    var accion = $(this).attr('accion');
    switch (accion) {
      case "cuadroBusqueda":
      $('#buscarRef').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      case "cuadroGenerar":
      $('#gctaGastos').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      case "cuadroConsultar":
      $('#repoSol').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      default:
        console.error("Something went terribly wrong...");
    }
  });


  $('#mostrarConsulta').submit(function(){
    $('#repoSol').fadeIn();
    $('#buscarRef').slideUp();
  });

  $('#bRef').focus(function(){
    $('#referencia').css('height', '100px');
    $('#labelRef').css('font-size', '24pt');
    $(this).css('height', '140px');
  });

  $('#gRef').focus(function(){
    $('#gctaGastosRef').css('height', '100px');
    $('#labelgRef').css('font-size', '24pt');
    $(this).css('height', '140px');
  });
});

$(document).ready(function(){

  /*Input se hace mas grande al enfocar*/
  $('#bRef').focus(function(){
    $('#referencia').css('height', '100px');
    $('#labelRef').css('font-size', '24pt');
    $(this).css('height', '140px');
  });


/*Oculta todos los divs y hace visible solo el submenu*/
  // $('.bg').click(function(){
  $('.fele').click(function(){
    var accion = $(this).attr('accion');
    switch (accion) {

// verificado que funciona
    case "generarctagastos":
    $('#g-ctagastos').fadeIn();
    $('#SeleccionarAccion').slideUp();
      break;
    case "buscarctagastos":
    $('#b-ctagastos').fadeIn();
    $('#SeleccionarAccion').slideUp();
      break;

    case "cuadroBusqueda":
    $('#b-ctagastos').fadeOut();
    $('#SeleccionarAccion').slideDown();
      break;
    case "cuadroGenerar":
    $('#g-ctagastos').fadeOut();
    $('#SeleccionarAccion').slideDown();
      break;




// pendiente por verificar

      case "cuadroConsultar":
      $('#m-ctagastos').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      case "BuscarOtro":
      $('#m-factura').fadeOut();
      $('#b-ctagastos').slideDown();
        break;
        case "cuadroObservaciones":
        $('#b-ctagastos').slideDown();
        $('#m-ctagastos').fadeOut();

          break;
      default:
        console.error("Something went terribly wrong...");
    }
  });

  /*Oculta todos los divs y hace visible solo el submenu*/
    $('.ver').click(function(){
      var accion = $(this).attr('accion');
      switch (accion) {
        case "cuadroConsultar":
        $('#buscarfactura').fadeOut();
        $('#ConsulFactura').fadeIn();
          break;

        case "cuadroCancelar":
        $('#buscarfactura').fadeOut();
        $('#CancelFactura').fadeIn();
          break;
        default:
          console.error("Something went terribly wrong...");
      }
    });

  $('#mostrarConsulta').submit(function(){
    $('#m-ctagastos').fadeIn();
    $('#b-ctagastos').slideUp();
  });

  $('#mostrarConsulta').submit(function(){
    $('#m-factura').fadeIn();
    $('#b-ctagastos').slideUp();
  });
  // $('#mostrar').submit(function(){
  //   $('#capmod').fadeIn();
  // });

  $('.visualizar').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    switch (accion) {
      case "Ver-cliente":
      if (status == 'cerrado') {
        $('#detalleCliente').fadeIn();
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      } else {
        $('#detalleCliente').fadeOut();
        $(this).attr('status', 'cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
      case "Ver-iEmbarque":
      if (status == 'cerrado') {
        $('#detalleEmbarque').fadeIn();
        $(this).attr('status','abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      }else {
        $('#detalleEmbarque').fadeOut();
        $(this).attr('status','cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
        case "Ver-iUsuario":
        if (status == 'cerrado') {
          $('#detalleUsuario').fadeIn();
          $(this).attr('status','abierto');
          $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
          $(this).css('font-size', '20px');
        }else {
          $('#detalleUsuario').fadeOut();
          $(this).attr('status','cerrado');
          $(this).css('color', "");
          $(this).css('font-size', "");
        }
          break;
      default:
        console.error("Something went terribly wrong...");
    }

  });
});

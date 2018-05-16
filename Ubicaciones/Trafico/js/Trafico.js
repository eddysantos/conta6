$(document).ready(function(){


// MONITOR DE OFICINAS
    $('.trafico').click(function(){
      var accion = $(this).attr('accion');
      var status = $(this).attr('status');



// CONSULTAR SOLICITUD
    switch (accion) {
      
      case "cliente":
      if (status == 'cerrado') {
        $('#contornodCliente').fadeIn();
        $(this).attr('status','abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      }else {
        $('#contornodCliente').fadeOut();
        $(this).attr('status','cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
      case "iEmbarque":
      if (status == 'cerrado') {
        $('#contornodEmbarque').fadeIn();
        $(this).attr('status','abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      }else {
        $('#contornodEmbarque').fadeOut();
        $(this).attr('status','cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;
      case "iUsuario":
      if (status == 'cerrado') {
        $('#contornodUsuario').fadeIn();
        $(this).attr('status','abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');
      }else {
        $('#contornodUsuario').fadeOut();
        $(this).attr('status','cerrado');
        $(this).css('color', "");
        $(this).css('font-size', "");
      }
        break;

        case "botonverDetalle":
        $('#BuscarMonOfi').hide();
        $('#VerMonitorOficinas').fadeIn();
          break;
        case "cerrarMonitorOficinas":
        $('#BuscarMonOfi').fadeIn();
        $('#VerMonitorOficinas').hide();
          break;

        case "mostrarDetalle":
        $(this).hide();
        $('#MostrarDetPoliza').fadeIn();
          break;
        case "cerrarDetalle":
        $('#botondetalle').fadeIn();
        $('#MostrarDetPoliza').hide();
          break;

  // SOLICITUD DE ANTICIPO
        case "buscar":
        $('#buscarRef').fadeIn();
        $('#SeleccionarAccion').slideUp();
          break;
        case "generar":
        $('#gSolicitud').fadeIn();
        $('#SeleccionarAccion').slideUp();
          break;

        default:
          console.error("Something went terribly wrong...");
      }
    });


/*Oculta todos los divs y hace visible solo el submenu*/
  $('.atras').click(function(){
    var accion = $(this).attr('accion');
    switch (accion) {
      case "BuscarOtro":
      $('#m-Remision').fadeOut();
      $('#b-notaRemision').slideDown();
      break;


//SOLICITUD DE ANTICIPO
      case "cuadroBusqueda":
      $('#buscarRef').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      case "cuadroGenerar":
      $('#gSolicitud').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      case "cuadroConsultar":
      $('#repoSol').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      case "cuadroDatosSol":
      $('#datosSol').fadeOut();
      $('#SeleccionarAccion').slideDown();
        break;
      default:
        console.error("Something went terribly wrong...");
    }
  });

  $('#mostrarConsulta').submit(function(){
    $('#m-Remision').fadeIn();
    $('#b-notaRemision').slideUp();
  });


// SOLICITUD DE ANTICIPO
  $('#mostrarConsulta').submit(function(){
    $('#repoSol').fadeIn();
    $('#buscarRef').slideUp();
  });

  $('#mostrarGenerar').submit(function(){
    $('#datosSol').fadeIn();
    $('#gSolicitud').slideUp();
  });


  /*Input se hace mas grande al enfocar*/
  $('#bRef').focus(function(){
    $('#referencia').css('height', '100px');
    $('#labelRef').css('font-size', '24pt');
    $(this).css('height', '140px');
  });

  $('#gRef').focus(function(){
    $('#gSolicitudRef').css('height', '100px');
    $('#labelgRef').css('font-size', '24pt');
    $(this).css('height', '140px');
  });
});

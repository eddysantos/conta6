
$(document).ready(function(){
  $('.prov').click(function(){
    var accion = $(this).attr('accion');
    switch (accion) {
      case "mostrarcta":
      $('#MostrarCuenta').fadeIn();
        break;

      case "mostrarDetalle":
      $(this).hide();
      $('#MostrarDetPoliza').fadeIn();
        break;

      case "cerrarDetalle":
      $('#botondetalle').fadeIn();
      $('#MostrarDetPoliza').hide();
        break;
      default:
        console.error("Something went terribly wrong...");
    }
  });
});

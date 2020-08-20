
//Detectamos los cambios y mostramos uno u otro form
$('#opcionespolizas').change(function() {
  if ($('#opcionespolizas').val() == 2){
    $(".cfdi").css("display","block");
    $(".cheque,.compext,.otro,.transferencia").css("display","none");
  };

  if ($('#opcionespolizas').val() == 3){
    $(".cheque").css("display","block");
    $(".cfdi,.compext,.otro,.transferencia").css("display","none");
  };

  if ($('#opcionespolizas').val() == 4){
    $(".compext").css("display","block");
    $(".cheque,.cfdi,.otro,.transferencia").css("display","none");
  };

  if ($('#opcionespolizas').val() == 5){
    $(".otro").css("display","block");
    $(".compext,.cheque,.cfdi,.transferencia").css("display","none");
  };

  if ($('#opcionespolizas').val() == 6){
    $(".transferencia").css("display","block");
    $(".otro,.compext,.cheque,.cfdi").css("display","none");
  };
});

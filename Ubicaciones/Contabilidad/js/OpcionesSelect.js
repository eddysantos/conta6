
//Detectamos los cambios y mostramos uno u otro form
$('#opcionespolizas').change(function() {
  // alert('Algo cambio!');
    if ($('#opcionespolizas').val() == 1){
      $(".cfdcbb").css("display","block");
      $(".cfdi").css("display","none");
      $(".cheque").css("display","none");
      $(".compext").css("display","none");
      $(".otro").css("display","none");
      $(".transferencia").css("display","none");
    };

    if ($('#opcionespolizas').val() == 2){
      $(".cfdi").css("display","block");
      $(".cfdcbb").css("display","none");
      $(".cheque").css("display","none");
      $(".compext").css("display","none");
      $(".otro").css("display","none");
      $(".transferencia").css("display","none");
    };

    if ($('#opcionespolizas').val() == 3){
      $(".cheque").css("display","block");
      $(".cfdi").css("display","none");
      $(".cfdcbb").css("display","none");
      $(".compext").css("display","none");
      $(".otro").css("display","none");
      $(".transferencia").css("display","none");
    };
    if ($('#opcionespolizas').val() == 4){
      $(".compext").css("display","block");
      $(".cheque").css("display","none");
      $(".cfdi").css("display","none");
      $(".cfdcbb").css("display","none");
      $(".otro").css("display","none");
      $(".transferencia").css("display","none");
    };
    if ($('#opcionespolizas').val() == 5){
      $(".otro").css("display","block");
      $(".compext").css("display","none");
      $(".cheque").css("display","none");
      $(".cfdi").css("display","none");
      $(".cfdcbb").css("display","none");
      $(".transferencia").css("display","none");
    };
    if ($('#opcionespolizas').val() == 6){
      $(".transferencia").css("display","block");
      $(".otro").css("display","none");
      $(".compext").css("display","none");
      $(".cheque").css("display","none");
      $(".cfdi").css("display","none");
      $(".cfdcbb").css("display","none");
    };


});

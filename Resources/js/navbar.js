$("#toggle").click(function(event){
  event.preventDefault();
  if ($(this).hasClass("isDown")) {
    $(".navbar-fixed-top").animate({"margin-top" : "-64px"},"fast");
    $("#content").animate({"margin-top" : "5px"},"fast");
    $(this).removeClass("isDown");
  }else {
    $(".navbar-fixed-top").animate({"margin-top" : "10px"},"fast");
    $("#content").animate({"margin-top" : "80px"},"fast");
    $(this).addClass("isDown");
  }
  return false;
});

$('#selectAduana').change(function(){
  var aduanaSelect = $('#selectAduana').val();
  $.ajax({
    method: 'POST',
    url: "/Ubicaciones/Login/actions/ingresarNuevo.php",
    data: {
      aduanaSelect: aduanaSelect
    },
    success: function(result){
      response = jQuery.parseJSON(result);
      console.log(response);
      switch (response.code) {
        case "200":
          swal("Usuario o contraseña incorrectos","Favor de Verificar","error");
          console.log(response);
          return false;
          break;

        case "1":
          //window.location.replace("/Ubicaciones/Bienvenida.php");
          window.location.reload();
          return false;
          break;

        default:
          alert("Something went terribly wrong");
      }
    },
    error: function(exception){
      console.error(exception);
    }
  });

});

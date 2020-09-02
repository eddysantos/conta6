$(document).ready(function(){

  $('#cat-benef').change(function() {
    var dbid = $(this).attr('db-id');

    if (dbid != "") {
      buscarDatosBenef(dbid);
      buscarCtasBenef(dbid);

    }
  });

  $('#btn_printBenef').click(function(){
    window.open(''+ruta+'Beneficiarios/actions/beneficiarios_impresion.php');
  });


  $('.btn_agregarBeneficiario').click(function(){
    ben = $('#ben_razonsocial').val();
    rfc = $('#ben_mrfc').val();

    if( ben == "" ){
      alertify.error("Escriba un Nombre");
      $('#ben_razonsocial').focus();
      return false;
    }

    validRFC = validaRFC($('#ben_mrfc'));
    if( rfc == "" || validRFC == false ){
      $('#ben_mrfc').focus();
      return false;
    }

  	var data = {
  		ben: ben,
  		rfc: rfc,
      taxid: $('#ben_taxid').val()
    }
    $.ajax({
      type: "POST",
      url: ""+ruta+"Beneficiarios/actions/beneficiarios_agregar.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Exito", "Se generó correctamente.", "success");
          $('.modal').modal('hide');
        } else if (r.code == 500) {
			    swal("RFC existe en sistema", r.data, "error");
          console.error(r.message);
        }else {
          swal("No se agrego, favor de reportar", r.data, "error");
          console.error(r.message);
          $('.modal').modal('hide');
        }
      },
      error: function(x){
        console.error(x);
      }
    });
  });

  $('#bcoSATben').change(function(){
    var bancoSATben = $(this).attr('db-id');
    if (bancoSATben == "999") {
      $('#nomBcoben').prop('disabled', false);
      $('#nomBcoExtjben').prop('disabled', false);
    }else {
      $('#nomBcoben').prop('disabled', true);
      $('#nomBcoExtjben').prop('disabled', true);
    }
  })

  $('#btn_agrCtaBcoBen').click(function(){
    id_ben = $('#cat-benef').attr('db-id');
    banco = $('#bcoSATben').attr('db-id');
    cuenta = $('#cinterben').val();
    nomBan = $('#nomBcoben').val();
    nomBanExt = $('#nomBcoExtjben').val();

    if( id_ben == "" ){
      alertify.error("Seleccione un Beneficiario");
      $('#cat-benef').focus();
      return false;
     }

     if( banco == "" ){
       alertify.error("Seleccione un banco");
       $('#bcoSATben').focus();
       return false;
     }

     if( banco == "999" && (nomBan == "" || nomBanExt == "") ){
       alertify.error("Es requerido el nombre del banco");
       $('#nomBcoben').focus();
       return false;
     }

     valid_cuenta = validarCtaBancaria($('#cinterben'));
     if( cuenta == "" || valid_cuenta == false ){
       alertify.error("Formato Cuenta bancaria Incorrecto");
       $('#cinterben').focus();
       return false;
     }

     var data = {
       id_ben: id_ben,
       banco: banco,
       cuenta: cuenta,
       nomBan: nomBan
     }
     console.log(data);

    var ajaxCall = $.ajax({
        method: "POST",
        data: data,
        url: ""+ruta+"Beneficiarios/actions/beneficiarios_agregarBcoCtaBen.php"
    });

    ajaxCall.done(function(r) {
      r = JSON.parse(r);
      if (r.code == 1) {
        swal("Exito", "Se generó correctamente.", "success");
        $("#ctasBancarias")[0].reset();
        // $('#cat-benef').change();
      } else {
        console.error(r.message);
      }
    });
  });



});

// var ruta = "/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/";

function buscarCtasBenef(id){
  var data = {
    id_ben: id
  }

  $.ajax({
    type: "POST",
    url: ""+ruta+"Beneficiarios/actions/beneficiarios_asignarCtasBancarias.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#lista_datosCtasBen').html(r.data);
      } else {
        console.error(r.message);
      }
    },
    error: function(x){
      console.error(x);
    }
  });
}

function buscarDatosBenef(id){
  var data = {
    id_ben: id
  }
  $.ajax({
    type: "POST",
    url: ""+ruta+"Beneficiarios/actions/beneficiarios_datosGenerales.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#datosGeneralesBen').html(r.data);
      } else {
          console.error(r.message);
      }
    },
    error: function(x){
      console.error(x);
    }

  });
}


function btn_editBen(){
  // ben = $('#nombre').val();
  ben = $('.nombre').val();
  rfc = $('#rfc').val();
  console.log(ben);
  console.log(rfc);

  if( ben == "" ){
    alertify.error("Escriba un Nombre");
    $('.nombre').focus();
    return false;
   }

   if( rfc == "" ){
     alertify.error("Escriba un RFC");
     $('#rfc').focus();
     return false;
   }

   var data = {
     id_ben: $('#cat-benef').attr('db-id'),
     ben: ben,
     rfc: rfc
   }

   var ajaxCall = $.ajax({
     method: "POST",
     data: data,
     url: ""+ruta+"Beneficiarios/actions/beneficiarios_editar.php"
   });

   ajaxCall.done(function(r) {
     r = JSON.parse(r);
     if (r.code == 1) {
       swal("Exito", "Se modificó correctamente.", "success");
       $('#cat-benef').change();
     } else {
       swal("RFC existe en sistema", r.data, "error");
       console.error(r.message);
     }
   });
 }


 function btn_bcben(partida,ben){
   swal({
   title: "Estas Seguro?",
   text: "Ya no se podra recuperar el registro! "+ partida +" ",
   type: "warning",
   showCancelButton: true,
   confirmButtonClass: "btn-danger",
   confirmButtonText: "Si, Eliminar",
   cancelButtonText: "No, cancelar",
   closeOnConfirm: false,
   closeOnCancel: false
   },
   function(isConfirm) {
     if (isConfirm) {
       var data = {
         partida: partida,
         ben: ben
       }
       $.ajax({
         type: "POST",
         url: ""+ruta+"Beneficiarios/actions/beneficiarios_eliminar.php",
         data: data,
           success: 	function(r){
             r = JSON.parse(r);
           if (r.code == 1) {
             swal("Eliminado!", "Se elimino correctamente.", "success");
             $('#cat-benef').change();
           } else {
             console.error(r.message);
           }
         },
         error: function(x){
           console.error(x)
         }
       });
     } else {
       swal("Cancelado", "El registro esta a salvo :)", "error");
     }
   });
 }

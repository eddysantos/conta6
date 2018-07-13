
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

  $('#razonsocial').change(function(){
	  eliminaBlancosIntermedios(this);
    todasMayusculas(this);
  });

  $('#mrfc').change(function(){
	  eliminaBlancosIntermedios(this);
    todasMayusculas(this);
  	validaRFC(this);
  });


  $('#btn_printBenef').click(function(){
    window.location.replace('/conta6/Ubicaciones/Contabilidad/cheques/beneficiarios/actions/impresion_lstBeneficiarios.php');
  });

  $('#btn_genBen').click(function(){
    ben = $('#razonsocial').val();
	  rfc = $('#mrfc').val();

	  if( ben == "" ){
		    alertify.error("Escriba un Nombre");
        $('#razonsocial').focus();
        return false;
	   }

     validRFC = validaRFC($('#mrfc'));
	   if( rfc == "" || validRFC == false ){
		    alertify.error("Formato RFC Incorrecto");
        $('#mrfc').focus();
        return false;
	    }

    	var data = {
      		ben: ben,
      		rfc: rfc,
          taxid: $('#taxid').val()
      }

      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/cheques/beneficiarios/actions/agregar.php",
        data: data,
        success: 	function(r){
          console.log(r);
          r = JSON.parse(r);
          if (r.code == 1) {
            swal("Exito", "Se generó correctamente.", "success");
            setTimeout('document.location.reload()',700);
          } else {
  			    swal("RFC existe en sistema", r.data, "error");
            console.error(r.message);
          }
        },
        error: function(x){
          console.error(x);
        }

      });
  });

  $('#btn_agrCtaBcoBen').click(function(){
    id_ben = $('#cat-benef').attr('db-id');
    banco = $('#bcoSAT').attr('db-id');
    cuenta = $('#cinter').val();

    if( id_ben == "" ){
        alertify.error("Seleccione un Beneficiario");
        $('#cat-benef').focus();
        return false;
     }

     if( banco == "" ){
        alertify.error("Seleccione un banco");
        $('#bcoSAT').focus();
        return false;
      }

      valid_cuenta = validarCtaBancaria($('#cinter'));
      if( cuenta == "" || valid_cuenta == false ){
         alertify.error("Formato Cuenta bancaria Incorrecto");
         $('#cinter').focus();
         return false;
       }

      var data = {
          id_ben: id_ben,
          banco: banco,
          cuenta: cuenta
      }

      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/cheques/beneficiarios/actions/agregarBcoCtaBen.php",
        data: data,
        success: 	function(r){
          //console.log(r);
          r = JSON.parse(r);
          if (r.code == 1) {
            swal("Exito", "Se generó correctamente.", "success");
            $('#cat-benef').change();
          } else {
            swal("Error", r.data, "error");
            console.error(r.message);
          }
        },
        error: function(x){
          console.error(x);
        }

      });
  });


  $('#cat-benef').change(function() {
    var $this = $(this);
    var dbid = $this.attr('db-id');

    if (dbid != "") {
      buscarDatosBenef(dbid);
      buscarCtasBenef(dbid);
    }
  });



});

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
        url: "/conta6/Ubicaciones/Contabilidad/cheques/beneficiarios/actions/eliminar.php",
        data: data,

          success: 	function(r){
            r = JSON.parse(r);
            console.log(r);
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

function btn_editBen(){
  ben = $('#nombre').val();
  rfc = $('#rfc').val();

  if( ben == "" ){
      alertify.error("Escriba un Nombre");
      $('#nombre').focus();
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

    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Contabilidad/cheques/beneficiarios/actions/editar.php",
      data: data,
      success: 	function(r){
        console.log(r);
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Exito", "Se modificó correctamente.", "success");
          $('#cat-benef').change();
        } else {
          swal("RFC existe en sistema", r.data, "error");
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }

    });
}

function buscarDatosBenef(id){
  //var data = { id_ben: $('#cat-benef').attr('db-id') }
  var data = {
    id_ben: id
  }
  $.ajax({
    type: "POST",
    url: "/conta6/Ubicaciones/Contabilidad/cheques/beneficiarios/datosGenerales.php",
    data: data,
    success: 	function(r){
      //console.log(r);
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

function buscarCtasBenef(id){
  //var data = { id_ben: $('#cat-benef').attr('db-id') }
  var data = {
    id_ben: id
  }
  $.ajax({
    type: "POST",
    url: "/conta6/Ubicaciones/Contabilidad/cheques/beneficiarios/asignarCtasBancarias.php",
    data: data,
    success: 	function(r){
      console.log(r);
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#datosCtasBen').html(r.data);
      } else {
          console.error(r.message);
      }
    },
    error: function(x){
      console.error(x);
    }

  });
}

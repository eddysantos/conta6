$(document).ready(function(){

  var ruta = "/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/";


  $('#cat-prov').change(function() {
    var $this = $(this);
    var dbid = $this.attr('db-id');

    if (dbid != "") {
      buscarDatosProv(dbid);
      buscarCtasProv(dbid);
    }
  });

  $('#btn_printProv').click(function(){
    window.open(""+ruta+"Proveedores/actions/proveedores_impresion.php");
  });


  $('#btn_agrCtaBcoProv').click(function(){
    id_prov = $('#cat-prov').attr('db-id');
    banco = $('#bcoSATprov').attr('db-id');
    cuenta = $('#cinter').val();
    nomBan = $('#nomBco').val();

    if( id_prov == "" ){
      alertify.error("Seleccione un Proveedor");
      $('#cat-prov').focus();
      return false;
    }

    if( banco == "" ){
      alertify.error("Seleccione un banco");
      $('#bcoSAT').focus();
      return false;
    }

    if( banco == "999" && nomBan == "" ){
      alertify.error("Es requerido el nombre del banco");
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
      id_prov: id_prov,
      banco: banco,
      cuenta: cuenta,
      nomBan: nomBan
    }

    $.ajax({
      type: "POST",
      url: ""+ruta+"Proveedores/actions/proveedores_agregarBcoCta.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Exito", "Se generó correctamente.", "success");
          $('#cat-prov').change();
        } else {
          swal("Error", r.data, "error");
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });
  }); // agregar cuenta banco proveedor


  $('#btn_genProv').click(function(){
  nombre = $('#nombreN_prov').val();
  persona = $('#personaN_prov').val();
  rfc = $('#rfcN_prov').val();
  curp = $('#curpN_prov').val();
  taxid = $('#taxidN_prov').val();
  direccion = $('#direccionN_prov').val();

  if( nombre == "" ){
    alertify.error("Nombre es requerido");
    $('#nombreN_prov').focus();
    return false;
  }
  if( persona == "" ){
      alertify.error("Persona es requerido");
      $('#personaN_prov').focus();
      return false;
   }
  if( persona == "fisica" && curp == ""){
      alertify.error("CURP es requerido");
      $('#curpN_prov').focus();
      return false;
   }

   if( rfc == "" ){
      alertify.error("RFC es requerido");
      $('#rfcN_prov').focus();
      return false;
    }
    if( rfc == "XEXX010101000" && taxid == '' ){
       alertify.error("taxID es requerido");
       $('#taxidN_prov').focus();
       return false;
     }

    var data = {
      nombre : nombre,
      persona : persona,
      rfc : rfc,
      curp : curp,
      taxid : taxid,
      direccion : direccion
    }

    $.ajax({
      type: "POST",
      url: ""+ruta+"Proveedores/actions/proveedores_agregar.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Exito", "Se generó correctamente.", "success");
          $('.modal').modal('hide');
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


}); // fin del documento

var ruta = "/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/";

function buscarDatosProv(id){
  var data = {
    id_prov: id
  }
  $.ajax({
    type: "POST",
    url: ""+ruta+"Proveedores/actions/proveedores_datosGenerales.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#datosGeneralesProv').html(r.data);
      } else {
        console.error(r.message);
      }
    },
    error: function(x){
      console.error(x);
    }
  });
}

function buscarCtasProv(id){
  var data = {
    id_prov: id
  }
  $.ajax({
    type: "POST",
    url: ""+ruta+"Proveedores/actions/proveedores_asignarCtasBancarias.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#datosCtasProv').html(r.data);
      } else {
          console.error(r.message);
      }
    },
    error: function(x){
      console.error(x);
    }
  });
}

function btn_bcprov(partida,prov){
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
        prov: prov
      }
      $.ajax({
        type: "POST",
        url: ""+ruta+"Proveedores/actions/proveedores_eliminarCtaBancaria.php",
        data: data,

          success: 	function(r){
            r = JSON.parse(r);
          if (r.code == 1) {
            swal("Eliminado!", "Se elimino correctamente.", "success");
            $('#cat-prov').change();

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

function btn_editProv(){
  idprov = $('#id_prov').val();
  nombre = $('#nombre_prov').val();
  persona = $('#persona_prov').val();
  rfc = $('#rfc_prov').val();
  curp = $('#curp_prov').val();
  taxid = $('#taxid_prov').val();
  direccion = $('#direccion_prov').val();

  if( persona == "" ){
      alertify.error("Persona es requerido");
      $('#persona_prov').focus();
      return false;
   }
  if( persona == "fisica" && curp == ""){
      alertify.error("CURP es requerido");
      $('#curp_prov').focus();
      return false;
   }

   if( rfc == "" ){
      alertify.error("RFC es requerido");
      $('#rfc_prov').focus();
      return false;
    }
    if( rfc == "XEXX010101000" && taxid == '' ){
       alertify.error("taxID es requerido");
       $('#taxid_prov').focus();
       return false;
     }

    var data = {
      idprov : idprov,
      nombre : nombre,
      persona : persona,
      rfc : rfc,
      curp : curp,
      taxid : taxid,
      direccion : direccion
    }

    $.ajax({
      type: "POST",
      url: ""+ruta+"Proveedores/actions/proveedores_editar.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Exito", "Se modificó correctamente.", "success");
          $('#cat-prov').change();
        } else {
          alertify.error("No hubo ningun cambio", r.data, "error");
          // swal("hubo un error", r.data, "error");
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }

    });
}

$(document).ready(function(){
  lista_cor_clientes();


  var ruta = "/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/";

  $('#btn_printCorresp').click(function(){
    // Este archivo no existe
    // TODO: Pendiente realizarlo
    window.open(""+ruta+"Corresponsales/actions/corresponsales_impresion.php");
  });

  $('#genCorresponsal').click(function(){
    if($('#corp-cliente').attr('db-id') == ""){
      alertify.error("Para agregar seleccione un cliente");
      $('#corp-cliente').focus();
      return false;
    }
    txt_cliente = $('#corp-cliente').val();
    cliente = $('#corp-cliente').attr('db-id');

    parte = txt_cliente.split(cliente);
    cliente = parte[0];
    nombre = parte[1];

    var data = {
      id_cliente: $('#corp-cliente').attr('db-id'),
      s_nombre: nombre
    }
    $.ajax({
      type: "POST",
      url: ""+ruta+"Corresponsales/actions/corresposales_agregar.php",
      data: data,
      success: 	function(request){
        r = JSON.parse(request);
        if (r.code == 1) {
          swal("Exito", "Se guardo correctamente.", "success");
          lista_cor_clientes();
          $('#corp-cliente').attr('db-id', "");
          $('#corp-cliente').val("");
        } else {
          console.error(r.message);
        }
      }
    });
  });


  $('tbody').on('click', '.addCorresp', function(){
    var dbid = $(this).attr('db-id');
    $('#addCorresp').attr('db-id',dbid);
    mostrarCorrespModal(dbid);
  }); //completo


  $('tbody').on('click', '.eliminarCorresp', function(){
    var data = {
      id_cliente: $(this).attr('idcliente'),
      id_corresp: 0
    }
    var dbid = $('#addCorresp').attr('db-id');
    swal({
      title: "Estas Seguro?",
      text: "Ya no se podra recuperar el registro!",
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
        $.ajax({
          method: 'POST',
          data: data,
          url: ''+ruta+'Corresponsales/actions/corresponsales_asignarAcliente.php',
          success: function(r){
            mostrarCorrespModal(dbid);
          },
          error: function(x){
            console.error(x)
            alertify.error('NO SE PUDO ELIMINAR');
            mostrarCorrespModal(dbid);
          }
        });
        swal("Eliminado!", "Se elimino correctamente.", "success");
        mostrarCorrespModal(dbid);
      } else {
        swal("Cancelado", "El registro esta a salvo :)", "error");
        mostrarCorrespModal(dbid);
      }
    });
  })

}); // fin del documento

var ruta = "/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/";

function lista_cor_clientes(){
  var ajaxCall = $.ajax({
    method: 'POST',
    url: ''+ruta+'Corresponsales/actions/corresponsales_mostrarlista.php'
  });

  ajaxCall.done(function(r) {
    r = JSON.parse(r);
    if (r.code == 1) {
      $('#tablaCorresponsales').html(r.data);
    } else {
      console.error(r.message);
    }
  });
}

function asigCorresponsal(id_corresp,id_cliente){
  if(id_corresp > 0){
    if($('#corp-cliente').attr('db-id') == ""){
      alertify.error("Seleccione un cliente");
      $('#corp-cliente').focus();
      return false;
    }
    var data = {
      id_cliente: $('#corp-cliente').attr('db-id'),
      id_corresp: $('#id_corresp').val()
    }

  }else{
    var data = {
      id_cliente: id_cliente,
      id_corresp: id_corresp
    }
  }

  $.ajax({
    type: "POST",
    url: ""+ruta+"Corresponsales/actions/corresponsales_asignarAcliente.php",
    data: data,
    success: 	function(request){
      r = JSON.parse(request);
      if (r.code == 1) {
        swal("Exito", "Operación realizada correctamente.", "success");
        // $('.modal').modal('hide');
        // $('.addCorresp').click();
      } else {
        console.error(r.message);
      }
    }
  });
}

function mostrarCorrespModal(dbid){
  var ajaxCall = $.ajax({
    method: 'POST',
    data:{dbid:dbid},
    url: ''+ruta+'Corresponsales/actions/corresposales_mostrarModal.php'
  });

  ajaxCall.done(function(r) {
    r = JSON.parse(r);
    if (r.code == 1) {
      $('#tablaClienteCorresponsales').html(r.data);
      $('#nombre').html(r.nombre);
      $('#nombreCorresp').html(r.nombreCorresp);
    } else {
      console.error(r.message);
    }
  });
} // completo

function asigCorrespModal(id_corresp,id_cliente){
  if(id_corresp > 0){
    if($('#corp-clientem').attr('db-id') == ""){
      alertify.error("Seleccione un cliente");
      $('#corp-clientem').focus();
      return false;
    }
    var data = {
      id_cliente: $('#corp-clientem').attr('db-id'),
      id_corresp: $('#addCorresp').attr('db-id')
    }

  }else{
    var data = {
      id_cliente: id_cliente,
      id_corresp: id_corresp
    }
  }

  $.ajax({
    type: "POST",
    url: ""+ruta+"Corresponsales/actions/corresponsales_asignarAcliente.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        swal("Exito", "Operación realizada correctamente.", "success");
        $('#corp-clientem').attr('db-id', "");
        $('#corp-clientem').val("");
        mostrarCorrespModal(id_corresp);
      } else {
        console.error(r.message);
      }

    }
  });
} // completo

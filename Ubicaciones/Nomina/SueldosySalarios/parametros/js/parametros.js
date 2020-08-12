$(document).ready(function(){
tablasParametros();

  $('tbody').on('click', '.editar', function(){
    var dbid = $(this).attr('db-id');
    var tar_modal = $($(this).attr('href'));

    var fetch_art80 = $.ajax({
      method: 'POST',
      data: {dbid: dbid},
      url: '/Conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/actions/fetchParametros.php'
    });

    fetch_art80.done(function(r){
      r = JSON.parse(r);

      if (r.code == 1) {

      for (var key in r.data) {

        if (r.data.hasOwnProperty(key)) {
          var iterated_element = $('#' + key);
          var element_type = iterated_element.prop('nodeName');
          var dbid = iterated_element.attr('db-id');
          var value = r.data[key];

          iterated_element.val(value).addClass('tiene-contenido');
          if (typeof dbid !== undefined && dbid !== false) {
            iterated_element.attr('db-id', value)
          }
        }
      }
      tar_modal.modal('show');
      } else {
        console.error(r);
      }
    })
  })

  $('.m-editar').click(function(){
    var data = {
      s_nombreTabla: $('#s_nombreTabla').attr('db-id'),
      pk_id_partida: $('#pk_id_partida').attr('db-id'),
      n_inferior: $('#n_inferior').val(),
      n_superior: $('#n_superior').val(),
      n_cuota: $('#n_cuota').val(),
      n_porcentaje: $('#n_porcentaje').val(),
      fk_id_aduana: $('#fk_id_aduana').val(),
      n_salarioMinimo: $('#n_salarioMinimo').val(),
      n_diasTrabajados: $('#n_diasTrabajados').val(),
      n_diasPagar: $('#n_diasPagar').val(),
      n_anio: $('#n_anio').val(),
      n_integrado: $('#n_integrado').val(),
      n_inferior_b: $('#n_inferior_b').val(),
      n_superior_b: $('#n_superior_b').val(),
      n_cuota_b: $('#n_cuota_b').val(),
      n_ramo: $('#n_ramo').val(),
      s_descripcion: $('#s_descripcion').val(),
      n_baseSalarial: $('#n_baseSalarial').val(),
      n_topeSalarial: $('#n_topeSalarial').val(),
      n_patron: $('#n_patron').val(),
      n_trabajador: $('#n_trabajador').val(),
      n_UMA: $('#n_UMA').attr('db-id')
    }
      var act_param = $.ajax({
          method: 'POST',
          data: data,
          url: '/Conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/actions/editarParametros.php'
      });

      act_param.done(function(r) {
        r = JSON.parse(r);
        if (r.code == 1) {
          tablasParametros();
          swal("Exito", "Se actualizo.", "success");
          $('.modal').modal('hide');
        } else {
          console.error(r.message);
        }
      });
  });

  $('.m-editar113').click(function(){
    var data = {
      s_nombreTabla: $('#s_nombreTabla').attr('db-id'),
      pk_id_partida: $('#pk_id_partida').attr('db-id'),
      n_inferior: $('#n_inferior').val(),
      n_superior: $('#n_superior').val(),
      n_cuota: $('#n_cuota').val(),
      n_porcentaje: $('#n_porcentaje').val(),
    }
      var act_param = $.ajax({
          method: 'POST',
          data: data,
          url: '/Conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/actions/editarParametros.php'
      });

      act_param.done(function(r) {
        r = JSON.parse(r);
        if (r.code == 1) {
          tablasParametros113();
          swal("Exito", "Se actualizo.", "success");
          $('.modal').modal('hide');
        } else {
          console.error(r.message);
        }
      });
  });




});


function tablasParametros(){
  var ajaxCall = $.ajax({
      method: 'POST',
      url: '/Conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/actions/mostrarParametros.php'
  });

  ajaxCall.done(function(r) {
    r = JSON.parse(r);
    if (r.code == 1) {
      $('#tablaArticulo80').html(r.articulo);
      $('#tablaGenerales').html(r.generales);
      $('#f-integracion').html(r.factor);
      $('#tablaSubsidio').html(r.subsidio);
      $('#tablaImss').html(r.imss);
    } else {
      console.error(r.message);
    }
  });
}

function tablasParametros113(){
  var ajaxCall = $.ajax({
      method: 'POST',
      url: '/Conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/actions/mostrarParametros.php'
  });

  ajaxCall.done(function(r) {
    r = JSON.parse(r);
    if (r.code == 1) {
      $('#tablaArticulo113').html(r.articulo113);
    } else {
      console.error(r.message);
    }
  });
}

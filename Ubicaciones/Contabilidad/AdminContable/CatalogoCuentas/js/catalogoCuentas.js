$(document).ready(function(){
  cuentas_Det();
  fetch_cuentas_sat();


  $('#ctamaestra1').change(function(){
    id_cuenta = $('#ctamaestra1').attr('db-id');
    parteCuentaMST = id_cuenta.split('-');

    if( parteCuentaMST[0] == '0100'){
      $('#form0100').show();
      $('#form0115').hide();
      $('#form0206').hide();
    }

    if( parteCuentaMST[0] == '0115'){
      $('#form0100').hide();
      $('#form0115').show();
      $('#form0206').hide();
    }

    if( parteCuentaMST[0] == '0206'){
      $('#form0100').hide();
      $('#form0115').hide();
      $('#form0206').show();
    }

  });

  $('#ctamaestra').click(function(){
    $(this).val('0000-00000').attr('value', '0000-00000').prop('value', '0000-00000').select();
  });

  $('#generarCtaMst').click(function(){
    if($('#ctaSAT').attr('db-id') == ""){
      alertify.error("Seleccione Cuenta del SAT");
      $('#ctaSAT').focus();
      return false;
    }else if($('#naturSAT').attr('db-id') == ""){
      alertify.error("Seleccione Naturaleza de la cuenta");
      $('#naturSAT').focus();
      return false;
    }else if($('#tipo').val() == ""){
      alertify.error("Seleccione un Tipo");
      $('#tipo').focus();
      return false;
    }else if($('#ctamaestra').val() == ""){
      alertify.error("Asigne una cuenta");
      $('#ctamaestra').focus();
      return false;
    }else if($('#concepto').val() == ""){
      alertify.error("Asigne una descripción");
      $('#concepto').focus();
      return false;
    }

    var data = {
      ctaSAT: $('#ctaSAT').attr('db-id'),
      naturSAT: $('#naturSAT').attr('db-id'),
      tipo: $('#tipo').val(),
      ctamaestra: $('#ctamaestra').val(),
      concepto: $('#concepto').val(),
      accion: 'MST'
    }
    agregar_cta_maestra(data);
  });



  $('#generarCtaDet').click(function(){
    if($('#ctaSAT1').attr('db-id') == ""){
      alertify.error("Seleccione Cuenta del SAT");
      $('#ctaSAT1').focus();
      return false;
    }else if($('#naturSAT1').attr('db-id') == ""){
      alertify.error("Seleccione Naturaleza de la cuenta");
      $('#naturSAT1').focus();
      return false;
    }else if($('#ctamaestra1').attr('db-id') == ""){
      alertify.error("Asigne una cuenta");
      $('#ctamaestra1').focus();
      return false;
    }else if($('#concepto1').val() == ""){
      alertify.error("Asigne una descripción");
      $('#concepto1').focus();
      return false;
    }

    id_cuenta = $('#ctamaestra1').attr('db-id');
    parteCuentaMST = id_cuenta.split('-');

    if (parteCuentaMST[0] == '0100'){ // cuando seleccionas 0100-bancos
      if($('#banSAT').attr('db-id') == ""){
        alertify.error("Seleccione un banco");
        $('#banSAT').focus();
        return false;
      }else if( $('#banSAT').attr('db-id') == "999" && $('#nomBcoExt').val() == "" ){
        alertify.error("Es requerido el nombre del banco");
         $('#nomBcoExt').focus();
         return false;
       }else if( $('#noCuenta').val() == ""){
         alertify.error("Escriba numero de cuenta");
         $('#noCuenta').focus();
         return false;
      }else if($('#oficina').attr('db-id') == ""){
        alertify.error("Seleccione oficina");
        $('#oficina').focus();
        return false;
      }

      var data = {
        ctaSAT: $('#ctaSAT1').attr('db-id'),
        naturSAT: $('#naturSAT1').attr('db-id'),
        ctamaestra: $('#ctamaestra1').attr('db-id'),
        concepto: $('#concepto1').val(),
        accion: 'DET',
        banSAT: $('#banSAT').attr('db-id'),
        nomBcoExt: $('#nomBcoExt').val(),
        noCuenta: $('#noCuenta').val(),
        oficinaAsignar: $('#oficina').attr('db-id'),
        obser: $('#obser').val()
      }
    }

    if (parteCuentaMST[0] == '0115'){ // cuando selecciona 0115-DEUDORES
      if($('#identID').val() == ""){
        alertify.error("Seleccione cliente o empleado");
        $('#cliente0115').focus();
        return false;
      }

      var data = {
        ctaSAT: $('#ctaSAT1').attr('db-id'),
        naturSAT: $('#naturSAT1').attr('db-id'),
        ctamaestra: $('#ctamaestra1').attr('db-id'),
        concepto: $('#concepto1').val(),
        accion: 'DET',
        identID: $('#identID').val(),
        identTipo: $('#identTipo').val()
      }
    }

    if (parteCuentaMST[0] == '0206'){
      if($('#prov0206').attr('db-id') == ""){
        alertify.error("Seleccione proveedor");
        $('#prov0206').focus();
        return false;
      }

      var data = {
        ctaSAT: $('#ctaSAT1').attr('db-id'),
        naturSAT: $('#naturSAT1').attr('db-id'),
        ctamaestra: $('#ctamaestra1').attr('db-id'),
        concepto: $('#concepto1').val(),
        accion: 'DET',
        prov: $('#prov0206').attr('db-id')
      }
    }

    if (parteCuentaMST[0] != '0100' && parteCuentaMST[0] != '0115' && parteCuentaMST[0] != '0206'){
      var data = {
        ctaSAT: $('#ctaSAT1').attr('db-id'),
        naturSAT: $('#naturSAT1').attr('db-id'),
        ctamaestra: $('#ctamaestra1').attr('db-id'),
        concepto: $('#concepto1').val(),
        accion: 'DET'
      }
    }

    agregar_cta_maestra(data);
  });


  $('#generarCtaCLT').click(function(){
    if($('#clt').attr('db-id') == ""){
      alertify.error("Seleccioe un cliente");
      $('#clt').focus();
      return false;
    }
    var data = {
      cliente: $('#clt').attr('db-id'),
      accion: 'cliente'
    }
    agregar_cta_maestra(data);
  });


  $('tbody').on('click', '.editar-cuenta', function(){
    var dbid = $(this).attr('db-id');
    var tar_modal = $($(this).attr('href'));
    var fetch_cuenta = $.ajax({
      method: 'POST',
      data: {dbid: dbid},
      url: 'actions/fetch.php'
    });

    fetch_cuenta.done(function(r){
      r = JSON.parse(r);
      if (r.code == 1) {

      for (var key in r.data) {
        if ($('#' + key).is('select')) {
          continue;
        }

        if (r.data.hasOwnProperty(key)) {
          $('#' + key).html(r['data'][key]).val(r['data'][key]).addClass('tiene-contenido');
          if ( typeof($('#'+key).attr('db-id')) != 'undefined' && $('#'+key).attr('db-id') !== false) {
            $('#' + key).attr('db-id', r['data'][key]);
          }
        }
      }

      $('#s_cta_status').val(r.data.s_cta_status);
      $('#medit-ctas').attr('db-id', r.data.pk_id_cuenta);

      tar_modal.modal('show');
      } else {
        console.error(r);
      }
    })
  })


  $('#medit-ctas').click(function(){

    if($('#medit-ctaSAT').attr('db-id') == ""){
      alertify.error("Seleccione cuenta del SAT");
      $('#medit-ctaSAT').focus();
      return false;
    }

    if($('#medit-concepto').val() == ""){
      alertify.error("Asigne un concepto");
      $('#medit-concepto').focus();
      return false;
    }

    if($('#medit-status').val() == ""){
      alertify.error("Seleccione el estatutus de captura");
      $('#medit-status').focus();
      return false;
    }

    if($('#medit-naturSAT').attr('db-id') == ""){
      alertify.error("Seleccione Naturaleza de la cuenta");
      $('#medit-naturSAT').focus();
      return false;
    }

    if($('#medit-prodServ').attr('db-id') == ""){
      alertify.error("Seleccione clave de producto");
      $('#medit-prodServ').focus();
      return false;
    }

    var data = {
      id_cuenta: $('#pk_id_cuenta').attr('db-id'),
      cuenta_sat: $('#fk_codAgrup').attr('db-id'),
      concepto: $('#s_cta_desc').val(),
      status: $('#s_cta_status').val(),
      naturSAT: $('#fk_id_naturaleza').attr('db-id'),
      prodServ: $('#fk_c_ClaveProdServ').attr('db-id'),
    }

    $.ajax({
      type: "POST",
      url: "/Ubicaciones/Contabilidad/AdminContable/actions/editar.php",
      data: data,
      success: 	function(r){
        console.log(r);
        r = JSON.parse(r);
        if (r.code == 1) {
          cuentas_Det();
          swal("Exito", "La cuenta se actualizó correctamente.", "success");
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });
    $('.modal').modal('hide');
  })

  // TODO: Este archivo se tendra que hacer en pdf
  $('#printCatCuentas').click(function(){
    window.open('/Ubicaciones/Contabilidad/AdminContable/CatalogoCuentas/imprimir_catalogoCtas.php');
  });

}); // fin del documento




function cuentas_Det(){
  $.ajax({
    method: 'POST',
    url: '/Ubicaciones/Contabilidad/AdminContable/CatalogoCuentas/actions/tablacuentasDet.php',
    success: function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#tabla_cuentas').html(r.data);
      } else {
        console.error(r.message);
      }
    }
  })
}

function CLTasignado(){
  cliente = $('#client0115').attr('db-id');
  $('#identTipo').val('cliente');
  $('#identID').val(cliente);

  nom = $('#client0115').val();
  parte = nom.split('-');
  $('#concepto1').val(parte[1]);
}

function empAsignado(){
  empleado = $('#emp0115').attr('db-id');
  $('#identTipo').val('empleado');
  $('#identID').val(empleado);

  nom = $('#emp0115').val();
  parte = nom.split('-');
  $('#concepto1').val(parte[1]);
}

function provAsignado(){
  nom = $('#prov0206').val();
  parte = nom.split('-');
  $('#concepto1').val(parte[1]);
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
    url: "/Ubicaciones/Contabilidad/AdminContable/actions/asignarCorresponsalAcliente.php",
    data: data,
    success: 	function(request){
      r = JSON.parse(request);
      console.log(r);
      if (r.code == 1) {
        swal("Exito", "Operación realizada correctamente.", "success");
        location.reload();
      } else {
        console.error(r.message);
      }

    }
  });
}


function correspAsignar(id_corresp){
  window.location.replace('/Ubicaciones/Contabilidad/AdminContable/CorresponsalesAsignar.php?id_corresp='+id_corresp);
}
function fetch_cuentas_sat(){
    $.ajax({
      method: 'POST',
      url: '/Resources/PHP/actions/lst_conta_cs_sat_cuentas.php',
      success: function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          $('#catalogo-sat-helper').html(r.data);
        } else {
          console.error(r.message);
        }
      }
    })
}


function agregar_cta_maestra(data){
  var ajaxCall = $.ajax({
    method: 'POST',
    data: data,
    url: '/Ubicaciones/Contabilidad/AdminContable/CatalogoCuentas/actions/agregar.php'
  });

  ajaxCall.done(function(r) {
    r = JSON.parse(r);
    if (r.code == 1) {
      swal("Exito", "Se agrego correctamente.", "success");
      cuentas_Det();
    } else {
      alertify.error('Algo salio Mal');
      console.error(r.message);
    }
  });
}

function valida_ctamaestra(){
  var ctamaestra = $('#ctamaestra').val();
  // 0400-00000
  if( (!/^(\d{4})\-(\d{5})+$/.test(ctamaestra)) || ctamaestra == "" ){
     alertify.error("La Cuenta Maestra no corresponde al formato: 0000-00000");
     $('#ctamaestra').focus();
    return false;
  }else{
    if(ctamaestra == '0000-00000'){
      swal("Ingrese una cuenta");
       $('#ctamaestra').focus();
       return false;
    }else{
      $('#respuestaCtasMST').html("");
      return true;
    }
  }
}

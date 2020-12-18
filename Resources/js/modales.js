$(document).ready(function(){


  // NOTE: btn_asignarProveedor marca error porque no existe la pagina Contabilidad/Proveedores/AsignarProveedor.php
  $('#btn_asignarProveedor').click(function(){
  	id_poliza = $('#folioPolAsignar').val();
  	window.location.replace('/Ubicaciones/Contabilidad/Proveedores/AsignarProveedor.php?id_poliza='+id_poliza);
  });

  $('#btn_busCheModifi').click(function(){
    id_cheque = $('#mModifiChIdcheque').val();
    id_cuentaMST = $('#mModifiChCtaMST').attr('db-id');
    window.location.replace('/Ubicaciones/Contabilidad/cheques/Detallecheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
  });

  $('#btn_busCheConsulta').click(function(){
    id_cheque = $('#mConsChIdcheque').val();
    id_cuentaMST = $('#mConsChCtaMST').attr('db-id');
    window.location.replace('/Ubicaciones/Contabilidad/cheques/ConsultarCheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
  });

  $('#btn_buscarFacturasTimbradas').click(function(){
    id_referencia = $('#b-referencia').attr('db-id');
    id_factura = $('#b-factura').attr('db-id');
    id_cliente = $('#b-cliente').attr('db-id');
    if( id_referencia != "" ){
      buscar = id_referencia;
    }else if( id_factura != "" ){
        buscar = id_factura;
      }else if( id_cliente != "" ){
        buscar = id_cliente;
      }else{
        alertify.error("No hay resultados");
      }
    accion = 'consultar';
    window.location.replace('/Ubicaciones/Contabilidad/facturaelectronica/4-Consultarfactura.php?buscar='+buscar+'&accion='+accion);
  });

  $('#btn_buscarFacturasTimbradas_cancela').click(function(){
    id_referencia = $('#b-referencia1').attr('db-id');
    id_factura = $('#b-factura1').attr('db-id');
    id_cliente = $('#b-cliente1').attr('db-id');
    if( id_referencia != "" ){
      buscar = id_referencia;
    }else if( id_factura != "" ){
        buscar = id_factura;
      }else if( id_cliente != "" ){
        buscar = id_cliente;
      }else{
        alertify.error("No hay resultados");
      }
    accion = 'cancelar';
    window.location.replace('/Ubicaciones/Contabilidad/facturaelectronica/4-Consultarfactura.php?buscar='+buscar+'&accion='+accion);
  });

})



function buscarPoliza(Accion){
  if( Accion == 'consultar'){ id_poliza = $('#folioPolconsulta').val(); }
  if( Accion == 'modificar'){ id_poliza = $('#folioPol').val(); }
  window.location.replace('/Ubicaciones/Contabilidad/polizas/actions/buscar_poliza.php?id_poliza='+id_poliza+'&Accion='+Accion);
}

function buscarAnticipo(Accion){
	if( Accion == 'consultar' ){
    id_anticipo = $('#folioAntConsulta').val();
    window.location.replace('/Ubicaciones/Contabilidad/anticipos/ConsultarAnticipo.php?id_anticipo='+id_anticipo);
  }
	if( Accion == 'modificar' ){
    id_anticipo = $('#folioAnt').val();
    window.location.replace('/Ubicaciones/Contabilidad/anticipos/Detalleanticipo.php?id_anticipo='+id_anticipo);
  }
}

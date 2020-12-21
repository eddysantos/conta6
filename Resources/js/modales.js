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

function validarCtasGastoOficina(st){
	/* CUENTAS QUE REQUIEREN ASIGNAR OFICINA PARA REFLEJAR EL GASTO */
	nombreCta = st.split('-');

	if(st.substring(0,2) == '05' ||
	   st.substring(0,4) == '0147' || st.substring(0,4) == '0148' || st.substring(0,4) == '0149' ||
		 st.substring(0,4) == '0420' || st.substring(0,4) == '0430' ||
		 st.substring(0,10) == '0168-00005' ||
		 st.substring(0,10) == '0201-00002' || st.substring(0,10) == '0201-00003' || st.substring(0,10) == '0201-00004' ||
		 st.substring(0,10) == '0201-00005' || st.substring(0,10) == '0201-00006' || st.substring(0,10) == '0201-00007' ){

		 return true;
	}
}


function valDescripOficina(){
		/********************************************************************************************************
		PARAMETRO DE DISTINCION EN EL GASTO, NO BASTA SOLO CON ASIGNAR LA OFICINA.
		CUANDO ES EL CASO QUE HAY MAS DE UN REGISTRO IGUAL EN LA MISMA POLIZA, SE REPIDE LA PARTIDA EN EL GASTO;
		PARA EVITAR ESTO SE ASIGNA UN PARAMETRO QUE HACE LA DISTINCION EN LA DESCRIPCION
		*/
		desc = $('#detpol-concepto').val();
		desc = desc.replace(" ::160::","");
		desc = desc.replace(" ::240::","");
		desc = desc.replace(" ::430::","");
		desc = desc.replace(" ::470::","");
		desc = desc.replace(" ::241::","");

		gastoOficina = $('#detpol-gtoficina').attr('db-id');
		descOficina = "";

		if (gastoOficina == 160){ descOficina = "::160::"; }
		if (gastoOficina == 240){ descOficina = "::240::"; }
		if (gastoOficina == 430){ descOficina = "::430::"; }
		if (gastoOficina == 470){ descOficina = "::470::"; }
		if (gastoOficina == 241){ descOficina = "::241::"; }

 		desc = desc + " " + descOficina;
		$('#detpol-concepto').val(desc);
}

function validarCtasCliente(st){
	/* CUENTAS QUE REQUIEREN ASIGNAR CLIENTE */
	nombreCta = st.split('-');

	if(st.substring(0,4) == '0108' || st.substring(0,4) == '0208' || st.substring(0,4) == '0106' || st.substring(0,4) == '0203'){
		 return true;
	}
}


function validarCtasPagosCliente(st){
	/* CUENTAS QUE REQUIEREN ASIGNAR CLIENTE */
	nombreCta = st.split('-');

	if(st.substring(0,4) == '0110'){
		 return true;
	}
}

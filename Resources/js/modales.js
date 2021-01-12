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

  $('#medit-partida').click(function(){
      var id_referencia = $('#fk_referencia').attr('db-id');
      partida = $('#pk_partida').val();
      id_poliza = $('#fk_id_poliza').val();
      fecha = $('#d_fecha').val();
      tipo = $('#fk_tipo').val();
      cuenta = $('#fk_id_cuenta').attr('db-id');
      documento = $('#s_folioCFDIext').val();
      factura = $('#fk_factura').attr('db-id');
      anticipo = $('#fk_anticipo').attr('db-id');
      cheque = $('#fk_cheque').attr('db-id');
      cargo = $('#n_cargo').val();
      abono = $('#n_abono').val();
      desc = $('#s_desc').val();
      gastoOficina = $('#fk_gastoAduana').attr('db-id');
      proveedor = $('#fk_id_proveedor').attr('db-id');

      if (id_referencia == 'SN' || id_referencia == '') {
        cliente = $('#fk_id_cliente').attr('db-id');
      }else {
        cliente = $('#modalpol-clienteCorresp').val();
      }
      id_cliente = cliente;

      if(cuenta == ""){
        alertify.error("Seleccione una cuenta");
        $('#fk_id_cuenta').focus();
        return false;
      }else{
        if(desc == ""){
          alertify.error("Ingrese una descripción");
          $('#s_desc').focus();
          return false;
        }else{
          if( (cargo == 0 && abono == 0) || (cargo > 0 && abono > 0) ){
            alertify.error("Ingrese un importe")
            $('#n_cargo').focus();
            if(cargo > 0 && abono > 0){ $('#n_cargo').val(0); $('#n_abono').val(0); }
            return false
          }else{
            st = cuenta;
            if( validarCtasGastoOficina(st) == true || validarCtasCliente(st) == true || validarCtasPagosCliente(st) == true ){

              if( validarCtasGastoOficina(st) == true ){
                if( gastoOficina == ''){
                  alertify.error("Seleccione una Oficina");
                  $('#detpol-gtoficina').focus();
                  return false
                }else{
                  actualizaRegPol();
                }
              }

              if (validarCtasPagosCliente(st) == true) {
                if (id_referencia == 0){
                  alertify.error("Ingrese n\u00FAmero de Referencia");
                  $('#detpol-referencia').focus();
                  return false;
                }else{
                  //SIEMPRE VALIDAR QUE LA REFERENCIA EXISTA EN LA TABLA DE REFERENCIAS
                  if (id_referencia != "SN" ){
                    if (id_cliente == 0){
                      alertify.error("Seleccione un Cliente");
                      $('#detpol-cliente').focus();
                      return false
                    }else{
                      actualizaRegPol();
                    }
                  }else{
                    if (id_cliente == 0){
                      alertify.error("Seleccione un Cliente");
                      $('#detpol-cliente').focus();
                      return false
                    }else{
                      actualizaRegPol();
                    }
                  }
                }
              }

              if( validarCtasCliente(st) == true ){
                if( cuenta == '0208-00001'){
                  $('#detpol-cliente').attr('db-id')='';
                  $('#detpol-cliente').val('');
                  id_cliente = 0;
                  actualizaRegPol();
                }else{
                  if(id_cliente == ''){
                    alertify.error("Seleccione un Cliente");
                    $('#detpol-cliente').focus();
                    return false
                  }else{
                    parte_Cuenta = cuenta.split('-');
                    parte_Cliente = id_cliente.split('_');
                    if( parte_Cuenta[1].search(parte_Cliente[1]) == -1){
                      alertify.error("La cuenta contable no corresponde al cliente seleccionado");
                      $('#detpol-cliente').focus();
                      return false
                    }else{
                      actualizaRegPol();
                    }
                  }
                }
              }

            }else{
              actualizaRegPol();
            }
          }
        }
      }



  });


})





function actualizaRegPol(){
			var id_referencia = $('#fk_referencia').attr('db-id');

		  if (id_referencia == 'SN' || id_referencia == '') {
		    cliente = $('#fk_id_cliente').attr('db-id');
		  }else {
		    cliente = $('#modalpol-clienteCorresp').val();
		  }


			var data = {
				partida: $('#pk_partida').val(),
				id_poliza: $('#fk_id_poliza').val(),
				fecha: $('#d_fecha').val(),
				id_referencia: id_referencia,
				tipo: $('#fk_tipo').val(),
				cuenta: $('#fk_id_cuenta').attr('db-id'),
				id_cliente: cliente,
				documento: $('#s_folioCFDIext').val(),
				factura: $('#fk_factura').attr('db-id'),
				anticipo: $('#fk_anticipo').attr('db-id'),
				cheque: $('#fk_cheque').attr('db-id'),
				cargo: $('#n_cargo').val(),
				abono: $('#n_abono').val(),
				desc: $('#s_desc').val(),
				gastoOficina: $('#fk_gastoAduana').attr('db-id'),
				proveedor: $('#fk_id_proveedor').attr('db-id')
			}

			$.ajax({
				type: "POST",
				url: "/Ubicaciones/Contabilidad/polizas/actions/editar.php",
				data: data,
				success: 	function(r){
					console.log(r);
					r = JSON.parse(r);
					if (r.code == 1) {
						swal("Exito", "La cuenta se actualizó correctamente.", "success");

						window.location.reload();
					} else {
						console.error(r.message);
					}
				},
				error: function(x){
					console.error(x);
				}
			});
		$('#detpol-editarRegPolDiario').modal('hide');
}

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
	   st.substring(0,4) == '0147' || st.substring(0,4) == '0148' || st.substring(0,4) == '0149' || st.substring(0,4) == '0150' ||
		 st.substring(0,4) == '0420' || st.substring(0,4) == '0430' ||
		 st.substring(0,10) == '0168-00005' ||
		 st.substring(0,10) == '0201-00002' || st.substring(0,10) == '0201-00003' || st.substring(0,10) == '0201-00004' ||
		 st.substring(0,10) == '0201-00005' || st.substring(0,10) == '0201-00006' || st.substring(0,10) == '0201-00007' ){

		 return true;
	}
}


function valDescripOficina_modal(){
		/********************************************************************************************************
		PARAMETRO DE DISTINCION EN EL GASTO, NO BASTA SOLO CON ASIGNAR LA OFICINA.
		CUANDO ES EL CASO QUE HAY MAS DE UN REGISTRO IGUAL EN LA MISMA POLIZA, SE REPIDE LA PARTIDA EN EL GASTO;
		PARA EVITAR ESTO SE ASIGNA UN PARAMETRO QUE HACE LA DISTINCION EN LA DESCRIPCION
		*/
		desc = $('#s_desc').val();
		desc = desc.replace(" ::160::","");
		desc = desc.replace(" ::240::","");
		desc = desc.replace(" ::430::","");
		desc = desc.replace(" ::470::","");
		desc = desc.replace(" ::241::","");

		gastoOficina = $('#fk_gastoAduana').attr('db-id');
		descOficina = "";

		if (gastoOficina == 160){ descOficina = "::160::"; }
		if (gastoOficina == 240){ descOficina = "::240::"; }
		if (gastoOficina == 430){ descOficina = "::430::"; }
		if (gastoOficina == 470){ descOficina = "::470::"; }
		if (gastoOficina == 241){ descOficina = "::241::"; }

 		desc = desc + " " + descOficina;
		$('#s_desc').val(desc);
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

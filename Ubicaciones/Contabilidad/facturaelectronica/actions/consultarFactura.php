<?PHP

$query_consultaFactura = "SELECT * FROM conta_t_facturas_cfdi where fk_id_cuenta_captura = ? ";

$stmt_consultaFactura = $db->prepare($query_consultaFactura);
if (!($stmt_consultaFactura)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaFactura->bind_param('s',$cuenta);
if (!($stmt_consultaFactura)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaFactura->errno]: $stmt_consultaFactura->error";
	exit_script($system_callback);
}
if (!($stmt_consultaFactura->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaFactura->errno]: $stmt_consultaFactura->error";
	exit_script($system_callback);
}

$rslt_consultaFactura = $stmt_consultaFactura->get_result();
$total_consultaFactura = $rslt_consultaFactura->num_rows;

if( $total_consultaFactura > 0 ) {
	$row_consultaFactura = $rslt_consultaFactura->fetch_assoc();

	$pk_id_factura = $row_consultaFactura['pk_id_factura'];
	$d_fechaVencimiento = $row_consultaFactura['d_fechaVencimiento'];
	if (!is_null($d_fechaVencimiento)){ $d_fechaVencimiento = date_format(date_create($d_fechaVencimiento),"d-m-Y H:i:s"); }
	$fechaTimbrado = $row_consultaFactura['d_fechaTimbrado'];
	$d_fechaTimbrado = $row_consultaFactura['d_fechaTimbrado'];
	if (!is_null($d_fechaTimbrado)){ $d_fechaTimbrado = date_format(date_create($d_fechaTimbrado),"d-m-Y\TH:i:s"); }
	$fk_id_certificado = $row_consultaFactura['fk_id_certificado'];
	$s_CFDversion = $row_consultaFactura['s_CFDversion'];
	$s_UUID = $row_consultaFactura['s_UUID'];
	$s_id_certificadoSAT = $row_consultaFactura['s_id_certificadoSAT'];
	$s_timbradoVersion = $row_consultaFactura['s_timbradoVersion'];
	$s_selloCFDI = $row_consultaFactura['s_selloCFDI'];
	$s_id_certificadoSAT = $row_consultaFactura['s_id_certificadoSAT'];
	$s_selloSAT = $row_consultaFactura['s_selloSAT'];
	$id_poliza_factura = $row_consultaFactura['fk_id_poliza'];
	$fk_usuario_timbrado = $row_consultaFactura['fk_usuario'];

	/*
	$d_fecha_cta = $row_consultaFactura['d_fecha_cta'];
	$fk_usuario = $row_consultaFactura['fk_usuario'];
	$d_fecha_modifi = $row_consultaFactura['d_fecha_modifi'];

	$s_usuario_modifi = $row_consultaFactura['s_usuario_modifi'];
	$fk_referencia = $row_consultaFactura['fk_referencia'];
	$fk_id_aduana = $row_consultaFactura['fk_id_aduana'];
	$fk_id_almacen = $row_consultaFactura['fk_id_almacen'];
	$fk_id_cliente = $row_consultaFactura['fk_id_cliente'];
	$s_nombre = $row_consultaFactura['s_nombre'];
	$s_calle = $row_consultaFactura['s_calle'];
	$s_no_ext = $row_consultaFactura['s_no_ext'];
	$s_no_int = $row_consultaFactura['s_no_int'];
	$s_colonia = $row_consultaFactura['s_colonia'];
	$s_codigo = $row_consultaFactura['s_codigo'];
	$s_ciudad = $row_consultaFactura['s_ciudad'];
	$s_estado = $row_consultaFactura['s_estado'];
	$s_pais = $row_consultaFactura['s_pais'];
	$s_taxid = $row_consultaFactura['s_taxid'];
	$s_rfc = $row_consultaFactura['s_rfc'];
	$s_proveedor_destinatario = $row_consultaFactura['s_proveedor_destinatario'];
	$s_imp_exp = $row_consultaFactura['s_imp_exp'];
	$n_valor = $row_consultaFactura['n_valor'];
	$n_peso = $row_consultaFactura['n_peso'];
	$n_diasEnAlmacen = $row_consultaFactura['n_diasEnAlmacen'];
	$n_POCME_total_gral = $row_consultaFactura['n_POCME_total_gral'];
	$n_POCME_tipo_cambio = $row_consultaFactura['n_POCME_tipo_cambio'];
	$n_POCME_total_MN = $row_consultaFactura['n_POCME_total_MN'];
	$n_total_custodia = $row_consultaFactura['n_total_custodia'];
	$n_total_manejo = $row_consultaFactura['n_total_manejo'];
	$n_total_almacenaje = $row_consultaFactura['n_total_almacenaje'];
	$n_total_maniobras = $row_consultaFactura['n_total_maniobras'];
	$n_total_subsidiado = $row_consultaFactura['n_total_subsidiado'];
	$n_IVA_aplicado = $row_consultaFactura['n_IVA_aplicado'];

	$s_txt_gral_importe = $row_consultaFactura['s_txt_gral_importe'];
	$n_total_gral_importe = $row_consultaFactura['n_total_gral_importe'];
	$n_txt_gral_IVA = $row_consultaFactura['n_txt_gral_IVA'];
	$n_total_gral_IVA = $row_consultaFactura['n_total_gral_IVA'];
	$s_txt_total_honorarios = $row_consultaFactura['s_txt_total_honorarios'];
	$n_total_honorarios = $row_consultaFactura['n_total_honorarios'];
	$s_txt_fac_IVA_retenido = utf8_encode($row_consultaFactura['s_txt_fac_IVA_retenido']);
	$s_fac_IVA_retenido = $row_consultaFactura['s_fac_IVA_retenido'];
	$s_txt_total_gral = $row_consultaFactura['s_txt_total_gral'];
	$n_total_gral = $row_consultaFactura['n_total_gral'];
	$s_POCME_descripcion_gral = $row_consultaFactura['s_POCME_descripcion_gral'];
	$n_total_POCME = $row_consultaFactura['n_total_POCME'];
	$s_txt_total_pagos = $row_consultaFactura['s_txt_total_pagos'];
	$n_total_pagos = $row_consultaFactura['n_total_pagos'];
	$s_txt_cta_gastos = $row_consultaFactura['s_txt_cta_gastos'];
	$n_total_cta_gastos = $row_consultaFactura['n_total_cta_gastos'];
	$s_total_cta_gastos_letra = $row_consultaFactura['s_total_cta_gastos_letra'];
	$s_txt_total_depositos = utf8_encode($row_consultaFactura['s_txt_total_depositos']);
	$n_total_depositos = $row_consultaFactura['n_total_depositos'];

	$s_txt_fac_saldo = $row_consultaFactura['s_txt_fac_saldo'];
	$n_fac_saldo = $row_consultaFactura['n_fac_saldo'];
	$s_total_letra = $row_consultaFactura['s_total_letra'];
	$n_tipoCambio = $row_consultaFactura['n_tipoCambio'];
	$fk_id_moneda = $row_consultaFactura['fk_id_moneda'];
	$pk_c_UsoCFDI = trim($row_consultaFactura['pk_c_UsoCFDI']);
	$fk_id_asoc = $row_consultaFactura['fk_id_asoc'];
	$s_tipoDeComprobante = $row_consultaFactura['s_tipoDeComprobante'];
	$fk_id_formapago = $row_consultaFactura['fk_id_formapago'];
	$s_numCtaPago = $row_consultaFactura['s_numCtaPago'];
	$fk_c_MetodoPago = $row_consultaFactura['fk_c_MetodoPago'];
	$s_lugarExpedicion = $row_consultaFactura['s_lugarExpedicion'];
	$s_lugarExpedicion_txt = $row_consultaFactura['s_lugarExpedicion_txt'];
	$s_emisor_razon_social = $row_consultaFactura['s_emisor_razon_social'];
	$s_emisor_rfc = $row_consultaFactura['s_emisor_rfc'];
	$s_regimenFiscal = $row_consultaFactura['s_regimenFiscal'];
	$n_statuspagada = $row_consultaFactura['n_statuspagada'];

	if( $fk_id_asoc == 1 ){ $txt_id_asoc = 'Si'; }
	*/
}

?>

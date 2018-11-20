<?PHP

$query_consultaGenerales = "SELECT * FROM conta_t_notacredito_captura where pk_id_cuenta_captura_nc = ? ";

$stmt_consultaGenerales = $db->prepare($query_consultaGenerales);
if (!($stmt_consultaGenerales)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaGenerales->bind_param('s',$cuenta);
if (!($stmt_consultaGenerales)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaGenerales->errno]: $stmt_consultaGenerales->error";
	exit_script($system_callback);
}
if (!($stmt_consultaGenerales->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaGenerales->errno]: $stmt_consultaGenerales->error";
	exit_script($system_callback);
}

$rslt_consultaGenerales = $stmt_consultaGenerales->get_result();
$total_consultaGenerales = $rslt_consultaGenerales->num_rows;

if( $total_consultaGenerales > 0 ) {
	$row_consultaGenerales = $rslt_consultaGenerales->fetch_assoc();

	$pk_id_cuenta_captura = $row_consultaGenerales['pk_id_cuenta_captura_nc'];
	$d_fecha_cta = $row_consultaGenerales['d_fecha_cta'];
	$fk_usuario = $row_consultaGenerales['fk_usuario'];
	$d_fecha_modifi = $row_consultaGenerales['d_fecha_modifi'];
	if (!is_null($d_fecha_modifi)){ $d_fecha_modifi = date_format(date_create($d_fecha_modifi),"d-m-Y H:i:s"); }
	$s_usuario_modifi = $row_consultaGenerales['s_usuario_modifi'];
	$fk_referencia = $row_consultaGenerales['fk_referencia'];
	$fk_id_aduana = $row_consultaGenerales['fk_id_aduana'];
	$fk_id_almacen = $row_consultaGenerales['fk_id_almacen'];
	$fk_id_cliente = $row_consultaGenerales['fk_id_cliente'];
	$s_nombre = $row_consultaGenerales['s_nombre'];
	$s_calle = $row_consultaGenerales['s_calle'];
	$s_no_ext = $row_consultaGenerales['s_no_ext'];
	$s_no_int = $row_consultaGenerales['s_no_int'];
	$s_colonia = $row_consultaGenerales['s_colonia'];
	$s_codigo = $row_consultaGenerales['s_codigo'];
	$s_ciudad = $row_consultaGenerales['s_ciudad'];
	$s_estado = $row_consultaGenerales['s_estado'];
	$s_pais = $row_consultaGenerales['s_pais'];
	$s_taxid = $row_consultaGenerales['s_taxid'];
	$s_rfc = $row_consultaGenerales['s_rfc'];
	$s_proveedor_destinatario = $row_consultaGenerales['s_proveedor_destinatario'];
	$s_imp_exp = $row_consultaGenerales['s_imp_exp'];
	$n_valor = $row_consultaGenerales['n_valor'];
	$n_peso = $row_consultaGenerales['n_peso'];
	$n_diasEnAlmacen = $row_consultaGenerales['n_diasEnAlmacen'];
	$n_POCME_total_gral = $row_consultaGenerales['n_POCME_total_gral'];
	$n_POCME_tipo_cambio = $row_consultaGenerales['n_POCME_tipo_cambio'];
	$n_POCME_total_MN = $row_consultaGenerales['n_POCME_total_MN'];
	$n_total_custodia = $row_consultaGenerales['n_total_custodia'];
	$n_total_manejo = $row_consultaGenerales['n_total_manejo'];
	$n_total_almacenaje = $row_consultaGenerales['n_total_almacenaje'];
	$n_total_maniobras = $row_consultaGenerales['n_total_maniobras'];
	$n_total_subsidiado = $row_consultaGenerales['n_total_subsidiado'];
	$n_IVA_aplicado = $row_consultaGenerales['n_IVA_aplicado'];

	$s_txt_gral_importe = $row_consultaGenerales['s_txt_gral_importe'];
	$n_total_gral_importe = $row_consultaGenerales['n_total_gral_importe'];
	$n_txt_gral_IVA = $row_consultaGenerales['n_txt_gral_IVA'];
	$n_total_gral_IVA = $row_consultaGenerales['n_total_gral_IVA'];
	$s_txt_total_honorarios = $row_consultaGenerales['s_txt_total_honorarios'];
	$n_total_honorarios = $row_consultaGenerales['n_total_honorarios'];
	$s_txt_fac_IVA_retenido = utf8_encode($row_consultaGenerales['s_txt_fac_IVA_retenido']);
	$s_fac_IVA_retenido = $row_consultaGenerales['s_fac_IVA_retenido'];
	$s_txt_total_gral = $row_consultaGenerales['s_txt_total_gral'];
	$n_total_gral = $row_consultaGenerales['n_total_gral'];
	$s_POCME_descripcion_gral = $row_consultaGenerales['s_POCME_descripcion_gral'];
	$n_total_POCME = $row_consultaGenerales['n_total_POCME'];
	$s_txt_total_pagos = $row_consultaGenerales['s_txt_total_pagos'];
	$n_total_pagos = $row_consultaGenerales['n_total_pagos'];
	$s_txt_cta_gastos = $row_consultaGenerales['s_txt_cta_gastos'];
	$n_total_cta_gastos = $row_consultaGenerales['n_total_cta_gastos'];
	$s_total_cta_gastos_letra = $row_consultaGenerales['s_total_cta_gastos_letra'];
	$s_txt_total_depositos = utf8_encode($row_consultaGenerales['s_txt_total_depositos']);
	$n_total_depositos = $row_consultaGenerales['n_total_depositos'];

	$s_txt_fac_saldo = $row_consultaGenerales['s_txt_fac_saldo'];
	$n_fac_saldo = $row_consultaGenerales['n_fac_saldo'];
	$s_total_letra = $row_consultaGenerales['s_total_letra'];
	$n_tipoCambio = $row_consultaGenerales['n_tipoCambio'];
	$fk_id_moneda = $row_consultaGenerales['fk_id_moneda'];
	$pk_c_UsoCFDI = trim($row_consultaGenerales['pk_c_UsoCFDI']);
	$fk_id_asoc = $row_consultaGenerales['fk_id_asoc'];
	$s_tipoDeComprobante = $row_consultaGenerales['s_tipoDeComprobante'];
	$fk_id_formapago = $row_consultaGenerales['fk_id_formapago'];
	$s_numCtaPago = $row_consultaGenerales['s_numCtaPago'];
	$fk_c_MetodoPago = $row_consultaGenerales['fk_c_MetodoPago'];
	$s_lugarExpedicion = $row_consultaGenerales['s_lugarExpedicion'];
	$s_lugarExpedicion_txt = $row_consultaGenerales['s_lugarExpedicion_txt'];
	$s_emisor_razon_social = $row_consultaGenerales['s_emisor_razon_social'];
	$s_emisor_rfc = $row_consultaGenerales['s_emisor_rfc'];
	$s_regimenFiscal = $row_consultaGenerales['s_regimenFiscal'];
	$n_statuspagada = $row_consultaGenerales['n_statuspagada'];

	$formaPago = $row_consultaGenerales['fk_id_formapago'];
	if( $fk_id_asoc == 1 ){ $txt_id_asoc = 'Si'; }

	//datos de la factura a la que le corresponde
	$id_facturaRelacionada = $row_consultaGenerales['fk_id_factura'];
	$s_UUID_factura = $row_consultaGenerales['s_UUID_factura'];
	$n_total_factura = $row_consultaGenerales['n_total_factura'];
}

?>

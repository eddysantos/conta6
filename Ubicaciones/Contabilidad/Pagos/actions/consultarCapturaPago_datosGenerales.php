<?PHP

$query_consultaGenerales = "SELECT * FROM conta_t_pagos_captura where pk_id_pago_captura = ? ";

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

	$pk_id_pago_captura = $row_consultaGenerales['pk_id_pago_captura'];
	$fk_usuario_alta = $row_consultaGenerales['fk_usuario_alta'];
	$fecha_alta = $row_consultaGenerales['d_fecha_alta'];
	if (!is_null($fecha_alta)){ $d_fecha_alta = date_format(date_create($fecha_alta),"d-m-Y H:i:s"); }
	$fecha_modifi = $row_consultaGenerales['d_fecha_modifi'];
	if (!is_null($fecha_modifi)){ $d_fecha_modifi = date_format(date_create($fecha_modifi),"d-m-Y H:i:s"); }
	$s_usuario_modifi = $row_consultaGenerales['s_usuario_modifi'];
	$fk_id_aduana = $row_consultaGenerales['fk_id_aduana'];
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
	$s_lugarExpedicion_txt = $row_consultaGenerales['s_lugarExpedicion_txt'];

	$n_cantidad = $row_consultaGenerales['n_cantidad'];
	$fk_c_claveUnidad = $row_consultaGenerales['fk_c_claveUnidad'];
	$fk_c_ClaveProdServ = $row_consultaGenerales['fk_c_ClaveProdServ'];
	$s_descripcion = $row_consultaGenerales['s_descripcion'];
	$n_valor_unitario = $row_consultaGenerales['n_valor_unitario'];
	$n_importe = $row_consultaGenerales['n_importe'];

	$fk_c_TipoRelacion = $row_consultaGenerales['fk_c_TipoRelacion'];
	$n_folioPagoSustituir = $row_consultaGenerales['n_folioPagoSustituir'];
	$s_UUIDpagoSustituir = $row_consultaGenerales['s_UUIDpagoSustituir'];

	$s_emisor_regimen = $row_consultaGenerales['s_emisor_regimen'];
	$fk_c_UsoCFDI = $row_consultaGenerales['fk_c_UsoCFDI'];
	$fk_id_monedaPago = $row_consultaGenerales['fk_id_monedaPago'];

}

?>

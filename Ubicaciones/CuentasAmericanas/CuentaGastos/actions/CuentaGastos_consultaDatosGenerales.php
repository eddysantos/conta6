<?PHP

$query_consultaGenerales = "SELECT * FROM contame_t_facturas where pk_id_ctaAme = ? ";

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

	$pk_id_ctaAme = $row_consultaGenerales['pk_id_ctaAme'];
	$fk_referencia = $row_consultaGenerales['fk_referencia'];
	$s_imp_exp = $row_consultaGenerales['s_imp_exp'];
	$d_fecha = $row_consultaGenerales['d_fecha'];
	$d_fechaVencimiento = $row_consultaGenerales['d_fechaVencimiento'];
	$d_fechaVencimiento = date_format(date_create($d_fechaVencimiento),"Y-m-d");
	$s_guia_master = $row_consultaGenerales['s_guia_master'];
	$n_bodegaIn = $row_consultaGenerales['n_bodegaIn'];
	$s_descripcion = $row_consultaGenerales['s_descripcion'];
	$s_tipoRegimen = $row_consultaGenerales['s_tipoRegimen'];
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
	$s_rfc = $row_consultaGenerales['s_rfc'];
	$fk_id_proveedor = $row_consultaGenerales['fk_id_proveedor'];
	$s_prov_nombre = $row_consultaGenerales['s_prov_nombre'];
	$s_prov_calle = $row_consultaGenerales['s_prov_calle'];
	$s_prov_no_ext = $row_consultaGenerales['s_prov_no_ext'];
	$s_prov_no_int = $row_consultaGenerales['s_prov_no_int'];
	$s_prov_telefono = $row_consultaGenerales['s_prov_telefono'];
	$s_prov_fax = $row_consultaGenerales['s_prov_fax'];
	$s_prov_cp = $row_consultaGenerales['s_prov_cp'];
	$s_prov_pais = $row_consultaGenerales['s_prov_pais'];
	$s_prov_entidad = $row_consultaGenerales['s_prov_entidad'];
	$s_prov_ciudad = $row_consultaGenerales['s_prov_ciudad'];
	$n_valor_usd = $row_consultaGenerales['n_valor_usd'];
	$n_peso = $row_consultaGenerales['n_peso'];
	$s_customerOrder = $row_consultaGenerales['s_customerOrder']; #facturas
	$s_pagada = $row_consultaGenerales['s_pagada'];
	$n_gasto = $row_consultaGenerales['n_gasto'];
	$n_ganancia = $row_consultaGenerales['n_ganancia'];
	$n_subtotal = $row_consultaGenerales['n_subtotal'];
	$n_anticipo1 = $row_consultaGenerales['n_anticipo1'];
	$n_anticipo2 = $row_consultaGenerales['n_anticipo2'];
	$n_total = $row_consultaGenerales['n_total'];
	$s_usuario = $row_consultaGenerales['s_usuario'];
	$d_fecha_alta = $row_consultaGenerales['d_fecha_alta'];
	$d_fecha_alta = date_format(date_create($d_fecha_alta),"d-m-Y H:i:s");
	$s_usuario_modifi = $row_consultaGenerales['s_usuario_modifi'];
	$d_fecha_modifi = $row_consultaGenerales['d_fecha_modifi'];
	if (!is_null($d_fecha_modifi)){ $d_fecha_modifi = date_format(date_create($d_fecha_modifi),"d-m-Y H:i:s"); }
	$s_docto_tipo = $row_consultaGenerales['s_docto_tipo'];
	$n_docto_id = $row_consultaGenerales['n_docto_id'];
	$n_cancela = $row_consultaGenerales['n_cancela'];
	$s_cancela_usuario = $row_consultaGenerales['s_cancela_usuario'];
	$d_cancela_fecha = $row_consultaGenerales['d_cancela_fecha'];
	if (!is_null(	$d_cancela_fecha)){ $d_cancela_fecha = date_format(date_create($d_cancela_fecha),"d-m-Y H:i:s"); }
}

?>

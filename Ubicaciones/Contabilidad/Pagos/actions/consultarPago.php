<?PHP

$query_consultaFactura = "SELECT * FROM conta_t_pagos_cfdi where fk_id_pago_captura = ? ";

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

	$pk_id_factura = $row_consultaFactura['pk_id_pago'];
	$d_fechaTimbrado = $row_consultaFactura['d_fechaTimbrado'];
	if (!is_null($d_fechaTimbrado)){ $d_fechaTimbrado = date_format(date_create($d_fechaTimbrado),"d-m-Y\TH:i:s"); }
	$fk_id_certificado = $row_consultaFactura['fk_id_certificado'];
	$s_CFDversion = $row_consultaFactura['s_CFDIversion'];
	$s_UUID = $row_consultaFactura['s_UUID'];
	$s_id_certificadoSAT = $row_consultaFactura['s_id_certificadoSAT'];
	$s_timbradoVersion = $row_consultaFactura['s_timbradoVersion'];
	$s_selloCFDI = $row_consultaFactura['s_selloCFDI'];
	$s_id_certificadoSAT = $row_consultaFactura['s_id_certificadoSAT'];
	$s_selloSAT = $row_consultaFactura['s_selloSAT'];

}

?>

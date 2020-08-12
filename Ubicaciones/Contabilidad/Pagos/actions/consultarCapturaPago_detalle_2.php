 <?PHP

$query_consultaDetalle = "SELECT * FROM conta_t_pagos_captura_det where fk_id_pago_captura = ? ";

$stmt_consultaDetalle = $db->prepare($query_consultaDetalle);
if (!($stmt_consultaDetalle)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaDetalle->bind_param('s',$cuenta);
if (!($stmt_consultaDetalle)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaDetalle->errno]: $stmt_consultaDetalle->error";
	exit_script($system_callback);
}
if (!($stmt_consultaDetalle->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaDetalle->errno]: $stmt_consultaDetalle->error";
	exit_script($system_callback);
}

$rslt_consultaDetalle = $stmt_consultaDetalle->get_result();
$total_consultaDetalle = $rslt_consultaDetalle->num_rows;


?>

<?php

$query_consultaDetalle_DR = "SELECT * FROM conta_t_pagos_captura_det_dr where fk_id_pago_captura = ? and n_fk_rowPago = ? ORDER BY pk_id_DR ";

$stmt_consultaDetalle_DR = $db->prepare($query_consultaDetalle_DR);
if (!($stmt_consultaDetalle_DR)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaDetalle_DR->bind_param('ss',$cuenta,$pk_rowPago);
if (!($stmt_consultaDetalle_DR)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaDetalle_DR->errno]: $stmt_consultaDetalle_DR->error";
	exit_script($system_callback);
}
if (!($stmt_consultaDetalle_DR->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaDetalle_DR->errno]: $stmt_consultaDetalle_DR->error";
	exit_script($system_callback);
}

$rslt_consultaDetalle_DR = $stmt_consultaDetalle_DR->get_result();
$total_consultaDetalle_DR = $rslt_consultaDetalle_DR->num_rows;


?>

<?PHP

$query_consultaDatosCaptura = "SELECT *
                            FROM conta_t_pagos_captura
                            WHERE pk_id_pago_captura = ?";

$stmt_consultaDatosCaptura = $db->prepare($query_consultaDatosCaptura);
if (!($stmt_consultaDatosCaptura)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare consultaDatosCaptura [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaDatosCaptura->bind_param('s',$cuenta);
if (!($stmt_consultaDatosCaptura)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding consultaDatosCaptura [$stmt_consultaDatosCaptura->errno]: $stmt_consultaDatosCaptura->error";
	exit_script($system_callback);
}
if (!($stmt_consultaDatosCaptura->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution consultaDatosCaptura [$stmt_consultaDatosCaptura->errno]: $stmt_consultaDatosCaptura->error";
	exit_script($system_callback);
}

$rslt_consultaDatosCaptura = $stmt_consultaDatosCaptura->get_result();
$total_consultaDatosCaptura = $rslt_consultaDatosCaptura->num_rows;





?>

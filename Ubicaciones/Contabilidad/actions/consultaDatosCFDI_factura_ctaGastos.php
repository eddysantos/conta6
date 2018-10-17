<?PHP

$query_consultaDatosCtaGastos = "SELECT *
                            FROM conta_t_facturas_captura A, conta_t_facturas_ctagastos B
                            WHERE A.pk_id_cuenta_captura = ? and A.pk_id_cuenta_captura = B.fk_id_cuenta_captura";

$stmt_consultaDatosCtaGastos = $db->prepare($query_consultaDatosCtaGastos);
if (!($stmt_consultaDatosCtaGastos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare consultaDatosCtaGastos [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaDatosCtaGastos->bind_param('s',$cuenta);
if (!($stmt_consultaDatosCtaGastos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding consultaDatosCtaGastos [$stmt_consultaDatosCtaGastos->errno]: $stmt_consultaDatosCtaGastos->error";
	exit_script($system_callback);
}
if (!($stmt_consultaDatosCtaGastos->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution consultaDatosCtaGastos [$stmt_consultaDatosCtaGastos->errno]: $stmt_consultaDatosCtaGastos->error";
	exit_script($system_callback);
}

$rslt_consultaDatosCtaGastos = $stmt_consultaDatosCtaGastos->get_result();
$total_consultaDatosCtaGastos = $rslt_consultaDatosCtaGastos->num_rows;





?>

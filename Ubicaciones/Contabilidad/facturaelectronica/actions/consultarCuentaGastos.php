<?PHP

$query_consultaCtaGstos = "SELECT * FROM conta_t_facturas_ctagastos where fk_id_cuenta_captura = ? ";

$stmt_consultaCtaGstos = $db->prepare($query_consultaCtaGstos);
if (!($stmt_consultaCtaGstos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaCtaGstos->bind_param('s',$cuenta);
if (!($stmt_consultaCtaGstos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaCtaGstos->errno]: $stmt_consultaCtaGstos->error";
	exit_script($system_callback);
}
if (!($stmt_consultaCtaGstos->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaCtaGstos->errno]: $stmt_consultaCtaGstos->error";
	exit_script($system_callback);
}

$rslt_consultaCtaGstos = $stmt_consultaCtaGstos->get_result();
$total_consultaCtaGstos = $rslt_consultaCtaGstos->num_rows;

if( $total_consultaCtaGstos > 0 ) {
	$row_consultaCtaGstos = $rslt_consultaCtaGstos->fetch_assoc();

	$id_ctagastos = $row_consultaCtaGstos['id_ctagastos'];
	$d_fecha_ctagastos = $row_consultaCtaGstos['d_fecha_ctagastos'];
	$fk_idpol_ctagastos = $row_consultaCtaGstos['fk_idpol_ctagastos'];
	$s_cancela_ctagastos = $row_consultaCtaGstos['s_cancela_ctagastos'];
	$fk_idpol_pagoaplicado = $row_consultaCtaGstos['fk_idpol_pagoaplicado'];
	$s_cancela_pagoaplicado = $row_consultaCtaGstos['s_cancela_pagoaplicado'];
	$d_fecha_genera = $row_consultaCtaGstos['d_fecha_genera'];
}

?>

<?PHP

$query_consultaDatosRelacionada = "SELECT *
                              from conta_t_nom_cfdi_relacionada
                              where fk_id_docNomina = ?";

$stmt_consultaDatosRelacionada = $db->prepare($query_consultaDatosRelacionada);
if (!($stmt_consultaDatosRelacionada)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare consultaDatosRelacionada [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaDatosRelacionada->bind_param('s',$idDocNomina);
if (!($stmt_consultaDatosRelacionada)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding consultaDatosRelacionada [$stmt_consultaDatosRelacionada->errno]: $stmt_consultaDatosRelacionada->error";
	exit_script($system_callback);
}
if (!($stmt_consultaDatosRelacionada->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution consultaDatosRelacionada [$stmt_consultaDatosRelacionada->errno]: $stmt_consultaDatosRelacionada->error";
	exit_script($system_callback);
}

$rslt_consultaDatosRelacionada = $stmt_consultaDatosRelacionada->get_result();
$total_consultaDatosRelacionada = $rslt_consultaDatosRelacionada->num_rows;





?>

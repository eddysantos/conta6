<?PHP

$query_consultaDatosCFDI = "SELECT *
                            FROM conta_t_nom_captura A, conta_t_nom_cfdi B
                            WHERE A.pk_id_docNomina = ? and A.pk_id_docNomina = B.fk_id_docNomina
                            ORDER BY pk_id_nomina desc ";

$stmt_consultaDatosCFDI = $db->prepare($query_consultaDatosCFDI);
if (!($stmt_consultaDatosCFDI)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare consultaDatosCFDI [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaDatosCFDI->bind_param('s',$idDocNomina);
if (!($stmt_consultaDatosCFDI)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding consultaDatosCFDI [$stmt_consultaDatosCFDI->errno]: $stmt_consultaDatosCFDI->error";
	exit_script($system_callback);
}
if (!($stmt_consultaDatosCFDI->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution consultaDatosCFDI [$stmt_consultaDatosCFDI->errno]: $stmt_consultaDatosCFDI->error";
	exit_script($system_callback);
}

$rslt_consultaDatosCFDI = $stmt_consultaDatosCFDI->get_result();
$total_consultaDatosCFDI = $rslt_consultaDatosCFDI->num_rows;





?>

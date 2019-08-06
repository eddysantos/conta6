<?PHP
$query_consultaPolContaElect = "SELECT *
        												FROM conta_t_polizas_det
        												WHERE fk_id_poliza = ? ";

$stmt_consultaPolContaElect = $db->prepare($query_consultaPolContaElect);
if (!($stmt_consultaPolContaElect)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaPolContaElect->bind_param('s',$fk_id_poliza);
if (!($stmt_consultaPolContaElect)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaPolContaElect->errno]: $stmt_consultaPolContaElect->error";
	exit_script($system_callback);
}
if (!($stmt_consultaPolContaElect->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaPolContaElect->errno]: $stmt_consultaPolContaElect->error";
	exit_script($system_callback);
}

$rslt_consultaPolContaElect = $stmt_consultaPolContaElect->get_result();
$total_consultaPolContaElect = $rslt_consultaPolContaElect->num_rows;

if( $total_consultaPolContaElect > 0 ) {

	while( $row_consultaPolContaElect = $rslt_consultaPolContaElect->fetch_assoc() ){

		$partidaDoc = $row_consultaPolContaElect['pk_partida'];
    require $root . '/Conta6/Resources/PHP/actions/contaElect_insertaCompNal.php';

	}
}

?>

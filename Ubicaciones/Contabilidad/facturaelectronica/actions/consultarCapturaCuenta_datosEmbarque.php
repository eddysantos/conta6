<?PHP

$query_consultaEmbarque = "SELECT s_conceptoEsp,s_descripcion FROM conta_t_facturas_captura_det WHERE fk_id_cuenta_captura = ? and s_tipoDetalle = 'DatGnEmbarq' ";

$stmt_consultaEmbarque = $db->prepare($query_consultaEmbarque);
if (!($stmt_consultaEmbarque)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaEmbarque->bind_param('s',$cuenta);
if (!($stmt_consultaEmbarque)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaEmbarque->errno]: $stmt_consultaEmbarque->error";
	exit_script($system_callback);
}
if (!($stmt_consultaEmbarque->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaEmbarque->errno]: $stmt_consultaEmbarque->error";
	exit_script($system_callback);
}

$rslt_consultaEmbarque = $stmt_consultaEmbarque->get_result();
$total_consultaEmbarque = $rslt_consultaEmbarque->num_rows;

if( $total_consultaEmbarque > 0 ) {
	while( $row_consultaEmbarque = $rslt_consultaEmbarque->fetch_assoc() ){

		$s_conceptoEsp = utf8_encode($row_consultaEmbarque['s_conceptoEsp']);
		$s_descripcion = utf8_encode($row_consultaEmbarque['s_descripcion']);

		$datosEmbarque = $datosEmbarque."<tr class='row'>
	            <td class='col-md-6 text-right'>$s_conceptoEsp</td>
	            <td class='col-md-6 text-left'>$s_descripcion</td>
	          </tr>";
	}
}

?>

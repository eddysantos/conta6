<?PHP

$query_consultaEmbarque = "SELECT pk_id_partida,s_conceptoEsp,s_descripcion FROM conta_t_facturas_captura_det WHERE fk_id_cuenta_captura = ? and s_tipoDetalle = 'DatGnEmbarq' ";

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
	$count = 0;
	while( $row_consultaEmbarque = $rslt_consultaEmbarque->fetch_assoc() ){
		++$count;

		$s_conceptoEsp = utf8_encode($row_consultaEmbarque['s_conceptoEsp']);
		$s_descripcion = utf8_encode($row_consultaEmbarque['s_descripcion']);
		$pk_id_partida = $row_consultaEmbarque['pk_id_partida'];

		$datosEmbarque = $datosEmbarque."<div class='row'>
							<div class='col-md-6 text-right'>$s_conceptoEsp</div>
							<div class='col-md-6 text-left p-0'>$s_descripcion</div>
						</div>";

		$impresionDatosEmbarque = $impresionDatosEmbarque.'<tr>
			<td width="50%" align="right">'.$s_conceptoEsp.' </td>
			<td width="50%" align="left"> '.$s_descripcion.'</td>
		</tr>' ;

		$datosEmbarqueModifi = $datosEmbarqueModifi."
			<tr class='row elementos-dge'>
				<td class='col-md-6 p-1'>
					<input class='efecto bt border-0 h22 text-right concepto-espanol' type='text' id='T_IGET_$count' size='30' maxlength='60' value='$s_conceptoEsp'>
					<input class='id-partida' type='hidden' id='T_partida_$pk_id_partida' value='$pk_id_partida'>
				</td>
				<td class='col-md-4 p-1'>
					<input class='efecto bt border-0 h22 text-left descripcion' type='text' id='T_IGED_$count' size='30' maxlength='60' value='$s_descripcion'>
				</td>
			</tr>";
	}
}

?>

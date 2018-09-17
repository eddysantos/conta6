<?PHP

$query_consultaCargos = "SELECT s_conceptoEsp,n_total FROM conta_t_facturas_captura_det WHERE fk_id_cuenta_captura = ? and s_tipoDetalle = 'cargos' ";

$stmt_consultaCargos = $db->prepare($query_consultaCargos);
if (!($stmt_consultaCargos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaCargos->bind_param('s',$cuenta);
if (!($stmt_consultaCargos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaCargos->errno]: $stmt_consultaCargos->error";
	exit_script($system_callback);
}
if (!($stmt_consultaCargos->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaCargos->errno]: $stmt_consultaCargos->error";
	exit_script($system_callback);
}

$rslt_consultaCargos = $stmt_consultaCargos->get_result();
$total_consultaCargos = $rslt_consultaCargos->num_rows;

if( $total_consultaCargos > 0 ) {
	while( $row_consultaCargos = $rslt_consultaCargos->fetch_assoc() ){

		$s_conceptoEsp = utf8_encode($row_consultaCargos['s_conceptoEsp']);
		$n_total = number_format($row_consultaCargos['n_total'],2,'.',',');

		$datosCargos = $datosCargos."<tr class='row'>
          <td class='col-md-6'>$s_conceptoEsp</td>
          <td class='col-md-2'></td>
					<td class='col-md-2'></td>
          <td class='col-md-2'>$ $n_total</td>
        </tr>";
	}
}

?>

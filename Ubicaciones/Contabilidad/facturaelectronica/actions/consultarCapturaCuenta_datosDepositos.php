<?PHP

$query_consultaDepositos = "SELECT n_noDeposito,n_total FROM conta_t_facturas_captura_det WHERE fk_id_cuenta_captura = ? and s_tipoDetalle = 'depositos' ";

$stmt_consultaDepositos = $db->prepare($query_consultaDepositos);
if (!($stmt_consultaDepositos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaDepositos->bind_param('s',$cuenta);
if (!($stmt_consultaDepositos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaDepositos->errno]: $stmt_consultaDepositos->error";
	exit_script($system_callback);
}
if (!($stmt_consultaDepositos->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaDepositos->errno]: $stmt_consultaDepositos->error";
	exit_script($system_callback);
}

$rslt_consultaDepositos = $stmt_consultaDepositos->get_result();
$total_consultaDepositos = $rslt_consultaDepositos->num_rows;

if( $total_consultaDepositos > 0 ) {
	while( $row_consultaDepositos = $rslt_consultaDepositos->fetch_assoc() ){

		$n_noDeposito = $row_consultaDepositos['n_noDeposito'];
		$n_total = number_format($row_consultaDepositos['n_total'],2,'.',',');

		$datosDepositos = $datosDepositos."<tr class='row'>
	            <td class='col-md-6 text-right'>$n_noDeposito</td>
	            <td class='col-md-2 text-left'>$n_total</td>
	          </tr>";
	}
}

?>

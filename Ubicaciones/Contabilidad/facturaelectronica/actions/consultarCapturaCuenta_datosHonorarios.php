<?PHP

$query_consultaHonorarios = "SELECT n_cantidad,fk_c_ClaveProdServ,fk_id_cuenta,s_conceptoEsp,n_importe,n_IVA,n_ret,n_total
 															FROM conta_t_facturas_captura_det WHERE fk_id_cuenta_captura = ? and s_tipoDetalle = 'honorarios' ";

$stmt_consultaHonorarios = $db->prepare($query_consultaHonorarios);
if (!($stmt_consultaHonorarios)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaHonorarios->bind_param('s',$cuenta);
if (!($stmt_consultaHonorarios)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaHonorarios->errno]: $stmt_consultaHonorarios->error";
	exit_script($system_callback);
}
if (!($stmt_consultaHonorarios->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaHonorarios->errno]: $stmt_consultaHonorarios->error";
	exit_script($system_callback);
}

$rslt_consultaHonorarios = $stmt_consultaHonorarios->get_result();
$total_consultaHonorarios = $rslt_consultaHonorarios->num_rows;

if( $total_consultaHonorarios > 0 ) {
	while( $row_consultaHonorarios = $rslt_consultaHonorarios->fetch_assoc() ){
		$n_cantidad = $row_consultaHonorarios['n_cantidad'];
		$fk_c_ClaveProdServ = $row_consultaHonorarios['fk_c_ClaveProdServ'];
		$fk_id_cuenta = $row_consultaHonorarios['fk_id_cuenta'];
		$s_conceptoEsp = utf8_encode($row_consultaHonorarios['s_conceptoEsp']);
		$n_importe = number_format($row_consultaHonorarios['n_importe'],2,'.',',');
		$n_IVA = number_format($row_consultaHonorarios['n_IVA'],2,'.',',');
		$n_ret = number_format($row_consultaHonorarios['n_ret'],2,'.',',');
		$n_total = number_format($row_consultaHonorarios['n_total'],2,'.',',');

		$datosHonorarios = $datosHonorarios."<div class='row b font12 ls1'>
          <div class='col-md-4 text-left'>$s_conceptoEsp</div>
          <div class='col-md-2'>$n_importe</div>
          <div class='col-md-2'>$n_IVA</div>
          <div class='col-md-2'>$n_ret</div>
          <div class='col-md-2'>$ $n_total</div>
        </div>";
	}
}

?>

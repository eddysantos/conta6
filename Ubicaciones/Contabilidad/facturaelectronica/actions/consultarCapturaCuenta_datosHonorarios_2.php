<?PHP

$query_consultaHonorarios = "SELECT pk_id_partida,fk_c_claveUnidad,s_unidad,fk_c_ClaveProdServ,fk_id_cuenta,s_conceptoEsp,
                                    n_porcentaje,n_base,n_descuento,n_cantidad,n_importe,n_IVA,n_ret,n_total
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


?>

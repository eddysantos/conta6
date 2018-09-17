<?PHP

$query_consultaPOCME = "SELECT n_cantidad,s_conceptoEsp,s_descripcion,n_importe,n_total FROM conta_t_facturas_captura_det WHERE fk_id_cuenta_captura = ? and s_tipoDetalle = 'POCME' ";

$stmt_consultaPOCME = $db->prepare($query_consultaPOCME);
if (!($stmt_consultaPOCME)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaPOCME->bind_param('s',$cuenta);
if (!($stmt_consultaPOCME)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaPOCME->errno]: $stmt_consultaPOCME->error";
	exit_script($system_callback);
}
if (!($stmt_consultaPOCME->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaPOCME->errno]: $stmt_consultaPOCME->error";
	exit_script($system_callback);
}

$rslt_consultaPOCME = $stmt_consultaPOCME->get_result();
$total_consultaPOCME = $rslt_consultaPOCME->num_rows;

if( $total_consultaPOCME > 0 ) {
	while( $row_consultaPOCME = $rslt_consultaPOCME->fetch_assoc() ){

		$n_cantidad = $row_consultaPOCME['n_cantidad'];
		$s_conceptoEsp = utf8_encode($row_consultaPOCME['s_conceptoEsp']);
		$s_descripcion = utf8_encode($row_consultaPOCME['s_descripcion']);
		$n_importe = number_format($row_consultaPOCME['n_importe'],2,'.',',');
		$n_total = number_format($row_consultaPOCME['n_total'],2,'.',',');

		$datosPOCME = $datosPOCME."<tr class='row'>
          <td class='col-md-6'>$n_cantidad $s_conceptoEsp $s_descripcion</td>
          <td class='col-md-2'>$ $n_importe</td>
          <td class='col-md-2'>$ $n_total</td>
        </tr>";
	}
}

?>

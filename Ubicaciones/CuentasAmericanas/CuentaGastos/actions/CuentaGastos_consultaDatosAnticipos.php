<?PHP

// $root = $_SERVER['DOCUMENT_ROOT'];
// require $root . '/Resources/PHP/Utilities/initialScript.php';
// echo $cuenta = 34;

$query_consultaANTICIPO = "SELECT pk_id_partida,n_noDeposito,n_importe
												FROM contame_t_facturas_det
												WHERE fk_id_ctaAme = ? and s_tipoDetalle = 'anticipo' ";

$stmt_consultaANTICIPO = $db->prepare($query_consultaANTICIPO);
if (!($stmt_consultaANTICIPO)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaANTICIPO->bind_param('s',$cuenta);
if (!($stmt_consultaANTICIPO)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaANTICIPO->errno]: $stmt_consultaANTICIPO->error";
	exit_script($system_callback);
}
if (!($stmt_consultaANTICIPO->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaANTICIPO->errno]: $stmt_consultaANTICIPO->error";
	exit_script($system_callback);
}

$rslt_consultaANTICIPO = $stmt_consultaANTICIPO->get_result();
$total_consultaANTICIPO = $rslt_consultaANTICIPO->num_rows;

$datosANTICIPO = '';
$datosANTICIPOImprimir = '';
$datosANTICIPOmodifi;
if( $total_consultaANTICIPO > 0 ) {
	$idFila = 0;

	while( $row_consultaANTICIPO = $rslt_consultaANTICIPO->fetch_assoc() ){
		++$idFila;

		$id_partidaDeposito = $row_consultaANTICIPO['pk_id_partida'];
		$n_noDeposito = $row_consultaANTICIPO['n_noDeposito'];
		$n_importeAnt = $row_consultaANTICIPO['n_importe'];

		$n_importeAnt_2 = number_format($row_consultaANTICIPO['n_importe'],2,'.',',');



		$datosANTICIPOImprimir .=
			'<tr style="border-left-width:1px; border-right-width:1px; border-top-width:1px; border-bottom-style:solid; border-bottom-width:1px; border-bottom-color:#7F7F7F">
					<td>Less Advance '.$n_noDeposito.'</td>
					<td align="right">'.$n_importeAnt_2.'</td>
				</tr>';

		$datosANTICIPOconsultar .=
				'<tr class="row m-0">
					<td class="col-md-2 offset-md-8 text-right">Less Advance '.$n_noDeposito.' :</td>
					<td class="col-md-1"></td>
					<td class="col-md-1">'.$n_importeAnt_2.'</td>
				</tr>';

		$datosANTICIPOmodificar .=
				'<tr class="row elemento-advance">
					<td class="p-1 col-md-3 offset-md-7">
						<input class="id-partida" type="hidden" id="T_partida_'.$id_partidaDeposito.'" value="'.$id_partidaDeposito.'">
						<input class="h22 w-100 bt text-right border-0" type="text" id="Txt_Advance'.$n_noDeposito.'" size="40"readonly value="Less Advance '.$n_noDeposito.' :">
					</td>
					<td class="p-1 col-md-2">
						<input class="advanceNum" type="hidden" id="T_Advance'.$n_noDeposito.'_Num" value="'.$n_noDeposito.'">
						<input class="efecto h22 advanceImporte" type="text" id="T_Advance'.$n_noDeposito.'_Total" size="20" value="'.$n_importeAnt.'" onblur="Suma_POCME_ctaAme()">
					</td>
				</tr>';

	}
}

?>

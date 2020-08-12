<?PHP
/*
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';
$cuenta = 43;
*/
$query_facDR = "SELECT DISTINCT fk_id_facturaDR from conta_t_pagos_captura_det_dr WHERE fk_id_pago_captura = ?";
$stmt_facDR = $db->prepare($query_facDR);
if (!($stmt_facDR)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_facDR->bind_param('s',$cuenta);
if (!($stmt_facDR)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_facDR->errno]: $stmt_facDR->error";
	exit_script($system_callback);
}
if (!($stmt_facDR->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_facDR->errno]: $stmt_facDR->error";
	exit_script($system_callback);
}

$rslt_facDR = $stmt_facDR->get_result();
$total_facDR = $rslt_facDR->num_rows;

$listS = 's';
$listC = '';
$listFac = '';
if( $total_facDR > 0 ) {
	while( $row_facDR = $rslt_facDR->fetch_assoc()  ){
		$listS .= 's';
		$listC .= 'a.fk_id_facturaDR = '.$row_facDR['fk_id_facturaDR'].' or';
		$listFac .= $row_facDR['fk_id_facturaDR'].',';
	}
	$listFac = trim($listFac,',');
	$listC = substr($listC,0,-2);
}

if( $listC <> '' ){
	$query_consultaPagosMismaFac = "select
	b.s_UUID,
	b.d_fechaTimbrado,
	a.n_numParcialidad,
	b.fk_id_poliza,
	a.fk_id_facturaDR,
	c.n_folioPagoSustituir,
	b.d_fechaTimbradoCancela,
	b.s_selloSATcancela,
	a.n_importeSaldoAnterior,
	a.n_importePagado,
	a.n_importeSaldoInsoluto,
	c.pk_id_pago_captura,
	b.pk_id_pago
	from conta_t_pagos_captura_det_dr a, conta_t_pagos_cfdi b, conta_t_pagos_captura c
	where a.fk_id_pago_captura = b.fk_id_pago_captura and a.fk_id_pago_captura = c.pk_id_pago_captura and
	a.fk_id_pago_captura <> $cuenta and ($listC)";

	$stmt_consultaPagosMismaFac = $db->prepare($query_consultaPagosMismaFac);

	if (!($stmt_consultaPagosMismaFac)) {
		$system_callback['code'] = "500";
		$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
		exit_script($system_callback);
	}
	if (!($stmt_consultaPagosMismaFac->execute())) {
		$system_callback['code'] = "500";
		$system_callback['message'] = "Error during query execution [$stmt_consultaPagosMismaFac->errno]: $stmt_consultaPagosMismaFac->error";
		exit_script($system_callback);
	}

	$rslt_consultaPagosMismaFac = $stmt_consultaPagosMismaFac->get_result();
	$total_consultaPagosMismaFac = $rslt_consultaPagosMismaFac->num_rows;

	$listpagMismaFac = '';
	if( $total_consultaPagosMismaFac > 0 ) {
		while( $row_consultaPagosMismaFac = $rslt_consultaPagosMismaFac->fetch_assoc()  ){
	    $cpmf_uuid = $row_consultaPagosMismaFac['s_UUID'];
			$cpmf_fechaTimbrado = $row_consultaPagosMismaFac['d_fechaTimbrado'];
			if(!is_null($cpmf_fechaTimbrado)){ $cpmf_fechaTimbrado = date_format(date_create($cpmf_fechaTimbrado),"d/m/Y");}
			$cpmf_numParcialidad = $row_consultaPagosMismaFac['n_numParcialidad'];
			$cpmf_poliza = $row_consultaPagosMismaFac['fk_id_poliza'];
			$cpmf_facturaDR = $row_consultaPagosMismaFac['fk_id_facturaDR'];
			$cpmf_folioPagoSustituir = $row_consultaPagosMismaFac['n_folioPagoSustituir'];
			$cpmf_fechaTimbradoCancela = $row_consultaPagosMismaFac['d_fechaTimbradoCancela'];
			if(!is_null($cpmf_fechaTimbradoCancela)){ $cpmf_fechaTimbradoCancela = date_format(date_create($cpmf_fechaTimbradoCancela),"d/m/Y");}
			$cpmf_selloSATcancela = $row_consultaPagosMismaFac['s_selloSATcancela'];
			$cpmf_importeSaldoAnterior = $row_consultaPagosMismaFac['n_importeSaldoAnterior'];
			$cpmf_importePagado = $row_consultaPagosMismaFac['n_importePagado'];
			$cpmf_importeSaldoInsoluto = $row_consultaPagosMismaFac['n_importeSaldoInsoluto'];
			$cpmf_id_pago_captura = $row_consultaPagosMismaFac['pk_id_pago_captura'];
			$cpmf_idpago = $row_consultaPagosMismaFac['pk_id_pago'];

			$listpagMismaFac .= '<tr>
				<td class="col-md-1">'.trim($cpmf_fechaTimbrado).'</td>
				<td class="col-md-1">'.$cpmf_idpago.'</td>
				<td class="col-md-1">'.$cpmf_numParcialidad.'</td>
				<td class="col-md-1">'.$cpmf_poliza.'</td>
				<td class="col-md-1">'.$cpmf_id_pago_captura.'</td>
				<td class="col-md-1">'.$cpmf_facturaDR.'</td>
				<td class="col-md-1">'.$cpmf_folioPagoSustituir.'</td>
				<td class="col-md-1">'.$cpmf_fechaTimbradoCancela.'<td>
				<td class="col-md-1">'.$cpmf_importeSaldoAnterior.'</td>
				<td class="col-md-1">'.$cpmf_importePagado.'</td>
				<td class="col-md-1">'.$cpmf_importeSaldoInsoluto.'</td>
			</tr>';
	  }
	}
}


?>

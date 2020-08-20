<?php
#$root = $_SERVER['DOCUMENT_ROOT'];


#$referencia = 'N13003036';
$sql_referenciasPedimento = mysqli_query($aduanet,"SELECT 	a.C001REFPED 		referencia,
															a.C001NUMPED 		pedimento,
															CASE WHEN a.C001TIPOPE = '1' THEN 'IMP' ELSE 'EXP' END AS 'tipo_operacion',
															a.N001VALADU 		valor_aduana,
															a.N001VALCOM 		valor_comercial,
															a.F001TIPCAM 		tipo_cambio,
															b.C008CVECON		cve_impuesto,
															b.C008CVEPAG		cve_pago,
															b.N008IMPCON		importe
											FROM AT001 a LEFT JOIN AT008 b ON a.C001PATEN = b.C008PATEN
													AND	a.C001ADUSEC = b.C008ADUSEC
													AND	a.C001REFPED = b.C008REFPED
													AND	a.C001NUMPED = b.C008NUMPED
											WHERE a.C001PATEN = '3317' AND	a.C001REFPED = '$referencia' 	");
#
#AND	a.C001ADUSEC = '240'
#AND	a.C001NUMPED = '9002945'

while($oRst_referenciasPedimento = mysqli_fetch_array($sql_referenciasPedimento) ){
	require $root . '/Resources/PHP/Databases/conexion.php';

	$referencia_aduanet = $oRst_referenciasPedimento['referencia'];
	$pedimento_aduanet = trim($oRst_referenciasPedimento['pedimento']);
	$tipo_operacion = trim($oRst_referenciasPedimento['tipo_operacion']);
	$valAduana_aduanet = trim($oRst_referenciasPedimento['valor_aduana']);
	$valComercial_aduanet = trim($oRst_referenciasPedimento['valor_comercial']);
	$tc_aduanet = trim($oRst_referenciasPedimento['tipo_cambio']);
	$cve_impuesto = trim($oRst_referenciasPedimento['cve_impuesto']);
	$cve_pago = trim($oRst_referenciasPedimento['cve_pago']);
	$importe_impuesto = trim($oRst_referenciasPedimento['importe']);


	// $sql_consRef = mysqli_query($db,"select * from conta_replica_referencias_pedimento where fk_referencia = '$referencia_aduanet' AND s_pedimento = $pedimento_aduanet AND s_cve_impuesto = '$cve_impuesto' ");
	// $total_consRef = mysqli_num_rows($sql_consRef);
	$query_mst="select * from conta_replica_referencias_pedimento where fk_referencia = ? AND s_pedimento = ? AND s_cve_impuesto = ?";

	$stmt_mst = $db->prepare($query_mst);
	if (!($stmt_mst)) {
	  $system_callback['code'] = "500";
	  $system_callback['message'] = "Error during query prepare captura [$db->errno]: $db->error";
	  exit_script($system_callback);
	}

	$stmt_mst->bind_param('sss',$referencia_aduanet,
															$pedimento_aduanet,
															$cve_impuesto);
	if (!($stmt_mst)) {
	  $system_callback['code'] = "500";
	  $system_callback['message'] = "Error during variables binding captura [$stmt_mst->errno]: $stmt_mst->error";
	  exit_script($system_callback);
	}

	if (!($stmt_mst->execute())) {
	  $system_callback['code'] = "500";
	  $system_callback['message'] = "Error during query execution captura [$stmt_mst->errno]: $stmt_mst->error";
	  //exit_script($system_callback);
	}

	$rslt_mst = $stmt_mst->get_result();
	$total_consRef = $rslt_mst->num_rows;


	if( $total_consRef > 0 ){

		$query_actualizando="UPDATE conta_replica_referencias_pedimento SET
		 							n_valor_aduana = ?,
		 							n_valor_comercial = ?,
		 							n_tipo_cambio = ?,
		 							s_cve_pago = ?,
		 							n_importe_impuesto = ?
		 						WHERE fk_referencia = ? AND s_cve_impuesto = ?";

		 $stmt_actualizando = $db->prepare($query_actualizando);
		 if (!($stmt_actualizando)) {
			 $system_callback['code'] = "500";
			 $system_callback['message'] = "Error during query prepare actualizando [$db->errno]: $db->error";
			 exit_script($system_callback);
		 }

		 $stmt_actualizando->bind_param('sssssss', $valAduana_aduanet,
																			 $valComercial_aduanet,
																			 $tc_aduanet,
																			 $cve_pago,
																			 $importe_impuesto,
																			 $referencia_aduanet,
																			 $cve_impuesto );


		 if (!($stmt_actualizando)) {
			 $system_callback['code'] = "500";
			 $system_callback['message'] = "Error during variables binding actualizando [$stmt_actualizando->errno]: $stmt_actualizando->error";
			 exit_script($system_callback);
		 }

		 if (!($stmt_actualizando->execute())) {
			 $system_callback['code'] = "500";
			 $system_callback['message'] = "Error during query execution actualizando [$stmt_actualizando->errno]: $stmt_actualizando->error";
			 //exit_script($system_callback);
		 }



	}else{

		 $query_guardar="INSERT INTO conta_replica_referencias_pedimento(fk_referencia,
																																 s_pedimento,
																																 s_imp_exp,
																																 n_valor_aduana,
																																 n_valor_comercial,
																																 n_tipo_cambio,
																																 s_cve_impuesto,
																																 s_cve_pago,
																																 n_importe_impuesto
																														 )VALUES(?,?,?,?,?,?,?,?,?)";
			$stmt_guardar = $db->prepare($query_guardar);
			if (!($stmt_guardar)) {
			  $system_callback['code'] = "500";
			  $system_callback['message'] = "Error during query prepare guardar [$db->errno]: $db->error";
			  exit_script($system_callback);
			}

			$stmt_guardar->bind_param('sssssssss',
																									$referencia_aduanet,
																																			$pedimento_aduanet,
																																			$tipo_operacion,
																																			$valAduana_aduanet,
																																			$valComercial_aduanet,
																																			$tc_aduanet,
																																			$cve_impuesto,
																																			$cve_pago,
																																			$importe_impuesto);

			if (!($stmt_guardar)) {
				$system_callback['code'] = "500";
				$system_callback['message'] = "Error during variables binding guaradar [$stmt_guardar->errno]: $stmt_guardar->error";
				exit_script($system_callback);
			}

			if (!($stmt_guardar->execute())) {
				$system_callback['code'] = "500";
				$system_callback['message'] = "Error during query execution guardar [$stmt_guardar->errno]: $stmt_guardar->error";
				//exit_script($system_callback);
			}




	}

}
#echo "SE ACTUALIZARON TODAS LOS PEDIMENTOS";

?>

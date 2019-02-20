<?php
/*
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_cliente_usar = 'CLT_5900';
$consolidado='LTL/FTL'; //LTL
$peso= 11;
$dias=1;
$tipo='IMP';
$calculoTarifa=1;
*/
$s_tipoDoc = 'ctaGastos';
$s_seccion = 'POCME';
$consolidado = 'LTL/FTL';

#-- * * * * * * * * * * ESTE CALCULA LOS IMPORTES QUE SE AGREGAN  SI SON FTL O LTL, SEGUN SE ESPECIFIQUE EN LA REFERENCIA * * * * * * * * * *
#-- * * * * * * * * * * LTL :: CARGA SUELTA
#-- * * * * * * * * * * FTL :: TRAILER COMPLETO

$ADICIONAL = 0;

//$system_callback = [];
$query_consultaConcPOCME = "SELECT DISTINCT b.pk_id_concepto,b.fk_id_tipo, B.s_descripcion,B.s_concepto_eng, A.fk_id_cliente , B.fk_id_cuenta
													FROM conta_tarifas a, conta_tarifas_conceptos b
													WHERE A.fk_id_concepto = B.pk_id_concepto AND a.fk_id_cliente = ? AND A.s_imp_exp = ? AND fk_id_cuenta like 'HNS%'";
#and a.s_consolidado = ?

// $query_consultaConcPOCME = "SELECT DISTINCT b.fk_id_conceptoHon,b.fk_id_tipoCalculo, B.s_concepto_esp,B.s_concepto_eng, A.fk_id_cliente , B.fk_id_conceptoCta
// 														FROM contame_tarifas a, contame_tarifas_conceptos b
// 														WHERE A.FK_ID_ConceptoHon = B.FK_ID_ConceptoHon AND a.fk_id_cliente = ? and a.s_consolidado = ? AND A.s_operacion = ? ";

$stmt_consultaConcPOCME = $db->prepare($query_consultaConcPOCME);
if (!($stmt_consultaConcPOCME)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}

#$consolidado,
$stmt_consultaConcPOCME->bind_param('ss',$id_cliente_usar,$tipo);
if (!($stmt_consultaConcPOCME)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaConcPOCME->errno]: $stmt_consultaConcPOCME->error";
	exit_script($system_callback);
}

if (!($stmt_consultaConcPOCME->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaConcPOCME->errno]: $stmt_consultaConcPOCME->error";
	exit_script($system_callback);
}

$rslt_consultaConcPOCME = $stmt_consultaConcPOCME->get_result();

while ($row_consultaConcPOCME = $rslt_consultaConcPOCME->fetch_assoc()) {
	$ID_CONCEPTO_CURSOR = $row_consultaConcPOCME['pk_id_concepto'];
	$TIPO_CURSOR = $row_consultaConcPOCME['fk_id_tipo'];
	$s_concepto_esp = $row_consultaConcPOCME['s_descripcion'];
	$s_concepto_eng = $row_consultaConcPOCME['s_concepto_eng'];
	$fk_id_conceptoCta = $row_consultaConcPOCME['fk_id_cuenta'];

	$IMPORTE = 0;
	//echo $id_cliente_usar.'/'.$tipo.'//'.$ID_CONCEPTO_CURSOR.'///'.$consolidado.'<br>';

	#-- Un solo registro con un solo importe
	if( $TIPO_CURSOR == 301 ){
		$query_calc301 = "SELECT n_importe_1
											FROM conta_tarifas
											WHERE fk_id_cliente = ? AND s_imp_exp = ? and fk_id_concepto = ? AND s_consolidado = ?";
		// $query_calc301 = "SELECT n_importe_1
		// 									FROM contame_tarifas
		// 									WHERE fk_id_cliente = ? AND s_operacion = ? and fk_id_conceptoHon = ? AND s_consolidado = ?";

		$stmt_calc301 = $db->prepare($query_calc301);
		if (!($stmt_calc301)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
			exit_script($system_callback);
		}
		$stmt_calc301->bind_param('ssss',$id_cliente_usar,$tipo,$ID_CONCEPTO_CURSOR,$consolidado);
		if (!($stmt_calc301)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during variables binding [$stmt_calc301->errno]: $stmt_calc301->error";
			exit_script($system_callback);
		}
		if (!($stmt_calc301->execute())) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query execution [$stmt_calc301->errno]: $stmt_calc301->error";
			exit_script($system_callback);
		}
		$rslt_calc301 = $stmt_calc301->get_result();
		if ($rslt_calc301->num_rows > 0) {
			$row_calc301 = $rslt_calc301->fetch_assoc();
			$IMPORTE = $row_calc301['n_importe_1'];
			if( is_null($IMPORTE) ){ $IMPORTE = 0; }

		}
	}//fin 301

	#-- Varios registros con 1 limite inferior, 1 limite superior y 1 importe ( por peso )
	if( $TIPO_CURSOR == 302 ){
		$query_calc302 = "SELECT n_importe_1
											FROM conta_tarifas
											WHERE fk_id_cliente = ? AND s_imp_exp = ? and fk_id_concepto = ? AND s_consolidado = ? AND n_lim_inferior <= ? and n_lim_superior >= ?";

		// $query_calc302 = "SELECT n_importe_1
		// 									FROM contame_tarifas
		// 									WHERE fk_id_cliente = ? AND s_operacion = ? and fk_id_conceptoHon = ? AND s_consolidado = ? AND n_lim_inferior <= ? and n_lim_superior >= ?";

		$stmt_calc302 = $db->prepare($query_calc302);
		if (!($stmt_calc302)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
			exit_script($system_callback);
		}
		$stmt_calc302->bind_param('ssssss',$id_cliente_usar,$tipo,$ID_CONCEPTO_CURSOR,$consolidado,$peso,$peso);
		if (!($stmt_calc302)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during variables binding [$stmt_calc302->errno]: $stmt_calc302->error";
			exit_script($system_callback);
		}
		if (!($stmt_calc302->execute())) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query execution [$stmt_calc302->errno]: $stmt_calc302->error";
			exit_script($system_callback);
		}
		$rslt_calc302 = $stmt_calc302->get_result();
		if ($rslt_calc302->num_rows > 0) {
			$row_calc302 = $rslt_calc302->fetch_assoc();
			$IMPORTE = $row_calc302['n_importe_1'];
			if( is_null($IMPORTE) ){ $IMPORTE = 0; }
		}
	}//fin 302


	//guardo tarifa
	#if( $IMPORTE > 0 ){
		$query_insertConcPOCME = "INSERT INTO conta_tem_tarifas_calculoDetalle(
																					fk_id_concepto,
																					fk_id_tipo,
																					s_conceptoEsp,
																					s_conceptoEnglish,
																					fk_id_cliente,
																					fk_id_tarifa,
																					fk_usuario,
																					s_seccion,
																					n_importe,
																					fk_id_cuenta
																					)values(?,?,?,?,?,?,?,?,?,?)";

		$stmt_insertConcPOCME = $db->prepare($query_insertConcPOCME);
		if (!($stmt_insertConcPOCME)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
			exit_script($system_callback);
		}

		$stmt_insertConcPOCME->bind_param('ssssssssss',$ID_CONCEPTO_CURSOR,
																									$TIPO_CURSOR,
																									$s_concepto_esp,
																									$s_concepto_eng,
																									$id_cliente_usar,
																									$calculoTarifa,
																									$usuario,
																									$s_seccion,
																									$IMPORTE,
																									$fk_id_conceptoCta);
		if (!($stmt_insertConcPOCME)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during variables binding [$stmt_insertConcPOCME->errno]: $stmt_insertConcPOCME->error";
			exit_script($system_callback);
		}
		if (!($stmt_insertConcPOCME->execute())) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query execution [$stmt_insertConcPOCME->errno]: $stmt_insertConcPOCME->error";
			exit_script($system_callback);
		}
	#}//fin guardar

}

?>

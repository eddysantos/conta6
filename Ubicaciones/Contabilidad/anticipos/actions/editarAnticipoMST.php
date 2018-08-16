<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_anticipo = trim($_POST['id_anticipo']);
$fecha = trim($_POST['antfecha']);
$valor = trim($_POST['antvalor']);
$cliente = trim($_POST['antcliente']);
$banco = trim($_POST['antbanco']);
$bancocta = trim($_POST['bancocta']);
$concepto = trim($_POST['antconcepto']);
$cta = trim($_POST['antcuenta']);
$id_poliza = trim($_POST['id_poliza']);

//$fechaDoc = date_format(date_create($fecha),'Y-m-d');


#'******* CTA ORIGEN ***************************
$parteCuenta = explode('-',$cta);
$bcoDest = "999"; //999 -	N/A - No identificado
$ctaDest = "NA";

if( $parteCuenta[0] == "0100" ){
	$query = "SELECT fk_id_banco AS id_banco,s_ctaOri AS ctaOri FROM conta_cs_bancos_cia WHERE fk_id_cuenta = ?";

}else{
	$query = "SELECT a.fk_id_banco AS id_banco,a.s_cta_banco AS ctaOri
						FROM conta_cs_bancos_clientes A, conta_cs_cuentas_mst B
						WHERE A.fk_id_cliente = B.s_cta_identificador AND b.pk_id_cuenta = ? ";
}

$stmt = $db->prepare($query);
if (!($stmt)) { die("Error during query prepare CTA [$db->errno]: $db->error");	}

$stmt->bind_param('s', $cta);
if (!($stmt)) { die("Error during query prepare CTA [$stmt->errno]: $stmt->error");	}

if (!($stmt->execute())) { die("Error during query prepare CTA [$stmt->errno]: $stmt->error"); }

$rslt = $stmt->get_result();
$rows = $rslt->num_rows;
$row = $rslt->fetch_assoc();
$bcoDest = $row['id_banco'];
$ctaDest = $row['ctaOri'];
#'******* FIN CTA ORIGEN ******************************



$system_callback = [];

//actualizando MST
$query_antMST = "UPDATE conta_t_anticipos_mst
SET d_fecha=?,
n_valor=?,
fk_id_cliente_antmst=?,
fk_id_cuentaMST=?,
s_concepto=?,
s_bancoOri=?,
s_ctaOri=?,
s_bancoDest=?,
s_ctaDest=?
WHERE pk_id_anticipo=?";

$stmt_antMST = $db->prepare($query_antMST);
if (!($stmt_antMST)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare MST [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_antMST->bind_param('ssssssssss', $fecha,$valor,$cliente,$cta,$concepto,$banco,$bancocta,$bcoDest,$ctaDest,$id_anticipo);
if (!($stmt_antMST)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding MST [$stmt_antMST->errno]: $stmt_antMST->error";
  exit_script($system_callback);
}

if (!($stmt_antMST->execute())) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution MST [$stmt_antMST->errno]: $stmt_antMST->error";
  exit_script($system_callback);
}


$descripcion = "Se Actualizo el Anticipo: $id_anticipo Concepto: $concepto Fecha: $fecha Valor: $valor Cuenta:$cta Cliente:$cliente";
$clave = 'anticipos';
$folio = $id_anticipo;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


//actualizando DET ******************************************************************************
$query_antDET = "UPDATE conta_t_anticipos_det SET d_fecha=? WHERE fk_id_anticipo=?";

$stmt_antDET = $db->prepare($query_antDET);
if (!($stmt_antDET)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare DET [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_antDET->bind_param('ss', $fecha,$id_anticipo);
if (!($stmt_antDET)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding DET [$stmt_antDET->errno]: $stmt_antDET->error";
  exit_script($system_callback);
}

if (!($stmt_antDET->execute())) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution DET [$stmt_antDET->errno]: $stmt_antDET->error";
  exit_script($system_callback);
}

if( $id_poliza > 0 ){
		//actualizando POLMST - actualiza la fecha y concepto de poliza
		$query_polMST = "UPDATE conta_t_polizas_mst SET d_fecha=?, s_concepto = ?
										WHERE pk_id_poliza=?";

		$stmt_polMST = $db->prepare($query_polMST);
		if (!($stmt_polMST)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query prepare POLMST [$db->errno]: $db->error";
			exit_script($system_callback);
		}

		$stmt_polMST->bind_param('sss', $fecha,$concepto,$id_poliza);
		if (!($stmt_polMST)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during variables binding POLMST [$stmt_polMST->errno]: $stmt_polMST->error";
			exit_script($system_callback);
		}

		if (!($stmt_polMST->execute())) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query execution POLMST [$stmt_polMST->errno]: $stmt_polMST->error";
			exit_script($system_callback);
		}



		//actualizando POLDET - actualiza la fecha a todos los registros del detalle *********************************************************************
		$query_polDET = "UPDATE conta_t_polizas_det SET d_fecha=? WHERE fk_id_poliza=?";

		$stmt_polDET = $db->prepare($query_polDET);
		if (!($stmt_polDET)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query prepare POLMST [$db->errno]: $db->error";
			exit_script($system_callback);
		}

		$stmt_polDET->bind_param('ss', $fecha,$id_poliza);
		if (!($stmt_polDET)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during variables binding POLDET [$stmt_polDET->errno]: $stmt_polDET->error";
			exit_script($system_callback);
		}

		if (!($stmt_polDET->execute())) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query execution POLDET [$stmt_polDET->errno]: $stmt_polDET->error";
			exit_script($system_callback);
		}

/***************************************/
// CONTABILIDAD ELECTRONICA
/***************************************/
		$d_fecha_modifi = date("Y-m-d H:i:s",time());

		//consulto el nombre de la cuenta contable////////
		$querynomCta = "SELECT ifnull(s_cta_identificador,'0') as id_cliente,s_cta_desc
		                                from conta_cs_cuentas_mst
		                                where pk_id_cuenta = ? ";
		$stmtnomCta = $db->prepare($querynomCta);
		if (!($stmtnomCta)) { die("Error during query prepare nomCta [$db->errno]: $db->error"); }
		$stmtnomCta->bind_param('s',$cta);
		if (!($stmtnomCta)) { die("Error during query prepare nomCta [$stmtnomCta->errno]: $stmtnomCta->error"); }
		if (!($stmtnomCta->execute())) { die("Error during query execute nomCta [$stmtnomCta->errno]: $stmtnomCta->error"); }
		$rsltnomCta = $stmtnomCta->get_result();
		$rownomCta = $rsltnomCta->fetch_assoc();
		$cta_desc = trim($rownomCta['s_cta_desc']);

		//consulto el nombre,RFC del cliente////////
		$querynomCLT = "SELECT s_nombre,s_rfc
		                                from conta_replica_clientes
		                                where pk_id_cliente = ? ";
		$stmtnomCLT = $db->prepare($querynomCLT);
		if (!($stmtnomCLT)) { die("Error during query prepare nomCLT [$db->errno]: $db->error"); }
		$stmtnomCLT->bind_param('s',$cliente);
		if (!($stmtnomCLT)) { die("Error during query prepare nomCLT [$stmtnomCLT->errno]: $stmtnomCLT->error"); }
		if (!($stmtnomCLT->execute())) { die("Error during query execute nomCLT [$stmtnomCLT->errno]: $stmtnomCLT->error"); }
		$rsltnomCLT = $stmtnomCLT->get_result();
		$rownomCLT = $rsltnomCLT->fetch_assoc();
		$nomCliente = trim($rownomCLT['s_nombre']);
		$rfcCliente = trim($rownomCLT['s_rfc']);



		//actualizando POLDEL - actualiza el registro que corresponde a anticipoMST *************************************************************
		$query_partAnt = "UPDATE conta_t_polizas_det
										SET n_cargo = ?,fk_id_cliente = ?,fk_id_cuenta = ?,s_desc=?
										WHERE s_idDocumento = 'anticipoMST' AND fk_idRegistro = ? AND fk_id_poliza=?";

		$stmt_partAnt = $db->prepare($query_partAnt);
		if (!($stmt_partAnt)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query prepare POLMST [$db->errno]: $db->error";
			exit_script($system_callback);
		}

		$stmt_partAnt->bind_param('ssssss',$valor,$cliente,$cta,$cta_desc,$id_anticipo,$id_poliza);
		if (!($stmt_partAnt)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during variables binding POLDET [$stmt_partAnt->errno]: $stmt_partAnt->error";
			exit_script($system_callback);
		}

		if (!($stmt_partAnt->execute())) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query execution POLDET [$stmt_partAnt->errno]: $stmt_partAnt->error";
			exit_script($system_callback);
		}

}

// se actualiza la contabilidad electronica
$queryPOL = "SELECT * from conta_t_polizas_det
						WHERE fk_ctagastos is null and fk_factura is null and fk_pago is null and fk_nc is null and
 						fk_id_poliza = ?";

$stmtPOL = $db->prepare($queryPOL);
if (!($stmtPOL)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare POL [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmtPOL->bind_param('s',$id_poliza);
if (!($stmtPOL)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding POL [$stmtPOL->errno]: $stmtPOL->error";
	exit_script($system_callback);
}
if (!($stmtPOL->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution POL [$stmtPOL->errno]: $stmtPOL->error";
	exit_script($system_callback);
}
$rsltPOL = $stmtPOL->get_result();
while($rowPOL = $rsltPOL->fetch_assoc()){
	$partidaDoc = $rowPOL['pk_partida'];
	$tipo = $rowPOL['fk_tipo'];
	$factura = $rowPOL['fk_factura'];
	$notaCred = $rowPOL['fk_nc'];
	$referencia = $rowPOL['fk_referencia'];
	$poliza = $rowPOL['fk_id_poliza'];
	$tipoDetalle = 'Transferencia';

	// Transferencia
	$queryTRANSFER = "UPDATE conta_t_polizas_det_contaelec SET
										s_BancoOri = ?,
										s_ctaOri = ?,
										s_BancoDest = ?,
										s_CtaDest = ?,
										d_fecha = ?,
										s_Beneficiario = ?,
										s_RFC = ?,
										n_monto = ?,
										s_usuario_modifi = ?,
										d_fecha_modifi = ?,
										s_BeneficiarioOpc = ?,
										s_RFCopc = ?
										WHERE fk_id_poliza = ? AND fk_partidaPol = ?";
	$stmtTRANSFER = $db->prepare($queryTRANSFER);
	if (!($stmtTRANSFER)) {
		$system_callback['code'] = "500";
		$system_callback['message'] = "Error during query prepare TRANSFER [$db->errno]: $db->error";
		exit_script($system_callback);
	}
	$stmtTRANSFER->bind_param('ssssssssssssss',$banco,
																						$bancocta,
																						$bcoDest,
																						$ctaDest,
																						$fecha,
																						$nomCliente,
																						$rfcCliente,
																						$valor,
																						$usuario,
																						$d_fecha_modifi,
																						$nombreCIA,
																						$rfcCIA,
																						$id_poliza,
																						$partidaDoc);

	if (!($stmtTRANSFER)) {
		$system_callback['code'] = "500";
		$system_callback['message'] = "Error during variables binding TRANSFER [$stmtTRANSFER->errno]: $stmtTRANSFER->error";
		exit_script($system_callback);
	}
	if (!($stmtTRANSFER->execute())) {
		$system_callback['code'] = "500";
		$system_callback['message'] = "Error during query execution TRANSFER [$stmtTRANSFER->errno]: $stmtTRANSFER->error";
		exit_script($system_callback);
	}
	$rsltTRANSFER = $stmtTRANSFER->get_result();
	/* FALTA TERMINAR
		// CFDI CompNal
		if( $factura > 0 || $notaCred > 0 ){
			if( $notaCred > 0 ){
				$oRst_datosNC = mysqli_fetch_array( mysqli_query($link,"SELECT Fac_RFC,UUID,Total_Honorarios
																				FROM TBL_NOTACREDITO_CFDI
																				WHERE ID_NC = $notaCred and Id_Referencia = '$referencia' "));
				$tipoDetalle = 'CompNal';
				$RFC = $oRst_datosNC['Fac_RFC'];
				$UUID_CFDI = $oRst_datosNC['UUID'];
				$monto = $oRst_datosNC['Total_Honorarios'];
			}else{
				if( $factura > 0 && $notaCred == 0 ){
					$oRst_datosFactura = mysqli_fetch_array( mysqli_query($link,"SELECT Fac_RFC,UUID,Total_Honorarios
																				FROM TBL_FACTURAS_CFD
																				WHERE id_factura = $factura and id_referencia = '$referencia' "));
					$tipoDetalle = 'CompNal';
					$RFC = $oRst_datosFactura['Fac_RFC'];
					$UUID_CFDI = $oRst_datosFactura['UUID'];
					$monto = $oRst_datosFactura['Total_Honorarios'];
				}
			}
			mysqli_query($link,"INSERT INTO TBL_POLIZAS_DET_PARTIDA (partidaDoc,tipo,tipoDetalle,RFC,UUID_CFDI,monto,usuario_alta)values
			($partidaDoc,$tipo,'CompNal','$RFC','$UUID_CFDI',$monto,'$usuario')");
		}
	*/
	}

$system_callback['data'] .= $nFolio;
$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>

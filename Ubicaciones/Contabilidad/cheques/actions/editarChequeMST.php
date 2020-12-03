<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

// $fecha = trim($_POST['fecha']);
// $cuenta = trim($_POST['cuenta']);
// $cheque = trim($_POST['cheque']);
// $valor = trim($_POST['importe']);
// $concepto = trim($_POST['concepto']);
// $opcion = trim($_POST['opcion']);
// $idOrd = trim($_POST['id_expedidor']);
// $id_poliza = trim($_POST['id_poliza']);
// $idcheque_folControl = trim($_POST['idcheque_folControl']);
// $idcuentaMST = trim($_POST['idcuentaMST']);
// $idchequeMST = trim($_POST['idchequeMST']);

extract($_POST);
// error_log('Pase el extact');
// error_log($fecha);

$fechaDoc = date_format(date_create($fecha),'Y-m-d');

//nombre y rfc correspondiente
if( $opcion == "BEN" ){ $queryDatosOrdenante = "SELECT s_nombre,s_rfc
																								FROM conta_cs_beneficiarios
																								WHERE pk_id_benef = ?" ;}

if( $opcion == "CLT" ){ $queryDatosOrdenante = "SELECT s_nombre,s_rfc
																								FROM conta_replica_clientes
																								WHERE pk_id_cliente = ?" ;}


// NOTE: modifique esta tabla porque conta_cs_empleados no existe
if( $opcion == "EMPL" ){ $queryDatosOrdenante = "SELECT CONCAT(s_nombre,' ',s_apellidoP,' ',s_apellidoM) AS s_nombre, s_rfc
																								-- FROM conta_cs_empleados
																								FROM conta_t_nom_empleados
																								WHERE pk_id_empleado = ?" ;}

if( $opcion == "PROV" ){ $queryDatosOrdenante = "SELECT s_nombre,s_rfc
																								FROM conta_cs_proveedores
																								WHERE pk_id_proveedor = ?" ;}


// error_log('Pase las querys');


$stmtDatosOrdenante = $db->prepare($queryDatosOrdenante);
if (!($stmtDatosOrdenante)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmtDatosOrdenante->bind_param('s',$idOrd);
if (!($stmtDatosOrdenante)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error al pasar variables [$stmtDatosOrdenante->errno]: $stmtDatosOrdenante->error";
  exit_script($system_callback);
}
if (!($stmtDatosOrdenante->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion [$stmtDatosOrdenante->errno]: $stmtDatosOrdenante->error";
  exit_script($system_callback);
}
$rsltDatosOrdenante = $stmtDatosOrdenante->get_result();
$rowDatosOrdenante = $rsltDatosOrdenante->fetch_assoc();
$nomOrd = $rowDatosOrdenante['s_nombre'];
$rfcOrd = $rowDatosOrdenante['s_rfc'];


// error_log('tengo los datos de nomORD y rfc Ord');

#'******* CTA ORIGEN ***************************
/*
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
*/
#'******* FIN CTA ORIGEN ******************************



$system_callback = [];
$system_callback['aff_rows'] = [];


//revisando cheque duplicado
if( $idchequeMST != $cheque || $cuenta != $idcuentaMST ){
	error_log('entre al if');
	$queryChequeExiste = "SELECT * FROM conta_t_cheques_mst WHERE pk_id_cheque = ? AND fk_id_cuentaMST = ?";

	$stmtChequeExiste = $db->prepare($queryChequeExiste);
	if (!($stmtChequeExiste)) {
		$system_callback['code'] = "500";
		$system_callback['message'] = "Error during query prepare EX[$db->errno]: $db->error";
		exit_script($system_callback);
	}

	$stmtChequeExiste->bind_param('ss', $cheque,$cuenta);
	if (!($stmtChequeExiste)) {
		$system_callback['code'] = "500";
		$system_callback['message'] = "Error during variables binding EX[$stmtChequeExiste->errno]: $stmtChequeExiste->error";
		exit_script($system_callback);
	}

	if (!($stmtChequeExiste->execute())) {
		$system_callback['code'] = "500";
		$system_callback['message'] = "Error during query execution EX[$stmtChequeExiste->errno]: $stmtChequeExiste->error";
		exit_script($system_callback);
	}

	$rsltChequeExiste = $stmtChequeExiste->get_result();
	$rowsChequeExiste = $rsltChequeExiste->num_rows;
	$system_callback['aff_rows']['queryChequeExiste'] = $rowsChequeExiste;

	if ($rowsChequeExiste > 0) {
		$system_callback['code'] = "500";
		$system_callback['data'] ="EL CHEQUE DUPLICADO $cheque YA EXISTE CON LA CUENTA $cuenta";
		$system_callback['message'] = "Cheque Existe";
		exit_script($system_callback);
	}

	error_log("Rows Cheque Exist = " . $rowsChequeExiste);
}else{
	$rowsChequeExiste = 0;
}

// error_log('llegue hasta aqui');
if ($rowsChequeExiste == 0){
	error_log('el checque no existe');
	try {
	  $db->begin_transaction();

		//actualizando MST
		$queryUpdateMST = "UPDATE conta_t_cheques_mst
		SET pk_id_cheque=?,
		d_fechache=?,
		fk_id_cuentaMST=?,
		s_tipoOrdenante=?,
		fk_idOrd=?,
		s_nomOrd=?,
		s_concepto=?,
		n_valor=?
		where pk_idcheque_folControl = ?";

		$stmtUpdateMST = $db->prepare($queryUpdateMST);
		if (!($stmtUpdateMST)) {
			$system_callback['code'] = "500";
		  $system_callback['message'] = "Error during query prepare MST [$db->errno]: $db->error";
		  exit_script($system_callback);
		}

		$stmtUpdateMST->bind_param('sssssssss',$cheque,$fecha,$cuenta,$opcion,$idOrd,$nomOrd,$concepto,$valor,$idcheque_folControl);
		if (!($stmtUpdateMST)) {
			$system_callback['code'] = "500";
		  $system_callback['message'] = "Error during variables binding MST [$stmtUpdateMST->errno]: $stmtUpdateMST->error";
		  exit_script($system_callback);
		}

		if (!($stmtUpdateMST->execute())) {
			$system_callback['code'] = "500";
		  $system_callback['message'] = "Error during query execution MST [$stmtUpdateMST->errno]: $stmtUpdateMST->error";
		  exit_script($system_callback);
		}

		$rsltUpdateMST = $stmtUpdateMST->get_result();
		$rowsUpdateMST = $rsltUpdateMST->num_rows;
		$system_callback['aff_rows']['queryUpdateMST'] = $rowsUpdateMST;


		$descripcion = "Se Actualizo el ChequeFolioControl: $idcheque_folControl Cheque: $cheque Cuenta:$cuenta Concepto: $concepto Fecha: $fecha Valor: $valor Expedido a: $opcion, $idOrd $nomOrd";
		$clave = 'cheques';
		$folio = $cheque;
		require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';


		$query_cheEditDET = "UPDATE conta_t_cheques_det
		SET fk_id_cheque = ?,
		fk_id_cuentaM = ?,
		d_fecha = ?
		WHERE fk_idcheque_folControl = ?";
		$stmt_cheEditDET = $db->prepare($query_cheEditDET);
		if (!($stmt_cheEditDET)) {
			// die("Error during query prepare [$db->errno]: $db->error");
			$system_callback['code'] = "500";
			"Error during query prepare DET [$db->errno]: $db->error";
			exit_script($system_callback);
		}
		$stmt_cheEditDET->bind_param('ssss',$cheque,$cuenta,$fecha,$idcheque_folControl);

		if (!($stmt_cheEditDET)) {
			// die("Error during variables binding [$stmt_cheEditDET->errno]: $stmt_cheEditDET->error");
			$system_callback['code'] = "500";
		  $system_callback['message'] = "Error during variables binding DET [$stmt_cheEditDET->errno]: $stmt_cheEditDET->error";
		  exit_script($system_callback);
		}

		if (!($stmt_cheEditDET->execute())) {
			// die("Error during query execute [$stmt_cheEditDET->errno]: $stmt_cheEditDET->error");
			$system_callback['code'] = "500";
		  $system_callback['message'] = "Error during query execute DET [$stmt_cheEditDET->errno]: $stmt_cheEditDET->error";
		  exit_script($system_callback);
		}

		// $affected = $stmt_cheEditDET->affected_rows;

		$rsltcheEditDET = $stmt_cheEditDET->get_result();
		$rowscheEditDET = $rsltcheEditDET->num_rows;
		$system_callback['aff_rows']['query_cheEditDET'] = $rowscheEditDET;

		// if ($affected == 0) {
		// 	// die("El query no hizo ningún cambio a la base de datos[$stmt_cheEditDET->errno]: $stmt_cheEditDET->error");
		//
		// 	$system_callback['code'] = "500";
		//   $system_callback['message'] = "El query no hizo ningún cambio a la base de datos[$stmt_cheEditDET->errno]: $stmt_cheEditDET->error";
		//   exit_script($system_callback);
		//  }
		// error_log("Id Poliza = " . $id_poliza);
		if( $id_poliza > 0 ){
				$mesPoliza = date_format(date_create($fecha),'m');

				error_log($mesPoliza);

				//actualizando POLMST
				$queryActPolMST = "UPDATE conta_t_polizas_mst SET d_fecha = ?, s_concepto = ?, d_mes = ? WHERE pk_id_poliza = ?";
				$stmtActPolMST = $db->prepare($queryActPolMST);
				if (!($stmtActPolMST)) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during query prepare POLMST [$db->errno]: $db->error";
					exit_script($system_callback);
				}
				$stmtActPolMST->bind_param('ssss', $fecha,$concepto,$mesPoliza,$id_poliza);
				if (!($stmtActPolMST)) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during variables binding POLMST [$stmtActPolMST->errno]: $stmtActPolMST->error";
					exit_script($system_callback);
				}
				if (!($stmtActPolMST->execute())) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during query execution POLMST [$stmtActPolMST->errno]: $stmtActPolMST->error";
					exit_script($system_callback);
				}

				$rsltcheActPolMST = $stmtActPolMST->get_result();
				$rowscheActPolMST = $rsltcheActPolMST->num_rows;
				$system_callback['aff_rows']['queryActPolMST'] = $rowscheActPolMST;


				//actualizando POLDETfecha
				$queryActPolDETfecha = "UPDATE conta_t_polizas_det SET d_fecha = ?, fk_cheque = ?, d_mes = ?	WHERE fk_id_poliza = ?";
				$stmtActPolDETfecha = $db->prepare($queryActPolDETfecha);
				error_log("Query Actualizacion de fecha");
				if (!($stmtActPolDETfecha)) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during query prepare POLDETfecha [$db->errno]: $db->error";
					error_log("Fallo query prepare");
					exit_script($system_callback);
				}
				$stmtActPolDETfecha->bind_param('ssss', $fecha,$cheque,$mesPoliza,$id_poliza);
				if (!($stmtActPolDETfecha)) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during variables binding POLDETfecha [$stmtActPolDETfecha->errno]: $stmtActPolDETfecha->error";
					error_log("Fallo query binding");
					exit_script($system_callback);
				}
				if (!($stmtActPolDETfecha->execute())) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during query execution POLDETfecha [$stmtActPolDETfecha->errno]: $stmtActPolDETfecha->error";
					error_log("Fallo query execution");
					exit_script($system_callback);
				}

				$rsltcheActPolDETfecha = $stmtActPolDETfecha->get_result();
				$rowscheActPolDETfecha = $rsltcheActPolDETfecha->num_rows;
				$system_callback['aff_rows']['queryActPolDETfecha'] = $rowscheActPolDETfecha;

				//actualizando POLDET
				$queryActPolDET = "UPDATE conta_t_polizas_det SET fk_id_cuenta=?, fk_id_cliente=?, fk_cheque=?, s_desc=?, n_abono =?
				WHERE s_idDocumento='chequeMST' AND fk_id_poliza=?";
				$stmtActPolDET = $db->prepare($queryActPolDET);
				if (!($stmtActPolDET)) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during query prepare POLDET [$db->errno]: $db->error";
					exit_script($system_callback);
				}
				$stmtActPolDET->bind_param('ssssss', $cuenta,$idOrd,$cheque,$concepto,$valor,$id_poliza);
				if (!($stmtActPolDET)) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during variables binding POLDET [$stmtActPolDET->errno]: $stmtActPolDET->error";
					exit_script($system_callback);
				}
				if (!($stmtActPolDET->execute())) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during query execution POLDET [$stmtActPolDET->errno]: $stmtActPolDET->error";
					exit_script($system_callback);
				}

				$rsltcheActPolDET = $stmtActPolDET->get_result();
				$rowscheActPolDET = $rsltcheActPolDET->num_rows;
				$system_callback['aff_rows']['queryActPolDET'] = $rowscheActPolDET;


		}



		$system_callback['data'] .= $cheque;
		$system_callback['code'] = 1;
		$system_callback['message'] = "Script called successfully!";

		$db->commit();
	  $system_callback['code'] = 1;
		error_log("Query commited!");
		exit_script($system_callback);
	} catch (\Exception $e) {
	  $db->rollback();
	  $system_callback['e'] = $e;
	  $system_callback['query']['code'] = "2";
	  $system_callback['query']['message'] = "There was a problem executing the query[$db->errno]: $db->error";
		error_log("query rolled back");
		exit_script($system_callback);
	}//try

}// termina $rowsChequeExiste == 1


?>

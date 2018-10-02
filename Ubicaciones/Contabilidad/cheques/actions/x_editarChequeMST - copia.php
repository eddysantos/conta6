<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$fecha = trim($_POST['fecha']);
$cheque = trim($_POST['cheque']);
$cuenta = trim($_POST['cuenta']);
$valor = trim($_POST['importe']);
$concepto = trim($_POST['concepto']);
$opcion = trim($_POST['opcion']);
$idOrd = trim($_POST['id_expedidor']);
$id_poliza = trim($_POST['id_poliza']);
$idcheque_folControl = trim($_POST['idcheque_folControl']);

$fechaDoc = date_format(date_create($fecha),'Y-m-d');

//nombre y rfc correspondiente
if( $opcion == "BEN" ){ $queryDatosOrdenante = "SELECT s_nombre,s_rfc FROM conta_cs_beneficiarios WHERE pk_id_benef = ?" ;}
if( $opcion == "CLT" ){ $queryDatosOrdenante = "SELECT s_nombre,s_rfc FROM conta_replica_clientes WHERE pk_id_cliente = ?" ;}
if( $opcion == "EMPL" ){ $queryDatosOrdenante = "SELECT CONCAT(s_nombre,' ',s_apellidoP,' ',s_apellidoM) AS s_nombre, s_rfc FROM conta_cs_empleados where pk_id_empleado = ?" ;}
if( $opcion == "PROV" ){ $queryDatosOrdenante = "SELECT s_nombre,s_rfc FROM conta_cs_proveedores WHERE pk_id_proveedor = ?" ;}
$stmtDatosOrdenante = $db->prepare($queryDatosOrdenante);
if (!($stmtDatosOrdenante)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmtDatosOrdenante->bind_param('s',$idOrd);
if (!($stmtDatosOrdenante)) { die("Error during query prepare [$stmtDatosOrdenante->errno]: $stmtDatosOrdenante->error");	}
if (!($stmtDatosOrdenante->execute())) { die("Error during query prepare [$stmtDatosOrdenante->errno]: $stmtDatosOrdenante->error"); }
$rsltDatosOrdenante = $stmtDatosOrdenante->get_result();
$rowDatosOrdenante = $rsltDatosOrdenante->fetch_assoc();
$nomOrd = $rowDatosOrdenante['s_nombre'];
$rfcOrd = $rowDatosOrdenante['s_rfc'];

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

//revisando cheque duplicado
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


if ($rowsChequeExiste > 1) {
	$system_callback['code'] = "500";
	$system_callback['data'] ="EL CHEQUE DUPLICADO $cheque YA EXISTE CON LA CUENTA $cuenta";
	$system_callback['message'] = "Cheque Existe";
	exit_script($system_callback);
}

if ($rowsChequeExiste == 1) {
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
		#WHERE pk_id_cheque=? AND fk_id_cuentaMST=? ";

		$stmtUpdateMST = $db->prepare($queryUpdateMST);
		if (!($stmtUpdateMST)) {
			$system_callback['code'] = "500";
		  $system_callback['message'] = "Error during query prepare MST [$db->errno]: $db->error";
		  exit_script($system_callback);
		}

		//$stmtUpdateMST->bind_param('ssssssssss',$cheque,$fecha,$cuenta,$opcion,$idOrd,$nomOrd,$concepto,$valor,$cheque,$cuenta);
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


		$descripcion = "Se Actualizo el ChequeFolioControl: $idcheque_folControl Cheque: $cheque Cuenta:$cuenta Concepto: $concepto Fecha: $fecha Valor: $valor Expedido a: $opcion, $idOrd $nomOrd";
		$clave = 'cheques';
		$folio = $cheque;
		require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

		//actualizo el detalle del cheque
		//$query_cheEditDET = "UPDATE conta_t_cheques_det SET fk_id_cheque = ?, fk_id_cuentaM = ?, d_fecha = ? WHERE fk_id_cheque = ? AND fk_id_cuentaM = ?";
		$query_cheEditDET = "UPDATE conta_t_cheques_det SET fk_id_cheque = ?, fk_id_cuentaM = ?, d_fecha = ? WHERE fk_idcheque_folControl = ?";
		$stmt_cheEditDET = $db->prepare($query_cheEditDET);
		if (!($stmt_cheEditDET)) { die("Error during query prepare [$db->errno]: $db->error"); }
		//$stmt_cheEditDET->bind_param('sssss',$cheque,$cuenta,$fechaDoc,$cheque,$cuenta);
		$stmt_cheEditDET->bind_param('ssss',$cheque,$cuenta,$fecha,$idcheque_folControl);
		if (!($stmt_cheEditDET)) { die("Error during variables binding [$stmt_cheEditDET->errno]: $stmt_cheEditDET->error"); }
		if (!($stmt_cheEditDET->execute())) { die("Error during query execute [$stmt_cheEditDET->errno]: $stmt_cheEditDET->error"); }
		$affected = $stmt_cheEditDET->affected_rows;
		if ($affected == 0) { die("El query no hizo ningún cambio a la base de datos  [$stmt_cheEditDET->errno]: $stmt_cheEditDET->error"); }




		if( $id_poliza > 0 ){
				//actualizando POLMST
				$queryActPolMST = "UPDATE conta_t_polizas_mst SET d_fecha=?, s_concepto=? WHERE pk_id_poliza=?";
				$stmtActPolMST = $db->prepare($queryActPolMST);
				if (!($stmtActPolMST)) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during query prepare POLMST [$db->errno]: $db->error";
					exit_script($system_callback);
				}
				$stmtActPolMST->bind_param('sss', $fecha,$concepto,$id_poliza);
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


				//actualizando POLDETfecha
				$queryActPolDETfecha = "UPDATE conta_t_polizas_det SET d_fecha=?, fk_cheque= ?	WHERE fk_id_poliza=?";
				$stmtActPolDETfecha = $db->prepare($queryActPolDETfecha);
				if (!($stmtActPolDETfecha)) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during query prepare POLDETfecha [$db->errno]: $db->error";
					exit_script($system_callback);
				}
				$stmtActPolDETfecha->bind_param('sss', $fecha,$cheque,$id_poliza);
				if (!($stmtActPolDETfecha)) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during variables binding POLDETfecha [$stmtActPolDETfecha->errno]: $stmtActPolDETfecha->error";
					exit_script($system_callback);
				}
				if (!($stmtActPolDETfecha->execute())) {
					$system_callback['code'] = "500";
					$system_callback['message'] = "Error during query execution POLDETfecha [$stmtActPolDETfecha->errno]: $stmtActPolDETfecha->error";
					exit_script($system_callback);
				}

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


		}

		$system_callback['data'] .= $cheque;
		$system_callback['code'] = 1;
		$system_callback['message'] = "Script called successfully!";
		exit_script($system_callback);

}






?>

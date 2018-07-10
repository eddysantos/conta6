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
$queryInsert = "UPDATE conta_t_anticipos_mst SET d_fecha=?,n_valor=?,fk_id_cliente=?,fk_id_cuentaMST=?,s_concepto=?,s_bancoOri=?,s_ctaOri=?,s_bancoDest=?,s_ctaDest=?
           		 WHERE pk_id_anticipo=?";

$stmtInsert = $db->prepare($queryInsert);
if (!($stmtInsert)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare MST [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtInsert->bind_param('ssssssssss', $fecha,$valor,$cliente,$cta,$concepto,$banco,$bancocta,$bcoDest,$ctaDest,$id_anticipo);
if (!($stmtInsert)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding MST [$stmtInsert->errno]: $stmtInsert->error";
  exit_script($system_callback);
}

if (!($stmtInsert->execute())) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution MST [$stmtInsert->errno]: $stmtInsert->error";
  exit_script($system_callback);
}


$descripcion = "Se Actualizo el Anticipo: $id_anticipo Concepto: $concepto Fecha: $fecha Valor: $valor Cuenta:$cta Cliente:$cliente";
$clave = 'anticipos';
$folio = $id_anticipo;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


//actualizando DET
$queryInsert = "UPDATE conta_t_anticipos_det SET d_fecha=? WHERE fk_id_anticipo=?";

$stmtInsert = $db->prepare($queryInsert);
if (!($stmtInsert)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare DET [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtInsert->bind_param('ss', $fecha,$id_anticipo);
if (!($stmtInsert)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding DET [$stmtInsert->errno]: $stmtInsert->error";
  exit_script($system_callback);
}

if (!($stmtInsert->execute())) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution DET [$stmtInsert->errno]: $stmtInsert->error";
  exit_script($system_callback);
}

if( $id_poliza > 0 ){
		//actualizando POLMST
		$queryInsert = "UPDATE conta_t_polizas_mst SET d_fecha=? WHERE
		    pk_id_poliza=?";

		$stmtInsert = $db->prepare($queryInsert);
		if (!($stmtInsert)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query prepare POLMST [$db->errno]: $db->error";
			exit_script($system_callback);
		}

		$stmtInsert->bind_param('ss', $fecha,$id_anticipo);
		if (!($stmtInsert)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during variables binding POLMST [$stmtInsert->errno]: $stmtInsert->error";
			exit_script($system_callback);
		}

		if (!($stmtInsert->execute())) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query execution POLMST [$stmtInsert->errno]: $stmtInsert->error";
			exit_script($system_callback);
		}

		//actualizando POLDET
		$queryInsert = "UPDATE conta_t_polizas_det SET d_fecha=? WHERE fk_id_poliza=?";

		$stmtInsert = $db->prepare($queryInsert);
		if (!($stmtInsert)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query prepare POLMST [$db->errno]: $db->error";
			exit_script($system_callback);
		}

		$stmtInsert->bind_param('ss', $fecha,$id_anticipo);
		if (!($stmtInsert)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during variables binding POLDET [$stmtInsert->errno]: $stmtInsert->error";
			exit_script($system_callback);
		}

		if (!($stmtInsert->execute())) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query execution POLDET [$stmtInsert->errno]: $stmtInsert->error";
			exit_script($system_callback);
		}


}

$system_callback['data'] .= $nFolio;
$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);





?>

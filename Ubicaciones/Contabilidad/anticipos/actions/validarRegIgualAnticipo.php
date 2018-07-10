<?PHP

	$root = $_SERVER['DOCUMENT_ROOT'];
	require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

	$system_callback = [];
	$data = $_POST;

	$anticipo = trim($_POST['anticipo']);
	$cuenta = trim($_POST['cuenta']);
	$referencia = trim($_POST['referencia']);
	$cliente = trim($_POST['cliente']);
	$desc = trim($_POST['desc']);
	$cargo = trim($_POST['cargo']);
	$abono = trim($_POST['abono']);

/*
	$anticipo = 25431;
	$cuenta = '0208-07664';
	$referencia = 'SN';
	$cliente = 'CLT_7664';
	$desc = 'MAHLE SISTEMAS DE FILTRACION DE MEXICO S.A. DE C.V.';
	$cargo = 40;
	$abono = 0;
*/

		$text = $data['string'];
/*
		$query = "SELECT *
							FROM conta_t_anticipos_det
							WHERE fk_id_anticipo = ? AND fk_id_cuenta = ? AND fk_referencia = ?";

		$stmt = $db->prepare($query);
		if (!($stmt)) {
		  $system_callback['code'] = "500";
		  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
		  exit_script($system_callback);
		}

		$stmt->bind_param('sss', $anticipo,$cuenta,$referencia);
		if (!($stmt)) {
		  $system_callback['code'] = "500";
		  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
		  exit_script($system_callback);
		}

		if (!($stmt->execute())) {
		  $system_callback['code'] = "500";
		  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
		  exit_script($system_callback);
		}

		$rslt = $stmt->get_result();

		if ($rslt->num_rows > 0) {
		  $system_callback['code'] = 1;
		  $system_callback['data'] = "La referencia ya existe";
		  $system_callback['message'] = "La referencia debe ser unica";
			$accionValidar = "conceptoIncorrecto";
		  exit_script($system_callback);
		}

		if ($rslt->num_rows == 0) {
*/
					///////////////////////////////////////
					$queryConcepto = "SELECT *
														FROM conta_t_anticipos_det
														WHERE fk_id_anticipo = ? AND fk_id_cuenta = ? AND fk_referencia = ? and
														      fk_id_cliente = ? AND s_desc = ? AND n_cargo = ? AND n_abono = ?";

					$stmtConcepto = $db->prepare($queryConcepto);
					if (!($stmtConcepto)) {
						$system_callback['code'] = "500";
						$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
						exit_script($system_callback);
					}

					$stmtConcepto->bind_param('sssssss', $anticipo,$cuenta,$referencia,$cliente,$desc,$cargo,$abono);
					if (!($stmtConcepto)) {
						$system_callback['code'] = "500";
						$system_callback['message'] = "Error during variables binding [$stmtConcepto->errno]: $stmtConcepto->error";
						exit_script($system_callback);
					}

					if (!($stmtConcepto->execute())) {
						$system_callback['code'] = "500";
						$system_callback['message'] = "Error during query execution [$stmtConcepto->errno]: $stmtConcepto->error";
						exit_script($system_callback);
					}

					$rsltConcepto = $stmtConcepto->get_result();
					if ($rsltConcepto->num_rows > 0) {
					  $system_callback['code'] = 1;
					  $system_callback['data'] = "conceptoExiste";
					  $system_callback['message'] = "El registro debe ser unico";
					  exit_script($system_callback);
					}

					if ($rsltConcepto->num_rows == 0) {
						$system_callback['code'] = 1;
					  $system_callback['data'] = "conceptoValido";
					  $system_callback['message'] = "Si el concepto no existe en el anticipo se puede insertar";
					  exit_script($system_callback);
					}

					///////////////////////////////////


/*
		}
*/
?>

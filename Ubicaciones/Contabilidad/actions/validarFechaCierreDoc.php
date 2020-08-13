<?PHP

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$tipo = trim($_POST['diatipo']);
$aduana = trim($_POST['diaaduana']);
$fecha = trim($_POST['diafecha']);
$usuario = trim($_POST['usuario']);
$permiso = trim($_POST['permiso']);

if( $oRst_permisos[$permiso] == 1){
	 $system_callback['data'] .= "fechaValida";
	 $system_callback['code'] = 1;
	 $system_callback['message'] = "Script called successfully!";
}else {

		$text = $data['string'];
		$query = "SELECT d_fecha_inicial,d_fecha_final
							FROM conta_t_documento_cierre
							WHERE fk_id_tipo = ? AND fk_id_aduana = ?
							ORDER BY pk_id_cierre DESC
							LIMIT 1";

		$stmt = $db->prepare($query);
		if (!($stmt)) {
		  $system_callback['code'] = "500";
		  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
		  exit_script($system_callback);
		}

		$stmt->bind_param('ss', $tipo, $aduana);
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

		if ($rslt->num_rows == 0) {
		  $system_callback['code'] = 1;
		  $system_callback['data'] =
		  "<p db-id=''>No se encontraron resultados</p>";
		  $system_callback['message'] = "Script called successfully but there are no rows to display.";
		  exit_script($system_callback);
		}

		while ($row = $rslt->fetch_assoc()) {
			$fecha_inicial = strtotime(date_format(date_create($row[d_fecha_inicial]),"Y/m/d"));
			$fecha_final = strtotime(date_format(date_create($row[d_fecha_final]),"Y/m/d"));
			$fecha_generar = strtotime(date_format(date_create($fecha),"Y/m/d"));

			if( $fecha_generar >= $fecha_inicial and $fecha_generar <= $fecha_final ){
				$accionValidar = "fechaValida";
			}else{
				$fecha_inicial = date_format(date_create($row[d_fecha_inicial]),"d・m・Y");
				$fecha_final = date_format(date_create($row[d_fecha_final]),"d・m・Y");
				$accionValidar = "$fecha_inicial\n$fecha_final";
			}

		  $system_callback['data'] .= $accionValidar;
		}

		$system_callback['code'] = 1;
		$system_callback['message'] = "Script called successfully!";
}
exit_script($system_callback);
?>

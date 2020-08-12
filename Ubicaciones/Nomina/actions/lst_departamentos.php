<?php
$system_callback = [];
$departamentos = '';


$departamentos.="<option selected value='0'>Departamento *</option>";
$query = "SELECT * FROM conta_cs_departamentos";


$stmt = $db->prepare($query);
if (!($stmt)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
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
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  $departamentos.="<option selected value='0'>Sin resultados</option>";
  exit_script($system_callback);
}

	while( $row = $rslt->fetch_assoc() ){
    $pk_id_depto = $row['pk_id_depto'];
    $s_descripcion = $row['s_descripcion'];

		$departamentos.="<option value='$pk_id_depto'>$s_descripcion</option>";
	}

 ?>

<?php
$system_callback = [];
$tipoContrato = '';

$tipoContrato .="<option selected value='0'>Tipo de Contrato *</option>";
  $query = "SELECT pk_id_contrato,s_descripcion FROM conta_cs_sat_tipocontrato";

  $stmt = $db->prepare($query);
	if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare tipo contrato [$db->errno]: $db->error";
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
    $tipoContrato ="<option selected value='0'>No hay datos</option>";
    $system_callback['message'] = "Script called successfully but there are no rows to display.";
    exit_script($system_callback);
  }

  while ($row = $rslt->fetch_assoc()) {
   	$pk_id_contrato = $row['pk_id_contrato'];
    $s_descripcion = $row['s_descripcion'];
    $tipoContrato .= "<option value='$pk_id_contrato'>$pk_id_contrato -- $s_descripcion</option>";
  }


 ?>

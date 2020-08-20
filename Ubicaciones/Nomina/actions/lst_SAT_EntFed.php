<?php
$system_callback = [];
$estado = '';
$entidadFederativa = '';

$estado .="<option selected value='0'>Seleccione Estado *</option>";
$entidadFederativa .="<option selected value='0'>Entidad Federativa donde presto servicio *</option>";
  $query = "SELECT pk_c_estado, s_entfed,s_entfed_activo FROM conta_cs_sat_entidadfederativa WHERE s_entfed_activo = 1";

  $stmt = $db->prepare($query);
	if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare entidad Federativa [$db->errno]: $db->error";
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
    $estado .="<option selected value='0'>Sin resultados</option>";
    $entidadFederativa .="<option selected value='0'>Sin resultados</option>";
    $system_callback['message'] = "Script called successfully but there are no rows to display.";
    exit_script($system_callback);
  }

  while ($row = $rslt->fetch_assoc()) {
    $pk_c_estado = $row['pk_c_estado'];
   	// $s_estado = $row['s_estado'];
    $s_entfed = $row['s_entfed'];
    // $s_id_entfed = $row['s_id_entfed'];
    $estado .= "<option value='$s_entfed'>$s_entfed</option>";


    $entidadFederativa .= "<option value='$pk_c_estado'>$s_entfed -- $pk_c_estado</option>";
  }




 ?>

<?php
$system_callback = [];
$riesgoTrabajo = '';
$riesgoTrabajo .="<option selected value='0'>Riesgo de Trabajo *</option>";

$query = "SELECT * FROM conta_cs_sat_riesgotrabajo";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion [$stmt->errno]: $db->error";
  exit_script($system_callback);
}

$result = $stmt->get_result();


if ($result->num_rows == 0) {
  $system_callback['code'] = 1;
  $riesgoTrabajo ="<option selected value='0'>No hay datos</option>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}


while ($row = $result->fetch_assoc()) {
  $pk_id_riesgo = $row['pk_id_riesgo'];
  $s_descripcion = $row['s_descripcion'];
  $riesgoTrabajo .="<option value='$pk_id_riesgo'>$pk_id_riesgo -- $s_descripcion</option>";
}

 ?>

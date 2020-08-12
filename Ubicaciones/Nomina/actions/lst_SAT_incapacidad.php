<?php

$system_callback = [];
$incapacidad = '';
$incapacidad .= "<option value='0' selected>Motivo</option>";

$query = "SELECT * FROM conta_cs_sat_incapacidad";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code']= "500";
  $system_callback['message'] = "error en la ejecucion ['$db->errno']: $db->error";
  exit_script($system_callback);
}

$result = $stmt->get_result();

if ($result->num_rows == 0) {
  $system_callback['code'] = 1;
  $incapacidad = "<option value='0' selected>Sin resultados</option>";
  $system_callback['message'] = "Llamada correcta pero no hay datos";
  exit_script($system_callback);
}

while ($row = $result->fetch_assoc()) {
  $pk_tipoIncapacidad = $row['pk_tipoIncapacidad'];
  $s_descripcion = $row['s_descripcion'];

  $incapacidad .= "<option value='$pk_tipoIncapacidad'>$pk_tipoIncapacidad --  $s_descripcion</option> ";
}

?>

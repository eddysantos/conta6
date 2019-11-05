<?php


$query_riesgotrabajo = "SELECT * FROM conta_cs_sat_riesgotrabajo WHERE pk_id_riesgo = $id_riesgo";

$stmt_riesgotrabajo = $db->prepare($query_riesgotrabajo);
if (!($stmt_riesgotrabajo)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
if (!($stmt_riesgotrabajo->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_riesgotrabajo->errno]: $stmt_riesgotrabajo->error";
  exit_script($system_callback);
}


$rslt_riesgotrabajo = $stmt_riesgotrabajo->get_result();
$row_riesgotrabajo = $rslt_riesgotrabajo->fetch_assoc();

$descripcionRiesgotrabajo = $row_riesgotrabajo['s_descripcion'];

?>

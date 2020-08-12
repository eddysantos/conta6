<?php


$query_datosEmpleado = "select * from conta_t_nom_empleados WHERE pk_id_empleado = $id_empleado";

$stmt_datosEmpleado = $db->prepare($query_datosEmpleado);
if (!($stmt_datosEmpleado)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
if (!($stmt_datosEmpleado->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_datosEmpleado->errno]: $stmt_datosEmpleado->error";
  exit_script($system_callback);
}


$rslt_datosEmpleado = $stmt_datosEmpleado->get_result();
$row_datosEmpleado = $rslt_datosEmpleado->fetch_assoc();

$PRESTAMOCTA = $row_datosEmpleado['s_prestamoCta'];

?>

<?php
$query_empleados = " SELECT *
                    FROM conta_t_nom_empleados
                    WHERE s_activo = 'S' and fk_id_regimen = '$regimenNomina' and fk_id_aduana = $aduana
                    ORDER BY s_nombre";

$stmt_empleados = $db->prepare($query_empleados);
if (!($stmt_empleados)) {
$system_callback['code'] = "500";
$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
exit_script($system_callback);
}



if (!($stmt_empleados->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_empleados->errno]: $stmt_empleados->error";
  exit_script($system_callback);
}

$rslt_empleados = $stmt_empleados->get_result();
$empleados = '';
while ($row_empleados = $rslt_empleados->fetch_assoc()) {
  $nombreEmpleado = $row_empleados['s_nombre'].' '.$row_empleados['s_apellidoP'].' '. $row_empleados['s_apellidoM'];
  $empleados .="<option value='$row_empleados[pk_id_empleado]'>$nombreEmpleado</option>";
}

 ?>

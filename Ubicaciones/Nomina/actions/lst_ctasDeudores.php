<?php

$system_callback = [];
$ctasDeudores ='';
$ctasDeudores .= "<option value='0' selected>Cuentas Deudores</option>";

$query = "SELECT * FROM conta_t_nom_empleados WHERE s_prestamoCta like '0115%'";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion de uery [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error en la ejecucion [$db->erro]: $db->error";
  exit_script($system_callback);
}

$result = $stmt->get_result();
if ($result->num_rows == 0) {
  $system_callback['code'] = 1;
  $ctasDeudores = "<option value='0' selected>No hay resultados</option>";
  $system_callback['message'] = "Llamada correcta pero no hay datos que mostrar";
  exit_script($system_callback);
}

while ($row =  $result->fetch_assoc()) {
  $s_nombre = $row['s_nombre'];
  $s_apellidoP = $row['s_apellidoP'];
  $s_apellidoM = $row['s_apellidoM'];
  $s_prestamoCta = $row['s_prestamoCta'];

  $ctasDeudores .= "<option value='$s_prestamoCta'>$s_nombre $s_apellidoP $s_apellidoM -- $s_prestamoCta</option>";
}

 ?>

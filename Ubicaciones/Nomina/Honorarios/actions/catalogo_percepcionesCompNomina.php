<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];

$query = "SELECT * FROM conta_cs_sat_tipopercepcion  ORDER BY pk_id_percepcion";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$rslt = $stmt->get_result();

if ($rslt->num_rows == 0) {
  $system_callback['code'] = 1;
  $system_callback['data'] ="<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $pk_id_percepcion = utf8_encode($row['pk_id_percepcion']);
  $s_descripcion = utf8_encode($row['s_descripcion']);
  $s_observaciones = utf8_encode($row['s_observaciones']);

  $system_callback['data'] .="<tr class='row text-left m-0 borderojo'>
    <td class='col-md-1 p-1'>$pk_id_percepcion</td>
    <td class='col-md-6 p-1'>$s_descripcion</td>
    <td class='col-md-5 p-1'>$s_observaciones</td>
  </tr>";

}



$querydeduccion = "SELECT * FROM conta_cs_sat_tipodeduccion  ORDER BY pk_id_deduccion";

$stmtdeduccion = $db->prepare($querydeduccion);
if (!($stmtdeduccion)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmtdeduccion->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion [$stmtdeduccion->errno]: $stmtdeduccion->error";
  exit_script($system_callback);
}

$rsltdeduccion = $stmtdeduccion->get_result();

if ($rsltdeduccion->num_rows == 0) {
  $system_callback['code'] = 1;
  $system_callback['data'] ="<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($rowdeduccion = $rsltdeduccion->fetch_assoc()) {
  $pk_id_deduccion = utf8_encode($rowdeduccion['pk_id_deduccion']);
  $s_descripcion = utf8_encode($rowdeduccion['s_descripcion']);
  $s_observaciones = utf8_encode($rowdeduccion['s_observaciones']);

  $system_callback['datadeducciones'] .="<tr class='row text-left m-0 borderojo align-items-center'>
    <td class='col-md-1 p-2'>$pk_id_deduccion</td>
    <td class='col-md-6 p-2'>$s_descripcion</td>
    <td class='col-md-5 p-2'>$s_observaciones</td>
  </tr>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

?>

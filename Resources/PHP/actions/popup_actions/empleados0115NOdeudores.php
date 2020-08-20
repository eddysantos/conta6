<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$data['string'];
$text = "%" . $data['string'] . "%";
$query = "SELECT *
          FROM conta_cs_empleados
          WHERE (s_rfc LIKE ? OR s_nombre LIKE ? OR s_apellidoP LIKE ? OR s_apellidoM LIKE ?)
                AND pk_id_empleado NOT IN(
                                        	SELECT s_cta_identificador
                                          FROM conta_cs_cuentas_mst
                                          where s_cta_identificador_tipo = 'empleado' AND pk_id_cuenta like '0115%')
          ORDER BY s_nombre ";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ssss', $text, $text, $text, $text);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
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
  $system_callback['data'] =
  "<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $system_callback['data'] .=
  "<p db-id='$row[pk_id_empleado]'>$row[pk_id_empleado] - $row[s_nombre] $row[s_apellidoP] $row[s_apellidoM] - $row[s_rfc] - $row[fk_id_aduana]</p>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


 ?>

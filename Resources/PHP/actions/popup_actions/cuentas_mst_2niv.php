<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;
$system_callback['data'] = '';

$data['string'];
$text = "%" . $data['string'] . "%";
$query = "SELECT * FROM conta_cs_cuentas_mst WHERE (pk_id_cuenta LIKE ? and s_cta_nivel = '2')  OR (s_cta_desc LIKE ? and s_cta_nivel = '2')";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss', $text, $text);
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
  $pk_id_cuenta = utf8_encode($row['pk_id_cuenta']);
  $s_cta_desc = utf8_encode($row['s_cta_desc']);

  $system_callback['data'] .=

  "<p db-id='$pk_id_cuenta'>$pk_id_cuenta - $s_cta_desc</p>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>

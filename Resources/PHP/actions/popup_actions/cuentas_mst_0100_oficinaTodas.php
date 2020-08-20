<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$data['string'];
$text = "%" . $data['string'] . "%";
$query = "SELECT pk_id_cuenta, s_cta_desc, fk_id_banco,s_ctaBancaria
		FROM conta_cs_cuentas_mst
		WHERE pk_id_cuenta LIKE '0100%' AND NOT pk_ID_CUENTA = '0100-00010' AND s_cta_nivel = 2 AND
		( pk_id_cuenta like ? OR s_cta_desc like ?)";

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
  $system_callback['data'] .=
  "<p db-id='$row[pk_id_cuenta]'>$row[pk_id_cuenta] - $row[s_cta_desc] - $rfcCIA - $row[fk_id_banco] - $row[s_ctaBancaria]</p>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>

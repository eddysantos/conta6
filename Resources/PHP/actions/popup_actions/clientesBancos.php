<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;
$system_callback['data'] = '';

$data['string'];
$text = "%" . $data['string'] . "%";
$query = "select pk_id_cliente, s_nombre, s_rfc, fk_id_banco, s_cta_banco,s_nomBanExt
          from conta_replica_clientes a, conta_cs_bancos_clientes b
          where a.pk_id_cliente = b.fk_id_cliente and (pk_id_cliente LIKE ? OR s_nombre LIKE ?)
          ORDER BY s_nombre ";

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
  "<p db-id='$row[pk_id_cliente]'>$row[pk_id_cliente] - $row[s_nombre] - $row[s_rfc] - $row[fk_id_banco] - $row[s_cta_banco] - $row[s_nomBanExt]</p>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


 ?>

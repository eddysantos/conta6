<?PHP
$query_CLT = "SELECT * FROM conta_replica_clientes WHERE s_rfc = ?";
$stmt_CLT = $db->prepare($query_CLT);
if (!($stmt_CLT)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare CLT [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_CLT->bind_param('s', $rfc);
if (!($stmt_CLT)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding CLT [$stmt_CLT->errno]: $stmt_CLT->error";
  exit_script($system_callback);
}
if (!($stmt_CLT->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution CLT [$stmt_CLT->errno]: $stmt_CLT->error";
  exit_script($system_callback);
}
$rslt_CLT = $stmt_CLT->get_result();
$rows_CLT = $rslt_CLT->num_rows;
if ($rows_CLT > 0) {
  $row_CLT = $rslt_CLT->fetch_assoc();
  $id_CLT = $row_CLT['pk_id_cliente'];
  $nom_CLT= trim($row_CLT['s_nombre']);
  $system_callback['code'] = "500";
  $system_callback['data'] = "El RFC pertenece a $id_CLT $nom_CLT";
  $system_callback['message'] = "Error RFC pertenece a $id_CLT $nom_CLT [$stmt_CLT->errno]: $stmt_CLT->error";
  exit_script($system_callback);
}

?>

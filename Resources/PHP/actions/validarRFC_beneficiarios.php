<?PHP
$query_BEN = "SELECT * FROM conta_cs_beneficiarios WHERE s_rfc = ?";
$stmt_BEN = $db->prepare($query_BEN);
if (!($stmt_BEN)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare BEN [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_BEN->bind_param('s', $rfc);
if (!($stmt_BEN)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding BEN [$stmt_BEN->errno]: $stmt_BEN->error";
  exit_script($system_callback);
}
if (!($stmt_BEN->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution BEN [$stmt_BEN->errno]: $stmt_BEN->error";
  exit_script($system_callback);
}
$rslt_BEN = $stmt_BEN->get_result();
$rows_BEN = $rslt_BEN->num_rows;
if ($rows_BEN > 0) {
  $row_BEN = $rslt_BEN->fetch_assoc();
  $id_BEN = $row_BEN['pk_id_benef'];
  $nom_BEN = trim($row_BEN['s_nombre']);
  $system_callback['code'] = "500";
  $system_callback['data'] = "El RFC existe más de una vez";
  $system_callback['message'] = "Error RFC pertenece a BEN $id_BEN $nom_BEN [$stmt_BEN->errno]: $stmt_BEN->error";
  //exit_script($system_callback);
}

?>

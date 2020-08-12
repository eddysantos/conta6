<?PHP
$query_PROV = "SELECT * FROM conta_cs_proveedores WHERE s_rfc = ?";
  $stmt_PROV = $db->prepare($query_PROV);
  if (!($stmt_PROV)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare PROV [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_PROV->bind_param('s', $rfc);
  if (!($stmt_PROV)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding PROV [$stmt_PROV->errno]: $stmt_PROV->error";
    exit_script($system_callback);
  }
  if (!($stmt_PROV->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution PROV [$stmt_PROV->errno]: $stmt_PROV->error";
    exit_script($system_callback);
  }
  $rslt_PROV = $stmt_PROV->get_result();
  $rows_PROV = $rslt_PROV->num_rows;
  if ($rows_PROV > 0) {
    $row_PROV = $rslt_PROV->fetch_assoc();
    $id_PROV = $row_PROV['pk_id_proveedor'];
    $nom_PROV = trim($row_PROV['s_nombre']);
    $system_callback['code'] = "500";
    $system_callback['data'] = "El RFC pertenece a PROV $id_PROV $nom_PROV";
    $system_callback['message'] = "Error RFC pertenece a PROV $id_PROV $nom_PROV [$stmt_PROV->errno]: $stmt_PROV->error";
    exit_script($system_callback);
  }

?>

<?PHP
  $query_datosCLT = "SELECT * FROM conta_replica_clientes WHERE pk_id_cliente = ?";
  $stmt_datosCLT = $db->prepare($query_datosCLT);
  if (!($stmt_datosCLT)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_datosCLT->bind_param('s',$id_cliente);
  if (!($stmt_datosCLT)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_datosCLT->errno]: $stmt_datosCLT->error";
    exit_script($system_callback);
  }
  if (!($stmt_datosCLT->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_datosCLT->errno]: $stmt_datosCLT->error";
    exit_script($system_callback);
  }
  $rslt_datosCLT = $stmt_datosCLT->get_result();
  $rows_datosCLT = $rslt_datosCLT->num_rows;
  if( $rows_datosCLT > 0 ){
    $row_datosCLT = $rslt_datosCLT->fetch_assoc();
    $rfcOri = trim($row_datosCLT["s_rfc"]);
    $benefOri = trim($row_datosCLT["s_nombre"]);
    $nom_cliente = $row_datosCLT['s_nombre'];
    $id_corresponsal = $row_datosCLT['fk_id_corresp'];
    $s_status = $row_datosCLT['s_status'];
  }

?>
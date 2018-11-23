<?PHP
  $query_solAntCaptRef = "SELECT * from conta_t_proforma Where fk_referencia = ?";
  $stmt_solAntCaptRef = $db->prepare($query_solAntCaptRef);
  if (!($stmt_solAntCaptRef)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare solAntCaptRef [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_solAntCaptRef->bind_param('s',$id_referencia);
  if (!($stmt_solAntCaptRef)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding solAntCaptRef [$stmt_solAntCaptRef->errno]: $stmt_solAntCaptRef->error";
    exit_script($system_callback);
  }
  if (!($stmt_solAntCaptRef->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution solAntCaptRef [$stmt_solAntCaptRef->errno]: $stmt_solAntCaptRef->error";
    exit_script($system_callback);
  }
  $rslt_solAntCaptRef = $stmt_solAntCaptRef->get_result();
  $rows_solAntCaptRef = $rslt_solAntCaptRef->num_rows;

  if( $rows_solAntCaptRef > 0 ){
    $row_solAntCaptRef = $rslt_solAntCaptRef->fetch_assoc();


  }

?>

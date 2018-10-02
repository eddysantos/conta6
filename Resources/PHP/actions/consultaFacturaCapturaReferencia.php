<?PHP
  $query_facCaptRef = "SELECT * from conta_t_facturas_captura Where fk_referencia = ?";
  $stmt_facCaptRef = $db->prepare($query_facCaptRef);
  if (!($stmt_facCaptRef)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_facCaptRef->bind_param('s',$id_referencia);
  if (!($stmt_facCaptRef)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_facCaptRef->errno]: $stmt_facCaptRef->error";
    exit_script($system_callback);
  }
  if (!($stmt_facCaptRef->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_facCaptRef->errno]: $stmt_facCaptRef->error";
    exit_script($system_callback);
  }
  $rslt_facCaptRef = $stmt_facCaptRef->get_result();
  $rows_facCaptRef = $rslt_facCaptRef->num_rows;

  if( $rows_facCaptRef > 0 ){
    $row_facCaptRef = $rslt_facCaptRef->fetch_assoc();

    
  }

?>

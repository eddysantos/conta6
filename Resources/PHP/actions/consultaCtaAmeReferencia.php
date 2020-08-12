<?PHP
  $query_ctaAmetRef = "SELECT * from contame_t_facturas Where fk_referencia = ?";
  $stmt_ctaAmetRef = $db->prepare($query_ctaAmetRef);
  if (!($stmt_ctaAmetRef)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_ctaAmetRef->bind_param('s',$id_referencia);
  if (!($stmt_ctaAmetRef)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding ctaAme [$stmt_ctaAmetRef->errno]: $stmt_ctaAmetRef->error";
    exit_script($system_callback);
  }
  if (!($stmt_ctaAmetRef->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution ctaAme [$stmt_ctaAmetRef->errno]: $stmt_ctaAmetRef->error";
    exit_script($system_callback);
  }
  $rslt_ctaAmetRef = $stmt_ctaAmetRef->get_result();
  $rows_ctaAmetRef = $rslt_ctaAmetRef->num_rows;

  if( $rows_ctaAmetRef > 0 ){
    $row_ctaAmetRef = $rslt_ctaAmetRef->fetch_assoc();


  }

?>

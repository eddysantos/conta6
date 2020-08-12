<?PHP
  $query_ncCaptTim = "select *
                      from conta_t_notacredito_captura a, conta_t_notacredito_cfdi b
                      where a.pk_id_cuenta_captura_nc = b.fk_id_cuenta_captura_nc and b.pk_id_notacredito = ?";

  $stmt_ncCaptTim = $db->prepare($query_ncCaptTim);
  if (!($stmt_ncCaptTim)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_ncCaptTim->bind_param('s',$notaCred);
  if (!($stmt_ncCaptTim)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_ncCaptTim->errno]: $stmt_ncCaptTim->error";
    exit_script($system_callback);
  }
  if (!($stmt_ncCaptTim->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_ncCaptTim->errno]: $stmt_ncCaptTim->error";
    exit_script($system_callback);
  }
  $rslt_ncCaptTim = $stmt_ncCaptTim->get_result();
  $rows_ncCaptTim = $rslt_ncCaptTim->num_rows;

  if( $rows_ncCaptTim > 0 ){
    $row_ncCaptTim = $rslt_ncCaptTim->fetch_assoc();


  }

?>

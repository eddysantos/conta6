<?PHP
  $query_ctaGastos = "SELECT * from conta_t_facturas_ctagastos Where fk_id_cuenta_captura = ?";
  $stmt_ctaGastos = $db->prepare($query_ctaGastos);
  if (!($stmt_ctaGastos)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare ctaGastos [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_ctaGastos->bind_param('s',$id_captura);
  if (!($stmt_ctaGastos)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding ctaGastos[$stmt_ctaGastos->errno]: $stmt_ctaGastos->error";
    exit_script($system_callback);
  }
  if (!($stmt_ctaGastos->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution ctaGastos[$stmt_ctaGastos->errno]: $stmt_ctaGastos->error";
    exit_script($system_callback);
  }
  $rslt_ctaGastos = $stmt_ctaGastos->get_result();
  $rows_ctaGastos = $rslt_ctaGastos->num_rows;

  if( $rows_ctaGastos > 0 ){
    while( $row_ctaGastos = $rslt_ctaGastos->fetch_assoc() ){
      $id_ctagastos = $row_ctaGastos['id_ctagastos'];
      $fecha_ctagastos = $row_ctaGastos['d_fecha_ctagastos'];
      $id_polctagastos = $row_ctaGastos['fk_idpol_ctagastos'];
      $cancela_ctagastos = $row_ctaGastos['s_cancela_ctagastos'];
      $id_polpagoaplic = $row_ctaGastos['fk_idpol_pagoaplicado'];
      $cancela_pagoaplicado = $row_ctaGastos['s_cancela_pagoaplicado'];
      $fecha_genera = $row_ctaGastos['d_fecha_genera'];
    }
  }

?>

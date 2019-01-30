<?PHP
  $query_pagoTimbrada = "SELECT * from conta_t_pagos_cfdi Where fk_id_pago_captura = ?";
  $stmt_pagoTimbrada = $db->prepare($query_pagoTimbrada);
  if (!($stmt_pagoTimbrada)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_pagoTimbrada->bind_param('s',$id_captura);
  if (!($stmt_pagoTimbrada)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_pagoTimbrada->errno]: $stmt_pagoTimbrada->error";
    exit_script($system_callback);
  }
  if (!($stmt_pagoTimbrada->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_pagoTimbrada->errno]: $stmt_pagoTimbrada->error";
    exit_script($system_callback);
  }
  $rslt_pagoTimbrada = $stmt_pagoTimbrada->get_result();
  $rows_pagoTimbrada = $rslt_pagoTimbrada->num_rows;

  if( $rows_pagoTimbrada > 0 ){
    while( $row_pagoTimbrada = $rslt_pagoTimbrada->fetch_assoc() ){
      $pk_id_pago = $row_pagoTimbrada['pk_id_pago'];
      $id_poliza = $row_pagoTimbrada['fk_id_poliza'];
      $s_UUID = $row_pagoTimbrada['s_UUID'];
      $usuario_timbra = $row_pagoTimbrada['fk_usuario_generaUUID'];
      $fechaTimbre = $row_pagoTimbrada['d_fechaTimbrado'];

      $s_cancela = $row_pagoTimbrada['s_cancela'];
      $fechaTimbreCancela = $row_pagoTimbrada['d_fechaTimbradoCancela'];
      $usuario_Cancela = $row_pagoTimbrada['fk_usuario_cancela'];
      $s_selloSATcancela = $row_pagoTimbrada['s_selloSATcancela'];
    }
  }

?>

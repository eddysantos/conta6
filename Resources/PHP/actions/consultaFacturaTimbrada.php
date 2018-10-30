<?PHP
  $query_facTimbrada = "SELECT * from conta_t_facturas_cfdi Where fk_id_cuenta_captura = ?";
  $stmt_facTimbrada = $db->prepare($query_facTimbrada);
  if (!($stmt_facTimbrada)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_facTimbrada->bind_param('s',$id_captura);
  if (!($stmt_facTimbrada)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_facTimbrada->errno]: $stmt_facTimbrada->error";
    exit_script($system_callback);
  }
  if (!($stmt_facTimbrada->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_facTimbrada->errno]: $stmt_facTimbrada->error";
    exit_script($system_callback);
  }
  $rslt_facTimbrada = $stmt_facTimbrada->get_result();
  $rows_facTimbrada = $rslt_facTimbrada->num_rows;

  if( $rows_facTimbrada > 0 ){
    while( $row_facTimbrada = $rslt_facTimbrada->fetch_assoc() ){
      $id_factura = $row_facTimbrada['pk_id_factura'];
      $id_poliza = $row_facTimbrada['fk_id_poliza'];
      $s_UUID = $row_facTimbrada['s_UUID'];
      $usuario_timbra = $row_facTimbrada['fk_usuario'];
      $fechaTimbre = $row_facTimbrada['d_fechaTimbrado'];

      $s_cancela_factura = $row_facTimbrada['s_cancela_factura'];
      $fechaTimbreCancela = $row_facTimbrada['d_fechaTimbradoCancela'];
      $usuario_Cancela = $row_facTimbrada['s_usuario_cancela'];
      $s_selloSATcancela = $row_facTimbrada['s_selloSATcancela'];
    }
  }

?>

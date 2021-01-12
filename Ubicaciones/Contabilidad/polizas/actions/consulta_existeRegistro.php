<?PHP
#consulta para revisar que en la misma poliza no exista otro registro igual
  $query_polCapt = "SELECT *
                    FROM conta_t_polizas_det
                    WHERE fk_id_poliza = ? and
                          fk_id_cuenta = ? and s_desc = ? and
                          n_cargo = ? and n_abono = ? ";

                          // and fk_referencia = ? and
                          // fk_id_cliente = ? and s_folioCFDIext = ? and
                          // fk_factura = ? and fk_anticipo = ? and
                          // fk_cheque = ?

  $stmt_polCapt = $db->prepare($query_polCapt);
  if (!($stmt_polCapt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare polCapt [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  #$stmt_polCapt->bind_param('sssssssssss',$id_poliza,$cuenta,$id_referencia,$id_cliente,$documento,$factura,$anticipo,$cheque,$desc,$cargo,$abono);
  $stmt_polCapt->bind_param('sssss',$id_poliza,$cuenta,$desc,$cargo,$abono);
  if (!($stmt_polCapt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding polCapt [$stmt_polCapt->errno]: $stmt_polCapt->error";
    exit_script($system_callback);
  }
  if (!($stmt_polCapt->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution polCapt [$stmt_polCapt->errno]: $stmt_polCapt->error";
    exit_script($system_callback);
  }
  $rslt_polCapt = $stmt_polCapt->get_result();
  $rows_polCapt = $rslt_polCapt->num_rows;

  // if( $rows_polCapt > 0 ){
  //   $row_polCapt = $rslt_polCapt->fetch_assoc();
  // }

?>

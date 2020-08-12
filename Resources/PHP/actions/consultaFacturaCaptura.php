<?PHP
  $query_facCapt = "SELECT *
                    FROM conta_t_facturas_cfdi
                    INNER JOIN conta_t_facturas_captura
                    ON fk_id_cuenta_captura  = pk_id_cuenta_captura
                    WHERE pk_id_factura = ?";

  $stmt_facCapt = $db->prepare($query_facCapt);
  if (!($stmt_facCapt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare facCapt [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_facCapt->bind_param('s',$factura);
  if (!($stmt_facCapt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding facCapt [$stmt_facCapt->errno]: $stmt_facCapt->error";
    exit_script($system_callback);
  }
  if (!($stmt_facCapt->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution facCapt [$stmt_facCapt->errno]: $stmt_facCapt->error";
    exit_script($system_callback);
  }
  $rslt_facCapt = $stmt_facCapt->get_result();
  $rows_facCapt = $rslt_facCapt->num_rows;

  if( $rows_facCapt > 0 ){
    $row_facCapt = $rslt_facCapt->fetch_assoc();
  }

?>

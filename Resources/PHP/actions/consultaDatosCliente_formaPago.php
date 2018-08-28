<?PHP
  $query_datosCLTformaPago = "select * from conta_cs_formapago_clientes where  fk_id_cliente = ?";
  $stmt_datosCLTformaPago = $db->prepare($query_datosCLTformaPago);
  if (!($stmt_datosCLTformaPago)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_datosCLTformaPago->bind_param('s',$id_cliente);
  if (!($stmt_datosCLTformaPago)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_datosCLTformaPago->errno]: $stmt_datosCLTformaPago->error";
    exit_script($system_callback);
  }
  if (!($stmt_datosCLTformaPago->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_datosCLTformaPago->errno]: $stmt_datosCLTformaPago->error";
    exit_script($system_callback);
  }
  $rslt_datosCLTformaPago = $stmt_datosCLTformaPago->get_result();
  $rows_datosCLTformaPago = $rslt_datosCLTformaPago->num_rows;

  // if( $rows_datosCLTformaPago > 0 ){
  //   $row_datosCLTformaPago = $rslt_datosCLTformaPago->fetch_assoc();
  //
  //   $nom_almacen = $row_datosCLTformaPago['s_almacen'];
  // }

?>

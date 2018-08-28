<?PHP
  $query_datosIVA = "SELECT * FROM conta_cs_sat_iva WHERE s_status = 1 AND fk_id_aduana = ?";
  $stmt_datosIVA = $db->prepare($query_datosIVA);
  if (!($stmt_datosIVA)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_datosIVA->bind_param('s',$aduana);
  if (!($stmt_datosIVA)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_datosIVA->errno]: $stmt_datosIVA->error";
    exit_script($system_callback);
  }
  if (!($stmt_datosIVA->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_datosIVA->errno]: $stmt_datosIVA->error";
    exit_script($system_callback);
  }
  $rslt_datosIVA = $stmt_datosIVA->get_result();
  $rows_datosIVA = $rslt_datosIVA->num_rows;

  if( $rows_datosIVA > 0 ){
    $row_datosIVA = $rslt_datosIVA->fetch_assoc();

  }

?>

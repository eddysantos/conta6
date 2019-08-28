<?PHP
  $query_datosPROV = "SELECT * from conta_cs_proveedores Where pk_id_proveedor = ?";
  $stmt_datosPROV = $db->prepare($query_datosPROV);
  if (!($stmt_datosPROV)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_datosPROV->bind_param('s',$idProveedor);
  if (!($stmt_datosPROV)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_datosPROV->errno]: $stmt_datosPROV->error";
    exit_script($system_callback);
  }
  if (!($stmt_datosPROV->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_datosPROV->errno]: $stmt_datosPROV->error";
    exit_script($system_callback);
  }
  $rslt_datosPROV = $stmt_datosPROV->get_result();
  $rows_datosPROV = $rslt_datosPROV->num_rows;

  if( $rows_datosPROV > 0 ){
    $row_datosPROV = $rslt_datosPROV->fetch_assoc();

    $nom_proveedor = $row_datosPROV['s_nombre'];
  }

?>

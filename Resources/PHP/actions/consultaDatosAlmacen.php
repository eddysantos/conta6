<?PHP
  $query_datosAlmacen = "SELECT * from conta_t_almacenes Where pk_id_almacen = ?";
  $stmt_datosAlmacen = $db->prepare($query_datosAlmacen);
  if (!($stmt_datosAlmacen)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_datosAlmacen->bind_param('s',$id_almacen);
  if (!($stmt_datosAlmacen)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_datosAlmacen->errno]: $stmt_datosAlmacen->error";
    exit_script($system_callback);
  }
  if (!($stmt_datosAlmacen->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_datosAlmacen->errno]: $stmt_datosAlmacen->error";
    exit_script($system_callback);
  }
  $rslt_datosAlmacen = $stmt_datosAlmacen->get_result();
  $rows_datosAlmacen = $rslt_datosAlmacen->num_rows;

  if( $rows_datosAlmacen > 0 ){
    $row_datosAlmacen = $rslt_datosAlmacen->fetch_assoc();

    $nom_almacen = $row_datosAlmacen['s_almacen'];
  }

?>

<?PHP
  $query_datosCorresp = "SELECT * FROM conta_t_corresponsales WHERE pk_id_corresp = ?";
  $stmt_datosCorresp = $db->prepare($query_datosCorresp);
  if (!($stmt_datosCorresp)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_datosCorresp->bind_param('s',$id_corresponsal);
  if (!($stmt_datosCorresp)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_datosCorresp->errno]: $stmt_datosCorresp->error";
    exit_script($system_callback);
  }
  if (!($stmt_datosCorresp->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_datosCorresp->errno]: $stmt_datosCorresp->error";
    exit_script($system_callback);
  }
  $rslt_datosCorresp = $stmt_datosCorresp->get_result();
  $rows_datosCorresp = $rslt_datosCorresp->num_rows;
  if( $rows_datosCorresp > 0 ){
    $row_datosCorresp = $rslt_datosCorresp->fetch_assoc();
    $nom_corresp = $row_datosCorresp['s_nombre'];
    $id_corresponsal = $row_datosCorresp['pk_id_corresp'];
    $idcliente_corresp = $row_datosCorresp['fk_id_cliente'];
  }

?>

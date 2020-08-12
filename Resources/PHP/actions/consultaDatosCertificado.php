<?PHP
  $query_datosCert = "SELECT * FROM conta_t_oficinas_certificados where d_valido_inicio <= NOW() and d_valido_final >= NOW() AND s_status = 1";
  $stmt_datosCert = $db->prepare($query_datosCert);
  if (!($stmt_datosCert)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt_datosCert->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_datosCert->errno]: $stmt_datosCert->error";
    exit_script($system_callback);
  }
  $rslt_datosCert = $stmt_datosCert->get_result();
  $total_datosCert = $rslt_datosCert->num_rows;

  if( $total_datosCert > 0 ){
    $row_datosCert = $rslt_datosCert->fetch_assoc();

  }




?>

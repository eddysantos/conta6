<?PHP
  $query_consultaMoneda = "SELECT * FROM conta_cs_sat_monedas where s_activo = 'S'";
  $stmt_consultaMoneda = $db->prepare($query_consultaMoneda);
  if (!($stmt_consultaMoneda)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaMoneda->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaMoneda->errno]: $stmt_consultaMoneda->error";
    exit_script($system_callback);
  }
  $rslt_consultaMoneda = $stmt_consultaMoneda->get_result();
  $rows_consultaMoneda = $rslt_consultaMoneda->num_rows;

  if ($rows_consultaMoneda > 0) {
      $consultaMoneda = "<option selected value='MXN'>Moneda</option>";
      while ($row_consultaMoneda = $rslt_consultaMoneda->fetch_assoc()) {
        $id_moneda = $row_consultaMoneda['pk_id_moneda'];
        $moneda = utf8_encode($row_consultaMoneda['s_moneda']);
        $consultaMoneda .= '<option value="'.$id_moneda.'">'.$moneda.' --- '.$id_moneda.'</option>';
      }
  }

  /*
  <select id=" ">
      <?php echo $consultaMoneda; ?>
  </select>
  */

?>

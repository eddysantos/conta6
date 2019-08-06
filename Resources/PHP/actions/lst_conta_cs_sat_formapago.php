<?PHP
  $query_consultaFormapago = "SELECT * FROM conta_cs_sat_formapago WHERE s_concepto <> 'Cheque' AND s_concepto <> 'Transferencia' ORDER BY s_concepto";
  $stmt_consultaFormapago = $db->prepare($query_consultaFormapago);
  if (!($stmt_consultaFormapago)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaFormapago->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaFormapago->errno]: $stmt_consultaFormapago->error";
    exit_script($system_callback);
  }
  $rslt_consultaFormapago = $stmt_consultaFormapago->get_result();
  $rows_consultaFormapago = $rslt_consultaFormapago->num_rows;

  if ($rows_consultaFormapago > 0) {
      $consultaFormapago = "<option selected value=''>Forma de pago</option>";
      while ($row_consultaFormapago = $rslt_consultaFormapago->fetch_assoc()) {
        $id_Formapago = $row_consultaFormapago['pk_id_formapago'];
        $concepto = utf8_encode($row_consultaFormapago['s_concepto']);
        $consultaFormapago .= '<option value="'.$id_Formapago.'">'.$concepto.' --- '.$id_Formapago.'</option>';
      }
  }

  /*
  <select id=" ">
      <?php echo $consultaFormapago; ?>
  </select>
  */

?>

<?PHP
  $query_consultaUsoCFDIfac = "SELECT * FROM conta_cs_sat_usocfdi where s_actFacturar = 'S'";
  $stmt_consultaUsoCFDIfac = $db->prepare($query_consultaUsoCFDIfac);
  if (!($stmt_consultaUsoCFDIfac)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaUsoCFDIfac->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaUsoCFDIfac->errno]: $stmt_consultaUsoCFDIfac->error";
    exit_script($system_callback);
  }
  $rslt_consultaUsoCFDIfac = $stmt_consultaUsoCFDIfac->get_result();
  $rows_consultaUsoCFDIfac = $rslt_consultaUsoCFDIfac->num_rows;

  if ($rows_consultaUsoCFDIfac > 0) {
      $consultaUsoCFDIfac = "<option selected value='0'>Uso CDFI</option>";
      while ($row_consultaUsoCFDIfac = $rslt_consultaUsoCFDIfac->fetch_assoc()) {
        $c_UsoCFDI = $row_consultaUsoCFDIfac['pk_c_UsoCFDI'];
        $descripcion = utf8_encode($row_consultaUsoCFDIfac['s_descripcion']);
        $consultaUsoCFDIfac .= '<option value="'.$c_UsoCFDI.'">'.$descripcion.' --- '.$c_UsoCFDI.'</option>';
      }
  }
  $c_UsoCFDI = $oRst_usoCFDI['c_UsoCFDI'];
  						$descripcion = $oRst_usoCFDI['descripcion'];
  /*
  <select id=" ">
      <?php echo $consultaUsoCFDIfac; ?>
  </select>
  */

?>

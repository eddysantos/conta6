<?PHP
  $query_consultaDeduc_penAlim = "SELECT b.fk_id_deduccion, a.s_descripcion as desDeduccion,b.s_descripcion,b.n_ordenReporte,b.fk_id_cuenta
                              FROM conta_cs_sat_tipodeduccion a, conta_cs_sat_tipodeduccion_ctamst b
                              WHERE a.pk_id_deduccion = b.fk_id_deduccion and a.s_activo = 1 AND s_clasificacion = 'desctoDespTotal' AND fk_id_regimen = $id_regimen
                              ORDER BY b.s_descripcion";

  $stmt_consultaDeduc_penAlim = $db->prepare($query_consultaDeduc_penAlim);
  if (!($stmt_consultaDeduc_penAlim)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaDeduc_penAlim->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaDeduc_penAlim->errno]: $stmt_consultaDeduc_penAlim->error";
    exit_script($system_callback);
  }
  $rslt_consultaDeduc_penAlim = $stmt_consultaDeduc_penAlim->get_result();
  $rows_consultaDeduc_penAlim = $rslt_consultaDeduc_penAlim->num_rows;

  if ($rows_consultaDeduc_penAlim > 0) {
      $consultaDeduc_penAlim = "<option selected value='0'>Concepto</option>";
      while ($row_consultaDeduc_penAlim = $rslt_consultaDeduc_penAlim->fetch_assoc()) {
        $idDeduc_penAlim = $row_consultaDeduc_penAlim['fk_id_deduccion'];
        $ctaDeduc_penAlim = $row_consultaDeduc_penAlim['fk_id_cuenta'];
        $descDeduc_penAlim = utf8_encode($row_consultaDeduc_penAlim['s_descripcion']);
        $ordenRepDeduc_penAlim = $row_consultaDeduc_penAlim['n_ordenReporte'];

        $consultaDeduc_penAlim .= '<option value="'.$idDeduc_penAlim.'+'.$ctaDeduc_penAlim.'+'.$descDeduc_penAlim.'+'.$ordenRepDeduc_penAlim.'">'.htmlentities($descDeduc_penAlim).' --- '.$idDeduc_penAlim.' --- '.$ctaDeduc_penAlim.'</option>';
      }
  }

?>

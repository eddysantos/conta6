<?PHP
  $query_consultaDeducConcep = "SELECT b.fk_id_deduccion, a.s_descripcion as desDeduccion,b.s_descripcion,b.n_ordenReporte,
                              			 CASE WHEN b.fk_id_cuenta = '0115-00001' THEN '$PRESTAMOCTA' else b.fk_id_cuenta END AS id_cuenta
                              FROM conta_cs_sat_tipodeduccion a, conta_cs_nom_tipodeduccion_ctamst b
                              WHERE a.pk_id_deduccion = b.fk_id_deduccion and a.s_activo = 1 AND s_clasificacion = 'deduccion' AND fk_id_regimen = $id_regimen
                              ORDER BY b.s_descripcion";

  $stmt_consultaDeducConcep = $db->prepare($query_consultaDeducConcep);
  if (!($stmt_consultaDeducConcep)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaDeducConcep->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaDeducConcep->errno]: $stmt_consultaDeducConcep->error";
    exit_script($system_callback);
  }
  $rslt_consultaDeducConcep = $stmt_consultaDeducConcep->get_result();
  $rows_consultaDeducConcep = $rslt_consultaDeducConcep->num_rows;

  if ($rows_consultaDeducConcep > 0) {
      $consultaDeducConcep = "<option selected value='0'>Concepto</option>";
      while ($row_consultaDeducConcep = $rslt_consultaDeducConcep->fetch_assoc()) {
        $idDeduc = $row_consultaDeducConcep['fk_id_deduccion'];
        $ctaDeduc = $row_consultaDeducConcep['id_cuenta'];
        $descDeduc = utf8_encode($row_consultaDeducConcep['s_descripcion']);
        $ordenRepDeduc = $row_consultaDeducConcep['n_ordenReporte'];

        $consultaDeducConcep .= '<option value="'.$idDeduc.'+'.$ctaDeduc.'+'.$descDeduc.'+'.$ordenRepDeduc.'">'.htmlentities($descDeduc).' --- '.$idDeduc.' --- '.$ctaDeduc.'</option>';
      }
  }

?>

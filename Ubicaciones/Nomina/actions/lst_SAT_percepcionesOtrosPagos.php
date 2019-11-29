<?PHP
  $query_consultaPercepConcepOP = "SELECT b.fk_id_otroPago, a.s_descripcion as desPercepcion,b.fk_id_cuenta,b.s_descripcion,b.n_ordenReporte
                              FROM conta_cs_sat_tipootropago a, conta_cs_sat_tipootropago_ctamst b
                              WHERE a.pk_id_otroPago = b.fk_id_otroPago AND s_clasificacion = 'otrosPagos' AND fk_id_regimen = $id_regimen
                              ORDER BY b.s_descripcion";

  $stmt_consultaPercepConcepOP = $db->prepare($query_consultaPercepConcepOP);
  if (!($stmt_consultaPercepConcepOP)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaPercepConcepOP->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaPercepConcepOP->errno]: $stmt_consultaPercepConcepOP->error";
    exit_script($system_callback);
  }
  $rslt_consultaPercepConcepOP = $stmt_consultaPercepConcepOP->get_result();
  $rows_consultaPercepConcepOP = $rslt_consultaPercepConcepOP->num_rows;

  if ($rows_consultaPercepConcepOP > 0) {
      $consultaPercepConcepOP = "<option selected value='0'>Concepto</option>";
      while ($row_consultaPercepConcepOP = $rslt_consultaPercepConcepOP->fetch_assoc()) {
        $idPercepOP = $row_consultaPercepConcepOP['fk_id_otroPago'];
        $ctaPercepOP = $row_consultaPercepConcepOP['fk_id_cuenta'];
        $descPOP = utf8_encode($row_consultaPercepConcepOP['s_descripcion']);
        $ordenRepPercepOP = $row_consultaPercepConcepOP['n_ordenReporte'];

        $consultaPercepConcepOP .= '<option value="'.$idPercepOP.'+'.$ctaPercepOP.'+'.$descPOP.'+'.$ordenRepPercepOP.'">'.htmlentities($descPOP).' --- '.$idPercepOP.' --- '.$ctaPercepOP.'</option>';
      }
  }

?>

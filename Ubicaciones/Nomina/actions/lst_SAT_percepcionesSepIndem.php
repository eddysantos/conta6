<?PHP
  $query_consultaPercepConcepINDEM = "SELECT b.fk_id_percepcion, a.s_descripcion as desPercepcion,b.s_descripcion,b.n_ordenReporte,b.fk_id_cuenta
                              FROM conta_cs_sat_tipopercepcion a, conta_cs_sat_tipopercepcion_ctamst b
                              WHERE a.pk_id_percepcion = b.fk_id_percepcion and a.s_activo = 1 AND s_clasificacion = 'separacionIndemnizacion' AND fk_id_regimen = $id_regimen
                              ORDER BY b.s_descripcion";

  $stmt_consultaPercepConcepINDEM = $db->prepare($query_consultaPercepConcepINDEM);
  if (!($stmt_consultaPercepConcepINDEM)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaPercepConcepINDEM->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaPercepConcepINDEM->errno]: $stmt_consultaPercepConcepINDEM->error";
    exit_script($system_callback);
  }
  $rslt_consultaPercepConcepINDEM = $stmt_consultaPercepConcepINDEM->get_result();
  $rows_consultaPercepConcepINDEM = $rslt_consultaPercepConcepINDEM->num_rows;

  if ($rows_consultaPercepConcepINDEM > 0) {
      $consultaPercepConcepINDEM = "<option selected value='0'>Concepto</option>";
      while ($row_consultaPercepConcepINDEM = $rslt_consultaPercepConcepINDEM->fetch_assoc()) {
        $idPercepINDEM = $row_consultaPercepConcepINDEM['fk_id_percepcion'];
        $ctaPercepINDEM = $row_consultaPercepConcepINDEM['fk_id_cuenta'];
        $descPINDEM = utf8_encode($row_consultaPercepConcepINDEM['s_descripcion']);
        $ordenRepPercepINDEM = $row_consultaPercepConcepINDEM['n_ordenReporte'];

        $consultaPercepConcepINDEM .= '<option value="'.$idPercepINDEM.'+'.$ctaPercepINDEM.'+'.$descPINDEM.'+'.$ordenRepPercepINDEM.'">'.htmlentities($descPINDEM).' --- '.$idPercepINDEM.' --- '.$ctaPercepINDEM.'</option>';
      }
  }

?>

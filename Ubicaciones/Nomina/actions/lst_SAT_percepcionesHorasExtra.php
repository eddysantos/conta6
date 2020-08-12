<?PHP
  $query_consultaPercepConcepHrExtra = "SELECT b.fk_id_percepcion, a.s_descripcion as desPercepcion,b.s_descripcion,b.n_ordenReporte,b.fk_id_cuenta
                              FROM conta_cs_sat_tipopercepcion a, conta_cs_sat_tipopercepcion_ctamst b
                              WHERE a.pk_id_percepcion = b.fk_id_percepcion and a.s_activo = 1 AND s_clasificacion = 'horasExtras' AND fk_id_regimen = $id_regimen
                              ORDER BY b.s_descripcion";

  $stmt_consultaPercepConcepHrExtra = $db->prepare($query_consultaPercepConcepHrExtra);
  if (!($stmt_consultaPercepConcepHrExtra)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaPercepConcepHrExtra->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaPercepConcepHrExtra->errno]: $stmt_consultaPercepConcepHrExtra->error";
    exit_script($system_callback);
  }
  $rslt_consultaPercepConcepHrExtra = $stmt_consultaPercepConcepHrExtra->get_result();
  $rows_consultaPercepConcepHrExtra = $rslt_consultaPercepConcepHrExtra->num_rows;

  if ($rows_consultaPercepConcepHrExtra > 0) {
      $consultaPercepConcepHrExtra = "<option selected value='0'>Concepto</option>";
      while ($row_consultaPercepConcepHrExtra = $rslt_consultaPercepConcepHrExtra->fetch_assoc()) {
        $idPercepHrExtra = $row_consultaPercepConcepHrExtra['fk_id_percepcion'];
        $ctaPercepHrExtra = $row_consultaPercepConcepHrExtra['fk_id_cuenta'];
        $descPHrExtra = utf8_encode($row_consultaPercepConcepHrExtra['s_descripcion']);
        $ordenRepPercepHrExtra = $row_consultaPercepConcepHrExtra['n_ordenReporte'];

        $consultaPercepConcepHrExtra .= '<option value="'.$idPercepHrExtra.'+'.$ctaPercepHrExtra.'+'.$descPHrExtra.'+'.$ordenRepPercepHrExtra.'">'.htmlentities($descPHrExtra).' --- '.$idPercepHrExtra.' --- '.$ctaPercepHrExtra.'</option>';
      }
  }

?>

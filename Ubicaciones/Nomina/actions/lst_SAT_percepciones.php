<?PHP
  $query_consultaPercepConcep = "SELECT b.fk_id_percepcion, a.s_descripcion as desPercepcion,b.s_descripcion,b.n_ordenReporte,
                              			 CASE WHEN b.fk_id_cuenta = '0115-00001' THEN '$PRESTAMOCTA' else b.fk_id_cuenta END AS id_cuenta
                              FROM conta_cs_sat_tipopercepcion a, conta_cs_nom_tipopercepcion_ctamst b
                              WHERE a.pk_id_percepcion = b.fk_id_percepcion and a.s_activo = 1 AND s_clasificacion = 'percepcion' AND fk_id_regimen = $id_regimen
                              ORDER BY b.s_descripcion";

  $stmt_consultaPercepConcep = $db->prepare($query_consultaPercepConcep);
  if (!($stmt_consultaPercepConcep)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaPercepConcep->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaPercepConcep->errno]: $stmt_consultaPercepConcep->error";
    exit_script($system_callback);
  }
  $rslt_consultaPercepConcep = $stmt_consultaPercepConcep->get_result();
  $rows_consultaPercepConcep = $rslt_consultaPercepConcep->num_rows;

  if ($rows_consultaPercepConcep > 0) {
      $consultaPercepConcep = "<option selected value='0'>Concepto</option>";
      while ($row_consultaPercepConcep = $rslt_consultaPercepConcep->fetch_assoc()) {
        $idPercep = $row_consultaPercepConcep['fk_id_percepcion'];
        $ctaPercep = $row_consultaPercepConcep['id_cuenta'];
        $descP = utf8_encode($row_consultaPercepConcep['s_descripcion']);
        $ordenRepPercep = $row_consultaPercepConcep['n_ordenReporte'];

        $consultaPercepConcep .= '<option value="'.$idPercep.'+'.$ctaPercep.'+'.$descP.'+'.$ordenRepPercep.'">'.htmlentities($descP).' --- '.$idPercep.' --- '.$ctaPercep.'</option>';
      }
  }

?>

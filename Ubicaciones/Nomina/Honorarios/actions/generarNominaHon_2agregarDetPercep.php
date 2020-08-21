<?php

$query_consultaPercep = "SELECT fk_id_percepcion, fk_id_cuenta, s_descripcion, n_ordenReporte, s_clasificacion
                         FROM conta_cs_sat_tipopercepcion_ctamst WHERE fk_id_regimen = ? ORDER BY n_ordenReporte";

$stmt_consultaPercep = $db->prepare($query_consultaPercep);
if (!($stmt_consultaPercep)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare consultaPercep [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_consultaPercep->bind_param('s',$id_regimen);

if (!($stmt_consultaPercep)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding consultaPercep [$stmt_consultaPercep->errno]: $stmt_consultaPercep->error";
  exit_script($system_callback);
}

if (!($stmt_consultaPercep->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution consultaPercep [$stmt_consultaPercep->errno]: $stmt_consultaPercep->error";
  exit_script($system_callback);
}

$rslt_consultaPercep = $stmt_consultaPercep->get_result();

if ($rslt_consultaPercep->num_rows == 0) {
  $system_callback['code'] = 1;
  $system_callback['data'] =
  "<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

if ($rslt_consultaPercep->num_rows > 0) {
  while ($row_consultaPercep = $rslt_consultaPercep->fetch_assoc()) {
    $ID_percepcion = $row_consultaPercep['fk_id_percepcion'];
    $id_cuentaP = $row_consultaPercep['fk_id_cuenta'];
    $descripcionP = $row_consultaPercep['s_descripcion'];
    $ordenReporteP = $row_consultaPercep['n_ordenReporte'];
    $clasificacionP = $row_consultaPercep['s_clasificacion'];
    $tipoElementoP = 'percepcion';

    if( $descripcionP == 'Honorarios Asimilables a Sueldos' and $SALARIO_SEMANAL > 0 ){

          $query_genPer = "INSERT INTO conta_t_nom_captura_det (
                                                                fk_id_docNomina,
                                                                s_tipoElemento,
                                                                fk_claveSAT,
                                                                fk_id_cuenta,
                                                                s_concepto,
                                                                n_importeGravado,
                                                                n_ordenReporte,
                                                                s_clasificacion )
                    VALUES (?,?,?,?,?,?,?,?)";

          $stmt_genPer = $db->prepare($query_genPer);
          if (!($stmt_genPer)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genPer->bind_param('ssssssss',
                                              $id_docNomina,
                                              $tipoElementoP,
                                              $ID_percepcion,
                                              $id_cuentaP,
                                              $descripcionP,
                                              $SALARIO_SEMANAL,
                                              $ordenReporteP,
                                              $clasificacionP );

          if (!($stmt_genPer)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
            exit_script($system_callback);
          }

          if (!($stmt_genPer->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
            exit_script($system_callback);
          }

    }

  }
}

?>

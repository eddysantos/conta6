<?php

$query_consultaDeduc = "SELECT fk_id_deduccion, fk_id_cuenta, s_descripcion, n_ordenReporte, s_clasificacion
                         FROM conta_cs_sat_tipodeduccion_ctamst WHERE fk_id_regimen = ? ORDER BY n_ordenReporte";

$stmt_consultaDeduc = $db->prepare($query_consultaDeduc);
if (!($stmt_consultaDeduc)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare consultaDeduc [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_consultaDeduc->bind_param('s',$id_regimen);

if (!($stmt_consultaDeduc)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding consultaDeduc [$stmt_consultaDeduc->errno]: $stmt_consultaDeduc->error";
  exit_script($system_callback);
}

if (!($stmt_consultaDeduc->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution consultaDeduc [$stmt_consultaDeduc->errno]: $stmt_consultaDeduc->error";
  exit_script($system_callback);
}

$rslt_consultaDeduc = $stmt_consultaDeduc->get_result();

if ($rslt_consultaDeduc->num_rows == 0) {
  $system_callback['code'] = 1;
  $system_callback['data'] =
  "<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

if ($rslt_consultaDeduc->num_rows > 0) {
  while ($row_consultaDeduc = $rslt_consultaDeduc->fetch_assoc()) {
    $ID_deduccion = $row_consultaDeduc['fk_id_deduccion'];
    $id_cuentaD = $row_consultaDeduc['fk_id_cuenta'];
    $descripcionD = $row_consultaDeduc['s_descripcion'];
    $ordenReporteD = $row_consultaDeduc['n_ordenReporte'];
    $clasificacionD = $row_consultaDeduc['s_clasificacion'];
    $tipoElementoD = 'deduccion';

    if( $descripcionD == 'ISR Hon Asimilables a Salarios' and $ISR > 0 ){

          $query_genDeduc = "INSERT INTO conta_t_nom_captura_det (
                                                                fk_id_docNomina,
                                                                s_tipoElemento,
                                                                fk_claveSAT,
                                                                fk_id_cuenta,
                                                                s_concepto,
                                                                n_importeExento,
                                                                n_ordenReporte,
                                                                s_clasificacion )
                    VALUES (?,?,?,?,?,?,?,?)";

          $stmt_genDeduc = $db->prepare($query_genDeduc);
          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genDeduc [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genDeduc->bind_param('ssssssss',
                                              $id_docNomina,
                                              $tipoElementoD,
                                              $ID_deduccion,
                                              $id_cuentaD,
                                              $descripcionD,
                                              $ISR,
                                              $ordenReporteD,
                                              $clasificacionD );

          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }

          if (!($stmt_genDeduc->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }

    }

  }
}

?>

<?php
$totalOtrosPagos = 0;

$query_otrosPagos = "SELECT fk_id_otroPago, fk_id_cuenta, s_descripcion, n_ordenReporte, s_clasificacion
                         FROM conta_cs_nom_tipootropago_ctamst WHERE fk_id_regimen = ? ORDER BY n_ordenReporte";


$stmt_otrosPagos = $db->prepare($query_otrosPagos);
if (!($stmt_otrosPagos)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare otrosPagos [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_otrosPagos->bind_param('s',$id_regimen);

if (!($stmt_otrosPagos)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding otrosPagos [$stmt_otrosPagos->errno]: $stmt_otrosPagos->error";
  exit_script($system_callback);
}

if (!($stmt_otrosPagos->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution otrosPagos [$stmt_otrosPagos->errno]: $stmt_otrosPagos->error";
  exit_script($system_callback);
}

$rslt_otrosPagos = $stmt_otrosPagos->get_result();

if ($rslt_otrosPagos->num_rows > 0) {
  while ($row_otrosPagos = $rslt_otrosPagos->fetch_assoc()) {
    $id_otroPago = $row_otrosPagos['fk_id_otroPago'];
    $id_cuentaOP = $row_otrosPagos['fk_id_cuenta'];
    $descripcionOP = $row_otrosPagos['s_descripcion'];
    $ordenReporteOP = $row_otrosPagos['n_ordenReporte'];
    $clasificacionOP = $row_otrosPagos['s_clasificacion'];
    $tipoElementoOP = 'otrosPagos';

		if( $descripcionOP == 'Subsidio al Empleo' and $SUBSIDIO > 0 ){
          $totalOtrosPagos = $totalOtrosPagos + $SUBSIDIO;

          $query_genOP = "INSERT INTO conta_t_nom_captura_det (
                                                                fk_id_docNomina,
                                                                s_tipoElemento,
                                                                fk_claveSAT,
                                                                fk_id_cuenta,
                                                                s_concepto,
                                                                n_importeExento,
                                                                n_ordenReporte,
                                                                s_clasificacion )
                    VALUES (?,?,?,?,?,?,?,?)";

          $stmt_genOP = $db->prepare($query_genOP);
          if (!($stmt_genOP)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genOP [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genOP->bind_param('ssssssss',
                                              $id_docNomina,
                                              $tipoElementoOP,
                                              $id_otroPago,
                                              $id_cuentaOP,
                                              $descripcionOP,
                                              $SUBSIDIO,
                                              $ordenReporteOP,
                                              $clasificacionOP );

          if (!($stmt_genOP)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genOP [$stmt_genOP->errno]: $stmt_genOP->error";
            exit_script($system_callback);
          }

          if (!($stmt_genOP->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genOP [$stmt_genOP->errno]: $stmt_genOP->error";
            exit_script($system_callback);
          }

    }

  }
}

?>

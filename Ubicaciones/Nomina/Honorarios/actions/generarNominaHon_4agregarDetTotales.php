<?php
$id_cuentaT = '0213-00003';
$tipoElementoT = 'totales';

$query_genTotales = "INSERT INTO conta_t_nom_captura_det (
                                                        fk_id_docNomina,
                                                        s_tipoElemento,
                                                        fk_id_cuenta,
                                                        s_concepto,
                                                        n_dias_pagar,
                                                        n_totalPercepciones,
                                                        n_totalDeducciones,
                                                        n_total,
                                                        n_totalNeto )
          VALUES (?,?,?,?,?,?,?,?,?)";

$stmt_genTotales = $db->prepare($query_genTotales);
if (!($stmt_genTotales)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare genTotales [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_genTotales->bind_param('sssssssss',
                                    $id_docNomina,
                                    $tipoElementoT,
                                    $id_cuentaT,
                                    $tipoElementoT,
                                    $DIAS_PAGAR,
                                    $TOTAL_PERCEPCIONES,
                                    $TOTAL_DEDUCCIONES,
                                    $TOTAL,
                                    $TOTAL_NETO );

if (!($stmt_genTotales)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding genTotales [$stmt_genTotales->errno]: $stmt_genTotales->error";
  exit_script($system_callback);
}

if (!($stmt_genTotales->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution genTotales [$stmt_genTotales->errno]: $stmt_genTotales->error";
  exit_script($system_callback);
}



?>

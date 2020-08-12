<?php
  $query_capturaDeduccionesArray = "select fk_claveSAT, fk_id_cuenta, s_concepto, truncate(n_importeGravado,2) + truncate(n_importeExento,2) as importe
                                from conta_t_nom_captura_det
                                where fk_id_docNomina = ? and ( s_clasificacion = 'deduccion' or
                                                                s_clasificacion = 'desctoDespTotal' )
                                order by pk_id_partida";

$stmt_capturaDeduccionesArray = $db->prepare($query_capturaDeduccionesArray);
if (!($stmt_capturaDeduccionesArray)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_capturaDeduccionesArray->bind_param('s',$idDocNomina);
if (!($stmt_capturaDeduccionesArray)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_capturaDeduccionesArray->errno]: $stmt_capturaDeduccionesArray->error";
  exit_script($system_callback);
}

if (!($stmt_capturaDeduccionesArray->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_capturaDeduccionesArray->errno]: $stmt_capturaDeduccionesArray->error";
  exit_script($system_callback);
}

$rslt_capturaDeduccionesArray = $stmt_capturaDeduccionesArray->get_result();

$idFila = 0;
while ($row_capturaDeduccionesArray = $rslt_capturaDeduccionesArray->fetch_assoc()) {
  ++$idFila;
  $claveSATD = $row_capturaDeduccionesArray['fk_claveSAT'];
  $idcuentaD = $row_capturaDeduccionesArray['fk_id_cuenta'];
  $conceptoD = utf8_encode($row_capturaDeduccionesArray['s_concepto']);
  $importeD =$row_capturaDeduccionesArray['importe'];

  $array['Deduccion'][$idFila]['TipoDeduccion'] = $claveSATD;
  $array['Deduccion'][$idFila]['Clave'] = $idcuentaD;
  $array['Deduccion'][$idFila]['Concepto'] = $conceptoD;
  $array['Deduccion'][$idFila]['Importe'] = $importeD;
}

?>

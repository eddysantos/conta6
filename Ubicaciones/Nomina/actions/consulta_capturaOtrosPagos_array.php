<?php
  $query_capturaOtrosPagosArray = "select fk_claveSAT, fk_id_cuenta, s_concepto, truncate(n_importeGravado,2) + truncate(n_importeExento,2) as importe,s_anio, n_remanenteSalFav , n_subsidioCausado
                                from conta_t_nom_captura_det
                                where fk_id_docNomina = ? and s_tipoElemento = 'otrosPagos'
                                order by pk_id_partida";

$stmt_capturaOtrosPagosArray = $db->prepare($query_capturaOtrosPagosArray);
if (!($stmt_capturaOtrosPagosArray)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_capturaOtrosPagosArray->bind_param('s',$idDocNomina);
if (!($stmt_capturaOtrosPagosArray)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_capturaOtrosPagosArray->errno]: $stmt_capturaOtrosPagosArray->error";
  exit_script($system_callback);
}

if (!($stmt_capturaOtrosPagosArray->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_capturaOtrosPagosArray->errno]: $stmt_capturaOtrosPagosArray->error";
  exit_script($system_callback);
}

$rslt_capturaOtrosPagosArray = $stmt_capturaOtrosPagosArray->get_result();

$idFila = 0;
while ($row_capturaOtrosPagosArray = $rslt_capturaOtrosPagosArray->fetch_assoc()) {
  ++$idFila;
  $claveSATOP = $row_capturaOtrosPagosArray['fk_claveSAT'];
  $idcuentaOP = $row_capturaOtrosPagosArray['fk_id_cuenta'];
  $conceptoOP = utf8_encode($row_capturaOtrosPagosArray['s_concepto']);
  $importeOP = $row_capturaOtrosPagosArray['importe'];
  $anioOP = $row_capturaOtrosPagosArray['s_anio'];
  $remanenteOP = $row_capturaOtrosPagosArray['n_remanenteSalFav'];
  $subsidioCausadoOP = $row_capturaOtrosPagosArray['n_subsidioCausado'];

  $array['OtroPago'][$idFila]['TipoOtroPago'] = $claveSATOP;
  $array['OtroPago'][$idFila]['Clave'] = $idcuentaOP;
  $array['OtroPago'][$idFila]['Concepto'] = $conceptoOP;
  $array['OtroPago'][$idFila]['Importe'] = $importeOP;

  if( $claveSATOP == '2' ){
    $array['SubsidioAlEmpleo'][$idFila]['SubsidioCausado'] = $subsidioCausadoOP;
  }
  if( $claveSATOP == '4' ){
    $array['CompensacionSaldosAFavor'][$idFila]['SaldoAFavor'] = $importeOP;
    $array['CompensacionSaldosAFavor'][$idFila]['Año'] = $anioOP;
    $array['CompensacionSaldosAFavor'][$idFila]['RemanenteSalFav'] = $remanenteOP;
  }
}

?>

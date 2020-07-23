<?php
  $query_capturaPercepcionesArray = "select *
                                from conta_t_nom_captura_det
                                where fk_id_docNomina = ? and ( s_clasificacion = 'percepcion' or
                                                                s_clasificacion = 'horasExtras' or
                                                                s_clasificacion = 'separacionIndemnizacion' )
                                order by pk_id_partida";

$stmt_capturaPercepcionesArray = $db->prepare($query_capturaPercepcionesArray);
if (!($stmt_capturaPercepcionesArray)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_capturaPercepcionesArray->bind_param('s',$idDocNomina);
if (!($stmt_capturaPercepcionesArray)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_capturaPercepcionesArray->errno]: $stmt_capturaPercepcionesArray->error";
  exit_script($system_callback);
}

if (!($stmt_capturaPercepcionesArray->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_capturaPercepcionesArray->errno]: $stmt_capturaPercepcionesArray->error";
  exit_script($system_callback);
}

$rslt_capturaPercepcionesArray = $stmt_capturaPercepcionesArray->get_result();

$idFila = 0;
while ($row_capturaPercepcionesArray = $rslt_capturaPercepcionesArray->fetch_assoc()) {
  ++$idFila;
  $clasificacion  = $row_capturaPercepcionesArray['s_clasificacion'];
  $claveSATP = $row_capturaPercepcionesArray['fk_claveSAT'];
  $idcuentaP = $row_capturaPercepcionesArray['fk_id_cuenta'];
  $conceptoP = utf8_encode($row_capturaPercepcionesArray['s_concepto']);
  $importeGravadoP =$row_capturaPercepcionesArray['n_importeGravado'];
  $importeExentoP = utf8_encode($row_capturaPercepcionesArray['n_importeExento']);

  $tipoHoras = $row_capturaPercepcionesArray['s_tipoHoras'];
  $dias_horasExtra = $row_capturaPercepcionesArray['n_dias_horasExtra'];
  $horasExtra = $row_capturaPercepcionesArray['n_horasExtra'];
  $importePagado = $row_capturaPercepcionesArray['n_importePagado'];

  $array['Percepcion'][$idFila]['TipoPercepcion'] = $claveSATP;
  $array['Percepcion'][$idFila]['Clave'] = $idcuentaP;
  $array['Percepcion'][$idFila]['Concepto'] = $conceptoP;
  $array['Percepcion'][$idFila]['ImporteGravado'] = $importeGravadoP;
  $array['Percepcion'][$idFila]['ImporteExento'] = $importeExentoP;

  if( $clasificacion == 'horasExtras' ){
    $array['HorasExtra'][$idFila]['Dias'] = $dias_horasExtra;
    $array['HorasExtra'][$idFila]['TipoHoras'] = $tipoHoras;
    $array['HorasExtra'][$idFila]['HorasExtra'] = $horasExtra;
    $array['HorasExtra'][$idFila]['ImportePagado'] = $importePagado;
  }

  if( $clasificacion == 'separacionIndemnizacion' ){
    # los importes provienen de: Ubicaciones\Nomina\actions\consulta_captura_sumaTotales.php
    $array['SeparacionIndemnizacion'][$idFila]['TotalPagado'] = $totalPagado;
    $array['SeparacionIndemnizacion'][$idFila]['NumAñosServicio'] = $numAniosServicio;
    $array['SeparacionIndemnizacion'][$idFila]['UltimoSueldoMensOrd'] = $ultimoSueldoMensOrd;
    $array['SeparacionIndemnizacion'][$idFila]['IngresoAcumulable'] = $ingresoAcumulable;
    $array['SeparacionIndemnizacion'][$idFila]['IngresoNoAcumulable'] = $ingresoNoAcumulable;
  }

}

?>

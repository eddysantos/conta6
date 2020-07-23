<?php
  $query_capturaPercepcionesHrExtra = "select * from conta_t_nom_captura_det where fk_id_docNomina = ? and s_clasificacion = 'horasExtras' order by pk_id_partida";

$stmt_capturaPercepcionesHrExtra = $db->prepare($query_capturaPercepcionesHrExtra);
if (!($stmt_capturaPercepcionesHrExtra)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_capturaPercepcionesHrExtra->bind_param('s',$idDocNomina);
if (!($stmt_capturaPercepcionesHrExtra)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_capturaPercepcionesHrExtra->errno]: $stmt_capturaPercepcionesHrExtra->error";
  exit_script($system_callback);
}

if (!($stmt_capturaPercepcionesHrExtra->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_capturaPercepcionesHrExtra->errno]: $stmt_capturaPercepcionesHrExtra->error";
  exit_script($system_callback);
}

$rslt_capturaPercepcionesHrExtra = $stmt_capturaPercepcionesHrExtra->get_result();

$idFila = 0;
while ($row_capturaPercepcionesHrExtra = $rslt_capturaPercepcionesHrExtra->fetch_assoc()) {
  ++$idFila;
  $partidaP = $row_capturaPercepcionesHrExtra['pk_id_partida'];
  $claveSATP = $row_capturaPercepcionesHrExtra['fk_claveSAT'];
  $ordenReporteP = $row_capturaPercepcionesHrExtra['n_ordenReporte'];
  $idcuentaP = $row_capturaPercepcionesHrExtra['fk_id_cuenta'];
  $conceptoP = utf8_encode($row_capturaPercepcionesHrExtra['s_concepto']);
  $dias_horasExtra = $row_capturaPercepcionesHrExtra['n_dias_horasExtra'];
  $horasExtra = $row_capturaPercepcionesHrExtra['n_horasExtra'];
  $importeGravadoP = $row_capturaPercepcionesHrExtra['n_importeGravado'];
  $importeExentoP = utf8_encode($row_capturaPercepcionesHrExtra['n_importeExento']);


  $detalle_PERCEPHrExtra .= "
  <tr class='row mt-4 m-0 trPERCEPHrExtra elemento-percepHrExtra' id='$partidaP'>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_PERCEPHrExtra_cve$partidaP' class='T_PERCEPHrExtra_CVE cve efecto border-0' value='$claveSATP' readonly>
      <input type='hidden' id='T_PERCEPHrExtra_ordenRep$partidaP' class='T_PERCEPHrExtra_ORDENREP ordenRep' value='$ordenReporteP' >
      <input type='hidden' id='T_PERCEPHrExtra_id-partida$partidaP' class='T_PERCEPHrExtra_ID-PARTIDA id-partida' value='$partidaP' >
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_PERCEPHrExtra_cta$partidaP' class='T_PERCEPHrExtra_CTA cta efecto border-0' value='$idcuentaP' readonly>
    </td>
    <td class='col-md-4 input-effect'>
      <input type='text' id='T_PERCEPHrExtra_desc$partidaP' class='T_PERCEPHrExtra_DESC desc efecto' value='$conceptoP'>
    </td>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_PERCEPHrExtra_dias$partidaP' class='T_PERCEPHrExtra_DIAS dias efecto' value='$dias_horasExtra'>
    </td>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_PERCEPHrExtra_horas$partidaP' class='T_PERCEPHrExtra_HORAS horas efecto' value='$horasExtra'>
    </td>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_PERCEPHrExtra_gravado$partidaP' class='T_PERCEPHrExtra_GRAVADO gravado efecto' value='$importeGravadoP' onblur='validaIntDec(this); sumaGeneralNomina()'>
    </td>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_PERCEPHrExtra_exento$partidaP' class='T_PERCEPHrExtra_EXENTO exento efecto' value='$importeExentoP' onblur='validaIntDec(this); sumaGeneralNomina()'>
    </td>
    <td>
      <a><img class='icomediano remove-PERCEPHrExtra' src='/conta6/Resources/iconos/002-trash.svg'></a>
    </td>
  </tr>
  ";
}

?>

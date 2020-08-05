<?php
  $query_capturaPercepciones = "select * from conta_t_nom_captura_det where fk_id_docNomina = ? and s_clasificacion = 'percepcion' order by pk_id_partida";

$stmt_capturaPercepciones = $db->prepare($query_capturaPercepciones);
if (!($stmt_capturaPercepciones)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_capturaPercepciones->bind_param('s',$idDocNomina);
if (!($stmt_capturaPercepciones)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_capturaPercepciones->errno]: $stmt_capturaPercepciones->error";
  exit_script($system_callback);
}

if (!($stmt_capturaPercepciones->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_capturaPercepciones->errno]: $stmt_capturaPercepciones->error";
  exit_script($system_callback);
}

$rslt_capturaPercepciones = $stmt_capturaPercepciones->get_result();

$idFila = 0;
while ($row_capturaPercepciones = $rslt_capturaPercepciones->fetch_assoc()) {
  ++$idFila;
  $partidaP = $row_capturaPercepciones['pk_id_partida'];
  $claveSATP = $row_capturaPercepciones['fk_claveSAT'];
  $ordenReporteP = $row_capturaPercepciones['n_ordenReporte'];
  $idcuentaP = $row_capturaPercepciones['fk_id_cuenta'];
  $conceptoP = utf8_encode($row_capturaPercepciones['s_concepto']);
  $importeGravadoP =$row_capturaPercepciones['n_importeGravado'];
  $importeExentoP = utf8_encode($row_capturaPercepciones['n_importeExento']);


  $detalle_PERCEP .= "
  <tr class='row mt-4 m-0 trPERCEP elemento-percep' id='$partidaP'>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_PERCEP_cve$partidaP' class='T_PERCEP_CVE cve efecto border-0' value='$claveSATP' readonly>
      <input type='hidden' id='T_PERCEP_ordenRep$partidaP' class='T_PERCEP_ORDENREP ordenRep' value='$ordenReporteP' >
      <input type='hidden' id='T_PERCEP_id-partida$partidaP' class='T_PERCEP_ID-PARTIDA id-partida' value='$partidaP' >
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_PERCEP_cta$partidaP' class='T_PERCEP_CTA cta efecto border-0' value='$idcuentaP' readonly>
    </td>
    <td class='col-md-4 input-effect'>
      <input type='text' id='T_PERCEP_desc$partidaP' class='T_PERCEP_DESC desc efecto' value='$conceptoP'>
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_PERCEP_gravado$partidaP' class='T_PERCEP_GRAVADO gravado efecto' value='$importeGravadoP' onblur='validaIntDec(this); sumaGeneralNomina()'>
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_PERCEP_exento$partidaP' class='T_PERCEP_EXENTO exento efecto' value='$importeExentoP' onblur='validaIntDec(this); sumaGeneralNomina()'>
    </td>
    <td>
      <a><img class='icomediano remove-percep' src='/conta6/Resources/iconos/002-trash.svg'></a>
    </td>
  </tr>
  ";
}

?>

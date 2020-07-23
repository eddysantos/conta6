<?php
  $query_capturaPercepcionesSepIndem = "select * from conta_t_nom_captura_det where fk_id_docNomina = ? and s_clasificacion = 'separacionIndemnizacion' order by pk_id_partida";

$stmt_capturaPercepcionesSepIndem = $db->prepare($query_capturaPercepcionesSepIndem);
if (!($stmt_capturaPercepcionesSepIndem)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_capturaPercepcionesSepIndem->bind_param('s',$idDocNomina);
if (!($stmt_capturaPercepcionesSepIndem)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_capturaPercepcionesSepIndem->errno]: $stmt_capturaPercepcionesSepIndem->error";
  exit_script($system_callback);
}

if (!($stmt_capturaPercepcionesSepIndem->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_capturaPercepcionesSepIndem->errno]: $stmt_capturaPercepcionesSepIndem->error";
  exit_script($system_callback);
}

$rslt_capturaPercepcionesSepIndem = $stmt_capturaPercepcionesSepIndem->get_result();

$idFila = 0;
while ($row_capturaPercepcionesSepIndem = $rslt_capturaPercepcionesSepIndem->fetch_assoc()) {
  ++$idFila;
  $partidaP = $row_capturaPercepcionesSepIndem['pk_id_partida'];
  $claveSATP = $row_capturaPercepcionesSepIndem['fk_claveSAT'];
  $ordenReporteP = $row_capturaPercepcionesSepIndem['n_ordenReporte'];
  $idcuentaP = $row_capturaPercepcionesSepIndem['fk_id_cuenta'];
  $conceptoP = utf8_encode($row_capturaPercepcionesSepIndem['s_concepto']);
  $importeGravadoP = $row_capturaPercepcionesSepIndem['n_importeGravado'];
  $importeExentoP = utf8_encode($row_capturaPercepcionesSepIndem['n_importeExento']);


  $detalle_PERCEPSepIndem .= "
  <tr class='row mt-4 m-0 trPERCEPSepIndem elemento-percepSepIndem' id='$partidaP'>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_PERCEPSepIndem_cve$partidaP' class='T_PERCEPSepIndem_CVE cve efecto border-0' value='$claveSATP' readonly>
      <input type='hidden' id='T_PERCEPSepIndem_ordenRep$partidaP' class='T_PERCEPSepIndem_ORDENREP ordenRep' value='$ordenReporteP' >
      <input type='hidden' id='T_PERCEPSepIndem_id-partida$partidaP' class='T_PERCEPSepIndem_ID-PARTIDA id-partida' value='$partidaP' >
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_PERCEPSepIndem_cta$partidaP' class='T_PERCEPSepIndem_CTA cta efecto border-0' value='$idcuentaP' readonly>
    </td>
    <td class='col-md-4 input-effect'>
      <input type='text' id='T_PERCEPSepIndem_desc$partidaP' class='T_PERCEPSepIndem_DESC desc efecto' value='$conceptoP'>
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_PERCEPSepIndem_gravado$partidaP' class='T_PERCEPSepIndem_GRAVADO gravado efecto' value='$importeGravadoP' onblur='validaIntDec(this); sumaGeneralNomina()'>
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_PERCEPSepIndem_exento$partidaP' class='T_PERCEPSepIndem_EXENTO exento efecto' value='$importeExentoP' onblur='validaIntDec(this); sumaGeneralNomina()'>
    </td>
    <td>
      <a><img class='icomediano remove-PERCEPSepIndem' src='/conta6/Resources/iconos/002-trash.svg'></a>
    </td>
  </tr>
  ";
}

?>

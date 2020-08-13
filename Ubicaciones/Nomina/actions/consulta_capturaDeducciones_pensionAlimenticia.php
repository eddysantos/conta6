<?php
  $query_capturaDeducciones_PA = "select * from conta_t_nom_captura_det where fk_id_docNomina = ? and s_clasificacion = 'desctoDespTotal' order by pk_id_partida";

$stmt_capturaDeducciones_PA = $db->prepare($query_capturaDeducciones_PA);
if (!($stmt_capturaDeducciones_PA)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_capturaDeducciones_PA->bind_param('s',$idDocNomina);
if (!($stmt_capturaDeducciones_PA)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_capturaDeducciones_PA->errno]: $stmt_capturaDeducciones_PA->error";
  exit_script($system_callback);
}

if (!($stmt_capturaDeducciones_PA->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_capturaDeducciones_PA->errno]: $stmt_capturaDeducciones_PA->error";
  exit_script($system_callback);
}

$rslt_capturaDeducciones_PA = $stmt_capturaDeducciones_PA->get_result();

$idFila = 0;
while ($row_capturaDeducciones_PA = $rslt_capturaDeducciones_PA->fetch_assoc()) {
  ++$idFila;
  $partidaD_PA = $row_capturaDeducciones_PA['pk_id_partida'];
  $claveSATD_PA = $row_capturaDeducciones_PA['fk_claveSAT'];
  $ordenReporteD_PA = $row_capturaDeducciones_PA['n_ordenReporte'];
  $idcuentaD_PA = $row_capturaDeducciones_PA['fk_id_cuenta'];
  $conceptoD_PA = utf8_encode($row_capturaDeducciones_PA['s_concepto']);
  $baseD_PA = $row_capturaDeducciones_PA['n_base'];
  $porcentajeD_PA = $row_capturaDeducciones_PA['n_porcentaje'];
  $importeGravadoD_PA =$row_capturaDeducciones_PA['n_importeGravado'];
  $importeExentoD_PA = utf8_encode($row_capturaDeducciones_PA['n_importeExento']);


  $detalle_DEDUC_penAlim.= "
  <tr class='row mt-4 m-0 trDEDUCPA elemento-deducPA' id='$partidaD_PA'>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_DEDUCPA_cve$partidaD_PA' class='T_DEDUCPA_CVE cve efecto border-0' value='$claveSATD_PA' readonly>
      <input type='hidden' id='T_DEDUCPA_ordenRep' class='T_DEDUCPA_ORDENREP ordenRep' value='$ordenReporteD_PA' >
      <input type='hidden' id='T_DEDUCPA_id-partida' class='T_DEDUCPA_ID-PARTIDA id-partida' value='$partidaD_PA' >
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_DEDUCPA_cta$partidaD_PA' class='T_DEDUCPA_CTA cta efecto border-0' value='$idcuentaD_PA' readonly>
    </td>
    <td class='col-md-4 input-effect'>
      <input type='text' id='T_DEDUCPA_desc$partidaD_PA' class='T_DEDUCPA_DESC desc efecto' value='$conceptoD_PA'>
    </td>
    <td class='col-md-4 input-effect'>
        <input type='text' id='T_DEDUCPA_base$partidaD_PA' class='T_DEDUCPA_BASE base efecto' value='$baseD_PA'>
    </td>
    <td class='col-md-4 input-effect'>
      <input type='text' id='T_DEDUCPA_porcentaje$partidaD_PA' class='T_DEDUCPA_PORCENTAJE porcentaje efecto' value='$porcentajeD_PA'>
    </td>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_DEDUCPA_gravado$partidaD_PA' class='T_DEDUCPA_GRAVADO gravado efecto border-0' value='$importeGravadoD_PA' onblur='validaIntDec(this); sumaGeneralNomina()' readonly>
    </td>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_DEDUCPA_exento$partidaD_PA' class='T_DEDUCPA_EXENTO exento efecto' value='$importeExentoD_PA' onblur='validaIntDec(this); sumaGeneralNomina()'>
    </td>
    <td>
      <a><img class='icomediano remove-DEDUCPA' src='/Resources/iconos/002-trash.svg'></a>
    </td>
  </tr>
  ";
}

?>

<?php
  $query_capturaDeducciones = "select * from conta_t_nom_captura_det where fk_id_docNomina = ? and s_clasificacion = 'deduccion' order by pk_id_partida";

$stmt_capturaDeducciones = $db->prepare($query_capturaDeducciones);
if (!($stmt_capturaDeducciones)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_capturaDeducciones->bind_param('s',$idDocNomina);
if (!($stmt_capturaDeducciones)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_capturaDeducciones->errno]: $stmt_capturaDeducciones->error";
  exit_script($system_callback);
}

if (!($stmt_capturaDeducciones->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_capturaDeducciones->errno]: $stmt_capturaDeducciones->error";
  exit_script($system_callback);
}

$rslt_capturaDeducciones = $stmt_capturaDeducciones->get_result();

$idFila = 0;
while ($row_capturaDeducciones = $rslt_capturaDeducciones->fetch_assoc()) {
  ++$idFila;
  $partidaD = $row_capturaDeducciones['pk_id_partida'];
  $claveSATD = $row_capturaDeducciones['fk_claveSAT'];
  $ordenReporteD = $row_capturaDeducciones['n_ordenReporte'];
  $idcuentaD = $row_capturaDeducciones['fk_id_cuenta'];
  $conceptoD = utf8_encode($row_capturaDeducciones['s_concepto']);
  $importeGravadoD =$row_capturaDeducciones['n_importeGravado'];
  $importeExentoD = utf8_encode($row_capturaDeducciones['n_importeExento']);


  $detalle_DEDUC.= "
  <tr class='row mt-4 m-0 trDEDUC elemento-deduc' id='$partidaD'>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_DEDUC_cve$partidaD' class='T_DEDUC_CVE cve efecto border-0' value='$claveSATD' readonly>
      <input type='hidden' id='T_DEDUC_ordenReD' class='T_DEDUC_ORDENREP ordenReD' value='$ordenReporteD' >
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_DEDUC_cta$partidaD' class='T_DEDUC_CTA cta efecto border-0' value='$idcuentaD' readonly>
    </td>
    <td class='col-md-4 input-effect'>
      <input type='text' id='T_DEDUC_desc$partidaD' class='T_DEDUC_DESC desc efecto' value='$conceptoD'>
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_DEDUC_gravado$partidaD' class='T_DEDUC_GRAVADO gravado efecto' value='$importeGravadoD' onblur='validaIntDec(this);' onchange='sumaGeneralNomina()'>
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_DEDUC_exento$partidaD' class='T_DEDUC_EXENTO exento efecto' value='$importeExentoD' onblur='validaIntDec(this);' onchange='sumaGeneralNomina()'>
    </td>
    <td>
      <a><img class='icomediano remove-DEDUC' src='/conta6/Resources/iconos/002-trash.svg'></a>
    </td>
  </tr>
  ";
}

?>

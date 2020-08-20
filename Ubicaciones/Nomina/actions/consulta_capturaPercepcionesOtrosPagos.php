<?php
  $query_capturaPercepcionesOP = "select * from conta_t_nom_captura_det where fk_id_docNomina = ? and s_clasificacion = 'otrosPagos' order by pk_id_partida";

$stmt_capturaPercepcionesOP = $db->prepare($query_capturaPercepcionesOP);
if (!($stmt_capturaPercepcionesOP)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_capturaPercepcionesOP->bind_param('s',$idDocNomina);
if (!($stmt_capturaPercepcionesOP)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_capturaPercepcionesOP->errno]: $stmt_capturaPercepcionesOP->error";
  exit_script($system_callback);
}

if (!($stmt_capturaPercepcionesOP->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_capturaPercepcionesOP->errno]: $stmt_capturaPercepcionesOP->error";
  exit_script($system_callback);
}

$rslt_capturaPercepcionesOP = $stmt_capturaPercepcionesOP->get_result();

$idFila = 0;
while ($row_capturaPercepcionesOP = $rslt_capturaPercepcionesOP->fetch_assoc()) {
  ++$idFila;
  $partidaPOP = $row_capturaPercepcionesOP['pk_id_partida'];
  $claveSATPOP = $row_capturaPercepcionesOP['fk_claveSAT'];
  $ordenReportePOP = $row_capturaPercepcionesOP['n_ordenReporte'];
  $idcuentaPOP = $row_capturaPercepcionesOP['fk_id_cuenta'];
  $conceptoPOP = utf8_encode($row_capturaPercepcionesOP['s_concepto']);
  $importeExentoPOP = $row_capturaPercepcionesOP['n_importeExento'];
  $subsidioCausadoPOP = $row_capturaPercepcionesOP['n_subsidioCausado'];
  $anioOP = $row_capturaPercepcionesOP['s_anio'];
  $remanenteSalFavOP = $row_capturaPercepcionesOP['n_remanenteSalFav'];

  $detalle_PERCEPOP .= "
  <tr class='row mt-4 m-0 trPERCEPOP elemento-percepop' id='$partidaPOP'>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_PERCEPOP_cve$partidaPOP' class='T_PERCEPOP_CVE cve efecto border-0' value='$claveSATPOP' readonly>
      <input type='hidden' id='T_PERCEPOP_ordenRep$partidaPOP' class='T_PERCEPOP_ORDENREP ordenRep' value='$ordenReportePOP' >
      <input type='hidden' id='T_PERCEPOP_id-partida$partidaPOP' class='T_PERCEPOP_ID-PARTIDA id-partida' value='$partidaPOP' >
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_PERCEPOP_cta$partidaPOP' class='T_PERCEPOP_CTA cta efecto border-0' value='$idcuentaPOP' readonly>
    </td>
    <td class='col-md-3 input-effect'>
      <input type='text' id='T_PERCEPOP_desc$partidaPOP' class='T_PERCEPOP_DESC desc efecto' value='$conceptoPOP'>
    </td>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_PERCEPOP_exento$partidaPOP' class='T_PERCEPOP_EXENTO exento efecto' value='$importeExentoPOP' onblur='validaIntDec(this); sumaGeneralNomina()'>
    </td>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_PERCEPOP_subCausado$partidaPOP' class='T_PERCEPOP_SUBCAUSADO subcausado efecto' value='$subsidioCausadoPOP' onblur='validaIntDec(this);'>
    </td>
    <td class='col-md-1 input-effect'>
      <input type='text' id='T_PERCEPOP_anio$partidaPOP' class='T_PERCEPOP_ANIO anio efecto' value='$anioPOP'>
    </td>
    <td class='col-md-2 input-effect'>
      <input type='text' id='T_PERCEPOP_saldoFavor$partidaPOP' class='T_PERCEPOP_SALDOFAVOR saldofavor efecto' value='$remanenteSalFavOP' onblur='validaIntDec(this);'>
    </td>
    <td>
      <a><img class='icomediano remove-PERCEPOP' src='/Resources/iconos/002-trash.svg'></a>
    </td>
  </tr>
  ";
}

?>

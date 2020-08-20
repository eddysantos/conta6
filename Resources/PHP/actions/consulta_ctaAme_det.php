<?php
  $query_ctaAme_det = "SELECT * from contame_t_facturas_det where fk_id_ctaAme = ?";

$stmt_ctaAme_det = $db->prepare($query_ctaAme_det);
if (!($stmt_ctaAme_det)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_ctaAme_det->bind_param('s', $extraerfolio);
if (!($stmt_ctaAme_det)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_ctaAme_det->errno]: $stmt_ctaAme_det->error";
  exit_script($system_callback);
}

if (!($stmt_ctaAme_det->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_ctaAme_det->errno]: $stmt_ctaAme_det->error";
  exit_script($system_callback);
}

$rslt_ctaAme_det = $stmt_ctaAme_det->get_result();

$idFila = 0;
while ($row_ctaAme_det = $rslt_ctaAme_det->fetch_assoc()) {
  ++$idFila;

  $n_cantidad = $row_ctaAme_det['n_cantidad'];
  $fk_id_cuenta = $row_ctaAme_det['fk_id_cuenta'];
  $fk_id_concepto = $row_ctaAme_det['fk_id_concepto'];
  $s_conceptoEsp = utf8_encode($row_ctaAme_det['s_conceptoEsp']);
  $s_conceptoEnglish =$row_ctaAme_det['s_conceptoEnglish'];
  $s_descripcion = utf8_encode($row_ctaAme_det['s_descripcion']);
  $n_importe = number_format($row_ctaAme_det['n_importe'],2,'.','');
  $n_total = number_format($row_ctaAme_det['n_total'],2,'.','');


  $ctaAme_POCME .= "<tr class='row m-0 trPOCME elemento-pocme' id='$idFila'>
    <td class='col-md-1 p-2'>
      <input type='text' id='T_POCME_Cantidad$idFila' class='T_POCME_CANTIDAD cantidad efecto h22' value='$n_cantidad' onblur='validaSoloNumeros(this);importe_POCME();' size='4'/>
    </td>
    <td class='col-md-3 p-2 datos-transferibles'>
      <input type='hidden' id='T_POCME_idTipoCta$idFila' class='T_POCME_CUENTAS id-cuenta' value='$fk_id_cuenta'>
      <input type='hidden' id='T_POCME_idConcep$idFila' class='T_POCME_idCONCEPTOS id-concepto' value='$fk_id_concepto'>
      <input type='text' id='T_POCME_Concepto$idFila' class='T_POCME_CONCEPTOS efecto h22 concepto-espanol' size='45' value='$s_conceptoEsp' readonly/>
      <input type='hidden' id='T_POCME_ConceptoEng$idFila' class='T_POCME_CONCEPTOS_ENG concepto-ingles' value='$s_conceptoEnglish'>
    </td>
    <td class='col-md-3 p-2'>
      <input type='text' id='T_POCME_Descripcion$idFila' class='T_POCME_DESCRIPCION descripcion efecto h22' size='45' maxlength='40' value='$s_descripcion'>
    </td>
    <td class='col-md-1 p-2 text-left'>
      <a href='#' class='remove-POCME'><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>
    </td>
    <td class='col-md-2 p-2'>
      <input type='text' id='T_POCME_Importe$idFila' class='T_POCME_IMPORTES importe efecto h22' onblur='validaIntDec(this);validaDescImporte(1,$idFila);importe_POCME();cortarDecimalesObj(this,2);' size='17' value='$n_importe' >
    </td>
    <td class='col-md-2 p-2'>
      <input type='text' id='T_POCME_Subtotal$idFila' class='T_POCME_SUBTOTALES subtotal efecto h22' size='17' readonly value='$n_total'>
    </td>
  </tr>";
}

?>

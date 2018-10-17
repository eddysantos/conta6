<?php
#fk_id_conceptoCta,s_concepto_eng,s_concepto_esp,n_cantidad,n_importe
// $query_conTarifaPOCMEgeneral = "SELECT fk_id_concepto,s_concepto_eng,s_concepto_esp,n_cantidad,n_importe,fk_id_cuenta
//                                 FROM conta_tem_tarifas_calculodetalle A, contame_tarifas_conceptos B
//                                 WHERE A.fk_id_concepto = B.fk_id_conceptoHon AND A.fk_id_tarifa=$calculoTarifa AND A.s_seccion = 'POCME' and A.fk_id_cliente = 'CLT_5900'
//                                 ORDER BY B.s_Concepto_esp";

$query_conTarifaPOCMEgeneral = "SELECT A.fk_id_concepto,b.s_concepto_eng,s_conceptoesp,n_cantidad,n_importe,A.fk_id_cuenta
                                FROM conta_tem_tarifas_calculodetalle A, conta_tarifas_conceptos B
                                WHERE A.fk_id_concepto = B.pk_id_concepto AND A.fk_id_tarifa=$calculoTarifa AND A.s_seccion = 'POCME' and A.fk_id_cliente = 'CLT_5900'
                                ORDER BY A.s_Conceptoesp";


$stmt_conTarifaPOCMEgeneral = $db->prepare($query_conTarifaPOCMEgeneral);
if (!($stmt_conTarifaPOCMEgeneral)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare conTarifaPOCMEgeneral [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_conTarifaPOCMEgeneral->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution conTarifaPOCMEgeneral [$stmt_conTarifaPOCMEgeneral->errno]: $stmt_conTarifaPOCMEgeneral->error";
  exit_script($system_callback);
}

$rslt_conTarifaPOCMEgeneral = $stmt_conTarifaPOCMEgeneral->get_result();
if ($rslt_conTarifaPOCMEgeneral->num_rows == 0) {
  $tarifaPOCMEgeneral .= "<option selected value='0'>Tarifa General no capturada</option>";
}

if ($rslt_conTarifaPOCMEgeneral->num_rows > 0) {
    $tarifaPOCMEgeneral = "<option selected value='0'>Tarifa General</option>";
  while ($row_conTarifaPOCMEgeneral = $rslt_conTarifaPOCMEgeneral->fetch_assoc()) {
    $fk_id_concepto = $row_conTarifaPOCMEgeneral['fk_id_concepto'];
    $s_concepto_eng = trim(utf8_encode($row_conTarifaPOCMEgeneral['s_concepto_eng']));
    $s_concepto_esp = trim(utf8_encode($row_conTarifaPOCMEgeneral['s_conceptoesp']));
    $n_cantidad = $row_conTarifaPOCMEgeneral['n_cantidad'];
    $n_importe = number_format($row_conTarifaPOCMEgeneral['n_importe'],2);
    $fk_id_cuenta = $row_conTarifaPOCMEgeneral['fk_id_cuenta'];

    $tarifaPOCMEgeneral .= "<option value='$fk_id_concepto+$s_concepto_eng+$n_cantidad+$n_importe+$s_concepto_esp+$fk_id_cuenta'>$s_concepto_esp $n_importe</option>";
  }
}
?>

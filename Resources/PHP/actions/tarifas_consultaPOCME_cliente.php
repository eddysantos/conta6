<?php
#fk_id_conceptoCta,s_concepto_eng,s_concepto_esp,n_cantidad,n_importe
// $query_conTarifaPOCMEcliente = "SELECT fk_id_concepto,s_concepto_eng,s_concepto_esp,n_cantidad,n_importe,fk_id_cuenta
//                                 FROM conta_tem_tarifas_calculodetalle A, contame_tarifas_conceptos B
//                                 WHERE A.fk_id_concepto = B.fk_id_conceptoHon AND A.fk_id_tarifa=$calculoTarifa AND A.s_seccion = 'POCME' and A.fk_id_cliente = '$id_cliente_usar'
//                                 ORDER BY B.s_Concepto_esp";

$query_conTarifaPOCMEcliente = "SELECT A.fk_id_concepto,B.s_concepto_eng,s_conceptoesp,n_cantidad,n_importe,A.fk_id_cuenta
                                FROM conta_tem_tarifas_calculodetalle A, conta_tarifas_conceptos B
                                WHERE A.fk_id_concepto = B.pk_id_concepto AND A.fk_id_tarifa=$calculoTarifa AND A.s_seccion = 'POCME' and A.fk_id_cliente = '$id_cliente_usar'
                                ORDER BY A.s_Conceptoesp";


$stmt_conTarifaPOCMEcliente = $db->prepare($query_conTarifaPOCMEcliente);
if (!($stmt_conTarifaPOCMEcliente)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_conTarifaPOCMEcliente->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_conTarifaPOCMEcliente->errno]: $stmt_conTarifaPOCMEcliente->error";
  exit_script($system_callback);
}

$rslt_conTarifaPOCMEcliente = $stmt_conTarifaPOCMEcliente->get_result();
if ($rslt_conTarifaPOCMEcliente->num_rows == 0) {
  $tarifaPOCMEcliente .= "<option selected value='0'>Tarifa Cliente no capturada</option>";
}

if ($rslt_conTarifaPOCMEcliente->num_rows > 0) {
    $tarifaPOCMEcliente = "<option selected value='0'>Tarifa Cliente</option>";
  while ($row_conTarifaPOCMEcliente = $rslt_conTarifaPOCMEcliente->fetch_assoc()) {
    $fk_id_concepto = $row_conTarifaPOCMEcliente['fk_id_concepto'];
    $s_concepto_eng = trim(utf8_encode($row_conTarifaPOCMEcliente['s_concepto_eng']));
    $s_concepto_esp = trim(utf8_encode($row_conTarifaPOCMEcliente['s_conceptoesp']));
    $n_cantidad = $row_conTarifaPOCMEcliente['n_cantidad'];
    $n_importe = number_format($row_conTarifaPOCMEcliente['n_importe'],2);
    $fk_id_cuenta = $row_conTarifaPOCMEcliente['fk_id_cuenta'];

    $tarifaPOCMEcliente .= "<option value='$fk_id_concepto+$s_concepto_eng+$n_cantidad+$n_importe+$s_concepto_esp+$fk_id_cuenta'>$s_concepto_esp $n_importe</option>";
  }
}
?>

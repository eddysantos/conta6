<?php

$query_cfdi = "SELECT * from conta_t_pagos_cfdi where fk_id_pago_captura = ? ";

$stmt_cfdi = $db->prepare($query_cfdi);
if (!($stmt_cfdi)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare cfdi [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_cfdi->bind_param('s',$id_pago_captura);
if (!($stmt_cfdi)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding cfdi [$stmt_cfdi->errno]: $stmt_cfdi->error";
  exit_script($system_callback);
}

if (!($stmt_cfdi->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution cfdi [$stmt_cfdi->errno]: $stmt_cfdi->error";
  exit_script($system_callback);
}

$rslt_cfdi = $stmt_cfdi->get_result();

if ($rslt_cfdi->num_rows == 0) {
  $pagosCFDI = "<p db-id=''>No se encontraron resultados</p>";
}

while ($row_cfdi = $rslt_cfdi->fetch_assoc()) {
  $pk_id_pago = $row_cfdi[pk_id_pago];
  $fk_id_poliza = $row_cfdi[fk_id_poliza];
  $s_UUID = $row_cfdi[s_UUID];
  $s_selloSATcancela = $row_cfdi[s_selloSATcancela];  

}
?>

<?php
/*
$query_facCaptura = "UPDATE conta_t_pagos_captura
                SET s_lugarExpedicion = ?,s_lugarExpedicion_txt = ?
                WHERE pk_id_cuenta_captura = ?";

$stmt_facCaptura = $db->prepare($query_facCaptura);
if (!($stmt_facCaptura)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare facCaptura [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_facCaptura->bind_param('sss',$lugarExpedicion,$lugarExpedicionTxt,$cuenta);
if (!($stmt_facCaptura)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding facCaptura [$stmt_facCaptura->errno]: $stmt_facCaptura->error";
  exit_script($system_callback);
}

if (!($stmt_facCaptura->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution facCaptura [$stmt_facCaptura->errno]: $stmt_facCaptura->error";
  exit_script($system_callback);
}
*/



$queryPagoCFDI = "UPDATE conta_t_pagos_cfdi
                SET s_UUID = ?, fk_id_certificado = ?, s_id_certificadoSAT = ?, s_selloCFDI = ?,
                    s_selloSAT = ?, s_timbradoVersion = ?, d_fechaTimbrado = ?, fk_usuario_generaUUID = ?, fk_id_poliza = ?, modoTimbrado = ?, s_nombrearchivo = ?
                WHERE fk_id_pago_captura = ? and pk_id_pago = ?";

$stmtPagoCFDI = $db->prepare($queryPagoCFDI);
if (!($stmtPagoCFDI)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare PagoCFDI [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtPagoCFDI->bind_param('sssssssssssss',$UUID,$noCertificado,$certSAT,$selloCFDI,$SelloSAT,$versionTimbre,$fechaTimbre,$usuario,$poliza,$modoTimbrar,$nombre_archivo,$cuenta,$id_factura);
if (!($stmtPagoCFDI)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding PagoCFDI [$stmtPagoCFDI->errno]: $stmtPagoCFDI->error";
  exit_script($system_callback);
}

if (!($stmtPagoCFDI->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution PagoCFDI [$stmtPagoCFDI->errno]: $stmtPagoCFDI->error";
  exit_script($system_callback);
}


?>

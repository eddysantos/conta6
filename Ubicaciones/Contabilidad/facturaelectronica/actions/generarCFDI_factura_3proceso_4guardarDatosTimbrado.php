<?php

$query_facCaptura = "UPDATE conta_t_facturas_captura
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




$queryfacDet = "UPDATE conta_t_facturas_cfdi
                SET d_fechaVencimiento = ?, s_UUID = ?, fk_id_certificado = ?, s_id_certificadoSAT = ?, s_selloCFDI = ?,
                    s_selloSAT = ?, s_timbradoVersion = ?, d_fechaTimbrado = ?, fk_usuario = ?, fk_id_poliza = ?, modoTimbrado = ?
                WHERE fk_id_cuenta_captura = ? and pk_id_factura = ?";

$stmtfacDet = $db->prepare($queryfacDet);
if (!($stmtfacDet)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare facDet [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtfacDet->bind_param('sssssssssssss',$vencimiento,$UUID,$noCertificado,$certSAT,$selloCFDI,$SelloSAT,$versionTimbre,$fechaTimbre,$usuario,$poliza,$modoTimbrar,$cuenta,$id_factura);
if (!($stmtfacDet)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding facDet [$stmtfacDet->errno]: $stmtfacDet->error";
  exit_script($system_callback);
}

if (!($stmtfacDet->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution facDet [$stmtfacDet->errno]: $stmtfacDet->error";
  exit_script($system_callback);
}


?>

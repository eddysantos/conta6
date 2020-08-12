<?php

$query_NCcaptura = "UPDATE conta_t_notacredito_captura
                SET s_lugarExpedicion = ?,s_lugarExpedicion_txt = ?
                WHERE pk_id_cuenta_captura_nc = ?";

$stmt_NCcaptura = $db->prepare($query_NCcaptura);
if (!($stmt_NCcaptura)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare NCcaptura [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_NCcaptura->bind_param('sss',$lugarExpedicion,$lugarExpedicionTxt,$cuenta);
if (!($stmt_NCcaptura)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding NCcaptura [$stmt_NCcaptura->errno]: $stmt_NCcaptura->error";
  exit_script($system_callback);
}

if (!($stmt_NCcaptura->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution NCcaptura [$stmt_NCcaptura->errno]: $stmt_NCcaptura->error";
  exit_script($system_callback);
}




$queryNCcfdi = "UPDATE conta_t_notacredito_cfdi
                SET s_UUID = ?, fk_id_certificado = ?, s_id_certificadoSAT = ?, s_selloCFDI = ?,
                    s_selloSAT = ?, s_timbradoVersion = ?, d_fechaTimbrado = ?, fk_usuario = ?, fk_id_poliza = ?,
                    s_descripNC = ?, n_valorUnitNC = ?, n_importeNC = ?, modoTimbrado = ?
                WHERE fk_id_cuenta_captura_nc = ? and pk_id_notacredito = ?";

$stmtNCcfdi = $db->prepare($queryNCcfdi);
if (!($stmtNCcfdi)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare NCcfdi [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtNCcfdi->bind_param('sssssssssssssss',$UUID,$noCertificado,$certSAT,$selloCFDI,$SelloSAT,$versionTimbre,$fechaTimbre,$usuario,$poliza,$s_descripNC,$n_importe,$n_importe,$modoTimbrar,$cuenta,$id_factura);
if (!($stmtNCcfdi)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding NCcfdi [$stmtNCcfdi->errno]: $stmtNCcfdi->error";
  exit_script($system_callback);
}

if (!($stmtNCcfdi->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution NCcfdi [$stmtNCcfdi->errno]: $stmtNCcfdi->error";
  exit_script($system_callback);
}


?>

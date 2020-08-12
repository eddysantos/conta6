<?php

$query_nomCaptura = "UPDATE conta_t_nom_captura
                SET s_lugarExpedicion = ?,s_lugarExpedicion_txt = ?
                WHERE pk_id_docNomina = ?";

$stmt_nomCaptura = $db->prepare($query_nomCaptura);
if (!($stmt_nomCaptura)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare nomCaptura [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_nomCaptura->bind_param('sss',$lugarExpedicion,$lugarExpedicionTxt,$idDocNomina);
if (!($stmt_nomCaptura)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding nomCaptura [$stmt_nomCaptura->errno]: $stmt_nomCaptura->error";
  exit_script($system_callback);
}

if (!($stmt_nomCaptura->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution nomCaptura [$stmt_nomCaptura->errno]: $stmt_nomCaptura->error";
  exit_script($system_callback);
}




$query_nomCFDIdet = "UPDATE conta_t_nom_cfdi
                SET s_UUID = ?, fk_id_certificado = ?, s_id_certificadoSAT = ?, s_selloCFD = ?,
                    s_selloSAT = ?, s_timbradoVersion = ?, d_fechaTimbrado = ?, fk_usuario_generaUUID = ?, fk_id_poliza = ?, s_modoTimbrado = ?
                WHERE fk_id_docNomina = ? and pk_id_nomina = ?";

$stmt_nomCFDIdet = $db->prepare($query_nomCFDIdet);
if (!($stmt_nomCFDIdet)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare _nomCFDIdet [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_nomCFDIdet->bind_param('ssssssssssss',$UUID,$noCertificado,$certSAT,$selloCFDI,$SelloSAT,$versionTimbre,$fechaTimbre,$usuario,$poliza,$modoTimbrar,$idDocNomina,$idFactura);
if (!($stmt_nomCFDIdet)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding nomCFDIdet [$stmt_nomCFDIdet->errno]: $stmt_nomCFDIdet->error";
  exit_script($system_callback);
}

if (!($stmt_nomCFDIdet->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution nomCFDIdet [$stmt_nomCFDIdet->errno]: $stmt_nomCFDIdet->error";
  exit_script($system_callback);
}


?>

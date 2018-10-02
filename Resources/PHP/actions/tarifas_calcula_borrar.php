<?PHP

$query_borrarCalculoTarifaMST="DELETE FROM conta_tem_tarifas_calculo WHERE pk_id_tarifaExtraer = ?";

$stmt_borrarCalculoTarifaMST = $db->prepare($query_borrarCalculoTarifaMST);
if (!($stmt_borrarCalculoTarifaMST)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare borrarCalculoTarifaMST [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_borrarCalculoTarifaMST->bind_param('s',$ID_calculo);
if (!($stmt_borrarCalculoTarifaMST)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding borrarCalculoTarifaMST [$stmt_borrarCalculoTarifaMST->errno]: $stmt_borrarCalculoTarifaMST->error";
  exit_script($system_callback);
}

if (!($stmt_borrarCalculoTarifaMST->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution borrarCalculoTarifaMST [$stmt_borrarCalculoTarifaMST->errno]: $stmt_borrarCalculoTarifaMST->error";
}



$query_borrarCalculoTarifaDET="DELETE FROM conta_tem_tarifas_calculodetalle WHERE fk_id_tarifa = ?";

$stmt_borrarCalculoTarifaDET = $db->prepare($query_borrarCalculoTarifaDET);
if (!($stmt_borrarCalculoTarifaDET)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare borrarCalculoTarifaDET [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_borrarCalculoTarifaDET->bind_param('s',$ID_calculo);
if (!($stmt_borrarCalculoTarifaDET)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding borrarCalculoTarifaDET [$stmt_borrarCalculoTarifaDET->errno]: $stmt_borrarCalculoTarifaDET->error";
  exit_script($system_callback);
}

if (!($stmt_borrarCalculoTarifaDET->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution borrarCalculoTarifaDET [$stmt_borrarCalculoTarifaDET->errno]: $stmt_borrarCalculoTarifaDET->error";
}

?>

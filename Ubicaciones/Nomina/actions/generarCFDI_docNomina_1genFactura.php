<?PHP
$query_genFac = "INSERT INTO conta_t_nom_cfdi(fk_id_docNomina) VALUES (?)";

$stmt_genFac = $db->prepare($query_genFac);
if (!($stmt_genFac)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare genFac [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_genFac->bind_param('s',$idDocNomina);
if (!($stmt_genFac)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding genFac [$stmt_genFac->errno]: $stmt_genFac->error";
  exit_script($system_callback);
}

if (!($stmt_genFac->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution genFac [$stmt_genFac->errno]: $stmt_genFac->error";
  //exit_script($system_callback);
}
$folioFactura = $db->insert_id;
?>

<?PHP
$query_genFac = "INSERT INTO conta_t_facturas_cfdi(fk_id_cuenta_captura,fk_referencia) VALUES (?,?)";

$stmt_genFac = $db->prepare($query_genFac);
if (!($stmt_genFac)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare genCtaGastos [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_genFac->bind_param('ss',$cuenta,$referencia);
if (!($stmt_genFac)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding genCtaGastos [$stmt_genFac->errno]: $stmt_genFac->error";
  exit_script($system_callback);
}

if (!($stmt_genFac->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution genCtaGastos [$stmt_genFac->errno]: $stmt_genFac->error";
  //exit_script($system_callback);
}
$folioFactura = $db->insert_id;
?>

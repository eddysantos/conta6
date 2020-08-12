<?PHP
$query_genCtaGastos = "INSERT INTO conta_t_facturas_ctagastos(fk_id_cuenta_captura) VALUES (?)";

$stmt_genCtaGastos = $db->prepare($query_genCtaGastos);
if (!($stmt_genCtaGastos)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare genCtaGastos [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_genCtaGastos->bind_param('s',$cuenta);
if (!($stmt_genCtaGastos)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding genCtaGastos [$stmt_genCtaGastos->errno]: $stmt_genCtaGastos->error";
  exit_script($system_callback);
}

if (!($stmt_genCtaGastos->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution genCtaGastos [$stmt_genCtaGastos->errno]: $stmt_genCtaGastos->error";
  //exit_script($system_callback);
}
$folioCtaGastos = $db->insert_id;
?>

<?PHP
$query_updatePagoNomina = "UPDATE conta_t_nom_cfdi SET fk_id_polizaPago = 0 WHERE pk_id_nomina = ?";

$stmt_updatePagoNomina = $db->prepare($query_updatePagoNomina);
if (!($stmt_updatePagoNomina)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_updatePagoNomina->bind_param('s',$factura);
if (!($stmt_updatePagoNomina)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding updatePagoNomina [$stmt_updatePagoNomina->errno]: $stmt_updatePagoNomina->error";
  exit_script($system_callback);
}

if (!($stmt_updatePagoNomina->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution updatePagoNomina [$stmt_updatePagoNomina->errno]: $stmt_updatePagoNomina->error";
  exit_script($system_callback);
}

$affected_updatePagoNomina = $stmt_updatePagoNomina->affected_rows;
$system_callback['affected'] = $affected_updatePagoNomina;
$system_callback['datos'] = $_POST;

if ($affected_updatePagoNomina == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "El query updatePagoNomina no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}

?>

<?PHP
#IVA RETENIDO NO COBRADO
$query_ivaRetenidoNoCobrado = "select *,sum(n_cargo-n_abono) as saldo from conta_t_polizas_det where fk_tipo=3 and fk_id_cuenta='0216-00001' and fk_factura = ? and fk_referencia = ?	";

$stmt_ivaRetenidoNoCobrado = $db->prepare($query_ivaRetenidoNoCobrado);
if (!($stmt_ivaRetenidoNoCobrado)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_ivaRetenidoNoCobrado->bind_param('ss',$factura,$referencia);
if (!($stmt_ivaRetenidoNoCobrado)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_ivaRetenidoNoCobrado->errno]: $stmt_ivaRetenidoNoCobrado->error";
  exit_script($system_callback);
}

if (!($stmt_ivaRetenidoNoCobrado->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_ivaRetenidoNoCobrado->errno]: $stmt_ivaRetenidoNoCobrado->error";
  exit_script($system_callback);
}


?>

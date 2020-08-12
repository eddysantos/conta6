<?PHP

$query_saldoFactura = "SELECT sum(b.n_cargo-b.n_abono) as saldo
					FROM conta_t_polizas_mst A,conta_t_polizas_det B 
					WHERE B.fk_factura = ? and b.fk_referencia = ? AND A.s_cancela = 0 AND A.pk_id_poliza = B.fk_id_poliza AND
					B.fk_id_cuenta like '0108%' AND B.fk_nc = 0	";

$stmt_saldoFactura = $db->prepare($query_saldoFactura);
if (!($stmt_saldoFactura)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_saldoFactura->bind_param('ss',$factura,$referencia);
if (!($stmt_saldoFactura)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_saldoFactura->errno]: $stmt_saldoFactura->error";
  exit_script($system_callback);
}

if (!($stmt_saldoFactura->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_saldoFactura->errno]: $stmt_saldoFactura->error";
  exit_script($system_callback);
}


?>

<?PHP
#IVA NO COBRADO AL 16%
$query_ivaNoCobrado = "SELECT B.fk_id_cuenta,B.fk_referencia,B.fk_factura,B.fk_nc,B.fk_ctagastos,cast(SUM(B.n_abono - B.n_cargo) as decimal(10,2)) as saldo
              FROM conta_t_polizas_mst A,conta_t_polizas_det B
              WHERE B.fk_id_cliente = ? AND CAST(B.d_fecha AS DATE) <= ? AND A.s_cancela = 0 AND A.pk_id_poliza = B.fk_id_poliza AND
              B.fk_factura = ? and B.fk_id_cuenta = '0202-00007'
              group by b.fk_referencia,b.fk_factura,B.fk_nc";

$stmt_ivaNoCobrado = $db->prepare($query_ivaNoCobrado);
if (!($stmt_ivaNoCobrado)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_ivaNoCobrado->bind_param('sss', $cliente,$fecha_pol,$factura);
if (!($stmt_ivaNoCobrado)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_ivaNoCobrado->errno]: $stmt_ivaNoCobrado->error";
  exit_script($system_callback);
}

if (!($stmt_ivaNoCobrado->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_ivaNoCobrado->errno]: $stmt_ivaNoCobrado->error";
  exit_script($system_callback);
}


?>

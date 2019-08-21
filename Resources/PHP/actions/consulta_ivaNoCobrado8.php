<?PHP
#IVA NO COBRADO AL 8%
$query_ivaNoCobrado8 = "SELECT B.fk_id_cuenta,B.fk_referencia,B.fk_factura,B.fk_nc,B.fk_ctagastos,cast(SUM(B.n_abono - B.n_cargo) as decimal(10,2)) as saldo
              FROM conta_t_polizas_mst A,conta_t_polizas_det B
              WHERE B.fk_id_cliente = ? AND CAST(B.d_fecha AS DATE) <= ? AND A.s_cancela = 0 AND A.pk_id_poliza = B.fk_id_poliza AND
              B.fk_factura = ? and B.fk_id_cuenta = '0202-00009'
              group by b.fk_referencia,b.fk_factura,B.fk_nc";

$stmt_ivaNoCobrado8 = $db->prepare($query_ivaNoCobrado8);
if (!($stmt_ivaNoCobrado8)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_ivaNoCobrado8->bind_param('sss', $cliente,$fecha_pol,$factura);
if (!($stmt_ivaNoCobrado8)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_ivaNoCobrado8->errno]: $stmt_ivaNoCobrado8->error";
  exit_script($system_callback);
}

if (!($stmt_ivaNoCobrado8->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_ivaNoCobrado8->errno]: $stmt_ivaNoCobrado8->error";
  exit_script($system_callback);
}


?>

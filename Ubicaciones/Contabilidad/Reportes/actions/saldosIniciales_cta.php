<?php
$query_saldoInicial = "SELECT ifnull(SUM(TRUNCATE(n_cargo,2)),0) Cargos, ifnull(SUM(TRUNCATE(n_abono,2)),0) Abonos
                        FROM conta_t_polizas_det
                        WHERE fk_id_cuenta = ? AND d_fecha < ?";



$stmt_saldoInicial = $db->prepare($query_saldoInicial);
if (!($stmt_saldoInicial)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_saldoInicial->bind_param('ss', $Cta_Inicial,$Fecha_Inicial);
if (!($stmt_saldoInicial)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_saldoInicial->errno]: $stmt_saldoInicial->error";
  exit_script($system_callback);
}

if (!($stmt_saldoInicial->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_saldoInicial->errno]: $stmt_saldoInicial->error";
  exit_script($system_callback);
}

$rslt_saldoInicial = $stmt_saldoInicial->get_result();

// if ($rslt_saldoInicial->num_rows == 0) {
//   $system_callback['code'] = 1;
//   $system_callback['data'] =
//   "<p db-id=''>No se encontraron resultados</p>";
//   $system_callback['message'] = "Script called successfully but there are no rows to display.";
//   exit_script($system_callback);
// }
//
// while ($row_saldoInicial = $rslt_saldoInicial->fetch_assoc()) {
//   $system_callback['data'] .=
//   "<p db-id='$row_saldoInicial[pk_id_cuenta]'>$row_saldoInicial[pk_id_cuenta] - $row_saldoInicial[s_cta_desc]</p>";
// }
//
// $system_callback['code'] = 1;
// $system_callback['message'] = "Script called successfully!";
// exit_script($system_callback);



 ?>

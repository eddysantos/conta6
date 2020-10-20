<?php
$query_cuentas_mst = "SELECT * FROM conta_cs_cuentas_mst WHERE pk_id_cuenta = ?";



$stmt_cuentas_mst = $db->prepare($query_cuentas_mst);
if (!($stmt_cuentas_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_cuentas_mst->bind_param('s', $Cta_Inicial);
if (!($stmt_cuentas_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_cuentas_mst->errno]: $stmt_cuentas_mst->error";
  exit_script($system_callback);
}

if (!($stmt_cuentas_mst->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_cuentas_mst->errno]: $stmt_cuentas_mst->error";
  exit_script($system_callback);
}

$rslt_cuentas_mst = $stmt_cuentas_mst->get_result();

// if ($rslt_cuentas_mst->num_rows == 0) {
//   $system_callback['code'] = 1;
//   $system_callback['data'] =
//   "<p db-id=''>No se encontraron resultados</p>";
//   $system_callback['message'] = "Script called successfully but there are no rows to display.";
//   exit_script($system_callback);
// }
//
// while ($row_cuentas_mst = $rslt_cuentas_mst->fetch_assoc()) {
//   $system_callback['data'] .=
//   "<p db-id='$row_cuentas_mst[pk_id_cuenta]'>$row_cuentas_mst[pk_id_cuenta] - $row_cuentas_mst[s_cta_desc]</p>";
// }
//
// $system_callback['code'] = 1;
// $system_callback['message'] = "Script called successfully!";
// exit_script($system_callback);



 ?>

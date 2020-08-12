<?PHP
$query_actMes_mst="UPDATE conta_t_polizas_mst SET d_mes = ?
            WHERE pk_id_poliza = ?";

$stmt_actMes_mst = $db->prepare($query_actMes_mst);
if (!($stmt_actMes_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare actMes_mst [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_actMes_mst->bind_param('ss',$mesPoliza,$poliza2);

if (!($stmt_actMes_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding actMes_mst [$stmt_actMes_mst->errno]: $stmt_actMes_mst->error";
  exit_script($system_callback);
}

if (!($stmt_actMes_mst->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution actMes_mst [$stmt_actMes_mst->errno]: $stmt_actMes_mst->error";
  //exit_script($system_callback);
}


$query_actMes_det="UPDATE conta_t_polizas_det SET d_mes = ?
            WHERE pk_id_poliza = ?";

$stmt_actMes_det = $db->prepare($query_actMes_det);
if (!($stmt_actMes_det)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare actMes_det [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_actMes_det->bind_param('ss',$mesPoliza,$poliza2);

if (!($stmt_actMes_det)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding actMes_det [$stmt_actMes_det->errno]: $stmt_actMes_det->error";
  exit_script($system_callback);
}

if (!($stmt_actMes_det->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution actMes_det [$stmt_actMes_det->errno]: $stmt_actMes_det->error";
  //exit_script($system_callback);
}

?>

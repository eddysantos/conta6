<?PHP
$query_consultaPartida = "select * FROM conta_t_polizas_det where pk_partida = ?";

$stmt_consultaPartida = $db->prepare($query_consultaPartida);
if (!($stmt_consultaPartida)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare consultaPartida [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_consultaPartida->bind_param('s', $partida);
if (!($stmt_consultaPartida)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding consultaPartida [$stmt_consultaPartida->errno]: $stmt_consultaPartida->error";
  exit_script($system_callback);
}

if (!($stmt_consultaPartida->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution consultaPartida [$stmt_consultaPartida->errno]: $stmt_consultaPartida->error";
  exit_script($system_callback);
}

$rslt_consultaPartida = $stmt_consultaPartida->get_result();

$row_consultaPartida = $rslt_consultaPartida->fetch_assoc();
$fk_id_cuenta = $row_consultaPartida['fk_id_cuenta'];
$fk_factura = $row_consultaPartida['fk_factura'];

?>

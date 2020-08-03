<?php

$query_CEeliminarpartida = "DELETE FROM conta_t_polizas_det_contaelec WHERE pk_id_partida = ?";
$stmt_CEeliminarpartida = $db->prepare($query_CEeliminarpartida);
if (!($stmt_CEeliminarpartida)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare CEeliminarpartida [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_CEeliminarpartida->bind_param('s',$partida);
if (!($stmt_CEeliminarpartida)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding CEeliminarpartida [$stmt_CEeliminarpartida->errno]: $stmt_CEeliminarpartida->error";
  exit_script($system_callback);
}

if (!($stmt_CEeliminarpartida->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution CEeliminarpartida [$stmt_CEeliminarpartida->errno]: $stmt_CEeliminarpartida->error";
  exit_script($system_callback);
}

$affected_CEeliminarpartida = $stmt_CEeliminarpartida->affected_rows;
$system_callback['affected'] = $affected_CEeliminarpartida;
$system_callback['datos'] = $_POST;

if ($affected_CEeliminarpartida == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "El query CEeliminarpartida no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}


?>

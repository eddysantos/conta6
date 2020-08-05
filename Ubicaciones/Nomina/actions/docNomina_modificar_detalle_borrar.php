<?PHP
$query_BORRAR="DELETE FROM conta_t_nom_captura_det WHERE pk_id_partida = ?";

$stmt_BORRAR = $db->prepare($query_BORRAR);
if (!($stmt_BORRAR)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare delete [$db->errno]: $db->error";
  exit_script($system_callback);
}

foreach ($borrar as $borrarPartida) {
  $borrar_idPartida = $borrarPartida['idpartida'];

  if( $borrar_idPartida > 0 ){
    $stmt_BORRAR->bind_param('s',$borrar_idPartida);
    if (!($stmt_BORRAR)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding delete [$stmt_BORRAR->errno]: $stmt_BORRAR->error";
      exit_script($system_callback);
    }

    if (!($stmt_BORRAR->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution delete [$stmt_BORRAR->errno]: $stmt_BORRAR->error";
    }
  }

}
?>

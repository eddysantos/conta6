<?PHP

$query_buscaRef = "SELECT * FROM conta_replica_referencias WHERE pk_referencia = ?";

$stmt_buscaRef = $db->prepare($query_buscaRef);
if (!($stmt_buscaRef)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare buscaRef [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_buscaRef->bind_param('s',$id_referencia);
if (!($stmt_buscaRef)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding buscaRef [$stmt_buscaRef->errno]: $stmt_buscaRef->error";
  exit_script($system_callback);
}
if (!($stmt_buscaRef->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution buscaRef [$stmt_buscaRef->errno]: $stmt_buscaRef->error";
  exit_script($system_callback);
}
$rslt_buscaRef = $stmt_buscaRef->get_result();
$rows_buscaRef = $rslt_buscaRef->num_rows;

if( $rows_buscaRef == 0 ){
  $system_callback['code'] = "1";
  $system_callback['message'] = "La referencia no existe";
  exit_script($system_callback);
}

#USAR COMO SIGUE
// if( $rows_buscaRef > 0 ){
//   $row_buscaRef = $rslt_buscaRef->fetch_assoc();
//   $id_aduanaReferencia = $row_buscaRef['fk_id_aduana'];
// }
?>

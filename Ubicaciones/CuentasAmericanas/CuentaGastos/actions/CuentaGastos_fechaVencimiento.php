<?PHP

$query_diasCredCLT = "SELECT * FROM conta_cs_diasCredito_clientes WHERE fk_id_cliente = ? AND s_credito = 'AME' ";
$stmt_diasCredCLT = $db->prepare($query_diasCredCLT);
if (!($stmt_diasCredCLT)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_diasCredCLT->bind_param('s',$id_cliente);
if (!($stmt_diasCredCLT)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_diasCredCLT->errno]: $stmt_diasCredCLT->error";
  exit_script($system_callback);
}
if (!($stmt_diasCredCLT->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_diasCredCLT->errno]: $stmt_diasCredCLT->error";
  exit_script($system_callback);
}
$rslt_diasCredCLT = $stmt_diasCredCLT->get_result();
$rows_diasCredCLT = $rslt_diasCredCLT->num_rows;

if( $rows_diasCredCLT > 0 ){
  $row_diasCredCLT = $rslt_diasCredCLT->fetch_assoc();
  $n_dias = trim($row_diasCredCLT["n_dias"]);
}







?>

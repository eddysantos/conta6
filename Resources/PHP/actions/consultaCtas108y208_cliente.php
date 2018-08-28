<?PHP
  $query_ctasCliente = "SELECT * from conta_cs_cuentas_mst
                        WHERE (pk_id_cuenta like '0108%' or pk_id_cuenta like '0208%') and
                              s_cta_identificador_tipo = 'cliente' and s_cta_identificador = ?";

  $stmt_ctasCliente = $db->prepare($query_ctasCliente);
  if (!($stmt_ctasCliente)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_ctasCliente->bind_param('s',$id_cliente);
  if (!($stmt_ctasCliente)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_ctasCliente->errno]: $stmt_ctasCliente->error";
    exit_script($system_callback);
  }
  if (!($stmt_ctasCliente->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_ctasCliente->errno]: $stmt_ctasCliente->error";
    exit_script($system_callback);
  }
  $rslt_ctasCliente = $stmt_ctasCliente->get_result();
  $rows_ctasCliente = $rslt_ctasCliente->num_rows;
  

?>

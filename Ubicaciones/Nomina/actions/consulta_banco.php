<?php


$query_banco = "SELECT * FROM conta_cs_sat_bancos where pk_id_banco = '$id_banco'";

$stmt_banco = $db->prepare($query_banco);
if (!($stmt_banco)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
if (!($stmt_banco->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_banco->errno]: $stmt_banco->error";
  exit_script($system_callback);
}


$rslt_banco = $stmt_banco->get_result();
$row_banco = $rslt_banco->fetch_assoc();

$descripcionBanco = $row_banco['s_nombre'];

?>

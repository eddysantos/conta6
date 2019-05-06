<?php
$query_clientes = "SELECT * FROM conta_replica_clientes ORDER BY s_nombre ";

$stmt_clientes = $db->prepare($query_clientes);
if (!($stmt_clientes)) {
$system_callback['code'] = "500";
$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
exit_script($system_callback);
}



if (!($stmt_clientes->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_clientes->errno]: $stmt_clientes->error";
  exit_script($system_callback);
}

$rslt_clientes = $stmt_clientes->get_result();

while ($row_clientes = $rslt_clientes->fetch_assoc()) {

  $clientes .="<option value='$row_clientes[pk_id_cliente]'>$row_clientes[s_nombre]</option>";
}

 ?>

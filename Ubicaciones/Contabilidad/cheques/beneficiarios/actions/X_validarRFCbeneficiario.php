<?php
echo "validar";
$query_CLT = "SELECT * FROM conta_replica_clientes WHERE s_rfc = ?";
$stmt_CLT = $db->prepare($query_CLT);
if (!($stmt_CLT)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare CLT [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_CLT->bind_param('s', $rfc);
if (!($stmt_CLT)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding CLT [$stmt_CLT->errno]: $stmt_CLT->error";
  exit_script($system_callback);
}
if (!($stmt_CLT->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution CLT [$stmt_CLT->errno]: $stmt_CLT->error";
  exit_script($system_callback);
}
$rslt_CLT = $stmt_CLT->get_result();
$rows_CLT = $rslt_CLT->num_rows;
if ($rows_CLT > 0) {
  $row_CLT = $rslt_CLT->fetch_assoc();
  $id_CLT = $row_CLT['pk_id_cliente'];
  $nom_CLT= trim($row_CLT['s_nombre']);
  $system_callback['code'] = "500";
  $system_callback['data'] = "El RFC pertenece a $id_CLT $nom_CLT";
  $system_callback['message'] = "Error RFC pertenece a $id_CLT $nom_CLT [$stmt_CLT->errno]: $stmt_CLT->error";
  exit_script($system_callback);
}


$query_PROV = "SELECT * FROM conta_cs_proveedores WHERE s_rfc = ?";
  $stmt_PROV = $db->prepare($query_PROV);
  if (!($stmt_PROV)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare PROV [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_PROV->bind_param('s', $rfc);
  if (!($stmt_PROV)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding PROV [$stmt_PROV->errno]: $stmt_PROV->error";
    exit_script($system_callback);
  }
  if (!($stmt_PROV->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution PROV [$stmt_PROV->errno]: $stmt_PROV->error";
    exit_script($system_callback);
  }
  $rslt_PROV = $stmt_PROV->get_result();
  $rows_PROV = $rslt_PROV->num_rows;
  if ($rows_PROV > 0) {
    $row_PROV = $rslt_PROV->fetch_assoc();
    $id_PROV = $row_PROV['pk_id_proveedor'];
    $nom_PROV = trim($row_PROV['s_nombre']);
    $system_callback['code'] = "500";
    $system_callback['data'] = "El RFC pertenece a PROV $id_PROV $nom_PROV";
    $system_callback['message'] = "Error RFC pertenece a PROV $id_PROV $nom_PROV [$stmt_PROV->errno]: $stmt_PROV->error";
    exit_script($system_callback);
  }


$query_EMPL = "SELECT * FROM conta_cs_empleados WHERE s_rfc = ?";
  $stmt_EMPL = $db->prepare($query_EMPL);
  if (!($stmt_EMPL)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare EMPL [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_EMPL->bind_param('s', $rfc);
  if (!($stmt_EMPL)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding EMPL [$stmt_EMPL->errno]: $stmt_EMPL->error";
    exit_script($system_callback);
  }
  if (!($stmt_EMPL->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution EMPL [$stmt_EMPL->errno]: $stmt_EMPL->error";
    exit_script($system_callback);
  }
  $rslt_EMPL = $stmt_EMPL->get_result();
  $rows_EMPL = $rslt_EMPL->num_rows;
  if ($rows_EMPL > 0) {
    $row_EMPL = $rslt_EMPL->fetch_assoc();
    $id_EMPL = $row_EMPL['pk_id_empleado'];
    $nom_EMPL = trim($row_EMPL['s_nombre'].' '.$row_EMPL['s_apellidoP'].' '.$row_EMPL['s_apellidoM']);
    $system_callback['code'] = "500";
    $system_callback['data'] = "El RFC pertenece a EMPL $id_EMPL $nom_EMPL";
    $system_callback['message'] = "Error RFC pertenece a EMPL $id_EMPL $nom_EMPL [$stmt_EMPL->errno]: $stmt_EMPL->error";
    exit_script($system_callback);
  }
?>

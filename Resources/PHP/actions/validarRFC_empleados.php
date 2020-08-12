<?php
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

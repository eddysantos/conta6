<?php
  $query_proforma = "SELECT * from conta_t_proforma where fk_referencia = ?";

$stmt_proforma = $db->prepare($query_proforma);
if (!($stmt_proforma)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_proforma->bind_param('s', $id_referencia);
if (!($stmt_proforma)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_proforma->errno]: $stmt_proforma->error";
  exit_script($system_callback);
}

if (!($stmt_proforma->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_proforma->errno]: $stmt_proforma->error";
  exit_script($system_callback);
}

$rslt_proforma = $stmt_proforma->get_result();

while ($row_proforma = $rslt_proforma->fetch_assoc()) {
  $proforma .= "<option value='$row_proforma[pk_id_proforma]'>$row_proforma[pk_id_proforma]</option>";
}

?>

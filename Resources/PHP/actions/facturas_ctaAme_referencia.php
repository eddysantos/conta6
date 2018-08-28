<?php
  $query_ctaAme = "SELECT * from contame_t_facturas where fk_referencia = ?";

$stmt_ctaAme = $db->prepare($query_ctaAme);
if (!($stmt_ctaAme)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_ctaAme->bind_param('s', $id_referencia);
if (!($stmt_ctaAme)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_ctaAme->errno]: $stmt_ctaAme->error";
  exit_script($system_callback);
}

if (!($stmt_ctaAme->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_ctaAme->errno]: $stmt_ctaAme->error";
  exit_script($system_callback);
}

$rslt_ctaAme = $stmt_ctaAme->get_result();

while ($row_ctaAme = $rslt_ctaAme->fetch_assoc()) {
  $facCtaAme .= "<option value='$row_ctaAme[pk_id_ctaAme]'>$row_ctaAme[pk_id_ctaAme]</option>";
}

?>

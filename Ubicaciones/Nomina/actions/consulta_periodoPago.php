<?php


$query_periodopago = "SELECT * FROM conta_cs_sat_periodopago WHERE pk_id_pago = $id_pago";

$stmt_periodopago = $db->prepare($query_periodopago);
if (!($stmt_periodopago)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
if (!($stmt_periodopago->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_periodopago->errno]: $stmt_periodopago->error";
  exit_script($system_callback);
}


$rslt_periodopago = $stmt_periodopago->get_result();
$row_periodopago = $rslt_periodopago->fetch_assoc();

$descripcionPago = $row_periodopago['s_descripcion'];

?>

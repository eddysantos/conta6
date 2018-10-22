<?php

$query_polCtaGastos = "UPDATE conta_t_facturas_ctagastos
                SET fk_idpol_ctagastos = ?,fk_idpol_pagoaplicado = ?
                WHERE fk_id_cuenta_captura = ?";

$stmt_polCtaGastos = $db->prepare($query_polCtaGastos);
if (!($stmt_polCtaGastos)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare polCtaGastos [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_polCtaGastos->bind_param('sss',$poliza_CtaGastos,$polizaAplicado,$cuenta);
if (!($stmt_polCtaGastos)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding polCtaGastos [$stmt_polCtaGastos->errno]: $stmt_polCtaGastos->error";
  exit_script($system_callback);
}

if (!($stmt_polCtaGastos->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution polCtaGastos [$stmt_polCtaGastos->errno]: $stmt_polCtaGastos->error";
  exit_script($system_callback);
}



?>

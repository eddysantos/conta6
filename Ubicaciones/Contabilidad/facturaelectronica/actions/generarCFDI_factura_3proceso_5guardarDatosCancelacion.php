<?php

$query_facCancela = "UPDATE conta_t_facturas_cfdi SET
                                                        fechaTimbradoCancela = ?,
                                                        s_selloSATcancela = ?,
                                                        s_usuario_cancela = ?
                      WHERE s_selloSAT = ?";

$stmt_facCancela = $db->prepare($query_facCancela);
if (!($stmt_facCancela)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare facCancela [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_facCancela->bind_param('ssss',$fechaCancela,$sello,$usuario,$UUID);
if (!($stmt_facCancela)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding facCancela [$stmt_facCancela->errno]: $stmt_facCancela->error";
  exit_script($system_callback);
}

if (!($stmt_facCancela->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution facCancela [$stmt_facCancela->errno]: $stmt_facCancela->error";
  exit_script($system_callback);
}



?>

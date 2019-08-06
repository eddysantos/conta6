<?php

$queryOtrMetodoPago = "INSERT INTO conta_t_polizas_det_contaelec
                              (fk_id_poliza,
                               fk_partidaPol,
                               fk_tipo,
                               s_tipoDetalle,
                              s_MetPagoPol,
                              d_fecha,
                              s_Beneficiario,
                              s_RFC,
                              n_monto,
                              s_moneda,
                              n_TipCamb,
                              s_usuario_modifi)
                              VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";


$stmtOtrMetodoPago = $db->prepare($queryOtrMetodoPago);
if (!($stmtOtrMetodoPago)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$importe = $_POST['importe'];
$moneda = $_POST['moneda'];
$tc = $_POST['tc'];

$stmtOtrMetodoPago->bind_param('ssssssssssss',$fk_id_poliza,
                                        $partidaDoc,
                                        $tipo,
                                        $tipoInf,
                                        $formaPago,
                                        $fecha,
                                        $nombre,
                                        $rfc,
                                        $importe,
                                        $moneda,
                                        $tipoCamb,
                                        $usuario);


if (!($stmtOtrMetodoPago)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding OtrMetodoPago [$stmtOtrMetodoPago->errno]: $stmtOtrMetodoPago->error";
  exit_script($system_callback);
}
if (!($stmtOtrMetodoPago->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution OtrMetodoPago [$stmtOtrMetodoPago->errno]: $stmtOtrMetodoPago->error";
  exit_script($system_callback);
}
?>

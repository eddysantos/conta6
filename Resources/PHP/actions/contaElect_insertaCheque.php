<?php

$queryCHEQUE = "INSERT INTO conta_t_polizas_det_contaelec
                              (fk_id_poliza,
                               fk_partidaPol,
                               fk_tipo,
                               s_tipoDetalle,
                              n_num,
                              s_BancoOri,
                              s_ctaOri,
                              s_BancoOriExt,
                              d_fecha,
                              s_Beneficiario,
                              s_RFC,
                              n_monto,
                              s_moneda,
                              n_TipCamb,
                              s_usuario_modifi)
                              VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";


$stmtCHEQUE = $db->prepare($queryCHEQUE);
if (!($stmtCHEQUE)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtCHEQUE->bind_param('sssssssssssssss',$fk_id_poliza,
                                        $partidaDoc,
                                        $tipo,
                                        $tipoInf,
                                        $cheque,
                                        $idbanco,
                                        $idcta,
                                        $nomExtj,
                                        $fecha,
                                        $beneficiario,
                                        $rfcbenef,
                                        $importe,
                                        $moneda,
                                        $tipoCamb,
                                        $usuario
                                        );


if (!($stmtCHEQUE)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding CHEQUE [$stmtCHEQUE->errno]: $stmtCHEQUE->error";
  exit_script($system_callback);
}
if (!($stmtCHEQUE->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution CHEQUE [$stmtCHEQUE->errno]: $stmtCHEQUE->error";
  exit_script($system_callback);
}
?>

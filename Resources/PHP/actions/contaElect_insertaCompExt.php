<?php

$queryCompExt = "INSERT INTO conta_t_polizas_det_contaelec
                              (fk_id_poliza,
                               fk_partidaPol,
                               fk_tipo,
                               s_tipoDetalle,
                              s_TaxID,
                              s_BeneficiarioOpc,
                              s_NumFactExt,
                              s_moneda,
                              n_TipCamb,
                              n_monto,
                              s_usuario_modifi)
                              VALUES (?,?,?,?,?,?,?,?,?,?,?)";


$stmtCompExt = $db->prepare($queryCompExt);
if (!($stmtCompExt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtCompExt->bind_param('sssssssssss',$fk_id_poliza,
                                        $partidaDoc,
                                        $tipo,
                                        $tipoInf,
                                        $tax,
                                        $razsocial,
                                        $fact,
                                        $moneda,
                                        $tipoCamb,
                                        $importe,
                                        $usuario);


if (!($stmtCompExt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding CompExt [$stmtCompExt->errno]: $stmtCompExt->error";
  exit_script($system_callback);
}
if (!($stmtCompExt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution CompExt [$stmtCompExt->errno]: $stmtCompExt->error";
  exit_script($system_callback);
}
?>

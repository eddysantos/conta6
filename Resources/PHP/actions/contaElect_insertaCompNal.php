<?PHP

$queryCOMPNAL = "INSERT INTO conta_t_polizas_det_contaelec
                              (fk_id_poliza,
                               fk_partidaPol,
                               fk_tipo,
                               s_tipoDetalle,
                               s_UUID_CFDI,
                               s_RFC,
                               n_monto,
                               s_BeneficiarioOpc,
                               s_usuario_modifi,
                               s_moneda,
                               n_TipCamb)
                              VALUES (?,?,?,?,?,?,?,?,?,?,?)";
$stmtCOMPNAL = $db->prepare($queryCOMPNAL);
if (!($stmtCOMPNAL)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtCOMPNAL->bind_param('sssssssssss',$fk_id_poliza,
                                        $partidaDoc,
                                        $tipo,
                                        $tipoInf,
                                        $UUID,
                                        $RFC,
                                        $importe,
                                        $beneficiarioOpc,
                                        $usuario,
                                        $moneda,
                                        $tipoCamb);

if (!($stmtCOMPNAL)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding COMPNAL [$stmtCOMPNAL->errno]: $stmtCOMPNAL->error";
  exit_script($system_callback);
}
if (!($stmtCOMPNAL->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution COMPNAL [$stmtCOMPNAL->errno]: $stmtCOMPNAL->error";
  exit_script($system_callback);
}
$rsltCOMPNAL = $stmtCOMPNAL->get_result();

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>

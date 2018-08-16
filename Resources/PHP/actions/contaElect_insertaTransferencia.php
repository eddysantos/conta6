<?PHP
/*
//VARIABLES A USAR
$fk_id_poliza
$partidaPol
$tipo
$tipoDetalle
$ctaOri
$BancoOri
$BancoOriExt
$CtaDest
$BancoDest
$BancoDestExt
$fecha
$Beneficiario
$RFC
$monto
$moneda
$TipCamb
$BeneficiarioOpc
$RFCopc
$usuario_modifi
*/

$queryTRANSFER = "INSERT INTO conta_t_polizas_det_contaelec
                              (fk_id_poliza,fk_partidaPol,fk_tipo,s_tipoDetalle,
                              s_ctaOri,s_BancoOri,s_BancoOriExt,
                              s_CtaDest,s_BancoDest,s_BancoDestExt,
                              d_fecha,s_Beneficiario,s_RFC,
                              n_monto,s_moneda,n_TipCamb,
                              s_BeneficiarioOpc,s_RFCopc,
                              s_usuario_modifi)
                              VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$stmtTRANSFER = $db->prepare($queryTRANSFER);
if (!($stmtTRANSFER)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtTRANSFER->bind_param('sssssssssssssssssss',$fk_id_poliza,
                                                $partidaPol,
                                                $tipo,
                                                $tipoDetalle,
                                                $ctaOri,
                                                $BancoOri,
                                                $BancoOriExt,
                                                $CtaDest,
                                                $BancoDest,
                                                $BancoDestExt,
                                                $fecha,
                                                $Beneficiario,
                                                $RFC,
                                                $monto,
                                                $moneda,
                                                $TipCamb,
                                                $BeneficiarioOpc,
                                                $RFCopc,
                                                $usuario_modifi);

if (!($stmtTRANSFER)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmtTRANSFER->errno]: $stmtTRANSFER->error";
  exit_script($system_callback);
}
if (!($stmtTRANSFER->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmtTRANSFER->errno]: $stmtTRANSFER->error";
  exit_script($system_callback);
}
$rsltTRANSFER = $stmtTRANSFER->get_result();
?>

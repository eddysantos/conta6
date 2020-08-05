<?PHP

$query_UPDATEtotal="UPDATE conta_t_nom_captura_det SET
                                                s_tipo_incapacidad	= ?,
                                                n_dias_incapacidad	= ?,
                                                n_dias_incapacidad_dscto	= ?,
                                                n_dias_incapacidad_pgo	= ?,
                                                n_dias_vacaciones	= ?,
                                                n_dias_faltas	= ?,
                                                n_dias_pagar = ?,
                                                n_totalPercepciones	= ?,
                                                n_totalDeducciones	= ?,
                                                n_totalOtrosPagos	= ?,
                                                n_total	= ?,
                                                n_totalNeto	= ?,
                                                n_numAniosServicio = ?,
                                                n_ultimoSueldoMensOrd = ?,
                                                n_ingresoAcumulable = ?,
                                                n_ingresoNoAcumulable = ?,
                                                n_totalPagado = ?
                                          WHERE fk_id_docNomina = ? and s_tipoElemento = 'totales' ";



$stmt_UPDATEtotal = $db->prepare($query_UPDATEtotal);
if (!($stmt_UPDATEtotal)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare ACTUALIZARTOTALES [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_UPDATEtotal->bind_param('ssssssssssssssssss',
                                                            $tipo,
                                                            $indias,
                                                            $indescontar,
                                                            $inpagar,
                                                            $totvacaciones,
                                                            $totfaltas,
                                                            $totpagar,
                                                            $totpercep,
                                                            $totdeduc,
                                                            $tototrospagos,
                                                            $tottotal,
                                                            $totneto,
                                                            $numAniosServicio,
                                                            $ultimoSueldoMensOrd,
                                                            $ingresoAcumulable,
                                                            $ingresoNoAcumulable,
                                                            $totalPagado,
                                                            $idDocNomina);

$system_callback['message2'] = $tipo.','.
$indias.','.
$indescontar.','.
$inpagar.','.
$totvacaciones.','.
$totfaltas.','.
$totpagar.','.
$totpercep.','.
$totdeduc.','.
$tototrospagos.','.
$tottotal.','.
$totneto.','.
$numAniosServicio.','.
$ultimoSueldoMensOrd.','.
$ingresoAcumulable.','.
$ingresoNoAcumulable.','.
$totalPagado.','.
$idDocNomina;



if (!($stmt_UPDATEtotal)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding ACTUALIZARTOTALES [$stmt_UPDATEtotal->errno]: $stmt_UPDATEtotal->error";
  exit_script($system_callback);
}

if (!($stmt_UPDATEtotal->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution ACTUALIZARTOTALES [$stmt_UPDATEtotal->errno]: $stmt_UPDATEtotal->error";
  //exit_script($system_callback);
}

?>

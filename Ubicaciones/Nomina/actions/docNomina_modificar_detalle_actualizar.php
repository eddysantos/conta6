<?PHP
$query_UPDATE="UPDATE conta_t_nom_captura_det SET
                                                s_concepto	= ?,
                                                n_importeGravado	= ?,
                                                n_importeExento	= ?,
                                                n_subsidioCausado = ?,
                                                s_anio	= ?,
                                                n_remanenteSalFav	= ?,
                                                n_dias_incapacidad	= ?,
                                                s_tipo_incapacidad	= ?,
                                                n_dias_incapacidad_pgo	= ?,
                                                n_dias_incapacidad_dscto	= ?,
                                                n_dias_vacaciones	= ?,
                                                n_PprimVacE	= ?,
                                                n_PprimVacG	= ?,
                                                n_dias_faltas	= ?,
                                                n_dias_pagar	= ?,
                                                s_tipoHoras	= ?,
                                                n_dias_horasExtra	= ?,
                                                n_horasExtra	= ?,
                                                n_importePagado	= ?,
                                                n_base	= ?,
                                                n_porcentaje	= ?,
                                                n_descuento	= ?,
                                                n_numAniosServicio	= ?,
                                                n_ultimoSueldoMensOrd	= ?,
                                                n_ingresoAcumulable	= ?,
                                                n_ingresoNoAcumulable	= ?,
                                                n_totalPagado	= ?,
                                                n_totalPercepciones	= ?,
                                                n_totalDeducciones	= ?,
                                                n_totalOtrosPagos	= ?,
                                                n_total	= ?,
                                                n_totalNeto	= ?
                                          WHERE pk_id_partida = ?";

$stmt_UPDATE = $db->prepare($query_UPDATE);
if (!($stmt_UPDATE)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare ACTUALIZAR [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_UPDATE->bind_param('sssssssssssssssssssssssssssssssss', $concepto,
                                                            $importeGravado,
                                                            $importeExento,
                                                            $subsidioCausado,
                                                            $anio,
                                                            $remanenteSalFav,
                                                            $dias_incapacidad,
                                                            $tipo_incapacidad,
                                                            $dias_incapacidad_pgo,
                                                            $dias_incapacidad_dscto,
                                                            $dias_vacaciones,
                                                            $PprimVacE,
                                                            $PprimVacG,
                                                            $dias_faltas,
                                                            $dias_pagar,
                                                            $tipoHoras,
                                                            $dias_horasExtra,
                                                            $horasExtra,
                                                            $importePagado,
                                                            $base,
                                                            $porcentaje,
                                                            $descuento,
                                                            $numAniosServicio,
                                                            $ultimoSueldoMensOrd,
                                                            $ingresoAcumulable,
                                                            $ingresoNoAcumulable,
                                                            $totalPagado,
                                                            $totalPercepciones,
                                                            $totalDeducciones,
                                                            $totalOtrosPagos,
                                                            $total,
                                                            $totalNeto,
                                                            $idpartida);



if (!($stmt_UPDATE)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding ACTUALIZAR [$stmt_UPDATE->errno]: $stmt_UPDATE->error";
  exit_script($system_callback);
}

if (!($stmt_UPDATE->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution ACTUALIZAR [$stmt_UPDATE->errno]: $stmt_UPDATE->error";
  //exit_script($system_callback);
}

?>

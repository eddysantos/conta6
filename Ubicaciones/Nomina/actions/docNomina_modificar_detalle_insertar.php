<?PHP

$query_INSERTAR="INSERT INTO  conta_t_nom_captura_det(  fk_id_docNomina,
                                                        s_tipoElemento,
                                                        fk_claveSAT,
                                                        fk_id_cuenta,
                                                        n_ordenReporte,
                                                        s_clasificacion,
                                                        s_concepto	,
                                                        n_importeGravado	,
                                                        n_importeExento	,
                                                        n_subsidioCausado,
                                                        s_anio	,
                                                        n_remanenteSalFav	,
                                                        n_dias_incapacidad	,
                                                        s_tipo_incapacidad	,
                                                        n_dias_incapacidad_pgo	,
                                                        n_dias_incapacidad_dscto	,
                                                        n_dias_vacaciones	,
                                                        n_PprimVacE	,
                                                        n_PprimVacG	,
                                                        n_dias_faltas	,
                                                        n_dias_pagar	,
                                                        n_dias_horasExtra	,
                                                        n_horasExtra,
                                                        s_tipoHoras,
                                                        n_importePagado	,
                                                        n_base	,
                                                        n_porcentaje	,
                                                        n_descuento	,
                                                        n_numAniosServicio	,
                                                        n_ultimoSueldoMensOrd,
                                                        n_ingresoAcumulable	,
                                                        n_ingresoNoAcumulable	,
                                                        n_totalPagado	,
                                                        n_totalPercepciones	,
                                                        n_totalDeducciones	,
                                                        n_totalOtrosPagos	,
                                                        n_total	,
                                                        n_totalNeto	)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";


$stmt_INSERTAR = $db->prepare($query_INSERTAR);
if (!($stmt_INSERTAR)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare INSERTAR [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_INSERTAR->bind_param('ssssssssssssssssssssssssssssssssssssss',
                                                            $idDocNomina,
                                                            $tipoElemento,
                                                            $cve,
                                                            $cta,
                                                            $ordenRep,
                                                            $clasificacion,
                                                            $concepto,
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
                                                            $dias_horasExtra,
                                                            $horasExtra,
                                                            $tipoHoras,
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
                                                            $totalNeto);


if (!($stmt_INSERTAR)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding INSERTAR [$stmt_INSERTAR->errno]: $stmt_INSERTAR->error";
  exit_script($system_callback);
}

if (!($stmt_INSERTAR->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution INSERTAR [$stmt_INSERTAR->errno]: $stmt_INSERTAR->error";
  //exit_script($system_callback);
}

?>

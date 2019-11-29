<?php

$query_genDoc = "INSERT INTO conta_t_nom_captura (
                                            fk_id_aduana,
                                            s_tipoNomina,
                                            s_descNomina,
                                            n_semana,
                                            n_anio,
                                            fk_id_empleado,
                                            fk_id_regimen,
                                            d_fechaPago,
                                            d_fechaInicio,
                                            d_fechaFinal,
                                            n_numDiasPagados,
                                            n_salarioBaseCotApor,
                                            n_salarioDiarioIntegrado,
                                            n_valor_unitario,
                                            n_importe,
                                            s_Reg_Patronal,
                                            fk_usuario_docNomina,
                                            s_nombre,
                                            s_apellidoP,
                                            s_apellidoM,
                                            s_RFC,
                                            s_CURP,
                                            fk_id_banco,
                                            s_CLABE,
                                            s_puesto_actividad,
                                            fk_id_contrato,
                                            fk_id_jornada,
                                            pk_id_pago,
                                            fk_c_estado_entFed,
                                            s_departamento,
                                            fk_id_riesgo,
                                            d_FechaInicioRelLaboral,
                                            mesCorresponde
                                          )
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt_genDoc = $db->prepare($query_genDoc);
if (!($stmt_genDoc)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_genDoc->bind_param('sssssssssssssssssssssssssssssssss',
                                              $aduana,
                                              $tipoNomina,
                                              $descNomina,
                                              $NUM_NOMINA,
                                              $anio,
                                              $id_empleado,
                                              $id_regimen,
                                              $fechaPago,
                                              $FECHAINICIO,
                                              $FECHAFINAL,
                                              $DIAS_PAGAR,
                                              $SALARIO_SEMANAL,
                                              $SALARIO_SEMANAL,
                                              $TOTAL,
                                              $TOTAL,
                                              $regPatronalCIA,
                                              $usuario,
                                              $nombre,
                                              $apellidoP,
                                              $apellidoM,
                                              $rfc,
                                              $curp,
                                              $id_banco,
                                              $cta_banco,
                                              $puesto,
                                              $id_contrato,
                                              $id_jornada,
                                              $id_pago,
                                              $id_entfed,
                                              $nom_depto,
                                              $id_riesgo,
                                              $fechaContrato,
                                              $mesCorresponde
                                              );

if (!($stmt_genDoc)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_genDoc->errno]: $stmt_genDoc->error";
  exit_script($system_callback);
}

if (!($stmt_genDoc->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_genDoc->errno]: $stmt_genDoc->error";
  exit_script($system_callback);
}


?>

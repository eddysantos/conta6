<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';


$pk_id_empleado = $_POST['pk_id_empleado'];
$s_nombre = $_POST['s_nombre'];
$s_apellidoP = $_POST['s_apellidoP'];
$s_apellidoM = $_POST['s_apellidoM'];
$d_fechaNacido = $_POST['d_fechaNacido'];
$s_CURP = $_POST['s_CURP'];
$s_RFC = $_POST['s_RFC'];
$s_telefono = $_POST['s_telefono'];
$s_email_personal = $_POST['s_email_personal'];
$s_calle = $_POST['s_calle'];
$s_no_ext = $_POST['s_no_ext'];
$s_no_int = $_POST['s_no_int'];
$s_colonia = $_POST['s_colonia'];
$s_localidad = $_POST['s_localidad'];
$s_municipio = $_POST['s_municipio'];
$s_estado = $_POST['s_estado'];
$s_codigo = $_POST['s_codigo'];
$s_id_entfed = $_POST['s_id_entfed'];
$fk_id_formapago = $_POST['fk_id_formapago'];
$s_cta_banco = $_POST['s_cta_banco'];
$fk_id_banco = $_POST['fk_id_banco'];
$fk_id_aduana = $_POST['fk_id_aduana'];
$fk_id_depto = $_POST['fk_id_depto'];
$s_puesto_actividad = $_POST['s_puesto_actividad'];
$d_fechaContrato = $_POST['d_fechaContrato'];
$fk_id_contrato = $_POST['fk_id_contrato'];
$fk_id_jornada = $_POST['fk_id_jornada'];
$fk_id_riesgo = $_POST['fk_id_riesgo'];
$fk_id_pago = $_POST['fk_id_pago'];
$fk_id_regimen = $_POST['fk_id_regimen'];
$s_email_laboral = $_POST['s_email_laboral'];
$s_observaciones = $_POST['s_observaciones'];
$s_activo = $_POST['s_activo'];
$d_fechaBaja = $_POST['d_fechaBaja'];
$s_pagar = $_POST['s_pagar'];
$fk_usuario_modifi = $_SESSION['user']['pk_usuario'];
$d_fecha_modifi = date("Y-m-d H:i:s",time());
$n_salario_AER = $_POST['n_salario_AER'];
$n_salario_MAN = $_POST['n_salario_MAN'];
$n_salario_NL = $_POST['n_salario_NL'];
$n_salario_VER = $_POST['n_salario_VER'];
$n_salario_LTX = $_POST['n_salario_LTX'];
$s_IMSS = $_POST['s_IMSS'];
$s_INFONAVIT = $_POST['s_INFONAVIT'];
$n_desc_infonavit_porcent = $_POST['n_desc_infonavit_porcent'];
$n_desc_infonavit_cuota = $_POST['n_desc_infonavit_cuota'];
$n_desc_infonavit_VSM = $_POST['n_desc_infonavit_VSM'];
$n_salario_mensual = $_POST['n_salario_mensual'];
$n_salario_semanal = $_POST['n_salario_semanal'];
$n_factor_integracion = $_POST['n_factor_integracion'];
$n_cuota_integral_salario = $_POST['n_cuota_integral_salario'];
$n_salario_integrado = $_POST['n_salario_integrado'];
$n_ISR = $_POST['n_ISR'];

// permanentes
$s_incapacidad_pgo = $_POST['s_incapacidad_pgo'];
$n_incapacidad_dias = $_POST['n_incapacidad_dias'];
$fk_tipoIncapacidad = $_POST['fk_tipoIncapacidad'];
$s_valesDespensa_pgo = $_POST['s_valesDespensa_pgo'];
$n_valesDespensa_dias = $_POST['n_valesDespensa_dias'];
$n_compensacion = $_POST['n_compensacion'];
$s_ayudaRenta_pgo = $_POST['s_ayudaRenta_pgo'];
$n_ayudaRenta = $_POST['n_ayudaRenta'];
$s_subsidioPago = $_POST['s_subsidioPago'];
$n_vacaciones_dias = $_POST['n_vacaciones_dias'];
$s_vacPrim_Pgo = $_POST['s_vacPrim_Pgo'];
$n_vacPrim_dias = $_POST['n_vacPrim_dias'];
$n_faltas_dias = $_POST['n_faltas_dias'];
$s_asistencia_pgo = $_POST['s_asistencia_pgo'];
$s_puntualidad_pgo = $_POST['s_puntualidad_pgo'];
$s_aguinaldo_Pgo = $_POST['s_aguinaldo_Pgo'];
$n_aguinaldo_dias = $_POST['n_aguinaldo_dias'];
$s_prestamoCta = $_POST['s_prestamoCta'];
$s_prestamo_pgo = $_POST['s_prestamo_pgo'];
$n_prestamo = $_POST['n_prestamo'];
$n_hrsExtra_dobles_dias = $_POST['n_hrsExtra_dobles_dias'];
$n_hrsExtra_dobles = $_POST['n_hrsExtra_dobles'];
$n_hrsExtra_triples_dias = $_POST['n_hrsExtra_triples_dias'];
$n_hrsExtra_triples = $_POST['n_hrsExtra_triples'];
$n_hrsExtra_simples_dias = $_POST['n_hrsExtra_simples_dias'];
$n_hrsExtra_simples = $_POST['n_hrsExtra_simples'];
$n_desc_descuentos = $_POST['n_desc_descuentos'];
$n_desc_prestamo = $_POST['n_desc_prestamo'];
$n_desc_infonavit = $_POST['n_desc_infonavit'];
$n_desc_fonacot = $_POST['n_desc_fonacot'];
$s_desc_renta_pgo = $_POST['s_desc_renta_pgo'];
$n_desc_renta = $_POST['n_desc_renta'];
$s_desc_pensionAlim_pago = $_POST['s_desc_pensionAlim_pago'];
$n_desc_pensionAlim_porcent = $_POST['n_desc_pensionAlim_porcent'];
$s_desc_pensionAlim_otorgado = $_POST['s_desc_pensionAlim_otorgado'];
$s_desc_pensionAlim_entregado = $_POST['s_desc_pensionAlim_entregado'];






$query = "UPDATE conta_t_nom_empleados SET s_nombre = ?,
                                           s_apellidoP = ?,
                                           s_apellidoM = ?,
                                           d_fechaNacido = ?,
                                           s_CURP = ?,
                                           s_RFC = ?,
                                           s_telefono = ?,
                                           s_email_personal = ?,
                                           s_calle = ?,
                                           s_no_ext = ?,
                                           s_no_int = ?,
                                           s_colonia = ?,
                                           s_localidad = ?,
                                           s_municipio = ?,
                                           s_estado = ?,
                                           s_codigo = ?,
                                           s_id_entfed = ?,
                                           fk_id_formapago = ?,
                                           s_cta_banco = ?,
                                           fk_id_banco = ?,
                                           fk_id_aduana = ?,
                                           fk_id_depto = ?,
                                           s_puesto_actividad = ?,
                                           d_fechaContrato = ?,
                                           fk_id_contrato = ?,
                                           fk_id_jornada = ?,
                                           fk_id_riesgo = ?,
                                           fk_id_pago = ?,
                                           fk_id_regimen = ?,
                                           s_email_laboral = ?,
                                           s_observaciones = ?,
                                           s_activo = ?,
                                           d_fechaBaja = ?,
                                           s_pagar = ?,
                                           fk_usuario_modifi = ?,
                                           d_fecha_modifi = ?,
                                           n_salario_AER = ?,
                                           n_salario_MAN = ?,
                                           n_salario_NL = ?,
                                           n_salario_VER = ?,
                                           n_salario_LTX = ?,
                                           s_IMSS = ?,
                                           s_INFONAVIT = ?,
                                           n_desc_infonavit_porcent = ?,
                                           n_desc_infonavit_cuota = ?,
                                           n_desc_infonavit_VSM = ?,
                                           n_salario_mensual = ?,
                                           n_salario_semanal = ?,
                                           n_factor_integracion = ?,
                                           n_cuota_integral_salario = ?,
                                           n_salario_integrado = ?,
                                           n_ISR = ?,
                                           s_incapacidad_pgo = ?,
                                           n_incapacidad_dias = ?,
                                           fk_tipoIncapacidad = ?,
                                           s_valesDespensa_pgo = ?,
                                           n_valesDespensa_dias = ?,
                                           n_compensacion = ?,
                                           s_ayudaRenta_pgo = ?,
                                           n_ayudaRenta = ?,
                                           s_subsidioPago = ?,
                                           n_vacaciones_dias = ?,
                                           s_vacPrim_Pgo = ?,
                                           n_vacPrim_dias = ?,
                                           n_faltas_dias = ?,
                                           s_asistencia_pgo = ?,
                                           s_puntualidad_pgo = ?,
                                           s_aguinaldo_Pgo = ?,
                                           n_aguinaldo_dias = ?,
                                           s_prestamoCta = ?,
                                           s_prestamo_pgo = ?,
                                           n_prestamo = ?,
                                           n_hrsExtra_dobles_dias = ?,
                                           n_hrsExtra_dobles = ?,
                                           n_hrsExtra_triples_dias = ?,
                                           n_hrsExtra_triples = ?,
                                           n_hrsExtra_simples_dias = ?,
                                           n_hrsExtra_simples =?,
                                           n_desc_descuentos = ?,
                                           n_desc_prestamo = ?,
                                           n_desc_infonavit = ?,
                                           n_desc_fonacot = ?,
                                           s_desc_renta_pgo = ?,
                                           n_desc_renta = ?,
                                           s_desc_pensionAlim_pago = ?,
                                           n_desc_pensionAlim_porcent =?,
                                           s_desc_pensionAlim_otorgado = ?,
                                           s_desc_pensionAlim_entregado = ?
                                      WHERE pk_id_empleado= ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}


$stmt->bind_param('sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
$s_nombre,
$s_apellidoP,
$s_apellidoM,
$d_fechaNacido,
$s_CURP,
$s_RFC,
$s_telefono,
$s_email_personal,
$s_calle,
$s_no_ext,
$s_no_int,
$s_colonia,
$s_localidad,
$s_municipio,
$s_estado,
$s_codigo,
$s_id_entfed,
$fk_id_formapago,
$s_cta_banco,
$fk_id_banco,
$fk_id_aduana,
$fk_id_depto,
$s_puesto_actividad,
$d_fechaContrato,
$fk_id_contrato,
$fk_id_jornada,
$fk_id_riesgo,
$fk_id_pago,
$fk_id_regimen,
$s_email_laboral,
$s_observaciones,
$s_activo,
$d_fechaBaja,
$s_pagar,
$fk_usuario_modifi,
$d_fecha_modifi,
$n_salario_AER,
$n_salario_MAN,
$n_salario_NL,
$n_salario_VER,
$n_salario_LTX,
$s_IMSS,
$s_INFONAVIT,
$n_desc_infonavit_porcent,
$n_desc_infonavit_cuota,
$n_desc_infonavit_VSM,
$n_salario_mensual,
$n_salario_semanal,
$n_factor_integracion,
$n_cuota_integral_salario,
$n_salario_integrado,
$n_ISR,
$s_incapacidad_pgo,
$n_incapacidad_dias,
$fk_tipoIncapacidad,
$s_valesDespensa_pgo,
$n_valesDespensa_dias,
$n_compensacion,
$s_ayudaRenta_pgo,
$n_ayudaRenta,
$s_subsidioPago,
$n_vacaciones_dias,
$s_vacPrim_Pgo,
$n_vacPrim_dias,
$n_faltas_dias,
$s_asistencia_pgo,
$s_puntualidad_pgo,
$s_aguinaldo_Pgo,
$n_aguinaldo_dias,
$s_prestamoCta,
$s_prestamo_pgo,
$n_prestamo,
$n_hrsExtra_dobles_dias,
$n_hrsExtra_dobles,
$n_hrsExtra_triples_dias,
$n_hrsExtra_triples,
$n_hrsExtra_simples_dias,
$n_hrsExtra_simples,
$n_desc_descuentos,
$n_desc_prestamo,
$n_desc_infonavit,
$n_desc_fonacot,
$s_desc_renta_pgo,
$n_desc_renta,
$s_desc_pensionAlim_pago,
$n_desc_pensionAlim_porcent,
$s_desc_pensionAlim_otorgado,
$s_desc_pensionAlim_entregado,
$pk_id_empleado);

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$affected = $stmt->affected_rows;
$system_callback['affected'] = $affected;
$system_callback['datos'] = $_POST;

if ($affected == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "El query no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}


$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>

<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';


$s_nombre_add = $_POST['s_nombre_add'];
$s_apellidoP_add = $_POST['s_apellidoP_add'];
$s_apellidoM_add = $_POST['s_apellidoM_add'];
$d_fechaNacido_add = $_POST['d_fechaNacido_add'];
$s_CURP_add = $_POST['s_CURP_add'];
$s_RFC_add = $_POST['s_RFC_add'];
$s_telefono_add = $_POST['s_telefono_add'];
$s_email_personal_add = $_POST['s_email_personal_add'];
$s_calle_add = $_POST['s_calle_add'];
$s_no_ext_add = $_POST['s_no_ext_add'];
$s_no_int_add = $_POST['s_no_int_add'];
$s_colonia_add = $_POST['s_colonia_add'];
$s_localidad_add = $_POST['s_localidad_add'];
$s_municipio_add = $_POST['s_municipio_add'];
$s_estado_add = $_POST['s_estado_add'];
$s_fk_c_pais_add = $_POST['s_fk_c_pais_add'];
$s_codigo_add = $_POST['s_codigo_add'];
$s_id_entfed_add = $_POST['s_id_entfed_add'];
$fk_id_formapago_add = $_POST['fk_id_formapago_add'];
$s_cta_banco_add = $_POST['s_cta_banco_add'];
$fk_id_banco_add = $_POST['fk_id_banco_add'];
$fk_id_aduana_add = $_POST['fk_id_aduana_add'];
$fk_id_depto_add = $_POST['fk_id_depto_add'];
$s_puesto_actividad_add = $_POST['s_puesto_actividad_add'];
$d_fechaContrato_add = $_POST['d_fechaContrato_add'];
$fk_id_contrato_add = $_POST['fk_id_contrato_add'];
$fk_id_jornada_add = $_POST['fk_id_jornada_add'];
$fk_id_riesgo_add = $_POST['fk_id_riesgo_add'];
$fk_id_pago_add = $_POST['fk_id_pago_add'];
$fk_id_regimen_add = $_POST['fk_id_regimen_add'];
$s_email_laboral_add = $_POST['s_email_laboral_add'];
$s_observaciones_add = $_POST['s_observaciones_add'];
$s_activo_add = $_POST['s_activo_add'];
$d_fechaBaja_add = $_POST['d_fechaBaja_add'];
$s_pagar_add = $_POST['s_pagar_add'];
$fk_usuario_alta_add = $_POST['fk_usuario_alta_add'];
$d_fecha_alta_add = $_POST['d_fecha_alta_add'];
$n_salario_AER_add = $_POST['n_salario_AER_add'];
$n_salario_MAN_add = $_POST['n_salario_MAN_add'];
$n_salario_NL_add = $_POST['n_salario_NL_add'];
$n_salario_VER_add = $_POST['n_salario_VER_add'];
$n_salario_LTX_add = $_POST['n_salario_LTX_add'];
$s_IMSS_add = $_POST['s_IMSS_add'];
$s_INFONAVIT_add = $_POST['s_INFONAVIT_add'];
$n_desc_infonavit_porcent_add = $_POST['n_desc_infonavit_porcent_add'];
$n_desc_infonavit_cuota_add = $_POST['n_desc_infonavit_cuota_add'];
$n_desc_infonavit_VSM_add = $_POST['n_desc_infonavit_VSM_add'];
$n_salario_mensual_add = $_POST['n_salario_mensual_add'];
$n_salario_semanal_add = $_POST['n_salario_semanal_add'];
$n_factor_integracion_add = $_POST['n_factor_integracion_add'];
$n_cuota_integral_salario_add = $_POST['n_cuota_integral_salario_add'];
$n_salario_integrado_add = $_POST['n_salario_integrado_add'];
$n_ISR_add = $_POST['n_ISR_add'];



$query = "INSERT INTO conta_t_nom_empleados (s_nombre,
                                             s_apellidoP,
                                             s_apellidoM,
                                             d_fechaNacido,
                                             s_CURP,
                                             s_RFC,
                                             s_telefono,
                                             s_email_personal,
                                             s_calle,
                                             s_no_ext,
                                             s_no_int,
                                             s_colonia,
                                             s_localidad,
                                             s_municipio,
                                             s_estado,
                                             s_fk_c_pais,
                                             s_codigo,
                                             s_id_entfed,
                                             fk_id_formapago,
                                             s_cta_banco,
                                             fk_id_banco,
                                             fk_id_aduana,
                                             fk_id_depto,
                                             s_puesto_actividad,
                                             d_fechaContrato,
                                             fk_id_contrato,
                                             fk_id_jornada,
                                             fk_id_riesgo,
                                             fk_id_pago,
                                             fk_id_regimen,
                                             s_email_laboral,
                                             s_observaciones,
                                             s_activo,
                                             d_fechaBaja,
                                             s_pagar,
                                             fk_usuario_alta,
                                             d_fecha_alta,
                                             n_salario_AER,
                                             n_salario_MAN,
                                             n_salario_VER,
                                             n_salario_NL,
                                             n_salario_LTX,
                                             s_IMSS,
                                             s_INFONAVIT,
                                             n_desc_infonavit_porcent,
                                             n_desc_infonavit_cuota,
                                             n_desc_infonavit_VSM,
                                             n_salario_mensual,
                                             n_salario_semanal,
                                             n_factor_integracion,
                                             n_cuota_integral_salario,
                                             n_salario_integrado,
                                             n_ISR
                                           )values(?,?,?,?,?,?,?,?,?,?,
                                                   ?,?,?,?,?,?,?,?,?,?,
                                                   ?,?,?,?,?,?,?,?,?,?,
                                                   ?,?,?,?,?,?,?,?,?,?,
                                                   ?,?,?,?,?,?,?,?,?,?,
                                                   ?,?,?)";


$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('sssssssssssssssssssssssssssssssssssssssssssssssssssss',$s_nombre_add,
                                                                         $s_apellidoP_add,
                                                                         $s_apellidoM_add,
                                                                         $d_fechaNacido_add,
                                                                         $s_CURP_add,
                                                                         $s_RFC_add,
                                                                         $s_telefono_add,
                                                                         $s_email_personal_add,
                                                                         $s_calle_add,
                                                                         $s_no_ext_add,
                                                                         $s_no_int_add,
                                                                         $s_colonia_add,
                                                                         $s_localidad_add,
                                                                         $s_municipio_add,
                                                                         $s_estado_add,
                                                                         $s_fk_c_pais_add,
                                                                         $s_codigo_add,
                                                                         $s_id_entfed_add,
                                                                         $fk_id_formapago_add,
                                                                         $s_cta_banco_add,
                                                                         $fk_id_banco_add,
                                                                         $fk_id_aduana_add,
                                                                         $fk_id_depto_add,
                                                                         $s_puesto_actividad_add,
                                                                         $d_fechaContrato_add,
                                                                         $fk_id_contrato_add,
                                                                         $fk_id_jornada_add,
                                                                         $fk_id_riesgo_add,
                                                                         $fk_id_pago_add,
                                                                         $fk_id_regimen_add,
                                                                         $s_email_laboral_add,
                                                                         $s_observaciones_add,
                                                                         $s_activo_add,
                                                                         $d_fechaBaja_add,
                                                                         $s_pagar_add,
                                                                         $fk_usuario_alta_add,
                                                                         $d_fecha_alta_add,
                                                                         $n_salario_AER_add,
                                                                         $n_salario_MAN_add,
                                                                         $n_salario_NL_add,
                                                                         $n_salario_VER_add,
                                                                         $n_salario_LTX_add,
                                                                         $s_IMSS_add,
                                                                         $s_INFONAVIT_add,
                                                                         $n_desc_infonavit_porcent_add,
                                                                         $n_desc_infonavit_cuota_add,
                                                                         $n_desc_infonavit_VSM_add,
                                                                         $n_salario_mensual_add,
                                                                         $n_salario_semanal_add,
                                                                         $n_factor_integracion_add,
                                                                         $n_cuota_integral_salario_add,
                                                                         $n_salario_integrado_add,
                                                                         $n_ISR_add);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

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

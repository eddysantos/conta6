<?php

$query_extraer_conceptosFactura = "INSERT INTO conta_tem_tarifas_calculodetalle
            (fk_id_tarifa,s_seccion,n_cantidad,fk_c_ClaveProdServ,fk_id_cuenta,fk_c_claveUnidad,s_unidad,fk_id_concepto,s_descripcion,s_conceptoEnglish,n_importe,n_IVA,n_ret,n_total)
SELECT $calculoTarifa,s_tipoDetalle,n_cantidad,fk_c_ClaveProdServ,fk_id_cuenta,fk_c_claveUnidad,s_unidad,fk_id_concepto,s_conceptoEsp,s_conceptoEnglish,n_importe,n_IVA,n_ret,n_total
                                FROM conta_t_facturas_captura_det
                                WHERE (s_tipoDetalle = 'honorarios')
                                      AND fk_id_cuenta_captura = $cuenta
                                ORDER BY pk_id_partida";


$stmt_extraer_conceptosFactura = $db->prepare($query_extraer_conceptosFactura);
if (!($stmt_extraer_conceptosFactura)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare extraer_conceptosFactura [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_extraer_conceptosFactura->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution extraer_conceptosFactura [$stmt_extraer_conceptosFactura->errno]: $stmt_extraer_conceptosFactura->error";
  exit_script($system_callback);
}


$query_extraer_conceptosFactura_update = "UPDATE conta_tem_tarifas_calculodetalle SET s_seccion = 'cliente' where fk_id_tarifa =$calculoTarifa and s_seccion ='honorarios'";
$stmt_extraer_conceptosFactura_update = $db->prepare($query_extraer_conceptosFactura_update);
if (!($stmt_extraer_conceptosFactura_update)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare extraer_conceptosFactura_update [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_extraer_conceptosFactura_update->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution extraer_conceptosFactura_update [$stmt_extraer_conceptosFactura_update->errno]: $stmt_extraer_conceptosFactura_update->error";
  exit_script($system_callback);
}





# cargos -> corresponden a cobros de almacen
$query_extraer_conceptosFactura_cargos = "INSERT INTO conta_tem_tarifas_calculodetalle
            (fk_id_tarifa,s_seccion,n_cantidad,fk_c_ClaveProdServ,fk_id_cuenta,fk_c_claveUnidad,s_unidad,fk_id_concepto,s_descripcion,s_conceptoEnglish,n_importe)
SELECT $calculoTarifa,s_tipoDetalle,n_cantidad,fk_c_ClaveProdServ,fk_id_cuenta,fk_c_claveUnidad,s_unidad,fk_id_concepto,s_conceptoEsp,s_conceptoEnglish,n_total
                                FROM conta_t_facturas_captura_det
                                WHERE (s_tipoDetalle = 'cargos')
                                      AND fk_id_cuenta_captura = $cuenta
                                ORDER BY pk_id_partida";


$stmt_extraer_conceptosFactura_cargos = $db->prepare($query_extraer_conceptosFactura_cargos);
if (!($stmt_extraer_conceptosFactura_cargos)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare extraer_conceptosFactura_cargos [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_extraer_conceptosFactura_cargos->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution extraer_conceptosFactura_cargos [$stmt_extraer_conceptosFactura_cargos->errno]: $stmt_extraer_conceptosFactura_cargos->error";
  exit_script($system_callback);
}

$query_extraer_conceptosFactura_updAlm = "UPDATE conta_tem_tarifas_calculodetalle SET s_seccion = 'almacen' where fk_id_tarifa =$calculoTarifa and s_seccion ='cargos'";
$stmt_extraer_conceptosFactura_updAlm = $db->prepare($query_extraer_conceptosFactura_updAlm);
if (!($stmt_extraer_conceptosFactura_updAlm)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare extraer_conceptosFactura_updAlm [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_extraer_conceptosFactura_updAlm->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution extraer_conceptosFactura_updAlm [$stmt_extraer_conceptosFactura_updAlm->errno]: $stmt_extraer_conceptosFactura_updAlm->error";
  exit_script($system_callback);
}


#PAGOS O COBROS EN MONEDA EXTRANJERA
$query_extraer_conceptosPOCME = "INSERT INTO conta_tem_tarifas_calculodetalle
            (fk_id_tarifa,s_seccion,n_cantidad,fk_c_ClaveProdServ,fk_id_cuenta,fk_c_claveUnidad,s_unidad,fk_id_concepto,s_conceptoEsp,s_conceptoEnglish,n_importe,n_IVA,n_ret,n_total,fk_id_cliente)
SELECT $calculoTarifa,s_tipoDetalle,n_cantidad,fk_c_ClaveProdServ,fk_id_cuenta,fk_c_claveUnidad,s_unidad,fk_id_concepto,s_conceptoEsp,s_conceptoEnglish,n_importe,n_IVA,n_ret,n_total,'$id_cliente'
                                FROM conta_t_facturas_captura_det
                                WHERE (s_tipoDetalle = 'POCME')
                                      AND fk_id_cuenta_captura = $cuenta
                                ORDER BY pk_id_partida";


$stmt_extraer_conceptosPOCME = $db->prepare($query_extraer_conceptosPOCME);
if (!($stmt_extraer_conceptosPOCME)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare extraer_conceptosPOCME [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_extraer_conceptosPOCME->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution extraer_conceptosPOCME [$stmt_extraer_conceptosPOCME->errno]: $stmt_extraer_conceptosPOCME->error";
  exit_script($system_callback);
}

?>

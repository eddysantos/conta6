<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';


$ID_calculo = trim($_POST['T_No_calculoTarifa']);
$Usuario_Cta = trim($_POST['Txt_Usuario']);
$ID_Referencia = trim($_POST['T_IGED_1']);
// $ID_Referencia = trim($_POST['T_IGED_2']);
$ID_Aduana = trim($_POST['T_ID_Aduana_Oculto']);
$ID_Almacen = trim($_POST['T_ID_Almacen_Oculto']);
$ID_Cliente = trim($_POST['T_ID_Cliente_Oculto']);
$Fac_Nombre = utf8_decode(trim($_POST['T_Nombre_Cliente']));
$Fac_Calle = utf8_decode(trim($_POST['T_Cliente_Calle']));
$Fac_No_Ext = trim($_POST['T_Cliente_No_Ext']);
$Fac_No_Int = trim($_POST['T_Cliente_No_Int']);
$Fac_Colonia = utf8_decode(trim($_POST['T_Cliente_Colonia']));
$Fac_CP = trim($_POST['T_Cliente_CP']);
$Fac_Ciudad = utf8_decode(trim($_POST['T_Cliente_Ciudad']));
$Fac_Estado = trim($_POST['T_Cliente_Estado']);
$Fac_Pais = trim($_POST['T_Cliente_Pais']);
$Fac_taxid = trim($_POST['T_Cliente_taxid']);
$Fac_RFC = utf8_decode(trim($_POST['T_Cliente_RFC']));
$Proveedor_Destinatario = utf8_decode(trim($_POST['T_Proveedor_Destinatario']));
$Tipo = trim($_POST['T_Tipo']);
$Valor = trim($_POST['T_Valor']);
$Peso = trim($_POST['T_Peso']);
$Dias = trim($_POST['T_Dias']);

$POCME_Total_Gral = trim($_POST['T_POCME_Total']);
$POCME_Tipo_Cambio = trim($_POST['T_POCME_Tipo_Cambio']);
$POCME_Total_MN = trim($_POST['T_POCME_Total_MN']);

$Total_Custodia = trim($_POST['T_Valor_Custodia_Aer']);
$Total_Manejo = trim($_POST['T_Valor_Manejo_Aer']);
$Total_Almacenaje = trim($_POST['T_Valor_Almacenaje_Aer']);
$Total_Maniobras = trim($_POST['T_Valor_Total_Maniobras']);
$Total_Subsidiado = trim($_POST['T_Subsidio']);
$Total_derechosPagados = trim($_POST['T_derechosPagados']);

$usoCFDI = trim($_POST['T_usoCFDI']);

$Honorarios_Porcentaje = trim($_POST['T_Honorarios_Porcentaje']);
$Honorarios_Base_Honorarios = trim($_POST['T_Honorarios_Base_Honorarios']);
$Honorarios_Descuent = trim($_POST['T_Honorarios_Descuento']);
$Honorarios_Minimo = trim($_POST['T_Honorarios_Minimo']);
$Honorarios_0 = trim($_POST['T_Honorarios_0']);
$Hcta_0 = trim($_POST['T_Hcta_0']);
$Hps_0 = trim($_POST['T_Hps_0']);
$Honorarios_Importe_0 = trim($_POST['T_Honorarios_Importe_0']);
$Honorarios_IVA_0 = trim($_POST['T_Honorarios_IVA_0']);
$Honorarios_RET_0 = trim($_POST['T_Honorarios_RET_0']);
$Honorarios_Subtotal_0 = trim($_POST['T_Honorarios_Subtotal_0']);

$Total_Gral_Importe = trim($_POST['T_Total_Importes']);
$Total_Gral_Iva = trim($_POST['T_Total_IVA']);
$Fac_IVA_Retenido = trim($_POST['T_IVA_RETENIDO']);
$Total_Gral = trim($_POST['T_Total_Gral']);
$Total_POCME = trim($_POST['T_Total_MN_Extranjera']);
$Fac_Saldo = trim($_POST['T_SALDO_GRAL']);
$ID_ASOC = trim($_POST['CUSTOMS']);
$IVA_Aplicado = trim($_POST['T_IVA_Porcentaje']);
$Total_Honorarios = trim($_POST['T_SUBTOTAL_HON']);
$POCME_Descripcion_Gral = trim($_POST['Txt_Total_MN_Extranjera']);
$Total_Cta_Gastos = trim($_POST['T_Cta_Gastos']);
$Total_Anticipos = trim($_POST['T_Total_Anticipos']);
$Txt_Gral_Importe = trim($_POST['Txt_Total_Importe']);
$Txt_Gral_IVA = trim($_POST['Txt_Total_IVA']);
$Txt_Total_Honorarios = trim($_POST['Txt_SUBTOTAL_HON']);
$Txt_Fac_IVA_Retenido = utf8_decode(trim($_POST['Txt_IVA_RETENIDO']));
$Txt_Total_Gral = trim($_POST['Txt_Total_Gral']);
$Txt_Cta_Gastos = trim($_POST['Txt_Cta_Gastos']);
//$Txt_Total_Anticipos = utf8_decode(trim($_POST['Txt_Total_Anticipos']));
$Txt_Fac_Saldo = trim($_POST['Txt_Saldo_Gral']);
$Txt_Total_Pagos = trim($_POST['Txt_Total_Pagos']);
$Total_Pagos = trim($_POST['T_Total_Pagos']);
$total_pagosCLT = $Total_POCME + $Total_Pagos;

$Txt_POCME_Total = trim($_POST['Txt_POCME_Total']);
$Txt_POCME_Tipo_Cambio = trim($_POST['Txt_POCME_Tipo_Cambio']);
$Total_Letra = trim($_POST['Total_Letra']);
$formaPago = trim($_POST['T_FormaPago']);
$metodoPago = trim($_POST['T_metodoPago']);
$numCtaPago = trim($_POST['T_CuentaPago']);
$moneda = trim($_POST['T_Moneda']);
$tipoCambio = trim($_POST['T_monedaTipoCambio']);


$Honorarios_Porcentaje = trim($_POST['T_Honorarios_Porcentaje']);
$Honorarios_Base_Honorarios = trim($_POST['T_Honorarios_Base_Honorarios']);
$Honorarios_Descuento = trim($_POST['T_Honorarios_Descuento']);
$folio = trim($_POST['folio']);

//DATOS PRINCIPALES
$query_mst="UPDATE conta_t_facturas_captura SET s_usuario_modifi = ?,
                                                  fk_referencia = ?,
                                                  fk_id_aduana = ?,
                                                  fk_id_almacen = ?,
                                                  fk_id_cliente = ?,
                                                  s_nombre = ?,
                                                  s_calle = ?,
                                                  s_no_ext = ?,
                                                  s_no_int = ?,
                                                  s_colonia = ?,
                                                  s_codigo = ?,
                                                  s_ciudad = ?,
                                                  s_estado = ?,
                                                  s_pais = ?,
                                                  s_taxid = ?,
                                                  s_rfc = ?,
                                                  s_proveedor_destinatario = ?,
                                                  s_imp_exp = ?,
                                                  n_valor = ?,
                                                  n_peso = ?,
                                                  n_diasEnAlmacen = ?,
                                                  n_total_custodia = ?,
                                                  n_total_manejo = ?,
                                                  n_total_almacenaje = ?,
                                                  n_total_maniobras = ?,
                                                  n_total_subsidiado = ?,
                                                  n_POCME_total_gral = ?,
                                                  n_POCME_tipo_cambio = ?,
                                                  n_POCME_total_MN = ?,
                                                  n_IVA_aplicado = ?,
                                                  n_total_depositos = ?,
                                                  s_txt_gral_importe = ?,
                                                  n_total_gral_importe = ?,
                                                  n_txt_gral_IVA = ?,
                                                  n_total_gral_IVA = ?,
                                                  s_txt_total_honorarios = ?,
                                                  n_total_honorarios = ?,
                                                  s_txt_fac_IVA_retenido = ?,
                                                  s_fac_IVA_retenido = ?,
                                                  s_txt_total_gral = ?,
                                                  n_total_gral = ?,
                                                  s_POCME_descripcion_gral = ?,
                                                  n_total_POCME = ?,
                                                  s_txt_total_pagos = ?,
                                                  n_total_pagos = ?,
                                                  s_txt_cta_gastos = ?,
                                                  n_total_cta_gastos = ?,
                                                  s_total_cta_gastos_letra = ?,
                                                  s_txt_fac_saldo = ?,
                                                  n_fac_saldo = ?,
                                                  n_tipoCambio = ?,
                                                  fk_id_moneda = ?,
                                                  pk_c_UsoCFDI = ?,
                                                  fk_id_asoc = ?,
                                                  fk_id_formapago = ?,
                                                  s_numCtaPago = ?,
                                                  fk_c_MetodoPago = ?
                                WHERE pk_id_cuenta_captura = ?";

$stmt_mst = $db->prepare($query_mst);
if (!($stmt_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare captura [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_mst->bind_param('ssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
                      $usuario,
                      $ID_Referencia,
                      $ID_Aduana,
                      $ID_Almacen,
                      $ID_Cliente,
                      $Fac_Nombre,
                      $Fac_Calle,
                      $Fac_No_Ext,
                      $Fac_No_Int,
                      $Fac_Colonia,
                      $Fac_CP,
                      $Fac_Ciudad,
                      $Fac_Estado,
                      $Fac_Pais,
                      $Fac_taxid,
                      $Fac_RFC,
                      $Proveedor_Destinatario,
                      $Tipo,
                      $Valor,
                      $Peso,
                      $Dias,
                      $Total_Custodia,
                      $Total_Manejo,
                      $Total_Almacenaje,
                      $Total_Maniobras,
                      $Total_Subsidiado,
                      $POCME_Total_Gral,
                      $POCME_Tipo_Cambio,
                      $POCME_Total_MN,
                      $IVA_Aplicado,
                      $Total_Anticipos,
                      $Txt_Gral_Importe,
                      $Total_Gral_Importe,
                      $Txt_Gral_IVA,
                      $Total_Gral_Iva,
                      $Txt_Total_Honorarios,
                      $Total_Honorarios,
                      $Txt_Fac_IVA_Retenido,
                      $Fac_IVA_Retenido,
                      $Txt_Total_Gral,
                      $Total_Gral,
                      $POCME_Descripcion_Gral,
                      $Total_POCME,
                      $Txt_Total_Pagos,
                      $Total_Pagos,
                      $Txt_Cta_Gastos,
                      $Total_Cta_Gastos,
                      $Total_Letra,
                      $Txt_Fac_Saldo,
                      $Fac_Saldo,
                      $tipoCambio,
                      $moneda,
                      $usoCFDI,
                      $ID_ASOC,
                      $formaPago,
                      $numCtaPago,
                      $metodoPago,
                      $folio);

if (!($stmt_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding captura [$stmt_mst->errno]: $stmt_mst->error";
  exit_script($system_callback);
}

if (!($stmt_mst->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution captura [$stmt_mst->errno]: $stmt_mst->error";
  //exit_script($system_callback);
}




require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/1-CuentaGastos_modificar_detalle.php';
require $root . '/Resources/PHP/actions/tarifas_calcula_borrar.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";

exit_script($system_callback);

//prueba modificar
?>

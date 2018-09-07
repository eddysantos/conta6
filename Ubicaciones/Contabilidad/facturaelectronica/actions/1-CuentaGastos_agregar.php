<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';
/*
$pocme = array();

foreach ($_POST['pocme'] as $index) {
  foreach ($index as $campo => $valor) {
    $pocme[$index][$campo] = $valor;
  }
}
*/
$ID_calculo = trim($_POST['T_No_calculoTarifa']);
$Usuario_Cta = trim($_POST['Txt_Usuario']);
$ID_Referencia = trim($_POST['T_IGED_1']);
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
$Fac_RFC = utf8_decode(trim($_POST['T_Cliente_RFC']));
$Proveedor_Destinatario = utf8_decode(trim($_POST['T_Proveedor_Destinatario']));
$Tipo = trim($_POST['T_Tipo']);
$Valor = trim($_POST['T_Valor']);
$Peso = trim($_POST['T_Peso']);
$Dias = trim($_POST['T_Dias']);
$Total_Custodia = trim($_POST['T_Valor_Custodia_Aer']);
$Total_Manejo = trim($_POST['T_Valor_Manejo_Aer']);
$Total_Almacenaje = trim($_POST['T_Valor_Almacenaje_Aer']);
$Total_Maniobras = trim($_POST['T_Valor_Total_Maniobras']);
$Total_Subsidiado = trim($_POST['T_Subsidio']);
$IGET_0 = utf8_decode(trim($_POST['T_IGET_0']));
$IGED_0 = utf8_decode(trim($_POST['T_IGED_0']));
$IGET_1 = utf8_decode(trim($_POST['T_IGET_1']));
$IGED_1 = utf8_decode(trim($_POST['T_IGED_1']));
$IGET_2 = utf8_decode(trim($_POST['T_IGET_2']));
$IGED_2 = utf8_decode(trim($_POST['T_IGED_2']));
$IGET_3 = utf8_decode(trim($_POST['T_IGET_3']));
$IGED_3 = utf8_decode(trim($_POST['T_IGED_3']));
$IGET_4 = utf8_decode(trim($_POST['T_IGET_4']));
$IGED_4 = utf8_decode(trim($_POST['T_IGED_4']));
$IGET_5 = utf8_decode(trim($_POST['T_IGET_5']));
$IGED_5 = utf8_decode(trim($_POST['T_IGED_5']));
$IGET_6 = utf8_decode(trim($_POST['T_IGET_6']));
$IGED_6 = utf8_decode(trim($_POST['T_IGED_6']));
$IGET_7 = utf8_decode(trim($_POST['T_IGET_7']));
$IGED_7 = utf8_decode(trim($_POST['T_IGED_7']));
$IGET_8 = utf8_decode(trim($_POST['T_IGET_8']));
$IGED_8 = utf8_decode(trim($_POST['T_IGED_8']));
$IGET_9 = utf8_decode(trim($_POST['T_IGET_9']));
$IGED_9 = utf8_decode(trim($_POST['T_IGED_9']));
$IGET_10 = utf8_decode(trim($_POST['T_IGET_10']));
$IGED_10 = utf8_decode(trim($_POST['T_IGED_10']));
$IGET_11 = utf8_decode(trim($_POST['T_IGET_11']));
$IGED_11 = utf8_decode(trim($_POST['T_IGED_11']));
$IGET_12 = utf8_decode(trim($_POST['T_IGET_12']));
$IGED_12 = utf8_decode(trim($_POST['T_IGED_12']));
$IGET_13 = utf8_decode(trim($_POST['T_IGET_13']));
$IGED_13 = utf8_decode(trim($_POST['T_IGED_13']));
$POCME_cantidad1 = trim($_POST['T_POCME_Cantidad1']);
$POCME_idTipoCta1 = trim($_POST['T_POCME_idTipoCta1']);
$POCME_concepto1 = utf8_decode(trim($_POST['T_POCME_Concepto1']));
$POCME_conceptoEng1 = trim($_POST['T_POCME_ConceptoEng1']);
$POCME_desc1 = utf8_decode(trim($_POST['T_POCME_Descripcion1']));
$POCME_importe1 = trim($_POST['T_POCME_Importe1']);
$POCME_valor1 = trim($_POST['T_POCME_Subtotal1']);
$POCME_cantidad2 = trim($_POST['T_POCME_Cantidad2']);
$POCME_idTipoCta2 = trim($_POST['T_POCME_idTipoCta2']);
$POCME_concepto2 = utf8_decode(trim($_POST['T_POCME_Concepto2']));
$POCME_conceptoEng2 = trim($_POST['T_POCME_ConceptoEng2']);
$POCME_desc2 = utf8_decode(trim($_POST['T_POCME_Descripcion2']));
$POCME_importe2 = trim($_POST['T_POCME_Importe2']);
$POCME_valor2 = trim($_POST['T_POCME_Subtotal2']);
$POCME_cantidad3 = trim($_POST['T_POCME_Cantidad3']);
$POCME_idTipoCta3 = trim($_POST['T_POCME_idTipoCta3']);
$POCME_concepto3 = utf8_decode(trim($_POST['T_POCME_Concepto3']));
$POCME_conceptoEng3 = trim($_POST['T_POCME_ConceptoEng3']);
$POCME_desc3 = utf8_decode(trim($_POST['T_POCME_Descripcion3']));
$POCME_importe3 = trim($_POST['T_POCME_Importe3']);
$POCME_valor3 = trim($_POST['T_POCME_Subtotal3']);
$POCME_cantidad4 = trim($_POST['T_POCME_Cantidad4']);
$POCME_idTipoCta4 = trim($_POST['T_POCME_idTipoCta4']);
$POCME_concepto4 = utf8_decode(trim($_POST['T_POCME_Concepto4']));
$POCME_conceptoEng4 = trim($_POST['T_POCME_ConceptoEng4']);
$POCME_desc4 = utf8_decode(trim($_POST['T_POCME_Descripcion4']));
$POCME_importe4 = trim($_POST['T_POCME_Importe4']);
$POCME_valor4 = trim($_POST['T_POCME_Subtotal4']);
$POCME_cantidad5 = trim($_POST['T_POCME_Cantidad5']);
$POCME_idTipoCta5 = trim($_POST['T_POCME_idTipoCta5']);
$POCME_concepto5 = utf8_decode(trim($_POST['T_POCME_Concepto5']));
$POCME_conceptoEng5 = trim($_POST['T_POCME_ConceptoEng5']);
$POCME_desc5 = utf8_decode(trim($_POST['T_POCME_Descripcion5']));
$POCME_importe5 = trim($_POST['T_POCME_Importe5']);
$POCME_valor5 = trim($_POST['T_POCME_Subtotal5']);
$POCME_cantidad6 = trim($_POST['T_POCME_Cantidad6']);
$POCME_idTipoCta6 = trim($_POST['T_POCME_idTipoCta6']);
$POCME_concepto6 = utf8_decode(trim($_POST['T_POCME_Concepto6']));
$POCME_conceptoEng6 = trim($_POST['T_POCME_ConceptoEng6']);
$POCME_desc6 = utf8_decode(trim($_POST['T_POCME_Descripcion6']));
$POCME_importe6 = trim($_POST['T_POCME_Importe6']);
$POCME_valor6 = trim($_POST['T_POCME_Subtotal6']);
$POCME_cantidad7 = trim($_POST['T_POCME_Cantidad7']);
$POCME_idTipoCta7 = trim($_POST['T_POCME_idTipoCta7']);
$POCME_concepto7 = utf8_decode(trim($_POST['T_POCME_Concepto7']));
$POCME_conceptoEng7 = trim($_POST['T_POCME_ConceptoEng7']);
$POCME_desc7 = utf8_decode(trim($_POST['T_POCME_Descripcion7']));
$POCME_importe7 = trim($_POST['T_POCME_Importe7']);
$POCME_valor7 = trim($_POST['T_POCME_Subtotal7']);
$POCME_cantidad8 = trim($_POST['T_POCME_Cantidad8']);
$POCME_idTipoCta8 = trim($_POST['T_POCME_idTipoCta8']);
$POCME_concepto8 = utf8_decode(trim($_POST['T_POCME_Concepto8']));
$POCME_conceptoEng8 = trim($_POST['T_POCME_ConceptoEng8']);
$POCME_desc8 = utf8_decode(trim($_POST['T_POCME_Descripcion8']));
$POCME_importe8 = trim($_POST['T_POCME_Importe8']);
$POCME_valor8 = trim($_POST['T_POCME_Subtotal8']);
$T_POCME_idConcep1 = trim($_POST['T_POCME_idConcep1']);
$T_POCME_idConcep2 = trim($_POST['T_POCME_idConcep2']);
$T_POCME_idConcep3 = trim($_POST['T_POCME_idConcep3']);
$T_POCME_idConcep4 = trim($_POST['T_POCME_idConcep4']);
$T_POCME_idConcep5 = trim($_POST['T_POCME_idConcep5']);
$T_POCME_idConcep6 = trim($_POST['T_POCME_idConcep6']);
$T_POCME_idConcep7 = trim($_POST['T_POCME_idConcep7']);
$T_POCME_idConcep8 = trim($_POST['T_POCME_idConcep8']);

$POCME_Total_Gral = trim($_POST['T_POCME_Total']);
$POCME_Tipo_Cambio = trim($_POST['T_POCME_Tipo_Cambio']);
$POCME_Total_MN = trim($_POST['T_POCME_Total_MN']);

$Cargo_Desc_1 = utf8_decode(trim($_POST['T_Cargo_1']));
$Cargo_Total_1 = trim($_POST['T_Cargo_13']);
$Cargo_Desc_2 = utf8_decode(trim($_POST['T_Cargo_2']));
$Cargo_Total_2 = trim($_POST['T_Cargo_23']);
$Cargo_Desc_3 = utf8_decode(trim($_POST['T_Cargo_3']));
$Cargo_Total_3 = trim($_POST['T_Cargo_33']);
$Cargo_Desc_4 = utf8_decode(trim($_POST['T_Cargo_4']));
$Cargo_Total_4 = trim($_POST['T_Cargo_43']);
$Cargo_Desc_5 = utf8_decode(trim($_POST['T_Cargo_5']));
$Cargo_Total_5 = trim($_POST['T_Cargo_53']);
$Cargo_Desc_6 = utf8_decode(trim($_POST['T_Cargo_6']));
$Cargo_Total_6 = trim($_POST['T_Cargo_63']);
$Cargo_Desc_7 = utf8_decode(trim($_POST['T_Cargo_7']));
$Cargo_Total_7 = trim($_POST['T_Cargo_73']);
$Cargo_Desc_8 = utf8_decode(trim($_POST['T_Cargo_8']));
$Cargo_Total_8 = trim($_POST['T_Cargo_83']);
$T_Cargo_idconcepto_1 = trim($_POST['T_Cargo_idconcepto_1']);
$T_Cargo_idconcepto_2 = trim($_POST['T_Cargo_idconcepto_2']);
$T_Cargo_idconcepto_3 = trim($_POST['T_Cargo_idconcepto_3']);
$T_Cargo_idconcepto_4 = trim($_POST['T_Cargo_idconcepto_4']);
$T_Cargo_idconcepto_5 = trim($_POST['T_Cargo_idconcepto_5']);
$T_Cargo_idconcepto_6 = trim($_POST['T_Cargo_idconcepto_6']);
$T_Cargo_idconcepto_7 = trim($_POST['T_Cargo_idconcepto_7']);
$T_Cargo_idconcepto_8 = trim($_POST['T_Cargo_idconcepto_8']);
$T_Cargo_idcuenta_1 = trim($_POST['T_Cargo_idcuenta_1']);
$T_Cargo_idcuenta_2 = trim($_POST['T_Cargo_idcuenta_2']);
$T_Cargo_idcuenta_3 = trim($_POST['T_Cargo_idcuenta_3']);
$T_Cargo_idcuenta_4 = trim($_POST['T_Cargo_idcuenta_4']);
$T_Cargo_idcuenta_5 = trim($_POST['T_Cargo_idcuenta_5']);
$T_Cargo_idcuenta_6 = trim($_POST['T_Cargo_idcuenta_6']);
$T_Cargo_idcuenta_7 = trim($_POST['T_Cargo_idcuenta_7']);
$T_Cargo_idcuenta_8 = trim($_POST['T_Cargo_idcuenta_8']);

$c_claveprodserv0 = trim($_POST['T_Hps0']);
$c_claveprodserv1 = trim($_POST['T_Hps1']);
$c_claveprodserv2 = trim($_POST['T_Hps2']);
$c_claveprodserv3 = trim($_POST['T_Hps3']);
$c_claveprodserv4 = trim($_POST['T_Hps4']);
$c_claveprodserv5 = trim($_POST['T_Hps5']);
$c_claveprodserv6 = trim($_POST['T_Hps6']);
$c_claveprodserv7 = trim($_POST['T_Hps7']);
$c_claveprodserv8 = trim($_POST['T_Hps8']);

$noIdentificacion0 = trim($_POST['T_Hcta0']);
$noIdentificacion1 = trim($_POST['T_Hcta1']);
$noIdentificacion2 = trim($_POST['T_Hcta2']);
$noIdentificacion3 = trim($_POST['T_Hcta3']);
$noIdentificacion4 = trim($_POST['T_Hcta4']);
$noIdentificacion5 = trim($_POST['T_Hcta5']);
$noIdentificacion6 = trim($_POST['T_Hcta6']);
$noIdentificacion7 = trim($_POST['T_Hcta7']);
$noIdentificacion8 = trim($_POST['T_Hcta8']);

$Honorarios_ret = trim($_POST['T_Honorarios_RET']);
$Honorarios_ret_1 = trim($_POST['T_Honorarios_14']);
$Honorarios_ret_2 = trim($_POST['T_Honorarios_24']);
$Honorarios_ret_3 = trim($_POST['T_Honorarios_34']);
$Honorarios_ret_4 = trim($_POST['T_Honorarios_44']);
$Honorarios_ret_5 = trim($_POST['T_Honorarios_54']);
$Honorarios_ret_6 = trim($_POST['T_Honorarios_64']);
$Honorarios_ret_7 = trim($_POST['T_Honorarios_74']);
$Honorarios_ret_8 = trim($_POST['T_Honorarios_84']);

$usoCFDI = trim($_POST['T_usoCFDI']);

$Porcentaje_Honorarios = trim($_POST['T_Honorarios_Porcentaje']);
$Honorarios_Base = trim($_POST['T_Honorarios_Base_Honorarios']);
$Porcentaje_Descuento = trim($_POST['T_Honorarios_Descuento']);
$Descuento_Txt = trim($_POST['Txt_Descuento']);
$Honorarios_Importe = trim($_POST['T_Honorarios_Importe']);
$Honorarios_Iva = trim($_POST['T_Honorarios_IVA']);
$Honorarios_Total = trim($_POST['T_Honorarios_Total']);
$Honorarios_Desc_1 = utf8_decode(trim($_POST['T_Honorarios_1']));
$Honorarios_Importe_1 = trim($_POST['T_Honorarios_11']);
$Honorarios_Iva_1 = trim($_POST['T_Honorarios_12']);
$Honorarios_Total_1 = trim($_POST['T_Honorarios_13']);
$Honorarios_Desc_2 = utf8_decode(trim($_POST['T_Honorarios_2']));
$Honorarios_Importe_2 = trim($_POST['T_Honorarios_21']);
$Honorarios_Iva_2 = trim($_POST['T_Honorarios_22']);
$Honorarios_Total_2 = trim($_POST['T_Honorarios_23']);
$Honorarios_Desc_3 = utf8_decode(trim($_POST['T_Honorarios_3']));
$Honorarios_Importe_3 = trim($_POST['T_Honorarios_31']);
$Honorarios_Iva_3 = trim($_POST['T_Honorarios_32']);
$Honorarios_Total_3 = trim($_POST['T_Honorarios_33']);
$Honorarios_Desc_4 = utf8_decode(trim($_POST['T_Honorarios_4']));
$Honorarios_Importe_4 = trim($_POST['T_Honorarios_41']);
$Honorarios_Iva_4 = trim($_POST['T_Honorarios_42']);
$Honorarios_Total_4 = trim($_POST['T_Honorarios_43']);
$Honorarios_Desc_5 = utf8_decode(trim($_POST['T_Honorarios_5']));
$Honorarios_Importe_5 = trim($_POST['T_Honorarios_51']);
$Honorarios_Iva_5 = trim($_POST['T_Honorarios_52']);
$Honorarios_Total_5 = trim($_POST['T_Honorarios_53']);
$Honorarios_Desc_6 = utf8_decode(trim($_POST['T_Honorarios_6']));
$Honorarios_Importe_6 = trim($_POST['T_Honorarios_61']);
$Honorarios_Iva_6 = trim($_POST['T_Honorarios_62']);
$Honorarios_Total_6 = trim($_POST['T_Honorarios_63']);
$Honorarios_Desc_7 = utf8_decode(trim($_POST['T_Honorarios_7']));
$Honorarios_Importe_7 = trim($_POST['T_Honorarios_71']);
$Honorarios_Iva_7 = trim($_POST['T_Honorarios_72']);
$Honorarios_Total_7 = trim($_POST['T_Honorarios_73']);
$Honorarios_Desc_8 = utf8_decode(trim($_POST['T_Honorarios_8']));
$Honorarios_Importe_8 = trim($_POST['T_Honorarios_81']);
$Honorarios_Iva_8 = trim($_POST['T_Honorarios_82']);
$Honorarios_Total_8 = trim($_POST['T_Honorarios_83']);

$No_Anticipo_1 = trim($_POST['T_No_Anticipo_1']);
$Val_Anticipo_1 = trim($_POST['T_Anticipo_1']);
$No_Anticipo_2 = trim($_POST['T_No_Anticipo_2']);
$Val_Anticipo_2 = trim($_POST['T_Anticipo_2']);
$No_Anticipo_3 = trim($_POST['T_No_Anticipo_3']);
$Val_Anticipo_3 = trim($_POST['T_Anticipo_3']);
$No_Anticipo_4 = trim($_POST['T_No_Anticipo_4']);
$Val_Anticipo_4 = trim($_POST['T_Anticipo_4']);
$No_Anticipo_5 = trim($_POST['T_No_Anticipo_5']);
$Val_Anticipo_5 = trim($_POST['T_Anticipo_5']);
$No_Anticipo_6 = trim($_POST['T_No_Anticipo_6']);
$Val_Anticipo_6 = trim($_POST['T_Anticipo_6']);
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
$Txt_Fac_IVA_Retenido = trim($_POST['Txt_IVA_RETENIDO']);
$Txt_Total_Gral = trim($_POST['Txt_Total_Gral']);
$Txt_Cta_Gastos = trim($_POST['Txt_Cta_Gastos']);
$Txt_Total_Anticipos = utf8_decode(trim($_POST['Txt_Total_Anticipos']));
$Txt_Fac_Saldo = trim($_POST['Txt_Saldo_Gral']);
$Txt_Total_Pagos = trim($_POST['Txt_Total_Pagos']);
$Total_Pagos = trim($_POST['T_Total_Pagos']);
$Honorarios_Txt = trim($_POST['Txt_Honorarios']);
$Txt_POCME_Total = trim($_POST['Txt_POCME_Total']);
$Txt_POCME_Tipo_Cambio = trim($_POST['Txt_POCME_Tipo_Cambio']);
$Total_Letra = trim($_POST['Total_Letra']);
$formaPago = trim($_POST['T_FormaPago']);
$metodoPago = trim($_POST['T_metodoPago']);
$numCtaPago = trim($_POST['T_CuentaPago']);
$moneda = trim($_POST['T_Moneda']);
$tipoCambio = trim($_POST['T_monedaTipoCambio']);



// try{
//   $db->beginTransaction();

    //DATOS PRINCIPALES
    $query_mst="INSERT INTO conta_t_facturas_captura( fk_usuario,
                                                      fk_referencia,
                                                      fk_id_aduana,
                                                      fk_id_almacen,
                                                      fk_id_cliente,
                                                      s_nombre,
                                                      s_calle,
                                                      s_no_ext,
                                                      s_no_int,
                                                      s_colonia,
                                                      s_codigo,
                                                      s_ciudad,
                                                      s_estado,
                                                      s_pais,
                                                      s_rfc,
                                                      fk_id_proveedor,
                                                      s_imp_exp,
                                                      n_valor,
                                                      n_peso,
                                                      n_diasEnAlmacen,
                                                      n_total_custodia,
                                                      n_total_manejo,
                                                      n_total_almacenaje,
                                                      n_total_maniobras,
                                                      n_total_subsidiado,
                                                      s_txt_POCME_total,
                                                      n_POCME_total_gral,
                                                      s_txt_POCME_tipo_cambio,
                                                      n_POCME_tipo_cambio,
                                                      n_POCME_total_MN,
                                                      n_IVA_aplicado,
                                                      s_txt_total_anticipos,
                                                      n_total_anticipos,
                                                      S_txt_gral_importe,
                                                      n_total_gral_importe,
                                                      n_txt_gral_IVA,
                                                      n_total_gral_IVA,
                                                      s_txt_total_honorarios,
                                                      n_total_honorarios,
                                                      s_txt_fac_IVA_retenido,
                                                      s_fac_IVA_retenido,
                                                      s_txt_total_gral,
                                                      n_total_gral,
                                                      s_POCME_descripcion_gral,
                                                      n_total_POCME,
                                                      s_txt_total_pagos,
                                                      n_total_pagos,
                                                      s_txt_cta_gastos,
                                                      n_total_cta_gastos,
                                                      s_total_cta_gastos_letra,
                                                      s_txt_fac_saldo,
                                                      n_fac_saldo,
                                                      n_tipoCambio,
                                                      fk_id_moneda,
                                                      pk_c_UsoCFDI,
                                                      fk_id_asoc,
                                                      fk_id_formapago,
                                                      s_numCtaPago,
                                                      fk_c_MetodoPago
                )values(?,?,?,?,?,?,?,?,?,?,
                        ?,?,?,?,?,?,?,?,?,?,
                        ?,?,?,?,?,?,?,?,?,?,
                        ?,?,?,?,?,?,?,?,?,?,
                        ?,?,?,?,?,?,?,?,?,?,
                        ?,?,?,?,?,?,?,?,?)";

    $stmt_mst = $db->prepare($query_mst);
    if (!($stmt_mst)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    $stmt_mst->bind_param('sssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
                          $Usuario_Cta,
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
                          $Txt_POCME_Total,
                          $POCME_Total_Gral,
                          $Txt_POCME_Tipo_Cambio,
                          $POCME_Tipo_Cambio,
                          $POCME_Total_MN,
                          $IVA_Aplicado,
                          $Txt_Total_Anticipos,
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
                          $metodoPago );

    if (!($stmt_mst)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding [$stmt_mst->errno]: $stmt_mst->error";
      exit_script($system_callback);
    }

    if (!($stmt_mst->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution [$stmt_mst->errno]: $stmt_mst->error";
      //exit_script($system_callback);
    }

    $nfolio = $db->insert_id;

    require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/1-CuentaGastos_agregar_detalle.php';

  //$db->commit();
    $system_callback['hon'] = $query_hon;
    $system_callback['code'] = 1;
    $system_callback['data'] = $nfolio;
    $system_callback['message'] = "Script called successfully!";

    exit_script($system_callback);



// }catch(\Exception $e){
//   $db->rollback();
//   $system_callback['code'] = 2;
//   $system_callback['message'] = "Error. No se guardo";
//   exit_script($system_callback);
// }


?>

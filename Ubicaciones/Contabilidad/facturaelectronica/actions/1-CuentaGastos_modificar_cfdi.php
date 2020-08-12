<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';


$ID_calculo = trim($_POST['T_No_calculoTarifa']);
$Usuario_Cta = trim($_POST['Txt_Usuario']);
$ID_Referencia = trim($_POST['T_IGED_1']);
$ID_Aduana = trim($_POST['T_ID_Aduana_Oculto']);
$ID_Almacen = trim($_POST['T_ID_Almacen_Oculto']);
$ID_Cliente = trim($_POST['T_ID_Cliente_Oculto']);
$Fac_Nombre = utf8_decode(trim($_POST['T_Nombre_Cliente']));
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
$Total_derechosPagados = trim($_POST['T_derechosPagados']);

$Total_POCME = trim($_POST['T_Total_MN_Extranjera']);
$Fac_Saldo = trim($_POST['T_SALDO_GRAL']);
$POCME_Descripcion_Gral = trim($_POST['Txt_Total_MN_Extranjera']);
$Total_Cta_Gastos = trim($_POST['T_Cta_Gastos']);
$Total_Anticipos = trim($_POST['T_Total_Anticipos']);

$Txt_Cta_Gastos = trim($_POST['Txt_Cta_Gastos']);
//$Txt_Total_Anticipos = utf8_decode(trim($_POST['Txt_Total_Anticipos']));
$Txt_Fac_Saldo = trim($_POST['Txt_Saldo_Gral']);
$Txt_Total_Pagos = trim($_POST['Txt_Total_Pagos']);
$Total_Pagos = trim($_POST['T_Total_Pagos']);
//$Total_Gral = trim($_POST['T_Total_Gral']);

$POCME_Total_Gral = trim($_POST['T_POCME_Total']);
$POCME_Tipo_Cambio = trim($_POST['T_POCME_Tipo_Cambio']);
$POCME_Total_MN = trim($_POST['T_POCME_Total_MN']);
$Total_Letra = trim($_POST['Total_Letra']);
$metodoPago = trim($_POST['T_metodoPago']);
$moneda = trim($_POST['T_Moneda']);
$tipoCambio = trim($_POST['T_monedaTipoCambio']);

$folio = trim($_POST['folio']);
$id_factura = trim($_POST['id_factura']);
$c_MetodoPago = $metodoPago;
$id_cliente = $ID_Cliente;
$referencia = $ID_Referencia;

$total_pagosCLT = $Total_POCME + $Total_Pagos;
/*
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

$ID_ASOC = trim($_POST['CUSTOMS']);
$IVA_Aplicado = trim($_POST['T_IVA_Porcentaje']);
$Total_Honorarios = trim($_POST['T_SUBTOTAL_HON']);
$Txt_Gral_Importe = trim($_POST['Txt_Total_Importe']);
$Txt_Gral_IVA = trim($_POST['Txt_Total_IVA']);
$Txt_Total_Honorarios = trim($_POST['Txt_SUBTOTAL_HON']);
$Txt_Fac_IVA_Retenido = utf8_decode(trim($_POST['Txt_IVA_RETENIDO']));
$Txt_Total_Gral = trim($_POST['Txt_Total_Gral']);

$Txt_POCME_Total = trim($_POST['Txt_POCME_Total']);
$Txt_POCME_Tipo_Cambio = trim($_POST['Txt_POCME_Tipo_Cambio']);
$formaPago = trim($_POST['T_FormaPago']);

$numCtaPago = trim($_POST['T_CuentaPago']);



$Honorarios_Porcentaje = trim($_POST['T_Honorarios_Porcentaje']);
$Honorarios_Base_Honorarios = trim($_POST['T_Honorarios_Base_Honorarios']);
$Honorarios_Descuento = trim($_POST['T_Honorarios_Descuento']);
*/

//DATOS PRINCIPALES
$query_mst="UPDATE conta_t_facturas_captura SET s_usuario_modifi = ?,
                                                  fk_referencia = ?,
                                                  fk_id_aduana = ?,
                                                  fk_id_almacen = ?,
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
                                                  n_total_depositos = ?,
                                                  s_POCME_descripcion_gral = ?,
                                                  n_total_POCME = ?,
                                                  s_txt_total_pagos = ?,
                                                  n_total_pagos = ?,
                                                  s_txt_cta_gastos = ?,
                                                  n_total_cta_gastos = ?,
                                                  s_total_cta_gastos_letra = ?,
                                                  s_txt_fac_saldo = ?,
                                                  n_fac_saldo = ?
                                            WHERE pk_id_cuenta_captura = ?";

$stmt_mst = $db->prepare($query_mst);
if (!($stmt_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare captura [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_mst->bind_param('ssssssssssssssssssssssssssss',
                                                        $usuario,
                                                        $ID_Referencia,
                                                        $ID_Aduana,
                                                        $ID_Almacen,
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
                                                        $Total_Anticipos,
                                                        $POCME_Descripcion_Gral,
                                                        $Total_POCME,
                                                        $Txt_Total_Pagos,
                                                        $Total_Pagos,
                                                        $Txt_Cta_Gastos,
                                                        $Total_Cta_Gastos,
                                                        $Total_Letra,
                                                        $Txt_Fac_Saldo,
                                                        $Fac_Saldo,
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




require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/1-CuentaGastos_modificar_detalle.php';
require $root . '/conta6/Resources/PHP/actions/tarifas_calcula_borrar.php';


$cuenta = $folio;

# modificar poliza de cuenta de gastos *************************************************
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCuentaGastos.php'; #$total_consultaCtaGstos

if( $Total_Cta_Gastos == 0 ){ #importe de los gastos por cuenta del cliente
  if( $total_consultaCtaGstos == 0 ) {
    $id_poliza = $fk_idpol_ctagastos;
    require $root . '/conta6/Resources/PHP/actions/borrarDetallePoliza.php';
  }
}

if( $Total_Cta_Gastos == 0 ){ #importe de los gastos por cuenta del cliente
  if( $total_consultaCtaGstos > 0 ) {
  	$id_poliza = $fk_idpol_ctagastos;
    require $root . '/conta6/Resources/PHP/actions/borrarDetallePoliza.php';

    require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarFactura.php';
    $id_ctagastos = $id_ctagastos;
    $fecha = $fechaTimbrado;
    $ID_Cliente = trim($_POST['T_ID_Cliente_Oculto']);
    $r_razon_social = $Fac_Nombre;
    $concepto = "CUENTA DE GASTOS - ".$r_razon_social;
    $poliza_CtaGastos = $fk_idpol_ctagastos;

    require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_det_ctaGastos.php';


  }
}

if( $Total_Cta_Gastos > 0 ){ #importe de los gastos por cuenta del cliente
  if( $total_consultaCtaGstos == 0 ) {
      echo "/entro1";
      require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarFactura.php';
      $fechaTimbre = $fechaTimbrado;
      $idFactura = $pk_id_factura;
      $r_razon_social = $Fac_Nombre;
      $concepto = "CUENTA DE GASTOS - ".$r_razon_social;

      require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_1genCtaGastos.php'; #$folioCtaGastos
      require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_ctaGastos.php'; #$poliza_CtaGastos

      if( $c_MetodoPago == 'PUE' && $fac_saldo < 0 ){
        if( $fk_idpol_pagoaplicado > 0 ){
          $polizaAplicado = $fk_idpol_pagoaplicado;
          $id_poliza = $fk_idpol_pagoaplicado;
          echo "/entro3";
          require $root . '/conta6/Resources/PHP/actions/borrarDetallePoliza.php';
          require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_pagoAplicadoDetalle.php';
        }else{
          require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_pagoAplicado.php';
        }
      }
  }

  if( $total_consultaCtaGstos > 0 ) {
    if( $fk_idpol_ctagastos > 0 ){
      $poliza_CtaGastos = $fk_idpol_ctagastos;
      $id_poliza = $fk_idpol_ctagastos;
      echo "/entro4";
      require $root . '/conta6/Resources/PHP/actions/borrarDetallePoliza.php';

      require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarFactura.php';
      $fecha = $fechaTimbrado;
      $idFactura = $pk_id_factura;

      require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_det_ctaGastos.php';
    }else{
      echo "/entro2";
      require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarFactura.php';
      $fechaTimbre = $fechaTimbrado;
      $idFactura = $pk_id_factura;
      $r_razon_social = $Fac_Nombre;
      $concepto = "CUENTA DE GASTOS - ".$r_razon_social;
      require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_ctaGastos.php'; #$poliza_CtaGastos
    }

    if( $c_MetodoPago == 'PUE' && $fac_saldo < 0 ){
      if( $fk_idpol_pagoaplicado > 0 ){
        $polizaAplicado = $fk_idpol_pagoaplicado;
        $id_poliza = $fk_idpol_pagoaplicado;
        echo "/entro5";
        require $root . '/conta6/Resources/PHP/actions/borrarDetallePoliza.php';
        require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_pagoAplicadoDetalle.php';
      }else{
        require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_pagoAplicado.php';
      }
    }
  }

  if( $poliza_CtaGastos > 0 || $polizaAplicado > 0 ){
    require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5guardarDatosPolizas.php';
  }

  $cliente = $ID_Cliente;


  #nombre carpetas
  $anioActual = date_format(date_create($fecha),"Y");
  $rutaAnioActual = $root . '/conta6/CFDI_generados/'.$anioActual;
  $rutaCLT = $rutaAnioActual.'/'.$cliente;
  $rutaQR = $rutaCLT.'/QR';
  #nombre del archivo
  $nombre_archivo = $referencia.'_'.$id_factura.'_factura';
  #ruta
  $rutaRepFilePDF = $rutaCLT.'/'.$nombre_archivo.'.pdf';
  $rutaQRFile = $rutaQR.'/'.$nombre_archivo.'.png';


  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5impresoHTML.php';


}









# bitacora
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarFactura.php';
$descripcion = "Correccion a la factura: $pk_id_factura con numCaptura: $cuenta, ";
$clave = 'facturas';
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['data'] = $folio;
$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";

exit_script($system_callback);

?>

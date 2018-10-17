<?php
$xml = '';
$ret = '';
$comprobante = '';
$nodo = 'Comprobante';

require $root . '/conta6/Resources/PHP/actions/consultaDatosGrales_CFDI.php'; #$CFDversion,$regimen,$cveIVA
require $root . '/conta6/Ubicaciones/Contabilidad/actions/consultaDatosCFDI_factura_captura.php'; #$total_consultaDatosCaptura
if( $total_consultaDatosCaptura > 0 ){
  $row_consultaDatosCaptura = $rslt_consultaDatosCaptura->fetch_assoc();
  $id_formapago = $row_consultaDatosCaptura['fk_id_formapago'];
  $totalGralImporte = $row_consultaDatosCaptura['n_total_gral_importe'];
  $moneda = $row_consultaDatosCaptura['fk_id_moneda'];
  $tipoCambio = $row_consultaDatosCaptura['n_tipoCambio'];
  $totalGral = $row_consultaDatosCaptura['n_total_gral'];
  $tipoDeComprobante = $row_consultaDatosCaptura['s_tipoDeComprobante'];
  $metodoPago = $row_consultaDatosCaptura['fk_c_MetodoPago'];
  $r_rfc = utf8_encode($row_consultaDatosCaptura['s_rfc']);
  $r_razon_social = utf8_encode($row_consultaDatosCaptura['s_nombre']);
  $usoCFDI = $row_consultaDatosCaptura['pk_c_UsoCFDI'];
  $iva_aplicado = number_format($row_consultaDatosCaptura['n_IVA_aplicado']/100,6,'.','');
  $IVAretenido = $row_consultaDatosCaptura['s_fac_IVA_retenido'];
  $totaGralIVA = $row_consultaDatosCaptura['n_total_gral_IVA'];
  $total_cta_gastos = $row_consultaDatosCaptura['n_total_cta_gastos'];
  $fac_saldo = $row_consultaDatosCaptura['n_fac_saldo'];
  $c_MetodoPago = $row_consultaDatosCaptura['fk_c_MetodoPago'];
  $Total_Anticipos = $row_consultaDatosCaptura['n_total_depositos'];
  $POCME_Total_MN = $row_consultaDatosCaptura['n_total_POCME'];
}

require $root . '/conta6/Resources/PHP/actions/consultaDatosCertificado.php'; #$total_datosCert
$noCertificado = $row_datosCert['pk_id_certificado'];
$certificado = $row_datosCert['s_certificado'];

require $root . '/conta6/Resources/PHP/actions/consultaDatosOficinaActiva.php';
$ex_cp = $row_oficinaActiva['s_codigo'];
$lugarExpedicion = $ex_cp;
$ex_estado = $row_oficinaActiva['s_estado'];
$lugarExpedicionTxt = $ex_cp.' '.$ex_estado;

require $root . '/conta6/Resources/PHP/actions/consultaDatosCIA.php';
$e_rfc = trim($rowCIA['s_RFC']);
$e_razon_social = $rowCIA['s_Razon_Social'];
$regimen = trim($rowCIA['fk_id_regimen']);


$array= array( 'Version'=>$CFDversion,
                'Folio'=>$folioFactura,
                'Fecha'=>$fechaFactura,
                'Sello'=>'NA',
                'FormaPago'=>$id_formapago,
                'NoCertificado'=>$noCertificado,
                'Certificado'=>$certificado,
                'CondicionesDePago'=>'Mismo dia',
                'SubTotal'=>$totalGralImporte,
                'Moneda'=>$moneda,
                'TipoCambio'=>$tipoCambio,
                'Total'=>$totalGral,
                'TipoDeComprobante'=>$tipoDeComprobante,
                'MetodoPago'=>$metodoPago,
                'LugarExpedicion'=>$lugarExpedicion,
                'TasaOCuota' => $iva_aplicado,
                'Emisor' => array('Rfc'=>$e_rfc,
                                  'Nombre'=>$e_razon_social,
                                  'RegimenFiscal'=>$regimen),
                'Receptor' => array('Rfc' => $r_rfc,
                                    'Nombre' => $r_razon_social,
                                    'UsoCFDI' => $usoCFDI),
                'Traslados' => array('importe' => $totaGralIVA),
                'Retencion' => array('importe' => $IVAretenido),
                'Impuestos' => array('TotalImpuestosTrasladados' => $totaGralIVA,
                                     'TotalImpuestosRetenidos' => $IVAretenido));

require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosHonorarios_2.php';
if( $total_consultaHonorarios > 0 ) {
  $idFila = 0;
  while( $row_consultaHonXML = $rslt_consultaHonorarios->fetch_assoc()){
    ++$idFila;

    $fk_c_ClaveProdServ = $row_consultaHonXML['fk_c_ClaveProdServ'];
    $n_cantidad = number_format($row_consultaHonXML['n_cantidad'],6,'.','');
    $fk_c_claveUnidad = $row_consultaHonXML['fk_c_claveUnidad'];
    $s_unidad = $row_consultaHonXML['s_unidad'];
    $fk_id_cuenta = $row_consultaHonXML['fk_id_cuenta'];
    $s_conceptoEsp = utf8_encode($row_consultaHonXML['s_conceptoEsp']);
    $n_importe = number_format($row_consultaHonXML['n_importe'],2,'.','');
    $n_IVA = number_format($row_consultaHonXML['n_IVA'],2,'.','');
    $n_ret = number_format($row_consultaHonXML['n_ret'],2,'.','');
    $n_total = number_format($row_consultaHonXML['n_total'],2,'.','');

    if( $idFila == 1 && $fk_id_cuenta == '0400-00001' ){
      $porcentajeModifi = $row_consultaHonXML['n_porcentaje'];
      $baseModifi = $row_consultaHonXML['n_base'];
      $descuentoModifi = $row_consultaHonXML['n_descuento'];

      if( $porcentajeModifi > 0 ){ $porcentajeModifi = number_format($porcentajeModifi,4,'.',''); }else{ $porcentajeModifi = "0.00"; }
      $s_conceptoEspPrint = '% de Honorarios sobre la base de:';
      $s_conceptoEspPrint = $porcentajeModifi.' '.$s_conceptoEspPrint.' '.number_format($baseModifi,2,'.',',');
    }else{
      $s_conceptoEspPrint = $s_conceptoEsp;
    }


    if( $n_total >= 0 ){
      $array['Conceptos'][$idFila]['claveProdServ'] = $fk_c_ClaveProdServ;
      $array['Conceptos'][$idFila]['cantidad'] = $n_cantidad;
      $array['Conceptos'][$idFila]['claveUnidad'] = $fk_c_claveUnidad;
      $array['Conceptos'][$idFila]['unidad'] = $s_unidad;
      $array['Conceptos'][$idFila]['descripcion'] = $s_conceptoEspPrint;
      $array['Conceptos'][$idFila]['valorUnitario'] = $n_importe;
      $array['Conceptos'][$idFila]['importe'] = $n_importe;
      $array['Conceptos'][$idFila]['Impuesto'] = $cveIVA;
      $array['Conceptos'][$idFila]['impuesto'] = $n_IVA;
      $array['Conceptos'][$idFila]['retenido'] = $n_ret;
      $array['Conceptos'][$idFila]['TasaOCuota'] = $iva_aplicado;

    }
  }
}

?>

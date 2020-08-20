<?php
$xml = '';
$ret = '';
$comprobante = '';
$nodo = 'Comprobante';

require $root . '/Resources/PHP/actions/consultaDatosGrales_CFDI.php'; #$CFDversion,$regimen,$cveIVA
require $root . '/Ubicaciones/Contabilidad/actions/consultaDatosCFDI_notacredito_captura.php'; #$total_consultaDatosCaptura
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

  $id_facturaRelacionada = $row_consultaDatosCaptura['fk_id_factura'];
  $UUID_relacionado = $row_consultaDatosCaptura['s_UUID_factura'];

  $fk_c_ClaveProdServ = '84111506';
  $n_cantidad = number_format(1,6,'.','');
  $fk_c_claveUnidad = 'ACT';
  $s_descripNC = utf8_encode($row_consultaDatosCaptura['s_descripNC']);
  $n_importe = number_format($row_consultaDatosCaptura['n_total_gral_importe'],2,'.','');
  $n_IVA = number_format($row_consultaDatosCaptura['n_total_gral_IVA'],2,'.','');
  $n_ret = number_format($row_consultaDatosCaptura['s_fac_IVA_retenido'],2,'.','');
  $n_total = number_format($row_consultaDatosCaptura['n_total_gral'],2,'.','');


}

require $root . '/Resources/PHP/actions/consultaDatosCertificado.php'; #$total_datosCert
$noCertificado = $row_datosCert['pk_id_certificado'];
$certificado = $row_datosCert['s_certificado'];

require $root . '/Resources/PHP/actions/consultaDatosOficinaActiva.php';
$ex_cp = $row_oficinaActiva['s_codigo'];
$lugarExpedicion = $ex_cp;
$ex_estado = $row_oficinaActiva['s_estado'];
$lugarExpedicionTxt = $ex_cp.' '.$ex_estado;

require $root . '/Resources/PHP/actions/consultaDatosCIA.php';
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
                'CfdiRelacionados' => array('TipoRelacion' => '01'),
                'CfdiRelacionado' =>  array('UUID' => $UUID_relacionado),
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



    # Concepto de nota de credito
    $fk_c_ClaveProdServ = '84111506';
    $n_cantidad = number_format(1,6,'.','');
    $fk_c_claveUnidad = 'ACT';
    $s_descripNC = utf8_encode($row_consultaDatosCaptura['s_descripNC']);
    $n_importe = number_format($row_consultaDatosCaptura['n_total_gral_importe'],2,'.','');
    $n_IVA = number_format($row_consultaDatosCaptura['n_total_gral_IVA'],2,'.','');
    $n_ret = number_format($row_consultaDatosCaptura['s_fac_IVA_retenido'],2,'.','');
    $n_total = number_format($row_consultaDatosCaptura['n_total_gral'],2,'.','');

    $idFila = 1;
    if( $n_importe >= 0 ){
      $array['Conceptos'][$idFila]['claveProdServ'] = $fk_c_ClaveProdServ;
      $array['Conceptos'][$idFila]['cantidad'] = $n_cantidad;
      $array['Conceptos'][$idFila]['claveUnidad'] = $fk_c_claveUnidad;
      $array['Conceptos'][$idFila]['descripcion'] = $s_descripNC;
      $array['Conceptos'][$idFila]['valorUnitario'] = $n_importe;
      $array['Conceptos'][$idFila]['importe'] = $n_importe;
      $array['Conceptos'][$idFila]['Impuesto'] = $cveIVA;
      $array['Conceptos'][$idFila]['impuesto'] = $n_IVA;
      $array['Conceptos'][$idFila]['retenido'] = $n_ret;
      $array['Conceptos'][$idFila]['TasaOCuota'] = $iva_aplicado;

    }


?>

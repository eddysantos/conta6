<?php
#comentar
/*
error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';
require $root . '/conta6/Resources/PHP/actions/validarFormulario.php';
#$cuenta = 14;
$cuenta = 15; #dos reg
*/


$xml = '';
$ret = '';
$comprobante = '';
$nodo = 'Comprobante';

require $root . '/conta6/Resources/PHP/actions/consultaDatosGrales_CFDI.php'; #$CFDversion,$regimen,$cveIVA
require $root . '/conta6/Ubicaciones/Contabilidad/actions/consultaDatosCFDI_pagos_captura.php'; #$total_consultaDatosCaptura
if( $total_consultaDatosCaptura > 0 ){
  $row_consultaDatosCaptura = $rslt_consultaDatosCaptura->fetch_assoc();

  $cantidad = $row_consultaDatosCaptura['n_cantidad'];
  $claveUnidad = $row_consultaDatosCaptura['fk_c_claveUnidad'];
  $claveProdServ = $row_consultaDatosCaptura['fk_c_ClaveProdServ'];
  $descripcion = $row_consultaDatosCaptura['s_descripcion'];
  $valor_unitario = $row_consultaDatosCaptura['n_valor_unitario'];
  $importe = $row_consultaDatosCaptura['n_importe'];
  $moneda = $row_consultaDatosCaptura['fk_id_monedaPago'];
  $tipoDeComprobante = $row_consultaDatosCaptura['s_tipoDeComprobante'];
  $r_rfc = utf8_encode($row_consultaDatosCaptura['s_rfc']);
  $r_razon_social = utf8_encode($row_consultaDatosCaptura['s_nombre']);
  $usoCFDI = $row_consultaDatosCaptura['fk_c_UsoCFDI'];

  $tipoRelacion = $row_consultaDatosCaptura['fk_c_TipoRelacion'];
  $UUID_relacionado = $row_consultaDatosCaptura['s_UUIDpagoSustituir'];
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
                    'NoCertificado'=>$noCertificado,
                    'Certificado'=>$certificado,
                    'SubTotal'=>$importe,
                    'Moneda'=>$moneda,
                    'Total'=>$importe,
                    'TipoDeComprobante'=>$tipoDeComprobante,
                    'LugarExpedicion'=>$lugarExpedicion,
                    'CfdiRelacionados' => array('TipoRelacion' => $tipoRelacion),
                    'CfdiRelacionado' =>  array('UUID' => $UUID_relacionado),
                    'Emisor' => array('Rfc'=>$e_rfc,
                                      'Nombre'=>$e_razon_social,
                                      'RegimenFiscal'=>$regimen),
                    'Receptor' => array('Rfc' => $r_rfc,
                                        'Nombre' => $r_razon_social,
                                        'UsoCFDI' => $usoCFDI),
                    'Pagos' => array('Version' => '1.0')

                  );

    $array['Conceptos'][1]['claveProdServ'] = $claveProdServ;
    $array['Conceptos'][1]['cantidad'] = $cantidad;
    $array['Conceptos'][1]['claveUnidad'] = $claveUnidad;
    $array['Conceptos'][1]['descripcion'] = $descripcion;
    $array['Conceptos'][1]['valorUnitario'] = $valor_unitario;
    $array['Conceptos'][1]['importe'] = $importe;



    require $root . '/conta6/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_detalle_2.php';
    if( $total_consultaDetalle > 0 ) {
      $idFila = 0;
      while(  $row_consultaDetalle = $rslt_consultaDetalle->fetch_assoc() ){
        ++$idFila;

        $pk_id_partida = $row_consultaDetalle['pk_id_partida'];
    		$d_fecha_docPago = $row_consultaDetalle['d_fecha_docPago'];
        $d_fecha_docPago = date_format(date_create($d_fecha_docPago),"Y-m-d\TH:i:s");
    		$fk_id_formapago = trim($row_consultaDetalle['fk_id_formapago']);
    		$s_numOperacion = $row_consultaDetalle['s_numOperacion'];
    		$fk_id_moneda = $row_consultaDetalle['fk_id_moneda'];
    		$n_tipoCambio = $row_consultaDetalle['n_tipoCambio'];
    		$n_importe = $row_consultaDetalle['n_importe'];
    		$n_deposito = $row_consultaDetalle['n_deposito'];
    		$n_iva = $row_consultaDetalle['n_iva'];
    		$s_rfcOrd = $row_consultaDetalle['s_rfcOrd'];
    		$s_nomBancoOrdExt = $row_consultaDetalle['s_nomBancoOrdExt'];
    		$s_ctaOrd = $row_consultaDetalle['s_ctaOrd'];
    		$s_rfcBen = $row_consultaDetalle['s_rfcBen'];
    		$s_ctaBen = $row_consultaDetalle['s_ctaBen'];
    		$s_tipoCadPago = $row_consultaDetalle['s_tipoCadPago'];
    		$s_certPago = $row_consultaDetalle['s_certPago'];
    		$s_cadPago = $row_consultaDetalle['s_cadPago'];
    		$s_selloPago = $row_consultaDetalle['s_selloPago'];
    		$fk_id_aduanaDR = $row_consultaDetalle['fk_id_aduanaDR'];
    		$fk_referenciaDR = $row_consultaDetalle['fk_referenciaDR'];
    		$fk_id_facturaDR = $row_consultaDetalle['fk_id_facturaDR'];
    		$s_UUID_DR = $row_consultaDetalle['s_UUID_DR'];
    		$fk_c_MetodoPagoDR = $row_consultaDetalle['fk_c_MetodoPagoDR'];
    		$fk_id_monedaDR = $row_consultaDetalle['fk_id_monedaDR'];
    		$n_tipoCambioDR = $row_consultaDetalle['n_tipoCambioDR'];
    		$totalDR = $row_consultaDetalle['totalDR'];
    		$n_numParcialidad = $row_consultaDetalle['n_numParcialidad'];
    		$n_importeSaldoAnterior = $row_consultaDetalle['n_importeSaldoAnterior'];
    		$n_importePagado = $row_consultaDetalle['n_importePagado'];
    		$n_importeSaldoInsoluto = $row_consultaDetalle['n_importeSaldoInsoluto'];
    		$s_usuario_alta = $row_consultaDetalle['s_usuario_alta'];
    		$d_fecha_alta = $row_consultaDetalle['d_fecha_alta'];
    		$n_CFDIrelacionado = $row_consultaDetalle['n_CFDIrelacionado'];
    		$s_tipoDetalle = $row_consultaDetalle['s_tipoDetalle'];

        $n_importeSaldoAnterior2 = $n_importeSaldoAnterior;
    		$n_importePagado2 = $n_importePagado;
    		$n_importeSaldoInsoluto2 = $n_importeSaldoInsoluto;


        #Pago
        $array['Pago'][$idFila]['FechaPago'] = $d_fecha_docPago;
        $array['Pago'][$idFila]['FormaDePagoP'] = $fk_id_formapago;
        $array['Pago'][$idFila]['MonedaP'] = $fk_id_moneda;
        $array['Pago'][$idFila]['TipoCambioP'] = $n_tipoCambio;
        $array['Pago'][$idFila]['Monto'] = $n_importe;
        $array['Pago'][$idFila]['NumOperacion'] = $s_numOperacion;
        $array['Pago'][$idFila]['RfcEmisorCtaOrd'] = $s_rfcOrd;
        $array['Pago'][$idFila]['CtaOrdenante'] = $s_ctaOrd;
        $array['Pago'][$idFila]['NomBancoOrdExt'] = $s_nomBancoOrdExt;
        $array['Pago'][$idFila]['RfcEmisorCtaBen'] = $s_rfcBen;
        $array['Pago'][$idFila]['CtaBeneficiario'] = $s_ctaBen;
        $array['Pago'][$idFila]['TipoCadPago'] = $s_tipoCadPago;
        $array['Pago'][$idFila]['CertPago'] = $s_certPago;
        $array['Pago'][$idFila]['CadPago'] = $s_cadPago;
        $array['Pago'][$idFila]['SelloPago'] = $s_selloPago;


        #DoctoRelacionado
        $array['DoctoRelacionado'][$idFila]['IdDocumento'] = $s_UUID_DR;
        $array['DoctoRelacionado'][$idFila]['Folio'] = $fk_id_facturaDR;
        $array['DoctoRelacionado'][$idFila]['MonedaDR'] = $fk_id_monedaDR;
        $array['DoctoRelacionado'][$idFila]['TipoCambioDR'] = $n_tipoCambioDR;
        $array['DoctoRelacionado'][$idFila]['MetodoDePagoDR'] = $fk_c_MetodoPagoDR;
        $array['DoctoRelacionado'][$idFila]['NumParcialidad'] = $n_numParcialidad;
        $array['DoctoRelacionado'][$idFila]['ImpSaldoAnt'] = $n_importeSaldoAnterior;
        $array['DoctoRelacionado'][$idFila]['ImpPagado'] = $n_importePagado;
        $array['DoctoRelacionado'][$idFila]['ImpSaldoInsoluto'] = $n_importeSaldoInsoluto;

      }
    }

//print_r($array);
//echo $array['CfdiRelacionado']['UUID'];
?>

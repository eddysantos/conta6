<?php
#comentar
/*
error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
require $root . '/Resources/PHP/actions/validarFormulario.php';
#$cuenta = 14;
$cuenta = 33; #dos reg
*/


$xml = '';
$ret = '';
$comprobante = '';
$nodo = 'Comprobante';

require $root . '/Resources/PHP/actions/consultaDatosGrales_CFDI.php'; #$CFDversion,$regimen,$cveIVA
require $root . '/Ubicaciones/Contabilidad/actions/consultaDatosCFDI_pagos_captura.php'; #$total_consultaDatosCaptura
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



    require $root . '/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_detalle_2.php';
    if( $total_consultaDetalle > 0 ) {
      $idFila = 0;
      while(  $row_consultaDetalle = $rslt_consultaDetalle->fetch_assoc() ){
        ++$idFila;

        $pk_rowPago = $row_consultaDetalle['n_pk_rowPago'];
    		$d_fecha_docPago = $row_consultaDetalle['d_fecha_docPago'];
        $d_fecha_docPago = date_format(date_create($d_fecha_docPago),"Y-m-d\TH:i:s");
    		$fk_id_formapago = trim($row_consultaDetalle['fk_id_formapago']);
    		$s_numOperacion = $row_consultaDetalle['s_numOperacion'];
    		$fk_id_moneda = $row_consultaDetalle['fk_id_moneda'];
    		$n_tipoCambio = $row_consultaDetalle['n_tipoCambio'];
        $s_rfcOrd = $row_consultaDetalle['s_rfcOrd'];
        $s_nomBancoOrdExt = $row_consultaDetalle['s_nomBancoOrdExt'];
        $s_ctaOrd = $row_consultaDetalle['s_ctaOrd'];
        $s_rfcBen = $row_consultaDetalle['s_rfcBen'];
        $s_ctaBen = $row_consultaDetalle['s_ctaBen'];
        $s_tipoCadPago = $row_consultaDetalle['s_tipoCadPago'];
        $s_certPago = $row_consultaDetalle['s_certPago'];
        $s_cadPago = $row_consultaDetalle['s_cadPago'];
        $s_selloPago = $row_consultaDetalle['s_selloPago'];
        $n_importePago = $row_consultaDetalle['n_importe'];

        #Pago
        $array['Pago'][$idFila]['FechaPago'] = $d_fecha_docPago;
        $array['Pago'][$idFila]['FormaDePagoP'] = $fk_id_formapago;
        $array['Pago'][$idFila]['MonedaP'] = $fk_id_moneda;
        $array['Pago'][$idFila]['TipoCambioP'] = $n_tipoCambio;
        $array['Pago'][$idFila]['Monto'] = $n_importePago;
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
        $array['Pago'][$idFila]['pk_rowPago'] = $pk_rowPago;

        #echo '<br>pago'.$idFila.'row'.$pk_rowPago.'/';


      }
    }

    require $root . '/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_detalle_DR.php';
    if( $total_consultaDetalle_DR > 0 ) {
      $idFilaDR = 0;
      while(  $row_consultaDetalle_DR = $rslt_consultaDetalle_DR->fetch_assoc() ){
        ++$idFilaDR;

        $fk_rowPago = $row_consultaDetalle_DR['n_fk_rowPago'];
        $n_deposito = $row_consultaDetalle_DR['n_deposito'];
        $n_iva = $row_consultaDetalle_DR['n_iva'];
        $fk_id_aduanaDR = $row_consultaDetalle_DR['fk_id_aduanaDR'];
        $fk_referenciaDR = $row_consultaDetalle_DR['fk_referenciaDR'];
        $fk_id_facturaDR = $row_consultaDetalle_DR['fk_id_facturaDR'];
        $s_UUID_DR = $row_consultaDetalle_DR['s_UUID_DR'];
        $fk_c_MetodoPagoDR = $row_consultaDetalle_DR['fk_c_MetodoPagoDR'];
        $fk_id_monedaDR = $row_consultaDetalle_DR['fk_id_monedaDR'];
        $n_tipoCambioDR = $row_consultaDetalle_DR['n_tipoCambioDR'];
        $totalDR = $row_consultaDetalle_DR['totalDR'];
        $n_numParcialidad = $row_consultaDetalle_DR['n_numParcialidad'];
        $n_importeSaldoAnterior = $row_consultaDetalle_DR['n_importeSaldoAnterior'];
        $n_importePagado = $row_consultaDetalle_DR['n_importePagado'];
        $n_importeSaldoInsoluto = $row_consultaDetalle_DR['n_importeSaldoInsoluto'];
        $s_usuario_alta = $row_consultaDetalle_DR['s_usuario_alta'];
        $d_fecha_alta = $row_consultaDetalle_DR['d_fecha_alta'];

        $n_importeSaldoAnterior2 = $n_importeSaldoAnterior;
        $n_importePagado2 = $n_importePagado;
        $n_importeSaldoInsoluto2 = $n_importeSaldoInsoluto;

        #echo 'DR'.$idFilaDR.'row'.$fk_rowPago;
        #DoctoRelacionado
        $array['DoctoRelacionado'][$idFilaDR]['IdDocumento'] = $s_UUID_DR;
        $array['DoctoRelacionado'][$idFilaDR]['Folio'] = $fk_id_facturaDR;
        $array['DoctoRelacionado'][$idFilaDR]['MonedaDR'] = $fk_id_monedaDR;
        $array['DoctoRelacionado'][$idFilaDR]['TipoCambioDR'] = $n_tipoCambioDR;
        $array['DoctoRelacionado'][$idFilaDR]['MetodoDePagoDR'] = $fk_c_MetodoPagoDR;
        $array['DoctoRelacionado'][$idFilaDR]['NumParcialidad'] = $n_numParcialidad;
        $array['DoctoRelacionado'][$idFilaDR]['ImpSaldoAnt'] = $n_importeSaldoAnterior;
        $array['DoctoRelacionado'][$idFilaDR]['ImpPagado'] = $n_importePagado;
        $array['DoctoRelacionado'][$idFilaDR]['ImpSaldoInsoluto'] = $n_importeSaldoInsoluto;
        $array['DoctoRelacionado'][$idFilaDR]['fk_rowPago'] = $fk_rowPago;
      }
    }

//print_r($array);
//echo $array['CfdiRelacionado']['UUID'];
?>

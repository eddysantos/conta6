<?PHP
  require $root . '/conta6/Resources/PHP/actions/consultaDatosGrales_CFDI.php'; #$CFDversion,$regimen,$cveIVA
  require $root . '/conta6/Ubicaciones/Contabilidad/actions/consultaDatosCFDI_factura_captura.php'; #$rslt_consultaDatosCaptura
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

  }

  require $root . '/conta6/Resources/PHP/actions/consultaDatosOficinaActiva.php';
  $ex_estado = $row_oficinaActiva['s_estado'];
  $ex_cp = $row_oficinaActiva['s_codigo'];
  $lugarExpedicion = $ex_cp;
  $lugarExpedicionTxt = $ex_cp.' '.$ex_estado;


   require $root . '/conta6/Resources/PHP/actions/consultaDatosCIA.php';
   $e_rfc = trim($rowCIA['s_RFC']);
   $e_razon_social = utf8_encode(trim($rowCIA['s_Razon_Social']));
   $regimen = trim($rowCIA['fk_id_regimen']);

   require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosHonorarios_2.php';

  $xml = new DomDocument('1.0', 'UTF-8');
  $comprobante = $xml->createElement('cfdi:Comprobante');
    $comprobante = $xml->appendChild($comprobante);
    $comprobante->setAttribute('xmlns:cfdi','http://www.sat.gob.mx/cfd/3');
    $comprobante->setAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
    $comprobante->setAttribute('xsi:schemaLocation','http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd');
    $comprobante->setAttribute('Version',$CFDversion);
    $comprobante->setAttribute('Folio',$folioFactura);
    $comprobante->setAttribute('Fecha',$fechaFactura);
    $comprobante->setAttribute('Sello','');
    $comprobante->setAttribute('FormaPago',$id_formapago);
    $comprobante->setAttribute('NoCertificado',$noCertificado);
    $comprobante->setAttribute('Certificado',$certificado);
    $comprobante->setAttribute('CondicionesDePago','Mismo dia');
    $comprobante->setAttribute('SubTotal',$totalGralImporte);
    $comprobante->setAttribute('Moneda',$moneda);
    if( $moneda != 'MXN' ){
    $comprobante->setAttribute('TipoCambio',$tipoCambio);
    }
    $comprobante->setAttribute('Total',$totalGral);
    $comprobante->setAttribute('TipoDeComprobante',$tipoDeComprobante);
    $comprobante->setAttribute('MetodoPago',$metodoPago);
    $comprobante->setAttribute('LugarExpedicion',$lugarExpedicion);

    $emisor = $xml->createElement('cfdi:Emisor');
      $emisor = $comprobante->appendChild($emisor);
      $emisor->setAttribute('Rfc',$e_rfc);
      $emisor->setAttribute('Nombre',$e_razon_social);
      $emisor->setAttribute('RegimenFiscal',$regimen);

    $receptor = $xml->createElement('cfdi:Receptor');
      $receptor = $comprobante->appendChild($receptor);
      $receptor->setAttribute('Rfc',$r_rfc);
      $receptor->setAttribute('Nombre',$r_razon_social);
      $receptor->setAttribute('UsoCFDI',$usoCFDI);

    $conceptos = $xml->createElement('cfdi:Conceptos');
      $conceptos = $comprobante->appendChild($conceptos);

if( $total_consultaHonorarios > 0 ) {
  $idFila = 0;
  while( $row_consultaHonXML = $rslt_consultaHonorarios->fetch_assoc()){
    ++$idFila;

    $fk_c_ClaveProdServ = $row_consultaHonXML['fk_c_ClaveProdServ'];
    $n_cantidad = number_format($row_consultaHonXML['n_cantidad'],2,'.','');
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
      $concepto = $xml->createElement('cfdi:Concepto');
        $concepto = $conceptos->appendChild($concepto);
        $concepto->setAttribute('ClaveProdServ',$fk_c_ClaveProdServ);
        $concepto->setAttribute('Cantidad',$n_cantidad);
        $concepto->setAttribute('ClaveUnidad',$fk_c_claveUnidad);
        $concepto->setAttribute('Unidad',$fk_c_claveUnidad);
        $concepto->setAttribute('Descripcion',$s_conceptoEspPrint);
        $concepto->setAttribute('ValorUnitario',$n_importe);
        $concepto->setAttribute('Importe',$n_importe);

        $impuestosConcep = $xml->createElement('cfdi:Impuestos');
          $impuestosConcep = $concepto->appendChild($impuestosConcep);

          $trasladosConcep = $xml->createElement('cfdi:Traslados');
              $trasladosConcep = $impuestosConcep->appendChild($trasladosConcep);

              $trasladoConcep = $xml->createElement('cfdi:Traslado');
                $trasladoConcep = $trasladosConcep->appendChild($trasladoConcep);
                $trasladoConcep->setAttribute('Base',$n_importe);
                $trasladoConcep->setAttribute('Impuesto',$cveIVA);
                $trasladoConcep->setAttribute('TipoFactor','Tasa');
                $trasladoConcep->setAttribute('TasaOCuota',$iva_aplicado);
                $trasladoConcep->setAttribute('Importe',$n_IVA);

          if( $n_ret > 0 ){
          $retencionesConcep = $xml->createElement('cfdi:Retenciones');
            $retencionesConcep = $impuestosConcep->appendChild($retencionesConcep);

            $retencionConcep = $xml->createElement('cfdi:Retencion');
              $retencionConcep = $retencionesConcep->appendChild($retencionConcep);
              $retencionConcep->setAttribute('Base',$n_importe);
              $retencionConcep->setAttribute('Impuesto',$cveIVA);
              $retencionConcep->setAttribute('TipoFactor','Tasa');
              $retencionConcep->setAttribute('TasaOCuota','0.040000');
              $retencionConcep->setAttribute('Importe',$n_ret);
          }
    }
  }
}

      $impuestos = $xml->createElement('cfdi:Impuestos');
        $impuestos = $comprobante->appendChild($impuestos);
        if( $IVAretenido > 0 ){
        $impuestos->setAttribute('TotalImpuestosRetenidos',$IVAretenido);
        }
        $impuestos->setAttribute('TotalImpuestosTrasladados',$totaGralIVA);

        if( $IVAretenido > 0 ){
        $retenciones = $xml->createElement('cfdi:Retenciones');
          $retenciones = $impuestos->appendChild($retenciones);

          $retencion = $xml->createElement('cfdi:Retencion');
            $retencion = $retenciones->appendChild($retencion);
            $retencion->setAttribute('Impuesto',$cveIVA);
            $retencion->setAttribute('Importe',$IVAretenido);
        }

          $traslados = $xml->createElement('cfdi:Traslados');
            $traslados = $impuestos->appendChild($traslados);

            $traslado = $xml->createElement('cfdi:Traslado');
              $traslado = $traslados->appendChild($traslado);
              $traslado->setAttribute('Impuesto',$cveIVA);
              $traslado->setAttribute('TipoFactor','Tasa');
              $traslado->setAttribute('TasaOCuota',$iva_aplicado);
              $traslado->setAttribute('Importe',$totaGralIVA);


  $xml->formatOutput = true;
  $el_xml = $xml->saveXML();
  $xml->save($rutaTempFile);

  //Mostramos el XML puro
  //echo '<p><b>El XML ha sido creado.... Mostrando en texto plano:</b></p>'.htmlentities($el_xml).'<br/><hr>';

?>

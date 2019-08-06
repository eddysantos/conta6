<?PHP
#Datos generales
function xmlV33_generales($array,$nodo){
  global $comprobante, $xml;
	$comprobante = $xml->createElement("cfdi:Comprobante");
	$comprobante = $xml->appendChild($comprobante);
  xmlV33_cargaAtt($comprobante, array("xmlns:cfdi"=>"http://www.sat.gob.mx/cfd/3",
							  "xmlns:xsi"=>"http://www.w3.org/2001/XMLSchema-instance",
							  "xsi:schemaLocation"=>"http://www.sat.gob.mx/cfd/3  http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd"
	));

  xmlV33_cargaAtt($comprobante, array("Version"=>$array['Version'],
                            						  "Folio"=>$array['Folio'],
                            						  "Fecha"=>$array['Fecha'],
                            						  "Sello"=>"@",
                            						  "FormaPago"=>$array['FormaPago'],
                            						  "MetodoPago"=>$array['MetodoPago'],
                            						  "NoCertificado"=>$array['NoCertificado'],
                            						  "Certificado"=>$array['Certificado'],
                            						  "SubTotal"=>$array['SubTotal'],
                            						  "Total"=>$array['Total'],
                            						  "Moneda"=>$array['Moneda'],
                            						  "TipoCambio"=>$array['TipoCambio'],
                            						  "TipoDeComprobante"=>$array['TipoDeComprobante'],
                            						  "LugarExpedicion"=>$array['LugarExpedicion'] ));

}

function xmlV33_generales_pago($array,$nodo){
  global $comprobante, $xml;
	$comprobante = $xml->createElement("cfdi:Comprobante");
	$comprobante = $xml->appendChild($comprobante);
  xmlV33_cargaAtt($comprobante, array("xmlns:cfdi"=>"http://www.sat.gob.mx/cfd/3",
							  "xmlns:xsi"=>"http://www.w3.org/2001/XMLSchema-instance",
                "xmlns:pago10"=>"http://www.sat.gob.mx/Pagos",
							  "xsi:schemaLocation"=>"http://www.sat.gob.mx/cfd/3  http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd http://www.sat.gob.mx/Pagos http://www.sat.gob.mx/sitio_internet/cfd/Pagos/Pagos10.xsd"
	));

  xmlV33_cargaAtt($comprobante, array("Version"=>$array['Version'],
                            						  "Folio"=>$array['Folio'],
                            						  "Fecha"=>$array['Fecha'],
                            						  "Sello"=>"@",

                            						  "NoCertificado"=>$array['NoCertificado'],
                            						  "Certificado"=>$array['Certificado'],
                            						  "SubTotal"=>$array['SubTotal'],
                                          "Moneda"=>$array['Moneda'],

                            						  "Total"=>$array['Total'],
                            						  "TipoDeComprobante"=>$array['TipoDeComprobante'],
                            						  "LugarExpedicion"=>$array['LugarExpedicion'] ));

}

# CFDI Relacionados
function xmlV33_cfdi_relacionados($array,$nodo) {
	global $comprobante, $xml;
	$relacionados = $xml->createElement("cfdi:CfdiRelacionados");
	$relacionados = $comprobante->appendChild($relacionados);
  $relacionados->SetAttribute("TipoRelacion",$array['CfdiRelacionados']['TipoRelacion']);

  	$relacionado = $xml->createElement("cfdi:CfdiRelacionado");
  	$relacionado = $relacionados->appendChild($relacionado);
    $relacionado->SetAttribute("UUID",$array['CfdiRelacionado']['UUID']);
}

#Datos del emisor
function xmlV33_emisor($array,$nodo) {
	global $comprobante, $xml;
	$emisor = $xml->createElement("cfdi:Emisor");
	$emisor = $comprobante->appendChild($emisor);
	xmlV33_cargaAtt($emisor, array("Rfc"=>$array['Emisor']['Rfc'],
                      						   "Nombre"=>$array['Emisor']['Nombre'],
                      						   "RegimenFiscal"=>$array['Emisor']['RegimenFiscal'] ));
}

#Datos del receptor
function xmlV33_receptor($array,$nodo) {
	global $comprobante, $xml;
	$receptor = $xml->createElement("cfdi:Receptor");
	$receptor = $comprobante->appendChild($receptor);
	$nombre = xmlV33_fix_chr($array['Receptor']['Nombre']);
	xmlV33_cargaAtt($receptor, array("Rfc"=>$array['Receptor']['Rfc'],
                      							   "Nombre"=>$nombre,
                      							   "UsoCFDI"=>$array['Receptor']['UsoCFDI'] ));
}

#Detalle de los conceptos/productos de la factura
function xmlV33_conceptos($array,$nodo) {
	global $comprobante, $xml;
	$conceptos = $xml->createElement("cfdi:Conceptos");
	$conceptos = $comprobante->appendChild($conceptos);
	for ($i=1; $i<=sizeof($array['Conceptos']); $i++) {
		$concepto = $xml->createElement("cfdi:Concepto");
		$concepto = $conceptos->appendChild($concepto);
		$prun = $array['Conceptos'][$i]['valorUnitario'];
		$descripcion = xmlV33_fix_chr($array['Conceptos'][$i]['descripcion']);
		xmlV33_cargaAtt($concepto,
			array("ClaveProdServ"=>$array['Conceptos'][$i]['claveProdServ'],
            "Cantidad"=>$array['Conceptos'][$i]['cantidad'],
            "ClaveUnidad"=>$array['Conceptos'][$i]['claveUnidad'],
  				  "Unidad"=>$array['Conceptos'][$i]['unidad'],
  				  "Descripcion"=>$descripcion,
  				  "ValorUnitario"=>$array['Conceptos'][$i]['valorUnitario'],
  				  "Importe"=>$array['Conceptos'][$i]['importe'],
				 )
			);
      #"NoIdentificacion"=>$array['Conceptos'][$i]['NoIdentificacion'],
		$impuestos = $xml->createElement("cfdi:Impuestos");
		$impuestos = $concepto->appendChild($impuestos);

		$traslados = $xml->createElement("cfdi:Traslados");
		$traslados = $impuestos->appendChild($traslados);
		$traslado = $xml->createElement("cfdi:Traslado");
		$traslado = $traslados->appendChild($traslado);
		xmlV33_cargaAtt($traslado,
			array("Base"=>$array['Conceptos'][$i]['importe'],
            "Impuesto"=>"002",
            "TipoFactor"=>"Tasa",
				    "TasaOCuota"=>$array['Conceptos'][$i]['TasaOCuota'],
            "Importe"=>$array['Conceptos'][$i]['impuesto']
				 )
			);

      if( $array['Conceptos'][$i]['retenido'] > 0 ){
        $retenciones = $xml->createElement("cfdi:Retenciones");
        $retenciones = $impuestos->appendChild($retenciones);
        $retencion = $xml->createElement("cfdi:Retencion");
        $retencion = $retenciones->appendChild($retencion);
        xmlV33_cargaAtt($retencion,
    			array("Base"=>$array['Conceptos'][$i]['importe'],
                "Impuesto"=>"002",
                "TipoFactor"=>"Tasa",
    				    "TasaOCuota"=>"0.040000",
    				    "Importe"=>$array['Conceptos'][$i]['retenido'] )
    			);
      }
	}
}

#Detalle de los concepto/producto de la nota de credito
function xmlV33_conceptos_NC($array,$nodo) {
	global $comprobante, $xml;
	$conceptos = $xml->createElement("cfdi:Conceptos");
	$conceptos = $comprobante->appendChild($conceptos);
	for ($i=1; $i<=sizeof($array['Conceptos']); $i++) {
		$concepto = $xml->createElement("cfdi:Concepto");
		$concepto = $conceptos->appendChild($concepto);
		$prun = $array['Conceptos'][$i]['valorUnitario'];
		$descripcion = xmlV33_fix_chr($array['Conceptos'][$i]['descripcion']);
		xmlV33_cargaAtt($concepto,
			array("ClaveProdServ"=>$array['Conceptos'][$i]['claveProdServ'],
            "Cantidad"=>$array['Conceptos'][$i]['cantidad'],
            "ClaveUnidad"=>$array['Conceptos'][$i]['claveUnidad'],
  				  "Descripcion"=>$descripcion,
  				  "ValorUnitario"=>$array['Conceptos'][$i]['valorUnitario'],
  				  "Importe"=>$array['Conceptos'][$i]['importe'],
				 )
			);
      #"NoIdentificacion"=>$array['Conceptos'][$i]['NoIdentificacion'],
		$impuestos = $xml->createElement("cfdi:Impuestos");
		$impuestos = $concepto->appendChild($impuestos);

		$traslados = $xml->createElement("cfdi:Traslados");
		$traslados = $impuestos->appendChild($traslados);
		$traslado = $xml->createElement("cfdi:Traslado");
		$traslado = $traslados->appendChild($traslado);
		xmlV33_cargaAtt($traslado,
			array("Base"=>$array['Conceptos'][$i]['importe'],
            "Impuesto"=>"002",
            "TipoFactor"=>"Tasa",
				    "TasaOCuota"=>$array['Conceptos'][$i]['TasaOCuota'],
            "Importe"=>$array['Conceptos'][$i]['impuesto']
				 )
			);

      if( $array['Conceptos'][$i]['retenido'] > 0 ){
        $retenciones = $xml->createElement("cfdi:Retenciones");
        $retenciones = $impuestos->appendChild($retenciones);
        $retencion = $xml->createElement("cfdi:Retencion");
        $retencion = $retenciones->appendChild($retencion);
        xmlV33_cargaAtt($retencion,
    			array("Base"=>$array['Conceptos'][$i]['importe'],
                "Impuesto"=>"002",
                "TipoFactor"=>"Tasa",
    				    "TasaOCuota"=>"0.040000",
    				    "Importe"=>$array['Conceptos'][$i]['retenido'] )
    			);
      }
	}
}

#Detalle de los concepto/producto de pagos
function xmlV33_concepto_pago($array,$nodo) {
	global $comprobante, $xml;
	$conceptos = $xml->createElement("cfdi:Conceptos");
	$conceptos = $comprobante->appendChild($conceptos);
	for ($i=1; $i<=sizeof($array['Conceptos']); $i++) {
		$concepto = $xml->createElement("cfdi:Concepto");
		$concepto = $conceptos->appendChild($concepto);
		$prun = $array['Conceptos'][$i]['valorUnitario'];
		$descripcion = xmlV33_fix_chr($array['Conceptos'][$i]['descripcion']);
		xmlV33_cargaAtt($concepto,
			array("ClaveProdServ"=>$array['Conceptos'][$i]['claveProdServ'],
            "Cantidad"=>$array['Conceptos'][$i]['cantidad'],
            "ClaveUnidad"=>$array['Conceptos'][$i]['claveUnidad'],
  				  "Descripcion"=>$descripcion,
  				  "ValorUnitario"=>$array['Conceptos'][$i]['valorUnitario'],
  				  "Importe"=>$array['Conceptos'][$i]['importe'],
				 )
			);
	}
}

# Complemento --------------------------------------------------------------------------------------------------------------
function xmlV33_complemento_pago($array,$nodo) {
	global $comprobante, $xml;
	$complemento = $xml->createElement("cfdi:Complemento");
	$complemento = $comprobante->appendChild($complemento);

		$pagos = $xml->createElement("pago10:Pagos");
		$pagos = $complemento->appendChild($pagos);
		xmlV33_cargaAtt($pagos,array("Version"=>$array['Pagos']['Version']));

    for ($i=1; $i<=sizeof($array['Pago']); $i++) {
  		$pago = $xml->createElement("pago10:Pago");
  		$pago = $pagos->appendChild($pago);
      $pk_rowPago = $array['Pago'][$i]['pk_rowPago'];

  		xmlV33_cargaAtt($pago,array("FechaPago"=>$array['Pago'][$i]['FechaPago'],
                                  "FormaDePagoP"=>$array['Pago'][$i]['FormaDePagoP'],
                                  "MonedaP"=>$array['Pago'][$i]['MonedaP'],
                                  "Monto"=>$array['Pago'][$i]['Monto'],
                                  "NumOperacion"=>$array['Pago'][$i]['NumOperacion'],
                                  "RfcEmisorCtaOrd"=>$array['Pago'][$i]['RfcEmisorCtaOrd'],
                                  "NomBancoOrdExt"=>$array['Pago'][$i]['NomBancoOrdExt'],
                                  "CtaOrdenante"=>$array['Pago'][$i]['CtaOrdenante'],
                                  "RfcEmisorCtaBen"=>$array['Pago'][$i]['RfcEmisorCtaBen'],
                                  "CtaBeneficiario"=>$array['Pago'][$i]['CtaBeneficiario'],
                                  "TipoCadPago"=>$array['Pago'][$i]['TipoCadPago'],
                                  "CertPago"=>$array['Pago'][$i]['CertPago'],
                                  "CadPago"=>$array['Pago'][$i]['CadPago'],
                                  "SelloPago"=>$array['Pago'][$i]['SelloPago']
        )
      );




      for ($dr=1; $dr<=sizeof($array['DoctoRelacionado']); $dr++) {
        $tipoCambioDR = $array['DoctoRelacionado'][$dr]['TipoCambioDR'];
        if( $tipoCambioDR == 0 or $tipoCambioDR == 1 ){ $tipoCambioDR = ''; }

        $fk_rowPago = $array['DoctoRelacionado'][$dr]['fk_rowPago'];
        if( $pk_rowPago === $fk_rowPago ){
          $DR = $xml->createElement("pago10:DoctoRelacionado");
          $DR = $pago->appendChild($DR);
          xmlV33_cargaAtt($DR,array("IdDocumento"=>$array['DoctoRelacionado'][$dr]['IdDocumento'],
                                    "Folio"=>$array['DoctoRelacionado'][$dr]['Folio'],
                                    "MonedaDR"=>$array['DoctoRelacionado'][$dr]['MonedaDR'],
                                    "TipoCambioDR"=>$tipoCambioDR,
                                    "MetodoDePagoDR"=>$array['DoctoRelacionado'][$dr]['MetodoDePagoDR'],
                                    "NumParcialidad"=>$array['DoctoRelacionado'][$dr]['NumParcialidad'],
                                    "ImpSaldoAnt"=>$array['DoctoRelacionado'][$dr]['ImpSaldoAnt'],
                                    "ImpPagado"=>$array['DoctoRelacionado'][$dr]['ImpPagado'],
                                    "ImpSaldoInsoluto"=>$array['DoctoRelacionado'][$dr]['ImpSaldoInsoluto']
            )
          );
        }
      }#fin DoctoRelacionado


    }#fin pago

}# fin complemento pago

# Complemento/ --------------------------------------------------------------------------------------------------------------

# Totales Impuestos
function xmlV33_impuestos($array,$nodo) {
	global $comprobante, $xml;
	$impuestos = $xml->createElement("cfdi:Impuestos");
	$impuestos = $comprobante->appendChild($impuestos);


  if( $array['Retencion']['importe'] > 0 ){
    $retenciones = $xml->createElement("cfdi:Retenciones");
    $retenciones = $impuestos->appendChild($retenciones);
    foreach ($array['Retencion'] as $TasaOCuota => $iva_aplicado) {
      $retencion = $xml->createElement("cfdi:Retencion");
      $retencion = $retenciones->appendChild($retencion);
      $ret = $array['Retencion']['importe'];
      xmlV33_cargaAtt($retencion,
      array("Impuesto"=>"002",
            "Importe"=>$ret));
    }
    $impuestos->setAttribute('TotalImpuestosRetenidos',$ret);
  }


	$traslados = $xml->createElement("cfdi:Traslados");
	$traslados = $impuestos->appendChild($traslados);
	foreach ($array['Traslados'] as $TasaOCuota => $iva_aplicado) {
		$traslado = $xml->createElement("cfdi:Traslado");
		$traslado = $traslados->appendChild($traslado);
		xmlV33_cargaAtt($traslado,
		   array("Impuesto"=>"002",
				 "TipoFactor"=>"Tasa",
				 "TasaOCuota"=>$array['TasaOCuota'],
				 "Importe"=>$array['Traslados']['importe']
				)
			);
	}
  $impuestos->SetAttribute("TotalImpuestosTrasladados",$array['Traslados']['importe']);
}


#genera_cadena_original
function xmlV33_genera_cadena_original() {
	global $xml, $cadena_original, $root;
	$paso = new DOMDocument("1.0","UTF-8");
	$paso->loadXML($xml->saveXML());
	$xsl = new DOMDocument("1.0","UTF-8");
  $file = $root . '/conta6/Resources/xsi/cadenaoriginal_3_3.xslt';
	$xsl->load($file);
	$proc = new XSLTProcessor;
	$proc->importStyleSheet($xsl);
	$cadena_original = $proc->transformToXML($paso);
  //solo para pruebas
  return($cadena_original);
}



#Calculo de sello
function xmlV33_sella($array) {
  global $comprobante, $cadena_original, $root;
  #ruta
  #$fileKey = $root . '/conta6/Resources/clavesKeyCer/key2017.pem';
  require $root . '/conta6/Resources/PHP/actions/generarCFDI_proceso_rutaKeyCer.php'; #$fileKey,$fileCer
  $certificado = $array['NoCertificado'];
  $pkeyid = openssl_get_privatekey(file_get_contents($fileKey));
  openssl_sign($cadena_original, $crypttext, $pkeyid, OPENSSL_ALGO_SHA256);
  openssl_free_key($pkeyid);
  $sello = base64_encode($crypttext);      // lo codifica en formato base64
  $comprobante->setAttribute("Sello",$sello);
  //solo para pruebas
  return($sello);
}

#Carga los atributos a la etiqueta XML
function xmlV33_cargaAtt($nodo,$attr) {
	global $xml, $sello;
	foreach ($attr as $key => $val) {
    $val = preg_replace('/&/','&amp;', $val);
		$val = preg_replace('/\s\s+/', ' ', $val);   // Regla 5a y 5c
		//$val = trim($val);                           // Regla 5b
		if (strlen($val)>0) {   // Regla 6
			$val = str_replace(array('"','>','<'),"'",$val);  // &...;
			$val = utf8_encode(str_replace("|","/",$val)); // Regla 1
			$nodo->setAttribute($key,$val);
		}
	}
}


#Quita caractceres especiales a nombres
function xmlV33_fix_chr($nomb) {
    $nomb = str_replace(array(".","/")," ",$nomb);
    return ($nomb);
}

#Guarda el archivo en disco
function xmlV33_saveTempXML($array) {
	global $xml,$rutaTempFile;

	$xml->formatOutput = true;
	$todo = $xml->saveXML();
  $xml->save($rutaTempFile);

	//return($todo);
  return "xmlTemGenerado";
}



#timbrar xml en modo TEST
function timbrarTest(){
  global $rutaTempFile,$rutaRepFileZipTest,$rutaRep,$fileXMLtest,$rutaCLT;

  $XMLtemp = fopen($rutaTempFile,"rb");
  $str = stream_get_contents($XMLtemp);
  fclose($XMLtemp);

  $usuario = 'PLA090609N21';
  $pswd = 'eqwlpoolt';

  #PRUEBAS
  try {
    $client = new SoapClient("https://cfdiws.sedeb2b.com/EdiwinWS/services/CFDi?wsdl");
    $result = $client->getCfdiTest(array('user' => 'PLA090609N21','password' => 'eqwlpoolt','file' => $str ));
    $result2 = $result->getCfdiTestReturn;
  } catch (SoapFault $exception) {
    return $exception->getMessage();
  }

  file_put_contents($rutaRepFileZipTest,$result2);//se escribe en un archivo
  $zip = new ZipArchive;
  if ($zip->open($rutaRepFileZipTest) === TRUE) {
    $zip->renameIndex(0,$fileXMLtest); #Asigno nombre al archivo XML
    if ($zip->open($rutaRepFileZipTest) === TRUE) {
      $zip->extractTo($rutaRep.'/');
      $zip->extractTo($rutaCLT.'/');
      $zip->close();
      return('correcto');
    }
  }else{
    return('Error');
  }

}

#timbrar xml en modo PRODUCCION
function timbrarProduccion(){
  global $rutaTempFile,$rutaRepFileZip,$rutaRep,$fileXML,$rutaCLT;

  $XMLtemp = fopen($rutaTempFile,"rb");
  $str = stream_get_contents($XMLtemp);
  fclose($XMLtemp);

  $usuario = 'PLA090609N21';
  $pswd = 'eqwlpoolt';

  #PRODUCCION
  try {
    $client = new SoapClient("https://cfdiws.sedeb2b.com/EdiwinWS/services/CFDi?wsdl");
    $result = $client->getCfdi(array('user' => 'PLA090609N21','password' => 'eqwlpoolt','file' => $str ));
    $result2 = $result->getCfdiReturn;
  } catch (SoapFault $exception) {
    return $exception->getMessage();
  }

  file_put_contents($rutaRepFileZip,$result2);//se escribe en un archivo
  $zip = new ZipArchive;
  if ($zip->open($rutaRepFileZip) === TRUE) {
    $zip->renameIndex(0,$fileXML); #Asigno nombre al archivo XML
    if ($zip->open($rutaRepFileZip) === TRUE) {
      $zip->extractTo($rutaRep.'/');
      $zip->extractTo($rutaCLT.'/');
      $zip->close();
      return('correcto');
    }
  }else{
    return('Error');
  }

}

function abrirTimbrado($rutaRepFileXML){
  global $tipoProceso;
  $xml = simplexml_load_file($rutaRepFileXML);
  $ns = $xml->getNamespaces(true);
  $xml->registerXPathNamespace('t', $ns['tfd']);
  $xml->registerXPathNamespace('c', $ns['cfdi']);

  foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante){
      $idFactura = $cfdiComprobante['Folio'];
      $total = $cfdiComprobante['Total'];
      $selloCFDI = $cfdiComprobante['Sello'];
      $selloParte = substr($selloCFDI,-10,8);
      $selloParte = str_replace('==','',$selloParte);
      $moneda = $cfdiComprobante['Moneda'];
      $tc = $cfdiComprobante['TipoCambio'];
  }
  foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){
    $e_rfc = TildesHtml($Emisor['Rfc']);
    $nombre = TildesHtml($Emisor['Nombre']);
  }
  foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor){
    $r_rfc = TildesHtml($Receptor['Rfc']);
    $r_nombre = TildesHtml($Receptor['Nombre']);
  }
  foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
      $UUID = $tfd['UUID'];
      $certificado = $tfd['NoCertificadoSAT'];
      $fechaTimbre = str_replace('T',' ',$tfd['FechaTimbrado']);
      $fechaTimbre = date_format(date_create($fechaTimbre),"Y-m-d H:i:s");
      $versionTimbre = $tfd['Version'];
      $SelloSAT = $tfd['SelloCFD'];
  }
  $respQR = generarQR($e_rfc,$r_rfc,$total,$UUID,$selloParte);

  if( $tipoProceso == "factura" ){
    $respGuardar = guardarDatosTimbrado($UUID,$certificado,$selloCFDI,$fechaTimbre,$versionTimbre,$SelloSAT,$idFactura, $r_rfc,$r_nombre,$total,$moneda,$tc );
  }
  if( $tipoProceso == "notaCredito" ){
    $respGuardar = guardarDatosTimbrado_NC($UUID,$certificado,$selloCFDI,$fechaTimbre,$versionTimbre,$SelloSAT,$idFactura, $r_rfc,$r_nombre,$total,$moneda,$tc );
  }
  if( $tipoProceso == "pago" ){
    $respGuardar = guardarDatosTimbrado_Pago($UUID,$certificado,$selloCFDI,$fechaTimbre,$versionTimbre,$SelloSAT,$idFactura, $r_rfc,$r_nombre,$total,$moneda,$tc );
  }
  return $UUID."\n".$respQR.$respGuardar;
}

function generarQR($e_rfc,$r_rfc,$total,$UUID,$selloParte){
  global $root,$rutaQRFile;
  require $root . '/conta6/Resources/phpqrcode/qrlib.php';

        /* re=RFC_emisor  rr=RFC_receptor  id=UUID
        fe=$selloParte -> 8 ultimos digitos
        tt=Total_CFDI -> 18 digitos para enteros, 1 digito para ".", 6 digitos para decimales*/

  if( $total == 0 ){
    $TT = "000000000000000000.000000";
  }else{
    $parteValor=explode('.', $total);
    $ent = str_pad((int)$parteValor[0],18,"0",STR_PAD_LEFT);
    $dec = str_pad((int)$parteValor[1],6,"0",STR_PAD_RIGHT);
    $TT = $ent.".".$dec;
  }
  $datos='https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?&id='.$UUID.'&re='.$e_rfc.'&rr='.$r_rfc.'&tt='.$TT.'&fe='.$selloParte;

  QRcode::png($datos,$rutaQRFile,QR_ECLEVEL_H,4);
  return("✓ QR generado correctamente\n");
}




/* CANCLACION DE CFDI */
function estadoCFDI($rfcR,$s_UUID,$totalFac,$modo){
  global $s_userPAC,$s_pwdPAC,$s_rfcE;
  $client = new SoapClient("https://cfdiws.sedeb2b.com/EdiwinWS/services/CFDi?wsdl");
  $result = $client->getCFDiStatus(array('user' => $s_userPAC,
                                            'password' => $s_pwdPAC,
                                            'rfcE' => $s_rfcE,
                                            'rfcR' => $rfcR,
                                            'uuid' => $s_UUID,
                                            'total' => $totalFac,
                                            'test' => $modo ));

  $cancelStatus = $result->getCFDiStatusReturn->cancelStatus;
  $isCancelable = $result->getCFDiStatusReturn->isCancelable;
  $status = $result->getCFDiStatusReturn->status;
  $statusCode = $result->getCFDiStatusReturn->statusCode;

  if( $cancelStatus != '' ){ $respuesta = 'ESTATUS DE CANCELACION: '.$cancelStatus.'<br>'; }
  if( $isCancelable != '' ){ $respuesta .= 'CANCELABLE: '.$isCancelable.'<br>'; }
  if( $status != '' ){ $respuesta .= 'ESTATUS: '.$status.'<br>'; }
  if( $statusCode != '' ){ $respuesta .= 'CODIGO RESPUESTA: '.$statusCode.'<br>'; }

  return $respuesta;
}


function cancelarCFDI($rfcR,$s_UUID,$totalFac,$modo){
  global $db,$usuario,$root,$s_userPAC,$s_pwdPAC,$s_rfcE,$pswdCerts,$s_rfcR,$id_factura,$fileCer,$fileKey,
         $rutaRepFileXMLCancela;

  $certificado = file_get_contents($fileCer);
  $key = file_get_contents($fileKey);
  // Se crea el certificado PKCS12 -> .PFX
  openssl_pkcs12_export($certificado,$CertPKCS12,$key,$pswdCerts);

  try{
    $client = new SoapClient("https://cfdiws.sedeb2b.com/EdiwinWS/services/CFDi?wsdl");
    $result = $client->cancelCFDiAsync(array('user' => $s_userPAC,
                                              'password' => $s_pwdPAC,
                                              'rfcE' => $s_rfcE,
                                              'rfcR' => $rfcR,
                                              'uuid' => $s_UUID,
                                              'total' => $totalFac,
                                              'pfx' => $CertPKCS12,
                                              'pxfPassword' => $pswdCerts,
                                              'test' => $modo ));
    $resultACK->cancelCFDiAsyncReturn->ack; #xml sellado
    if( $resultACK != '' ){
      file_put_contents($rutaRepFileXMLCancela,base64_decode($resultACK));//se escribe en un archivo
      file_put_contents($rutaCLTFileXMLCancela,base64_decode($resultACK));//se escribe en un archivo

      #GENERO HTML
      $xml = simplexml_load_file($rutaRepFileXMLCancela);
      $xml->Body->CancelaCFDResponse->CancelaCFDResult[0]['Fecha'];

      $ns = $xml->getNamespaces(true);
      $xml->registerXPathNamespace('s',$ns['s']);

      #falta reconocer los estados del cfdi
      $edoCancelacion = '';
      foreach ($xml->xpath('//s:Body') as $cfdiComprobante){
  		  $fecha = $cfdiComprobante->CancelaCFDResponse->CancelaCFDResult[0]['Fecha'];
  		  $RFC = $cfdiComprobante->CancelaCFDResponse->CancelaCFDResult[0]['RfcEmisor'];
  		  $UUID = $cfdiComprobante->CancelaCFDResponse->CancelaCFDResult->Folios->UUID;
  		  $status = $cfdiComprobante->CancelaCFDResponse->CancelaCFDResult->Folios->EstatusUUID;
  		  $sello = $cfdiComprobante->CancelaCFDResponse->CancelaCFDResult->Signature->SignatureValue;
  	   }

       #genero acuse de cancelacion en formato html
       require $root . '/conta6/Resources/PHP/actions/acuse_cancelacion_CFDI.php';

       $control = fopen($rutaFileClienteHTML,"w+");
       if($control == false){
         $imgError07 = "<img src='../../../imagenes/cancel.png' width='12' height='12'>";
         $obs07 = $imgError07." XML no encontrado";
       }

       $fp = fopen($rutaCLTFileHTMLCancela,'w');
       fwrite($fp,$html);
       fclose($fp);

       $fechaCancela = str_replace('T',' ',$fecha);
       $fechaCancela = date_format(date_create($fechaCancela),"d-m-Y H:i:s");

       #guardo los datos de la cancelacion
       require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5guardarDatosCancelacion.php';

       # Cancelo pólizas de la cuenta de gastos
       require $root . '/conta6/Resources/PHP/actions/consultaFactura_ctaGastos.php';
       if( $rows_ctaGastos > 0 ){
         if( $id_polctagastos > 0 ){
           cancelarPoliza($id_polctagastos, 0);
           mysqli_query($db,"UPDATE conta_t_facturas_ctagastos SET
															s_cancela_ctagastos = 1
														WHERE fk_id_cuenta_captura = $id_captura");
         }
         if( $id_polpagoaplic > 0 ){
           cancelarPoliza($id_polpagoaplic, 0);
           mysqli_query($db,"UPDATE conta_t_facturas_ctagastos SET
															s_cancela_pagoaplicado = 1
														WHERE fk_id_cuenta_captura = $id_captura");

         }
       }
       # Cancelo pólizas de la factura
       require $root . '/conta6/Resources/PHP/actions/consultaFacturaTimbrada.php';
       if( $rows_facTimbrada > 0 ){
         if( $id_poliza > 0 ){
           cancelarPoliza($id_poliza, 0);
           mysqli_query($db,"UPDATE conta_t_facturas_cfdi SET
															s_cancela_factura = 1
														WHERE fk_id_poliza = $id_poliza");
         }
       }

    }
    guardarRespuestaTimbrado('factura',$id_factura,'Cancelado',$edoCancelacion);
    return("✓ Cancelado correctamente\n");

  } catch (SoapFault $e) {
    $e->getMessage();
    guardarRespuestaTimbrado('factura',$id_factura,'Vigente',$e);
    return $e;

  }

}

function cancelarPoliza($id_poliza, $status){
  global $db,$root;
  require $root . '/conta6/Resources/PHP/actions/cancelarPoliza.php';
}

function guardarRespuestaTimbrado($tipoDoc,$folio,$estado,$statusPAC){
  global $db;
  require $root . '/conta6/Resources/PHP/actions/acuse_cancelacion_CFDI_bitacora.php';
}
?>

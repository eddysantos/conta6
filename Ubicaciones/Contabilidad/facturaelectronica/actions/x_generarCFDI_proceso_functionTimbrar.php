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
  				  "NoIdentificacion"=>$array['Conceptos'][$i]['NoIdentificacion'],
  				  "Descripcion"=>$descripcion,
  				  "ValorUnitario"=>$array['Conceptos'][$i]['valorUnitario'],
  				  "Importe"=>$array['Conceptos'][$i]['importe'],
				 )
			);
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
  $fileKey = $root . '/conta6/Resources/clavesKeyCer/key2017.pem';
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
  global $rutaTempFile,$rutaRepFileZipTest,$rutaRep,$fileXMLtest;

  $XMLtemp = fopen($rutaTempFile,"rb");
  $str = stream_get_contents($XMLtemp);
  fclose($XMLtemp);

  $usuario = 'PLA090609N21';
  $pswd = 'eqwlpoolt';
  $client = new SoapClient("https://cfdiws.sedeb2b.com/EdiwinWS/services/CFDi?wsdl");

  #PRUEBAS
  $result = $client->getCfdiTest(array('user' => 'PLA090609N21','password' => 'eqwlpoolt','file' => $str ));
  $result2 = $result->getCfdiTestReturn;

  file_put_contents($rutaRepFileZipTest,$result2);//se escribe en un archivo
  $zip = new ZipArchive;
  if ($zip->open($rutaRepFileZipTest) === TRUE) {
    $zip->renameIndex(0,$fileXMLtest); #Asigno nombre al archivo XML
    if ($zip->open($rutaRepFileZipTest) === TRUE) {
      $zip->extractTo($rutaRep.'/');
      $zip->close();
      return('Recibiendo XML TEST correctamente');
    }
  }else{
    return('No se recibio respuesta del PAC');
  }

}

function abrirTimbrado(){
  global $rutaRepFileXMLTest; #para produccion quitar a variable 'Test'
  $xml = simplexml_load_file($rutaRepFileXMLTest);
  $ns = $xml->getNamespaces(true);
  $xml->registerXPathNamespace('t', $ns['tfd']);
  $xml->registerXPathNamespace('c', $ns['cfdi']);

  foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante){
      $idFactura = $cfdiComprobante['Folio'];
      $total = $cfdiComprobante['Total'];
      $selloCFDI = $cfdiComprobante['Sello'];
      $selloParte = substr($selloCFDI,-10,8);
      $selloParte = str_replace('==','',$selloParte);
  }
  foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){ $e_rfc = $Emisor['Rfc']; }
  foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor){ $r_rfc = $Receptor['Rfc']; }
  foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
      $UUID = $tfd['UUID'];
      $certificado = $tfd['NoCertificadoSAT'];
      $fechaTimbre = str_replace('T',' ',$tfd['FechaTimbrado']);
      $fechaTimbre = date_format(date_create($fechaTimbre),"Y-m-d H:i:s");
      $versionTimbre = $tfd['Version'];
      $SelloSAT = $tfd['SelloCFD'];
  }
  generarQR($e_rfc,$r_rfc,$total,$UUID,$selloParte);
  $respGuardar = guardarDatosTimbrado($UUID,$certificado,$selloCFDI,$fechaTimbre,$versionTimbre,$SelloSAT,$idFactura);

  return $respGuardar;
}

function generarQR($e_rfc,$r_rfc,$total,$UUID,$selloParte){
  global $root,$rutaQRFile;
  require $root . '/conta6/Resources/phpqrcode/qrlib.php';

  /* re=RFC_emisor  rr=RFC_receptor  id=UUID
  fe=$selloParte -> 8 ultimos digitos
  tt=Total_CFDI -> 18 digitos para enteros, 1 digito para ".", 6 digitos para decimales*/
  $parteValor=explode('.', $total);
  $ent = str_pad((int)$parteValor[0],18,"0",STR_PAD_LEFT);
  $dec = str_pad((int)$parteValor[1],6,"0",STR_PAD_RIGHT);
  $TT = $ent.".".$dec;
  $datos='https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?&id='.$UUID.'&re='.$e_rfc.'&rr='.$r_rfc.'&tt='.$TT.'&fe='.$selloParte;

  QRcode::png($datos,$rutaQRFile,QR_ECLEVEL_H,4);
}

?>

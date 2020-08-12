<?PHP
error_reporting(E_ALL);
ini_set('display_errors',1);


$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';
require $root . '/conta6/Resources/PHP/actions/validarFormulario.php';


$xml = '';
$ret = '';
$comprobante = '';
$nodo = 'Comprobante';

$folioCtaGastos = 2;
$folioFactura = 3;
$cuenta = 167;
$cliente = 'CLT_6548';
$referencia = 'SN';
$fechaFactura = date("Y-m-d\TH:i:s");
$id_cliente = 'CLT_6548';


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


/*=======================================================================================================================================*/

#nombre carpetas
$anioActual = date('Y');
$rutaAnioActual = $root . '/conta6/CFDI_generados/'.$anioActual;
$rutaTemp = $rutaAnioActual.'/temp';
$rutaRep = $rutaAnioActual.'/repositorio';
$rutaCLT = $rutaAnioActual.'/'.$id_cliente;
$rutaQR = $rutaCLT.'/QR';

#generar carpetas
if(!is_dir($rutaAnioActual)){ @mkdir($rutaAnioActual, 0775); }
if(!is_dir($rutaTemp)){ @mkdir($rutaTemp, 0775); }
if(!is_dir($rutaRep)){ @mkdir($rutaRep, 0775); }
if(!is_dir($rutaCLT)){ @mkdir($rutaCLT, 0775); }
if(!is_dir($rutaQR)){ @mkdir($rutaQR, 0775); }

#nombre archivos
echo $id_factura = $folioFactura;
$nombre_archivo = $referencia.'_'.$id_factura.'_factura';
$fileXML = $nombre_archivo.'.xml';

#rutas archivos
$rutaTempFile = $rutaTemp.'/'.$fileXML;
$rutaRepFileZip = $rutaRep.'/'.$nombre_archivo.'.zip';
$rutaRepFileXML = $rutaRep.'/'.$nombre_archivo.'.xml';
$rutaQRFile = $rutaQR.'/'.$nombre_archivo.'.png';

#nombre archivo modo timbrado_test
$nombre_archivoTest = $nombre_archivo.'_TEST';
$fileXMLtest = $nombre_archivoTest.'.xml';
$rutaRepFileZipTest = $rutaRep.'/'.$nombre_archivoTest.'zip';
$rutaRepFileXMLTest = $rutaRep.'/'.$nombre_archivoTest.'.xml';

/*******************************************************************************************************************************************************/
echo xmlV33($array, $dir="./tmp/",$nodo);

function xmlV33($array, $dir="./tmp/",$nodo) {
  //require_once "lib/numealet.php";        // genera el texto de un importe con letras
  global $xml, $cadena_original, $sello, $texto, $ret;
  error_reporting(E_ALL & ~(E_WARNING | E_NOTICE));
  $ml = xmlV33_genera_xml($array,$nodo);
  $cO = xmlV33_genera_cadena_original();
  $sello = xmlV33_sella($array);
  $XMLtermina = xmlV33_termina($array);
  $respPAC = timbrarTest();
  if( $respPAC == 'Recibiendo XML TEST correctamente' ){
    $respTimbrado = abrirTimbrado(); #abre archivo timbrado para generar QR y guardar los datos
    //$obs05 .= generaPolizaPagoAplicado($idFactura,$link,$usuario);
			//	$obs05 .= generaPolizaCG($idFactura,$link,$usuario);
  }
  return $respTimbrado;
}


function xmlV33_genera_xml($array,$nodo) {
	global $xml, $ret;
	$xml = new DOMdocument("1.0","UTF-8");
	xmlV33_generales($array,$nodo);
  xmlV33_emisor($array,$nodo);
	xmlV33_receptor($array,$nodo);
	xmlV33_conceptos($array,$nodo);
	xmlV33_impuestos($array,$nodo);
}

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
  				  "NoIdentificacion"=>$array['Conceptos'][$i]['noIdentificacion'],
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
  global $comprobante, $cadena_original;
  #ruta
  $fileKey = $root . '/conta6/Resources/clavesKeyCer/key2017.pem';
  $certificado = $array['noCertificado'];
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
function xmlV33_termina($array) {
	global $xml,$rutaTempFile;

	$xml->formatOutput = true;
	$todo = $xml->saveXML();
  $xml->save($rutaTempFile);

	return($todo);
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

function guardarDatosTimbrado($UUID,$certSAT,$selloCFDI,$fechaTimbre,$versionTimbre,$SelloSAT,$idFactura){
  global $lugarExpedicion,$lugarExpedicionTxt,$noCertificado,$id_cliente,$cuenta,$id_factura,$referencia,$cliente,
         $root,$usuario,$db,$aduana,
         $moneda,$tipoCambio,$totalGralImporte,$totalGral,$IVAretenido,$totaGralIVA,$Total_Anticipos,$folioCtaGastos;

  require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente_diasCredito.php';
  if( $rows_diasCredCLT > 0 ){
    $credito = trim($row_diasCredCLT["n_dias"]);
    $vencimiento = date("Y-m-d",strtotime("+$credito days"));
  }

  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_4guardarDatosTimbrado.php';
  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza.php';

  if( $total_cta_gastos <> 0 ){
    require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPolizaCtaGastos.php';
  }
  if( $c_MetodoPago == 'PUE' && $fac_saldo < 0 ){
    require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPolizaPagoAplicado.php';
  }

  return ;


}
?>

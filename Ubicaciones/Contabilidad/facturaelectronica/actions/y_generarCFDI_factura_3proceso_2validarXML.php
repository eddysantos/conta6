<?PHP

// Habilitar el control de errores
libxml_use_internal_errors(true);

#validar xml
$rutaXSD = $root . '/Resources/xsi/cfdv33.xsd';
$xml_valida = new DOMDocument();
$xml_valida->load($rutaTempFile);

if (!$xml_valida->schemaValidate($rutaXSD)) {
  echo "incorrecto xml";
  $obs03 = '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
  echo $obs03 .= libxml_display_errors();
}else{
  echo "xml correcto";

  #generar cadenaoriginal
  $xml_cadenaOriginal = new DOMDocument();
  $xml_cadenaOriginal->load($rutaTempFile);

  $XSL = new DOMDocument();
  $rutaXSLT = $root . '/Resources/xsi/cadenaoriginal_3_3.xslt';
  $XSL->load($rutaXSLT);

  $proc = new XSLTProcessor;
  $proc->importStyleSheet($XSL);

  $cadena_original = $proc->transformToXML($xml_cadenaOriginal);
  $cadenaUTF8 = utf8_encode($cadena_original);

  $XMLtemp = fopen($rutaTempFile,"rb");
  $str = stream_get_contents($XMLtemp);
  fclose($XMLtemp);


  #GENERO ENCRIPTACION
  $file = $root . '/Resources//clavesKeyCer/key2017.pem';//llave privada
  $llave = openssl_get_privatekey(file_get_contents($file));//Obtienes la llave privada

  #openssl_sign($cadenaUTF8, $crypttext, $llave, OPENSSL_ALGO_SHA1);//Firmas la cadena original 2011
  //openssl_sign($cadenaUTF8, $crypttext, $llave, OPENSSL_ALGO_SHA256);//Firmas la cadena original 2017-07-01
  openssl_sign($cadena_original, $crypttext, $llave, OPENSSL_ALGO_SHA256);//Firmas la cadena original 2017-07-01

  openssl_free_key($llave);
  $sello = base64_encode($crypttext); // lo codifica en formato base64

  #AGREGO EL SELLO AL XML
  $xmlContenido = simplexml_load_file($rutaTempFile);
  $ns = $xmlContenido->getNamespaces(true);
  $xmlContenido->registerXPathNamespace('c', $ns['cfdi']);

  foreach ($xmlContenido->xpath('//cfdi:Comprobante') as $cfdiComprobante){
    $cfdiComprobante['Sello'] = $sello;
    $xmlContenido->saveXML($rutaTempFile);
  }

}
/*

*/

#timbrar
$XMLtemp = fopen($rutaTempFile,"rb");
$str = stream_get_contents($XMLtemp);
fclose($XMLtemp);

$usuario = 'PLA090609N21';
$pswd = 'eqwlpoolt';
$client = new SoapClient("https://cfdiws.sedeb2b.com/EdiwinWS/services/CFDi?wsdl");

//echo $rutaRepFile;
//echo $fileXML;
//echo $str;
#PRUEBAS
$result = $client->getCfdiTest(array('user' => 'PLA090609N21','password' => 'eqwlpoolt','file' => $str ));
$result2 = $result->getCfdiTestReturn;

// var_dump($client);
// die();

file_put_contents($rutaRepFile,$result2);//se escribe en un archivo
$zip = new ZipArchive;
if ($zip->open($rutaRepFile) === TRUE) {
  $zip->renameIndex(0,$fileXML); #Asigno nombre al archivo XML
  if ($zip->open($rutaRepFile) === TRUE) {
    //$zip->extractTo('repositorio/');

    $zip->extractTo($rutaRep.'/');
    $zip->close();
    //$imgError04 = "<img src='../../../imagenes/accept.png' width='12' height='12'>";
    echo $obs04 = 'Recibiendo XML correctamente';
    //$obs04 = $imgError04." ".$obs04;
  }
}else{
  //$imgError04 = "<img src='../../../imagenes/cancel.png' width='12' height='12'>";
  $obs04 = 'No se recibio respuesta del PAC';
  //$obs04 = $imgError04." ".$obs04;
}

?>

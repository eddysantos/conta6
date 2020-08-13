<?PHP
error_reporting(E_ALL);
ini_set('display_errors',1);

$tipoProceso = "nomina";

# array con todos los datos a timbrar
require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_2array.php';

# funciones para timbrar cfdi
require_once $root . '/Resources/PHP/actions/generarCFDI_proceso_functionTimbrar.php';

# nombre de carpetas y rutas de almacenamiento
require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_1path.php';





#***************************************************************************************
# funciones para timbrar cfdi --- factura
if( $total_consultaDatosRelacionada > 0 ){
  $ml = xmlV33_generaDR_xml($array,$nodo);
}else{
  $ml = xmlV33_genera_xml($array,$nodo);
}

$cO = xmlV33_genera_cadena_original();
$sello = xmlV33_sella($array);
$XMLsave = xmlV33_saveTempXML($array); #guardar archivo
if( $XMLsave == 'xmlTemGenerado' ){
  $system_callback['message'] .= "✓ xml generado correctamente\n";

  #PRUEBAS
  $respTEST = timbrarTest();
  $modoTimbrar = 'TEST';
  if( $respTEST == 'correcto'){
    $system_callback['message'] .= "✓ xml Timbrado TEST correctamente:\n";
    $respAbrirTimbrado = abrirTimbrado($rutaRepFileXMLTest); #abre archivo timbrado, generar QR, genera polizas y guardar los datos
    $system_callback['message'] .= $respAbrirTimbrado;
    exit_script($system_callback);
  }else {
    $system_callback['code'] = 3;
    $system_callback['message'] = $respTEST;
    exit_script($system_callback);
  }



  #FALTA GENERAR FUNCION DE PRODUCCION
  #EJECUTA SAT
  // $respProd = timbrarProduccion();
  // $modoTimbrar = 'PRODUC';
  // if( $respProd == 'correcto'){
  //   $system_callback['message'] .= "✓ xml Timbrado correctamente: ";
  //   $respAbrirTimbrado = abrirTimbrado($rutaRepFileXML); #abre archivo timbrado, generar QR, genera polizas y guardar los datos
  //   $system_callback['message'] .= $respAbrirTimbrado;
  // }else {
  //   $system_callback['code'] = 3;
  //   $system_callback['message'] = $respProd;
  //   exit_script($system_callback);
  // }




}else{
  $system_callback['message'] .= "Ø xml error:\n".$XMLsave;
  exit_script($system_callback);
}

#***************************************************************************************


#datos necesarios para timbrar una factura
function xmlV33_genera_xml($array,$nodo) {
	global $xml, $ret;
	$xml = new DOMdocument("1.0","UTF-8");
	xmlV33_generales_nomina($array,$nodo);
  xmlV33_emisor($array,$nodo);
	xmlV33_receptor($array,$nodo);
	xmlV33_concepto_nomina($array,$nodo);
  xmlV33_complemento_nomina($array,$nodo);
}

function xmlV33_generaDR_xml($array,$nodo) {
	global $xml, $ret;
	$xml = new DOMdocument("1.0","UTF-8");
	xmlV33_generales_nomina($array,$nodo);
  xmlV33_cfdi_relacionados_n($array,$nodo);
  xmlV33_emisor($array,$nodo);
	xmlV33_receptor($array,$nodo);
	xmlV33_concepto_nomina($array,$nodo);
  xmlV33_complemento_nomina($array,$nodo);
}


function guardarDatosTimbrado_Nomina($UUID,$certSAT,$selloCFDI,$fechaTimbre,$versionTimbre,$SelloSAT,$idFactura,$r_rfc,$r_nombre,$total,$moneda,$tc){
  global $lugarExpedicion,$lugarExpedicionTxt,$noCertificado,$descripcion,$id_regimen,$semana,$nombre,$apellidoP,$apellidoM,
         $anio, $id_aduana, $fechaPago, $id_empleado,
         $root,$usuario,$db,$aduana,
         $rutaRepFileHTML,$rutaRepFilePDF,$rutaQRFile,
         $modoTimbrar,$idDocNomina,$poliza;


  if( $poliza == 0 ){
    require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza.php';#prepare polDetFac
    $respGuardarDatos = "✓ Póliza de Factura: ".$poliza."\n";

    $mesPoliza = date_format(date_create($fechaTimbre),'m');
    $poliza2 = $poliza;
    require $root . '/Resources/PHP/actions/actualizarPoliza_dmes.php';
  }

  require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_4guardarDatosTimbrado.php';
  #probarCodigo

  #require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_5impresoHTML.php';

  #registro en contabilidad electronica
  if( $poliza > 0 ){
    $fk_id_poliza = $poliza;
    #$tipo = 3;
    $tipoInf = "CompNal";
    $RFC = $r_rfc;
    $importe = $total;
    $beneficiarioOpc = $r_nombre;
    $tipoCamb = $tc;
    require $root . '/Resources/PHP/actions/contaElect_insertaCompNal_poliza.php';
  }

  return $respGuardarDatos;


}

?>

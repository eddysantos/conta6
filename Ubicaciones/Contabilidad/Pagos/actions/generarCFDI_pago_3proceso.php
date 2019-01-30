<?PHP
error_reporting(E_ALL);
ini_set('display_errors',1);

$tipoProceso = "pago";

# nombre de carpetas y rutas de almacenamiento
# se toma una referencia para el nombre del archivo pago
require $root . '/conta6/Ubicaciones/Contabilidad/Pagos/actions/generarCFDI_pago_3proceso_1path.php';

# array con todos los datos a timbrar
require $root . '/conta6/Ubicaciones/Contabilidad/Pagos/actions/generarCFDI_pago_3proceso_2array.php';

# funciones para timbrar cfdi
require_once $root . '/conta6/Resources/PHP/actions/generarCFDI_proceso_functionTimbrar.php';

#***************************************************************************************
# funciones para timbrar cfdi --- pagos
$ml = xmlV33_genera_xml($array,$nodo);
$cO = xmlV33_genera_cadena_original();
$sello = xmlV33_sella($array);
$XMLsave = xmlV33_saveTempXML($array); #guardar archivo

if( $XMLsave == 'xmlTemGenerado' ){
  $system_callback['message'] .= "✓ xml generado correctamente\n";

  #PRUEBAS
  $respTEST = timbrarTest();
  if( $respTEST == 'correcto'){
    $system_callback['message'] .= "✓ xml Timbrado TEST correctamente:\n";
    $respAbrirTimbrado = abrirTimbrado(); #abre archivo timbrado, generar QR, genera polizas y guardar los datos
    $system_callback['message'] .= $respAbrirTimbrado;
  }else {
    $system_callback['code'] = 3;
    $system_callback['message'] = $respTEST;
    echo $respTEST;
    exit_script($system_callback);
  }

  #FALTA GENERAR FUNCION DE PRODUCCION
  #EJECUTA SAT
  // $respProd = timbrarProduccion();
  // if( $respProd == 'correcto'){
  //   $system_callback['message'] .= "✓ xml Timbrado correctamente: ";
  //   $respAbrirTimbrado = abrirTimbrado(); #abre archivo timbrado, generar QR, genera polizas y guardar los datos
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


#datos necesarios para timbrar un pago
function xmlV33_genera_xml($array,$nodo) {
	global $xml, $ret;
	$xml = new DOMdocument("1.0","UTF-8");
	xmlV33_generales_pago($array,$nodo);
  if( $array['CfdiRelacionado']['UUID'] <> '' ){
    xmlV33_cfdi_relacionados($array,$nodo);
  }
  xmlV33_emisor($array,$nodo);
	xmlV33_receptor($array,$nodo);
	xmlV33_concepto_pago($array,$nodo);
  xmlV33_complemento_pago($array,$nodo);
}


function guardarDatosTimbrado_Pago($UUID,$certSAT,$selloCFDI,$fechaTimbre,$versionTimbre,$SelloSAT,$idFactura){
  global $lugarExpedicion,$lugarExpedicionTxt,$noCertificado,$id_cliente,$cuenta,$id_factura,$referencia,$cliente,
         $root,$usuario,$db,$aduana,
         $moneda,$totalGralImporte,$folioCtaGastos,
         $r_razon_social,
         $rutaRepFileHTML,$rutaRepFilePDF,$rutaQRFile;
         #$tipoCambio,$totalGral,$IVAretenido,$totaGralIVA,$total_cta_gastos,$fac_saldo,$c_MetodoPago,$Total_Anticipos,$POCME_Total_MN,


  require $root . '/conta6/Ubicaciones/Contabilidad/Pagos/actions/generarCFDI_pago_3proceso_5generarPoliza.php';#prepare polDetFac
  $respGuardarDatos = "✓ Póliza de Factura: ".$poliza."\n";
  require $root . '/conta6/Ubicaciones/Contabilidad/Pagos/actions/generarCFDI_pago_3proceso_4guardarDatosTimbrado.php';

  #require $root . '/conta6/Ubicaciones/Contabilidad/Pagos/actions/generarCFDI_pago_3proceso_5impresoHTML.php';

  return $respGuardarDatos;
}

?>

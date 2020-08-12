<?PHP
error_reporting(E_ALL);
ini_set('display_errors',1);

$tipoProceso = "notaCredito";

# nombre de carpetas y rutas de almacenamiento
require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/generarCFDI_notacredito_3proceso_1path.php';

# array con todos los datos a timbrar
require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/generarCFDI_notacredito_3proceso_2array.php';
//print_r($array);

# funciones para timbrar cfdi
require_once $root . '/conta6/Resources/PHP/actions/generarCFDI_proceso_functionTimbrar.php';

#***************************************************************************************
# funciones para timbrar cfdi --- Nota Credito
$ml = xmlV33_genera_xml_notacredito($array,$nodo);
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


function xmlV33_genera_xml_notacredito($array,$nodo) {
	global $xml, $ret;
	$xml = new DOMdocument("1.0","UTF-8");
	xmlV33_generales($array,$nodo);
	xmlV33_cfdi_relacionados($array,$nodo);
  xmlV33_emisor($array,$nodo);
	xmlV33_receptor($array,$nodo);
	xmlV33_conceptos_NC($array,$nodo);
	xmlV33_impuestos($array,$nodo);
}

function guardarDatosTimbrado_NC($UUID,$certSAT,$selloCFDI,$fechaTimbre,$versionTimbre,$SelloSAT,$idFactura, $r_rfc,$r_nombre,$total,$moneda,$tc){
  global $lugarExpedicion,$lugarExpedicionTxt,$noCertificado,$id_cliente,$cuenta,$id_factura,$referencia,$cliente,
         $root,$usuario,$db,$aduana,
         $moneda,$tipoCambio,$totalGralImporte,$totalGral,$IVAretenido,$totaGralIVA,$Total_Anticipos,$folioCtaGastos,
				 $id_facturaRelacionada,$UUID_relacionado,$s_descripNC,$n_importe,
         $r_razon_social,$total_cta_gastos,$c_MetodoPago,$POCME_Total_MN,$fac_saldo,
         $rutaRepFileHTML,$rutaRepFilePDF,$rutaQRFile,
         $modoTimbrar;


  require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/generarCFDI_notacredito_3proceso_5generarPolizaNC.php';#prepare polDetFac
  $respGuardarDatos = "✓ Póliza de Factura: ".$poliza."\n";

  $mesPoliza = date_format(date_create($fechaTimbre),'m');
  $poliza2 = $poliza;
  require $root . '/conta6/Resources/PHP/actions/actualizarPoliza_dmes.php';

  require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/generarCFDI_notacredito_3proceso_4guardarDatosTimbrado.php';

  require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/generarCFDI_notacredito_3proceso_5impresoHTML.php';

  #registro en contabilidad electronica
  if( $poliza > 0 ){
    $fk_id_poliza = $poliza;
    $tipo = 3;
    $tipoInf = "CompNal";
    $RFC = $r_rfc;
    $importe = $total;
    $beneficiarioOpc = $r_nombre;
    $tipoCamb = $tc;
    require $root . '/conta6/Resources/PHP/actions/contaElect_insertaCompNal_poliza.php';
  }

  return $respGuardarDatos;
}

?>

<?PHP
error_reporting(E_ALL);
ini_set('display_errors',1);

$tipoProceso = "factura";
$respGuardarDatos = '';

# nombre de carpetas y rutas de almacenamiento
require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_1path.php';

# array con todos los datos a timbrar
require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_2array.php';

# funciones para timbrar cfdi
require_once $root . '/Resources/PHP/actions/generarCFDI_proceso_functionTimbrar.php';

#***************************************************************************************
# funciones para timbrar cfdi --- factura
if( $id_facturaRelacionada > 0 ){
  $ml = xmlV33_generaDR_xml($array,$nodo);
}else{
  $ml = xmlV33_genera_xml($array,$nodo);
}

$cO = xmlV33_genera_cadena_original();
$sello = xmlV33_sella($array);
$XMLsave = xmlV33_saveTempXML($array); #guardar archivo  esta funcion guarda un archivo temporal
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
	xmlV33_generales($array,$nodo);
  xmlV33_emisor($array,$nodo);
	xmlV33_receptor($array,$nodo);
	xmlV33_conceptos($array,$nodo);
	xmlV33_impuestos($array,$nodo);
}

function xmlV33_generaDR_xml($array,$nodo) {
	global $xml, $ret;
	$xml = new DOMdocument("1.0","UTF-8");
	xmlV33_generales($array,$nodo);
  xmlV33_cfdi_relacionados($array,$nodo);
  xmlV33_emisor($array,$nodo);
	xmlV33_receptor($array,$nodo);
	xmlV33_conceptos($array,$nodo);
	xmlV33_impuestos($array,$nodo);
}


function guardarDatosTimbrado($UUID,$certSAT,$selloCFDI,$fechaTimbre,$versionTimbre,$SelloSAT,$idFactura, $r_rfc,$r_nombre,$total,$moneda,$tc){
  global $lugarExpedicion,$lugarExpedicionTxt,$noCertificado,$id_cliente,$cuenta,$id_factura,$referencia,$cliente,
         $root,$usuario,$db,$aduana,
         $moneda,$tipoCambio,$totalGralImporte,$totalGral,$IVAretenido,$totaGralIVA,$Total_Anticipos,$folioCtaGastos,$iva_aplicado_2,
         $r_razon_social,$total_cta_gastos,$c_MetodoPago,$POCME_Total_MN,$fac_saldo,
         $Total_POCME,$Total_Pagos,$total_pagosCLT,
         $rutaRepFileHTML,$rutaRepFilePDF,$rutaQRFile,
         $modoTimbrar;

  require $root . '/Resources/PHP/actions/consultaDatosCliente_diasCredito.php';
  //$vencimiento = '0000-00-00';
  if( $rows_diasCredCLT > 0 ){
    $credito = trim($row_diasCredCLT["n_dias"]);
    $vencimiento = date("Y-m-d",strtotime("+$credito days"));
  }


  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza.php';#prepare polDetFac
  $respGuardarDatos = "✓ Póliza de Factura: ".$poliza."\n";

  # actualizando el mes de la poliza
  $mesPoliza = date_format(date_create($fechaTimbre),'m');
  $poliza2 = $poliza;
  require $root . '/Resources/PHP/actions/actualizarPoliza_dmes.php';

  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_4guardarDatosTimbrado.php';


  $poliza_CtaGastos = 0; $polizaAplicado = 0;
  if( $total_cta_gastos <> 0 ){
    require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_ctaGastos.php';
    $respGuardarDatos .= "✓ Póliza de Cuenta Gastos: ".$poliza_CtaGastos."\n";

    $poliza2 = $poliza_CtaGastos;
    require $root . '/Resources/PHP/actions/actualizarPoliza_dmes.php';
  }

  if( $c_MetodoPago == 'PUE' && $fac_saldo < 0 ){
    require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_pagoAplicado.php';
    $respGuardarDatos .= "✓ Póliza de Pago Aplicado: ".$polizaAplicado."\n";

    $poliza2 = $polizaAplicado;
    require $root . '/Resources/PHP/actions/actualizarPoliza_dmes.php';
  }

  if( $poliza_CtaGastos > 0 || $polizaAplicado > 0 ){
    require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5guardarDatosPolizas.php';
  }

  #registro en contabilidad electronica
  if( $poliza > 0 ){
    $fk_id_poliza = $poliza;
    $tipo = 3;
    $tipoInf = "CompNal";
    $RFC = $r_rfc;
    $importe = $total;
    $beneficiarioOpc = $r_nombre;
    $tipoCamb = $tc;
    require $root . '/Resources/PHP/actions/contaElect_insertaCompNal_poliza.php';
  }

  $CLT_nombre = '';
  $importe = 0;
  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5impresoHTML.php';

  return $respGuardarDatos;
}

?>

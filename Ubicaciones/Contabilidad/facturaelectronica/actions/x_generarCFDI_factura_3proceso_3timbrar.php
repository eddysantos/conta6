<?php
//echo $codigoTimbre = 1;


$ml = xmlV33_genera_xml($array,$nodo);
$cO = xmlV33_genera_cadena_original();
$sello = xmlV33_sella($array);
$XMLsave = xmlV33_saveTempXML($array); #guardar archivos
if( $XMLsave == 'xmlTemGenerado' ){
  $system_callback['message'] .= "xml generado correctamente\n";
}

#funciones generales para timbrar un CFDI
#include $root . '/Ubicaciones/Contabilidad/actions/generarCFDI_proceso_functionTimbrar.php';

//echo xmlV33($array,$nodo);
/*
function xmlV33($array,$nodo) {
  global $xml, $cadena_original, $sello, $texto, $ret;
  error_reporting(E_ALL & ~(E_WARNING | E_NOTICE));

  $ml = xmlV33_genera_xml($array,$nodo);
  $cO = xmlV33_genera_cadena_original();
  $sello = xmlV33_sella($array);
  $XMLtermina = xmlV33_saveTempXML($array); #guardar archivos

  $respPAC = timbrarTest(); #usando modo TEST
      #$respPAC = timbrarProduction(); #usando modo TEST

  if( $respPAC == 'Recibiendo XML TEST correctamente' ){
    $respTimbrado = abrirTimbrado(); #abre archivo timbrado para generar QR y guardar los datos
  }
  return $ml;
}
*/

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


#funciones generales para timbrar un CFDI
#require $root . '/Ubicaciones/Contabilidad/actions/generarCFDI_proceso_functionTimbrar.php';



function guardarDatosTimbrado($UUID,$certSAT,$selloCFDI,$fechaTimbre,$versionTimbre,$SelloSAT,$idFactura){
  global $lugarExpedicion,$lugarExpedicionTxt,$noCertificado,$id_cliente,$cuenta,$id_factura,$referencia,$cliente,
         $root,$usuario,$db,$aduana,
         $moneda,$tipoCambio,$totalGralImporte,$totalGral,$IVAretenido,$totaGralIVA,$Total_Anticipos,$folioCtaGastos;

  require $root . '/Resources/PHP/actions/consultaDatosCliente_diasCredito.php';
  if( $rows_diasCredCLT > 0 ){
    $credito = trim($row_diasCredCLT["n_dias"]);
    $vencimiento = date("Y-m-d",strtotime("+$credito days"));
  }

  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_4guardarDatosTimbrado.php';
  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza.php';

  if( $total_cta_gastos <> 0 ){
    require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_ctaGastos.php';
  }
  if( $c_MetodoPago == 'PUE' && $fac_saldo < 0 ){
    require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_pagoAplicado.php';
  }

  return ;


}

?>

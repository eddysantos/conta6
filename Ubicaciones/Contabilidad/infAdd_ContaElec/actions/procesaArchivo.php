<?php
#error_reporting(E_ALL);
#ini_set('display_errors', 1);
#echo phpinfo();
#REVISAR EN php.ini     allow_url_fopen=On

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

	$fileXML = $_POST['fileXML'];
	$contenido_XML = $_POST['contenido_XML'];
	$tipo = $_POST['tipo'];
	$partidaDoc = $_POST['partidaDoc'];
	$id_poliza = $_POST['id_poliza'];
	#$usuario = $_POST['usuario'];

$system_callback = [];
	$fileXML = $tipo."tipo_".$partidaDoc."partida_".$id_poliza."poliza_".$fileXML;

	#Ruta CFDI
	$rutaCFDI = $root . '/CFDI_BackUpsContabilidad/';

	//Reemplazamos caracteres especiales latinos
	require $root . '/Resources/PHP/actions/validarFormulario.php';

	#GUARDAR TEMPORAL XML
	$control = fopen($rutaCFDI.$fileXML,"w+");

	if($control == false){
		$imgError03 = "<img src='../../imagenes/cancel.png' width='12' height='12'>";
		$obs03 = $imgError03." XML temporal no se genero";
	}

	$fp = fopen($rutaCFDI.$fileXML,'w');
	fwrite($fp,$contenido_XML);
	fclose($fp);

	$buscar = 'version="3.2"';
	$encuentra = stripos($contenido_XML,$buscar);

	$totalImpuestosISR = 0;
	$totalImpuestosIVAret = 0;
  $totalImpuestos = 0;

	if($encuentra === false) {

		#LEER ARCHIVO TIMBRADO; Version="3.3"
		$xml = simplexml_load_file($rutaCFDI.$fileXML);
		$ns = $xml->getNamespaces(true);
		$xml->registerXPathNamespace('t', $ns['tfd']);
		$xml->registerXPathNamespace('c', $ns['cfdi']);

		foreach ($xml->xpath('//c:Comprobante') as $cfdi) {
			 $subTotal = $cfdi['SubTotal'];
			 $total = $cfdi['Total'];
			 $moneda = $cfdi['Moneda'];
			 $tc = $cfdi['TipoCambio'];
			 $folio = $cfdi['Folio'];
		}

		foreach ($xml->xpath('//c:Impuestos') as $cfdi) {
			$atributos = $cfdi->attributes();
			$totalImpuestos = $atributos['TotalImpuestosTrasladados'];
		}
		foreach ($xml->xpath('//c:Impuestos//cfdi:Traslados//cfdi:Traslado') as $cfdi) {
			$TasaOCuota = $cfdi['TasaOCuota'];
		}

		foreach ($xml->xpath('//c:Retencion') as $cfdi) {
			$atributos = $cfdi->attributes();
			if( $atributos['Impuesto'] == "001" ){ #ISR
				$totalImpuestosISR = $atributos['Importe'];
			}
			if( $atributos['Impuesto'] == "002" ){ #IVA
				$totalImpuestosIVAret = $atributos['Importe'];
			}
		}


		foreach ($xml->xpath('//c:Emisor') as $cfdi) {
			 $rfc = TildesHtml($cfdi['Rfc']);
			 $nombre = TildesHtml($cfdi['Nombre']);
		}
		foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
			 $UUID = $tfd['UUID'];
		}
	}else{
		#LEER ARCHIVO TIMBRADO: version="3.2"
		$xml = simplexml_load_file($rutaCFDI.$fileXML);
		$ns = $xml->getNamespaces(true);
		$xml->registerXPathNamespace('t', $ns['tfd']);
		$xml->registerXPathNamespace('c', $ns['cfdi']);

		foreach ($xml->xpath('//c:Comprobante') as $cfdi) {
			 $subTotal = $cfdi['subTotal'];
			 $total = $cfdi['total'];
		}
		foreach ($xml->xpath('//c:Traslado') as $cfdi) {
			$atributos = $cfdi->attributes();
			if( $atributos['impuesto'] == "IVA" ){
				$totalImpuestos = $atributos['importe'];
			}
		}
		foreach ($xml->xpath('//c:Retencion') as $cfdi) {
			$atributos = $cfdi->attributes();
			if( $atributos['impuesto'] == "ISR" ){
				$totalImpuestosISR = $atributos['importe'];
			}
			if( $atributos['impuesto'] == "IVA" ){
				$totalImpuestosIVAret = $atributos['importe'];
			}
		}
		foreach ($xml->xpath('//c:Emisor') as $cfdi) {
			 $rfc = TildesHtml($cfdi['rfc']);
			 $nombre = TildesHtml($cfdi['nombre']);
		}
		foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
			 $UUID = $tfd['UUID'];
		}
	}

	#EL NOMBRE DEL ARCHIVO SE GUARDA EN LA BASE DE DATOS
	mysqli_query($db,"INSERT INTO conta_t_polizas_det_contaelec_backupsxml(fk_id_poliza,s_nombre_archivo,s_uuid,s_rfc_emisor,s_usuario)values($id_poliza,'$fileXML','$UUID','$rfc','$usuario')");


	$system_callback['code'] = "1";
	$system_callback['data'] = $UUID."|".$rfc."|".$total."|".$nombre."|".$subTotal."|".$totalImpuestos."|".$totalImpuestosISR."|".$totalImpuestosIVAret."|".$moneda."|".$tc."|".$folio."|".$TasaOCuota;
	$system_callback['message'] = "Script called successfully!";
	exit_script($system_callback);



?>

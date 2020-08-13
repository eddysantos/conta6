<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

require $root . '/Resources/PHP/actions/consultaDatosGrales_CFDI.php'; #$CFDversion,$regimen,$cveIVA
require $root . '/Ubicaciones/Contabilidad/actions/consultaDatosCFDI_factura_captura.php';

echo $CFDversion;
	$id_formapago = $rslt_consultaDatosCaptura['fk_id_formapago'];
	/*
	pk_id_cuenta_captura	d_fecha_cta	fk_usuario	d_fecha_modifi	s_usuario_modifi	fk_referencia	fk_id_aduana	fk_id_almacen	fk_id_cliente	s_nombre	s_calle	s_no_ext	s_no_int	s_colonia	s_codigo	s_ciudad	s_estado	s_pais	s_taxid	s_rfc	s_proveedor_destinatario	s_imp_exp	n_valor	n_peso	n_diasEnAlmacen	n_POCME_total_gral	n_POCME_tipo_cambio	n_POCME_total_MN	n_total_custodia	n_total_manejo	n_total_almacenaje	n_total_maniobras	n_total_subsidiado	n_IVA_aplicado	s_txt_gral_importe	n_total_gral_importe	n_txt_gral_IVA	n_total_gral_IVA	s_txt_total_honorarios	n_total_honorarios	s_txt_fac_IVA_retenido	s_fac_IVA_retenido	s_txt_total_gral	n_total_gral	s_POCME_descripcion_gral	n_total_POCME	s_txt_total_pagos	n_total_pagos	s_txt_cta_gastos	n_total_cta_gastos	s_total_cta_gastos_letra	s_txt_total_depositos	n_total_depositos	s_txt_fac_saldo	n_fac_saldo	s_total_letra	n_tipoCambio	fk_id_moneda	pk_c_UsoCFDI	fk_id_asoc	s_tipoDeComprobante	fk_id_formapago	s_numCtaPago	fk_c_MetodoPago	s_lugarExpedicion	s_lugarExpedicion_txt	s_emisor_razon_social	s_emisor_rfc	s_regimenFiscal	n_statuspagada
	*/
	#$noCertificado = $row_datosCert['pk_id_certificado'];
	//$certificado = $row_datosCert['s_certificado'];






/*
	$objetoXML->writeAttribute("Sello",$sello);
	$objetoXML->writeAttribute("FormaPago",$id_formapago);
	$objetoXML->writeAttribute("NoCertificado",$noCertificado);
	$objetoXML->writeAttribute("Certificado",$certificado);
	$objetoXML->writeAttribute("CondicionesDePago","Mismo dia");
	$objetoXML->writeAttribute("SubTotal",$totalGralImporte);
	$objetoXML->writeAttribute("Moneda",$moneda);
	$objetoXML->writeAttribute("TipoCambio",$tipoCambio);
	$objetoXML->writeAttribute("Total",$totalGral);
	$objetoXML->writeAttribute("TipoDeComprobante",$tipoDeComprobante);
	$objetoXML->writeAttribute("MetodoPago",$metodoPago);
	$objetoXML->writeAttribute("LugarExpedicion",$lugarExpedicion);

	// Inicio del nodo raíz
	$objetoXML->startElement("obras");

		$objetoXML->startElement("obra"); // Se inicia un elemento para cada obra.
		// Atributo de la fecha de inicio del elemento obra
		$objetoXML->writeAttribute("inicio", "2018-01-01");
		// Atributo de la fecha de final del elemento obra
		$objetoXML->writeAttribute("final", "2018-01-31");
		$objetoXML->fullEndElement (); // Final del elemento "obra" que cubre cada obra de la matriz.

	$objetoXML->endElement(); // Final del nodo raíz, "obras"
*/


	/* Vamos a crear un XML con XMLWriter a partir de la matriz anterior.
	Lo vamos a crear usando programación orientada a objetos.
	Por lo tanto, empezamos creando un objeto de la clase XMLWriter.*/
	$objetoXML = new XMLWriter();

	// Estructura básica del XML
	$objetoXML = new XMLWriter();
	$objetoXML->openURI('c:\\prueba1.xml');
	$objetoXML->setIndent(true);
	$objetoXML->setIndentString("\t");
	$objetoXML->startDocument('1.0', 'utf-8');

	$objetoXML->startElementNS("cfdi:Comprobante","");
		$objetoXML->writeAttribute("xmlns:cfdi","http://www.sat.gob.mx/cfd/3");
		$objetoXML->writeAttribute("xmlns:xsi","http://www.w3.org/2001/XMLSchema-instance");
		$objetoXML->writeAttribute("xsi:schemaLocation","http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd");
		$objetoXML->writeAttribute("Version",$CFDversion);
		$objetoXML->writeAttribute("Folio",$folioFactura);
		$objetoXML->writeAttribute("Fecha",$fechaActual);

	$objetoXML->endElement();

	$objetoXML->endDocument(); // Final del documento
	//$out = xmlwriter_output_memory($objetoXML, 0);
	//echo $out;
?>

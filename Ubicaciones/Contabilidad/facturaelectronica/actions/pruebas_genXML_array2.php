<?php
$usuario = "testing@solucionfactible.com";
$password = "a0123456789";

try {
    $client = new SoapClient("https://solucionfactible.com/ERPWebServices/soap/CFDI33?wsdl", array('cache_wsdl' => WSDL_CACHE_NONE));
    $impuestosConcepto1 = array("traslados" => array(
        0 => array('base' => 1278.12, "tipoFactor" => "TASA", "tasaOCuota" => 0.16000, "impuesto" => 'IVA', "importe" => 204.50),
        1 => array('base' => 1, "tipoFactor" => "CUOTA", "tasaOCuota" => 2.00, "impuesto" => 'IEPS', "importe" => 2.00)
    ));
    $impuestosConcepto2 = array(
        "retenciones" => array(
            0 => array('base' => 12.78, "tipoFactor" => "TASA", "tasaOCuota" => 0.106667, "impuesto" => 'IVA', "importe" => 1.36320426)
        )
    );
    $concepto1 = array("claveProdServ" => "01010101", "claveUnidad" => "EA", "cantidad" => 1, "comment" => "Comentario en el primer concepto", "unidad" => "Servicio", "descripcion" => "Agencias de crédito personal", "valorUnitario" => 1278.12, "impuestos" => $impuestosConcepto1);
    $concepto2 = array("claveProdServ" => "01010101", "claveUnidad" => "EA", "cantidad" => 1, "comment" => "Comentario en el segundo concepto", "unidad" => "Servicio", "descripcion" => "Comisiones", "valorUnitario" => 12.78, "impuestos" => $impuestosConcepto2);
    $listaConceptos = array();
    array_push($listaConceptos, $concepto1);
    array_push($listaConceptos, $concepto2);#
    // opcionalmente, especificar el total de impuestos por comprobante;
    // si no los colocamos el sistema los incluirá con la informaciónd e impuestos de los conceptos# $trasladosComprobante = array();#
    $retencionesComprobante = array();#
    $ivaComprobante = array("tipoFactor" => "TASA", "tasaOCuota" => 0.16000, "impuesto" => 'IVA', "importe" => 204.50);#
    $iepsComprobante = array("tipoFactor" => "CUOTA", "tasaOCuota" => 2.00, "impuesto" => 'IEPS', "importe" => 2.00);#
    $ivaRetenidoComprobante = array("impuesto" => 'IVA', "importe" => 1.36);#
    array_push($trasladosComprobante, $ivaComprobante);#
    array_push($trasladosComprobante, $iepsComprobante);#
    array_push($retencionesComprobante, $ivaRetenidoComprobante);#
    $impuestosComprobante = array('traslados' => $trasladosComprobante, "retenciones" => $retencionesComprobante);
    $cfdi = array(
        'folio' => 3977,
        'nombreSerie' => 'E',
        'confirmacion' => '',
        "receptor" => array('rfc' => 'AESO900522RW9', "nombre", "Omar Ascencio Saavedra", "usoCFDI" => "G03"),
        'monedaSimbolo' => 'USD',
        'monedaTipoCambio' => 18.16,
        'fechaEmision' => '2017-08-31T07:01:23',
        'formaPago' => '03', #'regimenFiscal' => '601', #Si no se especifica el régimen fiscal del emisor se usará el configurado en la implementación 'lugarExpedicion' => '45065',
        'metodoPago' => 'PUE',
        'condicionesDePago' => 'Contado',
        'concepto' => $listaConceptos, #'subTotal' => 1290.90, #el subtotal puede omitirse y el sistema lo calcularía con base en la suma de los importes# "impuestos" => $impuestosComprobante, #'total' => 1496.04, #el valor del total también puede omitirse, en cuyo caso el sistema lo calcularía 'notas' => 'Ejemplo de notas',
    );
    $response = $client -> crearComprobante(array("usuario" => $usuario, "password" => $password, "comprobante" => $cfdi));
}
catch (SoapFault $fault) {
    echo "SOAPFault: ".$fault -> faultcode.
    "-".$fault -> faultstring.
    "\n";
}

$ret = $response ->
    return;
print_r($ret);
print_r("Estatus: ".$ret -> estatus.PHP_EOL);
print_r("Mensaje: ".$ret -> mensaje.PHP_EOL);

print_r("Folio:  ".$ret -> folio.PHP_EOL);
print_r("UUID:   ".$ret -> uuid.PHP_EOL);
?>

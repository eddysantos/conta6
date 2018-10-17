<?php

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
$id_factura = $folioFactura;
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

?>

<?php

#nombre carpetas
$anioActual = date('Y');
$rutaAnioActual = $root . '/CFDI_generados/'.$anioActual;
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
$nombre_archivo = $referencia.'_'.$id_factura.'_pago';
$fileXML = $nombre_archivo.'.xml';

#rutas archivos
$rutaTempFile = $rutaTemp.'/'.$fileXML;
$rutaRepFileZip = $rutaRep.'/'.$nombre_archivo.'.zip';
$rutaRepFileXML = $rutaRep.'/'.$nombre_archivo.'.xml';
$rutaRepFileHTML = $rutaCLT.'/'.$nombre_archivo.'.html';
$rutaRepFilePDF = $rutaCLT.'/'.$nombre_archivo.'.pdf';
$rutaQRFile = $rutaQR.'/'.$nombre_archivo.'.png';

#nombre archivo modo timbrado_test
$nombre_archivoTest = $nombre_archivo.'_TEST';
$fileXMLtest = $nombre_archivoTest.'.xml';
$rutaRepFileZipTest = $rutaRep.'/'.$nombre_archivoTest.'.zip';
$rutaRepFileXMLTest = $rutaRep.'/'.$nombre_archivoTest.'.xml';

#nombre archivo modo cancela
$nombre_archivoCancela = $nombre_archivo.'_cancelado';
$fileXMLCancela = $nombre_archivoCancela.'.xml';
//$rutaRepFileZipCancela = $rutaRep.'/'.$nombre_archivoCancela.'.zip';
$rutaRepFileXMLCancela = $rutaRep.'/'.$nombre_archivoCancela.'.xml';
$rutaCLTFileXMLCancela = $rutaCLT.'/'.$nombre_archivoCancela.'.xml';
$rutaCLTFileHTMLCancela = $rutaCLT.'/'.$nombre_archivoCancela.'.html';

#nombre archivo modo cancela_test
$SHCP = $root . '/Resources/imagenes/SHCP.png';
$nombre_archivoCancelaTest = $nombre_archivo.'cancelado_TEST';
$fileXMLCancelaTest = $nombre_archivoCancelaTest.'.xml';
$rutaRepFileZipCancelaTest = $rutaRep.'/'.$nombre_archivoCancelaTest.'.zip';
$rutaRepFileXMLCancelaTest = $rutaRep.'/'.$nombre_archivoCancelaTest.'.xml';

?>

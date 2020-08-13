<?php
	$archivo = trim($_GET['archivo']);
	$poliza = trim($_GET['poliza']);
	$formato = trim($_GET['formato']);


	$root = $_SERVER['DOCUMENT_ROOT'];
	$archivoPath = $root . '/CFDI_BackUpsContabilidad/'.$archivo;

	$ar=file_get_contents($archivoPath,true);

	if(!$ar){
   		echo "<h1><center><font color=#FF0000>Archivo no encontrado, haga una busqueda desde la ruta del FTP</font></center></h1>";
 	}else{
		header('Content-type: application/xml');
		if($formato == 'V'){
			#VER EN PANTALLA
			header('Content-Disposition: inline;');
		}
		if($formato == 'D'){
			#DESCARGA
			header('Content-Disposition: attachment; filename="'.$poliza.'_'.$archivo.'"');
		}

		echo $ar;
	}

?>

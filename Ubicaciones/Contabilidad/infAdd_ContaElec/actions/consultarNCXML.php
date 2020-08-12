<?php
	$anio = trim($_GET['anio']);
	$id_cliente = trim($_GET['id_cliente']);
	$id_referencia = trim($_GET['id_referencia']);
	$id_NC = trim($_GET['id_NC']);
	$anioActual = date("Y");
	$poliza = trim($_GET['poliza']);
	$formato = trim($_GET['formato']);

	$archivo = $id_NC."_".$id_referencia."_NC.xml";
	$root = $_SERVER['DOCUMENT_ROOT'];
	$archivoPath = "/conta6/CFDI_generados/".$anio."/".$id_cliente."/".$archivo;

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

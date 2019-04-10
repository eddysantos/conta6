<?php
	$nombreArchivo = trim($_GET['nombreArchivo']);
	$ruta = trim($_GET['ruta']);

	header('Content-type: application/pdf');
	header('Content-Disposition: inline; filename="'.$nombreArchivo.'"');

	$ar=file_get_contents($ruta,true);

	if(!$ar){
   		echo "<h1><center><font color=#FF0000>Archivo no encontrado, haga una busqueda desde la ruta del FTP</font></center></h1>";
 	}else{
			echo $ar;
	}
?>

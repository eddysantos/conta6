<?php
	include ("../conexion.php");
	include ("../conexionGlobalPCnet.php");	
	 
	#**************
	# PROVEEDORES *
	#**************
	$sql_proveedores = mysqli_query($linkPCnet,"SELECT dFechaActualizacion,
																sTelefonoContacto,
																sNombreContacto,
																sCiudadProveedor,
																sCalleProveedor,
																sNombreProveedor,
																sCveCliente,
																sCveProveedor
										FROM cu_cliente_proveedor ");
										
	
	while( $oRst_proveedores = mysqli_fetch_array($sql_proveedores) ){
		$PRO_OBS1 = trim($oRst_proveedores['dFechaActualizacion']);
		$PRO_TELEFONO = trim($oRst_proveedores['sTelefonoContacto']);
		$PRO_CONTACTO = trim($oRst_proveedores['sNombreContacto']);
		$PRO_CIUDAD = trim($oRst_proveedores['sCiudadProveedor']);
		$PRO_CALLE = trim($oRst_proveedores['sCalleProveedor']);
		$PRO_NOMBRE = trim($oRst_proveedores['sNombreProveedor']);
		$ID_CLIENTE = trim($oRst_proveedores['sCveCliente']);
		$ID_PROVEEDOR = trim($oRst_proveedores['sCveProveedor']);
		
		$PRO_NOMBRE = preg_replace("/'/"," ", $PRO_NOMBRE);

		$sql_consProv = mysqli_query($link,"SELECT * FROM tbl_proveedores where id_proveedor = '$ID_PROVEEDOR' and id_cliente = '$ID_CLIENTE' ");
		$total_consProv = mysqli_num_rows($sql_consProv);
		
		if( $total_consProv > 0 ){
			mysqli_query($link,"UPDATE TBL_PROVEEDORES SET
								PRO_OBS1 = '$PRO_OBS1',
								PRO_TELEFONO = '$PRO_TELEFONO',
								PRO_CONTACTO = '$PRO_CONTACTO',
								PRO_CIUDAD = '$PRO_CIUDAD',
								PRO_CALLE = '$PRO_CALLE',
								PRO_NOMBRE = '$PRO_NOMBRE',
								ID_CLIENTE = '$ID_CLIENTE'
						WHERE ID_PROVEEDOR = '$ID_PROVEEDOR' and id_cliente = '$ID_CLIENTE'");
		}else{
			mysqli_query($link,"INSERT INTO TBL_PROVEEDORES (	PRO_OBS1,
																PRO_TELEFONO,
																PRO_CONTACTO,
																PRO_CIUDAD,
																PRO_CALLE,
																PRO_NOMBRE,
																ID_CLIENTE,
																ID_PROVEEDOR
														)VALUES(
																'$PRO_OBS1',
																'$PRO_TELEFONO',
																'$PRO_CONTACTO',
																'$PRO_CIUDAD',
																'$PRO_CALLE',
																'$PRO_NOMBRE',
																'$ID_CLIENTE',
																'$ID_PROVEEDOR' )");
		}
	}
echo "SE ACTUALIZARON TODOS LOS PROVEEDORES";	
?>

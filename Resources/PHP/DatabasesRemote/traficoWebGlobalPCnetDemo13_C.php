<?php
require $root . '/Resources/PHP/Databases/conexion.php';
require $root . '/Resources/PHP/DatabasesRemote/conexionGlobalPCnet.php';

	#***********
	# CLIENTES *
	#***********
	$sql_clientes = mysqli_query($linkPCnet,"SELECT sCveCliente,
										sRazonSocial,
										sCalle,
										sNumInterior,
										sNumExterior,
										sColonia,
										sCodigoPostal,
										sCiudad,
										sEntidadVucem,
										sCvePais,
										sRFC,
										sNomApoderadoLegal,
										sRFCApoderadoLegal,
										sNombreContacto,
										sCuentaCorreoContacto,
										sTelefonoContacto,
										dFechaActualizacion
										FROM cu_cliente");

	while( $oRst_clientes = mysqli_fetch_array($sql_clientes) ){
		$ID_Cliente = trim($oRst_clientes['sCveCliente']);
		$CLI_NOMBRE = trim($oRst_clientes['sRazonSocial']);
		$CLI_CALLE = utf8_encode(trim($oRst_clientes['sCalle']));
		$CLI_NO_INT = trim($oRst_clientes['sNumInterior']);
		$CLI_NO_EXT = trim($oRst_clientes['sNumExterior']);
		$CLI_COLONIA = trim($oRst_clientes['sColonia']);
		$CLI_CODIGO = trim($oRst_clientes['sCodigoPostal']);
		$CLI_CIUDAD = trim($oRst_clientes['sCiudad']);
		$CLI_ESTADO = trim($oRst_clientes['sEntidadVucem']);
		$CLI_PAIS = trim($oRst_clientes['sCvePais']);
		$CLI_RFC = trim($oRst_clientes['sRFC']);
		$CLI_REP_LEGAL = trim($oRst_clientes['sNomApoderadoLegal']);
		$CLI_RFC_LEGAL = trim($oRst_clientes['sRFCApoderadoLegal']);
		$CLI_CONTACTO = trim($oRst_clientes['sNombreContacto']);
		$CLI_EMAIL = trim($oRst_clientes['sCuentaCorreoContacto']);
		$CLI_TELEFONO = trim($oRst_clientes['sTelefonoContacto']);
		$CLI_ALTA_FECHA = trim($oRst_clientes['dFechaActualizacion']);

		$CLI_ALTA_FECHA = date_format(date_create($CLI_ALTA_FECHA),'Y-m-d H:i:s');

		$sql_consClt = mysqli_query($db,"SELECT *	FROM conta_replica_clientes where pk_id_cliente = '$ID_Cliente' ");
		$total_consClt = mysqli_num_rows($sql_consClt);

		if( $total_consClt > 0 ){ }else{
			mysqli_query($db,"INSERT INTO conta_replica_clientes (pk_id_cliente)VALUES('$ID_Cliente')");
		}

		mysqli_query($db,"UPDATE conta_replica_clientes SET
					s_nombre = '$CLI_NOMBRE',
					s_calle = '$CLI_CALLE',
					s_no_int = '$CLI_NO_INT',
					s_no_ext = '$CLI_NO_EXT',
					s_colonia = '$CLI_COLONIA',
					s_codigo = '$CLI_CODIGO',
					s_ciudad = '$CLI_CIUDAD',
					s_ciudad = '$CLI_ESTADO',
					s_pais = '$CLI_PAIS',
					s_rfc = '$CLI_RFC',
					s_rep_legal = '$CLI_REP_LEGAL',
					s_rfc_legal = '$CLI_RFC_LEGAL',
					s_contacto = '$CLI_CONTACTO',
					s_email = '$CLI_EMAIL',
					s_telefono = '$CLI_TELEFONO',
					d_alta_fecha = '$CLI_ALTA_FECHA'
			WHERE pk_id_cliente = '$ID_Cliente'");
	}
echo "SE ACTUALIZARON TODOS LOS CLIENTES";
?>

<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

	$id_cliente = trim($_POST['id_cliente']);

	#VERIFICO QUE EL CLIENTE TENGA CUENTAS CONTABLES 0108 Y 0208
	require $root . '/conta6/Resources/PHP/actions/consultaCtas108y208_cliente.php';
	if( $rows_ctasCliente == 0 ){
		$system_callback['code'] = "1";
		$system_callback['data'] .= "<font color='#F73a4a'><b>Error - no tiene cuentas contables (0108 y 0208) </b></font>";
	}

	#VERIFICO QUE EL CLIENTE ESTE ACTIVO
	require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente.php';
	if( $s_status == '0' ){
		$system_callback['code'] = "1";
		$system_callback['data'] .= "<font color='#F73a4a'><b>Error - INACTIVO en Contabilidad </font>";
	}


	#VERIFICO QUE EL CLIENTE TENGA ASIGNADO UN METODO DE PAGO
	require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente_formaPago.php';
	if( $rows_datosCLTformaPago == 0 ){
		$system_callback['code'] = "1";
		$system_callback['data'] .= "<font color='#F73A4A'><b> Error - NO tenen asignado un método de pago </font>";
	}

	if( $rows_ctasCliente > 0 && $s_status == '1' && $rows_datosCLTformaPago > 0 ){
		$system_callback['code'] = "2";
		$system_callback['message'] = "Script called successfully!";
	}
	exit_script($system_callback);





?>

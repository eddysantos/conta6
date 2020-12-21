<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

// $system_callback['code'] = 1;
// $system_callback['message'] = "Llego";
// exit_script($system_callback);



	$usuario = trim($_POST['usuario']);
	$id_aduana = trim($_POST['id_aduana']);
	$tipo = trim($_POST['tipo']);
	$id_poliza = trim($_POST['id_poliza']);
	$UUID = trim($_POST['UUID']);
	$RFC = trim($_POST['RFC']);
	$importe = trim($_POST['importe']); # Total EN XML
	$subtotal = trim($_POST['subtotal']); # SubTotal EN XML
	$BeneficiarioOpc = trim($_POST['BeneficiarioOpc']);
	$iva = trim($_POST['iva']);
	$iva_aplicado = trim($_POST['iva_aplicado']) * 100 ;
	$numProv = trim($_POST['numProv']);
	$proveedor = trim($_POST['proveedor']);
	$ctaproveedor = trim($_POST['ctaproveedor']);
	$folio = trim($_POST['folio']);
	$fecha_Poliza = trim($_POST['fecha_Poliza']);
	$mesPoliza = date_format(date_create(trim($fecha_Poliza)),'m');
	$accion = trim($_POST['accion']);
	$moneda = trim($_POST['moneda']);
	$tipoCamb = trim($_POST['tipoCamb']);
	$retenido = trim($_POST['retenido']);

	if( $accion == 'provisionar' ){
		$Usuario = $usuario;
		$Aduana = $id_aduana;
		$Poliza = $id_poliza;
		$Fecha = $fecha_Poliza;
		$Referencia = 0;
		$Tipo = $tipo;
		$Cliente = 0;
		$Documento = $folio;
		$Factura = 0;
		$Anticipo = 0;
		$Cheque = 0;
		$tipoInf = "CompNal";
		$fk_id_poliza = $id_poliza;

		# PARTIDA DE LA 0530
		$sql_partPoliza1 = mysqli_query($db,"SELECT pk_partida, s_desc FROM conta_t_polizas_det WHERE fk_id_poliza = $id_poliza AND fk_id_cuenta LIKE '0530-%' and s_folioCFDIext  = $folio ");
		$totalRegistros_partPoliza1 = mysqli_num_rows($sql_partPoliza1);
		if( $totalRegistros_partPoliza1 > 0 ){
			$oRst_partPoliza1 = mysqli_fetch_array($sql_partPoliza1);
			$partidaPoliza = $oRst_partPoliza1["pk_partida"];
			$desc = $oRst_partPoliza1["s_desc"];

			$partidaDoc = $partidaPoliza;
			require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
		}

		if( $totalRegistros_partPoliza1 == 0 ){
			$oRst_partPoliza2 = mysqli_fetch_array(mysqli_query($db,"SELECT pk_partida, s_desc FROM conta_t_polizas_det WHERE fk_id_poliza = $id_poliza AND fk_id_cuenta LIKE '0530-%' "));
			$partidaPoliza = $oRst_partPoliza2["pk_partida"];
			$desc = $oRst_partPoliza2["s_desc"];

			$partidaDoc = $partidaPoliza;
			require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
		}

 		$Desc = str_replace('::470::','',$desc);
		$Desc = str_replace('::240::','',$Desc);
		$Desc = str_replace('::430::','',$Desc);
		$Desc = str_replace('::160::','',$Desc);
		$Desc = str_replace('::240::','',$Desc);


		#*******
		# IVA
		#*******
		if( $iva_aplicado == 16 ){ $Cuenta = '0119-00001'; }
		if( $iva_aplicado == 8  ){ $Cuenta = '0119-00003'; }

		$Cargo = $iva;
		$Abono = 0;

		mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_tipo,fk_id_poliza,d_fecha,fk_id_cuenta,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_factura,fk_anticipo,fk_cheque,s_desc,n_cargo,n_abono,d_mes,fk_id_proveedor) VALUES (
														$Tipo,'$Poliza','$Fecha','$Cuenta','$Referencia','$Cliente',$Documento,'$Factura',$Anticipo,$Cheque,'$Desc',$Cargo,$Abono,$mesPoliza,$numProv)");
		$partida_0119 = mysqli_insert_id($db);

		if( $partida_0119 > 0 ){
			$partidaDoc = $partida_0119;
			require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
		}


		#*******
		# Total DEL XML
		#*******
		$Cuenta = $ctaproveedor;
		$Cargo = 0;
		$Abono = $importe;
		mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_tipo,fk_id_poliza,d_fecha,fk_id_cuenta,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_factura,fk_anticipo,fk_cheque,s_desc,n_cargo,n_abono,d_mes,fk_id_proveedor) VALUES (
														$Tipo,'$Poliza','$Fecha','$Cuenta','$Referencia','$Cliente',$Documento,'$Factura',$Anticipo,$Cheque,'$Desc',$Cargo,$Abono,$mesPoliza,$numProv)");
		$partida_0206 = mysqli_insert_id($db);

		if( $partida_0206 > 0 ){
			$partidaDoc = $partida_0206;
			require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
		}


		#*******
		# Retenido
		#*******
		$datosPartida_0201_27 = "";
		if( $retenido > 0 ){
			$Cuenta = '0201-00027';
			$Abono = $retenido;
			$Cargo = 0;
			mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_tipo,fk_id_poliza,d_fecha,fk_id_cuenta,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_factura,fk_anticipo,fk_cheque,s_desc,n_cargo,n_abono,d_mes,fk_id_proveedor) VALUES (
															$Tipo,'$Poliza','$Fecha','$Cuenta','$Referencia','$Cliente',$Documento,'$Factura',$Anticipo,$Cheque,'$Desc',$Cargo,$Abono,$mesPoliza,$numProv)");
			$partida_0201_27 = mysqli_insert_id($db);
			$datosPartida_0201_27 = ",($numProv,$partida_0201_27,'$fechaActual','$usuario')";

			if( $partida_0201_27 > 0 ){
				$partidaDoc = $partida_0201_27;
				require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
			}

		}

		$descripcion = "Se inserto Poliza: $id_poliza tipo: $tipo Doc:$Documento desde btnProvision 0206:$importe 119:$iva 201-27:$retenido Prov:$BeneficiarioOpc";
		$clave = 'polizas';
		$folio = $id_poliza;
		require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

		$system_callback['code'] = 1;
		$system_callback['message'] = "Script called successfully!";
		exit_script($system_callback);
	}

	if( $accion == 'pagarProvision' ){
		$Usuario = $usuario;
		$Aduana = $id_aduana;
		$Poliza = $id_poliza;
		$Fecha = $fecha_Poliza;
		$Referencia = 0;
		$Tipo = $tipo;
		$Cliente = 0;
		$Documento = $folio;
		$Factura = 0;
		$Anticipo = 0;
		$Cheque = 0;
		$tipoInf = "CompNal";

		# PARTIDA DE LA 0100
		$sql_partPoliza1 = mysqli_query($db,"SELECT pk_partida, s_desc FROM conta_t_polizas_det WHERE fk_id_poliza =  $id_poliza AND fk_id_cuenta LIKE '0100-%' and s_folioCFDIext  = $folio ");
		$totalRegistros_partPoliza1 = mysqli_num_rows($sql_partPoliza1);
		if( $totalRegistros_partPoliza1 > 0 ){
			$oRst_partPoliza1 = mysqli_fetch_array($sql_partPoliza1);
			$partidaPoliza = $oRst_partPoliza1["pk_partida"];
			$desc = $oRst_partPoliza1["s_desc"];

			$partidaDoc = $partidaPoliza;
			require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
		}

		if( $totalRegistros_partPoliza1 == 0 ){
			$oRst_partPoliza2 = mysqli_fetch_array(mysqli_query($db,"SELECT pk_partida, s_desc FROM conta_t_polizas_det WHERE fk_id_poliza =  $id_poliza AND fk_id_cuenta LIKE '0100-%'"));
			$partidaPoliza = $oRst_partPoliza2["pk_partida"];
			$desc = $oRst_partPoliza2["s_desc"];

			$partidaDoc = $partidaPoliza;
			require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
		}
		$Desc = $desc;

		#*******
		# Total DEL XML
		#*******
		$Cuenta = $ctaproveedor;
		$Cargo = $importe;
		$Abono = 0;
		mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_tipo,fk_id_poliza,d_fecha,fk_id_cuenta,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_factura,fk_anticipo,fk_cheque,s_desc,n_cargo,n_abono,d_mes,fk_id_proveedor) VALUES (
														$Tipo,'$Poliza','$Fecha','$Cuenta','$Referencia','$Cliente',$Documento,'$Factura',$Anticipo,$Cheque,'$Desc',$Cargo,$Abono,$mesPoliza,$numProv)");

		$partida_0206 = mysqli_insert_id($db);

		#*******
		# IVA pendiente de pago
		#*******
		$Cuenta = '0119-00001';
		$Cargo = 0;
		$Abono = $iva;
		mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_tipo,fk_id_poliza,d_fecha,fk_id_cuenta,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_factura,fk_anticipo,fk_cheque,s_desc,n_cargo,n_abono,d_mes,fk_id_proveedor) VALUES (
														$Tipo,'$Poliza','$Fecha','$Cuenta','$Referencia','$Cliente',$Documento,'$Factura',$Anticipo,$Cheque,'$Desc',$Cargo,$Abono,$mesPoliza,$numProv)");

		$partida_0119 = mysqli_insert_id($db);
		if( $partida_0119 > 0 ){
			$partidaDoc = $partida_0119;
			require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
		}

		# IVA pendiente de pago
		if( $iva_aplicado == 16 ){ $Cuenta = '0168-00005'; }
		if( $iva_aplicado == 11 ){ $Cuenta = '0168-00007'; }
		if( $iva_aplicado == 8 ){ $Cuenta = '0168-00010'; }

		$Cargo = $iva;
		$Abono = 0;
		mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_tipo,fk_id_poliza,d_fecha,fk_id_cuenta,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_factura,fk_anticipo,fk_cheque,s_desc,n_cargo,n_abono,d_mes,fk_id_proveedor) VALUES (
														$Tipo,'$Poliza','$Fecha','$Cuenta','$Referencia','$Cliente',$Documento,'$Factura',$Anticipo,$Cheque,'$Desc',$Cargo,$Abono,$mesPoliza,$numProv)");

		$partida_0168 = mysqli_insert_id($db);
		if( $partida_0168 > 0 ){
			$partidaDoc = $partida_0168;
			require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
		}


		#*******
		# Retenido
		#*******
		$datosPartida_0201_27 = "";
		$datosPartida_0201_04 = "";
		if( $retenido > 0 ){
			$Cuenta = '0201-00027';
			$Abono = 0;
			$Cargo = $retenido;
			mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_tipo,fk_id_poliza,d_fecha,fk_id_cuenta,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_factura,fk_anticipo,fk_cheque,s_desc,n_cargo,n_abono,d_mes,fk_id_proveedor) VALUES (
															$Tipo,'$Poliza','$Fecha','$Cuenta','$Referencia','$Cliente',$Documento,'$Factura',$Anticipo,$Cheque,'$Desc',$Cargo,$Abono,$mesPoliza,$numProv)");
			$partida_0201_27 = mysqli_insert_id($db);
			$datosPartida_0201_27 = ",($numProv,$partida_0201_27,'$fechaActual','$usuario')";

			if( $partida_0201_27 > 0 ){
				$partidaDoc = $partida_0201_27;
				require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
			}



			$Cuenta = '0201-00004';
			$Abono = $retenido;
			$Cargo = 0;
			mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_tipo,fk_id_poliza,d_fecha,fk_id_cuenta,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_factura,fk_anticipo,fk_cheque,s_desc,n_cargo,n_abono,d_mes,fk_id_proveedor) VALUES (
															$Tipo,'$Poliza','$Fecha','$Cuenta','$Referencia','$Cliente',$Documento,'$Factura',$Anticipo,$Cheque,'$Desc',$Cargo,$Abono,$mesPoliza,$numProv)");
			$partida_0201_04 = mysqli_insert_id($db);
			$datosPartida_0201_04 = ",($numProv,$partida_0201_04,'$fechaActual','$usuario')";

			if( $partida_0201_04 > 0 ){
				$partidaDoc = $partida_0201_04;
				require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
			}



		}

		$descripcion = "Se inserto Poliza: $id_poliza tipo: $tipo Doc:$Documento desde btnProvision 0206:$importe 119,168:$iva 201-27,04:$retenido Prov:$BeneficiarioOpc";
		$clave = 'polizas';
		$folio = $id_poliza;
		require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

		$system_callback['code'] = 1;
		$system_callback['message'] = "Script called successfully!";
		exit_script($system_callback);




	}#terminada accion pagar

?>

<html>
<head>
<title>Impresion de Anticipo</title>
<?php
	$root = $_SERVER['DOCUMENT_ROOT'];
	require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';
	require $root . '/conta6/Resources/PHP/actions/numtoletras.php';

	$id_anticipo = trim($_GET['id_anticipo']);

	$sql_Select = "SELECT * from conta_t_anticipos_mst Where pk_id_anticipo = ?";
  	$stmt = $db->prepare($sql_Select);
	if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
	$stmt->bind_param('s', $id_anticipo);
	if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}
	if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
	$rslt = $stmt->get_result();
	$rows = $rslt->num_rows;

	if( $rows > 0 ){
		$rowMST = $rslt->fetch_assoc();

		$Total = $rowMST["n_valor"];
		$id_cliente = trim($rowMST["fk_id_cliente"]);
		$Cuenta = trim($rowMST["fk_id_cuentaMST"]);
		$id_poliza = trim($rowMST["fk_id_poliza"]);
		$Fecha = trim($rowMST["d_fecha"]);
		if(!is_null($oRst_Select["d_fecha"])){ $Fecha = date_format(date_create($oRst_Select["d_fecha"]),"d/m/Y"); }
		$TotalLetra = "*** ".numtoletras($Total)." ***";

		$sql_SelectCLT = "SELECT s_nombre FROM conta_replica_clientes WHERE pk_id_cliente = ?";
		$stmtCLT = $db->prepare($sql_SelectCLT);
		if (!($stmtCLT)) { die("Error during query prepare CLT [$db->errno]: $db->error");	}
		$stmtCLT->bind_param('s', $id_cliente);
		if (!($stmtCLT)) { die("Error during query prepare CLT [$stmtCLT->errno]: $stmtCLT->error");	}
		if (!($stmtCLT->execute())) { die("Error during query prepare CLT [$stmtCLT->errno]: $stmtCLT->error"); }
		$rsltCLT = $stmtCLT->get_result();
		$rowCLT = $rsltCLT->fetch_assoc();
		$nombre = trim($rowCLT["s_nombre"]);

		$sql_SelectCTA = "select s_cta_desc from conta_cs_cuentas_mst where pk_id_cuenta = ?";
		$stmtCTA = $db->prepare($sql_SelectCTA);
		if (!($stmtCTA)) { die("Error during query prepare CTA [$db->errno]: $db->error");	}
		$stmtCTA->bind_param('s', $Cuenta);
		if (!($stmtCTA)) { die("Error during query prepare CTA [$stmtCTA->errno]: $stmtCTA->error");	}
		if (!($stmtCTA->execute())) { die("Error during query prepare CTA [$stmtCTA->errno]: $stmtCTA->error"); }
		$rsltCTA = $stmtCTA->get_result();
		$rowCTA = $rsltCTA->fetch_assoc();
		$Cuenta_Desc = $rowCTA["s_cta_desc"];

		$sql_SelectPOL = "select * from conta_t_polizas_det where fk_id_poliza = ? order by pk_partida";
		$stmtPOL = $db->prepare($sql_SelectPOL);
		if (!($stmtPOL)) { die("Error during query prepare POL [$db->errno]: $db->error");	}
		$stmtPOL->bind_param('s', $id_poliza);
		if (!($stmtPOL)) { die("Error during query prepare POL [$stmtPOL->errno]: $stmtPOL->error");	}
		if (!($stmtPOL->execute())) { die("Error during query prepare POL [$stmtPOL->errno]: $stmtPOL->error"); }
		$rsltPOL = $stmtPOL->get_result();
		$rowsReg = $rsltPOL->num_rows;

		$sql_SelectTotales = "select fk_id_poliza,SUM(n_cargo)as SUMA_CARGOS,SUM(n_abono)as SUMA_ABONOS from conta_t_polizas_det where fk_id_poliza = ? group by fk_id_poliza";
		$stmtTotales = $db->prepare($sql_SelectTotales);
		if (!($stmtTotales)) { die("Error during query prepare Totales [$db->errno]: $db->error");	}
		$stmtTotales->bind_param('s', $id_poliza);
		if (!($stmtTotales)) { die("Error during query prepare Totales [$stmtTotales->errno]: $stmtTotales->error");	}
		if (!($stmtTotales->execute())) { die("Error during query prepare Totales [$stmtTotales->errno]: $stmtTotales->error"); }
		$rsltTotales = $stmtTotales->get_result();
		$rowTotales = $rsltTotales->fetch_assoc();
		$sumaCargos = $rowTotales["SUMA_CARGOS"];
		$sumaAbonos = $rowTotales["SUMA_ABONOS"];



	}









?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body">
<table border="0" width="100%" cellspacing="1">
	<tr>
		<td width="10%"><font size="2" face="Trebuchet MS">Anticipo</font></td>
		<td width="30%" colspan="2">
			<font face="Trebuchet MS" size="2" color="#FFFFFF">
			<input type="text" name="T_Fecha_Generacion2" size="28" style="border:1px solid #FFFFFF; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#FFFFFF; width:176; height:20" value="<?php echo $id_anticipo; ?>" readonly ></td>
		<td width="60%" colspan="3" rowspan="2">
		<p align="right"><b><font face="Trebuchet MS" size="5"><?php echo utf8_encode($nombreCIA); ?></font></b></td>
	</tr>
	<tr>
		<td width="10%"><font size="2" face="Trebuchet MS">Fecha</font></td>
		<td width="30%" colspan="2">
			<font face="Trebuchet MS" size="2" color="#FFFFFF">
			<input type="text" name="T_Fecha_Generacion3" size="28" style="border:1px solid #FFFFFF; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#FFFFFF; width:176; height:20" value="<?php echo $Fecha; ?>" readonly ></td>
	</tr>
	<tr>
		<td width="20%" colspan="2">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" colspan="2">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" colspan="2">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" colspan="2">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="100%" colspan="6"><font face="Trebuchet MS" size="2">Se Recibe Depósito del Cliente:</font>&nbsp;&nbsp;<input type="text" name="T_Fecha_Generacion4" size="60" style="border:1px solid #FFFFFF; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#FFFFFF; width:400; height:20" value="<?php echo $nombre; ?>" readonly ></td>
	</tr>
	<tr>
		<td width="100%" colspan="6">
		<font face="Trebuchet MS" size="2" color="#FFFFFF">
			<input type="text" name="T_Fecha_Generacion5" size="60" style="border:1px solid #FFFFFF; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#FFFFFF; width:550; height:20" value="<?php echo $Cuenta_Desc; ?>" readonly ></td>
	</tr>
	<tr>
		<td width="20%" colspan="2">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">
			<font face="Trebuchet MS" size="2">&nbsp;</font><font face="Trebuchet MS" size="2" color="#FFFFFF"><input type="text" name="T_Fecha_Generacion6" size="28" style="border:1px solid #FFFFFF; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#FFFFFF; width:81; height:20" value="$ <?php echo number_format($Total,2,'.',','); ?>" readonly ></td>
	</tr>
	<tr>
		<td width="20%" colspan="2">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="100%" colspan="6" style="font-family: Trebuchet MS; font-size: 8pt; color: #000000">
		<?php echo trim($TotalLetra); ?></td>
	</tr>
	<tr>
		<td width="20%" colspan="2">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" colspan="2">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" colspan="2">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="40%" colspan="2" style="border-left-width: 1px; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-width: 1px">
		<p align="center"><b><font face="Trebuchet MS" size="2">FIRMA</font></b></td>
	</tr>
	<tr>
		<td width="20%" colspan="2">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" colspan="2">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	</tr>
	<tr>
		<td width="100%" colspan="6" style="font-family: Trebuchet MS; font-size: 8pt; color: #000000"><?php echo $Cuenta_Desc; ?></td>
	</tr>
	</table>

<br>


<?php if( $rowsReg > 0 ){ ?>
<table border="1" width="100%" id="table4" style="font-family: Trebuchet MS; font-size: 8pt; border-collapse:collapse; color:#000000" cellspacing="1" cellpadding="0" align="center">

	<tr bgcolor="#808080" align="center" style="color:#FFFFFF">
		<td width="3%">Póliza</td>
		<td width="10%">Cuenta</td>
		<td width="9%">Referencia</td>
		<td width="7%">Cliente</td>
		<td width="7%">Factura</td>
		<td width="7%">CtaGastos</td>
		<td width="7%">PagoE</td>
		<td width="7%">NotaCred</td>
		<td width="7%">Fecha</td>
		<td width="30%">Descripción</td>
		<td width="10%">Cargo</td>
		<td width="10%">Abono</td>

	</tr>
<?php
	while( $rowPOL = $rsltPOL->fetch_assoc() ){ ?>
	<tr align="center">
		<td width="3%"><?php echo $rowPOL["fk_id_poliza"]; ?></td>
		<td width="10%"><?php echo trim($rowPOL["fk_id_cuenta"]); ?></td>
		<td width="7%"><?php echo trim($rowPOL["fk_referencia"]); ?></td>
		<td width="10%"><?php echo trim($rowPOL["fk_id_cliente"]); ?></td>
		<td width="10%"><?php echo trim($rowPOL["fk_factura"]); ?></td>
		<td width="10%"><?php echo trim($rowPOL["fk_ctagastos"]); ?></td>
		<td width="10%"><?php echo trim($rowPOL["fk_pago"]); ?></td>
		<td width="10%"><?php echo trim($rowPOL["fk_nc"]); ?></td>
		<td width="10%"><?php if (!is_null($rowPOL["d_fecha"])){ echo date_format(date_create($rowPOL["d_fecha"]),"d-m-Y"); }?></td>
		<td width="30%" align="left"><?php echo trim($rowPOL["s_desc"]); ?></td>
		<td width="10%" align="right"><?php echo number_format($rowPOL["n_cargo"],2,'.',','); ?></td>
		<td width="10%"align="right"><?php echo number_format($rowPOL["n_abono"],2,'.',','); ?></td>
	</tr>
<?PHP }  ?>

	</table>
</center>
<table align=center>
<tr>
		<td width="3%" align="center">&nbsp;</td>
		<td width="10%" align="center">&nbsp;</td>
		<td width="9%" align="center">&nbsp;</td>
		<td width="7%" align="center">&nbsp;</td>
		<td width="7%" align="center">&nbsp;</td>
		<td width="7%" align="center">&nbsp;</td>
		<td width="30%" align="center">
		<p align="right"><font face="Arial">
		<input type="text" name="Titulo0" size="22" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:8pt; text-align:center; color:#FFFFFF; font-weight:bold; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; width:100; height:20; background-color:#808080" value="Totales" readonly></font></td>
		<td width="10%" align="center"><font face="Arial">
				<input type="text" name="T_Suma_Cargos0" size="22" style="border:1px solid #000000; font-family: Trebuchet MS; font-size:9px; text-align:right; color:#000000; font-weight:bold; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; width:70; height:20" value="<?php echo number_format($sumaCargos,2,'.',','); ?>" readonly></font></td>
		<td width="10%" align="center"><font face="Arial">
				<input type="text" name="T_Suma_Abonos" size="22" style="border:1px solid #000000; font-family: Trebuchet MS; font-size:9px; text-align:right; color:#000000; font-weight:bold; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; width:70; height:20" value="<?php echo number_format($sumaAbonos,2,'.',','); ?>" readonly></font></td>
</tr>

</table>
<?PHP }else{ ?>
	<p align="center"><b><font face="Trebuchet MS" size="2" align="center" >NO HAY DETALLES DE ESTE ANTICIPO</font></b></p>
	<p align="center">&nbsp;</p>


<?PHP } ?>


	</body>
</html>

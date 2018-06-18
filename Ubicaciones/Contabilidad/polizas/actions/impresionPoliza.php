<?php
$root = $_SERVER['DOCUMENT_ROOT'];
// require $root . '/conta6/Ubicaciones/barradenavegacion.php';

require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_poliza = trim($_GET['id_poliza']);
$aduana = trim($_GET['aduana']);

$oRst_Select = mysqli_query($db,"Select * from conta_t_polizas_mst Where pk_id_poliza = $id_poliza AND fk_id_aduana = $aduana");
$totalRegistrosSelect = mysqli_num_rows($oRst_Select);
$oRst_Select = mysqli_fetch_array($oRst_Select);

$oRst_POLDET_sql = mysqli_query($db,"select * from conta_t_polizas_det where fk_id_poliza = $id_poliza order by pk_partida");
$totalRegistrosPOLDET = mysqli_num_rows($oRst_POLDET_sql);

$oRst_STPD = mysqli_query($db,"select fk_id_poliza,SUM(n_cargo)as SUMA_CARGOS,SUM(n_abono)as SUMA_ABONOS from conta_t_polizas_det where fk_id_poliza = $id_poliza group by fk_id_poliza ");
$totalRegistrosSTPD = mysqli_num_rows($oRst_STPD);
$oRst_STPD = mysqli_fetch_array($oRst_STPD);

if( $totalRegistrosSTPD > 0 ){
	$Status_Poliza = number_format($oRst_STPD["SUMA_CARGOS"] - $oRst_STPD["SUMA_ABONOS"],2,'.',',');
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Impresion de Poliza</title>
</head>
<body  leftmargin="20" rightmargin="20">
<table border="0" cellpadding="0" cellspacing="0" width="100%" id="table16">
	<tr>
		<td width="29%">
		<p align="left"><td width="14%" align="center">&nbsp;</td>
		<td width="42%" align="center">&nbsp;</td>
		<td width="15%" align="center">&nbsp;</td>
	</tr>
</table>
<?php
	 if( $totalRegistrosSelect > 0 ){
	 $cancela = $oRst_Select["s_cancela"];
	 if( $cancela == 1 ){ $txt_cancela = "P�liza Cancelada";}else{$txt_cancela = "";}
?>
<br>
<table border="0" width="100%" id="table26">
	<tr>
		<td><i><font face="Trebuchet MS" size="5">Proyecci&oacute;n Log&iacute;stica Agencia Aduanal S.A. de C.V.</font></i></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><font face="Trebuchet MS"><b>P&oacute;lizas</b></font></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
<table border="1" width="100%" id="table24" bordercolorlight="#808080" bordercolordark="#808080" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td>
		<table border="0" width="100%" id="table25">
			<tr>
				<td width="24%"><font face="Trebuchet MS" size="1">Fecha de la P&oacute;liza</font></td>
				<td width="20%"><font face="Trebuchet MS" size="2" color="#FFFFFF"><input name="T_Fecha_Poliza" size="28" onChange="fUpper(document.Polizas_Detalle.T_Cuenta)" style="border:1px solid #FFFFFF; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#FFFFFF; float:left" value="<?php if (!is_null($oRst_Select["d_fecha"])){ echo date_format(date_create($oRst_Select["d_fecha"]),"d/m/Y"); }?>" ></td>
				<td width="17%">&nbsp;</td>
				<td width="23%"><font face="Trebuchet MS" size="1">P&oacute;liza</font></td>
				<td width="16%"><p align="center"><font face="Trebuchet MS" size="2" color="#FFFFFF"><input type="text" name="T_Poliza" size="23" onChange="fUpper(document.Polizas_Detalle.T_Cuenta)" style="border:1px solid #FFFFFF; font-family: Trebuchet MS; font-size:8pt; text-align:center; " value="<?php echo $id_poliza; ?>" readonly ></td>
			</tr>
			<tr>
				<td width="24%"><font face="Trebuchet MS" size="1">Usuario que
				Capturo</font></td>
				<td width="20%">
			<font face="Trebuchet MS" size="2" color="#FFFFFF">
			<input name="T_Usuario" size="23" onChange="fUpper(document.Polizas_Detalle.T_Cuenta)" style="border:1px solid #FFFFFF; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#FFFFFF; float:left" value="<?php echo trim($oRst_Select["fk_usuario"]); ?>" ></td>
				<td width="17%">&nbsp;</td>
				<td width="23%"><font face="Trebuchet MS" size="1"><?php echo $txt_cancela; ?></font></td>
				<td width="16%">&nbsp;</td>
			</tr>
			<tr>
				<td width="24%"><font face="Trebuchet MS" size="1">Fecha de Captura</font></td>
				<td width="20%">
			<font face="Trebuchet MS" size="2" color="#FFFFFF">
			<input name="T_Fecha_Generacion" size="28" onChange="fUpper(document.Polizas_Detalle.T_Cuenta)" style="border:1px solid #FFFFFF; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#FFFFFF; float:left" value="<?php if (!is_null($oRst_Select["d_fecha_alta"])){ echo date_format(date_create($oRst_Select["d_fecha_alta"]),"d-m-Y H:i:s"); }?>" ></td>
				<td width="17%">&nbsp;</td>
				<td width="23%">&nbsp;</td>
				<td width="16%">&nbsp;</td>
			</tr>
			<tr>
				<td width="24%"><font face="Trebuchet MS" size="1">Concepto</font></td>
				<td width="76%" colspan="4"><font face="Trebuchet MS" size="1"><?php echo trim($oRst_Select["s_concepto"]); ?></font></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<br>
<table border="1" width="100%" id="table4" style="font-family: Arial; font-size: 8pt; border-collapse:collapse" cellpadding="0" cellspacing="0">
	<tr style="color:#FFFFFF" align="center" bgcolor="#7F7F7F">
		<td width="3%">Tipo</td>
		<td width="10%">Cuenta</td>
		<td width="9%">Ref.</td>
		<td width="7%">Cliente</td>
		<td width="7%">Doc.</td>
		<td width="7%">Fact.</td>
		<td width="7%">Cta.Gastos</td>
		<td width="7%">P.E.</td>
		<td width="7%">N.C.</td>
		<td width="7%">Cheque</td>
		<td width="30%">Descripci&oacute;n</td>
		<td width="10%">Cargo</td>
		<td width="10%">Abono</td>
	</tr>
<?php
	if( $totalRegistrosPOLDET > 0 ){
	  	while ($oRst_POLDET = mysqli_fetch_array($oRst_POLDET_sql)){
?>
	<tr>
		<td align="center"><?php echo $oRst_POLDET["fk_tipo"]; ?></td>
		<td><?php echo $oRst_POLDET["fk_id_cuenta"]; ?></td>
		<td align=center><?php echo $oRst_POLDET["fk_referencia"]; ?></td>
		<td align="center"><?php echo $oRst_POLDET["fk_id_cliente"]; ?></td>
		<td align="center"><?php echo $oRst_POLDET["s_folioCFDIext"]; ?></td>
		<td align="center"><?php echo $oRst_POLDET["fk_factura"]; ?></td>
		<td align="center"><?php echo $oRst_POLDET["fk_ctagastos"]; ?></td>
		<td align="center"><?php echo $oRst_POLDET["fk_pago"]; ?></td>
		<td align="center"><?php echo $oRst_POLDET["fk_nc"]; ?></td>
		<td align="center"><?php echo $oRst_POLDET["fk_cheque"]; ?></td>
		<td align="left"><?php echo $oRst_POLDET["s_desc"]; ?></td>
		<td align="right"><?php echo number_format($oRst_POLDET['n_cargo'],2,'.',',');?></td>
		<td align="right"><?php echo number_format($oRst_POLDET['n_abono'],2,'.',',');?></td>
	</tr>
	<?php }
		mysqli_free_result($oRst_POLDET_sql);
	?>
</table>
<table border="0" width="100%" id="table4" style="font-family: Arial; font-size: 8pt" >
	<tr>
		<td width="3%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
		<td width="9%">&nbsp;</td>
		<td width="7%">&nbsp;</td>
		<td width="7%">&nbsp;</td>
		<td width="7%">&nbsp;</td>
		<td width="7%">&nbsp;</td>
		<td width="7%">&nbsp;</td>
		<td width="30%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><p align="right"><font face="Arial">
				<input type="text" name="Titulo" size="22" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:8pt; text-align:center; color:#FFFFFF; font-weight:bold; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; width:100; height:20; background-color:#808080" value="Totales" readonly></font></td>
		<td align="center"><font face="Arial">
				<input type="text" name="T_Suma_Cargos0" size="22" style="border:1px solid #000000; font-family: Trebuchet MS; font-size:9px; text-align:right; color:#000000; font-weight:bold; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; width:70; height:20" value="<?php echo number_format($oRst_STPD['SUMA_CARGOS'],2,'.',',');?>" readonly></font></td>
		<td align="center"><font face="Arial">
				<input type="text" name="T_Suma_Abonos" size="22" style="border:1px solid #000000; font-family: Trebuchet MS; font-size:9px; text-align:right; color:#000000; font-weight:bold; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; width:70; height:20" value="<?php echo number_format($oRst_STPD['SUMA_ABONOS'],2,'.',',');?>" readonly></font></td>
	</tr>
</table>
<?php
	}else{
?>
	<p align="center"><b><font color="#F73A4A" face="Verdana" size="2" align="center" >NO HAY DETALLES DE ESTA P�LIZA</font></b></p>
<?php
	}
?>

<?php
}else{
?>
	<p align="center"><b><font color="#F73A4A" face="Verdana" size="2" align="center" >NO HAY DATOS DE ESTA P�LIZA, O ES UNA P�LIZA DE OTRA OFICINA</font></b></p>
<?php
}
?>
	</body>
</html>

<?php mysqli_close($db); ?>

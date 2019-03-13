<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$cuenta = trim($_GET['cuenta']);
require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosGenerales.php';
require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosPOCME.php'; # $datosPOCMEImprimir
require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosAnticipos.php'; # $datosANTICIPOImprimir


	#FECHA DE VENCIMIENTO DE LA FACTURA
	if (!is_null($d_fechaVencimiento)){
		$vencimiento = "<table width='AUTO' border='0' cellspacing='0' cellpadding='0' align='right' style='font-family:Trebuchet MS;font-size:10pt;font-weight:bold;border: 1px solid #000000;'>
			  <tr>
				<td align='center' bgcolor='#E62726' style='color:#FFFFFF;'>FECHA DE VENCIMIENTO</td>
			  </tr>
			  <tr>
				<td align='center'>".date_format(date_create($d_fechaVencimiento),"Y-m-d")."</td>
			  </tr>
</table>";
	}else{ $vencimiento = ""; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimir Cuenta Americana</title>
</head>
<style type="text/css">
	@page {
		size: auto;
  		margin-top: 1cm;
		margin-bottom: 1cm;
		margin-left: 1.5cm;
		margin-right: 1.5cm;
	}

</style>
<body>
<br>
<table width="auto" border="0" cellpadding="0" cellspacing="0" align="center" style="font-family:Trebuchet MS; font-size: 16pt;">
  <tr>
    <td align="center"><i><b><font face="Swis721 Hv BT" size="6">IM International Freight Forwarder, Corp.</font></b></i></td>
  </tr>
  <tr>
    <td align="center"><i>9000 San Mateo Dr.</i></td>
  </tr>
  <tr>
    <td align="center"><i>Tejas Industrial Park</i></td>
  </tr>
  <tr>
    <td align="center"><i>78045 Laredo, TX.</i></td>
  </tr>
  <tr>
    <td align="center">Phone (956) 791-4646 to 48 Fax (956) 791-4649</td>
  </tr>
</table>
<br>
<?php echo $vencimiento; ?>
<br><br>
<table width="100%" border="0" align="center" style="font-family:Swis721 Th BT; font-size: 12pt;">
  <tr>
    <td width="60%">
		<table width="100%" border="0" cellspacing="0" style="border-collapse:collapse; border: 1px solid #333333;">
			<tr style="color:#FFFFFF">
				<td bgcolor="#808080" align="center">TO</td>
			</tr>
			<tr>
				<td><?php echo trim($s_nombre);?></td>
			</tr>
			<tr>
				<td><?php echo trim($s_calle);?> <?php echo trim($s_no_ext);?> <?php echo trim($s_no_int);?></td>
			</tr>
			<tr>
				<td><?php echo trim($s_colonia);?></td>
			</tr>
			<tr>
				<td><?php echo trim($s_codigo);?> <?php echo trim($s_ciudad);?> <?php echo trim($s_estado);?></td>
			</tr>
			<tr>
				<td><?php echo trim($s_rfc);?></td>
			</tr>
		</table>
		<br><br>
		<table width="100%" border="0" cellspacing="0" style="border-collapse:collapse; border: 1px solid #333333;">
			<tr align="center" bgcolor="#808080" style="color:#FFFFFF">
				<td>Quantity</td>
				<td>Weight</td>
				<td>Type</td>
			</tr>
			<tr align="center">
				<td><?php echo trim($n_bodegaIn);?></td>
				<td><?php echo number_format($n_peso,2,'.',',');?></td>
				<td><?php echo trim($s_tipoRegimen);?></td>
			</tr>
			<tr align="center" bgcolor="#808080" style="color:#FFFFFF">
				<td width="100%" colspan="3">Description</td>
			</tr>
			<tr>
				<td width="100%" colspan="3"><?php echo trim($s_descripcion);?></td>
			</tr>
			<tr align="center" bgcolor="#808080" style="color:#FFFFFF">
				<td>Amount</td>
				<td>Freight Bill</td>
				<td>Vendor ID</td>
			</tr>
			<tr align="center">
				<td><?php echo number_format($n_valor_usd,2,'.',',');?></td>
				<td><?php echo trim($s_guia_master);?></td>
				<td><?php echo trim($fk_id_proveedor);?></td>
			</tr>
		</table>
		<br><br>
		<table width="100%" border="0" cellspacing="0" style="border-collapse:collapse; border: 1px solid #333333;">
			<tr>
				<td bgcolor="#808080" align="center" style="color:#FFFFFF"><?php if( $s_imp_exp == 'IMP' ){ echo "Vendor"; }else{ echo "CONSIGNEE"; } ?></td>
			</tr>
			<tr>
				<td><?php echo trim($s_prov_nombre);?></td>
			</tr>
			<tr>
				<td><?php echo trim($s_prov_calle);?></td>
			</tr>
			<tr>
				<td>Tel: <?php echo trim($s_prov_telefono);?></td>
			</tr>
			<tr>
				<td>Fax: <?php echo trim($s_prov_fax);?></td>
			</tr>
		</table>
		<br>
		<br>
		<table width="100%" border="0" cellspacing="0" style="border-collapse:collapse; border: 1px solid #333333; font-size: 10pt;">
			<tr>
				<td align="justify">If you are the importer of record, payment to the broker will not relieve you of Customs charges (duties, taxes or other debts owed Customs) in the event the charges are not paid by the broker. Therefore, if you pay by check, Customs charges may be paid with a separate check payable to the &quot;U.S. Customs Service&quot; which shall be delivered to Customs by the broker.</font></td>
			</tr>
		</table>
	</td>
    <td valign="top" width="40%">
		<table width="33%" border="0" cellspacing="0" style="border-collapse:collapse; border: 1px solid #333333;" align="right">
			<tr>
				<td bgcolor="#808080" align="center" style="color:#FFFFFF">REFERENCE</td>
			</tr>
			<tr>
				<td align="center"><?php echo trim($fk_referencia);?></td>
			</tr>
		</table>
		<br><br><br><br>
		<table width="100%" border="0" cellspacing="0" style="border-collapse:collapse; border: 1px solid #333333;">
			<tr bgcolor="#808080" align="center" style="color:#FFFFFF">
				<td>Invoice No.</td>
				<td>Date</td>
				<td>Customer Invoice</td>
			</tr>
			<tr align="center">
				<td><?php echo trim($pk_id_ctaAme);?></td>
				<td><?php echo date_format(date_create($d_fecha),"d/m/Y");?></td>
				<td><?php echo trim($s_customerOrder);?></td>
			</tr>
		</table>
		<br><br>
		<table width="100%" border="0" cellspacing="0" style="border-collapse:collapse; border: 1px solid #333333;">
			<tr bgcolor="#808080" align="center" style="color:#FFFFFF">
				<td width="80%">Decription of charges</td>
				<td width="20%">Amount</td>
			</tr>
			<?php echo $datosPOCMEImprimir; ?>
		</table>
		<br>
		<table width="100%" border="0" cellspacing="0" style="border-collapse:collapse; border: 1px solid #333333;">
			<tr style="border-left-width:1px; border-right-width:1px; border-top-width:1px; border-bottom-style:solid; border-bottom-width:1px; border-bottom-color:#7F7F7F">
				<td width="80%">Sub-total</td>
				<td width="20%" align="right"><?php echo number_format($n_subtotal,2,'.',',');?></td>
			</tr>
			<?php echo $datosANTICIPOImprimir; ?>
		</table>
		<br>
		<table width="100%" border="0" cellspacing="0" style="border-collapse:collapse; border: 1px solid #333333;">
			<tr>
				<td width="80%"><b>Please pay this amount ---&gt;</b></td>
				<td width="20%" align="right"><?php echo number_format($n_total,2,'.',',');?></td>
			</tr>
		</table>
		<br>
		<br>
		<table width="100%" border="0" cellspacing="0" style="border-collapse:collapse; border: 1px solid #333333; font-size: 10pt;">
			<tr>
				<td align="justify">IMPORTER MUST FURNISH MISSING DOCUMENTS WITHIN THE PERIOD OF TIME AS REQUIRED BY CUSTOMS REGULATIONS TO AVOID CUSTOM PENALTIES.</td>
			</tr>
		</table>


  </tr>
</table>

<?php
		#******************************
		#* HISTORIAL                  *
		#******************************
		$descripcion = "Se imprimio cuenta: $cuenta ";

		$clave = 'ctaAme_fac';
		$folio = $cuenta;
		require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';
?>

</body>
</html>

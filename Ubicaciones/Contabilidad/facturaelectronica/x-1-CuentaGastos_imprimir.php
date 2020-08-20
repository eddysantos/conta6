<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<!-- <html xmlns="http://www.w3.org/1999/xhtml"> -->
<!-- <head> -->
<!-- <title>Documento sin t&iacute;tulo</title> -->
<!-- <SCRIPT type="text/javascript">
function Imprime(){
}
</SCRIPT> -->
<?php
  // $root = $_SERVER['DOCUMENT_ROOT'];
  // require $root . '/Ubicaciones/barradenavegacion.php';
  //
  // $cuenta = trim($_GET['cuenta']);
  // $txt_id_asoc = 'No';
  //
  // require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosGenerales.php';
  // require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosEmbarque.php'; #$datosEmbarque
  // require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosPOCME.php'; # $datosPOCME
  // require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosCargos.php'; #$datosCargos
  // require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosHonorarios.php'; #$datosHonorarios
  // require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosDepositos.php'; #$datosDepositos


?>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body onload="Imprime()" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="1" marginwidth="1" marginheight="1">
<table width="100%" border="0">
  <tr>
    <td rowspan="3" width="auto"><img src="../../../imagenes/Logo.jpg" width="137" height="121" /></td>
    <td>&nbsp;</td>
    <td rowspan="3" width="auto">
		<table border="0" width="auto" style="font-family: Trebuchet MS; font-size: 7.2pt" cellspacing="0" cellpadding="0" align="right" >
			<tr>
				<td align="justify">Proyección Logistica Agencia</td>
			</tr>
			<tr>
				<td  align='justify'>A d u a n a l&nbsp;&nbsp; S. A.&nbsp; de &nbsp;C. V.</td>
			</tr>
			<tr>
				<td>Calle&nbsp; Fundidora&nbsp;&nbsp; Monterrey</td>
			</tr>
			<tr>
				<td>N o .&nbsp; 6 2&nbsp;&nbsp; P l a n t a&nbsp;&nbsp; A l t a</td>
			</tr>
			<tr>
				<td>Col.&nbsp;&nbsp; Peñon&nbsp; de&nbsp;&nbsp; los&nbsp;&nbsp;&nbsp;Baños </td>
			</tr>
			<tr>
				<td>C o d i g o&nbsp;&nbsp; P o s t a l.&nbsp;15520</td>
			</tr>
			<tr>
				<td>V e n u s t i a n o&nbsp;&nbsp;&nbsp; Carranza</td>
			</tr>
			<tr>
				<td>D i s t r i t o&nbsp;&nbsp;&nbsp;&nbsp; F e d e r e a l</td>
			</tr>
			<tr>
				<td>R.F.C. P L A 0 9 0 6 0 9 N 2 1</td>
			</tr>
</table>
	</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><b><font face="Trebuchet MS" size="4">CUENTA DE GASTOS</font></b></td>
  </tr>
</table>
<table width="100%">
  <tr>
	<td valign="top"> -->
<!-- ******************** CLIENTE *****************-->
		<!-- <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family: Trebuchet MS; font-size:6pt; border: 1px solid #000000;">
			  <tr>
				<td align="center" bgcolor="#7F7F7F" style="color:#FFFFFF;">CLIENTE</td>
	      </tr>
			  <tr>
			  	<td><?php echo $s_nombre;?></td>
	      </tr>
			  <tr>
				<td><?PHP echo $s_calle.' '.$s_no_ext.' '.$s_no_int; ?></td>
			  </tr>
			  <tr>
				<td colspan="2"><?php echo $s_colonia;?></td>
			  </tr>
			  <tr>
				<td colspan="2"><?php echo $s_codigo.' '.$s_ciudad.', '.$s_estado;?></td>
			  </tr>
			  <tr>
				<td align="right">R.F.C. <?php echo $s_rfc;?></td>
			  </tr>
	  </table>
		<br> -->
<!--************************ PROVEEDOR ***************** -->
			<!-- <table width="100%" border="0" cellspacing="0" style="border-collapse:collapse; font-family: Trebuchet MS; font-size:6pt; border: 1px solid #000000;" >
			  <tr align="center">
				<td colspan="3" bgcolor="#7F7F7F" style="color:#FFFFFF">PROVEEDOR (IMP) O DESTINATARIO (EXP)</td>
			  </tr>
			  <tr>
				<td colspan="3"><?PHP echo $s_proveedor_destinatario; ?></td>
			  </tr>
			</table>

			<br> -->
<!-- ********************** PAGOS EN MONEDA EXTRANJERA ***************** -->
			<!-- <table border="0" width="100%" id="table111" cellspacing="1" cellpadding="0" style="border-collapse:collapse; font-family: Trebuchet MS; font-size:6pt;  border: 1px solid #000000;">
				<tr>
					<td colspan="2" bgcolor="#808080" align="center" style="color:#FFFFFF;">PAGOS O CARGOS EN MONEDA EXTRANJERA</td>
				</tr>
				<?php echo $datosPOCME; ?>
			</table>

	</td>
    <td valign="top"> -->
<!--****************** FOLIO DE LA FACTURA ********************* -->
				<!-- <table width="100%" border="0" cellspacing="0" style="border-collapse: collapse;  font-family: Trebuchet MS; font-size:6pt; border: 1px solid #000000;">
				  <tr style="color:#FFFFFF" bgcolor="#808080" align="center">
					<td>CUENTA DE GASTOS </td>
					<td>&nbsp;</td>
				  </tr>
				  <tr align="center">
					<td><?php echo $pk_id_cuenta_captura;?></td>
					<td>&nbsp;</td>
				  </tr>
				  <tr style="color:#FFFFFF" bgcolor="#808080" align="center">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr align="center">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
			</table> -->

<!--******************* DATOS REFERENCIA ******************* -->
				<!-- <table border='0' width='100%' id='table81' cellspacing='0' style='border-collapse: collapse;  font-family: Trebuchet MS; font-size:6pt; border: 1px solid #000000;'>
					<tr>
						<td align='center' bgcolor='#C0C0C0' style='color:#000000;'>INFORMACI&Oacute;N GENERAL DEL EMBARQUE</td>
					</tr>
					<tr>
						<td>
							<table border='0' width='100%' cellspacing='0' style='border-collapse: collapse;  font-family: Trebuchet MS; font-size:6pt;'>
								<?php echo $datosEmbarque; ?>
							</table>
						</td>
					</tr>
				</table>

						</td>
					</tr>
				</table> -->


<!-- ******************** TIPO DE CAMBIO ***************-->
				<!-- <table width="100%" border="0" style="border-collapse:collapse; font-family: Trebuchet MS; font-size:6pt;  border: 1px solid #000000;" >
					<tr style="color:#FFFFFF;">
						<td bgcolor="#808080" align="center" width="33%">TOTAL</td>
						<td bgcolor="#808080" align="center" width="33%">AL TIPO DE CAMBIO</td>
						<td bgcolor="#808080" align="center" width="34%">TOTAL MN.</td>
					</tr>
					<tr>
						<td align="center" width="33%"><?php echo number_format($n_POCME_total_gral,2,'.',','); ?></td>
						<td align="center" width="33%"><?php echo $n_POCME_tipo_cambio ?></td>
						<td align="center" width="34%"><?php echo number_format($n_POCME_total_MN,2,'.',','); ?></td>
					</tr>
				</table>
	</td>
  </tr>
</table>


<table border="0" width="100%" style="font-family: Trebuchet MS; font-size:6pt; border: 1px solid #000000;" cellspacing="0">
		<tr align="center" bgcolor="#808080" style="color:#FFFFFF">
		  <td width="10%">&nbsp;</td>
			<td width="65%">PAGOS REALIZADOS POR SU CUENTA</td>
			<td width="15%">SUBTOTAL</td>
		    <td width="10%">&nbsp;</td>
		</tr>
		<?php echo $datosCargos; ?>
</table> -->



<!-- COBRO DE HONORARIOS -->
<!-- <table border="0" width="100%" style="font-family: Trebuchet MS; font-size:6pt; border: 1px solid #000000;" cellspacing="0">
		<tr bgcolor="#808080" style="color:#FFFFFF" align="center">
		  <td width="10%">&nbsp;</td>
			<td width="65%">HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR</td>
			<td width="15%">IMPORTE</td>
			<td width="10%">&nbsp;</td>
		</tr>
		<?php echo $datosHonorariosPrint; ?>
</table>

	<table border="0" width="100%" style="font-family: Trebuchet MS; font-size:6pt;" cellspacing="0">
		<tr>
			<td width="45%">&nbsp;</td>
			<td width="30%"><?php echo $s_txt_gral_importe; ?></td>
			<td width="15%" align="right"><?php echo number_format($n_total_gral_importe,2,'.',',');?></td>
		    <td width="10%" align="right">&nbsp;</td>
		</tr>
		  <tr>
			<td style="color:#FF0000">&nbsp;</td>
			<td><?php echo $n_txt_gral_IVA;?></td>
			<td align="right"><?php echo number_format($n_total_gral_IVA,2,'.',',');?></td>
		    <td align="right">&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><?php echo $s_txt_total_honorarios;?></td>
			<td align="right"><?php echo number_format($n_total_honorarios,2,'.',',');?></td>
		    <td align="right">&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><?php echo $s_txt_fac_IVA_retenido;?></td>
			<td align="right"><?php echo number_format($s_fac_IVA_retenido,2,'.',',');?></td>
		    <td align="right">&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><?php echo $s_txt_total_gral;?></td>
			<td align="right"><?php echo number_format($n_total_gral,2,'.',',');?></td>
		    <td align="right">&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><?php echo $s_POCME_descripcion_gral;?></td>
			<td align="right"><?php echo number_format($n_total_POCME,2,'.',',');?></td>
		    <td align="right">&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><?php echo $s_txt_total_pagos;?></td>
			<td align="right"><?php echo number_format($n_total_pagos,2,'.',',');?></td>
		    <td align="right">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="right">&nbsp;</td>
			<td bgcolor="#7F7F7F" style="color:#FFFFFF"><?php echo $s_txt_cta_gastos;?></td>
			<td align="right"><?php echo number_format($n_total_cta_gastos,2,'.',',');?></td>
		    <td align="right">&nbsp;</td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="3"><?php echo trim($s_total_cta_gastos_letra);?></td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><?php echo $s_txt_total_depositos;;?></td>
			<td align="right"><?php echo number_format($n_total_depositos,2,'.',',');?></td>
		    <td align="right">&nbsp;</td>
		  </tr>
		  <tr>
			<td></td>
			<td>
				<table width="auto" border="0" style="font-family: Trebuchet MS; font-size:6pt;" cellspacing="0">
				  <tr align="center" bgcolor="#C0C0C0">
					<td>Depósito</td>
					<td>Importe</td>
				  </tr>
				  <?php echo $datosDepositos; ?>
				</table>

			</td>
			<td></td>
		    <td></td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td bgcolor="#7F7F7F" style="color:#FFFFFF"><b><?php echo $s_txt_fac_saldo; ?></b></td>
			<td align="right"><?php echo trim(number_format($n_fac_saldo,2,'.',','));?></td>
		    <td>&nbsp;</td>
		  </tr>
</table>




</body>
</html> -->

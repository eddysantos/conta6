<?php


/*
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Resources/PHP/Utilities/initialScript.php';

  $cuenta = trim($_GET['cuenta']);

  #modificar segun ruta
  $fileQR = '../../../../CFDI_generados/2018/CLT_7345/QR/N13003039_9_factura.png';
*/
  require $root . '/Resources/PHP/actions/consultaDatosCIA.php';

  $d_fechavencimiento = '';
  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarFactura.php';
  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosGenerales.php';
  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosEmbarque.php'; #$datosEmbarque
  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosPOCME.php'; # $datosPOCME
  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosCargos.php'; #$datosCargos
  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosHonorarios.php'; #$datosHonorarios
  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosDepositos.php'; #$datosDepositos

  $id_cliente = $fk_id_cliente;
  require $root . '/Resources/PHP/actions/consultaDatosCliente_formaPago.php';#$formaPago
	if( $rows_datosCLTformaPago > 0 ){

	   while(  $row_datosCLTformaPago = $rslt_datosCLTformaPago->fetch_assoc() ){
	   		$fk_id_formaPago = $row_datosCLTformaPago['fk_id_formapago'];
			$s_concepto = $row_datosCLTformaPago['s_concepto'];

			if( $formaPago == $fk_id_formaPago ){
				$txt_formaPago = $fk_id_formaPago.' '.$s_concepto;
			}
	   }
	}

  require $root . '/Resources/PHP/actions/consultaUsoCFDI_facturar.php';
  $id_captura = $cuenta;
  require $root . '/Resources/PHP/actions/consultaFactura_ctaGastos.php';


  if( $fk_c_MetodoPago == 'PUE' ){ $descMetodoPago = 'PUE  Pago en una sola exhibici&oacute;n'; }
  if( $fk_c_MetodoPago == 'PPD' ){ $descMetodoPago = 'PPD  Pago en parcialidades o diferido'; }
  $regimen = "601 General de Ley Personas Morales";
  $cadenaSAT = "||".$s_timbradoVersion."|".$s_UUID."|".$d_fechaTimbrado."|".$s_selloCFDI."|".$s_id_certificadoSAT."||";

#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$observacionesPLAA = "Observaciones: La empresa así como sus representantes o corresponsales en el país o en el extranjero, consideran en cada operación que las mercancías se encuentran aseguradas desde la puerta del domicilio de los embarcadores hasta el destino final, con motivo de la importación o de la exportación; razón por la cual no tomara responsabilidad alguna por perdidas, mermas, daños, robo o averías de cualquier índole parciales o totales, excepto en los casos en que los consignatarios en importación o los remitentes en exportación manifiesten en cada ocasión por escrito y previo al arribo de las mercancías a los almacenes de reexpedición o de despacho que desean asegurar sus embarques.";

	$html = "
	<table width='100%' border='0' style='font-family:Trebuchet MS'>
	  <tr>
		<td rowspan='4' width='auto'><img src='Logo.jpg' width='117pt' height='101pt' /></td>
		<td width='auto'>&nbsp;</td>
		<td width='auto'>&nbsp;</td>
	  </tr>
	  <tr>
	    <td align='center'><b><font size='4'>FACTURA ELECTR&Oacute;NICA</font></b></td>
	    <td rowspan='2' valign='top'>".$d_fechaVencimiento."</td>
  	  </tr>
	  <tr>
		<td align='center'>&nbsp;</td>
      </tr>
	  <tr>
		<td>&nbsp;</td>
	    <td align='right'><font size='2'>R.F.C. ".$rfcCIA."</font></td>
	  </tr>
	</table>
	<table width='100%'>
	  <tr>
		<td valign='top' width='50%'>
			<!-- ******************** CLIENTE *****************-->
			<table width='100%' border='0' cellpadding='0' cellspacing='0' style='font-family: Trebuchet MS; font-size:8.1pt; border: 1px solid #000000;'>
				<tr>
					<td align='center' bgcolor='#E62726' style='color:#FFFFFF;font-weight:bold;'>CLIENTE</td>
	      		</tr>
			  	<tr>
			  		<td>".$s_nombre."</td>
	      		</tr>
			  	<tr>
					<td>".$s_calle.' '.$s_no_ext.' '.$s_no_int."</td>
			  	</tr>
			  	<tr>
					<td>".$s_colonia."</td>
			  	</tr>
			  	<tr>
					<td>".$s_codigo.' '.$s_ciudad.', '.$s_estado."</td>
			  	</tr>
			 	<tr>
					<td align='right'>R.F.C. ".$s_rfc."</td>
			  	</tr>
	  		</table>
		</td>
		<td valign='top' width='50%'>
			<!--****************** FOLIO DE LA FACTURA ********************* -->
			<table width='100%' border='0' cellspacing='0' style='border-collapse: collapse;  font-family: Trebuchet MS; font-size:8.1pt; border: 1px solid #000000;'>
				  <tr style='color:#FFFFFF;font-weight:bold;' bgcolor='#E62726' align='center'>
					<td>FACTURA</td>
					<td>NO. CERTIFICADO </td>
					<td>LUGAR Y FECHA</td>
				  </tr>
				  <tr align='center'>
					<td style='font-size:11pt;'><b>".$pk_id_factura."</b></td>
					<td>".$fk_id_certificado."</td>
					<td><font style='font-size:7pt'>".$s_lugarExpedicion_txt."</font><br/>".$d_fechaTimbrado."</td>
				  </tr>
			</table>
		</td>
	  </tr>
	</table>
	<br style='font-family: Trebuchet MS; font-size:1pt;'>

	<!-- ******************** HONORARIOS ********************-->
	<table border='0' width='100%' style='font-family: Trebuchet MS; font-size:8.1pt; border: 1px solid #000000;' cellspacing='0'>
			<tr bgcolor='#E62726' style='color:#FFFFFF;font-weight:bold;' align='center'>
			  	<td width='10%'>CANTIDAD</td>
				<td width='10%'>UNIDAD</td>
				<td width='10%'>ProdServ</td>
				<td width='50%'>HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR</td>
				<td width='20%' align='right'>IMPORTE</td>
			</tr>".$datosHonorariosXML."
	</table>
	<table border='0' width='100%' style='font-family: Trebuchet MS; font-size:8.1pt;' cellspacing='0'>
	  <tr>
			<td width='45%'><b>M&eacute;todo de pago:</b> ".$descMetodoPago."</td>
			<td width='30%'>".$s_txt_gral_importe."</td>
			<td width='25%' align='right'>".number_format($n_total_gral_importe,2,'.',',')."</td>
	  </tr>
	  <tr>
		<td><b>Forma de pago:</b> ".$txt_formaPago."</td>
		<td>".$n_txt_gral_IVA."</td>
		<td align='right'>".number_format($n_total_gral_IVA,2,'.',',')."</td>
	  </tr>
	  <tr>
	  	<td><b>R&eacute;gimen Fiscal:</b> ".$regimen."</td>
		<td>".$s_txt_total_honorarios."</td>
		<td align='right'>".number_format($n_total_honorarios,2,'.',',')."</td>
	  </tr>
	  <tr>
	  	<td><b>Uso de CFDI:</b> ".$txt_UsoCFDI."</td>
		<td>".$s_txt_fac_IVA_retenido."</td>
		<td align='right'>".number_format($s_fac_IVA_retenido,2,'.',',')."</td>
	  </tr>
	  <tr>
	  	<td valign='middle'>&nbsp;</td>
		<td>".$s_txt_total_gral."</td>
		<td align='right'>".number_format($n_total_gral,2,'.',',')."</td>
	  </tr>
	</table>
	<br style='font-family: Trebuchet MS; font-size:2pt;'>
	<table width='100%' border='0' cellspacing='0' style='font-family: Trebuchet MS; font-size:6pt;'>
	  <tr bgcolor='#E62726' style='color:#FFFFFF;font-weight:bold;' align='center'>
	  	<td colspan='2'>DATOS DE TIMBRADO VERSIÓN ".$s_CFDversion."</td>
	  </tr>
	  <tr>
	    <td valign='top' width='20%'><b>Folio Fiscal</b>
			<br>".$s_UUID."
			<br><b>Certificado Digital SAT</b> ".$s_id_certificadoSAT."
			<br><b>Fecha de Certificación</b> ".$d_fechaTimbrado."
			<br><img src='".$fileQR."' border='0'/>
		</td>
		    <td valign='top' width='80%' style='font-size:6pt;'><b>Cadena Original del Complemento de Certificación Digital del SAT</b>
			<br>".wordwrap($cadenaSAT, 150,'<br>',1)."
			<br><br><b>Sello Digital</b>
			<br>".wordwrap($s_selloCFDI, 150,'<br>',1)."
			<br><br><b>Sello Digital SAT</b>
			<br>".wordwrap($s_selloSAT, 150,'<br>',1)."
			<br><br><font color='#FF0000' style='font-size:7pt'><b>Este documento es una representaci&oacute;n impresa de un CFDI</b></font>
			<br>".wordwrap($observacionesPLAA, 200,'<br>',1)."
		</td>
	</table>
	<br style='font-family: Trebuchet MS; font-size:2pt;'>
	<table width='100%' style='font-family: Trebuchet MS; font-size:8.1pt; color:#FF0000'>
	  <tr align='center'>
		<td>Esta secci&oacute;n es &uacute;nicamente informativa sin validez oficial.<img src='lineaPunteada.jpg' /><img src='lineaPunteada2.jpg' /></td>
	  </tr>
	</table>
	<table width='100%'>
	  <tr>
		<td valign='top' width='50%'>
				<!--************************ PROVEEDOR ***************** -->
				<table width='100%' border='0' cellspacing='0' style='border-collapse:collapse; font-family: Trebuchet MS; font-size:7.1pt; border: 1px solid #000000;' >
				  <tr align='center'>
					<td colspan='3' bgcolor='#C0C0C0' style='color:#000000;'>PROVEEDOR (IMP) O DESTINATARIO (EXP)</td>
				  </tr>
				  <tr>
					<td colspan='3'>".preg_replace('/&/', '&amp;', preg_replace('/´/', '', utf8_encode($s_proveedor_destinatario) ))."</td>
				  </tr>
				</table>
				<br style='font-family: Trebuchet MS; font-size:1pt;'>
				<!-- ********************** PAGOS EN MONEDA EXTRANJERA ***************** -->
				<table border='0' width='100%' cellspacing='0' style='border-collapse:collapse; font-family: Trebuchet MS; font-size:7.1pt;  border: 1px solid #000000;'>
					<tr>
						<td colspan='2' align='center' bgcolor='#C0C0C0' style='color:#000000;'>PAGOS O CARGOS EN MONEDA EXTRANJERA</td>
					</tr>".$datosPOCME."
				</table>
				<br style='font-family: Trebuchet MS; font-size:1pt;'>
				<!-- ******************** TIPO DE CAMBIO ***************-->
				<table width='100%' border='0' style='border-collapse:collapse; font-family: Trebuchet MS; font-size:7.1pt;  border: 1px solid #000000;' >
					<tr bgcolor='#C0C0C0' style='color:#000000;' align='center' >
						<td width='33%'>TOTAL</td>
						<td width='33%'>AL TIPO DE CAMBIO</td>
						<td width='34%'>TOTAL MN.</td>
					</tr>
					<tr align='center'>
						<td width='33%'>".number_format($n_POCME_total_gral,2,'.','')."</td>
						<td width='33%'>".number_format($n_POCME_tipo_cambio,2,'.','')."</td>
						<td width='34%'>".number_format($n_POCME_total_MN,2,'.','')."</td>
					</tr>
				</table>
		</td>
		<td valign='top' width='50%'>
				<!--******************* DATOS REFERENCIA ******************* -->
				<table border='0' width='100%' id='table81' cellspacing='0' style='border-collapse: collapse;  font-family: Trebuchet MS; font-size:7.1pt; border: 1px solid #000000;'>
					<tr>
						<td align='center' bgcolor='#C0C0C0' style='color:#000000;'>INFORMACI&Oacute;N GENERAL DEL EMBARQUE</td>
					</tr>
					<tr>
						<td>
							<table border='0' width='auto' cellspacing='0' style='border-collapse: collapse;  font-family: Trebuchet MS; font-size:7.1pt;' align='center'>
							".$impresionDatosEmbarque."</table>
						</td>
					</tr>
				</table>
		</td>
	  </tr>
	</table>
	<!-- ****************** PAGOS DEL CLIENTE ***************-->
	<table border='0' width='100%' style='font-family: Trebuchet MS; font-size:7.1pt; border: 1px solid #000000;' cellspacing='0'>
			<tr align='center' bgcolor='#C0C0C0' style='color:#000000;'>
				<td width='45%'>PAGOS REALIZADOS POR SU CUENTA</td>
				<td width='10%'>&nbsp;</td>
				<td width='10%'>&nbsp;</td>
				<td width='10%'>&nbsp;</td>
				<td width='10%'>&nbsp;</td>
				<td width='15%' align='right'>SUBTOTAL</td>
			</tr>".$datosCargos."
	</table>
	<table border='0' width='100%' style='font-family: Trebuchet MS; font-size:7.1pt;' cellspacing='0'>
	  <tr>
	  	<td valign='middle' align='center'><b>FOLIO DE CUENTA DE GASTOS:".$id_ctagastos."</b></td>
		<td>Total Factura </td>
		<td align='right'>".number_format($n_total_gral,2,'.',',')."</td>
	  </tr>
	  <tr>
	    <td valign='middle'>".$datosDepositos."</td>
	  	<td>".$s_POCME_descripcion_gral."</td>
		<td align='right'>".number_format($n_total_POCME,2,'.',',')."</td>
	  </tr>
	  <tr>
	    <td valign='middle'>&nbsp;</td>
	  	<td>".$s_txt_total_pagos."</td>
		<td align='right'>".number_format($n_total_pagos,2,'.',',')."</td>
	  </tr>
	  <tr>
	    <td valign='middle'>&nbsp;</td>
	  	<td bgcolor='#C0C0C0' style='color:#000000;'>".$s_txt_cta_gastos."</td>
		<td align='right'>".number_format($n_total_cta_gastos,2,'.',',')."</td>
	  </tr>
	  <tr>
	    <td valign='middle'>&nbsp;</td>
	  	<td colspan='3'>".$s_total_cta_gastos_letra."</td>
	  </tr>
	  <tr>
	    <td valign='middle'>&nbsp;</td>
		<td>".$s_txt_total_depositos."</td>
		<td align='right'>".number_format($n_total_depositos,2,'.',',')."</td>
	  </tr>
	  <tr>
	    <td valign='middle'>&nbsp;</td>
		<td bgcolor='#C0C0C0' style='color:#000000;'><b>Saldo</b></td>
		<td align='right'>".number_format($n_fac_saldo,2,'.',',')."</td>
	  </tr>
	</table>";


	#$rutaRepFileHTML , $rutaRepFilePDF


	$fpdf = fopen($rutaRepFileHTML, 'w');
			fwrite($fpdf, $html);
			chmod($rutaRepFileHTML,0775);
			fclose($fpdf);

	if (file_exists($rutaRepFileHTML)){
		$respGuardarDatos .= "✓ Formato Impreso generado correctamente\n";
	}else{
	   	$respGuardarDatos .= "X No se genero formato impreso\n";
	}

?>

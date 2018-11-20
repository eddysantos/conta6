<?php
/*
#http://localhost:88/conta6/Resources/PHP/actions/acuse_cancelacion_CFDI.php
$edoCancelacion = 'Cancelacion sin aceptación';
$s_rfcR = 'IAF830713UD1';
$fecha = '2018-01-31T13:58:02';
$RFC = 'PLA090609N21';
$UUID = '846C00DC-85C1-48F4-B6FA-D2DDABDF86C5';
$status = 201;
$sello = '/SeY8BvQfSk8FVDMQJRBNSuf75CPx6XmH4L9G1m7N68azHpTg9DqqBpxsbe3d1EJoPO2/U2XsgpeOVTfCOmd7A==';
$root = $_SERVER['DOCUMENT_ROOT'];
$SHCP = $root . '/conta6/Resources/imagenes/SHCP.png';
*/

$html = "
<table width='80%' border='0' style='border-collapse:collapse; font-family: Arial; font-size:14pt;' >
			  <tr>
				<td><img src='".$SHCP."'></td>
				<td align=center><b>Servicio de Administraci&oacute;n Tributaria<br>
									Acuse de Cancelaci&oacute;n de CFDI</b></td>
			  </tr>
			</table>
			<br /><br />
			<table width='60%' border='0' style='border-collapse:collapse; font-family: Arial; font-size:10pt;'>
			  <tr>
				<td><b>Folio Fiscal:</b></td>
				<td>".$UUID."</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td><b>RFC Receptor:</b></td>
				<td>".$s_rfcR."</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td><b>RFC Emisor:</b></td>
				<td>".$RFC."</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td><b>Estado CFDI:</b></td>
				<td>Cancelado</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td><b>Estado Cancelación:</b></td>
				<td>".$edoCancelacion."</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td><b>Fecha:</b></td>
				<td>".date_format(date_create($fecha),'Y-m-d H:i:s')."</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td><b>Sello digital SAT:</b></td>
				<td>".wordwrap($sello,74,'<br>',1)."</td>
			  </tr>
			 </table>";

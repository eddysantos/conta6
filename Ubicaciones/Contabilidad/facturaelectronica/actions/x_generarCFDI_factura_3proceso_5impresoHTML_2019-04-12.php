<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';


//$cuenta = trim($_GET['cuenta']);

require $root . '/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_datosGenerales.php';
require $root . '/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_detalle.php'; # $pagosDetallePrint

$mostrarSustituir = false;
if( is_null($s_UUIDpagoSustituir) ){
	$fk_c_TipoRelacion = '';
	$n_folioPagoSustituir = '';
	$s_UUIDpagoSustituir = '';
	$mostrarSustituir = true;
}


	#http://localhost:88/contabilidad/pagosElectronicos/reciboPagos/elaborar_reciboPagos.php?usuario=admado&id_factura=73731&oficina=470&id_cliente=CLT_7621&id_docPago=4

	include ("../../../include/conexion.php");
	include ("../../../include/cortarDecimales_a3dig.php");

	// $cliente = trim($_GET['id_cliente']);
	// $id_factura = trim($_GET['id_factura']);
	$id_docPago = trim($_GET['id_docPago']);

	$sql_Cliente = mysqli_fetch_array(mysqli_query($link,"SELECT * from TBL_CLIENTES WHERE ID_CLIENTE = '$cliente'"));
	$oRst_Facturas = mysqli_fetch_array(mysqli_query($link,"SELECT * from TBL_FACTURAS_CFD WHERE id_factura = '$id_factura'"));
	$sql_formaPago = mysqli_query($link,"SELECT * FROM tbl_metpago_sat WHERE ACTIVO ='S';");
	$sql_moneda = mysqli_query($link,"select * from TBL_MONEDAS_SAT where activo = 'S' order by moneda");
	$sql_moneda2 = mysqli_query($link,"select * from TBL_MONEDAS_SAT where activo = 'S' order by moneda");
	$sql_bancosCIA = mysqli_query($link,"SELECT B.NOMBRE AS nomBanco,A.ID_BANCO,A.CTAORI,A.ID_ADUANA,A.NOMBRE,A.RFC,B.NOMBRE
										FROM TBL_BANCOS_CIA A, TBL_BANCOS_SAT B
										WHERE A.ID_BANCO = B.ID_BANCO ORDER BY A.NOMBRE");

	$oRst_Pago = mysqli_fetch_array(mysqli_query($link,"SELECT * from tbl_pagos_cfdi WHERE id_docPago = $id_docPago"));
	$sql_pagoDetalle = mysqli_query($link,"select * from TBL_PAGOS_CFDI_detalle where id_docPago = $id_docPago");
	$total_pagoDetalle = mysqli_num_rows($sql_pagoDetalle);

	$oRst_TotalPagoDet = mysqli_fetch_array(mysqli_query($link,"SELECT truncate(sum(importe),2) as totalPagado FROM cplaa.tbl_pagos_cfdi_detalle where id_docPago = $id_docPago"));

	$tabindex=0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Elaborar Recibo de Pagos</title>
<script language="javascript" src="../../../include/CFDI/validarStringSAT.js"></script>
<script language="javascript" src="../../../include/validaSoloNumeros.js"></script>
<script language="javascript" src="../../../include/eliminaBlancoIni.js"></script>
<script language="javascript" src="../../../include/eliminaBlancoFin.js"></script>
<script language="javascript" src="../../../include/eliminaBlancosIntermedios.js"></script>
<script language="javascript" src="../../../include/cortarDecimales.js"></script>
<script language="javascript" src="../../../include/calculadora.js"></script>
<script language="javascript" src="../../../include/cambiar_color.js"></script>
<script language="javascript" src="../../../include/validaIntDec.js"></script>

<script language="javascript" src="../../../include/validaDescImporte.js"></script>
<script language="javascript" src="../../../include/borrarAntImporte.js"></script>


<script>
	usuario = '<?php echo $usuario;?>';
	oficina = <?php echo $oficina;?>;
	id_cliente = '<?php echo $cliente;?>';

	function objetoAjax(){

		var xmlhttp=false;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
			}
		}

		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
	}

	function generarCFDI(id_docPago){
		mostrarEn = "mensaje";
		pagina = "generarCFDI.php";

		//document.Proforma_1.Btn_generaCFDI.disabled = true;
		//donde se mostrara el resultado
		div_generarCFDI = document.getElementById(mostrarEn);
		div_generarCFDI.innerHTML = "<center><img src='../../../imagenes/loader.gif' align='center' /><font size=5 color=#FF0000> Generando . . .Espere...</center>";

		//instanciamos el objetoAjax
		ajax_generarCFDI=objetoAjax();

		ajax_generarCFDI.open("POST",pagina,true);

		ajax_generarCFDI.onreadystatechange=function() {
			if (ajax_generarCFDI.readyState==1) {
				div_generarCFDI.innerHTML = "<center><img src='../../../imagenes/loader.gif' align='center' /><font size=5 color=#FF0000> Generando . . .Espere...</center>";
			}else if (ajax_generarCFDI.readyState==4){
				div_generarCFDI.innerHTML = ajax_generarCFDI.responseText;
			}
		}
		ajax_generarCFDI.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax_generarCFDI.send("id_docPago="+id_docPago+"&usuario="+usuario+"&oficina="+oficina+"&id_cliente="+id_cliente)

	}
</script>
<style type="text/css">
<!--
.sombrearDesactivado {border: 0px; background-color: #DCDCDC;}
-->
</style>
</head>

<body>
<table width='100%' border='0' style='font-family:Trebuchet MS'>
  <tr>
	<td rowspan='4' width='auto'><img src='../../../imagenes/Logo.jpg' width='117pt' height='101pt' /></td>
	<td width='auto'>&nbsp;</td>
	<td width='auto'>&nbsp;</td>
  </tr>
  <tr>
	<td align='center'><b><font size='4'>RECIBO DE PAGO</font></b></td>
	<td valign='top'>&nbsp;</td>
  </tr>
  <tr>
	<td align='center'>SIN VALIDEZ OFICIAL </td>
    <td valign='top'>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td align='right'><font size='2'>R.F.C. PLA090609N21</font></td>
  </tr>
</table>
<input type="hidden"  name="T_ID_Cliente_Oculto" size="13" value="<?php echo $cliente; ?>">
<input type="hidden" name="Txt_Usuario" value="<?php echo $usuario; ?>">

<table width="100%" border="0" cellpadding="0" cellspacing="1">
    <td width="70%" valign="top">
		<!-- ******************** CLIENTE *****************-->
		<table width="100%" border="0" cellpadding="0" cellspacing="1" style="font-family: Trebuchet MS; font-size:10pt; color:#000000; border: 1px solid #000000;">
			  <tr>
				<td colspan="6" align="center" bgcolor="#C0C0C0">CLIENTE</td>
		  </tr>
			  <tr>
				<td bgcolor="#C0C0C0">Nombre:</td>
				<td colspan="5"><?php echo $s_nombre;?></td>
			  </tr>
			  <tr>
				<td bgcolor="#C0C0C0">Calle:</td>
				<td><?php echo $s_calle;?></td>
				<td bgcolor="#C0C0C0">Ext:</td>
				<td><?php echo $s_no_ext;?></td>
				<td bgcolor="#C0C0C0">Int:</td>
				<td><?php echo $s_no_int;?></td>
			  </tr>
			  <tr>
				<td bgcolor="#C0C0C0">Col.:</td>
				<td colspan="3"><?php echo $s_colonia;?></td>
				<td bgcolor="#C0C0C0">C.P.</td>
				<td><?php echo $s_codigo;?></td>
			  </tr>
			  <tr>
				<td bgcolor="#C0C0C0">Ciudad:</td>
				<td><?php echo $s_ciudad;?></td>
				<td></td>
				<td></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td bgcolor="#C0C0C0">Estado:</td>
				<td><?php echo $s_estado;?></td>
				<td></td>
				<td></td>
				<td bgcolor="#C0C0C0">R.F.C.</td>
				<td><?php echo $s_rfc;?></td>
			  </tr>
		</table>
	</td>
	<td width="30%" valign="top">
		<table width="100%" border="0" cellpadding="0" cellspacing="1" style="font-family: Trebuchet MS; font-size:10pt; color:#000000; border: 1px solid #000000;">
		  <tr align="center" bgcolor="#C0C0C0">
			<td>SOLICITUD</td>
			<td>LUGAR Y FECHA</td>
		  </tr>
		  <tr align="center">
			<td><?php echo $pk_id_pago_captura; ?></td>
			<td><?php echo $s_lugarExpedicion_txt; ?></td>
		  </tr>
		</table>
	</td>
</table>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="1" style="font-family: Trebuchet MS; font-size:10pt; border: 1px solid #000000;">
	<tr bgcolor="#C0C0C0" align="center" style="color:#000000">
		<td width="15%">Cantidad</td>
		<td width="15%">Unidad</td>
		<td width="15%">cveServProd</td>
		<td width="55%" align="center">DESCRIPCI&Oacute;N</td>
		<td width="15%">VALOR UNITARIO</td>
		<td width="15%">IMPORTE</td>
	</tr>
	<tr align="center">
		<td><?php echo $n_cantidad;?></td>
		<td><?php echo $fk_c_claveUnidad;?></td>
		<td><?php echo $fk_c_ClaveProdServ;?></td>
		<td><?php echo $s_descripcion;?></td>
		<td><?php echo $n_valor_unitario;?></td>
		<td><?php echo $n_importe;?></td>
	</tr>
</table>
<?php if( $mostrarSustituir == true ){ ?>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="1" style="font-family: Trebuchet MS; font-size:10pt; border: 1px solid #000000;">
	<tr bgcolor="#C0C0C0" align="center" style="color:#000000">
		<td width="15%">Sustituye al pago</td>
		<td width="15%">UUID</td>
		<td width="55%" align="center">Tipo Relación</td>
	</tr>
	<tr align="center">
		<td><?php echo $n_folioPagoSustituir;?></td>
		<td><?php echo $s_UUIDpagoSustituir;?></td>
		<td><?php echo $fk_c_TipoRelacion.' Sustitución de los CFDI previos';?></td>
	</tr>
</table>
<?php } ?>
<br>
<p align="center" style="font-family: Trebuchet MS; font-size:10pt; background-color:#C0C0C0">COMPLEMENTO DE RECEPCIÓN DE PAGOS</p>
<?php echo $pagosDetallePrint; ?>
<br>
<table border="0" cellspacing="1" cellpadding="0" style="font-family: Trebuchet MS; font-size:10pt; color:#000000; border: 1px;">
  <tr bgcolor="DCDCDC" align="center">
	<td>Moneda</td>
	<td>Uso de CFDI</td>
	<td>Reguimen Fiscal</td>
  </tr>
  <tr>
	<td><?php echo $fk_id_monedaPago;?></td>
	<td><?php echo $fk_c_UsoCFDI;?> Por definir</td>
	<td><?php echo $s_emisor_regimen; ?> General de Ley Personas Morales</td>
  </tr>
</table>
<br>
<table class="border">
  <thead>
    <tr bgcolor="#e00000" color="rgb(255, 255, 255)" align="center">
      <td width="100%"><b>DATOS TIMBRADO VERSIÓN '.$s_CFDversion.'</b></td>
    </tr>
  </thead>
  <tbody>
    <tr align="left">
      <td width="20%"><b>Folio Fiscal</b>
        <br>'.$s_UUID.'
        <br><b>Certificado Digital SAT</b> '.$s_id_certificadoSAT.'
        <br><b>Fecha de Certificación</b> '.$d_fechaTimbrado.'
        <br><img src="'.$rutaQRFile.'" border="0"/>
      </td>
      <td widht="80%" style="font-size:6pt;">
        <b>Cadena Original del Complemento de Certificación Digital del SAT</b>
        <br>'.wordwrap($cadenaSAT, 150,"<br>",1).'
        <br><br><b>Sello Digital</b>
        <br>'.wordwrap($s_selloCFDI, 150,"<br>",1).'
        <br><br><b>Sello Digital SAT</b>
        <br>'.wordwrap($s_selloSAT, 150,"<br>",1).'
        <br><br><font color="#FF0000" style="font-size:7pt"><b>Este documento es una representación impresa de un CFDI</b></font>
      </td>
    </tr>
  </tbody>
</table>


</body>
</html>

<?php
#http://localhost:88/Ubicaciones/contabilidad/Reportes/contabilidad/balanzaComprobacion.php?Fecha_Inicial=2018-05-23&Fecha_Final=2020-08-31

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$Fecha_Final = trim($_GET['Fecha_Final']);
$Fecha_Final = date_format(date_create($Fecha_Final),"Y/m/d H:i:s");
$Fecha_Inicial = trim($_GET['Fecha_Inicial']);
$Fecha_Inicial = date_format(date_create($Fecha_Inicial),"Y/m/d H:i:s");

$fechaActual = date("YmdHis");
mysqli_query($db,"DROP TABLE IF EXISTS TEM_balanzaComprobacion");
mysqli_query($db,"DROP TABLE IF EXISTS TEM_balanzaComprobacion_GASTOS");

$periodo = 'comprobacion';
require $root . '/Ubicaciones/Contabilidad/Reportes/actions/sp_balanza.php';

$tblGastos = 'temconta_BC_gastos_'.$fechaActual;
$tblGastos_idx = 'idx_BC_gastos_'.$fechaActual;
mysqli_query($db,"CREATE TABLE $tblGastos(
                    select fk_gastoAduana, fk_id_cuenta, SUM(n_cargo) as cargos, SUM(n_abono) as abonos
                    from conta_t_polizas_det
                    where fk_gastoAduana > 0 and fk_id_cuenta = '0168-00005' and d_fecha between '$Fecha_Inicial' and '$Fecha_Final'
                    GROUP BY fk_gastoAduana,fk_id_cuenta)");

mysqli_query($db,"ALTER TABLE $tblGastos ADD index $tblGastos_idx(fk_id_cuenta)");

$sql_EDC_Activo = mysqli_query($db,"SELECT C.pk_id_cuenta,C.s_cta_desc,B.sal_ini,B.cargos,B.abonos,B.sal_fin
                                      FROM conta_cs_cuentas_mst C
                                      INNER JOIN $tblBalanza B
                                      ON  B.fk_id_cuenta = C.pk_id_cuenta
                                      WHERE C.pk_id_cuenta like '01%'
                                      ORDER BY C.pk_id_cuenta");

	$sql_EDC_Pasivo = mysqli_query($db,"SELECT C.pk_id_cuenta,C.s_cta_desc,B.sal_ini,B.cargos,B.abonos,B.sal_fin
                                        FROM conta_cs_cuentas_mst C
                                        INNER JOIN $tblBalanza B
                                        ON  B.fk_id_cuenta = C.pk_id_cuenta
                                        WHERE C.pk_id_cuenta like '02%'
                                        ORDER BY C.pk_id_cuenta");

	$sql_EDC_Capital = mysqli_query($db,"SELECT C.pk_id_cuenta,C.s_cta_desc,B.sal_ini,B.cargos,B.abonos,B.sal_fin
                                        FROM conta_cs_cuentas_mst C
                                        INNER JOIN $tblBalanza B
                                        ON  B.fk_id_cuenta = C.pk_id_cuenta
                                        WHERE C.pk_id_cuenta like '03%'
                                        ORDER BY C.pk_id_cuenta");

	$sql_EDC_Ingresos = mysqli_query($db,"SELECT C.pk_id_cuenta,C.s_cta_desc,B.sal_ini,B.cargos,B.abonos,B.sal_fin
                                        FROM conta_cs_cuentas_mst C
                                        INNER JOIN $tblBalanza B
                                        ON  B.fk_id_cuenta = C.pk_id_cuenta
                                        WHERE C.pk_id_cuenta like '04%'
                                        ORDER BY C.pk_id_cuenta");

	$sql_EDC_Gastos = mysqli_query($db,"SELECT C.pk_id_cuenta,C.s_cta_desc,B.sal_ini,B.cargos,B.abonos,B.sal_fin
                                        FROM conta_cs_cuentas_mst C
                                        INNER JOIN $tblBalanza B
                                        ON  B.fk_id_cuenta = C.pk_id_cuenta
                                        WHERE (C.pk_id_cuenta like '05%' or C.pk_id_cuenta like '06%' or C.pk_id_cuenta like '0803%')
                                        ORDER BY C.pk_id_cuenta");

	$oRst_SUMA_EDC = mysqli_fetch_array(mysqli_query($db,"SELECT SUM(cargos) as SUMA_Cargos, SUM(abonos) as SUMA_Abonos FROM $tblBalanza"));

	$sql_SumaGastos = mysqli_query($db,"SELECT * FROM $tblGastos");
?>
  <!DOCTYPE html>
  <html lang="es">
  	<head>
  	<meta charset="ISO-8859-1">
  	<title>Balanza de Comprobacion</title>
  	</head>
  	<body>
  	<table border="0" width="100%" cellspacing="1" style="font-family: Trebuchet MS; font-size:10pt;">
  		<tr>
  			<td width="20%" colspan="2" rowspan="3" align="center"><img src="/Resources/imagenes/s_rojo.svg" style=' width: 45px;'></td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="30%" colspan="3" align="right"><b>Proyecci&oacute;n Log&iacute;stica Agencia Aduanal S.A. de C.V.</b></td>
  		</tr>
  		<tr>
  			<td width="60%" colspan="6" style="text-align: center"><b>Balanza de Comprobaci&oacute;n</b></td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  		</tr>
  		<tr>
  			<td width="20%" colspan="6" align="center"><b>&nbsp;De la Fecha:&nbsp;<?php echo date_format(date_create($Fecha_Inicial),"d-m-Y");?> A la Fecha:&nbsp;<?php echo date_format(date_create($Fecha_Final),"d-m-Y");?></b></td>
  			<td width="20%" colspan="2" align="right">&nbsp;</td>
  		</tr>
  		<tr>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  			<td width="10%">&nbsp;</td>
  		</tr>
  	</table>
  	<table border="0" width="100%" cellspacing="1"  bgcolor="#7F7F7F" style="font-family: Trebuchet MS; font-size:10pt; color:ffffff;">
  		<tr align="center">
  			<td width="12%">Cuenta</td>
  			<td width="40%">Descripci&oacute;n</td>
  			<td width="12%">Saldo Inicial</td>
  			<td width="12%">Cargos</td>
  			<td width="12%">Abonos</td>
  			<td width="12%">Saldo Final</td>
  		</tr>
  	</table>
  	<table border="0" width="100%" cellspacing="1" style="text-align: center; font-family: Trebuchet MS; font-size: 8pt; ">
  		<tr bgcolor="#C0C0C0">
  			<td colspan="6" align="center"><b>ACTIVO</b></td>
  		</tr>
  	<?php while( $oRst_EDC_Activo = mysqli_fetch_array($sql_EDC_Activo) ){	?>
  		<tr>
  			<td width="12%" style="text-align: left"><?php echo trim($oRst_EDC_Activo['pk_id_cuenta']); ?></td>
  			<td width="40%" style="text-align: left"><?php echo trim($oRst_EDC_Activo['s_cta_desc']); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Activo['sal_ini'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Activo['cargos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Activo['abonos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Activo['sal_fin'],2,'.',','); ?></td>
  		</tr>
  	<?php
  			if( trim($oRst_EDC_Activo['pk_id_cuenta']) == "0168-00005" ){
  				while( $oRst_SumaGastos = mysqli_fetch_array($sql_SumaGastos) ){
  	?>
  		<tr>
  			<td width="12%" style="text-align: left"><?php echo trim($oRst_EDC_Activo['pk_id_cuenta']); ?></td>
  			<td width="40%" style="text-align: left"><?php echo trim($oRst_EDC_Activo['s_cta_desc']); ?> ::<?php echo trim($oRst_SumaGastos['POLGASTO_OFICINA']); ?>::</td>
  			<td width="12%" style="text-align: right">0</td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_SumaGastos['cargos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_SumaGastos['abonos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right">0</td>
  		</tr>
  <?php
  				}
  			}
  		} ?>
  	</table>
  	<table border="0" width="100%" cellspacing="1" style="text-align: center; font-family: Trebuchet MS; font-size: 8pt; ">
  		<tr bgcolor="#C0C0C0">
  			<td colspan="6" align="center"><b>PASIVO</b></td>
  		</tr>
  	<?php while( $oRst_EDC_Pasivo = mysqli_fetch_array($sql_EDC_Pasivo)){	?>
  		<tr>
  			<td width="12%" style="text-align: left"><?php echo trim($oRst_EDC_Pasivo['pk_id_cuenta']); ?></td>
  			<td width="40%" style="text-align: left"><?php echo trim($oRst_EDC_Pasivo['s_cta_desc']); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Pasivo['sal_ini'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Pasivo['cargos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Pasivo['abonos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Pasivo['sal_fin'],2,'.',','); ?></td>
  		</tr>
  <?php	} ?>
  	</table>
  	<table border="0" width="100%" cellspacing="1" style="text-align: center; font-family: Trebuchet MS; font-size: 8pt; ">
  		<tr bgcolor="#C0C0C0">
  			<td colspan="6" align="center"><b>CAPITAL</b></td>
  		</tr>
  	<?php while( $oRst_EDC_Capital = mysqli_fetch_array($sql_EDC_Capital)){	?>
  		<tr>
  			<td width="12%" style="text-align: left"><?php echo trim($oRst_EDC_Capital['pk_id_cuenta']); ?></td>
  			<td width="40%" style="text-align: left"><?php echo trim($oRst_EDC_Capital['s_cta_desc']); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Capital['sal_ini'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Capital['cargos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Capital['abonos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Capital['sal_fin'],2,'.',','); ?></td>
  		</tr>
  <?php	} ?>
  	</table>
  	<table border="0" width="100%" cellspacing="1" style="text-align: center; font-family: Trebuchet MS; font-size: 8pt; ">
  		<tr bgcolor="#C0C0C0">
  			<td colspan="6" align="center"><b>INGRESOS</b></td>
  		</tr>
  	<?php while( $oRst_EDC_Ingresos = mysqli_fetch_array($sql_EDC_Ingresos)){	?>

  		<tr>
  			<td width="12%" style="text-align: left"><?php echo trim($oRst_EDC_Ingresos['pk_id_cuenta']); ?></td>
  			<td width="40%" style="text-align: left"><?php echo trim($oRst_EDC_Ingresos['s_cta_desc']); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Ingresos['sal_ini'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Ingresos['cargos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Ingresos['abonos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Ingresos['sal_fin'],2,'.',','); ?></td>
  		</tr>
  <?php	} ?>
  	</table>
  	<table border="0" width="100%" cellspacing="1" style="text-align: center; font-family: Trebuchet MS; font-size: 8pt; ">
  		<tr bgcolor="#C0C0C0">
  			<td colspan="6" align="center"><b>GASTOS</b></td>
  		</tr>
  	<?php while( $oRst_EDC_Gastos = mysqli_fetch_array($sql_EDC_Gastos)){	?>

  		<tr>
  			<td width="12%" style="text-align: left"><?php echo trim($oRst_EDC_Gastos['pk_id_cuenta']); ?></td>
  			<td width="40%" style="text-align: left"><?php echo trim($oRst_EDC_Gastos['s_cta_desc']); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Gastos['sal_ini'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Gastos['cargos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Gastos['abonos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right"><?php echo number_format($oRst_EDC_Gastos['sal_fin'],2,'.',','); ?></td>
  		</tr>
  <?php	} ?>
  	</table>
  	<table border="0" width="100%" cellspacing="1" style="font-family: Trebuchet MS; font-size: 8pt;">
  		<tr>
  			<td colspan="6"><hr></td>
  		</tr>
  		<tr>
  			<td width="12%">&nbsp;</td>
  			<td width="40%">&nbsp;</td>
  			<td width="12%" style="text-align: right"><b>Totales:</b></td>
  			<td width="12%" style="text-align: right" bgcolor="#C0C0C0"><?php echo number_format($oRst_SUMA_EDC['SUMA_Cargos'],2,'.',','); ?></td>
  			<td width="12%" style="text-align: right" bgcolor="#C0C0C0"><?php echo number_format($oRst_SUMA_EDC['SUMA_Abonos'],2,'.',','); ?></td>
  			<td width="12%">&nbsp;</td>
  		</tr>
  	</table>
  	</body>
  </html>

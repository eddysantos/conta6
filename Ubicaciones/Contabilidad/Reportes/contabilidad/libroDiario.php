<?php
#http://localhost:88/Ubicaciones/Contabilidad/Reportes/contabilidad/libroDiario.php?numreporte=5&Fecha_Inicial=2020-01-01&Fecha_Final=2020-08-31

#fany, el orden de las columnas se debe respetar, asi lo solicito contabilidad, es para imprimir en papel.
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$Fecha_Final = trim($_GET['Fecha_Final']);
$Fecha_Final = date_format(date_create($Fecha_Final),"Y/m/d H:i:s");
$Fecha_Inicial = trim($_GET['Fecha_Inicial']);
$Fecha_Inicial = date_format(date_create($Fecha_Inicial),"Y/m/d H:i:s");
$numreporte = trim($_GET['numreporte']);

require $root . '/Ubicaciones/Contabilidad/Reportes/actions/consultaPermisosReportes.php';
if (  $oRst_permisos['s_contabilidad_todos'] == 1 || $rslt_permisosReportes->num_rows > 0) {

	$fechaActual = date("YmdHis");
	$tblLibroDiario = 'temconta_libroDiario';
	$lst_tablas = $tblLibroDiario.'_'.$fechaActual;
	require $root . '/Ubicaciones/Contabilidad/Reportes/actions/borrarTablas.php';

	mysqli_query($db,"create table $tblLibroDiario(
							fk_tipo char(1),
							d_fecha date,
							fk_id_poliza bigint(20),
							s_concepto varchar(300),
							fk_id_cuenta varchar(15),
							s_cuenta_desc varchar(300),
							s_desc varchar(255),
							n_cargo decimal(19,2),
							n_abono decimal(19,2),
							pk_partida int AUTO_INCREMENT PRIMARY KEY,
							n_nivel int)");

		mysqli_query($db,"INSERT INTO $tblLibroDiario(fk_id_poliza ,s_concepto,d_fecha,fk_tipo,n_nivel)
			SELECT DISTINCT a.pk_id_poliza, a.s_concepto, a.d_fecha,c.s_nombreDoc,1
			FROM conta_t_polizas_mst AS a
			INNER JOIN conta_t_polizas_det AS b
				ON a.pk_id_poliza = b.fk_id_poliza
			INNER JOIN conta_t_documento AS c
				ON b.fk_tipo = c.pk_id_tipo
			WHERE a.d_fecha BETWEEN '$Fecha_Inicial' AND '$Fecha_Final'
			ORDER BY a.pk_id_poliza");

		mysqli_query($db,"INSERT INTO $tblLibroDiario(fk_id_poliza,s_cuenta_desc, fk_id_cuenta,s_desc,n_cargo,n_abono,n_nivel)
			SELECT DISTINCT a.fk_id_poliza,b.s_cta_desc, a.fk_id_cuenta, a.s_desc,a.n_cargo, a.n_abono,2
			FROM conta_t_polizas_det AS a
			INNER JOIN conta_cs_cuentas_mst AS b
				ON a.fk_id_cuenta = b.pk_id_cuenta
			WHERE a.d_fecha BETWEEN '$Fecha_Inicial' AND '$Fecha_Final'
			ORDER BY a.fk_id_poliza,a.pk_partida");

		mysqli_query($db,"INSERT INTO $tblLibroDiario(fk_id_poliza,n_cargo,n_abono,n_nivel)
			SELECT fk_id_poliza,SUM(n_abono),SUM(n_cargo),3
			FROM conta_t_polizas_det
			WHERE d_fecha BETWEEN '$Fecha_Inicial' AND '$Fecha_Final'
			GROUP BY fk_id_poliza");


	$sql_polizas = mysqli_query($db,"SELECT *
													FROM $tblLibroDiario
													ORDER BY fk_id_poliza, pk_partida ");


	?>
	<table border="0" width="100%" cellspacing="1" style="font-family: Trebuchet MS; font-size:10pt;">
		<tr>
			<td width="20%" colspan="2" rowspan="3" align="center"><img src="/Resources/imagenes/s_rojo.svg" style=' width: 45px;'></td>
			<td width="10%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="30%" colspan="3" align="right"><b>Proyección Logística Agencia Aduanal S.A. de C.V.</b></td>
		</tr>
		<tr>
			<td width="60%" colspan="6" style="text-align: center"><b>Libro Diario</b></td>
			<td width="10%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%" colspan="6" align="center"><b>&nbsp;&nbsp;<?php echo date_format(date_create($Fecha_Inicial),"d-m-Y "); ?>&nbsp;al&nbsp;<?php echo date_format(date_create($Fecha_Final),"d-m-Y "); ?></b></td>
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
	<br>


	<?php
	while($oRst_polizas = mysqli_fetch_array($sql_polizas)){
		$nivel = $oRst_polizas['n_nivel'];
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Trebuchet MS; font-size: 4pt">
	<?php if($nivel == 1){ ?>
	  <tr align="center" bgcolor="#CCCCCC">
	    <td width="10%">TIPO</td>
	    <td width="10%">POLIZA</td>
	    <td width="10%">FECHA</td>
	    <td width="50%">CONCEPTO</td>
		<td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
	  </tr>
	  <tr>
	    <td><?PHP echo trim($oRst_polizas['fk_tipo']);?></td>
	    <td><?PHP echo trim($oRst_polizas['fk_id_poliza']);?></td>
	    <td><?PHP echo date_format(date_create($oRst_polizas['d_fecha']),"d-m-Y");?></td>
	    <td><?PHP echo trim($oRst_polizas['s_concepto']);?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr align="center" bgcolor="#E6EEEE">
	    <td width="10%">CUENTA</td>
	    <td width="20%" colspan="2">DESCRIPCION</td>
	    <td width="50%">CONCEPTO DEL MOVIMIENTO</td>
		<td width="10%">DEBE</td>
		<td width="10%">HABER</td>
	  </tr>
	 <?php } ?>
	 <?php if($nivel == 2){ ?>
	  <tr>
	    <td width="10%"><?PHP echo trim($oRst_polizas['fk_id_cuenta']);?></td>
	    <td colspan="2" width="20%"><?PHP echo trim($oRst_polizas['s_cuenta_desc']);?></td>
	    <td width="50%"><?PHP echo trim($oRst_polizas['s_desc']);?></td>
	    <td width="10%" align="right"><?PHP echo number_format($oRst_polizas['n_cargo'],2,'.',',');?></td>
		<td width="10%" align="right"><?PHP echo number_format($oRst_polizas['n_abono'],2,'.',',');?></td>
	  </tr>
	 <?php } ?>
	 <?php if($nivel == 3){ ?>
	  <tr>
	    <td width="10%">&nbsp;</td>
	    <td colspan="2" width="20%">&nbsp;</td>
	    <td width="50%" align="right">TOTAL DE LA POLIZA</td>
	    <td width="10%" align="right" style="border-top-style: solid; border-top-width: 1px; border-top-color:#C0C0C0"><?PHP echo number_format($oRst_polizas['n_cargo'],2,'.',',');?></td>
		<td width="10%" align="right" style="border-top-style: solid; border-top-width: 1px; border-top-color:#C0C0C0"><?PHP echo number_format($oRst_polizas['n_abono'],2,'.',',');?></td>
	  </tr>
	  <tr>
	    <td width="10%">&nbsp;</td>
	    <td colspan="2" width="20%">&nbsp;</td>
	    <td width="50%">&nbsp;</td>
	    <td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
	  </tr>
	  <?php } ?>
	</table>
	<?PHP
	}
	require $root . '/Ubicaciones/Contabilidad/Reportes/actions/borrarTablas.php';

} #fin permiso reporte
	?>

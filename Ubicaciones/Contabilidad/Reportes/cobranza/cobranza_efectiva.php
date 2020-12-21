<?php
#http://localhost:88/Ubicaciones/Contabilidad/Reportes/cobranza/cobranza_efectiva.php?numreporte=8&Oficina=240&Fecha_Inicial=2020-01-01&Fecha_Final=2020-08-31
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$Oficina = trim($_GET['Oficina']);
$Fecha_Final = trim($_GET['Fecha_Final']);
$Fecha_Final = date_format(date_create($Fecha_Final),"Y/m/d H:i:s");
$Fecha_Inicial = trim($_GET['Fecha_Inicial']);
$Fecha_Inicial = date_format(date_create($Fecha_Inicial),"Y/m/d H:i:s");
$numreporte = trim($_GET['numreporte']);

require $root . '/Ubicaciones/Contabilidad/Reportes/actions/consultaPermisosReportes.php';
if (  $oRst_permisos['s_contabilidad_todos'] == 1 || $rslt_permisosReportes->num_rows > 0) {
	$fechaActual = date("YmdHis");
	$cobEfec1 = "temconta_cobranzaEfectiva1".'_'.$fechaActual;
	$cobEfec2 = "temconta_cobranzaEfectiva2".'_'.$fechaActual;

	mysqli_query($db,"CREATE TABLE $cobEfec1
		select b.fk_id_aduana, b.fk_id_cliente, s_selloSATcancela, b.s_nombre, b.fk_referencia, a.pk_id_factura, c.fk_id_poliza, d_fecha_fac,
			b.n_total_gral_importe, b.n_total_honorarios, b.n_total_gral_IVA, b.s_fac_IVA_retenido, b.n_total_pagos, b.n_total_depositos, b.n_fac_saldo, b.n_IVA_aplicado, c.n_abono as cobranzaMes
		from conta_t_facturas_cfdi a
		INNER JOIN conta_t_facturas_captura b
			ON a.fk_id_cuenta_captura = b.pk_id_cuenta_captura
		INNER JOIN conta_t_polizas_det c
			ON a.pk_id_factura = c.fk_factura
		WHERE s_UUID is not null and s_selloSATcancela is null	and d_fecha_fac BETWEEN '$Fecha_Inicial' and '$Fecha_Final' and b.fk_id_aduana = $Oficina
			and b.fk_referencia = c.fk_referencia and c.fk_id_cuenta LIKE '0108%' and c.n_abono > 0 and c.fk_factura > 0
			and (c.fk_tipo = 2 or c.fk_tipo = 4)
		ORDER BY d_fecha_fac");

		mysqli_query($db," ALTER TABLE $cobEfec1 ADD cobranzaAnt decimal(19,2) DEFAULT '0'");

		mysqli_query($db,"CREATE TABLE $cobEfec2
			select b.fk_referencia, b.fk_factura, SUM(b.n_abono) as cobranzaAnt
			from conta_t_polizas_mst a
			INNER JOIN conta_t_polizas_det b
				ON a.pk_id_poliza = b.fk_id_poliza
			INNER JOIN $cobEfec1 c
				ON c.pk_referencia = b.fk_id_poliza
			where c.pk_id_factura = b.fk_factura AND
				b.fk_id_cuenta LIKE '0108%' AND b.n_abono > 0 AND b.fk_factura > 0 and (b.fk_tipo = 2 or b.fk_tipo = 4) AND b.d_fecha_fac < '$Fecha_Inicial'
			GROUP BY b.fk_referencia, b.fk_factura");

		mysqli_query($db,"UPDATE $cobEfec1 A
											INNER JOIN $cobEfec2 B
												ON A.fk_referencia = B.fk_referencia
					 						SET A.cobranzaMes = B.cobranzaAnt
					 						where A.pk_id_factura = B.fk_factura");

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Cobranza Efectiva</title>
	<style>
		@import url('https://fonts.googleapis.com/css?family=Barlow:100,300,400,500,600,700,800&display=swap');
		.fontBarlow{
			font-family: 'Barlow', sans-serif!important;
		}
	</style>
</head>
<body link="#000000" alink="#000000" vlink="#000000" topmargin="1" leftmargin="1" rightmargin="1" bottommargin="1" marginwidth="1" marginheight="1" >

	<table class='fontBarlow' border="0" width="100%" cellspacing="1" style="font-size: 10pt">
		<tr>
			<td width='70%'>
				<img border="0" src="/Resources/imagenes/spectrum_worldwide.svg" width="250px">
			</td>
			<td width='30%' style='text-align: left'>
				<b style='color:#ed1c24'>Reporte de Facturación Cobranza Efectiva</b>
				<br><b>Fecha Inicio: <?php echo date_format(date_create($Fecha_Inicial),"d-m-Y "); ?></b>
				<br>
				<b>Fecha Final: <?php echo date_format(date_create($Fecha_Final),"d-m-Y "); ?></b>
			</td>
		</tr>
	</table>
	<br>

	<table class="fontBarlow" border="0" width="100%" cellspacing="1" style="font-size: 10pt">
		<tr bgcolor='#58595b' style='color:whitesmoke' align='center'>
			<td>Facturado a</td>
			<td>Referencia</td>
			<td>Factura</td>
			<td>Fecha</td>
			<td>Total Gastos</td>
			<td>Total Hon</td>
			<td>Total IVA Hon.</td>
			<td>IVA Ret.</td>
			<td>Saldo Factura</td>
			<td>Cobranza meses anteriores</td>
			<td>Cobranza del mes</td>
			<td>Anticipos</td>
			<td>Total</td>
			<td>Parte Prop Honorarios</td>
			<td>Parte Prop IVA</td>
		</tr>
		<?php

			$sSQL_FACTURAS = mysqli_query($db,"SELECT * FROM $cobEfec1 ");

		  	while( $oRst_FACTURAS = mysqli_fetch_array($sSQL_FACTURAS) ){

				$saldoFac = $oRst_FACTURAS['n_fac_saldo'];

				if( $saldoFac > 0 ){

					$parteHonorarios = 0;
					$parteIVA = 0;
					$Ant_Gast = 0;
					$total = 0;
					$parteIVA = 0;
					$totalHonorarios = 0;
					$total_1 = 0;

					$cobranzaMes = $oRst_FACTURAS['cobranzaMes'];
					$cobranzaAnt = $oRst_FACTURAS['cobranzaAnt'];
					$totalHonorarios = $oRst_FACTURAS['n_total_gral_importe'];
					$totalHonConIVA = $oRst_FACTURAS['n_total_honorarios'];
					$totalAnticipos = $oRst_FACTURAS['n_total_depositos'];

					$totalPagos = $oRst_FACTURAS['n_total_pagos'];
					$IVAaplicado = $oRst_FACTURAS['n_IVA_aplicado'];

					$Fact = $IVAaplicado / 100;
					$IVA = $Fact + 1;

					$cobranzaTotal = $cobranzaMes + $cobranzaAnt;
					$totalsaldoFac = $saldoFac - $cobranzaAnt;

					if( $totalAnticipos == 0 ){
						if( $cobranzaTotal >= $totalPagos ){
							$total_1 = $cobranzaMes - $totalPagos;
							if( $total_1 > 5 ){
								$parteHonorarios = $totalsaldoFac;
							}else{
								$parteHonorarios = $totalHonorarios;
							}
							$parteIVA = $parteHonorarios * $Fact;
						}else{
							$parteHonorarios = ( $totalHonorarios - $totalPagos ) / $IVA;
							$parteIVA = $parteHonorarios * $Fact;
						}
					}else{
						if( $cobranzaMes < $totalHonConIVA ){
							$total = $cobranzaMes;
							$parteHonorarios = $total / $IVA;
							$parteIVA = $parteHonorarios * $Fact;
						}else{
							if( $saldoFac > $totalHonConIVA ){
								$parteHonorarios = $totalHonorarios;
								$parteIVA = $parteHonorarios * $Fact;
							}else{
								$Ant_Gast = $totalAnticipos - $totalPagos;
								$total = $saldoFac - abs($Ant_Gast);
								$parteHonorarios = $total / $IVA;
								$parteIVA = $parteHonorarios * $Fact;
							}
						}
					}


					$totalGastos = $totalPagos - $cobranzaAnt;
		?>
			<tr align=right>
				<td align=left><?php echo trim($oRst_FACTURAS['s_nombre']); ?> &nbsp;</td>
				<td align=center><?php echo trim($oRst_FACTURAS['fk_referencia']); ?></td>
				<td align=center><?php echo $oRst_FACTURAS['pk_id_factura']; ?></td>
				<td align=center><?php echo date_format(date_create($oRst_FACTURAS['d_fecha_fac']),"d-m-Y ");?></td>
				<td><?php echo number_format($totalGastos,2,'.',',');?></td>
				<td><?php echo number_format($totalHonorarios,2,'.',',');?></td>
				<td><?php echo number_format($oRst_FACTURAS['n_total_gral_IVA'],2,'.',',');?></td>
				<td><?php echo number_format($oRst_FACTURAS['s_fac_IVA_retenido'],2,'.',',');?></td>
				<td><?php echo number_format($totalsaldoFac,2,'.',',');?></td>
				<td><?php echo number_format($cobranzaAnt,2,'.',',');?></td>
				<td><?php echo number_format($cobranzaMes,2,'.',',');?></td>
				<td><?php echo number_format($totalAnticipos,2,'.',',');?></td>
				<td><?php echo number_format($total,2,'.',',');?></td>
				<td><?php echo number_format($parteHonorarios,2,'.',',');?></td>
				<td><?php echo number_format($parteIVA,2,'.',',');?></td>
			</tr>
		<?php

			    } #solo muestra los registros que el saldo es positivo
		    }

			$lst_tablas = $cobEfec1.','.$cobEfec2;
			require $root . '/Ubicaciones/Contabilidad/Reportes/actions/borrarTablas.php';

?>


	</table>
</body>
</html>











<?PHP
}#fin oRst_permisos
?>

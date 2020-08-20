<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
$rutaLogo = $root . '/Resources/imagenes/cheetah.svg';

$id_aduana = $aduana;
$id_nomina = trim($_GET['semana']);
$id_empleado = trim($_GET['id_empleado']);
$anio = trim($_GET['anio']);
$id_regimen = '02';

#ANUAL 					Ubicaciones\Nomina\SueldosySalarios\actions\impresionNominaCcompletoSuel_excel.php?id_empleado=Todas&id_nomina=Todas&id_aduana=Todas&anio=2014
if( $id_empleado == 'Todas' && $id_nomina == 'Todas' && $id_aduana == 'Todas' ){ $consulta = 'n_anio ='.$anio; }
#ANUAL POR OFICINA		Ubicaci	Ubicaciones\Nomina\SueldosySalarios\actions\impresionNominaCcompletoSuel_excel.php?id_empleado=Todas&id_nomina=Todas&id_aduana=160&anio=2014
if( $id_empleado == 'Todas' && $id_nomina == 'Todas' && $id_aduana > 0 ){ $consulta = 'n_anio ='.$anio.' AND fk_id_aduana ='.$id_aduana; }
#ANUAL POR EMPLEADO			Ubicaciones\Nomina\SueldosySalarios\actions\impresionNominaCcompletoSuel_excel.php?id_empleado=1&id_aduana=Todas&anio=2014&id_aduana=470
if( $id_empleado > 0 && $id_aduana > 0 && $anio > 0 ){ $consulta = 'id_empleado ='.$id_empleado.' AND n_anio ='.$anio.' AND fk_id_aduana ='.$id_aduana; }
#POR OFICINA				Ubicaciones\Nomina\SueldosySalarios\actions\impresionNominaCcompletoSuel_excel.php?id_empleado=Todas&id_nomina=38&id_aduana=160&anio=2014
if( $id_empleado == 'Todas' && $id_nomina > 0 && $id_aduana > 0 ){ $consulta = 'n_anio ='.$anio.' AND fk_id_aduana ='.$id_aduana.' AND n_semana ='.$id_nomina; }


	if( $id_empleado == 'Todas' && $id_nomina > 0 && $id_aduana > 0 ){
		$tipo = trim($_GET['tipo']);
		if( $tipo == 'T' ){
			$consulta = 'n_anio ='.$anio.' AND fk_id_aduana ='.$id_aduana.' AND n_semana ='.$id_nomina;
		}else{
			$consulta = "n_anio =".$anio." AND fk_id_aduana =".$id_aduana." AND n_semana =".$id_nomina." AND s_tipoNomina ='".$tipo."'";
		}
	}


	$txtSQL_percepciones = "SELECT n_ordenReporte,s_conceptoReporte,s_clasificacion
							FROM conta_cs_sat_tipoPercepcion_ctaMst
							WHERE fk_id_regimen = '$id_regimen' AND n_ordenReporte > 0
							ORDER BY n_ordenReporte";

	$txtSQL_otrosPagos = "SELECT n_ordenReporte,s_conceptoReporte,s_clasificacion
						   FROM conta_cs_sat_tipoOtroPago_ctaMst
						   WHERE fk_id_regimen = '$id_regimen' AND n_ordenReporte > 0
						   ORDER BY n_ordenReporte";

	$txtSQL_deducciones = "SELECT n_ordenReporte,s_conceptoReporte,s_clasificacion
						   FROM conta_cs_sat_tipoDeduccion_ctaMst
						   WHERE fk_id_regimen = '$id_regimen' AND n_ordenReporte > 0
						   ORDER BY n_ordenReporte";

  $sql_consultaNominaFecha = mysqli_fetch_array(mysqli_query($db,"SELECT distinct d_fechaInicio,d_fechaFinal FROM conta_t_nom_captura WHERE fk_id_regimen = '$id_regimen' AND $consulta "));

	if($id_aduana == 160) { $oficina = "MANZANILLO"; }
	if($id_aduana == 240) { $oficina = "NUEVO LAREDO"; }
	if($id_aduana == 430) { $oficina = "VERACRUZ"; }
	if($id_aduana == 470) { $oficina = "AEROPUERTO"; }
	if($id_aduana == 'Todas') { $oficina = ""; }
?>
<!DOCTYPE html>
<html lang="es">
	<head>
	<title>Impresion Recibos</title>
<style type="text/css">
	.linea:nth-child(even) td { background: #DCDCDC; }
	.linea:nth-child(odd) td { background: #FFFFFF; }
	.linea td:hover { background: #FCD6D7; color: #000000; }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">
<!--body onLoad="print()" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0"-->
<table border="0" width="100%" cellspacing="1" style="font-family: Trebuchet MS;">
		<tr>
			<td width="20%" colspan="2" rowspan="3" align="center"><img border="0" src="../../../../Resources/Imagenes/cheetah.svg" width="91" height="78"></td>
			<td width="10%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="30%" colspan="3" align="right"><b>Proyección Logística Agencia Aduanal S.A. de C.V.</b></td>
		</tr>
		<tr>
			<td width="60%" colspan="6" align="center"><?php echo $oficina;?></td>
			<td width="10%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
		</tr>
		<tr style="font-size: 10pt;" align=center>
			<td width="20%" colspan="2"><b>Número de Nómina: <?PHP echo $id_nomina;?></b></td>
			<td width="20%" colspan="2"><b>Fecha Inicio: <?php echo  date_format(date_create($sql_consultaNominaFecha['d_fechaInicio']),"d-m-Y"); ?></b></td>
			<td width="20%" colspan="2"><b>Fecha Final:<?php echo  date_format(date_create($sql_consultaNominaFecha['d_fechaFinal']),"d-m-Y"); ?></b></td>
			<td width="20%" colspan="2">&nbsp;</td>
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
<table border="0" width="100%" cellspacing="1" style="font-family: Trebuchet MS;">
		<tr>
			<td width="100%" colspan="9" bgcolor="#000000" align="center" style="color:#FFFFFF">Empleados Bajo el Régimen de Sueldos y Salarios</td>
		</tr>
</table>
<table border="0" width="100%" cellspacing="1" style="font-family: Trebuchet MS; font-size:8pt;">
	<tr align="center" bgcolor="#000000" style="color:#FFFFFF;">
		<td rowspan="2">Oficina</td>
		<td rowspan="2">Nómina</td>
		<td rowspan="2">No</td>
		<td rowspan="2">Empleado</td>
		<td rowspan="2">Salario</td>
		<td colspan="4">Días</td>
<?php
	$sql_consultaConceptoP = mysqli_query($db,$txtSQL_percepciones);

	while( $oRst_consultaConceptoP = mysqli_fetch_array($sql_consultaConceptoP)){
		$ordenReporteP = $oRst_consultaConceptoP['n_ordenReporte'];
		if( $ordenReporteP == 5 or $ordenReporteP == 6 ){
			if( $ordenReporteP == 5 ){ $rowspanP = 'style="background-color:#FFFF99; color:#000000" colspan="5" '; }else{
				$rowspanP = 'style="background-color:#8DBDD8; color:#000000" colspan="5" ';
			}
		}else{
			$rowspanP = 'style="background-color:#DCDCDC; color:#000000" rowspan="2" ';
		}
		echo '<td '.$rowspanP.'>'.utf8_encode($oRst_consultaConceptoP['s_conceptoReporte']).'</td>';}
?>
		<td rowspan="2" style="background-color:#7F7F7F;">Total Percepciones</td>

<?php
	$sql_consultaConceptoOP = mysqli_query($db,$txtSQL_otrosPagos);

	while( $oRst_consultaConceptoOP = mysqli_fetch_array($sql_consultaConceptoOP)){
		$ordenReporteOP = $oRst_consultaConceptoOP['n_ordenReporte'];
		$rowspanOP = "rowspan=2";;
		echo '<td style="background-color:#DCDCDC; color:#000000" '.$rowspanOP.'>'.utf8_encode($oRst_consultaConceptoOP['s_conceptoReporte']).'</td>';
	}
?>
<td rowspan="2" style="background-color:#7F7F7F;">Total Otros Pagos</td>











<?php
	$sql_consultaConceptoD = mysqli_query($db,$txtSQL_deducciones);

	while($oRst_consultaConceptoD = mysqli_fetch_array($sql_consultaConceptoD)){
		$ordenReporteD = $oRst_consultaConceptoD['n_ordenReporte'];
		if( $ordenReporteD == 7 ){ $rowspanD = "colspan=3"; }else{ $rowspanD = "rowspan=2"; }
		echo '<td style="background-color:#DCDCDC; color:#000000" '.$rowspanD.'>'.utf8_encode($oRst_consultaConceptoD['s_conceptoReporte']).'</td>';}
?>
		<td rowspan="2" style="background-color:#7F7F7F;">Total Deducciones</td>
		<td rowspan="2">Total</td>
		<td rowspan="2">Neto a Pagar</td>
		<td rowspan="2">CFDI</td>
    <td rowspan="2">Tipo</td>
	</tr>
	<tr align="center" bgcolor="#000000" style="color:#FFFFFF;">
		<td>I</td>
		<td>V</td>
		<td>F</td>
		<td>P</td>
		<td style="background-color:#DCDCDC; color:#000000">Días</td>
		<td style="background-color:#DCDCDC; color:#000000">Hrs.</td>
		<td style="background-color:#DCDCDC; color:#000000">Grava</td>
		<td style="background-color:#DCDCDC; color:#000000">Exento</td>
		<td style="background-color:#DCDCDC; color:#000000">Pago</td>
		<td style="background-color:#DCDCDC; color:#000000">Días</td>
		<td style="background-color:#DCDCDC; color:#000000">Hrs.</td>
		<td style="background-color:#DCDCDC; color:#000000">Grava</td>
		<td style="background-color:#DCDCDC; color:#000000">Exento</td>
		<td style="background-color:#DCDCDC; color:#000000">Pago</td>
		<td style="background-color:#DCDCDC; color:#000000">Base</td>
		<td style="background-color:#DCDCDC; color:#000000">%</td>
		<td style="background-color:#DCDCDC; color:#000000">Importe</td>
	</tr>
  <?php
  # no mostrar cancelados
   $sql_consultaNomina = mysqli_query($db,"SELECT n_anio, n_semana, fk_id_empleado, s_nombre, s_apellidoM, s_apellidoP, pk_id_docNomina, fk_id_aduana, n_salarioDiarioIntegrado,s_tipoNomina
                                          FROM conta_t_nom_captura
                                          WHERE fk_id_regimen = '$id_regimen' AND $consulta
                                          ORDER BY n_semana,s_nombre");

    while( $oRst_consultaNomina = mysqli_fetch_array($sql_consultaNomina)){
      $id_docNomina =  $oRst_consultaNomina['pk_id_docNomina'];
      $salario = $oRst_consultaNomina['n_salarioDiarioIntegrado'];
      $tipo = $oRst_consultaNomina['s_tipoNomina'];
      $id_poliza = '';
      $pol_cancela = '';
      $id_factura = '';
      $UUID = '';

      $sql_consultaCFDI=mysqli_query($db,"SELECT fk_id_poliza,s_UUID,pk_id_nomina, s_cancela_factura
                                          FROM conta_t_nom_cfdi
                                          where fk_id_docNomina = $id_docNomina");
      $totalRegistrosCFDI = mysqli_num_rows($sql_consultaCFDI);
      if( $totalRegistrosCFDI > 0 ){
        $oRst_consultaCFDI = mysqli_fetch_array($sql_consultaCFDI);
        $id_poliza = $oRst_consultaCFDI['fk_id_poliza'];
        $pol_cancela = $oRst_consultaCFDI['s_cancela_factura'];
        $id_factura = $oRst_consultaCFDI['pk_id_nomina'];
        $UUID = $oRst_consultaCFDI['s_UUID'];

        if( $pol_cancela == 1 ){
          $txt_cancela = 'CNCELADO';
        }else {
          $txt_cancela = 'ACTIVO';
        }
      }

      $sql_totales = mysqli_fetch_array(mysqli_query($db,"SELECT n_dias_vacaciones, n_dias_faltas, n_dias_incapacidad, n_dias_pagar, n_totalPercepciones, n_totalDeducciones, n_total, n_totalNeto
                                                          from conta_t_nom_captura_det
                                                          where s_tipoElemento = 'totales' and fk_id_docNomina = $id_docNomina"));

      $diasVacaciones = $sql_totales['n_dias_vacaciones'];
      $diasFaltas = $sql_totales['n_dias_faltas'];
      $diasIncapacidad = $sql_totales['n_dias_incapacidad'];
      $diasPagar = $sql_totales['n_dias_pagar'];
      $totalPercepciones = $sql_totales['n_totalPercepciones'];
      $totalDeducciones = $sql_totales['n_totalDeducciones'];
      $total = $sql_totales['n_total'];
      $totalNeto = $sql_totales['n_totalNeto'];
?>
<tr align="right">
  <td align="center"><?php echo $oRst_consultaNomina['fk_id_aduana']; ?></td>
  <td align="center"><?php echo $oRst_consultaNomina['n_semana']; ?></td>
  <td align="center"><?php echo $oRst_consultaNomina['fk_id_empleado']; ?></td>
  <td align="left"><?php echo $oRst_consultaNomina['s_nombre']." ".$oRst_consultaNomina['s_apellidoP']." ".$oRst_consultaNomina['s_apellidoM']; ?></td>
  <td><?php echo number_format( $salario ,2,'.',','); ?></td>
  <td align="center"><?php echo $diasIncapacidad; ?></td>
  <td align="center"><?php echo $diasVacaciones; ?></td>
  <td align="center"><?php echo $diasFaltas; ?></td>
  <td align="center"><?php echo $diasPagar; ?></td>
  <?php
  		$sql_consultaOrdenP=mysqli_query($db,$txtSQL_percepciones);

  		while($oRst_consultaOrdenP = mysqli_fetch_array($sql_consultaOrdenP)){
  			$ordenP = $oRst_consultaOrdenP['n_ordenReporte'];

  			$sql_consultaDetalleP=mysqli_query($db,"SELECT sum(n_importeGravado) as importeGravado,sum(n_importeExento) as importeExento,sum(n_importePagado) as importePagado,sum(n_dias_horasExtra) as dias_horasExtra,sum(n_horasExtra) as horasExtra
  													FROM conta_t_nom_captura_det
  													where fk_id_docNomina = $id_docNomina and (s_clasificacion = 'percepcion' or s_clasificacion = 'horasExtras' or s_clasificacion = 'separacionIndemnizacion') and n_ordenReporte = $ordenP");
  			$totalRegistros = mysqli_num_rows($sql_consultaDetalleP);
  			if( $totalRegistros > 0 ){
  				while( $oRst_consultaDetalleP = mysqli_fetch_array($sql_consultaDetalleP)){
  					if( $ordenP == 5 || $ordenP == 6 ){
  						$importeG = number_format($oRst_consultaDetalleP['importeGravado'],2,'.',',');
  						$importeE = number_format($oRst_consultaDetalleP['importeExento'],2,'.',',');
  						$importe = number_format($oRst_consultaDetalleP['importePagado'],2,'.',',');
  						$dias = $oRst_consultaDetalleP['dias_horasExtra'];
  						$horas = $oRst_consultaDetalleP['horasExtra'];
  						echo '<td>'.$dias.'</td><td>'.$horas.'</td><td align="right">'.$importeG.'</td><td align="right">'.$importeE.'</td><td align="right">'.$importe.'</td>';}else{
  						$importe = $oRst_consultaDetalleP['importeGravado'] + $oRst_consultaDetalleP['importeExento'];
  						$importe = number_format($importe,2,'.',',');
  						echo '<td align="right">'.$importe.'</td>';
  					}
  				}
  			}else{
  				if( $ordenP == 5 || $ordenP == 6 ){
  					echo '<td>0</td><td>0</td><td>0.0</td><td>0.0</td><td>0.0</td>';
  				}else{
  					echo '<td>0.0</td>';
  				}
  			}
		}?>
    <td><?php echo number_format($totalPercepciones,2,'.',',');?></td>
    <?php
		$sql_consultaOrdenOP=mysqli_query($db,$txtSQL_otrosPagos);

		while($oRst_consultaOrdenOP = mysqli_fetch_array($sql_consultaOrdenOP)){
			$ordenOP = $oRst_consultaOrdenOP['n_ordenReporte'];

			$sql_consultaDetalleOP=mysqli_query($db,"SELECT *
													FROM conta_t_nom_captura_det
													where fk_id_docNomina = $id_docNomina and s_clasificacion = 'otrosPagos' and n_ordenReporte = $ordenOP");
			$totalRegistros = mysqli_num_rows($sql_consultaDetalleOP);
			if( $totalRegistros > 0 ){
				while( $oRst_consultaDetalleOP = mysqli_fetch_array($sql_consultaDetalleOP)){

						$importe = $oRst_consultaDetalleOP['n_importeGravado'] + $oRst_consultaDetalleOP['n_importeExento'];
						$importe = number_format($importe,2,'.',',');
						echo '<td>'.$importe.'</td>';
				}
			 }else{	echo '<td>0.0</td>';}
		}?>
		<td><?php echo number_format($totalOtrosPagos,2,'.',',');?></td>


    <?php
    $sql_consultaOrdenD = mysqli_query($db,$txtSQL_deducciones);
    while( $oRst_consultaOrdenD = mysqli_fetch_array($sql_consultaOrdenD)){
      $ordenD = $oRst_consultaOrdenD['n_ordenReporte'];

      $sql_consultaDetalleD=mysqli_query($db,"SELECT *
                          FROM conta_t_nom_captura_det
                          where fk_id_docNomina = $id_docNomina and (s_clasificacion = 'deduccion' or s_clasificacion = 'desctoDespTotal') and n_ordenReporte = $ordenD");
      $totalRegistros = mysqli_num_rows($sql_consultaDetalleD);
      if( $totalRegistros > 0 ){
        while($oRst_consultaDetalleD = mysqli_fetch_array($sql_consultaDetalleD)){
          if( $ordenD == 7 ){
            $importe = number_format($oRst_consultaDetalleD['n_descuento'],2,'.',',');
            $base = number_format($oRst_consultaDetalleD['n_base'],2,'.',',');
            $porcentaje = $oRst_consultaDetalleD['n_porcentaje'];
            echo '<td>'.$base.'</td><td>'.$porcentaje.'</td><td align="right">'.$importe.'</td>';
          }else{
            $importe = $oRst_consultaDetalleD['n_importeGravado'] + $oRst_consultaDetalleD['n_importeExento'];
            $importe = number_format($importe,2,'.',',');
            echo '<td align="right">'.$importe.'</td>';
          }
        }
      }else{
        if( $ordenD == 7 ){
          echo '<td align="right">0.0</td><td>0</td><td align="right">0.0</td>';}else{
          echo '<td align="right">0.0</td>';
        }
      }
    }?>
    <td><?php echo number_format($totalDeducciones,2,'.',',');?></td>
    <td><?php echo number_format($total,2,'.',',');?></td>
    <td><?php echo number_format($totalNeto,2,'.',',');?></td>
    <td align="center"><?php if(is_string($UUID)){ echo $id_factura;} ?></td>
    <td align="center"><?php echo $tipo; ?></td>
  </tr>
  <?php } ?>







	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="4" align="center" style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">Totales</td>
	<?php
		$sql_consultaTotales = mysqli_fetch_array(mysqli_query($db,"SELECT SUM(n_totalPercepciones) as totalPercepciones,SUM(n_totalOtrosPagos) as totalOtrosPagos,SUM(n_totalDeducciones) as totalDeducciones, SUM(n_total) as total, SUM(n_totalNeto) as totalNeto
		                      from conta_t_nom_captura_det a, conta_t_nom_captura b, conta_t_nom_cfdi c
		                      where a.fk_id_docNomina = b.pk_id_docNomina and a.fk_id_docNomina = c.fk_id_docNomina and
		                                    c.s_selloSATcancela is null and a.s_tipoElemento  ='totales' and b.fk_id_regimen = '$id_regimen' and $consulta "));

		$consultaTotalPercepciones = $sql_consultaTotales['totalPercepciones'];
		$consultaTotalOtrosPagos = $sql_consultaTotales['totalOtrosPagos'];
		$consultaTotalDeducciones = $sql_consultaTotales['totalDeducciones'];
		$consultaTotal = $sql_consultaTotales['total'];
		$consultaTotalNeto = $sql_consultaTotales['totalNeto'];



		$sql_consultaOrdenPtotales = mysqli_query($db,$txtSQL_percepciones);
		while($oRst_consultaOrdenPtotales = mysqli_fetch_array($sql_consultaOrdenPtotales)){
			$ordenTotalesP = $oRst_consultaOrdenPtotales['n_ordenReporte'];
			if( $ordenTotalesP == 5 or $ordenTotalesP == 6){ $txtSumTotales = "n_importePagado"; }else{ $txtSumTotales = "n_importeGRAVADO + n_importeEXENTO"; }
			$sql_consultaPtotales = mysqli_query($db,"SELECT SUM($txtSumTotales) AS TOTAL
				from conta_t_nom_captura_det a, conta_t_nom_captura b, conta_t_nom_cfdi c
				where a.fk_id_docNomina = b.pk_id_docNomina and a.fk_id_docNomina = c.fk_id_docNomina and
					c.s_selloSATcancela is null and (a.s_clasificacion = 'percepcion' or a.s_clasificacion = 'horasExtras' or a.s_clasificacion = 'separacionIndemnizacion') AND a.n_ordenReporte = $ordenTotalesP and b.fk_id_regimen = '$id_regimen' and $consulta ");

			$totalRegTotalesP = mysqli_num_rows($sql_consultaPtotales);
			if( $totalRegTotalesP > 0 ){
				$oRst_consultaPtotales = mysqli_fetch_array($sql_consultaPtotales);
				$total = number_format($oRst_consultaPtotales['TOTAL'],2,'.',',');
				if( $ordenTotalesP == 5 or $ordenTotalesP == 6){
					echo '<td align="right">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">'.$total.'</td>';
				}else{
					echo '<td align="right" style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">'.$total.'</td>';
				}
			}else{
				if( $ordenTotalesP == 5 or $ordenTotalesP == 6 ){
					echo '<td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">0.0</td>
						  <td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">0.0</td>
						  <td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">0.0</td>';
				}else{
					echo '<td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">0.0</td>';
			}
		}
	}
	?>
		<td align="right" style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000"><?php echo number_format($consultaTotalPercepciones,2,'.',',');?></td>





		<?php
				$sql_consultaOrdenOtrosPtotales = mysqli_query($db,$txtSQL_otrosPagos);

				while($oRst_consultaOrdenOtrosPtotales = mysqli_fetch_array($sql_consultaOrdenOtrosPtotales)){
					$ordenTotalesOP = $oRst_consultaOrdenOtrosPtotales['n_ordenReporte'];
					$txtSumTotales = "n_importeGRAVADO + n_importeEXENTO";
					$sql_consultaOPtotales = mysqli_query($db,"SELECT SUM($txtSumTotales) AS TOTAL
						from conta_t_nom_captura_det a, conta_t_nom_captura b, conta_t_nom_cfdi c
						where a.fk_id_docNomina = b.pk_id_docNomina and a.fk_id_docNomina = c.fk_id_docNomina and
							c.s_selloSATcancela is null and (a.s_clasificacion = 'otrosPagos') AND a.n_ordenReporte = $ordenTotalesOP and b.fk_id_regimen = '$id_regimen' and $consulta");

					$totalRegTotalesOtrosP = mysqli_num_rows($sql_consultaOPtotales);
					if( $totalRegTotalesOtrosP > 0 ){
						$oRst_consultaOtrosPtotales = mysqli_fetch_array($sql_consultaOPtotales);
						$total = number_format($oRst_consultaOtrosPtotales['TOTAL'],2,'.',',');

						echo '<td align="right" style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">'.$total.'</td>';

					}else{
						echo '<td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">0.0</td>';
					}
				}
			?>
				<td align="right" style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000"><?php echo number_format($consultaTotalOtrosPagos,2,'.',',');?></td>




				<?php
						$sql_consultaOrdenDtotales = mysqli_query($db,$txtSQL_deducciones);

						while($oRst_consultaOrdenDtotales = mysqli_fetch_array($sql_consultaOrdenDtotales)){
							$ordenTotalesD = $oRst_consultaOrdenDtotales['n_ordenReporte'];
							if( $ordenTotalesD == 5 or $ordenTotalesD == 6){ $txtSumTotales = "n_descuento"; }else{ $txtSumTotales = "n_importeGravado + n_importeExento"; }
							$sql_consultaDtotales=mysqli_query($db,"SELECT SUM($txtSumTotales) AS TOTAL
									from conta_t_nom_captura_det a, conta_t_nom_captura b, conta_t_nom_cfdi c
									where a.fk_id_docNomina = b.pk_id_docNomina and a.fk_id_docNomina = c.fk_id_docNomina and
										c.s_selloSATcancela is null and (a.s_clasificacion = 'deduccion' or a.s_clasificacion = 'desctoDespTotal') AND a.n_ordenReporte = $ordenTotalesD and b.fk_id_regimen = '$id_regimen' and $consulta");

							$totalRegTotalesD = mysqli_num_rows($sql_consultaDtotales);
							if( $totalRegTotalesD > 0 ){
								$oRst_consultaDtotales = mysqli_fetch_array($sql_consultaDtotales);
								$total = number_format($oRst_consultaDtotales['TOTAL'],2,'.',',');
								if( $ordenTotalesD == 7){
									echo '<td align="right">&nbsp;</td><td>&nbsp;</td><td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">'.$total.'</td>';
								}else{
									echo '<td align="right" style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">'.$total.'</td>';
								}
							}else{
								if( $ordenTotalesD == 7 ){
									echo '<td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">0.0</td>
										  <td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">0</td>
										  <td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">0.0</td>';
								}else{
									echo '<td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000">0.0</td>';
								}
							}
						}
					?>




		<td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000"><?php echo number_format($consultaTotalDeducciones,2,'.',',');?></td>
		<td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000"><?php echo number_format($consultaTotal,2,'.',',');?></td>
		<td style="border-top-style:solid; border-top-width:1px; solid; border-bottom-width: 1px; border-bottom-style: solid; border-color:#000000"><?php echo number_format($consultaTotalNeto,2,'.',',');?></td>
	</tr>
	</table>
</body>






































	</table>
</body>

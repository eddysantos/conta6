<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
$rutaLogo = $root . '/Resources/imagenes/cheetah.svg';

$id_aduana = $aduana;
$id_nomina = trim($_GET['semana']);
$id_empleado = trim($_GET['id_empleado']);
$anio = trim($_GET['anio']);
$id_regimen = '09';

	#ANUAL 					Ubicaciones\Nomina\Honorarios\actions\impresionNomina_completo_excel.php?id_empleado=Todas&id_nomina=Todas&id_aduana=Todas&anio=2014
	if( $id_empleado == 'Todas' && $id_nomina == 'Todas' && $id_aduana == 'Todas' ){ $consulta = 'n_anio ='.$anio; }
	#ANUAL POR OFICINA		Ubicaciones\Nomina\Honorarios\actions\impresionNomina_completo_excel.php?id_empleado=Todas&id_nomina=Todas&id_aduana=160&anio=2014
	if( $id_empleado == 'Todas' && $id_nomina == 'Todas' && $id_aduana > 0 ){ $consulta = 'n_anio ='.$anio.' AND fk_id_aduana ='.$id_aduana; }
	#ANUAL POR EMPLEADO		Ubicaciones\Nomina\Honorarios\actions\impresionNomina_completo_excel.php?id_empleado=1&id_aduana=Todas&anio=2014&id_aduana=470
	if( $id_empleado > 0 && $id_aduana > 0 && $anio > 0 ){ $consulta = 'id_empleado ='.$id_empleado.' AND n_anio ='.$anio.' AND fk_id_aduana ='.$id_aduana; }
	#POR OFICINA			Ubicaciones\Nomina\Honorarios\actions\impresionNomina_completo_excel.php?id_empleado=Todas&id_nomina=38&id_aduana=160&anio=2014
	if( $id_empleado == 'Todas' && $id_nomina > 0 && $id_aduana > 0 ){ $consulta = 'n_anio ='.$anio.' AND fk_id_aduana ='.$id_aduana.' AND n_semana ='.$id_nomina; }

	$sql_consultaConceptoP = mysqli_query($db,"SELECT n_ordenReporte,s_conceptoReporte,s_clasificacion
										FROM conta_cs_sat_tipoPercepcion_ctaMst
										WHERE fk_id_regimen = '$id_regimen' AND n_ordenReporte > 0
										ORDER BY n_ordenReporte");
	$sql_consultaConceptoD = mysqli_query($db,"SELECT n_ordenReporte,s_conceptoReporte,s_clasificacion
										FROM conta_cs_sat_tipodeduccion_ctamst
										WHERE fk_id_regimen = '$id_regimen' AND n_ordenReporte > 0
										ORDER BY n_ordenReporte");
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
<!--body onLoad="print()" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0"-->
<body>
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
			<td width="20%" colspan="2"><b>Semana: <?PHP echo $id_nomina;?></b></td>
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
		<tr>
			<td width="100%" colspan="12" bgcolor="#000000" align="center" style="color:#FFFFFF">Empleados Bajo el Régimen de Honorarios Asimilables a Salarios</td>
		</tr>
</table>
<table border="0" width="100%" cellspacing="1">
	<tr align="center" bgcolor="#000000" style="color:#FFFFFF; font-family: Trebuchet MS; font-size:10pt">
		<td rowspan="2">Oficina</td>
		<td rowspan="2">Nómina</td>
		<td rowspan="2">No</td>
		<td rowspan="2">Empleado</td>
		<td colspan="4">Días</td>
<?php
	while( $oRst_consultaConceptoP = mysqli_fetch_array($sql_consultaConceptoP)){
		$ordenReporteP = $oRst_consultaConceptoP['n_ordenReporte'];
		$rowspanP = "rowspan=2";
		echo '<td '.$rowspanP.'>'.$oRst_consultaConceptoP['s_conceptoReporte'].'</td>';
	}
?>
<?php
	while( $oRst_consultaConceptoD = mysqli_fetch_array($sql_consultaConceptoD)){
		$ordenReporteD = $oRst_consultaConceptoD['n_ordenReporte'];
		if( $ordenReporteD == 2 ){
			$rowspanD = "colspan=3";
		}else{
			$rowspanD = "rowspan=2";
		}
		echo '<td '.$rowspanD.'>'.$oRst_consultaConceptoD['s_conceptoReporte'].'</td>';
	}
?>
		<td rowspan="2">Neto a Pagar</td>
		<td rowspan="2">Documento</td>
		<td rowspan="2">Póliza</td>
		<td rowspan="2">Cancela</td>
		<td rowspan="2">Factura</td>
		<td rowspan="2">UUID</td>
    <td rowspan="2">Tipo</td>
	</tr>
	<tr align="center" bgcolor="#000000" style="color:#FFFFFF; font-family: Trebuchet MS; font-size:10pt">
		<td>I</td>
		<td>V</td>
		<td>F</td>
		<td>P</td>
		<td>Base</td>
		<td>%</td>
		<td>Importe</td>
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
    <td align="center"><?php echo $diasIncapacidad; ?></td>
    <td align="center"><?php echo $diasVacaciones; ?></td>
    <td align="center"><?php echo $diasFaltas; ?></td>
    <td align="center"><?php echo $diasPagar; ?></td>
  <?php
    $sql_consultaOrdenP=mysqli_query($db,"SELECT n_ordenReporte
                        FROM conta_cs_sat_tipoPercepcion_ctaMst
                        WHERE fk_id_regimen = '$id_regimen' AND n_ordenReporte > 0
                        ORDER BY n_ordenReporte");

    while( $oRst_consultaOrdenP = mysqli_fetch_array($sql_consultaOrdenP)){
      $ordenP = $oRst_consultaOrdenP['n_ordenReporte'];
      $sql_consultaDetalleP = mysqli_query($db,"SELECT *
                          FROM conta_t_nom_captura_det
                          where fk_id_docNomina = $id_docNomina and s_clasificacion = 'percepcion' and n_ordenReporte = $ordenP");
      $totalRegistros = mysqli_num_rows($sql_consultaDetalleP);
      if( $totalRegistros > 0 ){
        while($oRst_consultaDetalleP = mysqli_fetch_array($sql_consultaDetalleP)){
          $importe = $oRst_consultaDetalleP['n_importeGravado'] + $oRst_consultaDetalleP['n_importeExento'];
          $importe = number_format($importe,2,'.',',');
          echo '<td>'.$importe.'</td>';
        }
      }else{
          echo '<td>0.0</td>';
      }
    }
  ?>
  <?php
    $sql_consultaOrdenD=mysqli_query($db,"SELECT n_ordenReporte
                        FROM conta_cs_sat_tipodeduccion_ctamst
                        WHERE fk_id_regimen = '$id_regimen' AND n_ordenReporte > 0
                        ORDER BY n_ordenReporte");
    while( $oRst_consultaOrdenD = mysqli_fetch_array($sql_consultaOrdenD)){
      $ordenD = $oRst_consultaOrdenD['n_ordenReporte'];
      $sql_consultaDetalleD = mysqli_query($db,"SELECT *
                          FROM conta_t_nom_captura_det
                          where fk_id_docNomina = $id_docNomina and s_clasificacion = 'deduccion' and n_ordenReporte = $ordenD");
      $totalRegistros = mysqli_num_rows($sql_consultaDetalleD);
      if( $totalRegistros > 0 ){
        while( $oRst_consultaDetalleD = mysqli_fetch_array($sql_consultaDetalleD)){
          if( $ordenD == 2 ){
            $importe = number_format($oRst_consultaDetalleD['n_descuento'],2,'.',',');
            $base = number_format($oRst_consultaDetalleD['n_base'],2,'.',',');
            $porcentaje = $oRst_consultaDetalleD['n_porcentaje'];
            echo '<td>'.$base.'</td><td>'.$porcentaje.'</td><td>'.$importe.'</td>';
          }else{
            $importe = $oRst_consultaDetalleD['n_importeGravado'] + $oRst_consultaDetalleD['n_importeExento'];
            $importe = number_format($importe,2,'.',',');
            echo '<td>'.$importe.'</td>';
          }
        }
      }else{
        if( $ordenD == 2 ){
          echo '<td>0.0</td><td>0</td><td>0.0</td>';
        }else{
          echo '<td>0.0</td>';
        }
      }
    }
  ?>
    <td><?php echo number_format($totalNeto,2,'.',',');?></td>
    <td align="center"><?php echo $id_docNomina; ?></td>
    <td align="center"><?php echo $id_poliza; ?></td>
    <td align="center"><?php echo $txt_cancela; ?></td>
    <td align="center"><?php echo $id_factura; ?></td>
    <td align="center"><?php if(is_string($UUID)){ echo "Si";} ?></td>
    <td align="center"><?php echo $tipo; ?></td>
  </tr>






  <?php
  }
  ?>
  </table>
  </body>

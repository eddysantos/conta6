<?php
#http://localhost:88/Ubicaciones/Contabilidad/Reportes/contabilidad/libroMayor.php?numreporte=6&Fecha_Inicial=2020-01-01&Fecha_Final=2020-08-31

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
  $libroMayor = 'temconta_libroMayor'.'_'.$fechaActual;
  $detPol = 'temconta_libroMayor_detPol'.'_'.$fechaActual;
  $cargoAbono = 'temconta_libroMayor_detPol_cargoAbono'.'_'.$fechaActual;
  $saldos = 'temconta_libroMayor_Saldos'.'_'.$fechaActual;
  $salIni = 'temconta_libroMayor_SalIni'.'_'.$fechaActual;


  mysqli_query($db,"CREATE TABLE $libroMayor
    SELECT SUBSTRING(pk_id_cuenta,1,4) as ctaMayor,pk_id_cuenta,s_cta_desc as nombre
    from conta_cs_cuentas_mst
    where pk_id_cuenta like '%-00000'");

  mysqli_query($db,"ALTER TABLE $libroMayor ADD COLUMN (n_cargo decimal(19,2),n_abono decimal(19,2),n_saldo decimal(19,2),n_saldoIni decimal(19,2),n_acumCargos decimal(19,2),n_acumAbonos decimal(19,2) )");

  mysqli_query($db,"CREATE TABLE $detPol
    select SUBSTRING(fk_id_cuenta,1,4) as ctaMayor,a.*
    from conta_t_polizas_det a
    INNER JOIN conta_t_polizas_mst b
     ON a.fk_id_poliza = b.pk_id_poliza
    where a.d_fecha between '$Fecha_Inicial' and '$Fecha_Final'");

  mysqli_query($db,"CREATE TABLE $cargoAbono
    select ctaMayor, sum(n_cargo) as n_cargo,sum(n_abono) as n_abono
    from $detPol
    group by ctaMayor");

  mysqli_query($db,"UPDATE $libroMayor INNER JOIN $cargoAbono
  ON $libroMayor.ctaMayor = $cargoAbono.ctaMayor
  SET $libroMayor.n_cargo = $cargoAbono.n_cargo,
  $libroMayor.n_abono = $cargoAbono.n_abono");

  mysqli_query($db,"CREATE TABLE $saldos
  select SUBSTRING(fk_id_cuenta,1,4) as ctaMayor,fk_id_cuenta, SUM(n_cargo) as n_cargos, SUM(n_abono) as n_abonos
  from conta_t_polizas_det
  where d_fecha < '$Fecha_Final'
  group by fk_id_cuenta");

  mysqli_query($db,"CREATE TABLE $salIni
    select ctaMayor,
        case
          when left(fk_id_cuenta, 2) = '01' then (n_cargos - n_abonos)
          when left(fk_id_cuenta, 2) = '05' then (n_cargos - n_abonos)
          when left(fk_id_cuenta, 4) = '0610' then (n_cargos - n_abonos)
          else (n_abonos - n_cargos)
        end as sal_ini
    from $saldos
    group by ctaMayor");


  mysqli_query($link,"UPDATE $libroMayor INNER JOIN $salIni
    ON $libroMayor.ctaMayor = $salIni.ctaMayor
    SET $libroMayor.saldoIni = $salIni.sal_ini");


  $sql_polizas = mysqli_query($db,"SELECT *
  													FROM $libroMayor");

  $totalLineas = 0;
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Libro Mayor</title>
  </head>

  <body>
  <table border="0" width="100%" cellspacing="1" style="font-family: Trebuchet MS; font-size:10pt;">
  	<tr>
  		<td width="20%" colspan="2" rowspan="3" align="center"><img src="/Resources/imagenes/s_rojo.svg" style=' width: 45px;'></td>
  		<td colspan="8" align="right"><b>Proyecci&oacute;n Log&iacute;stica Agencia Aduanal S.A. de C.V.</b></td>
  	</tr>
  	<tr>
  		<td width="60%" colspan="6" style="text-align: center"><b>Libro Mayor</b></td>
  		<td width="20%">&nbsp;</td>
  		<td width="10%">&nbsp;</td>
  	</tr>
  	<tr>
  		<td width="60%" colspan="6" align="center"><b>&nbsp;&nbsp;<?php echo date_format(date_create($Fecha_Inicial),"d-m-Y "); ?>&nbsp;al&nbsp;<?php echo date_format(date_create($Fecha_Final),"d-m-Y "); ?></b></td>
  		<td width="20%" colspan="2" align="right">&nbsp;</td>
  	</tr>
  	<tr>
  		<td width="20%">&nbsp;</td>
  		<td width="10%">&nbsp;</td>
  		<td width="60%">&nbsp;</td>
  		<td width="10%">&nbsp;</td>
  		<td width="10%">&nbsp;</td>
  		<td width="10%">&nbsp;</td>
  		<td width="10%">&nbsp;</td>
  		<td width="30%">&nbsp;</td>
  		<td width="20%">&nbsp;</td>
  		<td width="10%">&nbsp;</td>
  	</tr>
  </table>
  <br>
  <table border="0" width="100%" cellspacing="1" style="font-family: Trebuchet MS; font-size:10pt;">
  	<tr align="center" bgcolor="#CCCCCC">
  		<td>CUENTA</td>
  		<td>NOMBRE</td>
  		<td>CARGO</td>
  		<td>ABONO</td>
  		<td>SALDO INICIAL</td>
  	</tr>

  <?php
  while($oRst_polizas = mysqli_fetch_array($sql_polizas)){
  	$totalLineas = $totalLineas + 1;
  ?>
  	<tr <?php if($totalLineas%2==0){ echo 'bgcolor="#E6EEEE"'; }?>>
  		<td><?php echo $oRst_polizas['pk_id_cuenta'];?></td>
  		<td><?php echo utf8_encode($oRst_polizas['nombre']);?></td>
  		<td align="right"><?php echo number_format($oRst_polizas['n_cargo'],2,'.',',');?></td>
  		<td align="right"><?php echo number_format($oRst_polizas['n_abono'],2,'.',',');?></td>
  		<td align="right"><?php echo number_format($oRst_polizas['n_saldoIni'],2,'.',',');?></td>
  	</tr>
  <?php } ?>
  </table>
  </body>
  </html>
<?php
  $lst_tablas = $libroMayor.','.$detPol.','.$cargoAbono.','.$saldos.','.$salIni;
	require $root . '/Ubicaciones/Contabilidad/Reportes/actions/borrarTablas.php';
}
?>

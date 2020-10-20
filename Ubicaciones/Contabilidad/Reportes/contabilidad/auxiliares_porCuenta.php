<?php
#http://localhost:88/Ubicaciones/Contabilidad/Reportes/contabilidad/auxiliares_porCuenta.php?numreporte=7&Oficina=240&Fecha_Inicial=2018-05-23&Fecha_Final=2020-08-31&Cta_Inicial=0100-00001&Cta_Final=0100-00006

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$Oficina = trim($_GET['Oficina']);
$Fecha_Final = trim($_GET['Fecha_Final']);
$Fecha_Final = date_format(date_create($Fecha_Final),"Y/m/d H:i:s");
$Fecha_Inicial = trim($_GET['Fecha_Inicial']);
$Fecha_Inicial = date_format(date_create($Fecha_Inicial),"Y/m/d H:i:s");
$Cta_Inicial = trim($_GET['Cta_Inicial']);
$Cta_Final = trim($_GET['Cta_Final']);
$numreporte = trim($_GET['numreporte']);


$ctaIni = explode('-',$Cta_Inicial);
$ctaFin = explode('-',$Cta_Final);
$parte = '';
?>

<html>
<head>
<title>AUXILIARES</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 </head>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" >
<table width="100%" style="font-family: Trebuchet MS; font-size:8pt;" align=center>
	<tr>
		<td rowspan="4" width="10%"><img src="/Resources/imagenes/s_rojo.svg" style=' width: 45px;'></td>
		<td colspan="12" align="center" style="font-size:10pt;"><b>Proyección Logística Agencia Aduanal S.A. de C.V.</b></td>
	</tr>
	<tr>
		<td colspan="12"style="text-align: center"><b> Impresión de Auxiliares</b></td>
	</tr>
	<tr>
		<td colspan="12" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="12" align="center"><b>Periodo del&nbsp;<?php echo date_format(date_create($Fecha_Inicial),"d-m-Y "); ?>&nbsp;al&nbsp;<?php echo date_format(date_create($Fecha_Final),"d-m-Y "); ?></b></td>
	</tr>
</table>

<?php
for ($i = $ctaIni[1]; $i <= $ctaFin[1]; $i++) {
	$cuenta = $ctaIni[0].'-'.str_pad($i,5, '0', STR_PAD_LEFT);
  $parte .= 'pol_cuenta = '.$cuenta.',';

	$oRst_Cuenta = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM conta_cs_cuentas_mst WHERE pk_id_cuenta = '$cuenta'"));


	if( $Oficina == 1 ){
		$sSQL_Saldos_Iniciales = mysqli_query($db,"SELECT ifnull(SUM(TRUNCATE(n_cargo,2)),0) Cargos, ifnull(SUM(TRUNCATE(n_abono,2)),0) Abonos
                                               FROM conta_t_polizas_det
						                                   WHERE fk_id_cuenta = '$cuenta' AND d_fecha <  '$Fecha_Inicial'");

		$sSQL_Auxiliares = mysqli_query($db,"SELECT b.fk_id_aduana, b.s_cancela, a.fk_id_poliza, a.fk_id_cuenta, a.d_fecha, a.fk_tipo,
                                          a.fk_referencia,a.fk_id_cliente, a.s_folioCFDIext,
                                          a.fk_factura, a.fk_anticipo, a.fk_cheque, a.fk_nc, a.s_desc, a.fk_pago, a.fk_ctagastos,
                                          TRUNCATE(a.n_cargo,2) AS n_cargo,TRUNCATE(a.n_abono,2) AS n_abono,a.pk_partida, b.fk_usuario
                                          FROM conta_t_polizas_det a
                                          INNER JOIN conta_t_polizas_mst b
                                           ON a.fk_id_poliza = b.pk_id_poliza
                                          WHERE a.fk_id_cuenta = '$cuenta'
                                          AND a.d_fecha Between '$Fecha_Inicial' And '$Fecha_Final'
                                          order by a.d_fecha");
	}else{
		$sSQL_Saldos_Iniciales = mysqli_query($db,"SELECT SUM(TRUNCATE(a.n_cargo,2)) AS Cargos, SUM(TRUNCATE(a.n_abono,2)) AS Abonos
                                              FROM conta_t_polizas_det a
                                              INNER JOIN conta_t_polizas_mst b
                                               ON a.fk_id_poliza = b.pk_id_poliza
                                              WHERE a.fk_id_cuenta = '$cuenta' and b.fk_id_aduana = $Oficina
                                              AND a.d_fecha Between '$Fecha_Inicial' And '$Fecha_Final'");

		$sSQL_Auxiliares = mysqli_query($db,"SELECT b.fk_id_aduana, b.s_cancela, a.fk_id_poliza, a.fk_id_cuenta, a.d_fecha, a.fk_tipo,
                                          a.fk_referencia,a.fk_id_cliente, a.s_folioCFDIext,
                                          a.fk_factura, a.fk_anticipo, a.fk_cheque, a.fk_nc, a.s_desc, a.fk_pago, a.fk_ctagastos,
                                          TRUNCATE(a.n_cargo,2) AS n_cargo,TRUNCATE(a.n_abono,2) AS n_abono,a.pk_partida, b.fk_usuario
                                          FROM conta_t_polizas_det a
                                          INNER JOIN conta_t_polizas_mst b
                                           ON a.fk_id_poliza = b.pk_id_poliza
                                          WHERE a.fk_id_cuenta = '$cuenta' and b.fk_id_aduana = $Oficina
                                          AND a.d_fecha Between '$Fecha_Inicial' And '$Fecha_Final'
                                          order by a.d_fecha");
	}

	$total_Auxiliares = mysqli_num_rows($sSQL_Auxiliares);

	$oRst_Saldos_Iniciales = mysqli_fetch_array($sSQL_Saldos_Iniciales);


  if( is_null($oRst_Saldos_Iniciales['Cargos']) ){
	$SIC = "0.00";
  }else{
    $SIC = number_format($oRst_Saldos_Iniciales['Cargos'],2,'.',',');
  }

  if( is_null ($oRst_Saldos_Iniciales['Abonos']) ){
  	$SIA = "0.00";
  }else{
       $SIA = number_format($oRst_Saldos_Iniciales['Abonos'],2,'.',',');
  }

 $Nombre_Cuenta = $oRst_Cuenta['s_cta_desc'];
?>


<table border="0" width="100%" cellspacing="1" cellpadding="1">
	<tr style="font-family:Trebuchet MS; font-size: 8pt;">
		<td colspan="15"><b>Cuenta:&nbsp;<?php echo $Nombre_Cuenta; ?>&nbsp;--&nbsp;<?php echo $cuenta; ?></b></td>
		<td align=right><b>Saldo Anterior:</b></td>
		<td align=right><?php echo $SIC; ?></td>
		<td align=right><?php echo $SIA; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr bgcolor="#7F7F7F" align=center style="font-family:Trebuchet MS; font-size: 8pt;color:#FFFFFF">
		<td width="5%">CANCELA</td>
		<td width="5%">PARTIDA</td>
		<td width="5%">POL</td>
		<td width="2%">&nbsp;OF&nbsp;</td>
		<td width="8%">FECHA</td>
		<td width="2%">TIPO</td>
		<td width="8%">REF</td>
		<td width="8%">CLT</td>
		<td width="5%">DOC</td>
		<td width="5%">CTAGTO</td>
		<td width="5%">FAC</td>
		<td width="5%">PGO</td>
		<td width="5%">NC</td>
		<td width="5%">ANT</td>
		<td width="5%">CHE</td>

		<td width="27%">DESCRIPCION</td>
		<td width="8%">CARGO</td>
		<td width="8%">ABONO</td>
		<td>GASTO OFICINA</td>
		<td>PROVEEDOR</td>
		<td>USUARIO</td>
	</tr>
<?php
$TOTAL_SUMA_CARGOS = 0;
$TOTAL_SUMA_ABONOS = 0;
$Saldo = 0;

if( $total_Auxiliares > 0 ){
  	while( $oRst_Auxiliares = mysqli_fetch_array($sSQL_Auxiliares) ){
  	 	$TOTAL_SUMA_CARGOS = number_format( $TOTAL_SUMA_CARGOS + number_format($oRst_Auxiliares['n_cargo'],2,'.','') ,2,'.','');
		  $TOTAL_SUMA_ABONOS = number_format( $TOTAL_SUMA_ABONOS + number_format($oRst_Auxiliares['n_abono'],2,'.','') ,2,'.','');
      $Saldo = $TOTAL_SUMA_CARGOS - $TOTAL_SUMA_ABONOS;

  		$pol_cancela = $oRst_Auxiliares['s_cancela'];
		  $pol_partida = $oRst_Auxiliares['pk_partida'];
      $proveedor = $oRst_Auxiliares['fk_id_proveedor'];
      $pol_usuario = $oRst_Auxiliares['fk_usuario'];
?>
	<tr style="font-family:Trebuchet MS; font-size: 8pt; text-align: center" <?php if( $pol_cancela > 0 ){ ?> bgcolor="#F99EA0" <?php } ?>>
		<td><?php echo $pol_cancela; ?></td>
		<td><?php echo trim($oRst_Auxiliares['pk_partida']); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_id_poliza']); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_id_aduana']); ?></td>
		<td><?php echo date_format(date_create($oRst_Auxiliares['pol_fecha']),"d-m-Y "); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_tipo']); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_referencia']); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_id_cliente']); ?></td>
		<td><?php echo trim($oRst_Auxiliares['s_folioCFDIext']); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_ctagastos']); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_factura']); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_pago']); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_nc']); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_anticipo']); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_cheque']); ?></td>
		<td align="left"><?php echo $oRst_Auxiliares['s_desc']; ?></td>
		<td align="right"><?php echo number_format($oRst_Auxiliares['n_cargo'],2,'.',','); ?></td>
		<td align="right"><?php echo number_format($oRst_Auxiliares['n_abono'],2,'.',','); ?></td>
		<td><?php echo trim($oRst_Auxiliares['fk_gastoAduana']); ?></td>
    <td align="left">
    <?php
    if( $proveedor > 0 ){
      $sql_Partida_Prov = mysqli_query($db,"SELECT s_nombre FROM conta_cs_proveedores WHERE pk_id_proveedor = $proveedor");
      $total_Partida_Prov = mysqli_num_rows($sql_Partida_Prov);
      if( $total_Partida_Prov > 0 ){
        $oRst_Partida_Prov = mysqli_fetch_array($sql_Partida_Prov);
        echo $oRst_Partida_Prov['s_nombre'];
      }
    }
    ?>
    </td>
    <td><?php echo $pol_usuario; ?></td>
	</tr>


<?php
    }
}
?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td style="font-family: Trebuchet MS; font-size: 8pt; color: #000000; border-left-width:1px; border-right-width:1px; border-top-style:solid; border-top-width:1px; border-bottom-width:1px" align="right">
		<?php	echo number_format($TOTAL_SUMA_CARGOS,2,'.',',');?></td>
		<td width="7%" style="font-family: Trebuchet MS; font-size: 8pt; color: #000000; border-left-width:1px; border-right-width:1px; border-top-style:solid; border-top-width:1px; border-bottom-width:1px" align="right">
		<?php echo number_format($TOTAL_SUMA_ABONOS,2,'.',',');?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td style="font-family: Trebuchet MS; font-size: 8pt; color: #000000" align="right"><b>Saldo de la Cuenta</b></td>
		<td style="font-family: Trebuchet MS; font-size: 8pt; color: #000000; border-left-width:1px; border-right-width:1px; border-top-style:solid; border-top-width:1px; border-bottom-width:1px" align="right" colspan="2">
		<?php echo number_format($Saldo,2,'.',',');?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

</table>
<?php } ?>
</body>
</html>

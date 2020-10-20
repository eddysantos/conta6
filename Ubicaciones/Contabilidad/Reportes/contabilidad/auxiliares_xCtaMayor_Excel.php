<?php
#http://localhost:88/Ubicaciones/Contabilidad/Reportes/contabilidad/auxiliares_xCtaMayor_Excel.php?numreporte=2&Oficina=470&Fecha_Inicial=2018-05-23&Fecha_Final=2020-08-31&Cta_Inicial=0100

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$Oficina = trim($_GET['Oficina']);
$Fecha_Final = trim($_GET['Fecha_Final']);
$Fecha_Final = date_format(date_create($Fecha_Final),"Y/m/d H:i:s");
$Fecha_Inicial = trim($_GET['Fecha_Inicial']);
$Fecha_Inicial = date_format(date_create($Fecha_Inicial),"Y/m/d H:i:s");
$Cta_Ini = trim($_GET['Cta_Inicial']);
$Cta_Inicial = $Cta_Ini.'-00000';
$Cta_Ini = $Cta_Ini.'%';
$numreporte = trim($_GET['numreporte']);

require $root . '/Ubicaciones/Contabilidad/Reportes/actions/consultaPermisosReportes.php';
if (  $oRst_permisos['s_contabilidad_todos'] == 1 || $rslt_permisosReportes->num_rows > 0) {


  require $root . '/Ubicaciones/Contabilidad/Reportes/actions/consulta_cuentas.php';
  $row_cuentas_mst = $rslt_cuentas_mst->fetch_assoc();
  $Nombre_Cuenta = $row_cuentas_mst['s_cta_desc'];

  if( $Oficina == 1 ){
    require $root . '/Ubicaciones/Contabilidad/Reportes/actions/saldosIniciales_cta_like.php';
    require $root . '/Ubicaciones/Contabilidad/Reportes/actions/consultaDetallePoliza_like.php';
  }else{
    require $root . '/Ubicaciones/Contabilidad/Reportes/actions/saldosIniciales_ctaOficina_like.php';
    require $root . '/Ubicaciones/Contabilidad/Reportes/actions/consultaDetallePoliza_oficina_like.php';
  }


  $row_saldoInicial = $rslt_saldoInicial->fetch_assoc();
  $SI_cargos = $row_saldoInicial['Cargos'];
  $SI_abonos = $row_saldoInicial['Abonos'];

  if( is_null($SI_cargos) ){
    $SIC = "0.00";
  }else{
     $SIC = number_format($SI_cargos,2,'.',',');
  }

  if( is_null($SI_abonos) ){
    $SIA = "0.00";
  }else{
    $SIA = number_format($SI_abonos,2,'.',',');
  }

  $TOTAL_SUMA_CARGOS = 0;
  $TOTAL_SUMA_ABONOS = 0;

  ?>
  <table width="100%" style="font-family: Trebuchet MS; font-size:8pt;" align=center>
  	<tr>
  		<td rowspan="4" width="10%"><img src="/Resources/imagenes/s_rojo.svg" style=' width: 45px;'></td>
  		<td colspan="12" align="center" style="font-size:10pt;"><b>Proyección Logística Agencia Aduanal S.A. de C.V.</b></td>
  	</tr>
  	<tr>
  		<td colspan="12"style="text-align: center"><?php
  		if( $Oficina == 1 ){ $Nombre_Oficina = "TODAS LAS OFICINAS"; }
  		if( $Oficina == 160 ){ $Nombre_Oficina = "MANZANILLO"; }
  		if( $Oficina == 240 ){ $Nombre_Oficina = "NUEVO LAREDO"; }
  		if( $Oficina == 430 ){ $Nombre_Oficina = "VERACRUZ"; }
  		if( $Oficina == 470 ){ $Nombre_Oficina = "AEROPUERTO"; }
  		echo $Nombre_Oficina; ?><b> Impresión de Auxiliares</b></td>
  	</tr>
  	<tr>
  		<td colspan="12" align="center"><b>Cuenta:&nbsp;<?php echo $Nombre_Cuenta; ?>&nbsp;--&nbsp;<?php echo $Cta_Inicial; ?></b></td>
  	</tr>
  	<tr>
  		<td colspan="12" align="center"><b>Periodo del&nbsp;<?php echo date_format(date_create($Fecha_Inicial),"d-m-Y "); ?>&nbsp;al&nbsp;<?php echo date_format(date_create($Fecha_Final),"d-m-Y "); ?></b></td>
  	</tr>
  </table>
  <table border="0" width="100%" cellspacing="1" cellpadding="1">
  	<tr style="font-family:Trebuchet MS; font-size: 8pt;">
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
  		<td align=right><b>Saldo Anterior:</b></td>
  		<td align=right><?php echo $SIC; ?></td>
  		<td align=right><?php echo $SIA; ?></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  	</tr>
  	<tr bgcolor="#7F7F7F" align=center style="font-family:Trebuchet MS; font-size: 8pt;color:#FFFFFF">
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
    if ($rslt_detallePol->num_rows > 0) {
      while ($row_detallePol = $rslt_detallePol->fetch_assoc()) {
        $id_poliza = $row_detallePol['fk_id_poliza'];
        $cuenta = $row_detallePol['fk_id_cuenta'];
        $fecha = $row_detallePol['d_fecha'];
        $tipo = $row_detallePol['fk_tipo'];
        $referencia = $row_detallePol['fk_referencia'];
        $id_cliente = $row_detallePol['fk_id_cliente'];
        $folioCFDI = $row_detallePol['s_folioCFDIext'];
        $anticipo = $row_detallePol['fk_anticipo'];
        $cheque = $row_detallePol['fk_cheque'];
        $ctagastos = $row_detallePol['fk_ctagastos'];
        $factura = $row_detallePol['fk_factura'];
        $pago = $row_detallePol['fk_pago'];
        $nc = $row_detallePol['fk_nc'];
        $desc = $row_detallePol['s_desc'];
        $cargo = $row_detallePol['n_cargo'];
        $abono = $row_detallePol['n_abono'];
        $cargo_cancela = $row_detallePol['n_cargo_cancela'];
        $abono_cancela = $row_detallePol['n_abono_cancela'];
        $partida = $row_detallePol['pk_partida'];
        $gastoaduana = $row_detallePol['fk_gastoAduana'];
        $proveedor = $row_detallePol['fk_id_proveedor'];
        $iddocumento = $row_detallePol['s_idDocumento'];
        $idregistro = $row_detallePol['fk_idRegistro'];
        $pol_usuario = $row_detallePol['fk_usuario'];
        $fecha_modifi = $row_detallePol['d_fecha_ultmodif'];

        $cancela = $row_detallePol['s_cancela'];
        $id_aduana = $row_detallePol['fk_id_aduana'];

        $TOTAL_SUMA_CARGOS = number_format( $TOTAL_SUMA_CARGOS + number_format($cargo,2,'.','') ,2,'.','');
    		$TOTAL_SUMA_ABONOS = number_format( $TOTAL_SUMA_ABONOS + number_format($abono,2,'.','') ,2,'.','');

  ?>
        <tr style="font-family:Trebuchet MS; font-size: 8pt; text-align: center" <?php if( $cancela > 0 ){ ?> bgcolor="#F99EA0" <?php } ?>>
          <td><?php echo $partida; ?></td>
          <td><?php echo $id_poliza; ?></td>
          <td><?php echo $id_aduana; ?></td>
          <td><?php echo date_format(date_create($fecha),"d-m-Y "); ?></td>
          <td><?php echo $tipo; ?></td>
          <td><?php echo $referencia ?></td>
          <td><?php echo $id_cliente; ?></td>
          <td><?php echo $folioCFDI; ?></td>
          <td><?php echo $ctagastos; ?></td>
          <td><?php echo $factura; ?></td>
          <td><?php echo $pago; ?></td>
          <td><?php echo $nc; ?></td>
          <td><?php echo $anticipo; ?></td>
          <td><?php echo $cheque; ?></td>
          <td align="left"><?php echo $desc; ?></td>
          <td align="right"><?php echo number_format($cargo,2,'.',','); ?></td>
          <td align="right"><?php echo number_format($abono,2,'.',','); ?></td>
          <td><?php echo $gastoaduana; ?></td>
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

    $TOTAL_SUMA_CARGOS = number_format(  number_format($SI_cargos,2,'.','') + number_format($TOTAL_SUMA_CARGOS,2,'.','') ,2,'.','');
    $TOTAL_SUMA_ABONOS = number_format(  number_format($SI_abonos,2,'.','') + number_format($TOTAL_SUMA_ABONOS,2,'.',''),2,'.','');
    $Saldo = $TOTAL_SUMA_CARGOS - $TOTAL_SUMA_ABONOS;
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
    <td style="font-family: Trebuchet MS; font-size: 8pt; color: #000000; border-left-width:1px; border-right-width:1px; border-top-style:solid; border-top-width:1px; border-bottom-width:1px" align="right">
      <?php echo number_format($TOTAL_SUMA_CARGOS,2,'.',',');?>
    </td>
    <td width="7%" style="font-family: Trebuchet MS; font-size: 8pt; color: #000000; border-left-width:1px; border-right-width:1px; border-top-style:solid; border-top-width:1px; border-bottom-width:1px" align="right">
      <?php echo number_format($TOTAL_SUMA_ABONOS,2,'.',',');?>
    </td>
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
    <td style="font-family: Trebuchet MS; font-size: 8pt; color: #000000" align="right"><b>Saldo de la Cuenta</b></td>
    <td style="font-family: Trebuchet MS; font-size: 8pt; color: #000000; border-left-width:1px; border-right-width:1px; border-top-style:solid; border-top-width:1px; border-bottom-width:1px" align="right" colspan="2">
    <?php echo number_format($Saldo,2,'.',',');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<?php
} #fin permiso reporte
?>

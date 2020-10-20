<?php
#http://localhost:88/Ubicaciones/Contabilidad/Reportes/cobranza/detallePagosAnticipos_porCliente.php?numreporte=9&Oficina=240&Fecha_Inicial=2020-01-01&Fecha_Final=2020-08-31&id_cliente=CLT_6840
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$Oficina = trim($_GET['Oficina']);
$id_cliente = trim($_GET['id_cliente']);
$Fecha_Final = trim($_GET['Fecha_Final']);
$Fecha_Final = date_format(date_create($Fecha_Final),"Y/m/d H:i:s");
$Fecha_Inicial = trim($_GET['Fecha_Inicial']);
$Fecha_Inicial = date_format(date_create($Fecha_Inicial),"Y/m/d H:i:s");
$numreporte = trim($_GET['numreporte']);

require $root . '/Ubicaciones/Contabilidad/Reportes/actions/consultaPermisosReportes.php';
if (  $oRst_permisos['s_contabilidad_todos'] == 1 || $rslt_permisosReportes->num_rows > 0) {
  if($Oficina == 160){$likeOficina = "M";}
  if($Oficina == 240){$likeOficina = "N";}
  if($Oficina == 430){$likeOficina = "V";}
  if($Oficina == 470){$likeOficina = "A";}

  require $root . '/Resources/PHP/actions/consultaDatosCliente.php'; # $nom_cliente

  if($Oficina == "Todos"){
    $consultaAduana = '';
  }else{
    $consultaAduana = ' and b.fk_id_aduana = $Oficina ';
  }



		$sql_Referencia = mysqli_query($db,"SELECT b.fk_referencia, s_imp_exp, s_conceptoEsp, a.d_fecha_fac, a.pk_id_factura, b.n_fac_saldo, n_total_depositos, a.fk_id_poliza
                                        FROM conta_t_facturas_cfdi a
                                        INNER JOIN conta_t_facturas_captura b
                                        	ON a.fk_id_cuenta_captura = b.pk_id_cuenta_captura
                                        INNER JOIN conta_t_facturas_captura_det c
                                        	ON c.fk_id_cuenta_captura = b.pk_id_cuenta_captura
                                        WHERE b.fk_id_cliente= '$id_cliente' AND (a.d_fecha_fac BETWEEN '$Fecha_Inicial' and '$Fecha_Final') AND a.s_selloSATcancela is null
                                        	and c.s_tipoDetalle = 'DatGnEmbarq' and s_conceptoEsp = 'Descripción General:%' $consultaAduana
                                        ORDER BY s_nombre, d_fecha_fac");

		$sql_notaCred = mysqli_query($db,"SELECT b.fk_referencia, s_imp_exp, s_conceptoEsp, a.d_fecha_fac, a.pk_id_notacredito, b.n_fac_saldo, n_total_depositos, b.fk_id_factura
                                      FROM conta_t_notacredito_cfdi a
                                      INNER JOIN conta_t_notacredito_captura b
                                      	ON a.fk_id_cuenta_captura_nc = b.pk_id_cuenta_captura_nc
                                      INNER JOIN conta_t_notacredito_captura_det c
                                      	ON c.fk_id_cuenta_captura_nc = b.pk_id_cuenta_captura_nc
                                      WHERE b.fk_id_cliente= '$id_cliente' AND (a.d_fecha_fac BETWEEN '$Fecha_Inicial' and '$Fecha_Final') AND a.s_selloSATcancela is null
                                      	and c.s_tipoDetalle = 'DatGnEmbarq' and s_conceptoEsp like 'Descripción General:%' $consultaAduana
                                      ORDER BY s_nombre, d_fecha_fac");

		$sql_Anticipo = mysqli_query($db,"SELECT a.fk_anticipo, a.fk_referencia, (SUM(n_abono) - SUM(n_cargo)) as importe
                                      FROM conta_t_polizas_det a
                                      INNER JOIN conta_t_polizas_mst b
                                      	ON a.fk_id_poliza = b.pk_id_poliza
                                      WHERE a.d_fecha between '$Fecha_Inicial' and '$Fecha_Final'  and a.fk_id_cuenta  LIKE '0208%' and a.fk_id_cliente = '$id_cliente'
                                        $consultaAduana and  a.fk_referencia LIKE '$likeOficina%'
                                      GROUP BY a.fk_anticipo, a.fk_referencia
                                      ORDER BY abs(fk_anticipo)");


?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte de Facturaci&oacute;n por Cliente</title>
	<style>
		@import url('https://fonts.googleapis.com/css?family=Barlow:100,300,400,500,600,700,800&display=swap');
		.fontBarlow{
			font-family: 'Barlow', sans-serif!important;
		}
	</style>
</head>

<body>
<table class='fontBarlow' width="100%" style="font-size:10pt;" align=center>
  <tr>
    <td width="60%"><img border="0" src="/Resources/imagenes/spectrum_worldwide.svg" width="250px"></td>

    <td width="40%" style="text-align: left">
      <b style="color:#ed1c24;font-size:12pt">Reporte de Detalle de pagos y anticipos </b>
      <br><b><?php echo $id_cliente." ".$nom_cliente;?>
      <br> Del <?php echo date_format(date_create($Fecha_Inicial),"d-m-Y");?> al <?php echo date_format(date_create($Fecha_Final),"d-m-Y");?></b>
    </td>
  </tr>
</table>
<br><br>
<table class='fontBarlow' width="100%" border="0" cellspacing="1" cellpadding="1" style="font-size:10pt;" align="center">
  <tr bgcolor="#58595b" style='color:whitesmoke' align="center">
		<td>Referencia</td>
	  <td>Tipo</td>
		<td>Descripción</td>
		<td>Fecha</td>
		<td>Factura</td>
		<td>Nota de Crédito</td>
		<td>Anticipos</td>
		<td>Saldo</td>
		<td>Detalle</td>
		<td>Póliza</td>
  </tr>

  <?php
	while( $oRst_Referencia = mysqli_fetch_array($sql_Referencia)){
    $fecha_fac = date_create($oRst_Referencia['d_fecha_fac']);
    $referencia = $oRst_Referencia['fk_referencia'];
    $factura = $oRst_Referencia['pk_id_factura'];

    $sql_pagado = mysqli_query($db,"SELECT a.*
                                      FROM conta_t_polizas_det a
                                      INNER JOIN conta_t_polizas_mst b
                                      	ON a.fk_id_poliza = b.pk_id_poliza
                                      WHERE (b.s_cancela is null or b.s_cancela = 0) and a.d_fecha between '$Fecha_Inicial' and '$Fecha_Final'
                                        and a.fk_factura = $factura and (fk_tipo = 2 or fk_tipo = 5) and a.fk_id_cuenta LIKE '0108%' and a.fk_referencia = '$referencia'");

    $sql_devolucion = mysqli_query($db,"SELECT a.*
                                    FROM conta_t_polizas_det a
                                    INNER JOIN conta_t_polizas_mst b
                                      ON a.fk_id_poliza = b.pk_id_poliza
                                    WHERE (b.s_cancela is null or b.s_cancela = 0) and a.d_fecha between '$Fecha_Inicial' and '$Fecha_Final'
                                      and a.fk_factura = $factura and (fk_tipo = 1 or fk_tipo = 4) and a.fk_id_cuenta LIKE '0108%' and a.fk_referencia = '$referencia'");

    $totalPagado=mysqli_num_rows($sql_pagado);
    $totalDevol=mysqli_num_rows($sql_devolucion);


    echo "<tr align=center>";
    if($id_cliente == "Todos"){
      echo "<td align=left>".$id_cliente." ".$nom_cliente."</td>";
    }
    echo "<td>".$referencia."</td>
      <td>".$oRst_Referencia['s_imp_exp']."</td>
      <td align=left>".$oRst_Referencia['s_conceptoEsp']."</td>
      <td>".date_format($fecha,"d-m-Y")."</td>
      <td>".$factura."</td>
      <td>&nbsp;</td>
      <td align=right>".number_format($oRst_Referencia['n_total_depositos'],2,'.',',')."</td>
      <td align=right>".number_format($oRst_Referencia['n_fac_saldo'],2,'.',',')."</td>";
    echo	"<td align=left>";
      if($oRst_Referencia['n_fac_saldo'] == 0){
        echo "FACTURA SALDADA</td>";
        echo "<td align=left>".$oRst_Referencia['fk_id_poliza'];
      }else{
        while($pagado = mysqli_fetch_array($sql_pagado)){
          $id_poliza = $pagado['fk_id_poliza'];

          $bancoPagado_sql = mysqli_query($db,"SELECT b.s_cta_desc, a.*, (a.n_abono + a.n_cargo) as importe
                                      FROM conta_t_polizas_det a
                                      INNER JOIN conta_cs_cuentas_mst b
                                      	ON a.fk_id_cuenta = b.pk_id_cuenta
																			WHERE	(fk_tipo = 2 or fk_tipo = 5) and a.fk_id_cuenta LIKE '0100%' and fk_id_poliza = $id_poliza");

          $bancoReg = mysqli_num_rows($bancoPagado_sql);
          if ($bancoReg > 0){
            $bancoPagado = mysqli_fetch_array($bancoPagado_sql);
            $bancoPagadoDesc = $bancoPagado['s_cta_desc'];
            $bancoPagadoCta = trim( preg_replace('/[a-zA-Z]./', '',$bancoPagadoDesc ));
            $bancoPagadoNombre = explode($bancoPagadoCta, $bancoPagadoDesc);

            $bancoPagadoCt = substr($bancoPagadoCta, -4);
          }else{
            $bancoPagadoDesc = "";
            $bancoPagadoCta = "";
            $bancoPagadoNombre = "";

            $bancoPagadoCt = "";

          }
          echo $pagado['s_desc']." ".date_format(date_create($pagado['d_fecha']),"d-m-Y")." ".
             trim($bancoPagadoNombre[0]).$bancoPagadoCt." $".number_format($bancoPagado['importe'],2,'.',',')."</td>";
          echo "<td align=left>".$id_poliza;
        }
        while( $devolucion = mysqli_fetch_array($sql_devolucion)){
          $id_poliza = $devolucion['fk_id_poliza'];
          $tipoPol = $devolucion['fk_tipo'];
          if($tipoPol == 1){ $cheque = " Ch.".$devolucion['fk_cheque']; }else{ $cheque = "";}

          $sql_bancoDevol = mysqli_query($db,"SELECT b.s_cta_desc, a.*, (a.n_abono + a.n_cargo) as importe
                                      FROM conta_t_polizas_det a
                                      INNER JOIN conta_cs_cuentas_mst b
                                      	ON a.fk_id_cuenta = b.pk_id_cuenta
																			WHERE	(fk_tipo = 1 or fk_tipo = 4) and a.fk_id_cuenta LIKE '0100%' and fk_id_poliza = $id_poliza");
          $bancoReg = mysqli_num_rows($sql_bancoDevol);
          if ($bancoReg > 0){
            $bancoDevol = mysqli_fetch_array($sql_bancoDevol);
            $bancoDevolDesc = $bancoDevol['s_cta_desc'];
            $bancoDevolCta = trim( preg_replace('/[a-zA-Z]./', '',$bancoDevolDesc ));
            $bancoDevolNombre = explode($bancoDevolCta, $bancoDevolDesc);

            $bancoDevolCt = substr($bancoDevolCta, -4);
          }else{
            $bancoPagadoDesc = "";
            $bancoPagadoCta = "";
            $bancoPagadoNombre = "";

            $bancoPagadoCt = "";

          }

          echo $devolucion['s_desc']." ".date_format(date_create($devolucion['d_fecha']),"d-m-Y")." ".
            trim($bancoDevolNombre[0]).$bancoDevolCt.$cheque." $".number_format($bancoDevol['importe'],2,'.',',')."</td>";
          echo "<td align=left>".$id_poliza;
        }

        if($totalPagado==0 && $totalDevol==0){
          echo "FACTURA PENDIENTE DE SALDAR</td>";
          echo "<td align=left>".$oRst_Referencia['fk_id_poliza'];
        }
      }
    echo "</td>";
    echo "<td>";
    while( $pagado = mysqli_fetch_array($sql_pagado)){
      echo "Pagado: ".$pagado['fk_id_poliza'];
    }
    echo "</td>";
    echo "</tr>";



  }
  ?>

  <?php while( $oRst_notaCred = mysqli_fetch_array($sql_notaCred)){ ?>
  	<tr align='center'>
  		<td><?php echo $oRst_notaCred['fk_referencia']; ?></td>
  		<td><?php echo $oRst_notaCred['s_imp_exp']; ?></td>
  		<td align="left"><?php echo $oRst_notaCred['s_conceptoEsp']; ?></td>
  		<td><?php echo date_format(date_create($oRst_notaCred['d_fecha_fac']),"d-m-Y"); ?></td>
  		<td><?php echo $oRst_notaCred['fk_id_factura']; ?></td>
  		<td><?php echo $oRst_notaCred['pk_id_notacredito']; ?></td>
  		<td align="right"><?php echo '-'.number_format($oRst_notaCred['n_total_depositos'],2,'.',','); ?></td>
  		<td align="right"><?php echo '-'.number_format($oRst_notaCred['n_fac_saldo'],2,'.',','); ?></td>
  		<td>&nbsp;</td>
  		<td><?php echo $oRst_notaCred['fk_id_poliza']; ?></td>
  	</tr>
  <?php } ?>
  	<tr>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td></td>
  	</tr>
  	<tr>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td>&nbsp;</td>
  		<td></td>
  	</tr>
  <?PHP
  $totalReg = mysqli_num_rows($sql_Anticipo);
  if( $totalReg >0 ){
  ?>
    <tr bgcolor="#58595b" style='color:whitesmoke' align="center">
  		<td>Referencia</td>
  	  <td>Tipo</td>
  		<td>Descripción</td>
  		<td>Fecha</td>
  		<td>Anticipo</td>
  		<td>Importe</td>
  		<td>&nbsp;</td>
  		<td>Detalle de anticipos no aplicados </td>
  		<td>Póliza</td>
    </tr>
  <?php
  	while( $oRst_Anticipo = mysqli_fetch_array($sql_Anticipo)){
  		$importe=$oRst_Anticipo['importe'];

  		if($importe > 0){
  			$anticipo= trim($oRst_Anticipo['fk_anticipo']);

  			$consultaAnticipo = mysqli_fetch_array(mysqli_query($db,"SELECT c.fk_id_poliza,c.d_fecha, b.s_imp_exp, d.s_descripcion
                                      FROM conta_t_anticipos_det a
                                      INNER JOIN conta_replica_referencias b
                                      	ON a.fk_referencia = b.pk_referencia
																			INNER JOIN conta_t_anticipos_mst c
                                      	ON a.fk_id_anticipo = b.pk_id_anticipo
																			WHERE	a.pk_id_anticipo = $anticipo"));

  			$tipo=trim($consultaAnticipo['s_imp_exp']);
  			if($tipo=="I"){$tipo="IMP";}else{$tipo="EXP";}

  			echo "<tr align=center>";
  			echo "<td>".$oRst_Anticipo['fk_referencia']."</td>
  				<td>".$tipo."</td>
  				<td align=left>".trim(substr(preg_replace('/\s\s+/', ' ',$consultaAnticipo['DESCRIPCION']),0,25))."</td>
  				<td>".date_format(date_create($consultaAnticipo['ANT_FECHA']),"d-m-Y")."</td>
  				<td>".$anticipo."</td>
  				<td align=right>".number_format($importe,2,'.',',')."</td>
  				<td>&nbsp;</td>
  				<td align=left>PENDIENTE DE APLICAR</td>";
  			echo "<td>".$consultaAnticipo['ant_poliza']."</td>
  			  </tr>";
  		}
  	}
  }?>




</table>
</body>
</html>
<?php
}#fin permisos
?>

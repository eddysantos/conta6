<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$Poliza = trim($_GET['id_poliza']);
$Accion = trim($_GET['Accion']);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Busca P&oacute;lizas</title>
<head>
	<script type="text/javascript">


		function redireccionar(){
			Tipo = document.tipo_poliza.Lst_Tipo.value;
			Accion = '<?php echo $Accion; ?>';

			if(Tipo > 0){
				if (Tipo == '2'){
					if( Accion == 'modificar' ){ document.location.href="/Conta6/Ubicaciones/Contabilidad/polizas/DetallePoliza.php?id_poliza="+<?php echo $Poliza; ?>+'&tipo='+Tipo}
					if( Accion == 'consultar' ){ document.location.href="/Conta6/Ubicaciones/Contabilidad/polizas/ConsultarPoliza.php?id_poliza="+<?php echo $Poliza; ?> }
					if( Accion == 'proveedor' ){ document.location.href='../../Proveedores/AsignarProveedores.php?Usuario='+<?php echo $usuario; ?>+'&Pol='+<?php echo $Poliza; ?>+'&Oficina='+<?php echo $aduana; ?> }
				}else{
					if( Accion == 'modificar' ){ document.location.href="/Conta6/Ubicaciones/Contabilidad/polizas/DetallePoliza.php?id_poliza="+<?php echo $Poliza; ?>+'&tipo='+Tipo}
					if( Accion == 'consultar' ){ document.location.href="/Conta6/Ubicaciones/Contabilidad/polizas/ConsultarPoliza.php?id_poliza="+<?php echo $Poliza; ?> }
					if( Accion == 'proveedor' ){ document.location.href='../../Proveedores/AsignarProveedores.php?Usuario='+<?php echo $usuario; ?>+'&Pol='+<?php echo $Poliza; ?>+'&Oficina='+<?php echo $aduana; ?> }
				}
			}
		}

		function redirec(Tipo){
			Accion = '<?php echo $Accion; ?>';

			if(Tipo > 0){
				if (Tipo == '2'){
					if( Accion == 'modificar' ){ document.location.href="/Conta6/Ubicaciones/Contabilidad/polizas/DetallePoliza.php?id_poliza="+<?php echo $Poliza; ?>+'&tipo='+Tipo}
					if( Accion == 'consultar' ){ document.location.href="/Conta6/Ubicaciones/Contabilidad/polizas/ConsultarPoliza.php?id_poliza="+<?php echo $Poliza; ?> }
					if( Accion == 'proveedor' ){ document.location.href='../../proveedores/AsignarProveedores.php?Usuario=<?php echo $usuario; ?>'+'&Pol='+<?php echo $Poliza; ?>+'&Oficina='+<?php echo $aduana; ?> }
				}else{
					if( Accion == 'modificar' ){ document.location.href="/Conta6/Ubicaciones/Contabilidad/polizas/DetallePoliza.php?id_poliza="+<?php echo $Poliza; ?>+'&tipo='+Tipo}
					if( Accion == 'consultar' ){ document.location.href="/Conta6/Ubicaciones/Contabilidad/polizas/ConsultarPoliza.php?id_poliza="+<?php echo $Poliza; ?> }
					if( Accion == 'proveedor' ){ document.location.href='../../proveedores/AsignarProveedores.php?Usuario=<?php echo $usuario; ?>'+'&Pol='+<?php echo $Poliza; ?>+'&Oficina='+<?php echo $aduana; ?> }
				}
			}
		}
	</script>
</head>
<?PHP
#'***************************
#'* BUSCO LA POLIZA MAESTRA *
#'***************************
$oRst_POLIZA_MST_sql = mysqli_query($db,"SELECT fk_id_aduana,d_fecha FROM conta_t_polizas_mst WHERE pk_id_poliza = $Poliza ");
$totalRegistros_POLIZA_MST = mysqli_num_rows($oRst_POLIZA_MST_sql);


if( $totalRegistros_POLIZA_MST > 0 ){
  $oRst_POLIZA_MST = mysqli_fetch_array($oRst_POLIZA_MST_sql);
      #'*********************************
  		#'* BUSCO EL DETALLE DE LA POLIZA *
  		#'*********************************
  		$sql_POLIZA_DET = mysqli_query($db,"Select distinct fk_tipo from conta_t_polizas_det Where fk_id_poliza = '$Poliza'");
  		$totalRegistros_POLIZA_DET = mysqli_num_rows($sql_POLIZA_DET);


  	 	if( trim($oRst_POLIZA_MST['fk_id_aduana']) == $aduana && ($Accion == 'modificar' || $Accion == 'proveedor') ){

  			if( $totalRegistros_POLIZA_DET > 0 ){
  				$oRst_POLIZA_DET = mysqli_fetch_array($sql_POLIZA_DET);
  				$Tipo = trim($oRst_POLIZA_DET["fk_tipo"]);

  				if( $Tipo == 1 || $Tipo == 3 || $Tipo == 4 || $Tipo == 5 ){
  					if( $Tipo == 3 ){

  						#'*************************************************************************************************
  						#'* LAS POLIZAS DE TIPO 3 SON DE FACTURAS, TODO LO DE FACTURA ELECTRONICA NO SE PERMITE MODIFICAR *
  						#'*************************************************************************************************
  						$fecha_poliza = strtotime(date_format(date_create($oRst_POLIZA_MST["d_fecha"]),"Y-m-d H:i:s"));
  						$fecha_fac_elect = strtotime("01/01/2011");

  						if( $fecha_poliza < $fecha_fac_elect ){
  							//header('Location: '.$rutaPolDiario);
  							//$ruta = $rutaPolDiario;
  							echo "<body onLoad='redirec(".$Tipo.")'></body>";
  						}else{
  							echo "<br><br><center><font color=#E52727>La p&oacute;liza no puede ser modificada por pertenecer a una <b>FACTURA ELECTR&Oacute;NICA</font></center>";
  						}

  					}
  					if( $Tipo == 1 ){
  						#'*****************************************************************
  						#'* LAS POLIZAS DE TIPO 1 SON DE CHEQUES, NO SE PERMITE MODIFICAR *
  						#'*****************************************************************
  						echo "<br><br><center><font color=#E52727>La p&oacute;liza no puede ser modificada por pertenecer a un <b>CHEQUE</font></center>";
  					}
  					if( $Tipo == 5 ){
  						#'*****************************************************************
  						#'* LAS POLIZAS DE TIPO 5 SON DE ANTICIPOS, NO SE PERMITE MODIFICAR *
  						#'*****************************************************************
  						echo "<br><br><center><font color=#E52727>La p&oacute;liza no puede ser modificada por pertenecer a un <b>ANTICIPO</font></center>";
  					}
  					if( $Tipo == 4 ){
  						#'********************************************************************************
  						#'* LAS POLIZAS DE TIPO 4 PUEDEN PERTENECER A LA NOMINA, NO SE PERMITE MODIFICAR *
  						#'********************************************************************************
  						$sql_POLIZA_nom = mysqli_query($db,"SELECT fk_id_poliza, pol_cancela, fk_id_polizaPago FROM tbl_nom_nominacfdi WHERE fk_id_poliza = $Poliza or pol_cancela = $Poliza or fk_id_polizaPago = $Poliza");
  						$totalRegistros_POLIZA_nom = mysqli_num_rows($sql_POLIZA_nom);
  						if( $totalRegistros_POLIZA_nom > 0 ){
  							if( $sql_Permisos['s_modifica_polizasNomina'] == 1 && $Accion == 'modificar' ){ echo "<body onLoad='redirec(".$Tipo.")'></body>"; }else{
  								if( $sql_Permisos['s_consulta_polizasNomina'] == 1 && $Accion == 'consultar' ){ echo "<body onLoad='redirec(".$Tipo.")'></body>"; }else{
  									if( $sql_Permisos['s_modifica_polizasNomina'] == 1 && $Accion == 'proveedor' ){ echo "<body onLoad='redirec(".$Tipo.")'></body>"; }else{
  										if( $sql_Permisos['s_consulta_polizasNomina'] == 1 && $Accion == 'proveedor' ){ echo "<body onLoad='redirec(".$Tipo.")'></body>"; }else{
  											echo "<br><br><center><font color=#E52727>La p&oacute;liza pertenecer a una <b>N&Oacute;MINA</font></center>";
  										}
  									}
  								}
  							}
  						}else{
  							echo "<body onLoad='redirec(".$Tipo.")'></body>";
  						}
  					}
  				}else{
  					echo "<body onLoad='redirec(".$Tipo.")'></body>";
  				}

  			}else{ ?>
  			<body topmargin="0" leftmargin="0" rightmargin="1" bottommargin="1" marginwidth="1" marginheight="1" bgcolor=#FFFFFF>
  			<form name="tipo_poliza">
  			<table width='100%' border=0 cellpadding=0 cellspacing=0 style='font-family: Trebuchet MS; font-size:10pt; border-collapse:collapse'>
  				<tr>
  					<td>Contabilidad >> P&oacute;lizas >> <b>Modificar</b></td>
  				</tr>
  			</table><hr>
  			<br>
  			     <P align=center>
  				  <select size="1" name="Lst_Tipo" style="font-family: Trebuchet MS; font-size:10pt" onChange="redireccionar()">
  					<option selected value="0">Seleccione un Tipo</option>
  					<option value="2">2- P&oacute;liza de Ingresos</option>
  					<option value="4">4- P&oacute;liza de Diario</option>
  			      </select>
  			      </p>
  			</form>
  			</body>
  			<?PHP }
  		}else{
  			if( $Accion == 'consultar' ){
  				if( $totalRegistros_POLIZA_DET > 0 ){
  					$oRst_POLIZA_DET = mysqli_fetch_array($sql_POLIZA_DET);
  					$Tipo = trim($oRst_POLIZA_DET["fk_tipo"]);

  					if( $Tipo == 4 ){
  						#'********************************************************************************
  						#'* LAS POLIZAS DE TIPO 4 PUEDEN PERTENECER A LA NOMINA, NO SE PERMITE MODIFICAR *
  						#'********************************************************************************
  						$sql_POLIZA_nom = mysqli_query($db,"SELECT fk_id_poliza, pol_cancela, fk_id_polizaPago FROM tbl_nom_nominacfdi WHERE fk_id_poliza = $Poliza or pol_cancela = $Poliza or fk_id_polizaPago = $Poliza");
  						$totalRegistros_POLIZA_nom = mysqli_num_rows($sql_POLIZA_nom);
  						if( $totalRegistros_POLIZA_nom > 0 ){
  							if( $sql_Permisos['s_consulta_polizasNomina'] == 1 && $Accion == 'consultar' ){ echo "<body onLoad='redirec(".$Tipo.")'></body>"; }else{
  								echo "<br><br><center><font color=#E52727>La p&oacute;liza pertenecer a una <b>N&Oacute;MINA</font></center>";
  							}
  						}else{
  							echo "<body onLoad='redirec(".$Tipo.")'></body>";
  						}
  					}else{
  						echo "<body onLoad='redirec(".$Tipo.")'></body>";
  					}

  				}
  			}else{ echo '<p align="center"><u><font face="Trebuchet MS" size="2" align="center">ESTA P&Oacute;LIZA ES DE LA OFICINA '.trim($oRst_POLIZA_MST["fk_id_aduana"]).'</font></u></p>'; }
  		}
}else{echo '<p align="center"><u><font face="Trebuchet MS" size="2" align="center">NO EXISTE LA P&Oacute;LIZA</font></u></p>';}

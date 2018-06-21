<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';

$Poliza = trim($_GET['id_poliza']);
$Accion = trim($_GET['Accion']);
?>

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
						echo "
						<div class='container-fluid pantallaGris'>
							<div class='tituloSinRegistros font16'><font color=#E52727>La póliza no puede ser modificada por pertenecer a una </br> <b>FACTURA ELECTRÓNICA</font></div>
						</div>";
					}
				}

				if( $Tipo == 1 ){
					#'*****************************************************************
					#'* LAS POLIZAS DE TIPO 1 SON DE CHEQUES, NO SE PERMITE MODIFICAR *
					#'*****************************************************************
					echo "
					<div class='container-fluid pantallaGris'>
						<div class='tituloSinRegistros font16'><font color=#E52727>La póliza no puede ser modificada por pertenecer a un </br> <b>CHEQUE</font></div>
					</div>";
				}

				if( $Tipo == 5 ){
					#'*****************************************************************
					#'* LAS POLIZAS DE TIPO 5 SON DE ANTICIPOS, NO SE PERMITE MODIFICAR *
					#'*****************************************************************
					echo "
					<div class='container-fluid pantallaGris'>
						<div class='tituloSinRegistros font16'><font color=#E52727>La póliza no puede ser modificada por pertenecer a un </br> <b>ANTICIPO</font></div>
					</div>";
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
										echo "

										<div class='container-fluid pantallaGris'>
								      <div class='tituloSinRegistros font16'><font color=#E52727>La póliza pertenece a una </br> <b>NÓMINA</font></div>
								    </div>";
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
			}}else{ ?>
				<form name="tipo_poliza">
	  			<table class="table">
						<tr class="row mt-5">
							<td class="col-md-4 offset-md-4">
								<select class="custom-select" name="Lst_Tipo" onChange="redireccionar()">
			  					<option selected value="0">Seleccione un Tipo</option>
			  					<option value="2">2- Póliza de Ingresos</option>
			  					<option value="4">4- Póliza de Diario</option>
	  			      </select>
							</td>
						</tr>
	  			</table>
				 </form>
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
  								echo "
									<div class='container-fluid pantallaGris'>
							      <div class='tituloSinRegistros font16'><font color=#E52727>La póliza pertenece a una </br> <b>NÓMINA</font></div>
							    </div>";
								}
							}else{
  							echo "<body onLoad='redirec(".$Tipo.")'></body>";
  						}
						}else{
  						echo "<body onLoad='redirec(".$Tipo.")'></body>";
						}
					}
				}else{ echo '
					<div class="container-fluid pantallaGris">
			      <div class="tituloSinRegistros font16"><font color=#E52727>ESTA PÓLIZA ES DE LA OFICINA '.trim($oRst_POLIZA_MST["fk_id_aduana"]).'</font></div>
			    </div>';
				}
			}
		}else{echo '
			<div class="container-fluid pantallaGris">
	      <div class="tituloSinRegistros font18"><font color=#E52727>LA PÓLIZA NO EXISTE</font></div>
	    </div>';
		}

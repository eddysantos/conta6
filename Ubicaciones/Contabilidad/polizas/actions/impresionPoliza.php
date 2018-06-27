<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';


$id_poliza = trim($_GET['id_poliza']);
$aduana = trim($_GET['aduana']);

$oRst_Select = mysqli_query($db,"Select * from conta_t_polizas_mst Where pk_id_poliza = $id_poliza AND fk_id_aduana = $aduana");
$totalRegistrosSelect = mysqli_num_rows($oRst_Select);
$oRst_Select = mysqli_fetch_array($oRst_Select);

$oRst_POLDET_sql = mysqli_query($db,"select * from conta_t_polizas_det where fk_id_poliza = $id_poliza order by pk_partida");
$totalRegistrosPOLDET = mysqli_num_rows($oRst_POLDET_sql);

$oRst_STPD = mysqli_query($db,"select fk_id_poliza,SUM(n_cargo)as SUMA_CARGOS,SUM(n_abono)as SUMA_ABONOS from conta_t_polizas_det where fk_id_poliza = $id_poliza group by fk_id_poliza ");
$totalRegistrosSTPD = mysqli_num_rows($oRst_STPD);
$oRst_STPD = mysqli_fetch_array($oRst_STPD);

if( $totalRegistrosSTPD > 0 ){
	$Status_Poliza = number_format($oRst_STPD["SUMA_CARGOS"] - $oRst_STPD["SUMA_ABONOS"],2,'.',',');
}
?>

<?php
	 if( $totalRegistrosSelect > 0 ){

	 $cancela = $oRst_Select["s_cancela"];
	 if( $cancela == 1 ){ $txt_cancela = "Póliza Cancelada";}else{$txt_cancela = "";}
?>

<div class="text-center mb-10">
	<div class="contorno mt-5">
		<div class="row">
			<div class="col-md-12">
				<h4>Proyección Logística Agencia Aduanal S.A. de C.V.</h4>
			</div>
		</div>

		<table class="table text-center mt-4">
			<thead class="">
				<tr class="row encabezado">
					<th class="col-md-2">Fecha de Póliza</th>
					<th class="col-md-2">Usuario que Capturo</th>
					<th class="col-md-2">Fecha de Captura</th>
					<th class="col-md-5">Concepto</th>
					<th class="col-md-1">Póliza</th>
				</tr>
			</thead>
			<tbody>
				<tr class="row">
					<td class="col-md-2"><?php if (!is_null($oRst_Select["d_fecha"])){ echo date_format(date_create($oRst_Select["d_fecha"]),"d/m/Y"); }?></td>
					<td class="col-md-2"><?php echo trim($oRst_Select["fk_usuario"]); ?></td>
					<td class="col-md-2"><?php if (!is_null($oRst_Select["d_fecha_alta"])){ echo date_format(date_create($oRst_Select["d_fecha_alta"]),"d-m-Y H:i:s"); }?></td>
					<td class="col-md-5"><?php echo trim($oRst_Select["s_concepto"]); ?></td>
					<td class="col-md-1"><?php echo $id_poliza; ?></td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="contorno mt-5 text-center">
		<table class="table">
			<thead>
				<tr class="sub2 font12">
					<th>Tipo</th>
					<th>Cuenta</th>
					<th>Ref.</th>
					<th>Cliente</th>
					<th>Doc.</th>
					<th>Fact.</th>
					<th>Cta.Gastos</th>
					<th>P.E.</th>
					<th>N.C.</th>
					<th>Cheque</th>
					<th>Descripción</th>
					<th>Cargo</th>
					<th>Abono</th>
				</tr>
			</thead>

			<tbody>
				<?php
					if( $totalRegistrosPOLDET > 0 ){
						while ($oRst_POLDET = mysqli_fetch_array($oRst_POLDET_sql)){
				?>
				<tr class="borderojo">
					<td ><?php echo $oRst_POLDET["fk_tipo"]; ?></td>
					<td><?php echo $oRst_POLDET["fk_id_cuenta"]; ?></td>
					<td ><?php echo $oRst_POLDET["fk_referencia"]; ?></td>
					<td ><?php echo $oRst_POLDET["fk_id_cliente"]; ?></td>
					<td ><?php echo $oRst_POLDET["s_folioCFDIext"]; ?></td>
					<td ><?php echo $oRst_POLDET["fk_factura"]; ?></td>
					<td ><?php echo $oRst_POLDET["fk_ctagastos"]; ?></td>
					<td ><?php echo $oRst_POLDET["fk_pago"]; ?></td>
					<td ><?php echo $oRst_POLDET["fk_nc"]; ?></td>
					<td ><?php echo $oRst_POLDET["fk_cheque"]; ?></td>
					<td class="text-left"><?php echo $oRst_POLDET["s_desc"]; ?></td>
					<td><?php echo number_format($oRst_POLDET['n_cargo'],2,'.',',');?></td>
					<td><?php echo number_format($oRst_POLDET['n_abono'],2,'.',',');?></td>
				</tr>
			<?php }
				mysqli_free_result($oRst_POLDET_sql);
				?>
			</tbody>
			<tfoot>
				<tr class="font14">
					<td class="text-right" colspan="11">Totales : </td>
					<td><?php echo number_format($oRst_STPD['SUMA_CARGOS'],2,'.',',');?></td>
					<td><?php echo number_format($oRst_STPD['SUMA_ABONOS'],2,'.',',');?></td>
				</tr>
			</tfoot>
		</table>
	</div>

	<?php
	}else{
		?>
	<div class="container-fluid pantallaGris">
		<div class="tituloSinRegistros">
			<font color="#F73A4A" face="Verdana" size="2" align="center" >NO HAY DETALLES DE ESTA PÓLIZA</font>
		</div>
	</div>
	<?php
		}
	?>

	<?php
	}else{
	?>

	<div class="container-fluid pantallaGris">
		<div class="tituloSinRegistros">
			<font color="#F73A4A" face="Verdana" size="2" align="center" >NO HAY DATOS DE ESTA PÓLIZA, O ES UNA PÓLIZA DE OTRA OFICINA</font>
		</div>
	</div>
</div>
<?php
}
?>

<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>

<?php mysqli_close($db); ?>

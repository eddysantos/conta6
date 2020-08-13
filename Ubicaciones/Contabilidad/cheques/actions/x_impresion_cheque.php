<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Ubicaciones/barradenavegacion.php';
require $root . '/Resources/PHP/actions/numtoletras.php';


$id_cheque = $_GET['id_cheque'];
$id_cuentaMST = $_GET['id_cuentaMST'];
$id_poliza = $_GET['id_poliza'];

$sql_Select = "SELECT * from conta_t_cheques_mst Where pk_id_cheque = ? AND fk_id_cuentaMST = ?";
$stmt = $db->prepare($sql_Select);
if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmt->bind_param('ss', $id_cheque,$id_cuentaMST);
if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}
if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
$rslt = $stmt->get_result();
$rows = $rslt->num_rows;

if( $rows > 0 ){
	$rowMST = $rslt->fetch_assoc();

	$valorCheque = $rowMST['n_valor'];
    $cantidadLetra = "*** ".numtoletras($valorCheque)." ***";

	#'RESTRICCION PARA LAS CUENTAS EN DOLARES
    if( $id_cuentaMST == "0100-00011" OR $id_cuentaMST == "0100-00014" ){
	    $cantidadLetra = str_replace("PESOS","DOLARES",$cantidadLetra);
	    $cantidadLetra = str_replace(" MN "," ",$cantidadLetra);
	}

	$cancela = $rowMST["s_cancela"];
	if( $cancela == 1 ){ $txt_cancela = "CANCELADO"; }else{ $txt_cancela = "ACTIVO"; }

	if($id_poliza > 0){
		$sql_CHEDET = "Select * from conta_t_polizas_det where fk_id_poliza = ? order by pk_partida";
		$stmt_CHEDET = $db->prepare($sql_CHEDET);
		if (!($stmt_CHEDET)) { die("Error during query prepare [$db->errno]: $db->error");	}
		$stmt_CHEDET->bind_param('s',$id_poliza);
		if (!($stmt_CHEDET)) { die("Error during query prepare [$stmt_CHEDET->errno]: $stmt_CHEDET->error");	}
		if (!($stmt_CHEDET->execute())) { die("Error during query prepare [$stmt_CHEDET->errno]: $stmt_CHEDET->error"); }
		$rslt_CHEDET = $stmt_CHEDET->get_result();
		$rows_CHEDET = $rslt_CHEDET->num_rows;

		if( $rows_CHEDET > 0 ){
			$detalleCheque = "";
			//while( $rslt_CHEDET = mysqli_fetch_array($sql_CHEDET) ){
			while ($row_CHEDET = $rslt_CHEDET->fetch_assoc()) {
				$fecha = date_format(date_create($row_CHEDET['d_fecha']),"d/m/Y");
				$cargo = number_format($row_CHEDET['n_cargo'],2,'.',',');
				$abono = number_format($row_CHEDET['n_abono'],2,'.',',');

				$detalleCheque .= "
				<tr class='row borderojo' align='center' style='color:#000000'>
					<td class='col-md-1'>$row_CHEDET[fk_id_poliza]</td>
					<td class='col-md-1'>$row_CHEDET[fk_id_cuenta]</td>
					<td class='col-md-1'>$row_CHEDET[fk_referencia]</td>
					<td class='col-md-1'>$row_CHEDET[fk_id_cliente]</td>
					<td class='col-md-1'>$row_CHEDET[s_folioCFDIext]</td>
					<td class='col-md-1'>$row_CHEDET[fk_anticipo]</td>
					<td class='col-md-1'>$fecha</td>
					<td class='col-md-3' align='left'>$row_CHEDET[s_desc]</td>
					<td class='col-md-1' align='right'>$cargo</td>
					<td class='col-md-1' align='right'>$abono</td>
				</tr>";
	 		}

			$sql_SelectTotales = "SELECT fk_id_poliza,
													SUM(n_cargo) AS SUMA_CARGOS,
													SUM(n_abono) AS SUMA_ABONOS
													FROM conta_t_polizas_det
													WHERE fk_id_poliza = ?
													GROUP BY fk_id_poliza";
			$stmtTotales = $db->prepare($sql_SelectTotales);
			if (!($stmtTotales)) { die("Error during query prepare Totales [$db->errno]: $db->error");	}
			$stmtTotales->bind_param('s', $id_poliza);
			if (!($stmtTotales)) { die("Error during query prepare Totales [$stmtTotales->errno]: $stmtTotales->error");	}
			if (!($stmtTotales->execute())) { die("Error during query prepare Totales [$stmtTotales->errno]: $stmtTotales->error"); }
			$rsltTotales = $stmtTotales->get_result();
			$rowTotales = $rsltTotales->fetch_assoc();
			$sumaCargos = $rowTotales["SUMA_CARGOS"];
			$sumaAbonos = $rowTotales["SUMA_ABONOS"];

		}
	}
}


?>

<?php if( $rows > 0 ){ ?>
<!-- <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Trebuchet MS; font-size:8pt;">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="60%">&nbsp;</td>
    <td width="20%">&nbsp;</td>
    <td width="20%"><?php echo date_format(date_create($rowMST["d_fechache"]),"d/m/Y"); ?></td>
  </tr>
</table> -->

<table class="table font12" style="color:black">
	<thead>
		<tr class="row m-0">
			<td class="col-md-12 font14 text-center sub2" style="font-size:14px!important">
				<img src="/Resources/imagenes/cheetah.svg"  style="width:50px"> <?php echo $nombreCIA; ?>
			</td>
		</tr>

		<tr class="row m-0 mt-5">
			<td class="col-md-2 pb-0">
				<label class="imp">Cheque No :</label>
				<?php echo $rowMST["pk_id_cheque"]; ?>
			</td>
			<td class="col-md-2 pb-0">
				<label class="imp">Fecha :</label>
				<?php echo date_format(date_create($rowMST["d_fechache"]),"d/m/Y"); ?>
			</td>
		</tr>

		<tr class="row m-0">
			<td class="col-md-6 pb-0">
				<label class="imp">Beneficiario :</label>
				<?php echo trim($rowMST["s_nomOrd"]); ?>
			</td>
		</tr>
		<tr class="row m-0">
			<td class="col-md-6 pb-0">
				<label class="imp">Importe :</label>
				$ <?php echo number_format($rowMST["n_valor"],2,'.',','); ?>
				<?php echo $cantidadLetra; ?>
			</td>
		</tr>
	</thead>
</table>

<!-- <table>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo trim($rowMST["s_nomOrd"]); ?></td>
    <td>&nbsp;</td>
    <td align="center"><?php echo number_format($rowMST["n_valor"],2,'.',','); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $cantidadLetra; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table> -->

<div class="contorno">
	<table class="table font12">
		<tr class="row text-center sub2" style="font-size:12px!important">
			<td class="col-md-2">Fecha</td>
			<td class="col-md-3">Usuario que Capturo</td>
			<td class="col-md-3">Fecha de Captura</td>
			<td class="col-md-2">Poliza</td>
			<td class="col-md-2">Cancelacion</td>
		</tr>
		<tr class="row text-center">
			<td class="col-md-2"><?php echo date_format(date_create($rowMST["d_fechache"]),"d/m/Y"); ?></td>
			<td class="col-md-3"><?php echo trim($rowMST["fk_usuario"]);?></td>
			<td class="col-md-3"><?php if (!is_null($rowMST["d_fecha_alta"])){ echo date_format(date_create($rowMST["d_fecha_alta"]),"d/m/Y h:i:s a");}?></td>
			<td class="col-md-2"><?php echo $rowMST["fk_id_poliza"];?></td>
			<td class="col-md-2"><?php echo $rowMST["$txt_cancela"];?></td>
		</tr>
	</table>
</div>

<!-- <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table border="0" width="100%" style="font-family: Trebuchet MS; font-size:8pt;">
	<tr>
		<td width="40%" >&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%" align="right"><b>Cheque No.</b></td>
		<td width="20%"><?php echo $rowMST["pk_id_cheque"]; ?></td>
	</tr>
</table>
<table border="1" width="100%" id="table26" cellspacing="1" style="border-collapse: collapse;">
	<tr>
		<td>
			<table border="0" width="100%" id="table27" cellspacing="1">
				<tr>
					<td width="20%" style=" font-family: Trebuchet MS; font-size:10pt;">Fecha del Cheque</td>
					<td width="20%" style="font-family: Trebuchet MS; font-size:8pt;"><?php echo date_format(date_create($rowMST["d_fechache"]),"d/m/Y"); ?></td>
					<td width="20%">&nbsp;</td>
					<td width="20%" style="font-family: Trebuchet MS; font-size: 10pt">Póliza</td>
					<td width="20%" style="font-family: Trebuchet MS; font-size: 8pt"><?php echo $rowMST["fk_id_poliza"];?></td>
				</tr>
				<tr>
					<td style="font-family: Trebuchet MS; font-size: 10pt">Usuario que Capturo</td>
					<td style="font-family: Trebuchet MS; font-size: 8pt"><?php echo trim($rowMST["fk_usuario"]);?></td>
					<td>&nbsp;</td>
					<td style="font-family: Trebuchet MS; font-size: 10pt"></td>
					<td style="font-family: Trebuchet MS; font-size: 8pt"><?php echo $rowMST["$txt_cancela"];?></td>
				</tr>
				<tr>
					<td style="font-family: Trebuchet MS; font-size: 10pt">Fecha de Captura</td>
					<td style="font-family: Trebuchet MS; font-size: 8pt"><?php if (!is_null($rowMST["d_fecha_alta"])){ echo date_format(date_create($rowMST["d_fecha_alta"]),"d/m/Y h:i:s a");}?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<p>&nbsp;</p> -->
<?php
	if($id_poliza > 0){

?>

<div class="contorno text-center">
	<table class="table">
		<tr class="row sub">
			<td class="col-md-1 sub" style="letter-spacing: 0px!important;">Póliza</td>
			<td class="col-md-1 sub" style="letter-spacing: 0px!important;">Cuenta</td>
			<td class="col-md-1 sub" style="letter-spacing: 0px!important;">Referencia</td>
			<td class="col-md-1 sub" style="letter-spacing: 0px!important;">Cliente</td>
			<td class="col-md-1 sub" style="letter-spacing: 0px!important;">Documento</td>
			<td class="col-md-1 sub" style="letter-spacing: 0px!important;">Anticipo</td>
			<td class="col-md-1 sub" style="letter-spacing: 0px!important;">Fecha</td>
			<td class="col-md-3 sub" style="letter-spacing: 0px!important;">Descripcion</td>
			<td class="col-md-1 sub" style="letter-spacing: 0px!important;">Cargo</td>
			<td class="col-md-1 sub" style="letter-spacing: 0px!important;">Abono</td>
		</tr>
		<?php echo $detalleCheque; ?>

	</table>
</div>


<!-- <table border="1" width="100%" id="table4" style="font-family: Trebuchet MS; font-size: 8pt; border-collapse:collapse; color:#000000" cellspacing="1" cellpadding="0">
	<tr bgcolor="#808080" align="center" style="color:#FFFFFF;">
		<td width="3%">Póliza</td>
		<td width="10%">Cuenta</td>
		<td width="9%">Referencia</td>
		<td width="7%">Cliente</td>
		<td width="7%">Documento</td>
		<td width="7%">Anticipo</td>
		<td width="11%">Fecha</td>
		<td width="30%">Descripción</td>
		<td width="8%">Cargo</td>
		<td width="8%">Abono</td>
	</tr>
	<?php echo $detalleCheque; ?>
	<tr>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
	</tr>
	<tr align="right">
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden">&nbsp;</td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden"><input type="text" name="Titulo0" size="22" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:8pt; text-align:center; color:#000000; font-weight:bold; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; width:100; height:20; background-color:#808080" value="Totales" readonly></td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden"><input type="text" name="T_Suma_Cargos0" size="22" style="border:1px solid #000000; font-family: Trebuchet MS; font-size:9px; text-align:right; color:#000000; font-weight:bold; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; width:70; height:20" value="<?php echo number_format($sumaCargos,2,'.',',');?>" readonly></td>
		<td style="border-left:hidden; border-right:hidden; border-bottom:hidden"><input type="text" name="T_Suma_Abonos" size="22" style="border:1px solid #000000; font-family: Trebuchet MS; font-size:9px; text-align:right; color:#000000; font-weight:bold; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; width:70; height:20" value="<?php echo number_format($sumaAbonos,2,'.',',');?>" readonly></td>
	</tr>
</table> -->


<table class="table text-center font14 mt-5">
	<tr class="row m-0">
		<td class="col-md-4 p-0">Recibo de Conformidad</td>
		<td class="col-md-4 p-0">Hecho por:</td>
		<td class="col-md-4 p-0">Revisado por:</td>
	</tr>

	<tr class="row m-0">
		<td class="col-md-4">
			<div class="dimdiv"></div>
		</td>

		<td class="col-md-4">
			<div class="dimdiv"></div>
		</td>

		<td class="col-md-4">
			<div class="dimdiv"></div>
		</td>
	</tr>
</table>


<?php
	}else{
		echo '<div class="container-fluid pantallaGris">
				<div class="tituloSinRegistros">EL CHEQUE NO TIENE PÓLIZA</div>
			</div>';
	}
}else{
	echo '<div class="container-fluid pantallaGris">
			<div class="tituloSinRegistros">NO EXISTE EL CHEQUE</div>
		  </div>';

}

?>

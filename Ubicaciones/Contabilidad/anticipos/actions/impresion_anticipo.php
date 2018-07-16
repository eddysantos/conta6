

<title>Impresion de Anticipo</title>
<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/encabezadoImpresion.php';

	$id_anticipo = trim($_GET['id_anticipo']);

	$sql_Select = "SELECT *
								FROM conta_t_anticipos_mst
								WHERE pk_id_anticipo = ?";

  $stmt = $db->prepare($sql_Select);
	if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
	$stmt->bind_param('s', $id_anticipo);
	if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}
	if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
	$rslt = $stmt->get_result();
	$rows = $rslt->num_rows;

	if( $rows > 0 ){
		$rowMST = $rslt->fetch_assoc();

		$Total = $rowMST["n_valor"];
		$id_cliente = trim($rowMST["fk_id_cliente_antmst"]);
		$Cuenta = trim($rowMST["fk_id_cuentaMST"]);
		$id_poliza = trim($rowMST["fk_id_poliza"]);
		$Fecha = trim($rowMST["d_fecha"]);
		if(!is_null($oRst_Select["d_fecha"])){ $Fecha = date_format(date_create($oRst_Select["d_fecha"]),"d/m/Y"); }
		$TotalLetra = "*** ".numtoletras($Total)." ***";

		$sql_SelectCLT = "SELECT s_nombre
											FROM conta_replica_clientes
											WHERE pk_id_cliente = ?";

		$stmtCLT = $db->prepare($sql_SelectCLT);
		if (!($stmtCLT)) { die("Error during query prepare CLT [$db->errno]: $db->error");	}
		$stmtCLT->bind_param('s', $id_cliente);
		if (!($stmtCLT)) { die("Error during query prepare CLT [$stmtCLT->errno]: $stmtCLT->error");	}
		if (!($stmtCLT->execute())) { die("Error during query prepare CLT [$stmtCLT->errno]: $stmtCLT->error"); }
		$rsltCLT = $stmtCLT->get_result();
		$rowCLT = $rsltCLT->fetch_assoc();
		$nombre = trim($rowCLT["s_nombre"]);

		$sql_SelectCTA = "SELECT s_cta_desc
											FROM conta_cs_cuentas_mst
											WHERE pk_id_cuenta = ?";
		$stmtCTA = $db->prepare($sql_SelectCTA);
		if (!($stmtCTA)) { die("Error during query prepare CTA [$db->errno]: $db->error");	}
		$stmtCTA->bind_param('s', $Cuenta);
		if (!($stmtCTA)) { die("Error during query prepare CTA [$stmtCTA->errno]: $stmtCTA->error");	}
		if (!($stmtCTA->execute())) { die("Error during query prepare CTA [$stmtCTA->errno]: $stmtCTA->error"); }
		$rsltCTA = $stmtCTA->get_result();
		$rowCTA = $rsltCTA->fetch_assoc();
		$Cuenta_Desc = $rowCTA["s_cta_desc"];

		$sql_SelectPOL = "SELECT *
											FROM conta_t_polizas_det
											WHERE fk_id_poliza = ?
											ORDER BY pk_partida";
		$stmtPOL = $db->prepare($sql_SelectPOL);
		if (!($stmtPOL)) { die("Error during query prepare POL [$db->errno]: $db->error");	}
		$stmtPOL->bind_param('s', $id_poliza);
		if (!($stmtPOL)) { die("Error during query prepare POL [$stmtPOL->errno]: $stmtPOL->error");	}
		if (!($stmtPOL->execute())) { die("Error during query prepare POL [$stmtPOL->errno]: $stmtPOL->error"); }
		$rsltPOL = $stmtPOL->get_result();
		$rowsReg = $rsltPOL->num_rows;

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
?>
<!--DISEÑO  -->
</head>
<!-- <tbody class="container-fluid text-center"> -->
	<div class="">
		<table class="table font12">
			<thead>
				<tr class="row m-0">
					<td class="col-md-12 font14 text-center sub2" style="font-size:14px!important">
						<img src="/conta6/Resources/imagenes/cheetah.svg"  style="width:50px"> <?php echo $nombreCIA; ?>
					</td>
				</tr>
				<tr class="row m-0">
					<td class="col-md-1 pb-0">
						<label class="imp">Anticipo:</label>
						<?php echo $id_anticipo; ?>
					</td>
					<td class="col-md-2 pb-0">
						<label class="imp">Fecha:</label>
						<?php echo $Fecha; ?>
					</td>
				</tr>
				<tr class="row m-0">
					<td class="col-md-6 pb-0">
						<label class="imp">Se Recibe Depósito del Cliente: </label>
						<?php echo $nombre; ?>
					</td>
				</tr>
				<tr class="row m-0">
					<td class="col-md-6 pb-0">
						<label class="imp">Cuenta: </label>
						<?php echo $Cuenta_Desc; ?>
					</td>
				</tr>
				<tr class="row m-0">
					<td class="col-md-6 pb-0">
						<label class="imp">Importe: </label>
						$ <?php echo number_format($Total,2,'.',','); ?>
						<?php echo trim($TotalLetra); ?>
					</td>
				</tr>
			</thead>
		</table>



		<?php if( $rowsReg > 0 ){ ?>
		<div class="contorno">
			<table class="font12 text-center">
				<thead>
					<tr class="sub2" style="font-size:12px!important">
						<td width="3%">Póliza</td>
						<td width="10%">Cuenta</td>
						<td width="9%">Referencia</td>
						<td width="6%">Cliente</td>
						<td width="6%">Factura</td>
						<td width="6%">CtaGastos</td>
						<td width="6%">PagoE</td>
						<td width="6%">NotaCred</td>
						<td width="6%">Fecha</td>
						<td width="30%">Descripción</td>
						<td width="13%">Cargo</td>
						<td width="13%">Abono</td>
					</tr>
				</thead>
				<tbody>
					<?php
						while( $rowPOL = $rsltPOL->fetch_assoc() ){ ?>
						<tr class="table-bordered">
							<td width="3%"><?php echo $rowPOL["fk_id_poliza"]; ?></td>
							<td width="10%"><?php echo trim($rowPOL["fk_id_cuenta"]); ?></td>
							<td width="9%"><?php echo trim($rowPOL["fk_referencia"]); ?></td>
							<td width="6%"><?php echo trim($rowPOL["fk_id_cliente"]); ?></td>
							<td width="6%"><?php echo trim($rowPOL["fk_factura"]); ?></td>
							<td width="6%"><?php echo trim($rowPOL["fk_ctagastos"]); ?></td>
							<td width="6%"><?php echo trim($rowPOL["fk_pago"]); ?></td>
							<td width="6%"><?php echo trim($rowPOL["fk_nc"]); ?></td>
							<td width="6%"><?php if (!is_null($rowPOL["d_fecha"])){ echo date_format(date_create($rowPOL["d_fecha"]),"d-m-Y"); }?></td>
							<td width="38%" align="left"><?php echo trim($rowPOL["s_desc"]); ?></td>
							<td width="13%" align="right"><?php echo number_format($rowPOL["n_cargo"],2,'.',','); ?></td>
							<td width="13%"align="right"><?php echo number_format($rowPOL["n_abono"],2,'.',','); ?></td>
						</tr>
					<?PHP }  ?>
				</tbody>
				<tfoot>
					<tr class="row">
						<td class="col-md-12">&nbsp;</td>
					</tr>
					<tr class="mt-5">
						<td width="3%">&nbsp;</td>
						<td width="10%">&nbsp;</td>
						<td width="9%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						<td width="6%">&nbsp;</td>
						<td width="38" align="right">Total : </td>
						<td width="13%"><?php echo number_format($sumaCargos,2,'.',','); ?></td>
						<td width="13%"><?php echo number_format($sumaAbonos,2,'.',','); ?></td>
					</tr>
				</tfoot>
			</table>
		</div>
		<?PHP }else{ ?>
				<div class="tituloSinRegistros mt-5">
					<font color="#F73A4A" face="Verdana" size="2" align="center" >NO HAY DETALLES EN ESTE ANTICIPO</font>
				</div>
		<?PHP } ?>
	</div>

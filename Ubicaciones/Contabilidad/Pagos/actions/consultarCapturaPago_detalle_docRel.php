<?php

$query_consultaDetalle_DR = "SELECT * FROM conta_t_pagos_captura_det_dr where fk_id_pago_captura = ? and n_fk_rowPago = ? ORDER BY pk_id_DR ";

$stmt_consultaDetalle_DR = $db->prepare($query_consultaDetalle_DR);
if (!($stmt_consultaDetalle_DR)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaDetalle_DR->bind_param('ss',$cuenta,$pk_rowPago);
if (!($stmt_consultaDetalle_DR)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaDetalle_DR->errno]: $stmt_consultaDetalle_DR->error";
	exit_script($system_callback);
}
if (!($stmt_consultaDetalle_DR->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaDetalle_DR->errno]: $stmt_consultaDetalle_DR->error";
	exit_script($system_callback);
}

$rslt_consultaDetalle_DR = $stmt_consultaDetalle_DR->get_result();
$total_consultaDetalle_DR = $rslt_consultaDetalle_DR->num_rows;

if( $total_consultaDetalle_DR > 0 ) {

	$pagosDetalle_DR = '';
	$pagosDetallePrint_DR = '';
	$nombreElementDesglose2 = '';

	while( $row_consultaDetalle_DR = $rslt_consultaDetalle_DR->fetch_assoc()  ){
		$pk_id_DR = $row_consultaDetalle_DR['pk_id_DR'];
		$fk_id_aduanaDR = $row_consultaDetalle_DR['fk_id_aduanaDR'];
		$fk_referenciaDR = $row_consultaDetalle_DR['fk_referenciaDR'];
		$fk_id_facturaDR = $row_consultaDetalle_DR['fk_id_facturaDR'];
		$s_UUID_DR = $row_consultaDetalle_DR['s_UUID_DR'];
		$fk_c_MetodoPagoDR = $row_consultaDetalle_DR['fk_c_MetodoPagoDR'];
		$fk_id_monedaDR = $row_consultaDetalle_DR['fk_id_monedaDR'];
		$n_tipoCambioDR = $row_consultaDetalle_DR['n_tipoCambioDR'];
		$totalDR = $row_consultaDetalle_DR['totalDR'];
		$n_numParcialidad = $row_consultaDetalle_DR['n_numParcialidad'];
		$n_importeSaldoAnterior = $row_consultaDetalle_DR['n_importeSaldoAnterior'];
		$n_importePagado = $row_consultaDetalle_DR['n_importePagado'];
		$n_importeSaldoInsoluto = $row_consultaDetalle_DR['n_importeSaldoInsoluto'];
		$n_deposito = $row_consultaDetalle_DR['n_deposito'];
		$n_iva = $row_consultaDetalle_DR['n_iva'];
		$s_usuario_alta = $row_consultaDetalle_DR['s_usuario_alta'];
		$d_fecha_alta = $row_consultaDetalle_DR['d_fecha_alta'];
		$fk_rowPago = $row_consultaDetalle_DR['n_fk_rowPago'];
		// $n_CFDIrelacionado = $row_consultaDetalle_DR['n_CFDIrelacionado'];
		// $s_tipoDetalle = $row_consultaDetalle_DR['s_tipoDetalle'];

		$n_importeSaldoAnterior2 = number_format($n_importeSaldoAnterior,2,'.',',');
		$n_importePagado2 = number_format($n_importePagado,2,'.',',');
		$n_importeSaldoInsoluto2 = number_format($n_importeSaldoInsoluto,2,'.',',');

		#usada para el nombre del archivo
		$fk_referencia .= $fk_referenciaDR.'_';

		//$inputPartidaDR = "<input class='id-partidaDR' type='hidden' id='T_partida_$fk_rowPago' value='0'>";
		$btnEliminarDR = "<a href='#' class='eliminar-pagosDR'><img class='icochico' src='/conta6/Resources/iconos/cross.svg'></a>";


		if($pk_rowPago == $fk_rowPago){
			$pagosDetalle_DR .= "
			<tr class='row m-0 font12 elemento-pagosDR borrar-pagoDR borderojo remove_$fk_rowPago' id='$fk_rowPago'>
				 <td class='col-md-2 p-1'> <input class='efecto h22 border-0 bt t-referencia' type='text' id='referencia_$fk_rowPago' value='$fk_referenciaDR'></td>
				 <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt t-factura' type='text' id='factura_$fk_rowPago'  value='$fk_id_facturaDR' readonly></td>
				 <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt t-parcialidad' type='text' id='parcialidad_$fk_rowPago' value='$n_numParcialidad' readonly></td>
				 <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt t-saldoAnterior' type='text' id='saldoAnterior_$fk_rowPago' value='$n_importeSaldoAnterior' readonly></td>
				 <td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt t-pagado t-pagado$fk_rowPago' type='text' id='pagado_$fk_rowPago' value='$n_importePagado' readonly></td>
				 <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt t-iva' type='text' id='iva_$fk_rowPago' value='$n_iva' readonly> <input class=' t-deposito' type='hidden' id='deposito_$fk_rowPago' value='$n_deposito'></td>
				 <td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt t-saldoInsoluto' type='text' id='saldoInsoluto_$fk_rowPago' value='$n_importeSaldoInsoluto' readonly></td>
				 <td class='p-1'>
					 $btnEliminarDR
				   <input class='h22 efecto border-0 bt text-left t-uuid' type='hidden' id='uuid_$fk_rowPago' value='$s_UUID_DR' readonly>
				   <input class='h22 efecto border-0 bt text-left t-total' type='hidden' id='total_$fk_rowPago' value='$totalDR' readonly />
				   <input class='h22 efecto border-0 bt text-left t-monedaDR' type='hidden' id='monedaDR_$fk_rowPago' value='$fk_id_monedaDR' readonly />
				   <input class='t-tipoCambioDR' type='hidden' id='tipoCambioDR_$fk_rowPago' value='$n_tipoCambioDR'>
				   <input class='t-metodoPagoDR' type='hidden' id='metodoPagoDR_$fk_rowPago' value='$fk_c_MetodoPagoDR'>
					 <input class='t-aduanaDR' type='hidden' id='aduanaDR_$fk_rowPago' value='$fk_id_aduanaDR'>
					 <input class='t-idDR' type='hidden' id='idDR_$fk_rowPago' value='$pk_id_DR'>
					 <input class='t-idPago' type='hidden' id='idPago_$fk_rowPago' value='$fk_rowPago'>
				</td>
			</tr>";

			#<input class='t-pagosDETDR' type='hidden' id='pagosDETDR_$fk_rowPago' value='$fk_rowPago'>

			$pagosDetalle_DR_consulta .= "
			<tr class='row m-0 font12 elemento-pagosDR borrar-pago borrar-pagoDR borderojo remove_$fk_rowPago' id='$fk_rowPago'>
				 <td class='col-md-2 p-1'>$fk_referenciaDR</td>
				 <td class='col-md-2 p-1'>$fk_id_facturaDR</td>
				 <td class='col-md-1 p-1'>$n_numParcialidad</td>
				 <td class='col-md-2 p-1'>$n_importeSaldoAnterior</td>
				 <td class='col-md-2 p-1'>$n_importePagado</td>
				 <td class='col-md-1 p-1'>$n_iva</td>
				 <td class='col-md-1 p-1'>$n_importeSaldoInsoluto</td>
			</tr>";

			$pagosDetallePrint_DR .= "
			<table width='100%' border='0' cellpadding='0' cellspacing='1' style='font-family: Trebuchet MS; font-size:10pt; border: 1px solid #000000;'>
				<tr bgcolor='#C0C0C0' align='center' style='color:#000000'>
					<td>Factura</td>
					<td>Referencia</td>
					<td>M. Pago</td>
					<td>Moneda</td>
					<td>T. Cambio </td>
					<td>Parcialidad</td>
					<td>Saldo Anterior</td>
					<td>Importe Pagado</td>
					<td>Saldo Insoluto</td>
				</tr>
				<tr align='center'>
					<td>$fk_id_facturaDR</td>
					<td>$fk_referenciaDR</td>
					<td>$fk_c_MetodoPagoDR</td>
					<td>$fk_id_monedaDR</td>
					<td>$n_tipoCambioDR</td>
					<td>$n_numParcialidad</td>
					<td>$n_importeSaldoAnterior2</td>
					<td>$n_importePagado2</td>
					<td>$n_importeSaldoInsoluto2</td>
				</tr>
				<tr align='center'>
					<td bgcolor='#C0C0C0'>UUID:</td>
					<td colspan='5' align='left'>$s_UUID_DR</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table><br>
			";


			$pagosDetallePrint_PDF .= '
			<table class="border">
				<tr bgcolor="#ccc" color="rgb(255, 255, 255)" align="center">
					<td width="6%">Fact</td>
					<td width="11%">Referencia</td>
					<td width="8%">M. Pago</td>
					<td width="8%">Moneda</td>
					<td width="10%">T. Cambio </td>
					<td width="12%">Parcialidad</td>
					<td width="15%">Saldo Anterior</td>
					<td width="15%">Importe Pagado</td>
					<td width="15%">Saldo Insoluto</td>
				</tr>
				<tr align="center">
					<td width="6%">'.$fk_id_facturaDR.'</td>
					<td width="11%">'.$fk_referenciaDR.'</td>
					<td width="8%">'.$fk_c_MetodoPagoDR.'</td>
					<td width="8%">'.$fk_id_monedaDR.'</td>
					<td width="10%">'.$n_tipoCambioDR.'</td>
					<td width="12%">'.$n_numParcialidad.'</td>
					<td width="15%">'.$n_importeSaldoAnterior2.'</td>
					<td width="15%">'.$n_importePagado2.'</td>
					<td width="15%">'.$n_importeSaldoInsoluto2.'</td>
				</tr>
				<br />
				<tr>
					<td width="10%" bgcolor="#ccc" color="rgb(255, 255, 255)" align="center">UUID:</td>
					<td width="90%" align="left">'.$s_UUID_DR.'</td>
				</tr>
			</table>
			<br />
			<br />';




		}#fin $pk_rowPago == $fk_rowPago


  }
	$idElementDesglose = 'tbodyPagosDesglose'.$fk_rowPago;
	$idElementDesglose2 = '#tbodyPagosDesglose'.$fk_rowPago;
	#if( $fk_rowPago == 0 ){
			$pagosDetalle_pago = "
			<table class='table tableDR'>
				<thead>
					<tr class='row sub2 m-0'>
						<td class='col-md-2 p-1'>Referencia</td>
						<td class='col-md-2 p-1'>Factura</td>
						<td class='col-md-1 p-1'>Parc.</td>
						<td class='col-md-2 p-1'>S. Anterior</td>
						<td class='col-md-2 p-1'>Imp. Pagado</td>
						<td class='col-md-1 p-1'>IVA</td>
						<td class='col-md-1 p-1'>S.Insoluto</td>
						<td class='col-md-1 p-1'><a href='#' id='Btn_agregarDR' onclick='Btn_agregarDR(&#39;$idElementDesglose&#39;,$fk_rowPago)'><img class='icochico' src='/conta6/Resources/iconos/002-plus.svg'></a></td>
					</tr>
				</thead>
				<tbody id='$idElementDesglose' class='tbodyPagosDesglose'>$pagosDetalle_DR</tbody>
			</table>";

			$pagosDetalle_pago_consulta = "
			<table class='table'>
				<thead>
					<tr class='row sub2 m-0'>
						<td class='col-md-2 p-1'>Referencia</td>
						<td class='col-md-2 p-1'>Factura</td>
						<td class='col-md-1 p-1'>Parc.</td>
						<td class='col-md-2 p-1'>S. Anterior</td>
						<td class='col-md-2 p-1'>Imp. Pagado</td>
						<td class='col-md-1 p-1'>IVA</td>
						<td class='col-md-1 p-1'>S.Insoluto</td>
					</tr>
				</thead>
				<tbody id='$idElementDesglose' class='$nombreElementDesglose2'>$pagosDetalle_DR_consulta</tbody>
			</table>";


	#}



}


?>

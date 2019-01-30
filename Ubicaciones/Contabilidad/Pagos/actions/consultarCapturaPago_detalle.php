 <?PHP

$query_consultaDetalle = "SELECT * FROM conta_t_pagos_captura_det where fk_id_pago_captura = ? ";

$stmt_consultaDetalle = $db->prepare($query_consultaDetalle);
if (!($stmt_consultaDetalle)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaDetalle->bind_param('s',$cuenta);
if (!($stmt_consultaDetalle)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaDetalle->errno]: $stmt_consultaDetalle->error";
	exit_script($system_callback);
}
if (!($stmt_consultaDetalle->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaDetalle->errno]: $stmt_consultaDetalle->error";
	exit_script($system_callback);
}

$rslt_consultaDetalle = $stmt_consultaDetalle->get_result();
$total_consultaDetalle = $rslt_consultaDetalle->num_rows;

if( $total_consultaDetalle > 0 ) {
	$idFila = 0; $fk_referencia = '';
	while( $row_consultaDetalle = $rslt_consultaDetalle->fetch_assoc()  ){
		++$idFila;

		$pk_id_partida = $row_consultaDetalle['pk_id_partida'];
		$d_fecha_docPago = $row_consultaDetalle['d_fecha_docPago'];
		$fk_id_formapago = trim($row_consultaDetalle['fk_id_formapago']);
		$s_numOperacion = $row_consultaDetalle['s_numOperacion'];
		$fk_id_moneda = $row_consultaDetalle['fk_id_moneda'];
		$n_tipoCambio = $row_consultaDetalle['n_tipoCambio'];
		$n_importe = $row_consultaDetalle['n_importe'];
		$n_deposito = $row_consultaDetalle['n_deposito'];
		$n_iva = $row_consultaDetalle['n_iva'];
		$s_rfcOrd = $row_consultaDetalle['s_rfcOrd'];
		$s_nomBancoOrdExt = $row_consultaDetalle['s_nomBancoOrdExt'];
		$s_ctaOrd = $row_consultaDetalle['s_ctaOrd'];
		$s_rfcBen = $row_consultaDetalle['s_rfcBen'];
		$s_ctaBen = $row_consultaDetalle['s_ctaBen'];
		$s_tipoCadPago = $row_consultaDetalle['s_tipoCadPago'];
		$s_certPago = $row_consultaDetalle['s_certPago'];
		$s_cadPago = $row_consultaDetalle['s_cadPago'];
		$s_selloPago = $row_consultaDetalle['s_selloPago'];
		$fk_id_aduanaDR = $row_consultaDetalle['fk_id_aduanaDR'];
		$fk_referenciaDR = $row_consultaDetalle['fk_referenciaDR'];
		$fk_id_facturaDR = $row_consultaDetalle['fk_id_facturaDR'];
		$s_UUID_DR = $row_consultaDetalle['s_UUID_DR'];
		$fk_c_MetodoPagoDR = $row_consultaDetalle['fk_c_MetodoPagoDR'];
		$fk_id_monedaDR = $row_consultaDetalle['fk_id_monedaDR'];
		$n_tipoCambioDR = $row_consultaDetalle['n_tipoCambioDR'];
		$totalDR = $row_consultaDetalle['totalDR'];
		$n_numParcialidad = $row_consultaDetalle['n_numParcialidad'];
		$n_importeSaldoAnterior = $row_consultaDetalle['n_importeSaldoAnterior'];
		$n_importePagado = $row_consultaDetalle['n_importePagado'];
		$n_importeSaldoInsoluto = $row_consultaDetalle['n_importeSaldoInsoluto'];
		$s_usuario_alta = $row_consultaDetalle['s_usuario_alta'];
		$d_fecha_alta = $row_consultaDetalle['d_fecha_alta'];
		$n_CFDIrelacionado = $row_consultaDetalle['n_CFDIrelacionado'];
		$s_tipoDetalle = $row_consultaDetalle['s_tipoDetalle'];

    $n_importeSaldoAnterior2 = number_format($n_importeSaldoAnterior,2,'.',',');
		$n_importePagado2 = number_format($n_importePagado,2,'.',',');
		$n_importeSaldoInsoluto2 = number_format($n_importeSaldoInsoluto,2,'.',',');

    $fk_referencia .= $fk_referenciaDR.'_'; #usada para el nombre del archivo

    #FORMA DE PAGO
    $id_cliente = $fk_id_cliente;
    require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente_formaPago.php';#$formaPago

    if ($rows_datosCLTformaPago > 0 ) {
      while ($row_datosCLTformaPago = $rslt_datosCLTformaPago->fetch_assoc()) {
        $txt_formaPago = "";
        $formaPago = trim($row_datosCLTformaPago['fk_id_formapago']);
        $s_concepto = $row_datosCLTformaPago['s_concepto'];
        if( $fk_id_formaPago == $formaPago ){
            $txt_formaPago = $formaPago.' '.$s_concepto;
        }else{ $txt_formaPago = $fk_id_formapago; }
      }
    }

		$pagosDetalle .= "
			<tr class='row m-0 font12 elemento-pagos borderojo remove_$idFila'' id='$idFila'>
				<td class='col-md-1 text-right p-2 b'><b>Tipo Cadena:</b> </td>
				<td class='col-md-3 p-1'> <input class='h22 text-left t-tipoCadena efecto border-0 bt' type='text' id='tipoCadena_$idFila' value='$s_tipoCadPago' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-2'><b> Parcialidad: </b> </td>
				<td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-parcialidad' type='text' id='parcialidad_$idFila' value='$n_numParcialidad' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-4'><b> Importe: </b></td>
				<td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-importe' type='text' id='importe_$idFila' value='$n_importe' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-5'><b> Fecha: </b></td>
				<td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-fecha' type='text' id='fecha_$idFila' value='$d_fecha_docPago' readonly>
				<td class='p-1'></td>
				<td class='col-md-1 text-right p-2 b'><b> Certificado: </b></td>
				<td class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-certificado' type='text' id='certificado_$idFila' value='$s_certPago' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-2'><b> Factura: </b></td>
				<td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-factura' type='text' id='factura_$idFila' value='$fk_id_facturaDR' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-4'><b> IVA: </b></td>
				<td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-iva' type='text' id='iva_$idFila' value='$n_iva' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-5'><b> Forma Pago:</b> </td>
				<td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-formaPago' type='text' id='formaPago_$idFila' value='$fk_id_formapago' readonly></td>
				<td class='p-1'></td>
				<td class='col-md-1 text-right p-2 b'><b> Cadena Original:</b> </td>
				<td class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-cadenaOrig' type='text' id='cadenaOrig_$idFila' value='$s_cadPago' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-2'><b> T. Cambio:</b> </td>
				<td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-tipoCambio' type='text' id='tipoCambio_$idFila' value='$n_tipoCambio' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-4'><b> Saldo Anterior:</b> </td>
				<td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-saldoAnterior' type='text' id='saldoAnterior_$idFila' value='$n_importeSaldoAnterior' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-5'><b> # Autorización:</b></td>
				<td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-operacion' type='text' id='operacion_$idFila' value='$s_numOperacion' readonly></td>
				<td class='p-1'></td>
				<td class='col-md-1 text-right p-2 b'><b> Sello:</b></td>
				<td class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-sello' type='text' id='sello_$idFila' value='$s_selloPago' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-2'><b> Moneda:</b></td>
				<td class='col-md-1 p-1'> <input type='text' class='h22 efecto border-0 bt text-left t-monedaDR' id='monedaDR_$idFila' value='$fk_id_monedaDR' readonly /></td>
				<td class='col-md-1 text-right p-2 b ml-4'><b> Imp. Pagado:</b> </td>
				<td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-pagado' type='text' id='pagado_$idFila' value='$n_importePagado' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-5'><b> Cuenta Emisor:</b> </td>
				<td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-ctaE' type='text' id='ctaE_$idFila' value='$s_ctaOrd' readonly></td>
				<td class='p-1'></td>
				<td class='col-md-1 text-right p-2 b'><b> UUID:</b></td>
				<td class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-uuid' type='text' id='uuid_$idFila' value='$s_UUID_DR' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-2'><b> Total:</b></td>
				<td class='col-md-1 p-1'> <input name='text' type='text' class='h22 efecto border-0 bt text-left t-total' id='total_$idFila' value='$totalDR' readonly /></td>
				<td class='col-md-1 text-right p-2 b ml-4'><b> Saldo Insoluto:</b> </td>
				<td class='col-md-1 p-1'> <input class='h22 efecto border-0 bt text-left t-saldoInsoluto' type='text' id='saldoInsoluto_$idFila' value='$n_importeSaldoInsoluto' readonly></td>
				<td class='col-md-1 text-right p-2 b ml-5'><b> Banco Ext.: </b></td>
				<td class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-bcoExt' type='text' id='bcoExt_$idFila' value='$s_nomBancoOrdExt' readonly></td>
				<td class='p-1'></td>
				<td class='col-md-1'> <input class=' t-rfcE' type='hidden' id='rfcE_$idFila' value='$s_rfcOrd'></td>
				<td class='col-md-3'> <input class=' t-rfcR' type='hidden' id='rfcR_$idFila' value='$s_rfcBen'></td>
				<td class='col-md-1 ml-2'> <input class=' t-referencia' type='hidden' id='referencia_$idFila' value='$fk_referenciaDR'></td>
				<td class='col-md-1'> <input class=' t-tipoCambioDR' type='hidden' id='tipoCambioDR_$idFila' value='$n_tipoCambioDR'></td>
				<td class='col-md-1 ml-4'> <input class=' t-moneda' type='hidden' id='moneda_$idFila' value='$fk_id_moneda'><input class=' t-deposito' type='hidden' id='deposito_$idFila' value='$n_deposito'></td>
				<td class='col-md-1'> <input class=' t-metodoPagoDR' type='hidden' id='metodoPagoDR_$idFila' value='$fk_c_MetodoPagoDR'><input class=' t-aduanaDR' type='hidden' id='aduanaDR_$idFila' value='$fk_id_aduanaDR'></td>
				<td class='col-md-1 text-right p-2 b ml-5'> <b>Cta Receptor:</b> </td>
				<td class='col-md-2 p-1 mb-3'> <input class='h22 efecto border-0 bt text-left t-ctaR' type='text' id='ctaR_$idFila' value='$s_ctaBen' readonly></td>
		</tr> ";

    $ctaOrdenante = "";
    if( $s_ctaOrd != "" ){
      $ctaOrdenante = "
      <tr>
        <td bgcolor='#C0C0C0'>Cuenta:</td>
        <td>$s_ctaOrd</td>
        <td>&nbsp;</td>
      </tr>";
    }

    $bcoExtranjero = "";
    if( $s_nomBancoOrdExt != "" ){
      $bcoExtranjero = "
      <tr>
        <td bgcolor='#C0C0C0'>Banco Extranjero: </td>
        <td>$s_nomBancoOrdExt</td>
        <td>&nbsp;</td>
      </tr>";
    }

    $ctaReceptor = "";
    if( $s_ctaBen != "" ){
      $ctaReceptor = "
      <tr>
        <td bgcolor='#C0C0C0'>Cuenta:</td>
        <td>$s_ctaBen</td>
        <td>&nbsp;</td>
      </tr>";
    }

    $tr_SPEI = "";
    if( $s_certPago != "" || $s_cadPago != "" || $s_selloPago != "" ){
      $tr_SPEI = "
      <tr>
        <td colspan='6'>
          <table width='100%'  cellspacing='0' cellpadding='0'>
            <tr>
            <td width='12%' bgcolor='#C0C0C0'>Tipo Cadena</td>
            <td width='88%'>$s_tipoCadPago SPEI</td>
            </tr>
            <tr>
            <td bgcolor='#C0C0C0'>Certificado</td>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td colspan='2'>$s_certPago</td>
            </tr>
            <tr>
            <td bgcolor='#C0C0C0'>Cadena Original </td>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td colspan='2'>$s_cadPago</td>
            </tr>
            <tr>
            <td bgcolor='#C0C0C0'>Sello</td>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td colspan='2'>$s_selloPago</td>
            </tr>
          </table>
        </td>
      </tr>";
    }

    $pagosDetallePrint .= "
    <table width='100%' border='0' cellpadding='0' cellspacing='1' style='font-family: Trebuchet MS; font-size:10pt; border: 1px solid #000000;'>
      <tr bgcolor='#C0C0C0' align='center' style='color:#000000'>
        <td>Aduana</td>
        <td>Referencia</td>
        <td>Factura</td>
        <td>Mètodo Pago</td>
        <td>Moneda</td>
        <td>T. Cambio </td>
      </tr>
      <tr align='center'>
        <td>$fk_id_aduanaDR</td>
        <td>$fk_referenciaDR</td>
        <td>$fk_id_facturaDR</td>
        <td>$fk_c_MetodoPagoDR</td>
        <td>$fk_id_monedaDR</td>
        <td>$n_tipoCambioDR</td>
      </tr>
      <tr align='center'>
        <td bgcolor='#C0C0C0'>UUID:</td>
        <td colspan='3'>$s_UUID_DR</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor='#C0C0C0' align='center' style='color:#000000'>
        <td>Fecha</td>
        <td>Forma Pago </td>
        <td>Moneda</td>
        <td>T. Cambio </td>
        <td>Autorización</td>
        <td>Parcialidad</td>
      </tr>
      <tr align='center'>
        <td>$d_fecha_docPago</td>
        <td>$txt_formaPago</td>
        <td>$fk_id_moneda</td>
        <td>$n_tipoCambio</td>
        <td>$s_numOperacion</td>
        <td>$n_numParcialidad</td>
      </tr>
      <tr>
        <td colspan='3'>
    		<table width='100%' border='0' cellpadding='0' cellspacing='1' style='font-family: Trebuchet MS; font-size:10pt;'>
    		  <tr>
      			<td width='27%' bgcolor='#C0C0C0'>Emisor:</td>
      			<td width='45%'>$s_rfc</td>
      			<td width='28%'>&nbsp;</td>
    		  </tr>
    		  $ctaOrdenante
    		  $bcoExtranjero
          <tr>
            <td bgcolor='#C0C0C0'>Receptor:</td>
            <td>$s_rfcBen</td>
            <td>&nbsp;</td>
          </tr>
    		  $ctaReceptor
    		</table>	</td>
        <td colspan='3' valign='top' align='right'>
    		<table width='100%' border='0' cellpadding='0' cellspacing='1' style='font-family: Trebuchet MS; font-size:10pt;'>
    		  <tr align='right'>
    			<td width='61%'>&nbsp;</td>
    			<td width='11%' bgcolor='#C0C0C0'>Saldo Anterior: </td>
    			<td width='28%'>$n_importeSaldoAnterior2</td>
    		  </tr>
    		  <tr align='right'>
    			<td>&nbsp;</td>
    			<td bgcolor='#C0C0C0'>Importe Pagado </td>
    			<td>$n_importePagado</td>
    		  </tr>
    		  <tr align='right'>
    			<td>&nbsp;</td>
    			<td bgcolor='#C0C0C0'>Saldo Insoluto: </td>
    			<td>$n_importeSaldoInsoluto</td>
    		  </tr>
    		 </table>
    	</td>
      </tr>
      $tr_SPEI
    </table>
    <br>";

	}
  $fk_referencia  = trim($fk_referencia,'_');
}

?>

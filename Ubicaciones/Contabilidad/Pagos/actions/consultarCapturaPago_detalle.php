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
	$idFila = 0; $fk_referencia = ''; $pagosDetalle_pago = '';
	while( $row_consultaDetalle = $rslt_consultaDetalle->fetch_assoc()  ){
		++$idFila;
    $pagosDetallePrint_DR = '';
    $pagosDetalle_DR_consulta = '';

    $pk_id_pago_det = $row_consultaDetalle['pk_id_pago_det'];
		$d_fecha_docPago = $row_consultaDetalle['d_fecha_docPago'];
		$fk_id_formapago = trim($row_consultaDetalle['fk_id_formapago']);
		$s_numOperacion = $row_consultaDetalle['s_numOperacion'];
		$fk_id_moneda = $row_consultaDetalle['fk_id_moneda'];
		$n_tipoCambio = $row_consultaDetalle['n_tipoCambio'];
		$n_importe = $row_consultaDetalle['n_importe'];
		$s_rfcOrd = $row_consultaDetalle['s_rfcOrd'];
		$s_nomBancoOrdExt = $row_consultaDetalle['s_nomBancoOrdExt'];
		$s_ctaOrd = $row_consultaDetalle['s_ctaOrd'];
		$s_rfcBen = $row_consultaDetalle['s_rfcBen'];
		$s_ctaBen = $row_consultaDetalle['s_ctaBen'];
		$s_tipoCadPago = $row_consultaDetalle['s_tipoCadPago'];
		$s_certPago = $row_consultaDetalle['s_certPago'];
		$s_cadPago = $row_consultaDetalle['s_cadPago'];
		$s_selloPago = $row_consultaDetalle['s_selloPago'];
    $pk_rowPago = $row_consultaDetalle['n_pk_rowPago'];




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

    require $root . '/conta6/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_detalle_docRel.php';#$pagosDetalle_pago

    #if(tipoDocumento == 'modificar'){
      $btnEliminar = "<a href='#' class='eliminar-Pagos'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";
      $inputPartida = "<input class='id-partida' type='hidden' id='T_partida_$pk_rowPago' value='0'>";
    #}
		$pagosDetalle .= "
    <div class='elemento-pagDet'>
      <div class='row m-0 font12 elemento-pagos borderojo borrar-pago remove_$pk_rowPago' id='$pk_rowPago'>
        <div class='col-md-1 text-right p-2 b'><b>Tipo Cadena:</b> </div>
        <div class='col-md-3 p-1'><input class='h22 efecto text-left t-tipoCadena border-0 bt' type='text' id='tipoCadena_$pk_rowPago' value='$s_tipoCadPago' readonly></div>
        <div class='col-md-1 text-right p-2 b'><b> Cuenta Emisor:</b> </div>
        <div class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-ctaE' type='text' id='ctaE_$pk_rowPago' value='$s_ctaOrd' readonly></div>
        <div class='col-md-1 text-right p-2 b'><b> Fecha: </b></div>
        <div class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-fecha' type='text' id='fecha_$pk_rowPago' value='$d_fecha_docPago' readonly></div>
        <div class='col-md-1 p-1'>
          $btnEliminar
          $inputPartida
          <input class=' t-pagosDET' type='hidden' id='pagosDET_$pk_rowPago' value='$pk_id_pago_det'>
        </div>

        <div class='col-md-1 text-right p-2 b'><b> Certificado: </b></div>
        <div class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-certificado' type='text' id='certificado_$pk_rowPago' value='$s_certPago' readonly></div>
        <div class='col-md-1 text-right p-2 b'><b> Banco Ext.: </b></div>
        <div class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-bcoExt' type='text' id='bcoExt_$pk_rowPago' value='$s_nomBancoOrdExt' readonly></div>
        <div class='col-md-1 text-right p-2 b'><b> Forma Pago:</b> </div>
        <div class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-formaPago' type='text' id='formaPago_$pk_rowPago' value='$fk_id_formapago' readonly></div>
        <div class='col-md-1'></div>

        <div class='col-md-1 text-right p-2 b'><b> Cadena Original:</b> </div>
        <div class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-cadenaOrig' type='text' id='cadenaOrig_$pk_rowPago' value='$s_cadPago' readonly></div>
        <div class='col-md-1 text-right p-2 b'> <b>Cta Receptor:</b> </div>
        <div class='col-md-3 p-1'> <input class='h22 efecto border-0 bt text-left t-ctaR' type='text' id='ctaR_$pk_rowPago' value='$s_ctaBen' readonly></div>
        <div class='col-md-1 text-right p-2 b'><b> # Autorización:</b></div>
        <div class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-operacion' type='text' id='operacion_$pk_rowPago' value='$s_numOperacion' readonly></div>
        <div class='col-md-1'></div>

        <div class='col-md-1 text-right p-2 b'><b> Sello:</b></div>
        <div class='col-md-3 p-1'><input class='h22 efecto border-0 bt text-left t-sello' type='text' id='sello_$pk_rowPago' value='$s_selloPago' readonly></div>
        <div class='col-md-1'> <input class=' t-rfcE' type='hidden' id='rfcE_$pk_rowPago' value='$s_rfcOrd'></div>
        <div class='col-md-3'> <input class=' t-rfcR' type='hidden' id='rfcR_$pk_rowPago' value='$s_rfcBen'></div>
        <div class='col-md-1 text-right p-2 b'><b> Importe: </b></div>
        <div class='col-md-2 p-1'> <input class='h22 efecto border-0 bt text-left t-importe' type='text' id='importe_$pk_rowPago' value='$n_importe' readonly></div>
        <div class='col-md-1 p-1'>
          <input class=' t-tipoCambio' type='hidden' id='tipoCambio_$pk_rowPago' value='$n_tipoCambio'>
          <input class=' t-moneda' type='hidden' id='moneda_$pk_rowPago' value='$fk_id_moneda'>
          <input class=' t-idPago' type='hidden' id='idPago_$pk_rowPago' value='$pk_rowPago'>
        </div>
      </div>".$pagosDetalle_pago.
    "</div>";

    $pagosDetalle_consulta .= "
    <div class='row m-0 font12 borderojo elemento-pagos borrar-pago remove_$pk_rowPago' id='$pk_rowPago'>
      <div class='col-md-1 text-right p-2 b'><b>Tipo Cadena:</b> </div>
      <div class='col-md-3 p-1'>$s_tipoCadPago</div>
      <div class='col-md-1 text-right p-2 b'><b> Cuenta Emisor:</b> </div>
      <div class='col-md-3 p-1'>$s_ctaOrd</div>
      <div class='col-md-1 text-right p-2 b'><b> Fecha: </b></div>
      <div class='col-md-2 p-1'>$d_fecha_docPago</div>
      <div class='col-md-1 p-1'></div>

      <div class='col-md-1 text-right p-2 b'><b> Certificado: </b></div>
      <div class='col-md-3 p-1'>$s_certPago</div>
      <div class='col-md-1 text-right p-2 b'><b> Banco Ext.: </b></div>
      <div class='col-md-3 p-1'>$s_nomBancoOrdExt</div>
      <div class='col-md-1 text-right p-2 b'><b> Forma Pago:</b> </div>
      <div class='col-md-2 p-1'>$fk_id_formapago</div>
      <div class='col-md-1'></div>

      <div class='col-md-1 text-right p-2 b'><b> Cadena Original:</b> </div>
      <div class='col-md-3 p-1'>$s_cadPago</div>
      <div class='col-md-1 text-right p-2 b'> <b>Cta Receptor:</b> </div>
      <div class='col-md-3 p-1'>$s_ctaBen</div>
      <div class='col-md-1 text-right p-2 b'><b> # Autorización:</b></div>
      <div class='col-md-2 p-1'>$s_numOperacion</div>
      <div class='col-md-1'></div>

      <div class='col-md-1 text-right p-2 b'><b> Sello:</b></div>
      <div class='col-md-3 p-1'>$s_selloPago</div>
      <div class='col-md-1'>$s_rfcOrd</div>
      <div class='col-md-3'>$s_rfcBen</div>
      <div class='col-md-1 text-right p-2 b'><b> Importe: </b></div>
      <div class='col-md-2 p-1'>$n_importe</div>
      <div class='col-md-1 p-1'>
        <b>Tipo Cambio:</b> $n_tipoCambio /
        <b>Moneda:</b>$fk_id_moneda
      </div>
    </div>".$pagosDetalle_pago_consulta;


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
      <tr bgcolor='#7F7F7F' align='center' style='color:#000000'>
        <td>Fecha</td>
        <td>Forma Pago </td>
        <td>Autorización</td>
		<td>Moneda</td>
        <td>T. Cambio </td>
        <td>Importe</td>
      </tr>
      <tr align='center'>
        <td>$d_fecha_docPago</td>
        <td>$txt_formaPago</td>
        <td>$s_numOperacion</td>
		    <td>$fk_id_moneda</td>
        <td>$n_tipoCambio</td>
        <td>$n_importePagado</td>
      </tr>
	  <tr bgcolor='#7F7F7F' align='center' style='color:#000000'>
        <td>Emisor</td>
        <td>Cuenta</td>
        <td colspan='2'>Banco Ext.</td>
		    <td>Receptor</td>
        <td>Cuenta</td>
      </tr>
	  <tr align='center'>
        <td>$s_rfc</td>
        <td>$s_ctaOrd</td>
        <td colspan='2'>$s_nomBancoOrdExt</td>
		    <td>$s_rfcBen</td>
        <td>$s_ctaBen</td>
      </tr>
	  $tr_SPEI
  </table>
  <br>".$pagosDetallePrint_DR;

	}# fin 	while( $row_consultaDetalle
  $fk_referencia  = trim($fk_referencia,'_');
}

?>

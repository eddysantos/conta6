<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Conta6/Resources/vendor/autoload.php';
require $root . '/Conta6/Resources/PHP/Utilities/initialScript.php';


$cuenta = trim($_GET['cuenta']);
//$id_cliente = trim($_GET['id_cliente']);

require $root . '/conta6/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_datosGenerales.php';
// require $root . '/conta6/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_detalle.php'; # $pagosDetallePrint

$mostrarSustituir = false;
if( is_null($s_UUIDpagoSustituir) ){
	$fk_c_TipoRelacion = '';
	$n_folioPagoSustituir = '';
	$s_UUIDpagoSustituir = '';
	$mostrarSustituir = true;
}


	#http://localhost:88/contabilidad/pagosElectronicos/reciboPagos/elaborar_reciboPagos.php?usuario=admado&id_factura=73731&oficina=470&id_cliente=CLT_7621&id_docPago=4

	// include ("../../../include/conexion.php");
	// include ("../../../include/cortarDecimales_a3dig.php");

	$cliente = trim($_GET['id_cliente']);
	$id_factura = trim($_GET['id_factura']);
	$id_docPago = trim($_GET['id_docPago']);

	$sql_Cliente = mysqli_fetch_array(mysqli_query($link,"SELECT * from TBL_CLIENTES WHERE ID_CLIENTE = '$cliente'"));
	$oRst_Facturas = mysqli_fetch_array(mysqli_query($link,"SELECT * from TBL_FACTURAS_CFD WHERE id_factura = '$id_factura'"));
	$sql_formaPago = mysqli_query($link,"SELECT * FROM tbl_metpago_sat WHERE ACTIVO ='S';");
	$sql_moneda = mysqli_query($link,"select * from TBL_MONEDAS_SAT where activo = 'S' order by moneda");
	$sql_moneda2 = mysqli_query($link,"select * from TBL_MONEDAS_SAT where activo = 'S' order by moneda");
	$sql_bancosCIA = mysqli_query($link,"SELECT B.NOMBRE AS nomBanco,A.ID_BANCO,A.CTAORI,A.ID_ADUANA,A.NOMBRE,A.RFC,B.NOMBRE
										FROM TBL_BANCOS_CIA A, TBL_BANCOS_SAT B
										WHERE A.ID_BANCO = B.ID_BANCO ORDER BY A.NOMBRE");

	$oRst_Pago = mysqli_fetch_array(mysqli_query($link,"SELECT * from tbl_pagos_cfdi WHERE id_docPago = $id_docPago"));
	$sql_pagoDetalle = mysqli_query($link,"select * from TBL_PAGOS_CFDI_detalle where id_docPago = $id_docPago");
	$total_pagoDetalle = mysqli_num_rows($sql_pagoDetalle);

	$oRst_TotalPagoDet = mysqli_fetch_array(mysqli_query($link,"SELECT truncate(sum(importe),2) as totalPagado FROM cplaa.tbl_pagos_cfdi_detalle where id_docPago = $id_docPago"));

	$tabindex=0;


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
      $pagosDetallePrint_PDF = '';
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
        <div class='row m-0 font12 elemento-pagos borrar-pago remove_$pk_rowPago' id='$pk_rowPago'>
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
      <div class='row m-0 font12 elemento-pagos borrar-pago remove_$pk_rowPago' id='$pk_rowPago'>
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
      $tr_SPEI = '
        <tr>
          <td width="15%" bgcolor="#ccc">Tipo Cadena</td>
          <td width="85%">'.$s_tipoCadPago.' SPEI</td>
        </tr>
        <tr>
          <td width="15%" bgcolor="#ccc">Certificado</td>
          <td width="85%">&nbsp;</td>
        </tr>
        <tr>
          <td width="100%">'.$s_certPago.'</td>
        </tr>
        <tr>
          <td width="15%" bgcolor="#ccc">Cadena Original </td>
          <td width="85%">&nbsp;</td>
        </tr>
        <tr>
          <td width="100%">'.$s_cadPago.'</td>
        </tr>
        <tr>
          <td width="15%" bgcolor="#ccc">Sello</td>
          <td width="85%">&nbsp;</td>
        </tr>
        <tr>
          <td width="100%">'.$s_selloPago.'</td>
        </tr>';
    }

  $pagosDetallePrint .= '
  <table class="border">
    <tbody>
      <tr>
				<td width="15%" align="right"><b>Emisor :</b></td>
				<td width="19%" align="left">'.$s_rfc.'</td>

        <td width="15%" align="right"><b>Fecha :</b></td>
        <td width="18%" align="left">'.$d_fecha_docPago.'</td>
        <td width="15%" align="right"><b>T. Cambio :</b></td>
        <td width="18%" align="left">'.$n_tipoCambio.'</td>
      </tr>

      <tr>
				<td width="15%" align="right"><b>Cuenta :</b></td>
				<td width="19%" align="left">'.$s_ctaOrd.'</td>

        <td width="15%" align="right"><b>Forma Pago :</b></td>
        <td width="18%" align="left">'.$txt_formaPago.'</td>
        <td width="15%" align="right"><b>Importe :</b></td>
        <td width="18%" align="left">'.$n_importePagado.'</td>
      </tr>

      <tr>
				<td width="15%" align="right"><b>Banco Ext :</b></td>
				<td width="19%" align="left">'.$s_nomBancoOrdExt.'</td>

        <td width="15%" align="right"><b>Autorización :</b></td>
        <td width="18%" align="left">'.$s_numOperacion.'</td>
				<td width="15%" align="right"><b>Moneda :</b></td>
        <td width="18%" align="left">'.$fk_id_moneda.'</td>

      </tr>

      <tr>
				<td width="15%" align="right"><b>Receptor :</b></td>
				<td width="19%" align="left">'.$s_rfcBen.'</td>
      </tr>

			<tr>
				<td width="15%" align="right"><b>Cuenta :</b></td>
				<td width="13%" align="left">'.$s_ctaBen.'</td>
      </tr>

			'.$tr_SPEI.'
			</tbody>
    </table>
    <br />'.$pagosDetallePrint_PDF.'';

  	}# fin 	while( $row_consultaDetalle
    $fk_referencia  = trim($fk_referencia,'_');
  }


  $nombreArchivo = $cuenta.'pago.pdf';

class MYPDF extends TCPDF {
  public function Header() {
    $image_file = 'imagenes/cheetah.svg';
    $this->ImageSVG($image_file, 5, 10, '', 10, '', '','', 0,false);
    $this->setTextColor(102);
    $this->SetFont('helvetica', '', 10);
    $this->Cell(0, 0, date('m-d-Y', strtotime('today')) , 0, 1, 'R', 0, '', 0, false, 'T', 'C');
    $this->SetFont('helvetica', '', 12);
    $this->Cell(0, 12, 'RECIBO DE PAGO', 0, 1, 'C', 0, '', 0, false, 'T', 'C');
  }

  public function Footer() {
    $this->SetY(-15);
    $this->SetFont('helvetica', 'I', 8);
  }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(5, 30, 5);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFont('courier', '', 9);
$pdf->AddPage();



$client = '<style>
   .border{
     border-top:1px solid black;
     border-left:1px solid black;
     border-right:1px solid black;
     border-bottom:1px solid black;
    }
    table{
      margin:5px;
    }
</style>
<table>
  <tr>
    <td width="50%">
    <br />
      <table class="border">
        <thead>
          <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
            <td width="100%" align="center">Cliente</td>
          </tr>
        </thead>
        <tbody>
          <tr><td width="100%"><b>Nombre :</b> ' . $s_nombre.'</td></tr>
          <tr><td width="100%"><b>Calle y Num :</b> ' . $s_calle.' '.$s_no_ext.' '.$s_no_int.'</td></tr>
          <tr><td width="100%"><b>Colonia :</b> ' . $s_colonia.'</td></tr>
          <tr><td width="100%"><b>Estado  y C.P :</b>  '.$s_ciudad.', '.$s_estado.' ' . $s_codigo.'</td></tr>
          <tr><td width="100%"><b>RFC:</b> ' . $s_rfc.'</td></tr>
        </tbody>
      </table>
    </td>
    <td width="50%">
      <table class="border">
        <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
          <td width="30%" align="center">SOLICITUD</td>
          <td width="70%" align="center">LUGAR Y FECHA</td>
        </tr>
        <tr>
          <td width="30%" align="center">'.$pk_id_pago_captura.'</td>
          <td width="70%" align="center">'.$s_lugarExpedicion_txt.'</td>
        </tr>
      </table>
    </td>
  </tr>
</table>';


$descripcion = '<div border="1"><table>
  <thead>
    <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)" align="center">
      <td width="10%">Cantidad</td>
      <td width="10%">Unidad</td>
      <td width="12%">CveServProd</td>
      <td width="40%" align="center">Descripción</td>
      <td width="18%">Valor Unitario</td>
      <td width="10%">Importe</td>
    </tr>
</thead>
<tbody>
  <tr align="center">
    <td width="10%">'.$n_cantidad.'</td>
    <td width="10%">'.$fk_c_claveUnidad.'</td>
    <td width="12%">'.$fk_c_ClaveProdServ.'</td>
    <td width="40%" align="center">'.$s_descripcion.'</td>
    <td width="18%">'.$n_valor_unitario.'</td>
    <td width="10%">'.$n_valor_importe.'</td>
  </tr>
</tbody>
</table>
</div><br>';

$tipoRelacion = '<div border="1"><table>
  <thead>
    <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)" align="center">
      <td width="25%">Sustituye al pago</td>
      <td width="25%">UUID</td>
      <td width="50%" align="center">Tipo Relación</td>
    </tr>
</thead>
<tbody>
  <tr align="center">
    <td width="25%">'.$n_folioPagoSustituir.'</td>
    <td width="25%">'.$s_UUIDpagoSustituir.'</td>
    <td width="50%" align="center">'.$fk_c_TipoRelacion.' Sustitución de los CFDI previos</td>
  </tr>
</tbody>
</table>
</div><br>';

$detalle = '
<style>
   .border{
     border-top:1px solid black;
     border-left:1px solid black;
     border-right:1px solid black;
     border-bottom:1px solid black;
    }
		.border1{
      border-top:1px solid black;
      border-left:1px solid black;
      border-right:1px solid black;
     }
    .border2{
      border-bottom:2px solid black;
     }
</style>
<table>
  <thead>
    <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)" align="center">
      <td width="100%">COMPLEMENTO DE RECEPCIÓN DE PAGOS</td>
    </tr>
</thead>
</table>
<br/>
<br/>
    '.$pagosDetallePrint.'
  ';






$pdf->writeHTML($client, true, false, true, false, '');
$pdf->writeHTML($descripcion, true, false, true, false, '');


if ($mostrarSustituir == true ) {
  $pdf->writeHTML($tipoRelacion, true, false, true, false, '');
}

$pdf->writeHTML($detalle, true, false, true, false, '');






$pdf->lastPage();
$pdf->Output($nombreArchivo, 'I');
?>

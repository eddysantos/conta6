<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Conta6/Resources/vendor/autoload.php';
require $root . '/Conta6/Resources/PHP/Utilities/initialScript.php';

$cuenta = trim($_GET['cuenta']);
$txt_id_asoc = 'No';
require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosGenerales.php';
require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosEmbarque.php'; #$datosEmbarque
require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosPOCME.php'; # $datosPOCME
require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosCargos.php'; #$datosCargos
require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosHonorarios.php'; #$datosHonorarios
require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosDepositos.php'; #$datosDepositos

$nombreArchivo = $fk_referencia.'_'.$pk_id_cuenta_captura.'_profNC.pdf';

class MYPDF extends TCPDF {
  public function Header() {
    $image_file = 'imagenes/cheetah.svg';
    $this->ImageSVG($image_file, 5, 10, '', 10, '', '','', 0,false);
    $this->setTextColor(102);
    $this->SetFont('helvetica', '', 10);
    $this->Cell(0, 0, date('m-d-Y', strtotime('today')) , 0, 1, 'R', 0, '', 0, false, 'T', 'C');
    $this->SetFont('helvetica', '', 12);
    $this->Cell(0, 12,'PROFORMA NOTA DE CRÉDITO', 0, 1, 'C', 0, '', 0, false, 'T', 'C');
  }

  public function Footer() {
    $this->SetY(-15);
    $this->SetFont('helvetica', 'I', 8);
  }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(5, 30, 5);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
//     require_once(dirname(__FILE__).'/lang/eng.php');
//     $pdf->setLanguageArray($l);
// }
$pdf->SetFont('courier', '', 9);
$pdf->AddPage();

$EmbarqueYCliente = '<style>
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
          <tr><td width="100%">' . $s_nombre.'</td></tr>
          <tr><td width="100%">' . $s_calle.' '.$s_no_ext.' '.$s_no_int.'</td></tr>
          <tr><td width="100%">' . $s_colonia.'</td></tr>
          <tr><td width="100%">' . $s_codigo.' '.$s_ciudad.', '.$s_estado.'</td></tr>
          <tr><td width="100%"><b>RFC:</b> ' . $s_rfc.'</td></tr>
        </tbody>
      </table>
      <br />
      <br />
      <table class="border">
        <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)"><td width="100%" align="center">Proveedor</td></tr>
        <tr><td width="100%">'.$s_proveedor_destinatario.'</td></tr>
      </table>
    </td>
    <td width="50%"><br />
      <table class="border">
        <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)"><td width="100%" align="center">PROFORMA NOTA DE CREDITO</td></tr>
        <tr><td width="100%" align="center">'.$pk_id_cuenta_captura.'</td></tr>
      </table>
      <br/>
      <br/>
      <table class="border">
        <thead>
          <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)"><td width="100%" align="center">INFORMACIÓN GENERAL DEL EMBARQUE</td></tr>
        </thead>
        <tbody>
          '.$impresionDatosEmbarque.'
        </tbody>
      </table><br>
    </td>
  </tr>
</table>';



$pagosMonedaExtranjera = '<div border="1"><table>
  <thead>
    <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)"><td width="100%" align="center">PAGOS O CARGOS EN MONEDA EXTRANJERA</td></tr>
</thead>
<tbody>
  '.$datosPOCMEImprimir.'
</tbody>
</table></div><br>';


$tipoCambio = '<style>
   .border{
     border-top:1px solid black;
     border-left:1px solid black;
     border-right:1px solid black;
     border-bottom:1px solid black;
    }
</style>
<table class="border">
  <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
    <td width="30%">TOTAL</td>
    <td width="40%">AL TIPO DE CAMBIO</td>
    <td width="30%">TOTAL MN.</td>
  </tr>

  <tr>
    <td width="30%">'.number_format($n_POCME_total_gral,2,'.',',').'</td>
    <td width="40%">'.$n_POCME_tipo_cambio.'</td>
    <td width="30%">'.number_format($n_POCME_total_MN,2,'.',',').'</td>
  </tr>
</table>';

$pagosCuentaCliente = '<div border="1"><table>
  <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
    <td width="10%"></td>
    <td width="65%">PAGOS REALIZADOS POR SU CUENTA</td>
    <td width="15%">SUBTOTAL</td>
    <td width="10%"></td>
  </tr>
  <tbody>
    '.$datosCargosImpresion .'
  </tbody>
</table>
</div><br />';

$honorarios = '<div border="1"><table>
    <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
      <td width="52%">HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR</td>
      <td width="12%">IMPORTE</td>
      <td width="12%">IVA</td>
      <td width="12%">RET</td>
      <td width="12%">TOTAL</td>
    </tr>
    '.$datosHonorariosImprimir.'
</table>
</div><br />';


$totalesfinales = '<div border="1">
<table>
  <tr>
    <td width="30%"><table>
        <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
          <td width="50%">Depósito</td>
          <td width="50%">Importe</td>
        </tr>
        '.$datosDepositosImprimir.'
      </table>
    </td>
    <td width="70%"><table>
        <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
          <td width="70%">Conceptos</td>
          <td width="30%">Totales</td>
        </tr>
        <tr>
    			<td width="70%" align="right">'.$s_txt_gral_importe.' :</td>
    			<td width="30%">'.number_format($n_total_gral_importe,2,'.',',').'</td>
        </tr>
  		  <tr>
    			<td width="70%" align="right">'.$n_txt_gral_IVA.' :</td>
    			<td width="30%">'.number_format($n_total_gral_IVA,2,'.',',').'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right">'.$s_txt_total_honorarios.' :</td>
    			<td width="30%">'.number_format($n_total_honorarios,2,'.',',').'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right">'.$s_txt_fac_IVA_retenido.' :</td>
    			<td width="30%">'.number_format($s_fac_IVA_retenido,2,'.',',').'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right">'.$s_txt_total_gral.' :</td>
    			<td width="30%">'.number_format($n_total_gral,2,'.',',').'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right">'.$s_POCME_descripcion_gral.' :</td>
  			  <td width="30%">'.number_format($n_total_POCME,2,'.',',').'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right">'.$s_txt_total_pagos.' :</td>
    			<td width="30%">'.number_format($n_total_pagos,2,'.',',').'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right">'.$s_txt_cta_gastos.' :</td>
    			<td width="30%">'.number_format($n_total_cta_gastos,2,'.',',').'</td>
  		  </tr>
  		  <tr>
    			<td width="100%">'.trim($s_total_cta_gastos_letra).'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right">'.$s_txt_total_depositos.'</td>
    			<td width="30%">'.number_format($n_total_depositos,2,'.',',').'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right"><b>'.$s_txt_fac_saldo.' :</b></td>
    			<td width="30%">'.number_format($n_fac_saldo,2,'.',',').'</td>
  		  </tr>
      </table>
    </td>
  </tr>
</table></div>';


$pdf->writeHTML($EmbarqueYCliente, true, false, true, false, '');
$pdf->writeHTML($pagosMonedaExtranjera, true, false, true, false, '');
$pdf->writeHTML($tipoCambio, true, false, true, false, 'C');
$pdf->writeHTML($pagosCuentaCliente, true, false, true, false, 'C');
$pdf->writeHTML($honorarios, true, false, true, false, 'C');
$pdf->writeHTML($totalesfinales, true, false, true, false, 'C');


$pdf->lastPage();
$pdf->Output($nombreArchivo, 'I');
 ?>

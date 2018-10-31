<?php
#http://localhost:88/conta6/ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5impresoHTML_2.php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Conta6/Resources/vendor/autoload.php';
  require $root . '/Conta6/Resources/PHP/Utilities/initialScript.php';

  #$cuenta = trim($_GET['cuenta']);
  $cuenta = 172;
  $fileQR = $root . '/Conta6/CFDI_generados/2018/CLT_7345/QR/N13003039_9_factura.png';
  #require $root . '/conta6/Resources/PHP/actions/consultaDatosCIA.php';
  $d_fechavencimiento = '';
  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarFactura.php';
  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosGenerales.php';
  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosEmbarque.php'; #$datosEmbarque
  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosPOCME.php'; # $datosPOCME
  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosCargos.php'; #$datosCargos
  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosHonorarios.php'; #$datosHonorarios
  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosDepositos.php'; #$datosDepositos
  $id_cliente = $fk_id_cliente;
  require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente_formaPago.php';#$formaPago

  if ($rows_datosCLTformaPago > 0 ) {
    while ($row_datosCLTformaPago = $rslt_datosCLTformaPago->fetch_assoc()) {
      $fk_id_formaPago = $row_datosCLTformaPago['fk_id_formapago'];
      $s_concepto = $row_datosCLTformaPago['s_concepto'];
      if( $formaPago == $fk_id_formaPago ){
          $txt_formaPago = $fk_id_formaPago.' '.$s_concepto;
      }
    }
  }

  require $root . '/conta6/Resources/PHP/actions/consultaUsoCFDI_facturar.php';
  $id_captura = $cuenta;
  require $root . '/conta6/Resources/PHP/actions/consultaFactura_ctaGastos.php';
  if( $fk_c_MetodoPago == 'PUE' ){ $descMetodoPago = 'PUE  Pago en una sola exhibici&oacute;n'; }
  if( $fk_c_MetodoPago == 'PPD' ){ $descMetodoPago = 'PPD  Pago en parcialidades o diferido'; }
  $regimen = "601 General de Ley Personas Morales";
  $cadenaSAT = "||".$s_timbradoVersion."|".$s_UUID."|".$d_fechaTimbrado."|".$s_selloCFDI."|".$s_id_certificadoSAT."||";



   // ***************************** //
  //   O B S E R V A C I O N E S   //
 //****************************** //
$observacionesPLAA = "Observaciones: La empresa así como sus representantes o corresponsales en el país o en el extranjero, consideran en cada operación que las mercancías se encuentran aseguradas desde la puerta del domicilio de los embarcadores hasta el destino final, con motivo de la importación o de la exportación; razón por la cual no tomara responsabilidad alguna por perdidas, mermas, daños, robo o averías de cualquier índole parciales o totales, excepto en los casos en que los consignatarios en importación o los remitentes en exportación manifiesten en cada ocasión por escrito y previo al arribo de las mercancías a los almacenes de reexpedición o de despacho que desean asegurar sus embarques.";




class MYPDF extends TCPDF {
  public function Header() {
    $image_file =  'imagenes/cheetah.svg';
    $this->ImageSVG($image_file, 5, 10, '', 10, '', '','', 0,false);
    $this->setTextColor(102);
    $this->SetFont('helvetica', '', 10);
    $this->Cell(0, 0, date('m-d-Y', strtotime('today')) , 0, 1, 'R', 0, '', 0, false, 'T', 'C');
    $this->SetFont('helvetica', '', 12);
    $this->Cell(0, 12, 'FACTURA ELECTRONICA', 0, 1, 'C', 0, '', 0, false, 'T', 'C');
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


$ClienteYFactura = '<style>
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
    <td width="45%">
    <br />
      <table class="border">
        <thead>
          <tr bgcolor="#e00000" color="rgb(255, 255, 255)">
            <td width="100%" align="center"><b>CLIENTE</b></td>
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
    </td>
    <td width="55%">
      <table class="border">
        <thead>
          <tr bgcolor="#e00000" color="rgb(255, 255, 255)" align="center">
            <td width="100%"><b>FECHA VENCIMIENTO</b></td>
          </tr>
          <tr>
            <td width="100%">'.$d_fechaVencimiento.'</td>
          </tr>
          <tr bgcolor="#e00000" color="rgb(255, 255, 255)" align="center">
            <td width="20%"><b>FACTURA</b></td>
            <td width="45%"><b>NO.CERTIFICADO</b></td>
            <td width="35%"><b>LUGAR Y FECHA</b></td>
          </tr>
        </thead>
        <tbody>
          <tr align="center">
            <td width="20%"><b>'.$pk_id_factura.'</b></td>
            <td width="45%">'.$fk_id_certificado.'</td>
            <td width="35%"><font>'.$s_lugarExpedicion_txt.'</font><br/>'.$d_fechaTimbrado.' </td>
          </tr>
        </tbody>
      </table>
    </td>
  </tr>
</table>';

$pdf->SetFont('courier', '', 8);

$InfoHonorarios = '<style>
   .border{
     border-top:1px solid black;
     border-left:1px solid black;
     border-right:1px solid black;
     border-bottom:1px solid black;
    }
</style>
<table class="border">
  <thead>
    <tr bgcolor="#e00000" color="rgb(255, 255, 255)" align="center">
      <td width="10%"><b>CANTIDAD</b></td>
      <td width="15%"><b>UNIDAD</b></td>
      <td width="10%"><b>ProdServ</b></td>
      <td width="45%" align="left"><b>HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR</b></td>
      <td width="20%" align="right"><b>IMPORTE</b></td>
    </tr>
  </thead>
  <tbody>
    '.$datosHonorariosXML.'
  </tbody>
</table>';

$pdf->SetFont('courier', '', 7.5);

$metPagoYtotHonorarios = '<style>
   .border{
     border-top:1px solid black;
     border-left:1px solid black;
     border-right:1px solid black;
     border-bottom:1px solid black;
    }
</style>
<div border="1">
<table>
  <tr>
    <td width="45%">
    <br/>
      <table>
        <tr>
          <td width="32%" align="right"><b>Método de Pago:</b></td>
          <td width="68%">'.$descMetodoPago.'</td>
        </tr>
        <tr>
          <td width="32%" align="right"><b>Forma de Pago:</b></td>
          <td width="68%">'.$txt_formaPago.'</td>
        </tr>

        <tr>
          <td width="32%" align="right"><b>Régimen Fiscal:</b></td>
          <td width="68%">'.$regimen.'</td>
        </tr>
        <tr>
          <td width="32%" align="right"><b>Uso de CFDI:</b></td>
          <td width="68%">'.$txt_UsoCFDI.'</td>
        </tr>
      </table>
    </td>
    <td width="55%">
      <table>
        <tr>
          <td width="60%" align="right"><b>'.$s_txt_gral_importe.'</b></td>
          <td width="40%" align="right">'.number_format($n_total_gral_importe,2,'.',',').'</td>
        </tr>
        <tr>
          <td width="60%" align="right"><b>'.$n_txt_gral_IVA.'</b></td>
          <td width="40%" align="right">'.number_format($n_total_gral_IVA,2,'.',',').'</td>
        </tr>
        <tr>
          <td width="60%" align="right"><b>'.$s_txt_total_honorarios.'</b></td>
          <td width="40%" align="right">'.number_format($n_total_honorarios,2,'.',',').'</td>
        </tr>
        <tr>
          <td width="60%" align="right"><b>'.$s_txt_fac_IVA_retenido.'</b></td>
          <td width="40%" align="right">'.number_format($s_fac_IVA_retenido,2,'.',',').'</td>
        </tr>
        <tr>
          <td width="60%" align="right"><b>'.$s_txt_total_gral.'</b></td>
          <td width="40%" align="right">'.number_format($n_total_gral,2,'.',',').'</td>
        </tr>
      </table>
    </td>
  </tr></table></div> <br /><br />';


$pdf->SetFont('courier', '', 6.5);

$datosTimbrado = '<style>
   .border{
     border-top:1px solid black;
     border-left:1px solid black;
     border-right:1px solid black;
     border-bottom:1px solid black;
    }
</style>
<table class="border">
  <thead>
    <tr bgcolor="#e00000" color="rgb(255, 255, 255)" align="center">
      <td width="100%"><b>DATOS TIMBRADO VERSIÓN '.$s_CFDversion.'</b></td>
    </tr>
  </thead>
  <tbody>
    <tr align="left">
      <td width="20%"><b>Folio Fiscal</b>
        <br>'.$s_UUID.'
        <br><b>Certificado Digital SAT</b> '.$s_id_certificadoSAT.'
        <br><b>Fecha de Certificación</b> '.$d_fechaTimbrado.'
        <br><img src="'.$fileQR.'" border="0"/>
      </td>
      <td widht="80%" style="font-size:6pt;">
        <b>Cadena Original del Complemento de Certificación Digital del SAT</b>
        <br>'.wordwrap($cadenaSAT, 150,"<br>",1).'
        <br><br><b>Sello Digital</b>
        <br>'.wordwrap($s_selloCFDI, 150,"<br>",1).'
        <br><br><b>Sello Digital SAT</b>
        <br>'.wordwrap($s_selloSAT, 150,"<br>",1).'
        <br><br><font color="#FF0000" style="font-size:7pt"><b>Este documento es una representación impresa de un CFDI</b></font>
        <br>'.wordwrap($observacionesPLAA, 200,"<br>",1).'
      </td>
    </tr>
  </tbody>
</table>
<br />  <br /> <br />
<table  style="color:#FF0000; font-size:8pt;">
  <tr align="center" >
    <td width="30%" align="right"><img width="12px" src="imagenes/cut1.png"></td>
    <td width="70%" align="left">Esta sección es unicamente informativa sin validez oficial.</td>
  </tr>
</table>';


$EmbarqueYProv= '<style>
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
        <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)"><td width="100%" align="center">Proveedor (IMP) o Destinatario (EXP)</td></tr>
        <tr><td width="100%">'.preg_replace('/&/', '&amp;', preg_replace('/´/', '', utf8_encode($s_proveedor_destinatario))).'</td></tr>
      </table>
      <br />
      <br />
      <table class="border">
        <thead>
          <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
            <td width="100%" align="center">PAGOS O CARGOS EN MONEDA EXTRANJERA</td>
          </tr>
        </thead>
        <tbody>
          '.$datosPOCMEImprimir.'
        </tbody>
      </table>
      <br /><br />
      <table class="border" align="center">
        <thead>
          <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
            <td width="33%">TOTAL</td>
            <td width="33%">AL TIPO DE CAMBIO</td>
            <td width="34%">TOTAL MN.</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td width="33%">'.number_format($n_POCME_total_gral,2,'.','').'</td>
            <td width="33%">'.number_format($n_POCME_tipo_cambio,2,'.','').'</td>
            <td width="34%">'.number_format($n_POCME_total_MN,2,'.','').'</td>
          </tr>
        </tbody>
      </table>
      <br />
      <br />
      <table class="border" align="center">
        <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
          <td>FOLIO DE CUENTA DE GASTOS</td>
        </tr>
        <tr>
          <td><b>'.$id_ctagastos.'</b></td>
        </tr>
      </table>
    </td>
    <td width="50%">
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

$pgosxCuentaCliente ='<style>
   .border{
     border-top:1px solid black;
     border-left:1px solid black;
     border-right:1px solid black;
     border-bottom:1px solid black;
    }
</style>
<table class="border" align="center">
  <thead>
    <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
      <td width="10%"></td>
      <td width="65%">PAGOS REALIZADOS POR SU CUENTA</td>
      <td width="15%">SUBTOTAL</td>
      <td width="10%"></td>
    </tr>
  </thead>
  <tbody>
  '.$datosCargosImpresion.'
  </tbody>
</table>
<br />';


$conceptosYtot = '<div border="1">
<table>
  <tr>
    <td width="30%"><table align="center">
        <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
          <td width="50%">Depósito</td>
          <td width="50%">Importe</td>
        </tr>
        '.$datosDepositosImprimir.'
      </table>
    </td>
    <td width="70%"><table>
        <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
          <td width="70%" align="center">Conceptos</td>
          <td width="25%" align="right">Totales</td>
          <td width="5%" align="right"></td>
        </tr>
        <tr>
    			<td width="70%" align="right">Total Factura :</td>
    			<td width="25%" align="right"> '.number_format($n_total_gral,2,'.',',').' </td>
        </tr>
  		  <tr>
    			<td width="70%" align="right">'.$s_POCME_descripcion_gral.' </td>
    			<td width="25%" align="right"> '.number_format($n_total_POCME,2,'.',',').'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right">'.$s_txt_total_pagos.' </td>
    			<td width="25%" align="right"> '.number_format($n_total_pagos,2,'.',',').'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right">'.$s_txt_cta_gastos.' </td>
    			<td width="25%" align="right"> '.number_format($n_total_cta_gastos,2,'.',',').'</td>
  		  </tr>
        <tr>
    			<td width="100%" align="center">'.trim($s_total_cta_gastos_letra).'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right">'.$s_txt_total_depositos.' </td>
    			<td width="25%" align="right"> '.number_format($n_total_depositos,2,'.',',').'</td>
  		  </tr>
  		  <tr>
    			<td width="70%" align="right">Saldo :</td>
  			  <td width="25%" align="right"> '.number_format($n_fac_saldo,2,'.',',').'</td>
  		  </tr>
      </table>
    </td>
  </tr>
</table></div>';






$pdf->writeHTML($ClienteYFactura, true, false, true, false, '');
$pdf->writeHTML($InfoHonorarios, true, false, true, false, 'C');
$pdf->writeHTML($metPagoYtotHonorarios, true, false, true, false, '');
$pdf->writeHTML($datosTimbrado, true, false, true, false, 'C');
$pdf->writeHTML($EmbarqueYProv, true, false, true, false, '');
$pdf->writeHTML($pgosxCuentaCliente, true, false, true, false, 'C');
$pdf->writeHTML($conceptosYtot, true, false, true, false, '');


$pdf->Output('ImpresionCuentaGtos.pdf', 'I');


?>

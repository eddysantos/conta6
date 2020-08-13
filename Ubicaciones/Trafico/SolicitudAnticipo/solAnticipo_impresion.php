<?php
#http://localhost:88/conta6/ubicaciones/Trafico/SolicitudAnticipo/solAnticipo_impresion.php?cuenta=192
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Resources/vendor/autoload.php';
  require $root . '/Resources/PHP/Utilities/initialScript.php';

  $cuenta = trim($_GET['cuenta']);

  require $root . '/Ubicaciones/Trafico/SolicitudAnticipo/actions/consultarCapturaSolAnt_datosGenerales.php';
  require $root . '/Ubicaciones/Trafico/SolicitudAnticipo/actions/consultarCapturaSolAnt_datosEmbarque.php'; #$datosEmbarque
  require $root . '/Ubicaciones/Trafico/SolicitudAnticipo/actions/consultarCapturaSolAnt_datosPOCME.php'; # $datosPOCME
  require $root . '/Ubicaciones/Trafico/SolicitudAnticipo/actions/consultarCapturaSolAnt_datosCargos.php'; #$datosCargos
  require $root . '/Ubicaciones/Trafico/SolicitudAnticipo/actions/consultarCapturaSolAnt_datosHonorarios.php'; #$datosHonorarios

  $id_cliente = $fk_id_cliente;

  $nombreArchivo = $fk_referencia.'_'.$cuenta.'_proforma.pdf';





   // ***************************** //
  //   O B S E R V A C I O N E S   //
  //****************************** //
  $observacionesPLAA = "Observaciones: La empresa así como sus representantes o corresponsales en el país o en el extranjero, consideran en cada operación que las mercancías se encuentran aseguradas desde la puerta del domicilio de los embarcadores hasta el destino final, con motivo de la importación o de la exportación; razón por la cual no tomara responsabilidad alguna por perdidas, mermas, daños, robo o averías de cualquier índole parciales o totales, excepto en los casos en que los consignatarios en importación o los remitentes en exportación manifiesten en cada ocasión por escrito y previo al arribo de las mercancías a los almacenes de reexpedición o de despacho que desean asegurar sus embarques.";

  $observaciones = "Hemos calculado los gastos de importación para las mercancías cuyos datos generales están contenidos en la primera parte del formato, amparadas por las facturas que ahí se citan, con el fin de que una vez revisada, nos den su aprobación remitiéndonos la cantidad anotada en el total de este documento, a nuestras oficinas en esa ciudad o nos depositen a nuestras cuentas bancarias citadas al calce.";

  class MYPDF extends TCPDF {
  public function Header() {
    $image_file =  'imagenes/cheetah.svg';
    $this->ImageSVG($image_file, 5, 10, '', 10, '', '','', 0,false);
    $this->setTextColor(102);
    $this->SetFont('helvetica', '', 10);
    $this->Cell(0, 0, date('m-d-Y', strtotime('today')) , 0, 1, 'R', 0, '', 0, false, 'T', 'C');
    $this->SetFont('helvetica', '', 12);
    $this->Cell(0, 12, 'PROFORMA', 0, 1, 'C', 0, '', 0, false, 'T', 'C');
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


  $cliente = '<table class="border">
    <thead>
      <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
        <td width="100%" align="center"><b>Cliente</b></td>
      </tr>
    </thead>
    <tbody>
      <tr><td width="100%">' . $s_nombre.'</td></tr>
      <tr><td width="100%">' . $s_calle.' '.$s_no_ext.' '.$s_no_int.'</td></tr>
      <tr><td width="100%">' . $s_colonia.'</td></tr>
      <tr><td width="100%">' . $s_codigo.' '.$s_ciudad.', '.$s_estado.'</td></tr>
      <tr><td width="100%"><b>RFC:</b> ' . $s_rfc.'</td></tr>
    </tbody>
  </table>';
  $solicitud = '<table class="border">
    <thead>
      <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)" align="center">
        <td width="20%"><b>SOLICITUD</b></td>
        <td width="45%"><b>ADUANA</b></td>
        <td width="35%"><b>FECHA</b></td>
      </tr>
    </thead>
    <tbody>
      <tr align="center">
        <td width="20%"><b>'.$pk_id_cuenta_captura.'</b></td>
        <td width="45%">'.$fk_id_aduana.'</td>
        <td width="35%"><font>'.$d_fecha_proforma.'</font></td>
      </tr>
    </tbody>
  </table>';
  $embarque = '<table class="border">
    <thead>
      <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
        <td width="100%" align="center">INFORMACIÓN GENERAL DEL EMBARQUE</td>
      </tr>
    </thead>
    <tbody>
      '.$impresionDatosEmbarque.'
    </tbody>
  </table>';
  $proveedor = '<table class="border">
    <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)"><td width="100%" align="center">Proveedor (IMP) o Destinatario (EXP)</td></tr>
    <tr><td width="100%">'.preg_replace('/&/', '&amp;', preg_replace('/´/', '', utf8_encode($s_proveedor_destinatario))).'</td></tr>
  </table>';
  $datosPocme = '<table class="border">
    <thead>
      <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
        <td width="100%" align="center">PAGOS O CARGOS EN MONEDA EXTRANJERA</td>
      </tr>
    </thead>
    <tbody>
      '.$datosPOCMEImprimir.'
    </tbody>
  </table>';
  $tipoCambio = '<table class="border" align="center">
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
  </table>';


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
      <td width="50%"><br />
      '.$cliente.'<br /><br />'.$proveedor.'<br /><br />'.$datosPocme.'<br /><br />'.$tipoCambio.'
      </td>
      <td width="50%"><br />
        '.$solicitud.'<br /><br />'.$embarque.'
        <br>
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
    <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
      <td width="52%" align="left"><b>HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR</b></td>
      <td width="12%" align="right"><b>IMPORTE</b></td>
      <td width="12%" align="right"><b>IVA</b></td>
      <td width="12%" align="right"><b>SUBTOTAL</b></td>
      <td width="12%"><b></b></td>
    </tr>
  </thead>
  <tbody>
    '.$datosHonorariosImprimir.'
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
    <td width="50%"> </td>
    <td width="50%">
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
        <tr>
          <td width="60%" align="right">'.$s_POCME_descripcion_gral.' </td>
          <td width="40%" align="right"> '.number_format($n_total_POCME,2,'.',',').'</td>
        </tr>
        <tr>
          <td width="60%" align="right">'.$s_txt_total_pagos.' </td>
          <td width="40%" align="right"> '.number_format($n_total_pagos,2,'.',',').'</td>
        </tr>
        <tr>
          <td width="60%" align="right">'.$s_txt_cta_gastos.' </td>
          <td width="40%" align="right"> '.number_format($n_total_cta_gastos,2,'.',',').'</td>
        </tr>
      </table>
    </td>
  </tr></table></div> <br /><br />';


  $pdf->SetFont('courier', '', 6.5);

  $datosObservaciones = '<style>
   .border{
     border-top:1px solid black;
     border-left:1px solid black;
     border-right:1px solid black;
     border-bottom:1px solid black;
    }
  </style>
  <table class="border">
    <tbody>
      <tr align="left">
        <td style="font-size:6pt;" align="justify">
          '.$observacionesPLAA.'
        </td>
      </tr>
    </tbody>
  </table>';

  $datosObservaciones2 = '<style>
   .border{
     border-top:1px solid black;
     border-left:1px solid black;
     border-right:1px solid black;
     border-bottom:1px solid black;
    }
  </style>
  <table class="border">
  <tbody>
    <tr align="left">
      <td style="font-size:6pt;" align="justify">
        '.$observaciones.'
      </td>
    </tr>
  </tbody>
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
  $pdf->writeHTML($pgosxCuentaCliente, true, false, true, false, 'C');
  $pdf->writeHTML($InfoHonorarios, true, false, true, false, 'C');
  $pdf->writeHTML($metPagoYtotHonorarios, true, false, true, false, '');
  $pdf->writeHTML($datosObservaciones2, true, false, true, false, 'C');
  $pdf->writeHTML($datosObservaciones, true, false, true, false, 'C');


  $pdf->Output($nombreArchivo, 'I');

?>

<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/vendor/autoload.php';
require $root . '/Resources/PHP/Utilities/initialScript.php';
require $root . '/Resources/PHP/actions/numtoletras.php';


class MYPDF extends TCPDF {
  public function Header() {
    // $image_file = '/Resources/imagenes/logoSHCP.png';
    $image_file = 'logoSHCP.png';
    $this->Image($image_file, 8, 8, '', 15, '', '','', 0,false);
    $this->setTextColor(102);
    $this->SetFont('helvetica', '', 10);
    $this->Cell(0, 0, date('m-d-Y', strtotime('today')) , 0, 1, 'R', 0, '', 0, false, 'T', 'C');
    $this->SetFont('helvetica', '', 12);
		$this->Cell(0, 7, 'Servicio de Administración Tributaria' , 0, 1, 'C', 0, '', 0, false, 'T', 'C');
    $this->Cell(0, 8, 'Acuse de Cancelacion de CFDI' , 0, 1, 'C', 0, '', 0, false, 'T', 'C');
  }

  public function Footer() {
    $this->SetY(-15);
    $this->SetFont('helvetica', 'I', 8);
  }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(25, 50, 25);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$pdf->AddPage();
$pdf->SetFont('courier', '', 8);

#http://localhost:88/conta6/Resources/PHP/actions/acuse_cancelacion_CFDI.php
$edoCancelacion = 'Cancelacion sin aceptación';
$s_rfcR = 'IAF830713UD1';
$fecha = '2018-01-31T13:58:02';
$RFC = 'PLA090609N21';
$UUID = '846C00DC-85C1-48F4-B6FA-D2DDABDF86C5';
$status = 201;
$sello = '/SeY8BvQfSk8FVDMQJRBNSuf75CPx6XmH4L9G1m7N68azHpTg9DqqBpxsbe3d1EJoPO2/U2XsgpeOVTfCOmd7A==';
$acuse = '<style>
      table.test {
          color: #787878;
          border-width: 1px 1px 1px 1px;
          border-color: black;
          text-align: center;
      }
  </style>
  <table class="test">
  <tr>
    <td width="40%" align="right"><b>Folio Fiscal :</b></td>
    <td width="60%" align="left">'.$UUID.'</td>
  </tr><br />
  <tr>
    <td width="40%" align="right"><b>RFC Receptor :</b></td>
    <td width="60%" align="left">'.$s_rfcR.'</td>
  </tr><br />
  <tr>
    <td width="40%" align="right"><b>Estado CFDI :</b></td>
    <td width="60%" align="left">Cancelado</td>
  </tr><br />
  <tr>
    <td width="40%" align="right"><b>Estado Cancelación :</b></td>
    <td width="60%" align="left">'.$edoCancelacion.'</td>
  </tr><br />
  <tr>
    <td width="40%" align="right"><b>Fecha :</b></td>
    <td width="60%" align="left">'.date_format(date_create($fecha),'Y-m-d H:i:s').'</td>
  </tr><br />
  <tr>
    <td width="40%" align="right"><b>Sello digital SAT :</b></td>
    <td width="60%" align="left">'.wordwrap($sello,74,'<br>',1).'</td>
  </tr>
  </table>';

  $pdf->writeHTML($acuse, true, false, true, false, 'C');


$pdf->lastPage();
$pdf->Output('AcuseCancelacion.pdf', 'I');

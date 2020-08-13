<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

require $root . '/Resources/vendor/autoload.php';
require $root . '/Resources/PHP/actions/numtoletras.php';

$id_nomina = trim($_GET['semana']);
$id_aduana = $aduana;
$id_empleado = trim($_GET['id_empleado']);
$anio = trim($_GET['anio']);
$tipo = trim($_GET['tipo']);
$id_regimen = 9;
$image_file = 'cheetah.svg';
$fechaIni = '2019-12-30';
$fechaFin = '2020-01-03';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData($image_file, PDF_HEADER_LOGO_WIDTH, 'Proyección Logistica Agencia Aduanal S.A de C.V', 'Empleados Bajo el Regimen de Honorarios Asimilados a Salarios'.'
Semana: '.$id_nomina.' Fecha Inicio: '.$fechaIni.' Fecha Final: '.$fechaFin.'');

// $pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// ---------------------------------------------------------
$pdf->setFontSubsetting(true);

$pdf->SetFont('dejavusans', '', 8, '', true);

$pdf->AddPage();

$sql_Select = "SELECT * FROM conta_t_nom_captura INNER JOIN conta_t_nom_captura_det ON pk_id_docNomina = fk_id_docNomina WHERE n_semana = $id_nomina AND fk_id_regimen = $id_regimen AND s_tipoElemento = 'totales' AND s_tipoNomina = '$tipo' ";
$stmt = $db->prepare($sql_Select);
if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
$rslt = $stmt->get_result();
$rows = $rslt->num_rows;

$html = '';
$html .= <<<EOD
<style>
      .bg{
        background-color : #bebebe;
        color: #ffffff;
        text-align: center;
      }

      td.bbottom {
        border-bottom: 1px solid #ccc;

      }
      .black{
        color:rgb(80, 80, 80);
        font-size: 10px
      }
      table.test {
          color: #787878;
          border-width: 1px 1px 1px 1px;
          border-color: black;
          text-align: center;
      }
  </style>
  <table class="test"><tr>
    <td class="bg" width="10%">NO.</td>
    <td class="bg" width="40%" align="left">NOMBRE</td>
    <td class="bg" width="10%">DOC</td>
    <td class="bg" width="10%">POLIZA</td>
    <td class="bg" width="10%">CANC</td>
    <td class="bg" width="10%">FACTURA</td>
    <td class="bg" width="10%">UUID</td>
  </tr>
EOD;

while ($row = $rslt->fetch_assoc()) {
  $noEmpleado = $row['fk_id_empleado'];
  $nombre = $row['s_nombre'];
  $s_apellidoP = $row['s_apellidoP'];
  $s_apellidoM = $row['s_apellidoM'];
  $pk_id_docNomina = $row['pk_id_docNomina'];
  $n_dias_incapacidad = $row['n_dias_incapacidad'];
  $n_dias_vacaciones = $row['n_dias_vacaciones'];
  $n_dias_faltas = $row['n_dias_faltas'];
  $n_numDiasPagados = $row['n_numDiasPagados'];
  // $n_importeGravado = $row['n_importeGravado'];
  // $n_importeExento = $row['n_importeExento'];
  $n_totalPercepciones = $row['n_totalPercepciones'];
  $n_totalDeducciones = $row['n_totalDeducciones'];
  $n_total = $row['n_total'];


  $html .='<tbody><tr color="black">
    <td width="10%">'.$noEmpleado.'</td>
    <td width="40%" align="left">'.$nombre.' '.$s_apellidoP.' '.$s_apellidoM.'</td>
    <td width="10%">'.$pk_id_docNomina.'</td>
    <td width="10%"></td>
    <td width="10%"></td>
    <td width="10%"></td>
    <td width="10%"></td>
  </tr>
  <tr>
    <td width="40%">Dias</td>
    <td width="15%"></td>
    <td width="10%"></td>
    <td width="20%">DESC ERRORES</td>
    <td width="15%"></td>
  </tr>

  <tr>
    <td width="10%"> I </td>
    <td width="10%"> V </td>
    <td width="10%"> F </td>
    <td width="10%"> P </td>
    <td width="15%">IMPORTE</td>
    <td width="10%">ISR</td>
    <td width="10%">Base %</td>
    <td width="10%">Importe</td>
    <td width="15%">NETO A PAGAR</td>
  </tr>
  <tr color="black">
    <td class="bbottom" width="10%">'.$n_dias_incapacidad.'</td>
    <td class="bbottom" width="10%">'.$n_dias_vacaciones.'</td>
    <td class="bbottom" width="10%">'.$n_dias_faltas.'</td>
    <td class="bbottom" width="10%">'.$n_numDiasPagados.'</td>
    <td class="bbottom" width="15%">'.$n_totalPercepciones.'</td>
    <td class="bbottom" width="10%">'.$n_totalDeducciones.'</td>
    <td class="bbottom" width="10%"></td>
    <td class="bbottom" width="10%"></td>
    <td class="bbottom" width="15%">'.$n_total.'</td>
  </tr>';
}
$html .='</tbody></table><br>';

// $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->writeHTML($html, true, false, true, false, 'C');


// ---------------------------------------------------------

$pdf->Output('NominaOrdinaria.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>

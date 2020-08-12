<?php
//PDF
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Conta6/Resources/vendor/autoload.php';
require $root . '/Conta6/Resources/PHP/Utilities/initialScript.php';
require $root . '/conta6/Resources/PHP/actions/numtoletras.php';



class MYPDF extends TCPDF {
  public function Header() {
    $image_file = 'cheetah.svg';
    $this->ImageSVG($image_file, 5, 10, '', 10, '', '','', 0,false);
    $this->setTextColor(102);
    $this->SetFont('helvetica', '', 10);
    $this->Cell(0, 0, date('m-d-Y', strtotime('today')) , 0, 1, 'R', 0, '', 0, false, 'T', 'C');
    $this->SetFont('helvetica', '', 12);
    $this->Cell(0, 12, 'Proyección Logistica Agencia Aduanal S.A de C.V' , 0, 1, 'C', 0, '', 0, false, 'T', 'C');
  }

  public function Footer() {
    $this->SetY(-15);
    $this->SetFont('helvetica', 'I', 8);
  }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(8, 30, 8);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$pdf->AddPage();
$pdf->SetFont('courier', '', 8);


$sql_Select = "SELECT * from conta_cs_cuentas_mst ORDER BY pk_id_cuenta";
$stmt = $db->prepare($sql_Select);
if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
$rslt = $stmt->get_result();
$rows = $rslt->num_rows;


$catalogoCuentas = '';
$catalogoCuentas .='<style>
      .bg{
        background-color : #919191;
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
    <td class="bg" width="15%">CUENTA</td>
    <td class="bg" width="55%">DESCRIPCION</td>
    <td class="bg" width="6%">TIPO</td>
    <td class="bg" width="6%">NIVEL</td>
    <td class="bg" width="10%">CodAgrup SAT</td>
    <td class="bg" width="8%">NATUR SAT</td>
  </tr>';
while ($row = $rslt->fetch_assoc()) {
  $cuenta = $row['pk_id_cuenta'];
  $desc = $row['s_cta_desc'];
  $tipo =  $row['s_cta_tipo'];
  $nivel = $row['s_cta_nivel'];
  $codAgrup = $row['fk_codAgrup'];
  $natur = $row['fk_id_naturaleza'];
  $tipo_ident = $row['s_cta_identificador_tipo'];
  $cta_ident = $row['s_cta_identificador'];

  $catalogoCuentas .='<tbody><tr color="black">
      <td class="bbottom" width="15%">'.$cuenta.'</td>
      <td class="bbottom" width="55%" align="left">'.$desc.'</td>
      <td class="bbottom" width="6%">'.$tipo.'</td>
      <td class="bbottom" width="6%">'.$nivel.'</td>
      <td class="bbottom" width="10%">'.$codAgrup.'</td>
      <td class="bbottom" width="8%">'.$natur.'</td>
    </tr>';
}
$catalogoCuentas .='</tbody></table><br>';


$pdf->writeHTML($catalogoCuentas, true, false, true, false, 'C');


$pdf->lastPage();
$pdf->Output('CatalogoCuentas.pdf', 'I');
?>

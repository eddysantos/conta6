<?php
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
    $this->Cell(0, 12, 'Proyección Logística Agencia Aduanal S.A de C.V.' , 0, 1, 'C', 0, '', 0, false, 'T', 'C');
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

$sql_Select = "SELECT * from conta_cs_proveedores order by s_nombre limit 10";
$stmt = $db->prepare($sql_Select);
if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
$rslt = $stmt->get_result();
$rowMST = $rslt->num_rows;

$proveedores = '';
$proveedores .= '<style>
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
    <td class="bg" width="20%">PROVEEDOR</td>
    <td class="bg" width="15%">RFC</td>
    <td class="bg" width="15%">CURP</td>
    <td class="bg" width="10%">TAX ID</td>
    <td class="bg" width="15%">PERSONA</td>
    <td class="bg" width="25%">BANCO / CUENTA</td>
  </tr>';

  while($rowMST = $rslt->fetch_assoc()){
    $id_prov = $rowMST['pk_id_proveedor'];
    $nombre = trim($rowMST['s_nombre']);
    $rfc = trim($rowMST['s_rfc']);
    $taxId = trim($rowMST['s_taxid']);
    $persona = trim($rowMST['s_persona']);
    $curp = trim($rowMST['s_curp']);
    $direccion = trim($rowMST['s_direccion']);



    $sql_prov = "SELECT b.s_nombre , a.s_cta_banco
                FROM conta_cs_bancos_proveedores a, conta_cs_sat_bancos b
                WHERE a.fk_id_banco = b.pk_id_banco and a.fk_id_proveedor = ?";
    $stmt_ctas = $db->prepare($sql_prov);
    if (!($stmt_ctas)) { die("Error during query prepare [$db->errno]: $db->error");	}
    $stmt_ctas->bind_param('s', $id_prov);
    if (!($stmt_ctas)) { die("Error during query prepare [$stmt_ctas->errno]: $stmt_ctas->error");	}
    if (!($stmt_ctas->execute())) { die("Error during query prepare [$stmt_ctas->errno]: $stmt_ctas->error"); }
    $rslt_ctas = $stmt_ctas->get_result();
    if ($rslt_ctas->num_rows > 0) {
       $listCtas = '';

       while( $rowctas = $rslt_ctas->fetch_assoc() ){

         $listCtas .= '<tr>
           <td width="50%" align="right">'.$rowctas['s_nombre'].' -</td>
           <td width="50%" align="left">- '. $rowctas['s_cta_banco'].'</td>
         </tr>';
       }

    }


  $proveedores .='</tbody><tr color="black">
                    <td class="bbottom" width="20%" align="left">'.$id_prov.' = '.$nombre.'</td>
                    <td class="bbottom" width="15%">'.$rfc.'</td>
                    <td class="bbottom" width="15%">'.$curp.'</td>
                    <td class="bbottom" width="10%">'.$taxId.'</td>
                    <td class="bbottom" width="15%">'.$persona.'</td>
                    <td class="bbottom" width="25%"><table>'.$listCtas.'</table></td>
                  </tr>';

}

$proveedores .='</tbody></table><br>';


$pdf->writeHTML($proveedores, true, false, true, false, 'C');


$pdf->lastPage();
$pdf->Output('CatalogoCuentas.pdf', 'I');

 ?>

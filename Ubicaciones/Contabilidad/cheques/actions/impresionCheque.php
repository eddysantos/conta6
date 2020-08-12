<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Conta6/Resources/vendor/autoload.php';
require $root . '/Conta6/Resources/PHP/Utilities/initialScript.php';
require $root . '/Conta6/Resources/PHP/actions/numtoletras.php';



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



$id_cheque = $_GET['id_cheque'];
$id_cuentaMST = $_GET['id_cuentaMST'];
$id_poliza = $_GET['id_poliza'];

$sql_Select = "SELECT * FROM conta_t_cheques_mst WHERE pk_id_cheque = ? AND fk_id_cuentaMST = ?";
$stmt = $db->prepare($sql_Select);
if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmt->bind_param('ss', $id_cheque,$id_cuentaMST);
if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}
if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
$rslt = $stmt->get_result();
$rows = $rslt->num_rows;


if( $rows > 0 ){
	$rowMST = $rslt->fetch_assoc();

	$valorCheque = $rowMST['n_valor'];
    $cantidadLetra = "*** ".numtoletras($valorCheque)." ***";

	#'RESTRICCION PARA LAS CUENTAS EN DOLARES
    if( $id_cuentaMST == "0100-00011" OR $id_cuentaMST == "0100-00014" ){
	    $cantidadLetra = str_replace("PESOS","DOLARES",$cantidadLetra);
	    $cantidadLetra = str_replace(" MN "," ",$cantidadLetra);
	}

	$cancela = $rowMST["s_cancela"];
	if( $cancela == 1 ){ $txt_cancela = "CANCELADO"; }else{ $txt_cancela = "ACTIVO"; }

	if($id_poliza > 0){
		$sql_CHEDET = "SELECT * FROM conta_t_polizas_det WHERE fk_id_poliza = ? ORDER BY pk_partida";
		$stmt_CHEDET = $db->prepare($sql_CHEDET);
		if (!($stmt_CHEDET)) { die("Error during query prepare [$db->errno]: $db->error");	}
		$stmt_CHEDET->bind_param('s',$id_poliza);
		if (!($stmt_CHEDET)) { die("Error during query prepare [$stmt_CHEDET->errno]: $stmt_CHEDET->error");	}
		if (!($stmt_CHEDET->execute())) { die("Error during query prepare [$stmt_CHEDET->errno]: $stmt_CHEDET->error"); }
		$rslt_CHEDET = $stmt_CHEDET->get_result();
		$rows_CHEDET = $rslt_CHEDET->num_rows;


    $sql_SelectTotales = "SELECT fk_id_poliza, SUM(n_cargo) AS SUMA_CARGOS, SUM(n_abono) AS SUMA_ABONOS FROM conta_t_polizas_det WHERE fk_id_poliza = ? GROUP BY fk_id_poliza";
    $stmtTotales = $db->prepare($sql_SelectTotales);
    if (!($stmtTotales)) { die("Error during query prepare Totales [$db->errno]: $db->error");	}
    $stmtTotales->bind_param('s', $id_poliza);
    if (!($stmtTotales)) { die("Error during query prepare Totales [$stmtTotales->errno]: $stmtTotales->error");	}
    if (!($stmtTotales->execute())) { die("Error during query prepare Totales [$stmtTotales->errno]: $stmtTotales->error"); }
    $rsltTotales = $stmtTotales->get_result();
    $rowTotales = $rsltTotales->fetch_assoc();
    $sumaCargos = $rowTotales["SUMA_CARGOS"];
    $sumaAbonos = $rowTotales["SUMA_ABONOS"];

	}
}

$pdf->SetFont('courier', '', 8);
$pdf->AddPage();


if (!is_null($rowMST["d_fecha_alta"])){
  $fechaCaptura = date_format(date_create($rowMST["d_fecha_alta"]),"d/m/Y h:i:sa");
}else {
  $fechaCaptura = $rowMST["d_fecha_alta"];
}


$pdf->SetFont('courier', '', 9);
$encabezado = '<style>
   .border{
     border-top:1px solid black;
     border-left:1px solid black;
     border-right:1px solid black;
     border-bottom:1px solid black;
    }
    table{
      margin:5px;
    }
    .margin-top{
      margin: 10px;
    }
</style>
<table class="border">
		<tr bgcolor="#919191">
			<td width="10%"><b>Cheque</b></td>
			<td width="20%"><b>Fecha</b></td>
      <td width="10%"><b>Usuario</b></td>
      <td width="30%"><b>Captura</b></td>
      <td width="15%"><b>Poliza</b></td>
			<td width="15%"><b>Cancelacion</b></td>
		</tr>

    <tr>
			<td width="10%">'.$rowMST["pk_id_cheque"].'</td>
			<td width="20%">'.date_format(date_create($rowMST["d_fechache"]),"d/m/Y").'</td>
      <td width="10%">'.$rowMST["fk_usuario"].'</td>
      <td width="30%">'.$fechaCaptura.'</td>
      <td width="15%">'.$rowMST["fk_id_poliza"].'</td>
      <td width="15%">'.$rowMST["$txt_cancela"].'</td>
    </tr>
    <br />
    <tr>
      <td width="20%" align="right"><b>Beneficiario :</b></td>
      <td width="80%" align="left">'.$rowMST["s_nomOrd"].'</td>
    </tr>
    <tr>
    <td width="20%" align="right"><b>Importe :</b></td>
    <td width="80%" align="left">$' .number_format($rowMST["n_valor"],2,'.',',').trim($cantidadLetra).'</td>
    </tr>
</table>';


$detalleCheque = "";
if( $rows_CHEDET > 0 ){

  $detalleCheque .= '<style>
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
    <td class="bg" width="12.5%">Cuenta</td>
    <td class="bg" width="12.5%">Referencia</td>
    <td class="bg" width="12.5%">Cliente</td>
    <td class="bg" width="12.5%">Documento</td>
    <td class="bg" width="12.5%">Anticipo</td>
    <td class="bg" width="12.5%">Fecha</td>
    <td class="bg" width="12.5%">Cargo</td>
    <td class="bg" width="12.5%">Abono</td>
  </tr>';

  while ($row_CHEDET = $rslt_CHEDET->fetch_assoc()) {
  	$fecha = date_format(date_create($row_CHEDET['d_fecha']),"d/m/Y");
  	$cargo = number_format($row_CHEDET['n_cargo'],2,'.',',');
  	$abono = number_format($row_CHEDET['n_abono'],2,'.',',');
    $polizaCheque = $row_CHEDET['fk_id_poliza'];
    $cuentaCheque = $row_CHEDET["fk_id_cuenta"];
    $referenciaCheque = $row_CHEDET["fk_referencia"];
    $clienteCheque = $row_CHEDET["fk_id_cliente"];
    $CFDIcheque = $row_CHEDET["s_folioCFDIext"];
    $anticipoCheque = $row_CHEDET["fk_anticipo"];
    $descripcionCheque = $row_CHEDET["s_desc"];

  	$detalleCheque .= '<tbody><tr color="black">
        <td width="12.5%">'.$cuentaCheque.'</td>
        <td width="12.5%">'.$referenciaCheque.'</td>
        <td width="12.5%">'.$clienteCheque.'</td>
        <td width="12.5%">'.$CFDIcheque.'</td>
        <td width="12.5%">'.$anticipoCheque.'</td>
        <td width="12.5%">'.$fecha.'</td>
        <td width="12.5%" align="right">'.$cargo.'</td>
        <td width="12.5%" align="right">'.$abono.'</td>
      </tr>
      <tr class="bbottom">
        <td width="0.5%"></td>
        <td class="bbottom" width="79.5%" align="left">Desc.'.$descripcionCheque.'</td>
        <td class="bbottom" width="19.5%" align="left"></td>
        <td width="0.5%"></td>
      </tr>';
    }

    $detalleCheque .= '</tbody></table><br/><br/>';

    $detalleCheque .= '<style>
        table{
          border:1px solid black;
        }
    </style>
    <table>
      <tfoot>
        <tr color="black">
          <td width="50%">Totales :</td>
          <td width="25%"> $'. $sumaCargos.'</td>
          <td width="25%"> $'. $sumaAbonos.'</td>
        </tr>';

    $detalleCheque .='</tfoot></table>';
}





$pdf->writeHTML($encabezado, true, false, true, false, 'C');
$pdf->writeHTML($detalleCheque, true, false, true, false, 'C');



$pdf->lastPage();
$pdf->Output('ImpresionPoliza.pdf', 'I');

?>

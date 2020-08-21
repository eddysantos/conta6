<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/vendor/autoload.php';
require $root . '/Resources/PHP/Utilities/initialScript.php';


class MYPDF extends TCPDF {
  public function Header() {
    $image_file = 'spectrum_worldwide.svg';
    $this->ImageSVG($image_file, 6, 12, '', 12, '', '','', 0,false);
    $this->setTextColor(102);
    $this->SetFont('barlow', '', 12);
    $this->Cell(0, 12, 'Impresión de poliza' , 0, 1, 'R', 0, '', 0, false, 'T', 'C');
  }

  function Footer(){
   $logoX = 100;
   $logoFileName = "s_rojo.svg";
   $logoWidth = 7;
   $logoY = 286;
   $logo = $this->PageNo() . ' | '. $this->ImageSVG($logoFileName, $logoX, $logoY, $logoWidth);

   $this->SetX($this->w - $this->documentRightMargin - $logoWidth);
   $this->Cell(10,10, $logo, 0, 0, 'C');
  }

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(8, 30, 8);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);


// QUERY Y TABLA DE ENCABEZADO DE POLIZA
$id_poliza = trim($_GET['id_poliza']);
$aduana = trim($_GET['aduana']);

$oRst_Select ="SELECT * FROM conta_t_polizas_mst WHERE pk_id_poliza = $id_poliza AND fk_id_aduana = $aduana";
$stmt = $db->prepare($oRst_Select);
if (!($stmt)) {
  $cb['query']['code'] = "500";
  $cb['query']['query'] = $oRst_Select;
  $cb['query']['message'] = "Error during TRIP_LINEHAUL query prepare [$db->errno]: $db->error";
  exit_script($cb);
}
if (!($stmt->execute())) {
  $cb['query']['code'] = "500";
  $cb['query']['query'] = $oRst_Select;
  $cb['query']['message'] = "Error during TRIP_LINEHAUL query execution [$stmt->errno]: $stmt->error";
  exit_script($cb);
}
$rslt = $stmt->get_result();
$amount = $rslt->num_rows;

$pdf->SetFont('barlow', '', 9, '', false);
$pdf->AddPage();

if( $amount > 0 ){

  #$cancela = $oRst_Select["s_cancela"];
  #if( $cancela == 1 ){ $txt_cancela = "Póliza Cancelada";}else{$txt_cancela = "";}
  $contentEncabezado = '';


$contentEncabezado .= '
<div border="1">
<table>
  <tr bgcolor="#58595b" color="rgb(255, 255, 255)">
    <td width="20%">Fecha de Póliza</td>
    <td width="10%">Usuario</td>
    <td width="25%">Fecha de Captura</td>
    <td width="35%">Concepto</td>
    <td width="10%">Póliza</td>
  </tr>';

  if ($rslt->num_rows == 0) {
    $cb['query']['code'] = 2;
    $cb['query']['message'] = "Script called successfully but there are no rows to display.";
  } else {
    while ($row = $rslt->fetch_assoc()) {
      if ((!is_null($row["d_fecha"]))) {
        $fechapoliza = date_format(date_create($row["d_fecha"]),"d/m/Y");
      }
      if (!is_null($row['d_fecha_alta'])) {
        $fechaAlta =  date_format(date_create($row["d_fecha_alta"]),"d-m-Y H:i:s");
      }
      $usuario = $row["fk_usuario"];
      $concepto = $row["s_concepto"];
      $idpoliza = $row['pk_id_poliza'];


      $contentEncabezado .='<tr>
        <td width="20%">'. $fechapoliza .'</td>
        <td width="10%">'. $usuario .'</td>
        <td width="25%">'. $fechaAlta .'</td>
        <td width="35%">'. $concepto .'</td>
        <td width="10%">'. $idpoliza .'</td>
      </tr>';
    }
  }
$contentEncabezado .='</table></div><br>';
$pdf->writeHTML($contentEncabezado, false, true, false, true, 'C');

// FIN QUERY Y TABLA DE ENCABEZADO DE POLIZA



// *********************************** //
// QUERY  Y TABLA DE DETALLE DE POLIZA //
// *********************************** //
$oRst_POLDET_sql ="SELECT * FROM conta_t_polizas_det WHERE fk_id_poliza = $id_poliza ORDER BY pk_partida";
$stmt1 = $db->prepare($oRst_POLDET_sql);
if (!($stmt)) {
  $cb1['query']['code'] = "500";
  $cb1['query']['query'] = $oRst_POLDET_sql;
  $cb1['query']['message'] = "Error during TRIP_LINEHAUL query prepare [$db->errno]: $db->error";
  exit_script($cb1);
}
if (!($stmt1->execute())) {
  $cb1['query']['code'] = "500";
  $cb1['query']['query'] = $oRst_POLDET_sql;
  $cb1['query']['message'] = "Error during TRIP_LINEHAUL query execution [$stmt->errno]: $stmt->error";
  exit_script($cb1);
}
$rslt = $stmt1->get_result();
$amount1 = $rslt->num_rows;
$pdf->SetFont('barlow', '', 8);
$pdf->setTextColor(120);
$pdf->SetAutoPageBreak(TRUE, 15);
$contenidobody ='';

if ($amount1 > 0) {
$contenidobody .='<style>
    .bg{
      background-color : #58595b;
      color: #ffffff;
      text-align: center;
    }

    td.bbottom {
      border-bottom: 0.5px solid #ccc;

    }
    .black{
      color:#58595b;
      font-size: 10px
    }
    table.test {
        color: #58595b;
        border-width: 1px 1px 1px 1px;
        border-color: black;
        text-align: center;
    }
</style>
<table class="test" >
  <thead>
    <tr>
      <th class="bg" width="5%">Tipo</th>
      <th class="bg" width="10%">Cuenta</th>
      <th class="bg" width="11%">Referencia</th>
      <th class="bg" width="9.5%">Cliente</th>
      <th class="bg" width="10%">Doc.</th>
      <th class="bg" width="7%">Fact.</th>
      <th class="bg" width="9%">Cta.Gtos</th>
      <th class="bg" width="6%">P.E.</th>
      <th class="bg" width="6%">N.C</th>
      <th class="bg" width="7%">Cheque</th>
      <th class="bg" width="9.7%">Cargo</th>
      <th class="bg" width="9.8%">Abono</th>
    </tr>
  </thead>';

if ($rslt->num_rows == 0) {
  $cb1['query']['code'] = 2;
  $cb1['query']['message'] = "Script called successfully but there are no rows to display.";
}else {
  while ($row = $rslt->fetch_assoc()) {
    $tipo = $row["fk_tipo"];
    $cuenta = $row["fk_id_cuenta"];
    $referencia = $row["fk_referencia"];
    $cliente = $row["fk_id_cliente"];
    $folioCFDI = $row["s_folioCFDIext"];
    $factura = $row["fk_factura"];
    $ctagastos = $row["fk_ctagastos"];
    $pago = $row["fk_pago"];
    $nc = $row["fk_nc"];
    $cheque = $row["fk_cheque"];
    $descripcion = $row["s_desc"];
    $cargo = number_format($row['n_cargo'],2,'.',',');
    $abono = number_format($row['n_abono'],2,'.',',');

    // if ($folioCFDI == "" || $folioCFDI == null) {
    //   $display ="display:none";
    // }
    $contenidobody .='<tbody><tr color="black">
      <td width="0.2%"></td>
      <td width="5%">'.$tipo.'</td>
      <td width="10%">'.$cuenta .'</td>
      <td width="11%">'.$referencia .'</td>
      <td width="9.5%">'.$cliente .'</td>
      <td width="10%">'.$folioCFDI .'</td>
      <td width="7%">'.$factura .'</td>
      <td width="9%">'.$ctagastos .'</td>
      <td width="6%">'.$pago .'</td>
      <td width="6%">'.$nc .'</td>
      <td width="7%">'.$cheque .'</td>
      <td width="9.5%" align="right">'.$cargo .'</td>
      <td width="9.6%" align="right">'.$abono .'</td>
      <td width="0.2%"></td>
    </tr>
    <tr color="black">
      <td width="0.5%"></td>
      <td class="bbottom" width="99%" align="left">Descripcion: '.$descripcion .'</td>
      <td width="0.5%"></td>
    </tr>';
  }
}
$contenidobody .='</tbody></table><br><br>';
}else {
  $contenidobody .='<div>
			<font color="#ed1c24" align="center">NO HAY DETALLES DE ESTA PÓLIZA</font>
		</div>';
}
$pdf->writeHTML($contenidobody, true, false, false, false, 'C');

// QUERY Y TABLA DEL DETALLE DE Poliza


// *********************************** //
// QUERY  Y  SUMAS  TOTALES  DE POLIZA //
// *********************************** //

$oRst_STPD = "SELECT fk_id_poliza,SUM(n_cargo) AS SUMA_CARGOS, SUM(n_abono) AS SUMA_ABONOS FROM conta_t_polizas_det WHERE fk_id_poliza = $id_poliza GROUP BY fk_id_poliza";

$stmt2 = $db->prepare($oRst_STPD);

if (!($stmt2)) {
  $cb2['query']['code'] = "500";
  $cb2['query']['query'] = $oRst_STPD;
  $cb2['query']['message'] = "Error during TRIP_LINEHAUL query prepare [$db->errno]: $db->error";
  exit_script($cb2);
}

if (!($stmt2->execute())) {
  $cb2['query']['code'] = "500";
  $cb2['query']['query'] = $oRst_STPD;
  $cb2['query']['message'] = "Error during TRIP_LINEHAUL query execution [$stmt->errno]: $stmt->error";
  exit_script($cb2);
}
$rslt2 = $stmt2->get_result();
$amount2 = $rslt2->num_rows;

$pdf->SetFont('barlow', '', 10);
$pdf->SetCellPadding(0);



$contenidopie ='';

if ($amount2 == 0) {
  $cb2['query']['code'] = 2;
  $cb2['query']['message'] = "Script called successfully but there are no rows to display. For trailer query.";
}else {
  while ($row = $rslt2->fetch_assoc()) {
    if( $totalRegistrosSTPD > 0 ){
    	$Status_Poliza = number_format($row["SUMA_CARGOS"] - $row["SUMA_ABONOS"],2,'.',',');
    }
    $cargos = number_format($row['SUMA_CARGOS'],2,'.',',');
    $abonos = number_format($row['SUMA_ABONOS'],2,'.',',');


    $contenidopie .='<style>
        table{
          border:1px solid black;
        }
    </style>
     <table>
      <tfoot>
        <tr color="black">
          <td width="50%">Totales :</td>
          <td width="25%"> $'. $cargos.'</td>
          <td width="25%"> $'. $abonos .'</td>
        </tr>';
 }
}

$contenidopie .='</tfoot></table>';
$pdf->writeHTML($contenidopie, true, false, false, false, 'C');

}else{
  $contenidobody .='<div>
    <font color="#ed1c24" align="center" >NO HAY DATOS DE ESTA PÓLIZA, O ES UNA PÓLIZA DE OTRA OFICINA</font>
  </div>';
}

$pdf->lastPage();
$pdf->Output('ImpresionPoliza.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+

 ?>

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


// QUERY Y TABLA DE ENCABEZADO DE POLIZA
$id_anticipo = trim($_GET['id_anticipo']);

$sql_Select = "SELECT * FROM conta_t_anticipos_mst WHERE pk_id_anticipo = ?";
$stmt = $db->prepare($sql_Select);
if (!($stmt)) {
  $cb['query']['code'] = "500";
  $cb['query']['query'] = $oRst_Select;
  $cb['query']['message'] = "Error during TRIP_LINEHAUL query prepare [$db->errno]: $db->error";
  exit_script($cb);
}
$stmt->bind_param('s', $id_anticipo);
if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}
if (!($stmt->execute())) {
  $cb['query']['code'] = "500";
  $cb['query']['query'] = $oRst_Select;
  $cb['query']['message'] = "Error during TRIP_LINEHAUL query execution [$stmt->errno]: $stmt->error";
  exit_script($cb);
}
$rslt = $stmt->get_result();
$rows = $rslt->num_rows;

if ($rows > 0) {
  $rowMST = $rslt->fetch_assoc();
  $Total = $rowMST["n_valor"];
  $id_cliente = trim($rowMST["fk_id_cliente_antmst"]);
  $Cuenta = trim($rowMST["fk_id_cuentaMST"]);
  $id_poliza = trim($rowMST["fk_id_poliza"]);
  $Fecha = trim($rowMST["d_fecha"]);
  $TotalLetra = "***".numtoletras($Total)."***";
  if(!is_null($oRst_Select["d_fecha"])){
  $Fecha = date_format(date_create($oRst_Select["d_fecha"]),"d/m/Y");
  }

  $sql_SelectCLT = "SELECT s_nombre FROM conta_replica_clientes WHERE pk_id_cliente = ?";
  $stmtCLT = $db->prepare($sql_SelectCLT);
  if (!($stmtCLT)) { die("Error during query prepare CLT [$db->errno]: $db->error");	}
  $stmtCLT->bind_param('s', $id_cliente);
  if (!($stmtCLT)) { die("Error during query prepare CLT [$stmtCLT->errno]: $stmtCLT->error");	}
  if (!($stmtCLT->execute())) { die("Error during query prepare CLT [$stmtCLT->errno]: $stmtCLT->error"); }
  $rsltCLT = $stmtCLT->get_result();
  $rowCLT = $rsltCLT->fetch_assoc();
  $nombre = trim($rowCLT["s_nombre"]);

  $sql_SelectCTA = "SELECT s_cta_desc FROM conta_cs_cuentas_mst WHERE pk_id_cuenta = ?";
  $stmtCTA = $db->prepare($sql_SelectCTA);
  if (!($stmtCTA)) { die("Error during query prepare CTA [$db->errno]: $db->error");	}
  $stmtCTA->bind_param('s', $Cuenta);
  if (!($stmtCTA)) { die("Error during query prepare CTA [$stmtCTA->errno]: $stmtCTA->error");	}
  if (!($stmtCTA->execute())) { die("Error during query prepare CTA [$stmtCTA->errno]: $stmtCTA->error"); }
  $rsltCTA = $stmtCTA->get_result();
  $rowCTA = $rsltCTA->fetch_assoc();
  $Cuenta_Desc = $rowCTA["s_cta_desc"];

  $sql_SelectPOL = "SELECT * FROM conta_t_polizas_det WHERE fk_id_poliza = ? ORDER BY pk_partida";
  $stmtPOL = $db->prepare($sql_SelectPOL);
  if (!($stmtPOL)) { die("Error during query prepare POL [$db->errno]: $db->error");	}
  $stmtPOL->bind_param('s', $id_poliza);
  if (!($stmtPOL)) { die("Error during query prepare POL [$stmtPOL->errno]: $stmtPOL->error");	}
  if (!($stmtPOL->execute())) { die("Error during query prepare POL [$stmtPOL->errno]: $stmtPOL->error"); }
  $rsltPOL = $stmtPOL->get_result();
  $rowsReg = $rsltPOL->num_rows;

  $sql_SelectTotales = "SELECT fk_id_poliza,
                        SUM(n_cargo) AS SUMA_CARGOS,
                        SUM(n_abono) AS SUMA_ABONOS
                        FROM conta_t_polizas_det
                        WHERE fk_id_poliza = ?
                        GROUP BY fk_id_poliza";
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


$pdf->SetFont('courier', '', 9);
$pdf->AddPage();

$datosGeneralesAnticipo = '<style>
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
      <td width="20%"><b>Anticipo</b></td>
      <td width="20%"><b>Fecha</b></td>
      <td width="60%"><b>Se Recibe Depósito del Cliente</b></td>
    </tr>
    <tr>
      <td width="20%">'.$id_anticipo.'</td>
      <td width="20%">'.$Fecha.'</td>
      <td width="60%">'.$nombre.'</td>
    </tr>
    <br />
    <tr>
      <td width="10%" align="right"><b>Cuenta :</b></td>
      <td width="90%" align="left">'.$Cuenta_Desc.'</td>
    </tr>
    <tr>
    <td width="10%" align="right"><b>Importe :</b></td>
    <td width="40%" align="left">$' .number_format($Total,2,'.',',').trim($TotalLetra).'</td>
    </tr>
  </table>';


  $pdf->SetFont('courier', '', 8);

  $detalleRegistrosAnticipo ='';
  if ($rowsReg > 0) {
    $detalleRegistrosAnticipo .= '<style>
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
      <td class="bg" width="9%">Póliza</td>
      <td class="bg" width="10%">Cuenta</td>
      <td class="bg" width="11%">Referencia</td>
      <td class="bg" width="9.5%">Cliente</td>
      <td class="bg" width="8%">Fact</td>
      <td class="bg" width="9%">Cta.Gtos</td>
      <td class="bg" width="6%">P.E</td>
      <td class="bg" width="8%">N.C</td>
      <td class="bg" width="10%">Fecha</td>
      <td class="bg" width="9.8%">Cargo</td>
      <td class="bg" width="9.8%">Abono</td>
    </tr>';

    if ($rsltPOL->num_rows == 0) {
      $stmtPOL['query']['code'] = 2;
      $stmtPOL['query']['message'] = "Llamada al script exitosa, pero no hay resultados que arrojar.";
    }else {
    while( $rowPOL = $rsltPOL->fetch_assoc()){
      $idPolizasAnt = $rowPOL["fk_id_poliza"];
      $cuentaAnt = trim($rowPOL["fk_id_cuenta"]);
      $referenciaAnt = trim($rowPOL["fk_referencia"]);
      $clienteAnt = trim($rowPOL["fk_id_cliente"]);
      $facturaAnt = trim($rowPOL["fk_factura"]);
      $ctagtosAnt = trim($rowPOL["fk_ctagastos"]);
      $pagoAnt = trim($rowPOL["fk_pago"]);
      $ncAnt = trim($rowPOL["fk_nc"]);
      $descAnt= trim($rowPOL["s_desc"]);
      $cargoAnt = number_format($rowPOL["n_cargo"],2,'.',',');
      $abonoAnt = number_format($rowPOL["n_abono"],2,'.',',');
      if (!is_null($rowPOL["d_fecha"])){
         $fechapol = date_format(date_create($rowPOL["d_fecha"]),"d-m-Y");
      }
      $sumaCargosAnt = number_format($sumaCargos,2,'.',',');
      $sumaAbonosAnt = number_format($sumaAbonos,2,'.',',');

    $detalleRegistrosAnticipo .='<tbody><tr color="black">
      <td width="9%">'.$idPolizasAnt.'</td>
      <td width="10%">'.$cuentaAnt.'</td>
      <td width="11%">'.$referenciaAnt.'</td>
      <td width="9.5%">'.$clienteAnt.'</td>
      <td width="8%">'.$facturaAnt.'</td>
      <td width="9%">'.$ctagtosAnt.'</td>
      <td width="6%">'.$pagoAnt.'</td>
      <td width="8%">'.$ncAnt.'</td>
      <td width="10%">'.$fechapol.'</td>
      <td width="9.8%" align="right">'.$cargoAnt.'</td>
      <td width="9.8%" align="right">'.$abonoAnt.'</td>
    </tr>
    <tr class="bbottom">
      <td width="0.5%"></td>
      <td class="bbottom" width="79.5%" align="left">Desc.'.$descAnt.'</td>
      <td class="bbottom" width="19.5%" align="left"></td>
      <td width="0.5%"></td>
    </tr>';
    }
    $detalleRegistrosAnticipo .= '</tbody></table><br/><br/>';
    $detalleRegistrosAnticipo .= '<style>
        table{
          border:1px solid black;
        }
    </style>
    <table>
      <tfoot>
        <tr color="black">
          <td width="50%">Totales :</td>
          <td width="25%"> $'. $sumaCargosAnt.'</td>
          <td width="25%"> $'. $sumaAbonosAnt .'</td>
        </tr>';

  }
}
  $detalleRegistrosAnticipo .='</tfoot></table>';




$pdf->writeHTML($datosGeneralesAnticipo, true, false, true, false, 'C');
$pdf->writeHTML($detalleRegistrosAnticipo, true, false, true, false, 'C');

$pdf->lastPage();
$pdf->Output('ImpresionPoliza.pdf', 'I');
 ?>

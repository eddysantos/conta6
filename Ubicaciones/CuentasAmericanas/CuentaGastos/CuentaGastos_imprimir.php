<?php

  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Conta6/Resources/vendor/autoload.php';
  require $root . '/Conta6/Resources/PHP/Utilities/initialScript.php';


  $cuenta = trim($_GET['cuenta']);
  require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosGenerales.php';
  require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosPOCME.php'; # $datosPOCMEImprimir
  require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosAnticipos.php'; # $datosANTICIPOImprimir

  #FECHA DE VENCIMIENTO DE LA FACTURA
	if (!is_null($d_fechaVencimiento)){
		$vencimiento = date_format(date_create($d_fechaVencimiento),"Y-m-d");
	}else{ $vencimiento = ""; }


  if( $s_imp_exp == 'IMP' ){
     $vendor = "Vendor";
   } else{
     $vendor = "CONSIGNEE";
   }


  class MYPDF extends TCPDF {
    public function Header(){
         $html = '<table>
           <thead>
             <tr>
               <td align="center"><i><b><font face="Swis721 Hv BT" size="14">IM International Freight Forwarder, Corp.</font></b></i></td>
             </tr>
             <tr>
               <td align="center"><i>9000 San Mateo Dr.</i></td>
             </tr>
             <tr>
               <td align="center"><i>Tejas Industrial Park</i></td>
             </tr>
             <tr>
               <td align="center"><i>78045 Laredo, TX.</i></td>
             </tr>
             <tr>
               <td align="center">Phone (956) 791-4646 to 48 Fax (956) 791-4649</td>
             </tr>
           </thead>
         </table>';
         $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
      }

    public function Footer() {
      $this->SetY(-15);
      $this->SetFont('helvetica', 'I', 8);
    }
  }
  $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $pdf->SetMargins(5, 40, 5);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFont('courier', '', 9);
  $pdf->AddPage();



  $cliente = '<table class="border">
    <thead>
      <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
        <td width="100%" align="center"><b>To</b></td>
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
  $vencimiento = '<table class="border">
    <thead>
      <tr bgcolor="#E62726" style="color:#FFFFFF;">
        <td width="100%" align="center">FECHA DE VENCIMIENTO</td>
      </tr>
    </thead>
    <tbody>
      <tr align="center">
        <td width="100%"><b>'.$vencimiento.'</b></td>
      </tr>
    </tbody>
  </table>';
  $referencia = '<table class="border">
    <thead>
      <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
        <td width="100%" align="center">REFERENCE</td>
      </tr>
    </thead>
    <tbody>
      <tr align="center">
        <td width="100%"><b>'.$fk_referencia.'</b></td>
      </tr>
    </tbody>
  </table>';
  $invoice = '<table class="border">
    <thead>
      <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)" align="center">
        <td width="25%">Invoice No.</td>
        <td width="40%">Date</td>
        <td width="35%">Custom Invoice</td>
      </tr>
    </thead>
    <tbody>
      <tr align="center">
        <td width="25%">'.$pk_id_ctaAme.'</td>
        <td width="40%">'.date_format(date_create($d_fecha),"d/m/Y").'</td>
        <td width="35%">'.$s_customerOrder.'</td>
      </tr>
    </tbody>
  </table>';
  $proveedor = '<table class="border">
    <tr bgcolor="#9f9f9f" align="center" style="color:#FFFFFF">
      <td><b>'.$vendor.'</b></td>
    </tr>
    <tr>
      <td>'.trim($s_prov_nombre).'</td>
    </tr>
    <tr>
      <td>'.trim($s_prov_calle).'</td>
    </tr>
    <tr>
      <td>Tel: '.trim($s_prov_telefono).'</td>
    </tr>
    <tr>
      <td>Fax: '.trim($s_prov_fax).'</td>
    </tr>
  </table>';
  $cargos = '<table class="border">
    <tr bgcolor="#9f9f9f" align="center" style="color:#FFFFFF">
      <td width="80%">Decription of charges</td>
      <td width="20%">Amount</td>
    </tr>
    '.$datosPOCMEImprimir.'
  </table>';
  $datosProveedor = '<table class="border">
    <tr align="center" bgcolor="#808080" style="color:#FFFFFF">
      <td>Quantity</td>
      <td>Weight</td>
      <td>Type</td>
    </tr>
    <tr align="center">
      <td>'.trim($n_bodegaIn).'</td>
      <td>'.number_format($n_peso,2,'.',',').'</td>
      <td>'.trim($s_tipoRegimen).'</td>
    </tr>
    <tr align="center" bgcolor="#808080" style="color:#FFFFFF">
      <td width="100%" colspan="3">Description</td>
    </tr>
    <tr>
      <td width="100%" colspan="3">'.trim($s_descripcion).'</td>
    </tr>
    <tr align="center" bgcolor="#808080" style="color:#FFFFFF">
      <td>Amount</td>
      <td>Freight Bill</td>
      <td>Vendor ID</td>
    </tr>
    <tr align="center">
      <td>'.number_format($n_valor_usd,2,'.',',').'</td>
      <td>'.trim($s_guia_master).'</td>
      <td>'.trim($fk_id_proveedor).'</td>
    </tr>
  </table>';
  $amount = '<table class="border">
    <tr>
      <td width="80%">Sub-total</td>
      <td width="20%" align="right">'.number_format($n_subtotal,2,'.',',').'</td>
    </tr>
    '.$datosANTICIPOImprimir.'
  </table><br><br /><table class="border">
    <tr>
      <td width="80%"><b>Please pay this amount ---&gt;</b></td>
      <td width="20%" align="right">'.number_format($n_total,2,'.',',').'</td>
    </tr>
  </table>';
  $texto1 = '<table class="border">
    <tr>
      <td align="justify">IMPORTER MUST FURNISH MISSING DOCUMENTS WITHIN THE PERIOD OF TIME AS REQUIRED BY CUSTOMS REGULATIONS TO AVOID CUSTOM PENALTIES.</td>
    </tr>
  </table>';
  $texto2 = '<table class="border">
    <tr>
      <td>If you are the importer of record, payment to the broker will not relieve you of Customs charges (duties, taxes or other debts owed Customs) in the event the charges are not paid by the broker. Therefore, if you pay by check, Customs charges may be paid with a separate check payable to the &quot;U.S. Customs Service&quot; which shall be delivered to Customs by the broker.</td>
    </tr>
  </table>';


  $completo = '<style>
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
        '.$cliente.'
      <br/><br/>
      '.$proveedor.'
      <br/><br/>
      '.$datosProveedor.'
      </td>
      <td width="50%"><br />
        '.$vencimiento.'
        <br/><br/>
        '.$referencia.'
        <br/><br/>
        '.$invoice.'
        <br/><br/>
        '.$cargos.'
        <br/><br/>
        '.$amount.'
        <br/><br/>
        '.$texto1.'
      </td>
    </tr>
  </table><br /><br />
  '.$texto2.'';






  $pdf->writeHTML($completo, true, false, true, false, '');



  $pdf->Output($nombreArchivo, 'I');


  #******************************
  #* HISTORIAL                  *
  #******************************
  $descripcion = "Se imprimio cuenta: $cuenta ";

  $clave = 'ctaAme_fac';
  $folio = $cuenta;
  require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';
?>

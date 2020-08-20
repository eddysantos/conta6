<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

require $root . '/Resources/vendor/autoload.php';
require $root . '/Resources/PHP/actions/numtoletras.php';

$id_nomina = trim($_GET['semana']);
$id_aduana = $aduana;
$id_empleado = trim($_GET['id_empleado']);
$anio = trim($_GET['anio']);
$id_regimen = '09';
// $image_file = 'cheetah.svg';
// $image_file = $root . '/Resources/imagenes/sww_icon_red.png';
$image_file = 'sww_icon_red.png';
// $fechaIni = '2019-12-30';
// $fechaFin = '2020-01-03';


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// $pdf->Image($image_file, 8, 10, 35, '', 'PNG', '', 'T', false, 0, '', false, false, 0, false, false, false);
// set default header data
$pdf->SetHeaderData($image_file, 22, '', 'Proyección Logistica Agencia Aduanal S.A de C.V'.'
R.F.C PLA090609N21'.'
Recibo de Honorarios Asimilables a Salarios');

$pdf->setFooterData(array(0,64,0), array(0,64,128));

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

$pdf->SetFont('dejavusans', '', 7, '', true);
$pdf->AddPage();

$sql_Select = "SELECT * FROM conta_t_nom_captura
               INNER JOIN conta_t_nom_cfdi ON pk_id_docNomina = fk_id_docNomina
               WHERE n_anio = $anio and fk_id_aduana = $aduana and n_semana = $id_nomina AND fk_id_regimen = $id_regimen limit 1";

$stmt = $db->prepare($sql_Select);
if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
$rslt = $stmt->get_result();
$rows = $rslt->num_rows;

  $html = '';
  $html .= '<style>
     .border{
       border-top:1px solid black;
       border-left:1px solid black;
       border-right:1px solid black;
       border-bottom:1px solid black;
      }
      table{
        margin:5px;
      }
  </style>';

  while ($row = $rslt->fetch_assoc()) {
    $pk_id_docNomina = $row['pk_id_docNomina'];
    $fk_id_certificado = $row['fk_id_certificado'];
    $s_nombre = $row['s_nombre'];
    $fk_id_empleado = $row['fk_id_empleado'];
    $s_apellidoM = $row['s_apellidoM'];
    $s_apellidoP = $row['s_apellidoP'];
    $s_departamento = $row['s_departamento'];
    $s_RFC = $row['s_RFC'];
    $s_CURP = $row['s_CURP'];
    $d_fechaPago = $row['d_fechaPago'];
    $n_cantidad = $row['n_cantidad'];
    $s_unidad = $row['s_unidad'];
    $s_descripcion = $row['s_descripcion'];
    $n_valor_unitario = $row['n_valor_unitario'];
    $n_importe = $row['n_importe'];
    $n_total = $row['n_total'];

    // Timbrado
    $version = $row['s_timbradoVersion'];
    $UUID = $row['s_UUID'];
    $fechaTimbre = date_format(date_create($row['d_FechaTimbrado']),'Y-m-d\TH:i:s');
    $selloCFD = $row['s_selloCFD'];
    $selloSAT = $row['s_selloSAT'];
    $certificado = $row['s_id_certificadoSAT'];
    $cadenaSAT = "||".$version."|".$UUID."|".$fechaTimbre."|".$selloCFD."|".$certificado."||";
    $id_factura = $pk_id_docNomina;
    $id_nomina = $row['pk_id_nomina'];
    $anio = $row['n_anio'];
    $oficina = $row['fk_id_aduana'];
    $id_regimen = $row['fk_id_regimen'];
    $r_rfc = $s_RFC;
    if($oficina == 470){ $cveOficina = "AER"; }
    if($oficina == 240){ $cveOficina = "NL"; }
    if($oficina == 430){ $cveOficina = "VER"; }
    if($oficina == 160){ $cveOficina = "MAN"; }
    if($id_regimen == 2){ $cveIdRegimen = "Sueldos"; }
    if($id_regimen == 9){ $cveIdRegimen = "Honorarios"; }

    // $nombre_archivo = $id_factura."_".$cveOficina."_".$id_nomina."_".$cveIdRegimen."_".$anio."_".$r_rfc; //asi apararece el link en PLAA

    // NOTE: revisar esta ruta, no supe que campo jalar para el #1
    $nombre_archivo = $id_nomina."_".$cveOficina."_1_".$cveIdRegimen."_".$anio."_".$r_rfc;
    // $fileQR = "/CFDI_nomina/2020/QR/$nombre_archivo.png";
    $fileQR = $root . "/CFDI_nomina/2020/QR/97_NL_1_Honorarios_2020_MADA8111253E5.png";

    require $root . '/Ubicaciones/Nomina/Honorarios/actions/honorariosPercepcionesDeducciones.php'; //percepciones, deducciones, totales
    require $root . '/Ubicaciones/Nomina/Honorarios/actions/honorariosCFDI_relacionado.php'; // CFDI relacionado
    $html .= '
    <table>
      <tr>
        <td width="50%">
        <br />
          <table class="border">
            <thead>
              <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
                <td width="100%" align="center">Empleado</td>
              </tr>
            </thead>
            <tbody>
              <tr align="left">
                <td width="8%">'.$fk_id_empleado.'</td>
                <td width="92%">'.$s_nombre.' '.$s_apellidoP.' '.$s_apellidoM.'</td>
              </tr>
              <tr>
                <td width="50%" align="left"><b>R.F.C:</b>'.$s_RFC.'</td>
                <td width="50%" align="left"><b>CURP:</b>'.$s_CURP.'</td>
              </tr>
              <tr>
                <td width="50%" align="left"><b>Departamento:</b> '.$s_departamento.'</td>
                <td width="50%" align="left"><b>Fecha Pago:</b>'.$d_fechaPago.'</td>
              </tr>
            </tbody>
          </table>
        </td>
        <td width="50%"><br />
          <table class="border">
            <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
              <td width="20%" align="center">FACTURA:</td>
              <td width="38%" align="center">No.CERTIFICADO:</td>
              <td width="43%" align="center">LUGAR Y FECHA:</td>
            </tr>
            <tr>
              <td width="20%" align="center">'.$pk_id_docNomina.'</td>
              <td width="38%" align="center">'.$fk_id_certificado.'</td>
              <td width="43%" align="center">88280 2019-10-18T16:08:29</td>
            </tr>
            <tr>
              <td width="99.9%" align="center"><b>EXPEDIDO :</b></td>
            </tr>
            <tr>
              <td width="99.9%" align="center">Melvin Jones 4040 Burocratas 88280 Nuevo Laredo Tamaulipas
              </td>
            </tr>
          </table>


        </td>
      </tr>
    </table>
    '.$cfdiRelacionado.'
    <br /><br />
    <table class="border">
      <thead>
        <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
          <td width="20%" align="center">CANTIDAD</td>
          <td width="20%" align="center">UNIDAD</td>
          <td width="20%" align="center">DESCRIPCION</td>
          <td width="20%" align="center">VALOR UNITARIO</td>
          <td width="20%" align="center">IMPORTE</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width="20%" align="center">'.$n_cantidad.'</td>
          <td width="20%" align="center">'.$s_unidad.'</td>
          <td width="20%" align="center">'.$s_descripcion.'</td>
          <td width="20%" align="center">'.$n_valor_unitario.'</td>
          <td width="20%" align="center">'.$n_importe.'</td>
        </tr>
      </tbody>
    </table>
    <br />

    <br /><br /> ';




   $html .='<table>
     <tr>
       <td width="50%">
       <br />
         <table>
          <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
            <td width="100%" align="center">PERCEPCIONES</td>
          </tr>
           '.$datosPercepcionesHon.'
         </table>
       </td>
       <td width="50%"><br />
         <table >
           <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
             <td width="100%" align="center">DEDUCCIONES</td>
           </tr>
           '.$datosDeduccionesHon.'
         </table>
       </td>
     </tr>
   </table>
   <br /><br />
   '.$totales.' <br /><br /><br /><br /><br />';


   $html .='<table>
     <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
       <td width="100%" align="center">DATOS DE TIMBRADO</td>
     </tr>
     <tr>
       <td width="35%">
       <br />
         <table>
          <tr>
            <td><img src="'.$fileQR.'" alt="" /></td>
          </tr>
         </table>
       </td>
       <td width="65%">
       <br />
         <table align="left">
           <tr>
             <td width="100%"><b>Folio Fiscal :</b>'.$UUID.'</td>
           </tr>
           <tr>
             <td width="100%"><b>Certificado Digital SAT :</b>'.$certificado.'</td>
           </tr>
           <tr>
             <td width="100%"><b>Fecha de Certificación :</b>'.$fechaTimbre.'</td>
           </tr>

           <br /><br />

           <tr>
             <td width="100%"><b>Cadena Original del Complemento de Vertificado Digital del SAT  </b>
               '.wordwrap($cadenaSAT, 85,'<br>',1).'
             </td>
           </tr>
           <br />
           <tr>
             <td width="100%"><b>Sello Digital  </b>
               '.wordwrap($selloCFD, 85,'<br>',1).'
             </td>
           </tr>
           <br />
           <tr>
             <td width="100%"><b>Sello Digital SAT  </b>
               '.wordwrap($selloSAT, 85,'<br>',1).'
             </td>
           </tr>


         </table>
       </td>
     </tr>
   </table>';

  $html .='<br /><br /><br /><br /><br />
  <table align="center">
    <tr>
      <td style="color:#E62726; font-weight: bold;">Este documento es una representaci&oacute;n impresa de un CFDI</td>
    </tr>
  </table>';

  }


$pdf->writeHTML($html, true, 0, true, 0, '');
// ---------------------------------------------------------
$pdf->lastPage();
$pdf->Output($nombre_archivo, 'I');
?>

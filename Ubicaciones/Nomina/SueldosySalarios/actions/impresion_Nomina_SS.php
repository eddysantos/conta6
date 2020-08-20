<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

require $root . '/Resources/vendor/autoload.php';
require $root . '/Resources/PHP/actions/numtoletras.php';

$id_nomina = trim($_GET['semana']);
$id_aduana = $aduana;
$id_empleado = trim($_GET['id_empleado']);
$anio = trim($_GET['anio']);
$id_regimen = '02';
// $image_file = 'cheetah.svg';
$image_file = 'sww_icon_red.png';


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetHeaderData($image_file, 22, '', 'Proyección Logistica Agencia Aduanal S.A de C.V'.'
R.F.C PLA090609N21'.'
Recibo de Nomina - Registro Patronal');

$pdf->setFooterData(array(0,64,0), array(0,64,128));

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, 'Proyeccion', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setFontSubsetting(true);
$pdf->SetFont('dejavusans', '', 6, '', true);
$pdf->AddPage();


$sql_Select = "SELECT * FROM conta_t_nom_captura
               INNER JOIN conta_t_nom_cfdi ON pk_id_docNomina = fk_id_docNomina
               WHERE n_anio = $anio and fk_id_aduana = $aduana and n_semana = $id_nomina AND fk_id_regimen = $id_regimen";

$stmt = $db->prepare($sql_Select);
if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
$rslt = $stmt->get_result();
$rows = $rslt->num_rows;

  $html = '<style>
             .border{
               border-top:1px solid black;
               border-left:1px solid black;
               border-right:1px solid black;
               border-bottom:1px solid black;
              }
              .border-titulo{
                border-top:0.5px solid black;
                border-left:1px solid black;
                border-right:1px solid black;
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
    $s_RFC = $row['s_RFC'];
    $s_CURP = $row['s_CURP'];
    $s_IMSS = $row['s_IMSS'];
    $s_INFONAVIT = $row['s_INFONAVIT'];
    $s_departamento = $row['s_departamento'];
    $n_semana = $row['n_semana'];
    $d_fechaInicio = $row['d_fechaInicio'];
    $d_fechaFinal = $row['d_fechaFinal'];
    $d_fechaPago = $row['d_fechaPago'];
    $n_cantidad = $row['n_cantidad'];
    $s_unidad = $row['s_unidad'];
    $s_descripcion = $row['s_descripcion'];
    $n_valor_unitario = $row['n_valor_unitario'];
    $n_importe = $row['n_importe'];
    $n_total = $row['n_total'];
    $salarioDiarioIntegrado = $row['n_salarioDiarioIntegrado'];
    $s_descNomina = $row['s_descNomina'];
    $tablaFiniquito = "";

    require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/detalleNomina.php'; #Tabla detalle de nomina

    if ($s_descNomina == "Finiquito") {
      $tablaFiniquito = '<table class="border">
			  <tr align="center" bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
  				<td>Años de Servicio</td>
  				<td>Último Sueldo Mensual</td>
  				<td>Ingreso Acumulable</td>
  				<td>Ingreso No Acumulable</td>
  				<td>Total Pagado</td>
			  </tr>
			  <tr align="center">
  				<td>'.$anioServicio.'</td>
  				<td>'.$ultimoSueldoMensual.'</td>
  				<td>'.$ingresoAcumulable.'</td>
  				<td>'.$ingresoNoAcumulable.'</td>
  				<td>'.$totalPagado.'</td>
			  </tr>
			</table>
      <br /><br />';
    }

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

    $nombre_archivo = $id_nomina."_".$cveOficina."_1_".$cveIdRegimen."_".$anio."_".$r_rfc;

    $fileQR = $root . "/CFDI_nomina/2020/QR/98_NL_1_Sueldos_2020_PUMS661129JP6.png";


  $html .= '
  <table >
    <tr align="center">
      <td class="border-titulo"  width="49.5%" bgcolor="#9f9f9f" color="rgb(255, 255, 255)">Empleado</td>
      <td width="1%"></td>
      <td class="border-titulo" width="49.5%" bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
        <table>
          <tr>
            <td width="20%" align="center">FACTURA:</td>
            <td width="38%" align="center">No.CERTIFICADO:</td>
            <td width="43%" align="center">LUGAR Y FECHA:</td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td class="border">
        <table >
          <tr align="left">
            <td width="8%">'.$fk_id_empleado.'</td>
            <td width="92%">'.$s_nombre.' '.$s_apellidoP.' '.$s_apellidoM.'</td>
          </tr>
          <tr>
            <td width="50%" align="left"><b>R.F.C: </b>'.$s_RFC.'</td>
            <td width="50%" align="left"><b>CURP: </b>'.$s_CURP.'</td>
          </tr>
          <tr>
            <td width="50%" align="left"><b>No. Seguro social: </b> '.$s_IMSS.'</td>
            <td width="50%" align="left"><b>No. Credito Infonavit: </b>'.$s_INFONAVIT.'</td>
          </tr>
          <tr>
            <td width="50%" align="left"><b>Depto: </b> '.$s_departamento.'</td>
            <td width="50%" align="left"><b>Nomina: </b>'.$n_semana.'</td>
          </tr>
          <tr>
            <td width="50%" align="left"><b>Fecha Inicio: </b> '.$d_fechaInicio.'</td>
            <td width="50%" align="left"><b>Fecha Final: </b>'.$d_fechaFinal.'</td>
          </tr>
        </table>
      </td>
      <td></td>
      <td class="border">
        <table>
          <tr>
            <td width="20%" align="center">'.$pk_id_docNomina.'</td>
            <td width="38%" align="center">'.$fk_id_certificado.'</td>
            <td width="43%" align="center">88280 2019-10-18T16:08:29</td>
          </tr>
          <br />
          <tr>
            <td width="99.9%" align="center"><b>EXPEDIDO :</b></td>
          </tr>
          <tr>
            <td width="99.9%" align="center">Melvin Jones 4040 Burocratas 88280 Nuevo Laredo Tamaulipas
            </td>
          </tr>
          <tr><td width="99.9%" align="center"></td></tr>
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
  <br /><br />
  <table class="border">
    <thead>
      <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
        <td width="16.66%" align="center">Salario diario</td>
        <td width="16.66%" align="center">Horas Extras</td>
        <td width="16.66%" align="center">Días</td>
        <td width="16.66%" align="center">Vacaciones</td>
        <td width="16.66%" align="center">Faltas</td>
        <td width="16.66%" align="center">Incapacidad</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td width="16.66%" align="center">'.$salarioDiarioIntegrado.'</td>
        <td width="16.66%" align="center">'.$totalHorasExtras.'</td>
        <td width="16.66%" align="center">'.$totalApagar.'</td>
        <td width="16.66%" align="center">'.$totalVacaciones.'</td>
        <td width="16.66%" align="center">'.$totalFaltas.'</td>
        <td width="16.66%" align="center">'.$totalIncapacidad.'</td>
      </tr>
    </tbody>
  </table>
  <br /><br />
  '.$tablaFiniquito.'';
  // percepciones - deducciones
  $html .= '
  <table>
    <tr align="center">
      <td width="49.5%" bgcolor="#9f9f9f" color="rgb(255, 255, 255)">Percepciones</td>
      <td width="1%"></td>
      <td width="49.5%" bgcolor="#9f9f9f" color="rgb(255, 255, 255)">Deducciones</td>
    </tr>
    <tr>
      <td>
        <table>
          '.$percepciones.'
          '.$horas_extras.'
        </table>
      </td>
      <td></td>
      <td valign="top">
        <table>
          '.$deducciones.'
        </table>
      </td>
    </tr>
    <br />
    <tr align="right">
      <td><b>Total $ '.$totalPercepciones.'</b></td>
      <td></td>
      <td><b>Total $ '.$totalDeducciones.'</b></td>
    </tr>
  </table> ';
  // OTROS PAGOS
  $html .= '
    <br /><br />
    '.$tablaotrosPagos.'
    <br /><br />
  ';
  // TOTALES
  $html .= '
    <table>
    <tr>
      <td width="75%"></td>
      <td width="15%" bgcolor="#9f9f9f" color="rgb(255, 255, 255)">Vales de despensa :</td>
      <td width="10%" align="right"><b>$ '.$totalValesDespensa.'</b> </td>
    </tr>
    <tr>
      <td></td>
      <td width="15%" bgcolor="#9f9f9f" color="rgb(255, 255, 255)">Neto Pagar :</td>
      <td width="10%" align="right"><b>$ '.$totalNeto.'</b></td>
    </tr>
    <tr align="">
      <td>***'.$numeroLetras.'***</td>
      <td bgcolor="#9f9f9f" color="rgb(255, 255, 255)">Pago Total :</td>
      <td align="right"><b>$ '.$total.'</b></td>
    </tr>
  </table>
  <br /><br /> <br /><br />
    <table>
      <tr>
        <td width="50%" align="justify">Recibí de la Empresa "Proyección Logística Agencia Aduanal, S.A. de C.V." la cantidad que señala este recibo en pago de mi sueldo estando conforme con las percepciones y deducciones descritas, por lo que certifico que no se me adeuda cantidad alguna por ningún concepto.</td>
        <td width="50%"></td>
      </tr>
      <tr>
        <td></td>
        <td width="50%" align="center" style="border-top-width:1px;  border-top-style:solid; border-color:#000000;">Firma de Conformidad</td>
      </tr>

    </table>
  ';
  // Timbrado
  $html .= '<br /><br />
    <table>
      <tr align="center">
        <td bgcolor="#9f9f9f" color="rgb(255, 255, 255)">DATOS DE TIMBRADO</td>
      </tr>
      <br /><br />
      <tr>
        <td width="30%">
          <img src="'.$fileQR.'">
        </td>
        <td width="70%"><b>Folio Fiscal </b>'.$UUID.' <br />
          <b>Certificado Digital SAT </b> '.$certificado.'<br />
          <b>Fecha de Certificación</b> '.$fechaTimbre.' <br />
          <b>Cadena Original del Complemento de Certificación Digital del SAT</b><br />
          '.wordwrap($cadenaSAT, 85,'<br>',1).'<br />
          <b>Sello Digital</b><br />
          '.wordwrap($selloCFD, 85,'<br>',1).'<br />
          <b>Sello Digital SAT</b> <br />
          '.wordwrap($selloSAT, 85,'<br>',1).'<br />
        </td>
      </tr>
      <br /><br /><br />
      <tr align="center">
        <td width="100%" style="color:#E62726; font-weight: bold;">Este documento es una representación impresa de un CFDI</td>
      </tr>

    </table>
  ';
  $html .= '<br pagebreak="true" />';


}

$pdf->writeHTML($html, true, 0, true, 0, '');

// ---------------------------------------------------------
$pdf->lastPage();
$pdf->Output($nombre_archivo, 'I');
?>

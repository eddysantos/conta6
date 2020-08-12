<?php
#totales
$query_totales = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM conta_t_nom_captura_det WHERE fk_id_docNomina = $pk_id_docNomina AND s_tipoElemento = 'totales' "));
$totalVacaciones = $query_totales['n_dias_vacaciones'];
$totalFaltas = $query_totales['n_dias_faltas'];
$totalIncapacidad = $query_totales['n_dias_incapacidad_dscto'];
$totalApagar = $query_totales['n_dias_pagar'];
$totalPercepciones = number_format($query_totales['n_totalPercepciones'],2,'.',',');
$totalOtrosPagos = number_format($query_totales['n_totalOtrosPagos'],2,'.',',');
$totalDeducciones = number_format($query_totales['n_totalDeducciones'],2,'.',',');
$total = number_format($query_totales['n_total'],2,'.',',');
$totalNeto = number_format($query_totales['n_totalNeto'],2,'.',',');
$anioServicio = $query_totales['n_numAniosServicio'];
$ultimoSueldoMensual =  number_format($query_totales['n_ultimoSueldoMensOrd'],2,'.',',');
$ingresoAcumulable = number_format($query_totales['n_ingresoAcumulable'],2,'.',',');
$ingresoNoAcumulable = number_format($query_totales['n_ingresoNoAcumulable'],2,'.',',');
$totalPagado = number_format($query_totales['n_totalPagado'],2,'.',',');


$n_total = $query_totales['n_total'];
$numeroLetras = numtoletras($n_total);


#Total horas extra
$query_totalHorasExtras = mysqli_fetch_array(mysqli_query($db,"SELECT sum(n_horasExtra) as horasExtra FROM conta_t_nom_captura_det WHERE s_tipoElemento = 'horasExtras' and fk_id_docNomina = $pk_id_docNomina"));
if ($query_totalHorasExtras == 0) {
  $totalHorasExtras = "0";
}else {
  $totalHorasExtras = $query_totalHorasExtras['n_horasExtra'];
}

#Percepciones
$query_percepciones = mysqli_query($db,"SELECT s_concepto,n_importeGravado,n_importeExento FROM conta_t_nom_captura_det WHERE s_tipoElemento = 'percepcion' and fk_id_docNomina = $pk_id_docNomina");

$percepciones = '';
while ($row_percepciones =  mysqli_fetch_array($query_percepciones)) {
  $concepto = $row_percepciones['s_concepto'];
  $gravado_exento = number_format($row_percepciones['n_importeGravado']+$row_percepciones['n_importeExento'],2,'.',',');

  $percepciones .= '<tr valign="top">
    <td>'.$concepto.'</td>
    <td align="right">$ '.$gravado_exento.'</td>
  </tr> ';
}

#Horas Extras Pago
$query_he = mysqli_query($db,"SELECT s_concepto, n_horasExtra, n_importePagado FROM conta_t_nom_captura_det WHERE s_tipoElemento = 'horasExtras' and fk_id_docNomina = $pk_id_docNomina");

$horas_extras = '';
while($row_horasExtras = mysqli_fetch_array($query_he)){
  $he_concepto = $row_horasExtras['s_concepto'];
  $he_horas =  $row_horasExtras['n_horasExtra'];
  $he_importePagado = number_format($row_horasExtras['n_importePagado'],2,'.',',');

  $horas_extras .= '
    <tr valign="top">
      <td>Horas Extras '.$he_concepto.' '.$he_horas.'</td>
      <td align="right">'.$he_importePagado.'</td>
    </tr>
  ';
}

#Deducciones
$query_deducciones = mysqli_query($db,"SELECT s_concepto, n_importeGravado, n_importeExento FROM conta_t_nom_captura_det WHERE s_tipoElemento = 'deduccion' AND fk_id_docNomina = $pk_id_docNomina");

$deducciones = '';
while ($row_deducciones = mysqli_fetch_array($query_deducciones)) {
  $ded_concepto = $row_deducciones['s_concepto'];
  $ded_gravado_exento = number_format($row_deducciones['n_importeGravado']+$row_deducciones['n_importeExento'],2,'.',',');

  $deducciones .= '
    <tr>
      <td>'.$ded_concepto.'</td>
      <td align="right">'.$ded_gravado_exento.'</td>
    </tr>
  ';
}

#Otros Pagos
$query_otrosPagos = mysqli_query($db,"SELECT s_concepto,n_importeGravado,n_importeExento FROM conta_t_nom_captura_det WHERE s_tipoElemento = 'otrosPagos' AND fk_id_docNomina = $pk_id_docNomina");
$otrosPagos = '';
while ($row_otrosPagos = mysqli_fetch_array($query_otrosPagos)) {
  $op_concepto = $row_otrosPagos['concepto'];
  $op_gravado_exento = number_format($row_otrosPagos['importeGravado']+$row_otrosPagos['importeExento'],2,'.',',');
  $otrosPagos .= '
  <tr>
    <td>'.$op_concepto.'</td>
    <td align="right">$ '.$op_gravado_exento.'</td>
  </tr>
  ';
}


#Subsidio Causado
$query_otrosPagos_subsidiocausado = mysqli_query($db,"SELECT n_subsidioCausado FROM conta_t_nom_captura_det WHERE s_tipoElemento = 'otrosPagos' and fk_id_docNomina = $pk_id_docNomina and fk_claveSAT = '002'");

if ($totalOtrosPagos > 0) {
  $row_otrosPagos_subsidiocausado = mysqli_fetch_array($query_otrosPagos_subsidiocausado);
  $subsidioCausado = $row_otrosPagos_subsidiocausado['subsidioCausado'];

  if( $subsidioCausado > 0 ){
    $linea_subCausado = '
    <table>
      <tr>
        <td>Subsidio Causado '.$subsidioCausado.'</td>
        <td align="right"></td>
      </tr>
    </table>';

    $encabezado_subCausado = '<td width="49.5%" bgcolor="#9f9f9f" color="rgb(255, 255, 255)">Subsidio al Empleo</td>';
  }else{
    $encabezado_subCausado = '<td width="49.5%"></td>';
    $linea_subCausado = '';
  }

  $tablaotrosPagos = '
  <table>
    <tr align="center">
      <td width="49.5%" bgcolor="#9f9f9f" color="rgb(255, 255, 255)">Otros Pagos</td>
      <td width="1%"></td>
      '.$encabezado_subCausado.'
      <td width="49.5%"></td>
    </tr>
    <tr>
      <td valign="top">
        <table>
          '.$otrosPagos.'
        </table>
      </td>
      <td></td>
      <td valign="top">
        <table>
          '.$deducciones.'
        </table>
        '.$linea_subCausado.'
      </td>
    </tr>
    <tr align="right">
      <td><b>Total '.$totalOtrosPagos.'</b></td>
      <td></td>
      <td></td>
    </tr>
  </table>';
}// fin del if otros Pagos


#Total Vales de despensa
$query_valesDespensa = mysqli_fetch_array(mysqli_query($db,"SELECT n_importeGravado, n_importeExento FROM conta_t_nom_captura_det WHERE s_concepto LIKE '%vales%' AND fk_id_docNomina = $pk_id_docNomina"));
$totalValesDespensa = number_format($query_valesDespensa['importeGravado'] + $query_valesDespensa['importeExento'],2,'.',',');
// if($totalValesDespensa > 0){ $totalValesDespensa; }else { echo "0.0"; }








?>

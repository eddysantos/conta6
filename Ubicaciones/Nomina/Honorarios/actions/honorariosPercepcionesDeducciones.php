<?php
// PERCEPCIONES
$query_consultarPercepciones = "SELECT s_concepto, n_importeGravado, n_totalPercepciones, s_tipoElemento, fk_id_docNomina FROM conta_t_nom_captura_det WHERE s_tipoElemento = 'percepcion' AND fk_id_docNomina = $pk_id_docNomina";

$stmt_consulHonPer = $db->prepare($query_consultarPercepciones);
$stmt_consulHonPer->execute();
$rslt_consulHonPer = $stmt_consulHonPer->get_result();
$total_consulHonPer = $rslt_consulHonPer->num_rows;
$datosPercepcionesHon = '';

if ($total_consulHonPer > 0) {
  $idFila = 0;
   while ($row_perHon = $rslt_consulHonPer->fetch_assoc()) {
    ++$idFila;

    $s_concepto = $row_perHon['s_concepto'];
    $n_importeGravado = $row_perHon['n_importeGravado'];
    $n_totalPercepciones = $row_perHon['n_totalPercepciones'];


    $datosPercepcionesHon .= '<tr>
      <td width="80%">'.$s_concepto.'</td>
      <td width="20%">$ '.$n_importeGravado.'</td>
    </tr> ';
   }
}


// DEDUCCIONES
$query_consultarDeducciones = "SELECT s_concepto, n_importeExento, n_totalPercepciones, s_tipoElemento, fk_id_docNomina FROM conta_t_nom_captura_det WHERE  s_tipoElemento = 'deduccion' AND fk_id_docNomina = $pk_id_docNomina";


$stmt_consulHonDed = $db->prepare($query_consultarDeducciones);
$stmt_consulHonDed->execute();
$rslt_consulHonDed = $stmt_consulHonDed->get_result();
$total_consulHonDed = $rslt_consulHonDed->num_rows;
$datosDeduccionesHon = '';

if ($total_consulHonDed > 0) {
  $idFila = 0;
   while ($row_perHonDed = $rslt_consulHonDed->fetch_assoc()) {
    ++$idFila;

    $s_conceptoDed = $row_perHonDed['s_concepto'];
    $n_importeExento = $row_perHonDed['n_importeExento'];

    $datosDeduccionesHon .= '<tr>
      <td width="80%">'.$s_conceptoDed.'</td>
      <td width="20%">$ '.$n_importeExento.'</td>
    </tr> ';
   }
}


// DEDUCCIONES
$query_consultarTotal = "SELECT n_totalDeducciones,n_totalPercepciones,n_totalNeto,s_tipoElemento,fk_id_docNomina FROM conta_t_nom_captura_det WHERE s_tipoElemento = 'totales' AND fk_id_docNomina = $pk_id_docNomina";


$stmt_consulHonTot = $db->prepare($query_consultarTotal);
$stmt_consulHonTot->execute();
$rslt_consulHonTot = $stmt_consulHonTot->get_result();
$total_consulHonTot = $rslt_consulHonTot->num_rows;
$totales = '';

if ($total_consulHonTot > 0) {
  $idFila = 0;
   while ($row_perHonTot = $rslt_consulHonTot->fetch_assoc()) {
    ++$idFila;

    $n_totalDeducciones = $row_perHonTot['n_totalDeducciones'];
    $n_totalPercepciones = $row_perHonTot['n_totalPercepciones'];
    $n_totalNeto = $row_perHonTot['n_totalNeto'];
    $numeroLetras = numtoletras($n_totalNeto);

    $totales .= '<table>
      <tr>
        <td width="50%">
        <br />
          <table>
           <tr>
             <td width="80%" align="right">TOTAL</td>
             <td width="20%" align="left">$ '.$n_totalPercepciones.'</td>
           </tr>
           <tr>
             <td width="100%" align="left">***'.$numeroLetras.'***</td>
           </tr>
          </table>
        </td>
        <td width="50%"><br />
          <table>
            <tr>
              <td width="80%" align="right">TOTAL</td>
              <td width="20%" align="left">$ '.$n_totalDeducciones.'</td>
            </tr>
            <tr>
              <td width="80%" align="right">NETO A PAGAR</td>
              <td width="20%" align="left">$ '.$n_totalNeto.'</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>';
   }
}



?>

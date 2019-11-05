<?php
  $query_capturaTotales = "select * from conta_t_nom_captura_det where fk_id_docNomina = ? and s_tipoElemento = 'totales' order by pk_id_partida";

$stmt_capturaTotales = $db->prepare($query_capturaTotales);
if (!($stmt_capturaTotales)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_capturaTotales->bind_param('s',$idDocNomina);
if (!($stmt_capturaTotales)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_capturaTotales->errno]: $stmt_capturaTotales->error";
  exit_script($system_callback);
}

if (!($stmt_capturaTotales->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_capturaTotales->errno]: $stmt_capturaTotales->error";
  exit_script($system_callback);
}

$rslt_capturaTotales = $stmt_capturaTotales->get_result();

while ($row_capturaTotales = $rslt_capturaTotales->fetch_assoc()) {
  $partidaT = $row_capturaTotales['pk_id_partida'];
  $tipo_incapacidad = $row_capturaTotales['s_tipo_incapacidad'];
  $dias_incapacidad = $row_capturaTotales['n_dias_incapacidad'];
  $dias_incapacidad_dscto = $row_capturaTotales['n_dias_incapacidad_dscto'];
  $dias_incapacidad_pgo = $row_capturaTotales['n_dias_incapacidad_pgo'];
  $dias_vacaciones = $row_capturaTotales['n_dias_vacaciones'];
  $dias_faltas =$row_capturaTotales['n_dias_faltas'];
  $dias_pagar = $row_capturaTotales['n_dias_pagar'];
  $totalPercepciones = $row_capturaTotales['n_totalPercepciones'];
  $totalDeducciones = $row_capturaTotales['n_totalDeducciones'];
  $total = $row_capturaTotales['n_total'];
  $totalOtrosPagos = $row_capturaTotales['n_totalOtrosPagos'];
  $totalNeto = $row_capturaTotales['n_totalNeto'];

  $detalle_TOTALES.= "
  <tr>
    <td>INCAPACIDAD</td>
    <td><select class='custom-select-s' name='select' id='incapacidadConceptos' onchange='concepIncapacidad()'>
     $incapacidad
    </select></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Tipo</td>
    <td><input id='tipo' class='efecto border-0' value='$tipo_incapacidad' readonly></td>
    <td>Vacaciones</td>
    <td><input id='totvac' class='efecto' value='$dias_vacaciones'></td>
    <td>Percepciones</td>
    <td><input type='text' id='totpercep' class='efecto border-0' value='$totalPercepciones' readonly></td>
  </tr>
  <tr>
    <td>Dias</td>
    <td><input id='indias' class='efecto' value='$dias_incapacidad'></td>
    <td>Faltas</td>
    <td><input id='totfaltas' class='efecto' value='$dias_faltas'></td>
    <td>Deducciones</td>
    <td><input type='text' id='totdeduc' class='efecto border-0' value='$totalDeducciones' readonly></td>
  </tr>
  <tr>
    <td>Descontar</td>
    <td><input id='indescontar' class='efecto' value='$dias_incapacidad_dscto'></td>
    <td>Dias a pagar </td>
    <td><input id='totpagar' class='efecto' value='$dias_pagar'></td>
    <td>Total</td>
    <td><input type='text' id='tottotal' class='efecto border-0' value='$total' readonly></td>
  </tr>
  <tr>
    <td>Pagar</td>
    <td><input id='inpagar' class='efecto' value='$dias_incapacidad_pgo'></td>
    <td></td>
    <td></td>
    <td>Otros pagos </td>
    <td><input type='text' id='tototrospagos' class='efecto border-0' value='$totalOtrosPagos' readonly></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Neto</td>
    <td><input type='text' id='totneto' class='efecto border-0' value='$totalNeto' readonly></td>
  </tr> ";
}

?>

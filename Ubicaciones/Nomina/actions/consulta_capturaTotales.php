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

  $numAniosServicio = $row_capturaTotales['n_numAniosServicio'];
  $ultimoSueldoMensOrd = $row_capturaTotales['n_ultimoSueldoMensOrd'];
  $ingresoAcumulable = $row_capturaTotales['n_ingresoAcumulable'];
  $ingresoNoAcumulable = $row_capturaTotales['n_ingresoNoAcumulable'];
  $totalPagado = $row_capturaTotales['n_totalPagado'];


  $detalle_TOTALES.= "
  <tr>
      <td>INCAPACIDAD</td>
      <td><select class='custom-select-s' name='select' id='incapacidadConceptos' onchange='concepIncapacidad()'>
       $incapacidad
      </select></td>
      <td colspan='2'>SEPARACIÓN E INDEMNIZACIÓN</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>Tipo</td>
      <td><input id='tipo' class='efecto border-0' value='$tipo_incapacidad' readonly></td>
      <td>Años de servicio </td>
      <td><input id='anioserv' class='efecto' value='$numAniosServicio' onBlur='validaIntDec(this)'></td>
      <td>Vacaciones</td>
      <td><input id='totvac' class='efecto' value='$dias_vacaciones' onBlur='validaIntDec(this)'></td>
      <td>Percepciones</td>
      <td><input type='text' id='totpercep' class='efecto border-0' value='$totalPercepciones' readonly></td>
    </tr>
    <tr>
      <td>Dias</td>
      <td><input id='indias' class='efecto' value='$dias_incapacidad' onBlur='validaIntDec(this)'></td>
      <td>Último sueldo mensual </td>
      <td><input id='ultsuelmesord' class='efecto' value='$ultimoSueldoMensOrd' onBlur='validaIntDec(this)'></td>
      <td>Faltas</td>
      <td><input id='totfaltas' class='efecto' value='$dias_faltas' onBlur='validaIntDec(this)'></td>
      <td>Deducciones</td>
      <td><input type='text' id='totdeduc' class='efecto border-0' value='$totalDeducciones' readonly></td>
    </tr>
    <tr>
      <td>Descontar</td>
      <td><input id='indescontar' class='efecto' value='$dias_incapacidad_dscto' onBlur='validaIntDec(this)'></td>
      <td>Ingreso acumulable </td>
      <td><input id='ingacum' class='efecto' value='$ingresoAcumulable' onBlur='validaIntDec(this)'></td>
      <td>Dias a pagar </td>
      <td><input id='totpagar' class='efecto' value='$dias_pagar' onBlur='validaIntDec(this)'></td>
      <td>Total</td>
      <td><input type='text' id='tottotal' class='efecto border-0' value='$total' readonly onBlur'sumaGeneralNomina()'></td>
    </tr>
    <tr>
      <td>Pagar</td>
      <td><input id='inpagar' class='efecto' value='$dias_incapacidad_pgo' onBlur='validaIntDec(this)'></td>
      <td>Ingreso no acumulable </td>
      <td><input id='ingnoacum' class='efecto' value='$ingresoNoAcumulable' onBlur='validaIntDec(this)'></td>
      <td></td>
      <td></td>
      <td>Otros pagos </td>
      <td><input type='text' id='tototrospagos' class='efecto border-0' value='$totalOtrosPagos' readonly onBlur='sumaGeneralNomina'></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Total pagado </td>
      <td><input id='totalpagado' class='efecto' value='$totalPagado' onBlur='validaIntDec(this)'></td>
      <td></td>
      <td></td>
      <td>Neto</td>
      <td><input type='text' id='totneto' class='efecto border-0' value='$totalNeto' readonly onBlur='sumaGeneralNomina'></td>
    </tr>
";
/*
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
    <td><input id='totvac' class='efecto' value='$dias_vacaciones' onBlur='validaIntDec(this)'></td>
    <td>Percepciones</td>
    <td><input type='text' id='totpercep' class='efecto border-0' value='$totalPercepciones' readonly></td>
  </tr>
  <tr>
    <td>Dias</td>
    <td><input id='indias' class='efecto' value='$dias_incapacidad' onBlur='validaIntDec(this)'></td>
    <td>Faltas</td>
    <td><input id='totfaltas' class='efecto' value='$dias_faltas' onBlur='validaIntDec(this)'></td>
    <td>Deducciones</td>
    <td><input type='text' id='totdeduc' class='efecto border-0' value='$totalDeducciones' readonly></td>
  </tr>
  <tr>
    <td>Descontar</td>
    <td><input id='indescontar' class='efecto' value='$dias_incapacidad_dscto' onBlur='validaIntDec(this)'></td>
    <td>Dias a pagar </td>
    <td><input id='totpagar' class='efecto' value='$dias_pagar' onBlur='validaIntDec(this)'></td>
    <td>Total</td>
    <td><input type='text' id='tottotal' class='efecto border-0' value='$total' readonly onBlur'sumaGeneralNomina()'></td>
  </tr>
  <tr>
    <td>Pagar</td>
    <td><input id='inpagar' class='efecto' value='$dias_incapacidad_pgo' onBlur='validaIntDec(this)'></td>
    <td></td>
    <td></td>
    <td>Otros pagos </td>
    <td><input type='text' id='tototrospagos' class='efecto border-0' value='$totalOtrosPagos' readonly onBlur='sumaGeneralNomina'></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Neto</td>
    <td><input type='text' id='totneto' class='efecto border-0' value='$totalNeto' readonly onBlur='sumaGeneralNomina'></td>
  </tr> ";

  */
}

?>

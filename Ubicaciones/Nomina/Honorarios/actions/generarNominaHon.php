<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$anio = $_POST['anio_nomsig'];
$NUM_NOMINA = $_POST['num_nomsig'];
$FECHAINICIO = $_POST['fi_nomsig'];
$FECHAFINAL = $_POST['ff_nomsig'];
$fechaPago = $_POST['fp_nomsig'];

$id_regimen = '09';
$tipoNomina = "O"; #NOMINA ORDINARIA
$unidad = "ACT";
$DIAS_PAGAR = 5;
$descNomina = 'Honorarios';
$descConcepto = 'Pago de nómina'; #default en BD
$METODODEPAGO = 'PUE'; #default en BD
$usoCFDI = 'P01'; #default BD

$query = "select a.*,b.s_descripcion AS nom_depto
          from conta_t_nom_empleados a
						INNER JOIN conta_cs_departamentos b
          on a.fk_id_depto = b.pk_id_depto where s_activo = 's' and s_pagar = 's' and fk_id_regimen = ? and fk_id_aduana = ?
          ORDER BY pk_id_empleado";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss',$id_regimen,$aduana);

if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$rslt_empl = $stmt->get_result();

if ($rslt_empl->num_rows == 0) {
  $system_callback['code'] = 1;
  $system_callback['data'] =
  "<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

if ($rslt_empl->num_rows > 0) {
  $system_callback['data'] =
  "<table>
    <tr>
      <td>EMPLEADO</td>
      <td>SUELDO</td>
      <td>ISR</td>
      <td>TOTAL</td>
      <td>CAPTURA</td>
    </tr>";
  while ($row_empl = $rslt_empl->fetch_assoc()) {
    $id_empleado = $row_empl['pk_id_empleado'];
    $SALARIO_SEMANAL = $row_empl['n_salario_semanal'];
    $ISR = $row_empl['n_ISR'];
    $nombre = $row_empl['s_nombre'];
    $apellidoP = $row_empl['s_apellidoP'];
    $apellidoM = $row_empl['s_apellidoM'];
    $curp = $row_empl['s_CURP'];
    $rfc = $row_empl['s_RFC'];
    $id_banco = $row_empl['fk_id_banco'];
    $cta_banco = $row_empl['s_cta_banco'];
    $puesto = $row_empl['s_puesto_actividad'];
    $id_contrato = $row_empl['fk_id_contrato'];
    $id_jornada = $row_empl['fk_id_jornada'];
    $id_pago = $row_empl['fk_id_pago'];
    $id_depto = $row_empl['fk_id_depto'];
    $id_entfed = $row_empl['s_id_entfed'];
    $nom_depto = $row_empl['nom_depto'];
    $id_riesgo = $row_empl['fk_id_riesgo'];
    $fechaContrato = $row_empl['d_fechaContrato'];

    $TOTAL_PERCEPCIONES = $SALARIO_SEMANAL;
	  $TOTAL_DEDUCCIONES = $ISR;
	  $TOTAL = $TOTAL_PERCEPCIONES - $TOTAL_DEDUCCIONES;
	  $TOTAL_NETO = $TOTAL_PERCEPCIONES - $TOTAL_DEDUCCIONES;



    require $root . '/conta6/Ubicaciones/Nomina/Honorarios/actions/generarNominaHon_1agregarDocCaptura.php';
    $id_docNomina = $db->insert_id;
    require $root . '/conta6/Ubicaciones/Nomina/Honorarios/actions/generarNominaHon_2agregarDetPercep.php';
    require $root . '/conta6/Ubicaciones/Nomina/Honorarios/actions/generarNominaHon_3agregarDetDeduc.php';
    require $root . '/conta6/Ubicaciones/Nomina/Honorarios/actions/generarNominaHon_4agregarDetTotales.php';

    $descripcion = "Se genero DocNomina: $id_docNomina Oficina: $aduana Anio: $anio Semana: $NUM_NOMINA Sueldo: $SALARIO_SEMANAL ISR: $ISR Total:$TOTAL";
    $clave = 'nomHonorarios';
    $folio = $id_docNomina;
    require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


    $system_callback['code'] = 1;
    $system_callback['data'] .=
    "<tr>
      <td>$id_empleado $nombre $apellidoP</td>
      <td>$SALARIO_SEMANAL</td>
      <td>$ISR</td>
      <td>$TOTAL</td>
      <td>$id_docNomina</td>
     </tr>";
    $system_callback['message'] = "Script called successfully but there are no rows to display.";






  }
  $system_callback['data'] .= "</table>";
  exit_script($system_callback);
}


?>

<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
require $root . '/Resources/PHP/actions/validarFormulario.php';

#http://localhost:88/conta6/Ubicaciones/Nomina/actions/generar_docNomina_nuevo.php?semana=1&idRegimen=02&empleado=24&anio=2020&tipo=O&descrip=Sueldos
$NUM_NOMINA = trim($_POST['semana']);
$id_regimen = trim($_POST['idRegimen']);
$id_empleado = trim($_POST['empleado']);
$anio = trim($_POST['anio']);
$fechaActual = date("Y-m-d H:i:s");
$tipoNomina = trim($_POST['tipo']);
$tipoDoc = trim($_POST['descrip']);
$descNomina = trim($_POST['descrip']);


$unidad = "ACT";
$descripcion = "Pago de nómina";
$DIAS_PAGAR = 7;
$TOTAL_PERCEPCIONES = 0;
$TOTAL_DEDUCCIONES = 0;
$TOTAL = 0;
$TOTAL_NETO = 0;
$ISR = 0;
$totalOtrosPagos = 0;

if( $id_regimen == '09' ){ #Honorarios
  $DIAS_PAGAR = 5;
}

require $root . '/Ubicaciones/Nomina/actions/consulta_datosEmpleado.php';
$ID_EMPLEADO_CURSOR = $row_datosEmpleado['pk_id_empleado'];
$id_empleado = $row_datosEmpleado['pk_id_empleado'];
$nombre = $row_datosEmpleado['s_nombre'];
$apellidoP = $row_datosEmpleado['s_apellidoP'];
$apellidoM = $row_datosEmpleado['s_apellidoM'];
$rfc = $row_datosEmpleado['s_RFC'];
$curp = $row_datosEmpleado['s_CURP'];
$noIMSS = $row_datosEmpleado['s_IMSS'];
$INFONAVIT = $row_datosEmpleado['s_INFONAVIT'];
$id_depto = $row_datosEmpleado['fk_id_depto'];
$cta_banco = $row_datosEmpleado['s_cta_banco'];
$id_banco = $row_datosEmpleado['fk_id_banco'];
$fechaContrato =  date_format(date_create($row_datosEmpleado['d_fechaContrato']),"Y-m-d");
$puesto = $row_datosEmpleado['s_puesto_actividad'];
$id_contrato = $row_datosEmpleado['fk_id_contrato'];
$id_jornada = $row_datosEmpleado['fk_id_jornada'];
$id_pago = $row_datosEmpleado['fk_id_pago'];
$id_riesgo = $row_datosEmpleado['fk_id_riesgo'];
$SALARIO_SEMANAL = $row_datosEmpleado['n_salario_semanal'];
$id_entfed = $row_datosEmpleado['s_id_entfed'];
$salario_mensual =  $row_datosEmpleado['n_salario_mensual'];
if( is_null($salario_mensual) ){ $salario_mensual = 0; }


$sql_SelectFECHA = "SELECT DISTINCT d_fechaInicio,d_fechaFinal,d_fechaPago,n_mesCorresponde
                     FROM conta_t_nom_captura
                     where fk_id_aduana = ? and fk_id_regimen = '$id_regimen' and n_anio = ? and n_semana = ?";
$stmtFECHA = $db->prepare($sql_SelectFECHA);
if (!($stmtFECHA)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmtFECHA->bind_param('sss',$aduana,$anio,$NUM_NOMINA);
if (!($stmtFECHA)) { die("Error during query prepare [$stmtFECHA->errno]: $stmtFECHA->error");	}
if (!($stmtFECHA->execute())) { die("Error during query prepare [$stmtFECHA->errno]: $stmtFECHA->error"); }
$rsltFECHA = $stmtFECHA->get_result();
$rowsFECHA = $rsltFECHA->num_rows;
if( $rowsFECHA > 0 ){
  $rowFECHA = $rsltFECHA->fetch_assoc();
  $FECHAINICIO = date_format(date_create($rowFECHA['d_fechaInicio']),"Y-m-d");
	$FECHAFINAL = date_format(date_create($rowFECHA['d_fechaFinal']),"Y-m-d");
	$fechaPago = date_format(date_create($rowFECHA['d_fechaPago']),"Y-m-d");
  $mesCorresponde = $rowFECHA['n_mesCorresponde'];
}

$aniosServicio = 0;
#antiguedad en semanas
$pANTIGUEDAD = calcularAntiguedad($fechaContrato,$FECHAFINAL);

if( $descNomina == "Finiquito" ){
		$DIAS_PAGAR = calcularAntiguedadDias($fechaContrato,$FECHAFINAL);
		$aniosServicio = calcularAntiguedadAnios($fechaContrato,$FECHAFINAL);
		if( $tipoNomina == "E" ){ $id_pago = '99'; }
}

$sql_deptoDesc = "SELECT * FROM conta_cs_departamentos where pk_id_depto = ?";
$stmt_deptoDesc = $db->prepare($sql_deptoDesc);
if (!($stmt_deptoDesc)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmt_deptoDesc->bind_param('s',$id_depto);
if (!($stmt_deptoDesc)) { die("Error during query prepare [$stmt_deptoDesc->errno]: $stmt_deptoDesc->error");	}
if (!($stmt_deptoDesc->execute())) { die("Error during query prepare [$stmt_deptoDesc->errno]: $stmt_deptoDesc->error"); }
$rslt_deptoDesc = $stmt_deptoDesc->get_result();
$row_deptoDesc = $rslt_deptoDesc->fetch_assoc();
$nom_depto = $row_deptoDesc['s_descripcion'];

if( $descNomina == "Honorarios" ){
  require $root . '/Ubicaciones/Nomina/Honorarios/actions/generarNominaHon_1agregarDocCaptura.php';
  $id_docNomina = $db->insert_id;
  require $root . '/Ubicaciones/Nomina/Honorarios/actions/generarNominaHon_4agregarDetTotales.php';
}

if( $descNomina == "Sueldos" || $descNomina == "Finiquito" ){
  require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_1agregarDocCaptura.php';
  $id_docNomina = $db->insert_id;
}

if( $descNomina == "Sueldos" ){
  require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_5agregarDetTotales.php';
}

if( $descNomina == "Finiquito" ){
  require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_5agregarDetTotales_finiquito.php';
}




$nombreCompleto = $nombre.' '.$apellidoP.' '.$apellidoM;
$descripcion = "Se genero DocNomina: $id_docNomina Oficina: $aduana Anio: $anio Semana: $NUM_NOMINA Empleado: $nombreCompleto";
$clave = 'nomHonorarios';
$folio = $id_docNomina;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';


$system_callback['code'] = 1;
$system_callback['data'] = "Generado correctamente".$id_docNomina;
$system_callback['message'] = "Script called successfully but there are no rows to display.";
exit_script($system_callback);
?>

<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $idDocNomina = trim($_POST['idDocNomina']);
  $fechaActual = date("Y-m-d H:i:s");


require $root . '/conta6/Ubicaciones/Nomina/actions/consultaDatosCFDI_docNomina_captura.php';
if( $total_consultaDatosCaptura > 0 ){
  $row_consultaDatosCaptura = $rslt_consultaDatosCaptura->fetch_assoc();

  $descNomina = $row_consultaDatosCaptura['s_descNomina'];
  $tipoNomina = $row_consultaDatosCaptura['s_tipoNomina'];
  $semana = $row_consultaDatosCaptura['n_semana'];
  $anio = $row_consultaDatosCaptura['n_anio'];
  $id_empleado = $row_consultaDatosCaptura['fk_id_empleado'];
  $nombre = $row_consultaDatosCaptura['s_nombre'];
  $apellidoP = $row_consultaDatosCaptura['s_apellidoP'];
  $apellidoM = $row_consultaDatosCaptura['s_apellidoM'];
  $nombreEmpleado = $nombre.' '.$apellidoP.' '.$apellidoM;
  $RFC = $row_consultaDatosCaptura['s_RFC'];
  $CURP = $row_consultaDatosCaptura['s_CURP'];
  $id_regimen = $row_consultaDatosCaptura['fk_id_regimen']; # 02 Sueldos, 09 Honorarios
  $Reg_Patronal = $row_consultaDatosCaptura['s_Reg_Patronal'];
  $estado_entFed = $row_consultaDatosCaptura['fk_c_estado_entFed'];
  $IMSS = $row_consultaDatosCaptura['s_IMSS'];
  $INFONAVIT = $row_consultaDatosCaptura['s_INFONAVIT'];
  $mesCorresponde = $row_consultaDatosCaptura['n_mesCorresponde'];
  $fechaPago = $row_consultaDatosCaptura['d_fechaPago'];
  $fechaInicio = $row_consultaDatosCaptura['d_fechaInicio'];
  $fechaFinal = $row_consultaDatosCaptura['d_fechaFinal'];
  $numDiasPagados = $row_consultaDatosCaptura['n_numDiasPagados'];
  $departamento = $row_consultaDatosCaptura['s_departamento'];
  $id_formapago = $row_consultaDatosCaptura['fk_id_formapago'];
  $metodoPago = $row_consultaDatosCaptura['fk_c_MetodoPago'];
  $CLABE = $row_consultaDatosCaptura['s_CLABE'];
  $id_banco = $row_consultaDatosCaptura['fk_id_banco'];
  $FechaInicioRelLaboral = $row_consultaDatosCaptura['d_FechaInicioRelLaboral'];
  $antiguedad = $row_consultaDatosCaptura['s_antiguedad'];
  $puesto = $row_consultaDatosCaptura['s_puesto_actividad'];
  $id_contrato = $row_consultaDatosCaptura['fk_id_contrato'];
  $id_jornada = $row_consultaDatosCaptura['fk_id_jornada'];
  $id_pago = $row_consultaDatosCaptura['pk_id_pago'];
  $UsoCFDI = $row_consultaDatosCaptura['fk_c_UsoCFDI'];
  $salarioBaseCotApor = $row_consultaDatosCaptura['n_salarioBaseCotApor'];
  $id_riesgo = $row_consultaDatosCaptura['fk_id_riesgo'];
  $salarioDiarioIntegrado = $row_consultaDatosCaptura['n_salarioDiarioIntegrado'];
  $cantidad = $row_consultaDatosCaptura['n_cantidad'];
  $unidad = $row_consultaDatosCaptura['s_unidad'];
  $moneda = $row_consultaDatosCaptura['s_moneda'];
  $ClaveProdServ = $row_consultaDatosCaptura['s_ClaveProdServ'];
  $descripcion = $row_consultaDatosCaptura['s_descripcion'];
  $valor_unitario = $row_consultaDatosCaptura['n_valor_unitario'];
  $importe = $row_consultaDatosCaptura['n_importe'];
  $tipoDeComprobante = $row_consultaDatosCaptura['s_tipoDeComprobante']; #N=nomina
  $id_aduana = $row_consultaDatosCaptura['fk_id_aduana'];

  $NUM_NOMINA = $semana;
  $FECHAINICIO = $fechaInicio;
  $FECHAFINAL = $fechaFinal;
  $DIAS_PAGAR = $numDiasPagados;
  $SALARIO_SEMANAL = $salarioBaseCotApor;
  $TOTAL = $valor_unitario;
  $ANTIGUEDAD_SEMANAS = $antiguedad;
  $pANTIGUEDAD = $antiguedad;
  $fechaContrato = $FechaInicioRelLaboral;
  $FECHA_CONTRATO = $FechaInicioRelLaboral;
  $rfc = $RFC;
  $curp = $CURP;
  $cta_banco = $CLABE;
  $nom_depto = $departamento;
  $id_entfed = $estado_entFed;
  $regPatronalCIA = $Reg_Patronal;
  $noIMSS = $IMSS;
  $cve_INFONAVIT = $INFONAVIT;
  $ID_EMPLEADO_CURSOR = $id_empleado;
  $puesto_actividad = $puesto;

}
if( $id_regimen == "09" ){
  require $root . '/conta6/Ubicaciones/Nomina/Honorarios/actions/generarNominaHon_1agregarDocCaptura.php';
  $id_docNomina = $db->insert_id;
  $clave = 'nomHonorarios';
}

if( $id_regimen == "02" ){
  require $root . '/conta6/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_1agregarDocCaptura.php';
  $id_docNomina = $db->insert_id;
  $clave = 'nomSueldos';
}




$query_detalleDocNomina = "INSERT INTO conta_t_nom_captura_det(
        fk_id_docNomina, s_tipoElemento, fk_claveSAT, fk_id_cuenta, s_concepto, n_importeGravado, n_importeExento, s_anio, n_remanenteSalFav,n_dias_incapacidad,
        s_tipo_incapacidad,n_dias_incapacidad_pgo,n_dias_incapacidad_dscto, n_dias_vacaciones, n_PprimVacE, n_PprimVacG, n_dias_faltas,n_dias_pagar, s_tipoHoras,n_dias_horasExtra,
        n_horasExtra, n_importePagado, n_base, n_porcentaje, n_descuento, n_numAniosServicio, n_ultimoSueldoMensOrd, n_ingresoAcumulable, n_ingresoNoAcumulable, n_totalPagado, n_totalPercepciones,
        n_totalDeducciones, n_total, n_totalNeto, n_ordenReporte, s_clasificacion)

        SELECT $id_docNomina, s_tipoElemento, fk_claveSAT, fk_id_cuenta, s_concepto, n_importeGravado, n_importeExento, s_anio, n_remanenteSalFav,n_dias_incapacidad,
        s_tipo_incapacidad,n_dias_incapacidad_pgo,n_dias_incapacidad_dscto, n_dias_vacaciones, n_PprimVacE, n_PprimVacG, n_dias_faltas,n_dias_pagar, s_tipoHoras,n_dias_horasExtra,
        n_horasExtra, n_importePagado, n_base, n_porcentaje, n_descuento, n_numAniosServicio, n_ultimoSueldoMensOrd, n_ingresoAcumulable, n_ingresoNoAcumulable, n_totalPagado, n_totalPercepciones,
        n_totalDeducciones, n_total, n_totalNeto, n_ordenReporte, s_clasificacion
        FROM conta_t_nom_captura_det
        WHERE fk_id_docNomina = ?";

  $stmt_detalleDocNomina = $db->prepare($query_detalleDocNomina);
  if (!($stmt_detalleDocNomina)) {
    die("Error during query prepare detalleDocNomina [$db->errno]: $db->error");
  }
  $stmt_detalleDocNomina->bind_param('s',$idDocNomina);
  if (!($stmt_detalleDocNomina)) {
    die("Error during variables binding detalleDocNomina [$stmt_detalleDocNomina->errno]: $stmt_detalleDocNomina->error");
  }
  if (!($stmt_detalleDocNomina->execute())) {
    die("Error during query execute detalleDocNomina [$stmt_detalleDocNomina->errno]: $stmt_detalleDocNomina->error");
  }





  $query_relacionada = "INSERT INTO conta_t_nom_cfdi_relacionada( fk_id_docNomina, fk_id_nomina_relacionada, s_UUID_relacionada, n_ordenRegistro )
                        SELECT $id_docNomina, pk_id_nomina, s_UUID, 1
                        from conta_t_nom_cfdi
                        where fk_id_docNomina = ?";

    $stmt_relacionada = $db->prepare($query_relacionada);
    if (!($stmt_relacionada)) {
      die("Error during query prepare relacionada [$db->errno]: $db->error");
    }
    $stmt_relacionada->bind_param('s',$idDocNomina );
    if (!($stmt_relacionada)) {
      die("Error during variables binding relacionada [$stmt_relacionada->errno]: $stmt_relacionada->error");
    }
    if (!($stmt_relacionada->execute())) {
      die("Error during query execute relacionada [$stmt_relacionada->errno]: $stmt_relacionada->error");
    }



  $descripcion = "Se genera Documento: $id_docNomina que sustituye al Documento: $idDocNomina";
  $folio = $id_docNomina;
  require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);

?>

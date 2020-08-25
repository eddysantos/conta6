<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
require $root . '/Resources/PHP/actions/validarFormulario.php';


$anio = $_POST['anio_nomsig'];
$NUM_NOMINA = $_POST['num_nomsig'];
$FECHAINICIO = $_POST['fi_nomsig'];
$FECHAFINAL = $_POST['ff_nomsig'];
$fechaPago = $_POST['fp_nomsig'];
$pagVales = $_POST['lstValesDespensa'];
$pagPremAsist = $_POST['lstPremioAsistencia'];
$mesCorresponde = $_POST['mesCorresponde'];


/*
$anio = 2020;
$NUM_NOMINA = 1;
$FECHAINICIO = '2019-12-30';
$FECHAFINAL = '2020-01-05';
$fechaPago = '2020-01-05';
$pagVales = 'S';
$pagPremAsist = 'S';
$mesCorresponde = 1;
*/

$id_regimen = '02';
$tipoNomina = "O"; #NOMINA ORDINARIA
$unidad = "ACT";
$DIAS_PAGAR = 7;
$descNomina = 'Sueldos'; #Sueldos_Salrios
$descConcepto = 'Pago de nómina'; #default en BD
$METODODEPAGO = 'PUE'; #default en BD
$usoCFDI = 'P01'; #default BD
$id_pago = 99; #default BD

# DATOS INFORMATIVOS
$query_inf = "SELECT d_fechaInicio,n_diasPagar,n_diasTrabajados,n_salarioMinimo,n_primaVacaciones,n_subsidio
              FROM conta_cs_imss WHERE s_nombreTabla = 'infoGral' AND fk_id_aduana = ? ";

$stmt_inf = $db->prepare($query_inf);
if (!($stmt_inf)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_inf->bind_param('s',$aduana);

if (!($stmt_inf)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_inf->errno]: $stmt_inf->error";
  exit_script($system_callback);
}

if (!($stmt_inf->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_inf->errno]: $stmt_inf->error";
  exit_script($system_callback);
}

  $rslt_inf = $stmt_inf->get_result();
  $row_inf = $rslt_inf->fetch_assoc();
  $FIA = $row_inf['d_fechaInicio'];
	$SALARIO_MINIMO_INFO = $row_inf['n_salarioMinimo'];
	$DIAS_PAGAR_INFO  = $row_inf['n_diasPagar'];
	$DIAS_TRABAJADOS_INFO  = $row_inf['n_diasTrabajados'];
	$FACTOR_PRIMA = $row_inf['n_primaVacaciones'];
	$SUBSIDIO_INFO = $row_inf['n_subsidio'];
  $anioFI = date_format(date_create($FECHAINICIO),"Y");
	$ultimaSemAnio = date_format(date_create($anioFI."-12-28"),"W");


  #QUERY DE EMPLEADOS
  $query_empleados = "SELECT * FROM conta_t_nom_empleados
                      WHERE s_activo = 'S' and s_pagar = 'S' and fk_id_aduana = ? and fk_id_regimen = ?
                      order by pk_id_empleado";

  $stmt_empleados = $db->prepare($query_empleados);
  if (!($stmt_empleados)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmt_empleados->bind_param('ss',$aduana,$id_regimen);

  if (!($stmt_empleados)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_empleados->errno]: $stmt_empleados->error";
    exit_script($system_callback);
  }

  if (!($stmt_empleados->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_empleados->errno]: $stmt_empleados->error";
    exit_script($system_callback);
  }

  $rslt_empleados = $stmt_empleados->get_result();
  // TODO: eliminar
  // $system_callback['data'] =
  // "<table>
  //   <tr>
  //     <td>EMPLEADO</td>
  //     <td>CAPTURA</td>
  //   </tr>";

  while( $row_empleados = $rslt_empleados->fetch_assoc() ){
    $ID_EMPLEADO_CURSOR = $row_empleados['pk_id_empleado'];
    $nombre = utf8_encode($row_empleados['s_nombre']);
    $apellidoP = utf8_encode($row_empleados['s_apellidoP']);
    $apellidoM = utf8_encode($row_empleados['s_apellidoM']);
    $rfc = $row_empleados['s_RFC'];
    $curp = $row_empleados['s_CURP'];
    $id_banco = $row_empleados['fk_id_banco'];
    $cta_banco = $row_empleados['s_cta_banco'];
    $puesto_actividad = utf8_encode($row_empleados['s_puesto_actividad']);
    $id_contrato = $row_empleados['fk_id_contrato'];
    $id_jornada = $row_empleados['fk_id_jornada'];
    $cve_INFONAVIT = $row_empleados['s_INFONAVIT'];
    $id_depto = $row_empleados['fk_id_depto'];
    $id_entfed = $row_empleados['s_id_entfed'];
    $id_riesgo = $row_empleados['fk_id_riesgo'];

    $oRst_depto = mysqli_fetch_array(mysqli_query($db,"SELECT s_descripcion FROM conta_cs_departamentos WHERE pk_id_depto = '$id_depto'"));
    $departamento = utf8_encode($oRst_depto['s_descripcion']);
  	$SALARIO_MENSUAL = $row_empleados['n_salario_mensual'];
  	$SALARIO = $row_empleados['n_salario_semanal'];
  	$DIAS_VACACIONES  = $row_empleados['n_vacaciones_dias'];
  	if( is_null($DIAS_VACACIONES) ){ $DIAS_VACACIONES = 0; }
  	$INCAPACIDAD_PGO = $row_empleados['s_incapacidad_pgo'];
  	$DIAS_INCAPACIDAD  = $row_empleados['n_incapacidad_dias'];
  	if( is_null($DIAS_INCAPACIDAD) or $DIAS_INCAPACIDAD == 0 ){ $DIAS_INCAPACIDAD_DESCTO = 0; }
  	$TIPO_INCAPACIDAD  = $row_empleados['s_incapacidad_tipo'];
  	$DIAS_FALTAS = $row_empleados['n_faltas_dias'];
  	$VACACIONES_primaPGO = $row_empleados['s_vacPrim_Pgo'];
  	$VACACIONES_primaDias = $row_empleados['n_vacPrim_dias'];
  	$VALIDA_PCOMPENSA = $row_empleados['s_puntualidad_pgo'];
  	$GRATIF3 = $row_empleados['n_compensacion'];
  	$FECHA_CONTRATO = date_format(date_create($row_empleados['d_fechaContrato']),"Y-m-d");
  	$FACTOR_INTEGRADO_ANO = $row_empleados['n_factor_integracion'];
  	$SDI = $row_empleados['n_salario_integrado'];
  	$VALIDA_DESPENSA = $row_empleados['s_valesDespensa_pgo'];
  	$diasVales = $row_empleados['n_valesDespensa_dias'];
  	$hrsExtra_dobles = $row_empleados['n_hrsExtra_dobles'];
  	$hrsExtra_triples = $row_empleados['n_hrsExtra_triples'];
  	$hrsExtra_dobles_dias = $row_empleados['n_hrsExtra_dobles_dias'];
  	$hrsExtra_triples_dias = $row_empleados['n_hrsExtra_triples_dias'];
  	$ASISTENCIA_PGO = $row_empleados['s_asistencia_pgo'];
  	$ASISTENCIA_DIAS = $row_empleados['n_asistencia_dias'];
  	$SUBSIDIO_PGO = $row_empleados['s_subsidioPago'];
  	$ctaDeudorEmpleado = $row_empleados['s_prestamoCta'];
  	if( is_null($ctaDeudorEmpleado) or $ctaDeudorEmpleado == 0 ){
  		$ctaDeudorEmpleado = '0115-00001';
  	}
    if( $DIAS_INCAPACIDAD <= 3 ){
      if( $INCAPACIDAD_PGO == 'N' ){ $DIAS_INCAPACIDAD_DESCTO = $DIAS_INCAPACIDAD; }
      if( $INCAPACIDAD_PGO == 'S' ){ $DIAS_INCAPACIDAD_DESCTO = 0; }
  	}
    if( $DIAS_INCAPACIDAD > 3 ){
      if( $INCAPACIDAD_PGO == 'N' ){ $DIAS_INCAPACIDAD_DESCTO = $DIAS_INCAPACIDAD; }
      if( $INCAPACIDAD_PGO == 'S' ){ $DIAS_INCAPACIDAD_DESCTO = $DIAS_INCAPACIDAD - 3; }
  	}
    $DIAS_INCAPACIDAD_PGO = $DIAS_INCAPACIDAD - $DIAS_INCAPACIDAD_DESCTO;
    if( is_null($DIAS_FALTAS) ){ $DIAS_FALTAS = 0; }
  	if( $DIAS_FALTAS > 0 ){
  		$DIASfaltas = $DIAS_PAGAR_INFO / $DIAS_TRABAJADOS_INFO;
  		$DIAS_FALTAS = $DIASfaltas * $DIAS_FALTAS;
  	}
  	if( $DIAS_FALTAS > 7 ){ $DIAS_FALTAS = 7; }
  	$DIAS_PAGAR = cortarXdecimales(floatval( $DIAS_PAGAR_INFO - ($DIAS_VACACIONES + $DIAS_FALTAS + $DIAS_INCAPACIDAD_DESCTO)),3);
  	if( $DIAS_PAGAR > 0 ){
  		$DIAS_PAGAR = $DIAS_PAGAR;
  	}else{ $DIAS_PAGAR = 0; }
  	$SALARIO_SEMANAL_CD = $SALARIO * $DIAS_PAGAR;
  	$PVACACIONES = $DIAS_VACACIONES * $SALARIO;
  	$PRIMA_VACIONES = 0;
  	$FACTOR_PRIMA_EG = 0;
  	$PRIMA_VACIONES_E = 0;
  	$PRIMA_VACIONES_G = 0;

    if( $DIAS_VACACIONES > 0 and $VACACIONES_primaPGO == 'S' and $VACACIONES_primaDias > 0 ){
      $PRIMA_VACIONES = $PVACACIONES * $FACTOR_PRIMA;
      $FACTOR_PRIMA_EG = $VACACIONES_primaDias * $SALARIO_MINIMO_INFO;
      if( $PRIMA_VACIONES < $FACTOR_PRIMA_EG ){
        $PRIMA_VACIONES_E = $PRIMA_VACIONES;
        $PRIMA_VACIONES_G = 0;
      }
      if( $PRIMA_VACIONES > $FACTOR_PRIMA_EG ){
        $PRIMA_VACIONES_E = $FACTOR_PRIMA_EG;
        $PRIMA_VACIONES_G = $PRIMA_VACIONES - $FACTOR_PRIMA_EG;
      }
    }

    $diasTrabajadosEmpleado = 0;
    $diasTrabajadosEmpleado = $DIAS_PAGAR_INFO - $DIAS_FALTAS - $DIAS_VACACIONES;
    if( $diasTrabajadosEmpleado < 0 or is_null($diasTrabajadosEmpleado) ){ $diasTrabajadosEmpleado = 0; }
    $SALARIO_SEMANAL = $SALARIO * $DIAS_PAGAR_INFO;
    $PCOMPENSA = 0;
    if( $VALIDA_PCOMPENSA == 'S' and $diasTrabajadosEmpleado > 0 ){
      $PCOMPENSA = cortarXdecimales(floatval(( $diasTrabajadosEmpleado * $SALARIO ) * 0.10),2);
    }
    $PGRATIFIACION = $PVACACIONES + $PRIMA_VACIONES + $PCOMPENSA + $GRATIF3;
    $FONDO = 0;
    $ANTIGUEDAD_SEMANAS = calcularAntiguedad($FECHA_CONTRATO,$FECHAFINAL);
  	$VALES_DESPENSA = 0;
  	$faltasPeriodo = 0;
  	$diasCalculoVales = 0;

    if( $pagVales == 'S' ){
      if( $VALIDA_DESPENSA == 'S' ){
        $faltasPeriodo = 0;
        $diasCalculoVales = $diasVales - $faltasPeriodo;
        $VALES_DESPENSA = $SALARIO *  $diasCalculoVales;
  			$VALES_DESPENSA = $VALES_DESPENSA * 0.10;
  			$VALES_DESPENSA = $VALES_DESPENSA;
	    }
  	}
    $PGRATI_EXCENTOS = $FONDO + $VALES_DESPENSA;
    $hrsExtra_dobles_pgo = 0;
    $hrsExtra_triples_pgo = 0;
    $PHORASdobles_ISPT = 0;
    $PHORAStriples_ISPT = 0;
    $PHORAS_ISPT = 0;
    if( $hrsExtra_dobles > 0 ){
      $hrsExtra_dobles_pgo = $hrsExtra_dobles * (($SALARIO / 8)* 2);
      $hrsExtra_dobles_pgoG = $hrsExtra_dobles_pgo / 2;
      $hrsExtra_dobles_pgoE = $hrsExtra_dobles_pgo / 2;
      $limExento = $SALARIO_MINIMO_INFO * 5;
      if( $limGravado > $hrsExtra_dobles_pgoE ){
        $resto = $hrsExtra_dobles_pgoE - $limGravado;
        $hrsExtra_dobles_pgoE = $limGravado;
        $hrsExtra_dobles_pgoG = $hrsExtra_dobles_pgoG + $resto;
      }
      $PHORASdobles_ISPT =  $hrsExtra_dobles_pgoG;
    }
    if( $hrsExtra_triples > 0 ){
      $hrsExtra_triples_pgo = $hrsExtra_triples * (($SALARIO / 8)* 3);
      $PHORAStriples_ISPT = $hrsExtra_triples_pgo;
    }
    $PHORAS_ISPT = $PHORASdobles_ISPT + $PHORAStriples_ISPT;
    $PREMIO_ASISTENCIA = 0;

    if( $pagPremAsist == 'S' ){
      if( $ASISTENCIA_PGO == 'S' ){
        $PREMIO_ASISTENCIA = cortarXdecimales(floatval($SALARIO * 30.40),2);
        $PREMIO_ASISTENCIA = cortarXdecimales(floatval($PREMIO_ASISTENCIA * 0.10),2);
      }
    }
    $AYUDA_RENTA_PGO = $row_empleados['s_ayudaRenta_pgo'];
    $AYUDA_RENTA = 0;
    if( $AYUDA_RENTA_PGO == 'S' ){
      $AYUDA_RENTA = $row_empleados['n_ayudaRenta'];
    }
    $CREDITO = 0;
    $TOTAL_GRATIFICACIONES = $PCOMPENSA + $PVACACIONES + $PRIMA_VACIONES_G + $GRATIF3 + $PREMIO_ASISTENCIA + $PHORAS_ISPT + $AYUDA_RENTA;
    $TOTAL_GRATIFICACIONESgravadas = $SALARIO_SEMANAL_CD + $PCOMPENSA + $PVACACIONES + $PRIMA_VACIONES_G + $GRATIF3 + $PREMIO_ASISTENCIA + $PHORAS_ISPT + $AYUDA_RENTA;
    $CREDITO_ISPT_BASE = $TOTAL_GRATIFICACIONESgravadas;
  	if( $SALARIO <= $SALARIO_MINIMO_INFO ){
			$ISPT = 0;
			$oRst_T80A = mysqli_fetch_array(mysqli_query($db,"SELECT n_cuota_b
                   FROM conta_cs_imss
                   WHERE s_nombreTabla = 'art80_b' AND $CREDITO_ISPT_BASE >= n_inferior_b and $CREDITO_ISPT_BASE <= n_superior_b"));
			$CREDITO = $oRst_T80A['n_cuota_b'];
  	}


    #--********** SUBSIDIO AL EMPLEO **********
  	if( $SALARIO > $SALARIO_MINIMO_INFO ){
      $oRst_T80A = mysqli_fetch_array(mysqli_query($db,"SELECT n_porcentaje,n_cuota,n_inferior
                    from conta_cs_imss
                    WHERE s_nombreTabla = 'art80_a' AND $CREDITO_ISPT_BASE >= n_inferior and $CREDITO_ISPT_BASE <= n_superior"));
      $PORCENTA_2 = $oRst_T80A['n_porcentaje'];
      $INFERIROR_80A = $oRst_T80A['n_inferior'];
      $cuotaT80A = $oRst_T80A['n_cuota'];

      $oRst_T80 = mysqli_fetch_array(mysqli_query($db,"SELECT n_porcentaje,n_cuota,n_inferior
                   from conta_cs_imss
                   WHERE s_nombreTabla = 'art80' AND $CREDITO_ISPT_BASE >= n_inferior and $CREDITO_ISPT_BASE <= n_superior"));
      $INFERIROR_80 = $oRst_T80['n_inferior'];
      $PORCENTA_1 = $oRst_T80['n_porcentaje'];
      $cuotaT80 = $oRst_T80['n_cuota'];

      if( is_null($PORCENTA_1) ){ $PORCENTA_1 = 0; }
      if( $PORCENTA_1 > 0 ){ $PORCENTA_1 = cortarXdecimales(floatval($PORCENTA_1),2); }
      $MARGINAL_80 = cortarXdecimales(floatval(( $CREDITO_ISPT_BASE - $INFERIROR_80 ) * $PORCENTA_1 / 100 ),2);
      $MARGINAL_80A = cortarXdecimales(floatval(( $CREDITO_ISPT_BASE - $INFERIROR_80A ) * $PORCENTA_1 / 100 ),2);
      $oRst_T80B = mysqli_fetch_array(mysqli_query($db,"SELECT n_cuota_b
                    FROM conta_cs_imss
                    WHERE s_nombreTabla = 'art80_b' AND $CREDITO_ISPT_BASE >= n_inferior_b and $CREDITO_ISPT_BASE <= n_superior_b"));
      $CREDITO = $oRst_T80B['n_cuota_b'];
      if( is_null($PORCENTA_2) ){ $PORCENTA_2 = 0; }
      if( $PORCENTA_2 > 0 ){ $PORCENTA_2 = $PORCENTA_2 / 100; }
      $impuestoTotal = $MARGINAL_80 + $cuotaT80;
      $SUBSIDIO = 0;

      if( $impuestoTotal > $CREDITO ){
        $ISPT = $impuestoTotal - $CREDITO;
        $SUBSIDIO = 0;
      } else {
        $ISPT = 0;
        $SUBSIDIO = $CREDITO - $impuestoTotal;
      }
      if( $SUBSIDIO_PGO == 'N' ){ $SUBSIDIO = 0; }
    }
    $PRESTAMO = 0;
  	$PRESTAMO_PGO = $row_empleados['s_prestamo_pgo'];
    if ( $PRESTAMO_PGO == 'S' ){
      $PRESTAMO = $row_empleados['n_prestamo'];
    }
    $DIAS_CALCULO = cortarXdecimales(floatval($DIAS_PAGAR_INFO - $DIAS_INCAPACIDAD_DESCTO - $DIAS_FALTAS),3);
    $SDIcalculo = $SDI * $DIAS_CALCULO;
    if( $SALARIO >= $SALARIO_MINIMO_INFO ){
      $SMGI = $SALARIO_MINIMO_INFO;
      if( $SDI > $SMGI ){
        $sql_NOM_IMSS = mysqli_query($db,"SELECT n_ramo,n_baseSalarial as BaseSalarial,n_topeSalarial,n_trabajador as Trabajador from conta_cs_imss where s_nombreTabla = 'ramoSeguro'");

    		$PRESTA_DINERO = 0;
    		$ESPECIE_ADICIONAL = 0;
    		$PENSIONADOS = 0;
    		$INVALIDEZ_VIDA = 0;
    		$CESANTIA_VEJEZ = 0;
    		$DESCUENTO_PRESTAMO = 0;

    		while( $oRst_NOM_IMSS = mysqli_fetch_array($sql_NOM_IMSS) ){
  			  $Ramo = $oRst_NOM_IMSS['n_ramo'];
    			$BaseSalarial = $oRst_NOM_IMSS['n_baseSalarial'];
    			$TopeSalarial = $oRst_NOM_IMSS['n_topeSalarial'];
    			$Trabajador = $oRst_NOM_IMSS['n_trabajador'];

    			$trabaja = $Trabajador / 100;

    			if( $DIAS_CALCULO <> 0 ){
    				if( $Ramo == 1 ){
    					$PRESTA_DINERO = cortarXdecimales(floatval($SDIcalculo * $trabaja),2);
    				}
    				if( $Ramo == 3 ){
              $ST = cortarXdecimales(floatval($SDI - ($SALARIO_MINIMO_INFO * 3)),2);
              if( $ST > 0 ){
                $STcalculo = $ST * $trabaja;
    						$ESPECIE_ADICIONAL = cortarXdecimales(floatval($STcalculo * $DIAS_CALCULO),2);
              }  else {
                $ESPECIE_ADICIONAL = 0;
              }
            }
            if( $Ramo == 4 ){
    					$PENSIONADOS = cortarXdecimales(floatval($SDIcalculo * $trabaja),2);
    				}
    				if( $Ramo == 5 ){
    					$INVALIDEZ_VIDA = cortarXdecimales(floatval($SDIcalculo * $trabaja),2);
    				}
    				if( $Ramo == 7 ){
    					$CESANTIA_VEJEZ = cortarXdecimales(floatval($SDIcalculo * $trabaja),2);
  				  }
          }else{
            if( $Ramo == 1 ){ $PRESTA_DINERO = 0; }
		        if( $Ramo == 3 ){ $ESPECIE_ADICIONAL = 0; }
		        if( $Ramo == 4 ){ $PENSIONADOS = 0; }
		        if( $Ramo == 5 ){ $INVALIDEZ_VIDA = 0; }
		        if( $Ramo == 7 ){ $CESANTIA_VEJEZ = 0; }
    		  }
          $IMSS = cortarXdecimales(floatval($PRESTA_DINERO + $ESPECIE_ADICIONAL + $PENSIONADOS + $INVALIDEZ_VIDA + $CESANTIA_VEJEZ),2);
          if( $IMSS < 0 or is_null($IMSS) ){
    				$IMSS = 0;
    			}
        }
      }#while

      if( $SDI < $SMGI ){ $IMSS = 0; }
    }

    $INFONAVIT = $row_empleados['n_desc_infonavit'];
  	$DFONDO = $FONDO * 2;
  	$DESCUENTO_1 = $row_empleados['n_desc_descuentos'];
  	$DESCUENTO_PRESTAMO = $row_empleados['n_desc_prestamo'];
  	$DESC_RENTA_PGO = $row_empleados['s_desc_renta_pgo'];
  	$DESC_RENTA = 0;
  	if( $DESC_RENTA_PGO == 'S' ){ $DESC_RENTA = $row_empleados['n_desc_renta']; }
  	$DESC_FONACOT = $row_empleados['n_desc_fonacot'];

  	$TOTAL_PERCEPCIONES = cortarXdecimales(floatval($SALARIO_SEMANAL_CD + $PVACACIONES + $PRIMA_VACIONES + $PCOMPENSA + $FONDO + $VALES_DESPENSA + $GRATIF3 + $hrsExtra_dobles_pgo + $hrsExtra_triples_pgo + $PREMIO_ASISTENCIA + $PRESTAMO + $AYUDA_RENTA),2);
  	$DESC_PENSIONALIMEN_PGO = $row_empleados['s_desc_pensionAlim_pago'];
  	$DESC_PENSIONALIMEN = 0;
  	$DESC_PENSIONALIMEN_PORCENT = 0;
  	$DESC_PENSIONALIMEN_OTORGADO = '';
  	$DESC_PENSIONALIMEN_ENTREGADO = '';
  	if( $DESC_PENSIONALIMEN_PGO = 'S' ){
  		$DESC_PENSIONALIMEN_OTORGADO = $row_empleados['s_desc_pensionAlim_otorgado'];
  		$DESC_PENSIONALIMEN_ENTREGADO = $row_empleados['s_desc_pensionAlim_entregado'];
  		$DESC_PENSIONALIMEN_PORCENT = $row_empleados['n_desc_pensionAlim_porcent'];

  		$BASE = $TOTAL_PERCEPCIONES - ($ISPT + $IMSS + $INFONAVIT);
  		$DESC_PENSIONALIMEN = $BASE * $DESC_PENSIONALIMEN_PORCENT;
  	}
  	$TOTAL_DEDUCCIONES = $ISPT + $IMSS + $INFONAVIT + $DFONDO + $DESCUENTO_1 + $DESCUENTO_PRESTAMO + $DESC_RENTA + $DESC_FONACOT + $DESC_PENSIONALIMEN;
  	$TOTAL = ($TOTAL_PERCEPCIONES + $SUBSIDIO) - $TOTAL_DEDUCCIONES;
    $TOTAL_NETO = cortarXdecimales(floatval($TOTAL - $VALES_DESPENSA),2);
    $id_folio = 'docNomina';
  	include ("generarFolio.php");
  	$id_docNomina = $nFolio;
    $noIMSS = $row_empleados['s_IMSS'];
    $descConcepto = 'Pago de nómina';
    if( $DIAS_PAGAR <= 0 ){ $DIAS_PAGAR = 0.001; }
    if( $SALARIO_SEMANAL_CD <= 0 ){ $salarioBaseCotApor = $SALARIO * $DIAS_PAGAR_INFO; }else{ $salarioBaseCotApor = $SALARIO_SEMANAL_CD; }
    require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_1agregarDocCaptura.php';
    $id_docNomina = $db->insert_id;

    require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_2agregarDetPercep.php';
    require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_3agregarDetOtrosPagos.php';
    require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_4agregarDetDeduc.php';
    require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_5agregarDetTotales.php';

    $descripcion = "Se genero DocNomina: $id_docNomina Oficina: $aduana Anio: $anio Semana: $NUM_NOMINA";
    $clave = 'nomSueldos';
    $folio = $id_docNomina;
    require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

    // TODO: eliminar
    // $system_callback['data'] .=
    // "<tr>
    //   <td>$id_empleado $nombre $apellidoP</td>
    //   <td>$id_docNomina</td>
    //  </tr>";
  }

  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);

?>

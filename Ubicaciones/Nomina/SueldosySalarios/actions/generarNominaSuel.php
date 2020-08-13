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

  #echo '-- DATOS INFORMATIVOS'; #echo "<br>";
  #echo 'INF SALARIO MINIMO $SALARIO_MINIMO_INFO'; #echo "<br>";
  #echo $SALARIO_MINIMO_INFO; #echo "<br>";


  #echo 'INF DIAS PAGAR $DIAS_PAGAR_INFO'; #echo "<br>";
  #echo $DIAS_PAGAR_INFO; #echo "<br>";

  #echo 'INF DIAS TRABAJADOS $DIAS_TRABAJADOS_INFO'; #echo "<br>";
  #echo $DIAS_TRABAJADOS_INFO; #echo "<br>";

  #echo 'INF PRIMA VACACIONAL $FACTOR_PRIMA'; #echo "<br>";
  #echo $FACTOR_PRIMA; #echo "<br>";

  #echo 'INF SUBSIDIO $SUBSIDIO_INFO'; #echo "<br>";
  #echo $SUBSIDIO_INFO; #echo "<br>";

  #echo '-- ULTIMA NOMINA Y FECHA'; #echo "<br>";
  #echo $NUM_NOMINA; #echo "<br>";
  #echo $FECHAINICIO; #echo "<br>";
  #echo $FECHAFINAL; #echo "<br>";

  $anioFI = date_format(date_create($FECHAINICIO),"Y");
	$ultimaSemAnio = date_format(date_create($anioFI."-12-28"),"W");

  #echo '-- NOMINA SIGUIENTE'; #echo "<br>";
  #echo $NUM_NOMINA; #echo "<br>";
  #echo $FECHAINICIO; #echo "<br>";
  #echo $FECHAFINAL; #echo "<br>";

  #EMPLEADOS
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
  $system_callback['data'] =
  "<table>
    <tr>
      <td>EMPLEADO</td>
      <td>CAPTURA</td>
    </tr>";

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

    $oRst_depto = mysqli_fetch_array(mysqli_query($db,"select s_descripcion from conta_cs_departamentos where pk_id_depto = '$id_depto'"));
    $departamento = utf8_encode($oRst_depto['s_descripcion']);



    #echo '***********************************************************************************************************************'; #echo "<br>";
    #echo '** ID_EMPLEADO **'; #echo "<br>";
    #echo '***********************************************************************************************************************'; #echo "<br>";
    #echo $ID_EMPLEADO_CURSOR." ".$apellidoP." ".$apellidoM; #echo "<br>";

    #--********** SALARIO MENSUAL **********
  	$SALARIO_MENSUAL = $row_empleados['n_salario_mensual'];
   	#--********** SALARIO DIARIO **********
  	$SALARIO = $row_empleados['n_salario_semanal'];
  	#--********** DIAS DE VACACIONES **********
  	$DIAS_VACACIONES  = $row_empleados['n_vacaciones_dias'];
  	if( is_null($DIAS_VACACIONES) ){ $DIAS_VACACIONES = 0; }
  	#--********** PAGAR INCAPACIDAD ********
  	$INCAPACIDAD_PGO = $row_empleados['s_incapacidad_pgo'];
  	#--********** DIAS DE INCAPACIDAD / motivo de incapacidad **********
  	$DIAS_INCAPACIDAD  = $row_empleados['n_incapacidad_dias'];
  	if( is_null($DIAS_INCAPACIDAD) or $DIAS_INCAPACIDAD == 0 ){ $DIAS_INCAPACIDAD_DESCTO = 0; }
  	$TIPO_INCAPACIDAD  = $row_empleados['s_incapacidad_tipo'];
  	#--********** FALTAS **********
  	$DIAS_FALTAS = $row_empleados['n_faltas_dias'];
  	#--********** PAGAR PRIMA VACACIONAL **********
  	$VACACIONES_primaPGO = $row_empleados['s_vacPrim_Pgo'];
  	#--********** DIAS PRIMA VACACIONAL **********
  	$VACACIONES_primaDias = $row_empleados['n_vacPrim_dias'];
  	#--********** PAGAR PREMIO DE PUNTUALIDAD **********
  	$VALIDA_PCOMPENSA = $row_empleados['s_puntualidad_pgo'];
  	#--********** COMPENSACION **********
  	$GRATIF3 = $row_empleados['n_compensacion'];
  	#--********** FECHA CONTRATO **********
  	$FECHA_CONTRATO = date_format(date_create($row_empleados['d_fechaContrato']),"Y-m-d");
  	#--********* FACTOR INTEGRADO POR ANIO *********
  		#--SELECT $FACTOR_INTEGRADO_ANO = Integrado from TBL_NOM_INTEGRADO where ano = $ANTIGUEDAD_SEMANAS
  	$FACTOR_INTEGRADO_ANO = $row_empleados['n_factor_integracion'];
  	#--********* SALARIO DIARIO INTEGRADO *********
  		#--SELECT $SDI = $SALARIO *  $FACTOR_INTEGRADO_ANO
  	$SDI = $row_empleados['n_salario_integrado'];
  	#--********* VALES DE DESPENSA *********
  	$VALIDA_DESPENSA = $row_empleados['s_valesDespensa_pgo'];
  	$diasVales = $row_empleados['n_valesDespensa_dias'];
  	#--********* HORAS EXTRAS *********
  	$hrsExtra_dobles = $row_empleados['n_hrsExtra_dobles'];
  	$hrsExtra_triples = $row_empleados['n_hrsExtra_triples'];
  	$hrsExtra_dobles_dias = $row_empleados['n_hrsExtra_dobles_dias'];
  	$hrsExtra_triples_dias = $row_empleados['n_hrsExtra_triples_dias'];
  	#--********* PREMIO DE ASISTENCIA *********
  	$ASISTENCIA_PGO = $row_empleados['s_asistencia_pgo'];
  	$ASISTENCIA_DIAS = $row_empleados['n_asistencia_dias'];
  	#--********* PAGAR SUBSIDIO ********* afecta $SUBSIDIO ,$ISPT
  	$SUBSIDIO_PGO = $row_empleados['s_subsidioPago'];
  	#--********* CUENTA CONTABLE DEL EMPLEADO PARA PRESTAMO *********
  	$ctaDeudorEmpleado = $row_empleados['s_prestamoCta'];
  	if( is_null($ctaDeudorEmpleado) or $ctaDeudorEmpleado == 0 ){
  		$ctaDeudorEmpleado = '0115-00001';
  	}

    #echo '-- $SALARIO_MENSUAL'; #echo "<br>";
    #echo  $SALARIO_MENSUAL; #echo "<br>";

    #echo '-- $SALARIO DIARIO'; #echo "<br>";
    #echo  $SALARIO; #echo "<br>";

    #echo '-- DIAS VACACIONES'; #echo "<br>";
    #echo $DIAS_VACACIONES; #echo "<br>";

    #echo '-- PAGO INCAPACIDAD'; #echo "<br>";
    #echo $INCAPACIDAD_PGO; #echo "<br>";

    #echo '-- DIAS INCAPACIDAD'; #echo "<br>";
    #echo $DIAS_INCAPACIDAD; #echo "<br>";

    #echo '-- MOTIVO DE INCAPACIDAD'; #echo "<br>";
    #echo $TIPO_INCAPACIDAD; #echo "<br";

    	#--********** VALORAMOS SI LAS PAGA EL PATRON **********
    	if( $DIAS_INCAPACIDAD <= 3 ){
    	     if( $INCAPACIDAD_PGO == 'N' ){ $DIAS_INCAPACIDAD_DESCTO = $DIAS_INCAPACIDAD; }
    	     if( $INCAPACIDAD_PGO == 'S' ){ $DIAS_INCAPACIDAD_DESCTO = 0; }
    	}
    	if( $DIAS_INCAPACIDAD > 3 ){
    	     if( $INCAPACIDAD_PGO == 'N' ){ $DIAS_INCAPACIDAD_DESCTO = $DIAS_INCAPACIDAD; }
    	     if( $INCAPACIDAD_PGO == 'S' ){ $DIAS_INCAPACIDAD_DESCTO = $DIAS_INCAPACIDAD - 3; }
    	}

    	$DIAS_INCAPACIDAD_PGO = $DIAS_INCAPACIDAD - $DIAS_INCAPACIDAD_DESCTO;

      #echo '-- DIAS INCAPACIDAD DESCUENTO'; #echo "<br>";
      #echo $DIAS_INCAPACIDAD_DESCTO; #echo "<br>";
      #echo '-- DIAS INCAPACIDAD PAGO'; #echo "<br>";
      #echo $DIAS_INCAPACIDAD_PGO; #echo "<br>";

      #--******************************************
    	#--********** FALTAS EN UNA SEMANA **********
    	#--******************************************
    	if( is_null($DIAS_FALTAS) ){ $DIAS_FALTAS = 0; }

    	if( $DIAS_FALTAS > 0 ){
    		$DIASfaltas = $DIAS_PAGAR_INFO / $DIAS_TRABAJADOS_INFO;
    		$DIAS_FALTAS = $DIASfaltas * $DIAS_FALTAS;
    		#$DIAS_FALTAS = number_format($DIAS_FALTAS,2,'.','');
    		#$DIAS_FALTAS = round($DIAS_FALTAS,0);
    	}
    	if( $DIAS_FALTAS > 7 ){ $DIAS_FALTAS = 7; }

    #echo '-- FALTAS EN LA SEMANA $DIAS_FALTAS'; #echo "<br>";
    #echo $DIAS_FALTAS; #echo "<br>";

    	#--****************************************
    	#--********** DIAS A PAGAR **********
    	#--****************************************
    	$DIAS_PAGAR = cortarXdecimales(floatval( $DIAS_PAGAR_INFO - ($DIAS_VACACIONES + $DIAS_FALTAS + $DIAS_INCAPACIDAD_DESCTO)),3);

    	if( $DIAS_PAGAR > 0 ){
    		$DIAS_PAGAR = $DIAS_PAGAR;
    	}else{ $DIAS_PAGAR = 0; }
    #echo '-- DIAS_PAGAR'; #echo "<br>";
    #echo $DIAS_PAGAR; #echo "<br>";

    	#--*************************************************************
    	#--********** SALARIO SEMANAL SIN VACACIONES Y FALTAS **********
    	#--*************************************************************
    	$SALARIO_SEMANAL_CD = $SALARIO * $DIAS_PAGAR;
    #echo '-- SALARIO SEMANAL SIN VACACIONES Y FALTAS $SALARIO_SEMANAL_CD'; #echo "<br>";
    #echo $SALARIO_SEMANAL_CD; #echo "<br>";


#--------------------------------------------------------------------------------------------------------------
#-- PERCEPCIONES
#--------------------------------------------------------------------------------------------------------------

    	#--***************************************************
    	#--********** PAGO DE VACACIONES **********
    	#--***************************************************
    	$PVACACIONES = $DIAS_VACACIONES * $SALARIO;

    #echo '-- PAGO DE VACACIONES $PVACACIONES = $DIAS_VACACIONES * $SALARIO'; #echo "<br>";
    #echo $PVACACIONES; #echo "<br>";

    #echo '-- PAGAR PRIMA VACACIONAL'; #echo "<br>";
    #echo $VACACIONES_primaPGO; #echo "<br>";

    #echo '-- DIAS PRIMA VACACIONAL'; #echo "<br>";
    #echo $VACACIONES_primaDias; #echo "<br>";

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

    #echo '-- PRIMA VACACIONAL IMPORTE A PAGAR $PRIMA_VACIONES'; #echo "<br>";
    #echo $PRIMA_VACIONES; #echo "<br>";
    #echo '-- FACTOR_PRIMA_EG'; #echo "<br>";
    #echo $FACTOR_PRIMA_EG; #echo "<br>";
    #echo '-- PRIMA VACACIONAL E'; #echo "<br>";
    #echo $PRIMA_VACIONES_E; #echo "<br>";
    #echo '-- PRIMA VACACIONAL G'; #echo "<br>";
    #echo $PRIMA_VACIONES_G; #echo "<br>";

    	#--***********************************************************************
    	#--********** VALOR INFORMATIVO - DIAS TRABAJADOS DEL EMPLEADO **********
    	#--***********************************************************************
    	# SE RESTAN LOS DIAS DE VACACIONES A PARTIR DE 19-JUNIO-2017 POR SOLICITUD DE CARLOS LANDA
    	$diasTrabajadosEmpleado = 0;
    	$diasTrabajadosEmpleado = $DIAS_PAGAR_INFO - $DIAS_FALTAS - $DIAS_VACACIONES;
    	if( $diasTrabajadosEmpleado < 0 or is_null($diasTrabajadosEmpleado) ){ $diasTrabajadosEmpleado = 0; }
    #echo '-- $diasTrabajadosEmpleado = $DIAS_PAGAR_INFO - $DIAS_FALTAS - $DIAS_VACACIONES ='; #echo "<br>";
    #echo $diasTrabajadosEmpleado; #echo "<br>";

    	#--*************************************************************
    	#--********** SALARIO SEMANAL INTEGRAL **********
    	#--*************************************************************
    	$SALARIO_SEMANAL = $SALARIO * $DIAS_PAGAR_INFO;
    #echo '-- $SALARIO_SEMANAL = $SALARIO * $DIAS_PAGAR_INFO'; #echo "<br>";
    #echo $SALARIO_SEMANAL; #echo "<br>";

    	#--********************************************************
    	#--********** PREMIO DE PUNTUALIDAD **********
    	#--********************************************************

    	$PCOMPENSA = 0;
    	if( $VALIDA_PCOMPENSA == 'S' and $diasTrabajadosEmpleado > 0 ){
    		#-- calculo modificado 9 Agosto 2013 a peticion de Carlos Ososrio > Alicia Velez
    		#--BEGIN SELECT $PCOMPENSA = $SALARIO_SEMANAL * .10 END
    		$PCOMPENSA = cortarXdecimales(floatval(( $diasTrabajadosEmpleado * $SALARIO ) * 0.10),2);

    	}
    #echo '-- PREMIO DE PUNTUALIDAD $PCOMPENSA'; #echo "<br>";
    #echo $PCOMPENSA; #echo "<br>";


    	#--***************************************
    	#--******** COMPENSACION ********
    	#--***************************************
    #echo '-- COMPENSACION $GRATIF3'; #echo "<br>";
    #echo $GRATIF3; #echo "<br>";

    	$PGRATIFIACION = $PVACACIONES + $PRIMA_VACIONES + $PCOMPENSA + $GRATIF3;
    #echo '-- $PGRATIFIACION = $PVACACIONES + $PRIMA_VACIONES + $PCOMPENSA + $GRATIF3'; #echo "<br>";
    #echo $PGRATIFIACION; #echo "<br>";

    	#--**************************************************************
    	#--********** FONDO DE AHORRO 1=NO 2=SI                **********
    	#-- 16 Enero 2014 se deja de calcular fondo de ahorro
    	#--**************************************************************
    	#--SELECT $FONDO_CONDICION = Cond_fondo FROM TBL_NOM_EMPLEADOS WHERE Empleado = $ID_EMPLEADO_CURSOR
    	#--SELECT $FONDO_CONDICION = 1
    	#--IF  $FONDO_CONDICION = 2 BEGIN
    		    #--- calculo modificado 9 Agosto 2013 a peticion de Carlos Osorio > Alicia Velez
    		    #--- SELECT $FONDO = $SALARIO_SEMANAL *  .10

    		    #--IF $diasTrabajadosEmpleado > 0 BEGIN SELECT $FONDO = ( $diasTrabajadosEmpleado * $SALARIO) * 0.13 END
    		    #--ELSE BEGIN SELECT $FONDO = 0 END
    		#--END
    	#--ELSE BEGIN SELECT $FONDO = 0 END

    	$FONDO = 0;
    #echo '-- FONDO DE AHORRO $FONDO'; #echo "<br>";
    #echo $FONDO; #echo "<br>";

    	#--***************************************
    	#--********** FECHA DE CONTRATO **********
    	#--***************************************
    #echo '-- FECHA CONTRATO'; #echo "<br>";
    #echo $FECHA_CONTRATO; #echo "<br>";

    	#--********************************
    	#--********** ANTIGUEDAD **********
    	#--********************************
    	#echo "Contrato: $FECHA_CONTRATO"; #echo "<br>";
    	#echo "Fecha final nomina: $FECHAFINAL";#echo "<br>";

    	$ANTIGUEDAD_SEMANAS = calcularAntiguedad($FECHA_CONTRATO,$FECHAFINAL);

    	#$ANTIGUEDAD_SEMANAS = date_diff($FECHA_CONTRATO,$fechaActual);
    #echo '-- ANTIGUEDAD PATRON'; #echo "<br>";
    #echo $ANTIGUEDAD_SEMANAS; #echo "<br>";

    	#--********* FACTOR INTEGRADO POR ANIO *********
    #echo '-- FACTOR INTEGRADO'; #echo "<br>";
    #echo $FACTOR_INTEGRADO_ANO; #echo "<br>";

    #--******************************************
  	#--********** VALES DE DESPENSA    **********
  	#--******************************************
  	$VALES_DESPENSA = 0;
  	$faltasPeriodo = 0;
  	$diasCalculoVales = 0;

  	if( $pagVales == 'S' ){
  	    if( $VALIDA_DESPENSA == 'S' ){
          /* EN LA BD NO SE USA DESDE EL 2014
    			$oRst_diasFaltas = mysqli_fetch_array(mysqli_query($db,"SELECT truncate(SUM(dias_faltas),2) as dias_faltas FROM TBL_NOM_nominaCFDI_detalle WHERE tipoElemento = 'TOTALES' AND id_docNomina IN
                              		(SELECT ID_DOCNOMINA FROM TBL_NOM_nominaCFDI WHERE ID_EMPLEADO = $ID_EMPLEADO_CURSOR AND ANIO = $anio AND ID_NOMINA BETWEEN $periodoNominaInicial AND $periodoNominaFinal)"));
    			$faltasPeriodo = $oRst_diasFaltas['dias_faltas'];
    			if( is_null($faltasPeriodo) ){ $faltasPeriodo = 0; }*/

          $faltasPeriodo = 0;

    			$diasCalculoVales = $diasVales - $faltasPeriodo;
    	    	$VALES_DESPENSA = $SALARIO *  $diasCalculoVales;
    			$VALES_DESPENSA = $VALES_DESPENSA * 0.10;
    			$VALES_DESPENSA = $VALES_DESPENSA;
  	    }
  	}

    #echo '-- DIAS VALES'; #echo "<br>";
    #echo $diasVales; #echo "<br>";
    #echo '-- FALTAS EN EL PERIODO'; #echo "<br>";
    #echo $faltasPeriodo; #echo "<br>";
    #echo '-- DIAS A CALCULAR'; #echo "<br>";
    #echo $diasCalculoVales; #echo "<br>";
    #echo '-- TOTAL VALES DE DESPENSA $VALES_DESPENSA = ($SALARIO *  $diasCalculoVales) * 0.10'; #echo "<br>";
    #echo $VALES_DESPENSA; #echo "<br>";

    #--*******************************************
    #--********** GRATIFICACION EXCENTA **********
    #--*******************************************
    $PGRATI_EXCENTOS = $FONDO + $VALES_DESPENSA;
    #echo '-- GRATIFICACION EXCENTA'; #echo "<br>";
    #echo $PGRATI_EXCENTOS; #echo "<br>";

    #--**********************************
    #--********** HORAS EXTRAS **********
    #--**********************************
    $hrsExtra_dobles_pgo = 0;
    $hrsExtra_triples_pgo = 0;
    $PHORASdobles_ISPT = 0;
    $PHORAStriples_ISPT = 0;
    $PHORAS_ISPT = 0;

    #--********** PAGO HORAS EXTRAS **********
    if( $hrsExtra_dobles > 0 ){
         $hrsExtra_dobles_pgo = $hrsExtra_dobles * (($SALARIO / 8)* 2);
       #PARA TODOS APLICA 50% GRAVADO Y 50% EXENTO
       $hrsExtra_dobles_pgoG = $hrsExtra_dobles_pgo / 2;
       $hrsExtra_dobles_pgoE = $hrsExtra_dobles_pgo / 2;

       #EL LIMITE DE EXENTO ES 5 VECES EL SALARIO MINIMO Y EL RESTO ES GRAVADO
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

    #echo '-- DIAS Y HORAS DOBLES'; #echo "<br>";
    #echo $hrsExtra_dobles_dias; #echo "<br>";
    #echo $hrsExtra_dobles; #echo "<br>";
    #echo '-- $hrsExtra_dobles_pgo = $hrsExtra_dobles * (($SALARIO / 8)* 2)'; #echo "<br>";
    #echo $hrsExtra_dobles_pgo; #echo " *** 50% gravado y 50% exento(limite 5 veces el salario minimo) <br>";
    #echo '-- BASE PAGO ISPT POR HORAS DOBLES $PHORASdobles_ISPT'; #echo "<br>";
    #echo $PHORASdobles_ISPT; #echo "<br>";

    #echo '-- DIAS Y HORAS TRIPLES'; #echo "<br>";
    #echo $hrsExtra_triples_dias; #echo "<br>";
    #echo $hrsExtra_triples; #echo "<br>";
    #echo '-- $hrsExtra_triples_pgo = $hrsExtra_triples * (($SALARIO / 8)* 3)'; #echo "<br>";
    #echo $hrsExtra_triples_pgo; #echo "<br>";
    #echo '-- BASE PAGO ISPT POR HORAS TRIPLES $PHORAS_ISPT'; #echo "<br>";
    #echo $PHORAStriples_ISPT; #echo "<br>";

    #--****************************************************
    #--********** PREMIO DE ASISTENCIA *********
    #-- No se pagara a partir de la nomina 6 con fecha de pago 8/Feb/2013 CALCULO: $PREMIO_ASISTENCIA = ($SALARIO * 30.4) * 0.05
    #-- Se paga a partir del 1/Ene/2015
    #-- Calculo semanal : SELECT $PREMIO_ASISTENCIA = (   ($SALARIO * 30 * 0.10) /30   )*$ASISTENCIA_DIAS
    #--****************************************************
    $PREMIO_ASISTENCIA = 0;

    if( $pagPremAsist == 'S' ){
      if( $ASISTENCIA_PGO == 'S' ){
        $PREMIO_ASISTENCIA = cortarXdecimales(floatval($SALARIO * 30.40),2);
        $PREMIO_ASISTENCIA = cortarXdecimales(floatval($PREMIO_ASISTENCIA * 0.10),2);
      }
    }

    #echo '-- $PREMIO_ASISTENCIA'; #echo "<br>";
    #echo $PREMIO_ASISTENCIA; #echo "<br>";


    #--************************************
    #--********** AYUDA DE RENTA **********
    #--************************************
    $AYUDA_RENTA_PGO = $row_empleados['s_ayudaRenta_pgo'];
    $AYUDA_RENTA = 0;
    if( $AYUDA_RENTA_PGO == 'S' ){
      $AYUDA_RENTA = $row_empleados['n_ayudaRenta'];
    }
    #echo '-- AYUDA POR RENTA $AYUDA_RENTA_PGO'; #echo "<br>";
    #echo $AYUDA_RENTA_PGO; #echo "<br>";
    #echo '-- IMPORTE $AYUDA_RENTA'; #echo "<br>";
    #echo $AYUDA_RENTA; #echo "<br>";


    #--*****************************
    #--********** CREDITO **********
    #--*****************************
    $CREDITO = 0;
    $TOTAL_GRATIFICACIONES = $PCOMPENSA + $PVACACIONES + $PRIMA_VACIONES_G + $GRATIF3 + $PREMIO_ASISTENCIA + $PHORAS_ISPT + $AYUDA_RENTA;
    $TOTAL_GRATIFICACIONESgravadas = $SALARIO_SEMANAL_CD + $PCOMPENSA + $PVACACIONES + $PRIMA_VACIONES_G + $GRATIF3 + $PREMIO_ASISTENCIA + $PHORAS_ISPT + $AYUDA_RENTA;
    $CREDITO_ISPT_BASE = $TOTAL_GRATIFICACIONESgravadas;
    #$CREDITO_ISPT_BASE = ($TOTAL_GRATIFICACIONES  + ($SALARIO * $DIAS_PAGAR)); SE APLICO CAMBIOS PARA 01-04-2017

    #echo '-- $TOTAL_GRATIFICACIONES = $PCOMPENSA + $PVACACIONES + $PRIMA_VACIONES_G + $GRATIF3 + $PREMIO_ASISTENCIA + $PHORAS_ISPT + $AYUDA_RENTA'; #echo "<br>";
    #echo '-- '.$TOTAL_GRATIFICACIONES.' = '.$PCOMPENSA.' + '.$PVACACIONES.' + '.$PRIMA_VACIONES_G.' + '.$GRATIF3.' + '.$PREMIO_ASISTENCIA.' + '.$PHORAS_ISPT.' + '.$AYUDA_RENTA; #echo "<br>";
    #echo '-- $TOTAL_GRATIFICACIONESgravadas = $SALARIO_SEMANAL_CD + $PCOMPENSA + $PVACACIONES + $PRIMA_VACIONES_G + $GRATIF3 + $PREMIO_ASISTENCIA + $PHORAS_ISPT + $AYUDA_RENTA'; #echo "<br>";
    #echo '-- '.$TOTAL_GRATIFICACIONESgravadas.' = '.$SALARIO_SEMANAL_CD.' + '.$PCOMPENSA.' + '.$PVACACIONES.' + '.$PRIMA_VACIONES_G.' + '.$GRATIF3.' + '.$PREMIO_ASISTENCIA.' + '.$PHORAS_ISPT.' + '.$AYUDA_RENTA; #echo "<br>";
    #echo '-- $CREDITO_ISPT_BASE =  ($TOTAL_GRATIFICACIONESgravadas  + ($SALARIO * $DIAS_PAGAR)) ='; #echo "<br>";
    #echo $CREDITO_ISPT_BASE.' = ('.$TOTAL_GRATIFICACIONESgravadas.' + ('.$SALARIO.' * '.$DIAS_PAGAR.')) ='; #echo "<br>";

    #--********** ISPT **********
  	if( $SALARIO <= $SALARIO_MINIMO_INFO ){
  			#--Damos Valor al ISPT
  			$ISPT = 0;
  			#--Obtenemos el CREDITO
  			$oRst_T80A = mysqli_fetch_array(mysqli_query($db,"SELECT n_cuota_b
                                                          FROM conta_cs_imss
                                                          WHERE s_nombreTabla = 'art80_b' AND $CREDITO_ISPT_BASE >= n_inferior_b and $CREDITO_ISPT_BASE <= n_superior_b"));
  			$CREDITO = $oRst_T80A['n_cuota_b'];

        #echo '-- if $SALARIO <= $SALARIO_MINIMO_INFO'; #echo "<br>";
        #echo $SALARIO.' <= '.$SALARIO_MINIMO_INFO; #echo "<br>";
        #echo '-- $ISPT = '.$ISPT."<br>";
        #echo '-- $CREDITO  = n_cuota_b s_nombreTabla=art80_b = '.$CREDITO."<br>";
  	}


    #--********** SUBSIDIO AL EMPLEO **********
  	if( $SALARIO > $SALARIO_MINIMO_INFO ){
        #echo '-- IF $SALARIO > $SALARIO_MINIMO_INFO'; #echo "<br>";
        #echo $SALARIO.' > '.$SALARIO_MINIMO_INFO; #echo "<br>";


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

        #echo '-- $INFERIROR_80 = n_inferior s_nombreTabla=art80'; #echo "<br>";
        #echo $INFERIROR_80; #echo "<br>";
        #echo '-- $INFERIROR_80A = n_inferior s_nombreTabla=art80_a'; #echo "<br>";
        #echo $INFERIROR_80; #echo "<br>";
        #echo '-- $cuotaT80 = n_cuota s_nombreTabla=art80'; #echo "<br>";
        #echo $cuotaT80; #echo "<br>";

        	          if( is_null($PORCENTA_1) ){ $PORCENTA_1 = 0; }

        	          if( $PORCENTA_1 > 0 ){ $PORCENTA_1 = cortarXdecimales(floatval($PORCENTA_1),2); }
        			  #if( $PORCENTA_1 > 0 ){ $PORCENTA_1 = cortarXdecimales(floatval($PORCENTA_1 / 100),2); } #SE APLICO CAMBIOS PARA 01-04-2017

        #echo '--$PORCENTA_1  = n_porcentaje s_nombreTabla=art80'; #echo "<br>";
        #echo $PORCENTA_1; #echo "<br>";

        	          #$MARGINAL_80 = cortarXdecimales(floatval(( $CREDITO_ISPT_BASE - $INFERIROR_80 ) * $PORCENTA_1),2); #SE APLICO CAMBIOS PARA 01-04-2017
        	          #$MARGINAL_80A = cortarXdecimales(floatval(( $CREDITO_ISPT_BASE - $INFERIROR_80A ) * $PORCENTA_1),2); #SE APLICO CAMBIOS PARA 01-04-2017
        			  $MARGINAL_80 = cortarXdecimales(floatval(( $CREDITO_ISPT_BASE - $INFERIROR_80 ) * $PORCENTA_1 / 100 ),2);
        	          $MARGINAL_80A = cortarXdecimales(floatval(( $CREDITO_ISPT_BASE - $INFERIROR_80A ) * $PORCENTA_1 / 100 ),2);
        #echo '-- $MARGINAL_80A = ($CREDITO_ISPT_BASE - $INFERIROR_80A ) * $PORCENTA_1 / 100 = '.'('.$CREDITO_ISPT_BASE.' - '.$INFERIROR_80A.' ) * '.$PORCENTA_1.' / 100'; #echo "<br>";
        #echo $MARGINAL_80A; #echo "<br>";
        #echo '-- $MARGINAL_80 =  ($CREDITO_ISPT_BASE - $INFERIROR_80 ) * $PORCENTA_1 / 100 ='.'('.$CREDITO_ISPT_BASE.' - '.$INFERIROR_80.' ) * '.$PORCENTA_1.' / 100'; #echo "<br>";
        #echo $MARGINAL_80; #echo "<br>";

        			  #--Obtenemos el Credito
        	          $oRst_T80B = mysqli_fetch_array(mysqli_query($db,"SELECT n_cuota_b
                                                                      FROM conta_cs_imss
                                                                      WHERE s_nombreTabla = 'art80_b' AND $CREDITO_ISPT_BASE >= n_inferior_b and $CREDITO_ISPT_BASE <= n_superior_b"));
        			  $CREDITO = $oRst_T80B['n_cuota_b'];
        #echo '-- $CREDITO = Cuota s_nombreTabla=art80_b'; #echo "<br>";
        #echo $CREDITO; #echo "<br>";

        	          if( is_null($PORCENTA_2) ){ $PORCENTA_2 = 0; }

        	          if( $PORCENTA_2 > 0 ){ $PORCENTA_2 = $PORCENTA_2 / 100; }


        			  $impuestoTotal = $MARGINAL_80 + $cuotaT80;
        	#echo '-- $impuestoTotal = '; #echo "<br>";
        	#echo $impuestoTotal; #echo "<br>";

        			$SUBSIDIO = 0;
        			if( $impuestoTotal > $CREDITO ){
        				$ISPT = $impuestoTotal - $CREDITO;
        				$SUBSIDIO = 0;
        	#echo 'if( $impuestoTotal > $CREDITO ){';  #echo "<br>";
        	#echo '$ISPT = $impuestoTotal - $CREDITO = '.$ISPT;  #echo "<br>";
        	#echo '$SUBSIDIO = 0';  #echo "<br>";
        			}else{
        				$ISPT = 0;
        				$SUBSIDIO = $CREDITO - $impuestoTotal;
        	#echo 'if( $CREDITO > $impuestoTotal ){'; #echo "<br>";
        	#echo '$SUBSIDIO = $CREDITO - $impuestoTotal = '.$SUBSIDIO;  #echo "<br>";
        	#echo '$ISPT = 0';  #echo "<br>";

        			}

        			if( $SUBSIDIO_PGO == 'N' ){ $SUBSIDIO = 0; }
        	#echo '-- PAGAR SUBSIDIO = '.$SUBSIDIO_PGO; #echo "<br>";

  	}


    #--*******************************************
  	#--********** PRESTAMOS EN EFECTIVO **********
  	#--*******************************************
  	$PRESTAMO = 0;
  	$PRESTAMO_PGO = $row_empleados['s_prestamo_pgo'];

    #echo '-- PRESTAMO EN EFECTIVO'; #echo "<br>";
    #echo $PRESTAMO_PGO; #echo "<br>";

    if ( $PRESTAMO_PGO == 'S' ){

    		$PRESTAMO = $row_empleados['n_prestamo'];

        #echo '-- CTA CONTABLE DEL EMPLEADO $ctaDeudorEmpleado'; #echo "<br>";
        #echo $ctaDeudorEmpleado; #echo "<br>";
        #echo '-- IMPORTE  $PRESTAMO'; #echo "<br>";
        #echo $PRESTAMO; #echo "<br>";
    }


    #--------------------------------------------------------------------------------------------------------------
    #-- DEDUCCIONES
    #--------------------------------------------------------------------------------------------------------------
    	#--**************************
    	#--********** IMSS **********
    	#--**************************

    		#--********** SALARIO DIARIO INTEGRADO **********
    		#--CUANDO SE INICIA PLAA, este valor se captura en la pantalla "Datos", debido a que empleados que vienen de PLO se les respeto su antiguedad.
    		#echo '-- IMSS'; #echo "<br>";
    		#echo '-- SALARIO DIARIO INTEGRADO $SDI='; #echo "<br>";
    		#echo $SDI; #echo "<br>";

    		$DIAS_CALCULO = cortarXdecimales(floatval($DIAS_PAGAR_INFO - $DIAS_INCAPACIDAD_DESCTO - $DIAS_FALTAS),3);
    		$SDIcalculo = $SDI * $DIAS_CALCULO;
    		#echo '-- $DIAS_CALCULO IMSS = $DIAS_PAGAR_INFO - $DIAS_INCAPACIDAD_DESCTO - $DIAS_FALTAS = '.$DIAS_PAGAR_INFO.' - '.$DIAS_INCAPACIDAD_DESCTO.' - '.$DIAS_FALTAS; #echo "<br>";
    		#echo $DIAS_CALCULO; #echo "<br>";


    		#echo '-- $SDIcalculo = $SDI * $DIAS_CALCULO ='; #echo '<br>';
    		#echo $SDIcalculo; #echo "<br>";

    	if( $SALARIO >= $SALARIO_MINIMO_INFO ){

    	     $SMGI = $SALARIO_MINIMO_INFO;

    	    if( $SDI > $SMGI ){
    		#--Obtenemos los Ramos del IMSS
    	        #--Genero un cursor para la tabla del IMMS
    		$sql_NOM_IMSS = mysqli_query($db,"SELECT n_ramo,n_baseSalarial as BaseSalarial,n_topeSalarial,n_trabajador as Trabajador from conta_cs_imss where s_nombreTabla = 'ramoSeguro'");

    		$PRESTA_DINERO = 0;
    		$ESPECIE_ADICIONAL = 0;
    		$PENSIONADOS = 0;
    		$INVALIDEZ_VIDA = 0;
    		$CESANTIA_VEJEZ = 0;
    		$DESCUENTO_PRESTAMO = 0;

    		#--Asigano a unas varibles los resultados
    		while( $oRst_NOM_IMSS = mysqli_fetch_array($sql_NOM_IMSS) ){
    			$Ramo = $oRst_NOM_IMSS['n_ramo'];
    			$BaseSalarial = $oRst_NOM_IMSS['n_baseSalarial'];
    			$TopeSalarial = $oRst_NOM_IMSS['n_topeSalarial'];
    			$Trabajador = $oRst_NOM_IMSS['n_trabajador'];

    			$trabaja = $Trabajador / 100;
    			#por default se manejan 4 decimales. ejemplo 0.375/100 = 0.0037

    			if( $DIAS_CALCULO <> 0 ){
    			    #--EM - Prestaciones en Dinero
    				if( $Ramo == 1 ){
    					$PRESTA_DINERO = cortarXdecimales(floatval($SDIcalculo * $trabaja),2);
    					#echo 'ramo1 --EM - Prestaciones en Dinero = $PRESTA_DINERO = $SDIcalculo * $trabaja ='.$SDIcalculo.' * '.$trabaja.' = ';
    					#echo $PRESTA_DINERO; #echo '<br>';
    				}
    		        #--EM - Adicional
    				if( $Ramo == 3 ){
    					$ST = cortarXdecimales(floatval($SDI - ($SALARIO_MINIMO_INFO * 3)),2);
    					#echo 'ramo3 --EM - Adicional = $ST = $SDI - ($SALARIO_MINIMO_INFO * 3) = '.$SDI.' - ('.$SALARIO_MINIMO_INFO.' * 3) = ';
    					#echo $ST; #echo '<br>';

    				   if( $ST > 0 ){
    				   		#$STcalculo = $ST * $DIAS_CALCULO;
    						#$ESPECIE_ADICIONAL = $STcalculo * $trabaja;
    						$STcalculo = $ST * $trabaja;
    						$ESPECIE_ADICIONAL = cortarXdecimales(floatval($STcalculo * $DIAS_CALCULO),2);
    				   }else{
    						$ESPECIE_ADICIONAL = 0;
    				   }
    				   #echo 'if( $ST > 0 ){';
    				   #echo '$ESPECIE_ADICIONAL = $ST * $DIAS_CALCULO * $trabaja = '.$ST.' * '.$trabaja.' * '.$DIAS_CALCULO.' = ';
    				   #echo $ESPECIE_ADICIONAL; #echo '<br>';
    				}
    				#--IV - Pensionados
    			    if( $Ramo == 4 ){
    					$PENSIONADOS = cortarXdecimales(floatval($SDIcalculo * $trabaja),2);
    					#echo 'ramo4 -- Pensionados = $PENSIONADOS = $SDIcalculo * $trabaja = '.$SDIcalculo.' * '.$trabaja.' = ';
    					#echo $PENSIONADOS; #echo '<br>';
    				}
    		        #--RE - Invalidez y vida
    				if( $Ramo == 5 ){
    					$INVALIDEZ_VIDA = cortarXdecimales(floatval($SDIcalculo * $trabaja),2);
    					#echo 'ramo5 -- Invalidez = $INVALIDEZ_VIDA = $SDIcalculo * $trabaja = '.$SDIcalculo.' * '.$trabaja.' = ';
    					#echo $INVALIDEZ_VIDA; #echo '<br>';
    				}
    		        #--Cesantia y Vejez
    				if( $Ramo == 7 ){
    					$CESANTIA_VEJEZ = cortarXdecimales(floatval($SDIcalculo * $trabaja),2);
    					#echo 'ramo7 -- CESANTIA_VEJEZ = $CESANTIA_VEJEZ = $SDIcalculo * $trabaja = '.$SDIcalculo.' * '.$trabaja.' = ';
    					#echo $CESANTIA_VEJEZ; #echo '<br>';
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
    #echo '-- $IMSS = $PRESTA_DINERO + $ESPECIE_ADICIONAL + $PENSIONADOS + $INVALIDEZ_VIDA + $CESANTIA_VEJEZ = '.$PRESTA_DINERO.' + '.$ESPECIE_ADICIONAL.' + '.$PENSIONADOS.' + '.$INVALIDEZ_VIDA.' + '.$CESANTIA_VEJEZ.' = '; #echo "<br>";
    #echo $IMSS; #echo "<br>";



    	#--*****************************************
    	#--********** INFONAVIT descuento **********
    	#--*****************************************
    	$INFONAVIT = $row_empleados['n_desc_infonavit'];
    #echo '-- INFONAVIT'; #echo "<br>";
    #echo $INFONAVIT; #echo "<br>";

    	#--******************************************
    	#--********** FONDO DE DEDUCCIONES **********
    	#--******************************************
    	$DFONDO = $FONDO * 2;
    #echo '-- FONDO DE DEDUCCIONES $DFONDO'; #echo "<br>";
    #echo $DFONDO; #echo "<br>";


    	#--*********************************
    	#--********** DESCUENTO 1 **********
    	#--*********************************
    	$DESCUENTO_1 = $row_empleados['n_desc_descuentos'];
    #echo '-- DESCUENTO 1'; #echo "<br>";
    #echo $DESCUENTO_1; #echo "<br>";

    	#--********************************************
    	#--********** DESCUENTO DE PRESTAMOS **********
    	#--********************************************
    	$DESCUENTO_PRESTAMO = $row_empleados['n_desc_prestamo'];
    #echo '-- DESCUENTO POR PRESTAMO'; #echo "<br>";
    #echo $DESCUENTO_PRESTAMO; #echo "<br>";
    #echo '-- CUENTA POR PRESTAMO'; #echo "<br>";
    #echo $ctaDeudorEmpleado; #echo "<br>";

    	#--**************************************************
    	#--********** DESCUENTO POR AYUDA DE RENTA **********
    	#--**************************************************
    	$DESC_RENTA_PGO = $row_empleados['s_desc_renta_pgo'];
    	$DESC_RENTA = 0;
    	if( $DESC_RENTA_PGO == 'S' ){ $DESC_RENTA = $row_empleados['n_desc_renta']; }
    #echo '-- DESCONTAR POR RENTA $DESC_RENTA_PGO'; #echo "<br>";
    #echo $DESC_RENTA_PGO; #echo "<br>";
    #echo '-- IMPORTE DESCUENTO $DESC_RENTA'; #echo "<br>";
    #echo $DESC_RENTA; #echo "<br>";

    	#--*******************************************
    	#--********** DESCUENTO POR FONACOT **********
    	#--*******************************************
    	$DESC_FONACOT = $row_empleados['n_desc_fonacot'];
    #echo '-- DESCUENTO FONACOT $DESC_FONACOT'; #echo "<br>";
    #echo $DESC_FONACOT; #echo "<br>";

      #--****************************************
    	#--********** TOTAL PERCEPCIONES **********
    	#--****************************************

    	$TOTAL_PERCEPCIONES = cortarXdecimales(floatval($SALARIO_SEMANAL_CD + $PVACACIONES + $PRIMA_VACIONES + $PCOMPENSA + $FONDO + $VALES_DESPENSA + $GRATIF3 + $hrsExtra_dobles_pgo + $hrsExtra_triples_pgo + $PREMIO_ASISTENCIA + $PRESTAMO + $AYUDA_RENTA),2);
    #echo '-- Total percepciones = $SALARIO_SEMANAL_CD + $PVACACIONES + $PRIMA_VACIONES + $PCOMPENSA + $FONDO + $VALES_DESPENSA + $GRATIF3 + $hrsExtra_dobles_pgo + $hrsExtra_triples_pgo + $PREMIO_ASISTENCIA + $AYUDA_RENTA'; #echo "<br>";
    #echo $TOTAL_PERCEPCIONES; #echo "<br>";


    	#--***************************************************
    	#--********** DESCUENTO PENSION ALIMENTICIA **********
    	#--***************************************************
    	$DESC_PENSIONALIMEN_PGO = $row_empleados['s_desc_pensionAlim_pago'];
    #echo '-- PENSION ALIMENTICIA PAGAR'; #echo "<br>";
    #echo $DESC_PENSIONALIMEN_PGO; #echo "<br>";
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

    #echo '-- PENSION ALIMENTICIA OTORGADO'; #echo "<br>";
    #echo $DESC_PENSIONALIMEN_OTORGADO; #echo "<br>";
    #echo '-- PENSION ALIMENTICIA ENTREGADO'; #echo "<br>";
    #echo $DESC_PENSIONALIMEN_ENTREGADO; #echo "<br>";
    #echo '-- PENSION ALIMENTICIA PORCENTAJE'; #echo "<br>";
    #echo $DESC_PENSIONALIMEN_PORCENT; #echo "<br>";
    #echo '-- PENSION ALIMENTICIA IMPORTE'; #echo "<br>";
    #echo $DESC_PENSIONALIMEN; #echo "<br>";
    	}

    	#--***************************************
    	#--********** TOTAL DEDUCCIONES **********
    	#--***************************************
    	$TOTAL_DEDUCCIONES = $ISPT + $IMSS + $INFONAVIT + $DFONDO + $DESCUENTO_1 + $DESCUENTO_PRESTAMO + $DESC_RENTA + $DESC_FONACOT + $DESC_PENSIONALIMEN;
    #echo '-- TOTAL DEDUCCIONES'; #echo "<br>";
    #echo $TOTAL_DEDUCCIONES; #echo "<br>";

    	#--***********************************
    	#--********** TOTAL GENERAL **********
    	#--***********************************
    	$TOTAL = ($TOTAL_PERCEPCIONES + $SUBSIDIO) - $TOTAL_DEDUCCIONES;
    #echo '-- TOTAL = ($TOTAL_PERCEPCIONES + $SUBSIDIO) - $TOTAL_DEDUCCIONES = '.'('.$TOTAL_PERCEPCIONES.' + '.$SUBSIDIO.') - '.$TOTAL_DEDUCCIONES.' = '.$TOTAL; #echo "<br>";
    #echo $TOTAL; #echo "<br>";

    	#--********************************
    	#--********** TOTAL NETO **********
    	#--********************************
    	$TOTAL_NETO = cortarXdecimales(floatval($TOTAL - $VALES_DESPENSA),2);
    #echo '-- TOTAL NETO'; #echo "<br>";
    #echo $TOTAL_NETO; #echo "<br>";

      #--*****************************************
      #--********** DOCUMENTO EN NOMINA **********
      #--*****************************************

      	#-- FOLIO DEL DOCUMENTO DE NOMINA
      	$id_folio = 'docNomina';
      	include ("generarFolio.php");
      	$id_docNomina = $nFolio;

      	$noIMSS = $row_empleados['s_IMSS'];
      	$descConcepto = 'Pago de nómina';
      	if( $DIAS_PAGAR <= 0 ){ $DIAS_PAGAR = 0.001; } # como minimo se captura 0.001 y como max 5490.000
      	if( $SALARIO_SEMANAL_CD <= 0 ){ $salarioBaseCotApor = $SALARIO * $DIAS_PAGAR_INFO; }else{ $salarioBaseCotApor = $SALARIO_SEMANAL_CD; }


        require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_1agregarDocCaptura.php';
        $id_docNomina = $db->insert_id;
        #echo '-- DOCUMENTO EN NOMINA'; #echo "<br>";
        #echo $id_docNomina; #echo "<br>";

        require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_2agregarDetPercep.php';
        require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_3agregarDetOtrosPagos.php';
        require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_4agregarDetDeduc.php';
        require $root . '/Ubicaciones/Nomina/SueldosySalarios/actions/generarNominaSuel_5agregarDetTotales.php';

        $descripcion = "Se genero DocNomina: $id_docNomina Oficina: $aduana Anio: $anio Semana: $NUM_NOMINA";
        $clave = 'nomSueldos';
        $folio = $id_docNomina;
        require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

        $system_callback['code'] = 1;
        $system_callback['data'] .=
        "<tr>
          <td>$id_empleado $nombre $apellidoP</td>
          <td>$id_docNomina</td>
         </tr>";
        $system_callback['message'] = "Script called successfully but there are no rows to display.";


  }

  $system_callback['data'] .= "</table>";
  exit_script($system_callback);

?>

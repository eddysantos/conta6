<?php

$tipo = 4;
$fecha = $fechaTimbre;

if( $id_regimen == '02' ){
  $semCncpt = $descripcion." Sem. ".$semana;
}else{
  $semCncpt = "Pago de Honorarios Sem. ".$semana;
}
$concepto = $semCncpt." ".$nombre." ".$apellidoP." ".$apellidoM;
$concepto = substr($concepto, 0, 300);
require $root . '/Resources/PHP/actions/generarFolioPoliza.php';
echo 'POLIZA:';
echo $poliza = $nFolio;
echo '<br>';
$detallePoliza = '';


#DETALLE DE LA POLIZA ***
$cveDistrib = '';
$oficinaDistrib = '';

mysqli_query($db,"DELETE FROM conta_t_polizas_det WHERE fk_id_poliza = $poliza");
mysqli_query($db,"DROP TABLE IF EXISTS temp_distribSalarioPolNomina");
mysqli_query($db,"CREATE TABLE IF NOT EXISTS temp_distribSalarioPolNomina(oficina varchar(3),salarioDistrib float)");

//$sql_nomina = mysqli_query($db,"SELECT id_aduana, anio, id_factura, id_regimen, fechaPago, id_empleado,id_nomina FROM TBL_NOM_nominaCFDI WHERE id_docNomina = $id_docto");
//while( $oRst_nomina = mysqli_fetch_array($sql_nomina) ){
  //$id_aduana = $oRst_nomina['id_aduana'];
  //$anio = $oRst_nomina['anio'];
  //$idFactura = $oRst_nomina['id_factura'];
  //$id_regimen = $oRst_nomina['id_regimen'];
  //$fechaPago = date_format(date_create($oRst_nomina['fechaPago']),"Y-m-d");
  //$id_empleado = $oRst_nomina['id_empleado'];
  //$semana = $oRst_nomina['id_nomina'];

  echo 'factura: ';
  echo $idFactura;
  echo "<br>";
  echo "Fecha Pago: ";
  echo $fechaPago;
  echo "<br>";

  $oRst_salDist = mysqli_fetch_array(mysqli_query($db,"SELECT n_salario_AER, n_salario_VER, n_salario_MAN, n_salario_NL, n_salario_LTX FROM conta_t_nom_empleados WHERE pk_id_empleado = $id_empleado"));

  $salario_AER = $oRst_salDist['n_salario_AER'];
  $salario_VER = $oRst_salDist['n_salario_VER'];
  $salario_MAN = $oRst_salDist['n_salario_MAN'];
  $salario_NL = $oRst_salDist['n_salario_NL'];
  $salario_LTX = $oRst_salDist['n_salario_LTX'];
  $salario_NL = $salario_NL + $salario_LTX;

  mysqli_query($db,"INSERT INTO temp_distribSalarioPolNomina (oficina,salarioDistrib) VALUES ('470',$salario_AER) ");
  mysqli_query($db,"INSERT INTO temp_distribSalarioPolNomina (oficina,salarioDistrib) VALUES ('160',$salario_MAN) ");
  mysqli_query($db,"INSERT INTO temp_distribSalarioPolNomina (oficina,salarioDistrib) VALUES ('430',$salario_VER) ");
  mysqli_query($db,"INSERT INTO temp_distribSalarioPolNomina (oficina,salarioDistrib) VALUES ('240',$salario_NL) ");

  $contsalDist = mysqli_fetch_array(mysqli_query($db,"SELECT count(oficina) as oficina FROM temp_distribSalarioPolNomina WHERE salarioDistrib > 0"));
  $distribOfic = $contsalDist['oficina'];
  echo '-- Distribuir Salario en Oficinas: ';
  echo $distribOfic;
  echo "<br>";



#$totalPercepciones;
  echo '-------------------------------------------------------------------------------------------------------------------- PERCEPCIONES - INICIO';
  echo '---------------------------------------------';
  echo '-- PERCEPCIONES';
  echo "<br>";

  $sql_percep = mysqli_query($db,"SELECT fk_id_percepcion, fk_id_cuenta, s_descripcion, n_ordenReporte, s_clasificacion, s_registroConta, s_distribuido
                                  FROM conta_cs_sat_tipopercepcion_ctamst
                                  WHERE fk_id_regimen = $id_regimen and n_ordenReporte > 0 and (s_clasificacion = 'percepcion' or s_clasificacion = 'separacionIndemnizacion')
                                  ORDER BY n_ordenReporte");

  while( $oRst_percep = mysqli_fetch_array($sql_percep) ){
    $ID_percepcion = $oRst_percep['fk_id_percepcion'];
    $id_cuentaP = $oRst_percep['fk_id_cuenta'];
    $descripcionP = $oRst_percep['s_descripcion'];
    $ordenReporteP = $oRst_percep['n_ordenReporte'];
    $clasificacionP = $oRst_percep['s_clasificacion'];
    $registroContaP = $oRst_percep['s_registroConta'];
    $distribuidoP = $oRst_percep['s_distribuido'];

    $accionDistribuir = '';

    echo '----------------------------------------------------------------------------------------CONCEPTO: '.$descripcionP;
    echo "<br>";
    echo 'orden en reporte:';
    echo $ordenReporteP;
    echo "<br>";


      if( $distribOfic > 1 and $distribuidoP == 'S' ){ #-- 1
      echo '--------------------------------------------------- parte1 PERCEPCIONES DISTRIBUIR <br>';

        $accionDistribuir = 'percepciones';
        require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_salarioDistrib.php';

      }else{ #--1
      echo '--------------------------------------------------- parte2 PERCEPCIONES'; echo "<br>";
          // echo 'EL CONCEPTO SE DISTRIBUYE: '.$distribuidoP;
          // echo "<br>";
          // echo 'INSERTAR EN: '.$registroContaP;
          // echo "<br>";
          require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_percepciones.php';
      } #-- 1
  }
  echo '-------------------------------------------------------------------------------------------------------------------- PERCEPCIONES - FIN'; echo "<br>";
//} #$oRst_nomina


#if( $totalDeducciones > 0 ){
echo '-------------------------------------------------------------------------------------------------------------------- DEDUCCIONES - INICIO'; echo "<br>";
#---------------------------------------------
#-- DEDUCCIONES
$sql_deduccion = mysqli_query($db,"SELECT fk_id_deduccion, fk_id_cuenta, s_descripcion, n_ordenReporte, s_clasificacion, s_registroConta, s_distribuido
                  FROM conta_cs_sat_tipoDeduccion_ctaMst
                  WHERE fk_id_regimen = $id_regimen and n_ordenReporte > 0 and s_clasificacion = 'deduccion' and fk_id_cuenta like '%-%'
                  ORDER BY n_ordenReporte");


while( $oRst_deduccion = mysqli_fetch_array($sql_deduccion) ){
  $ID_deduccion = $oRst_deduccion['fk_id_deduccion'];
  $id_cuentaD = $oRst_deduccion['fk_id_cuenta'];
  $descripcionD = $oRst_deduccion['s_descripcion'];
  $ordenReporteD = $oRst_deduccion['n_ordenReporte'];
  $clasificacionD = $oRst_deduccion['s_clasificacion'];
  $registroContaD = $oRst_deduccion['s_registroConta'];
  $distribuidoD = $oRst_deduccion['s_distribuido'];

  $accionDistribuir = '';

echo '----------------------------------------------------------------------------------------CONCEPTO: '.$descripcionD; echo "<br>";
echo 'orden en reporte: ';
echo $ordenReporteD; echo "<br>";


  if( $distribOfic > 1 and $distribuidoD == 'S' ){ #-- 1
  echo '--------------------------------------------------- parte1 DEDUCCIONES DISTRIBUIR'; echo "<br>";
    $accionDistribuir = 'deduccion';
    require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_salarioDistrib.php';

  }else{ #-- 1
  echo '--------------------------------------------------- parte2 DEDUCCIONES'; echo "<br>";
      #echo 'EL CONCEPTO SE DISTRIBUYE: '.$distribuidoD;	echo "<br>";
      #echo 'INSERTAR EN: '.$registroContaD; echo "<br>";

      require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_deducciones.php';

  } #-- 1


}
echo '-------------------------------------------------------------------------------------------------------------------- DEDUCCIONES - FIN'; echo "<br>";
#}




































  echo '-------------------------------------------------------------------------------------------------------------------- HORAS EXTRAS - INICIO'; echo "<br>";
#---------------------------------------------;
#-- HORAS EXTRAS;


$sql_HE = mysqli_query($db,"SELECT fk_id_percepcion, fk_id_cuenta, s_descripcion, n_ordenReporte, s_clasificacion, s_registroConta, s_distribuido
              FROM conta_cs_sat_tipoPercepcion_ctaMst
              WHERE fk_id_regimen = $id_regimen and n_ordenReporte > 0 and s_clasificacion = 'horasExtras'
              ORDER BY n_ordenReporte");

while( $oRst_HE = mysqli_fetch_array($sql_HE) ){
  $ID_percepcionHE = $oRst_HE['fk_id_percepcion'];
  $id_cuentaHE = $oRst_HE['fk_id_cuenta'];
  $descripcionHE = $oRst_HE['s_descripcion'];
  $ordenReporteHE = $oRst_HE['n_ordenReporte'];
  $clasificacionHE = $oRst_HE['s_clasificacion'];
  $registroContaHE = $oRst_HE['s_registroConta'];
  $distribuidoHE = $oRst_HE['s_distribuido'];

  $accionDistribuir = '';

echo '----------------------------------------------------------------------------------------CONCEPTO: '.$descripcionP; echo "<br>";
echo 'orden en reporte: ';
echo $ordenReporteHE; echo "<br>";


  if( $distribOfic > 1 and $distribuidoHE == 'S' ){ #-- 1
  echo '--------------------------------------------------- parte1 HORAS EXTRAS DISTRIBUIR';
    $accionDistribuir = 'horasExtras';
    require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_salarioDistrib.php';

  }else{ #-- 1
  echo '--------------------------------------------------- parte2 HORAS EXTRAS'; echo "<br>";
      echo 'EL CONCEPTO SE DISTRIBUYE: '.$distribuidoP; echo "<br>";
      echo 'INSERTAR EN: '.$registroContaP; echo "<br>";

      require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_horasExtra.php';

  } #-- 1
}
echo '-------------------------------------------------------------------------------------------------------------------- HORAS EXTRAS - FIN'; echo "<br>";










#if( $totalOtrosPagos > 0 ){
echo '-------------------------------------------------------------------------------------------------------------------- OTROS PAGOS - INICIO'; echo "<br>";
echo '---------------------------------------------'; echo "<br>";
echo '-- OTROS PAGOS'; echo "<br>";

$sql_otrosPagos = mysqli_query($db,"SELECT fk_id_otroPago, fk_id_cuenta, s_descripcion, n_ordenReporte, s_clasificacion, s_registroConta, s_distribuido
                FROM conta_cs_sat_tipoOtroPago_ctamst
                WHERE fk_id_regimen = $id_regimen and n_ordenReporte > 0 and s_clasificacion = 'otrosPagos' and fk_id_cuenta like '%-%'
                ORDER BY n_ordenReporte");



  while( $oRst_otrosPagos = mysqli_fetch_array($sql_otrosPagos) ){
    $id_otroPago = $oRst_otrosPagos['fk_id_otroPago'];
    $id_cuentaOP = $oRst_otrosPagos['fk_id_cuenta'];
    $descripcionOP = $oRst_otrosPagos['s_descripcion'];
    $ordenReporteOP = $oRst_otrosPagos['n_ordenReporte'];
    $clasificacionOP = $oRst_otrosPagos['s_clasificacion'];
    $registroContaOP = $oRst_otrosPagos['s_registroConta'];
    $distribuidoOP = $oRst_otrosPagos['s_distribuido'];

    $accionDistribuir = '';

    echo '----------------------------------------------------------------------------------------CONCEPTO: '.$descripcionOP;
    echo "<br>";
    echo 'orden en reporte';
    echo "<br>";
    echo $ordenReporteOP;
    echo "<br>";


    if( $distribOfic > 1 and $distribuidoOP == 'S' ){ #-- 1
    echo '--------------------------------------------------- parte1 OTROS PAGOS DISTRIBUIR';
      $accionDistribuir = 'otrosPagos';
      require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_salarioDistrib.php';

    }else{ #--1
    echo '--------------------------------------------------- parte2 OTROS PAGOS';
        echo 'EL CONCEPTO SE DISTRIBUYE: '.$distribuidoOP;
        echo "<br>";
        echo 'INSERTAR EN: '.$registroContaOP;
        echo "<br>";

        require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_otrosPagos.php';
    } #-- 1
  }
echo '-------------------------------------------------------------------------------------------------------------------- OTROS PAGOS - FIN'; echo "<br>";
#}









echo '-------------------------------------------------------------------------------------------------------------------- desctoDespTotal - INICIO'; echo "<br>";
#---------------------------------------------
#-- desctoDespTotal
$desctoDespTotal = mysqli_query($db,"SELECT fk_id_deduccion, fk_id_cuenta, s_descripcion, n_ordenReporte, s_clasificacion, s_registroConta, s_distribuido
                  FROM conta_cs_sat_tipoDeduccion_ctaMst
                  WHERE fk_id_regimen = $id_regimen and n_ordenReporte > 0 and s_clasificacion = 'desctoDespTotal'
                  ORDER BY n_ordenReporte");

while( $oRst_desctoDespTotal = mysqli_fetch_array($desctoDespTotal) ){
  $ID_deduccion_DT = $oRst_desctoDespTotal['fk_id_deduccion'];
  $id_cuenta_DT = $oRst_desctoDespTotal['fk_id_cuenta'];
  $descripcion_DT = $oRst_desctoDespTotal['s_descripcion'];
  $ordenReporte_DT = $oRst_desctoDespTotal['n_ordenReporte'];
  $clasificacion_DT = $oRst_desctoDespTotal['s_clasificacion'];
  $registroConta_DT = $oRst_desctoDespTotal['s_registroConta'];
  $distribuido_DT = $oRst_desctoDespTotal['s_distribuido'];

  $accionDistribuir = '';

  echo '----------------------------------------------------------------------------------------CONCEPTO: '.$descripcion_DT;echo "<br>";
  echo 'orden en reporte';
  echo $ordenReporte_DT; echo "<br>";


    if( $distribOfic > 1 and $distribuido_DT == 'S' ){ #-- 1
    echo '--------------------------------------------------- parte1 desctoDespTotal DISTRIBUIR'; echo "<br>";
      $accionDistribuir = 'desctoDespTotal';
      require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_salarioDistrib.php';

    }else{ #-- 1
    echo '--------------------------------------------------- parte2 desctoDespTotal'; echo "<br>";
        echo 'EL CONCEPTO SE DISTRIBUYE: '.$distribuido_DT;	echo "<br>";
        echo 'INSERTAR EN: '.$registroConta_DT; echo "<br>";

        require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_desctoDespTotal.php';

    } #-- 1
}
echo '-------------------------------------------------------------------------------------------------------------------- desctoDespTotal - FIN'; echo "<br>";




echo '-------------------------------------------------------------------------------------------------------------------- TOTALES - INICIO'; echo "<br>";
#---------------------------------------------
#-- TOTALES
$TOTALES = mysqli_query($db,"SELECT fk_id_percepcion, fk_id_cuenta, s_descripcion, n_ordenReporte, s_clasificacion, s_registroConta, s_distribuido
            FROM conta_cs_sat_tipoPercepcion_ctaMst
            WHERE fk_id_regimen = $id_regimen and s_clasificacion = 'percepcionTotal'
            ORDER BY n_ordenReporte");

while( $oRst_TOTALES = mysqli_fetch_array($TOTALES) ){
  $ID_percepcion = $oRst_TOTALES['fk_id_percepcion'];
  $id_cuentaP = $oRst_TOTALES['fk_id_cuenta'];
  $descripcionP = $oRst_TOTALES['s_descripcion'];
  $ordenReporteP = $oRst_TOTALES['n_ordenReporte'];
  $clasificacionP = $oRst_TOTALES['s_clasificacion'];
  $registroContaP = $oRst_TOTALES['s_registroConta'];
  $distribuidoP = $oRst_TOTALES['s_distribuido'];

echo '----------------------------------------------------------------------------------------CONCEPTO: '.$descripcionP;  echo "<br>";
echo 'orden en reporte';
echo $ordenReporteP;  echo "<br>";


      echo 'EL CONCEPTO SE DISTRIBUYE: '.$distribuidoP;	 echo "<br>";
      echo 'INSERTAR EN: '.$registroContaP;  echo "<br>";

      require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_totales.php';

}
echo '-------------------------------------------------------------------------------------------------------------------- TOTALES - FIN';  echo "<br>";


mysqli_query($db,"DROP TABLE IF EXISTS temp_distribSalarioPolNomina");





#*********************************************
#* GENERAR DETALLE ADICIONAL - INSERTAR UUID *
#*********************************************

#$sql_consultaDocNomina = mysqli_fetch_array(mysqli_query($db,"SELECT FechaPago,id_factura,descripcion,nombre,apellidoP,apellidoM,importe,usuario_generaUUID,UUID,RFC,id_nomina,id_regimen
#                      FROM TBL_NOM_NOMINACFDI WHERE ID_DOCNOMINA = $id_docto"));

#$facRFC = $sql_consultaDocNomina['RFC'];
#$UUID = $sql_consultaDocNomina['UUID'];
#$totalHonorarios = number_format($sql_consultaDocNomina['importe'],2,'.','');
#$facUsuario = $sql_consultaDocNomina['usuario_generaUUID'];
$tipoDetalle = 'CompNal';
echo "&nbsp;";

mysqli_query($db,"INSERT INTO conta_t_polizas_det_contaelec (fk_partidaPol,fk_tipo,s_tipoDetalle,s_RFC,s_UUID_CFDI,n_monto,s_usuario_modifi)
                              SELECT pk_partida,fk_tipo,'$tipoDetalle','$r_rfc','$UUID',$total,'$usuario'
                              FROM conta_t_polizas_det
                              WHERE fk_id_poliza = $poliza");









?>

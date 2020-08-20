<?php

$sql_salarioDistrib = mysqli_query($db,"SELECT oficina,salarioDistrib FROM temp_distribSalarioPolNomina WHERE salarioDistrib > 0");

while( $oRst_salarioDistrib = mysqli_fetch_array($sql_salarioDistrib) ){
  $oficinaDistrib = $oRst_salarioDistrib['oficina'];
  $salarioDistrib = $oRst_salarioDistrib['salarioDistrib'];

  if( $distribOfic > 1 ){
    $cveDistrib = ' ::'.$oficinaDistrib.'::';
    // echo '-- CLAVE DE DISTRIBUCION DE SALARIO: ';
    // echo "<br>";
    // echo $cveDistrib;
    // echo "<br>";
  }

  // echo '-- PORCENTAJE: ';
  // echo "<br>";
  // echo $salarioDistrib;
  // echo "<br>";
  // echo 'EL CONCEPTO SE DISTRIBUYE: '.$distribuidoP;
  // echo "<br>";
  // echo 'INSERTAR EN: '.$registroContaP;
  // echo "<br>";

  if( $accionDistribuir == 'percepciones' ){
    require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_percepciones.php';
  }

   if( $accionDistribuir == 'otrosPagos' ){
     require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_otrosPagos.php';
   }
  if( $accionDistribuir == 'deduccion' ){
    require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_deducciones.php';
  }
   if( $accionDistribuir == 'desctoDespTotal' ){
     require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_desctoDespTotal.php';
   }
   if( $accionDistribuir == 'horasExtras' ){
     require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_3generarPoliza_horasExtra.php';
   }
}


?>

<?php

# $FI       Fecha Inicial del Año
# $ULT_NOM  Ultima Nomina
# $FIUNG    Fecha Inicial Ultima Nomina Generada
# $FFUNG    Fecha Final Ultima Nomina Generada
# $NOM_SIG  Nomina siguiente
# $FINS     Fecha Inicial Nomina Siguiente
# $FFNS     Fecha final nomina siguiente
# $ANIO     Ultimo año registrado
# Se calcula de Lunes a Viernes

# Fecha Inicio, primer nomina con la que se iniciara la nomina
$sql_SelectFI = "SELECT d_fechaInicio FROM conta_cs_imss WHERE s_nombreTabla = 'infoGral' and fk_id_aduana = ?";
$stmtFI = $db->prepare($sql_SelectFI);
if (!($stmtFI)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmtFI->bind_param('s',$aduana);
if (!($stmtFI)) { die("Error during query prepare [$stmtFI->errno]: $stmtFI->error");	}
if (!($stmtFI->execute())) { die("Error during query prepare [$stmtFI->errno]: $stmtFI->error"); }
$rsltFI = $stmtFI->get_result();
$rowsFI = $rsltFI->num_rows;
if( $rowsFI > 0 ){
  $rowFI = $rsltFI->fetch_assoc();
  $FI = $rowFI['d_fechaInicio'];
}

$sql_SelectANIO = "SELECT MAX(n_anio) as anio FROM conta_t_nom_captura where fk_id_regimen = '$regimenNomina' and fk_id_aduana = ?";
$stmtANIO = $db->prepare($sql_SelectANIO);
if (!($stmtANIO)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmtANIO->bind_param('s',$aduana);
if (!($stmtANIO)) { die("Error during query prepare [$stmtANIO->errno]: $stmtANIO->error");	}
if (!($stmtANIO->execute())) { die("Error during query prepare [$stmtANIO->errno]: $stmtANIO->error"); }
$rsltANIO = $stmtANIO->get_result();
$rowsANIO = $rsltANIO->num_rows;
if( $rowsANIO > 0 ){
  $rowANIO = $rsltANIO->fetch_assoc();
  #if( $rowANIO['anio'] > 1 ){
    $ANIO = $rowANIO['anio'];
  #}
}


$sql_SelectULTNOM = "SELECT max(n_semana) as id_nomina
                     FROM conta_t_nom_captura
                     where fk_id_aduana = ? and fk_id_regimen = '$regimenNomina' and n_anio = ?
                      and pk_id_docNomina in ( select fk_id_docNomina
                                               from conta_t_nom_cfdi
                                               where s_selloSATcancela is null )";
$stmtULTNOM = $db->prepare($sql_SelectULTNOM);
if (!($stmtULTNOM)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmtULTNOM->bind_param('ss',$aduana,$ANIO);
if (!($stmtULTNOM)) { die("Error during query prepare [$stmtULTNOM->errno]: $stmtULTNOM->error");	}
if (!($stmtULTNOM->execute())) { die("Error during query prepare [$stmtULTNOM->errno]: $stmtULTNOM->error"); }
$rsltULTNOM = $stmtULTNOM->get_result();
$rowsULTNOM = $rsltULTNOM->num_rows;
if( $rowsULTNOM > 0 ){
  $rowULTNOM = $rsltULTNOM->fetch_assoc();
  if( $rowULTNOM['id_nomina'] > 0 ){
    $ULTNOM = $rowULTNOM['id_nomina'];
  }
}



$sql_SelectFECHA = "SELECT d_fechaInicio,d_fechaFinal
                     FROM conta_t_nom_captura
                     where fk_id_aduana = ? and fk_id_regimen = '$regimenNomina' and n_anio = ? and n_semana = ?
                      and pk_id_docNomina in ( select fk_id_docNomina
                                               from conta_t_nom_cfdi
                                               where s_selloSATcancela is null )";
$stmtFECHA = $db->prepare($sql_SelectFECHA);
if (!($stmtFECHA)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmtFECHA->bind_param('sss',$aduana,$ANIO,$ULTNOM);
if (!($stmtFECHA)) { die("Error during query prepare [$stmtFECHA->errno]: $stmtFECHA->error");	}
if (!($stmtFECHA->execute())) { die("Error during query prepare [$stmtFECHA->errno]: $stmtFECHA->error"); }
$rsltFECHA = $stmtFECHA->get_result();
$rowsFECHA = $rsltFECHA->num_rows;
if( $rowsFECHA > 0 ){
  $rowFECHA = $rsltFECHA->fetch_assoc();
  #if( $rowFECHA['d_fechaInicio'] > 0 ){
    $anioFI = date_format(date_create($rowFECHA['d_fechaInicio']),"Y");
    $FIUNG = date_format(date_create($rowFECHA['d_fechaInicio']),"Y-m-d");
    $FFUNG = date_format(date_create($rowFECHA['d_fechaFinal']),"Y-m-d");
    $ultimaSemAnio = date_format(date_create($anioFI."-12-28"),"W"); #afecta el archivo SP_generaNominaHAS.php
  #}
}


#-- Cuando sea el caso que el año tenga 53 semanas,
#-- basta con cambiar el valor de 52 a 53, una vez que
#-- hayan generado la nomina 1 regresar el valor a 52;
#-- los proximos años seran 2015, 2020, 2026.
#-- $ultimaSemAnio equivale a 52 semanas
if( is_null($ULT_NOM) ){
  echo "parte0";
  #NOMINA 1, INICIO SISTEMA
  $NOM_SIG = 1;
  $FINS = '2019-12-30';
  $FFNS = date("Y-m-d",strtotime("$FI+6 days"));
  $anioFI = '2020';
  $ultimaSemAnio = numeroSemanasTieneUnAno($anioFI);
  $semActual = date_format(date_create($FI),"W");

}else{
  if( is_null($ULT_NOM) or $ULT_NOM == $ultimaSemAnio ){
    echo "parte1";
    $NOM_SIG = 1;
    if( is_null($FI) ){
      $FINS = $FI;
      $FFNS = date("Y-m-d",strtotime("$FINS+6 days"));
    }else{
      $FINS = date("Y-m-d",strtotime("$FFUNG+1 days"));
      $FFNS = date("Y-m-d",strtotime("$FINS+6 days"));
    }
  }else{
    echo "parte2";
    if( $ULT_NOM < $ultimaSemAnio ){
      $NOM_SIG = $ULT_NOM + 1;
      $FINS = date("Y-m-d",strtotime("$FFUNG+1 days"));
      $FFNS = date("Y-m-d",strtotime("$FINS+6 days"));
    }
  }
}
?>
